<?php

namespace App\Http\Livewire\Keuangan;

use App\Models\Keuangan\Akun;
use App\Http\Services\Repositories\JurnalPenerimaanRepo;
use App\Models\Keuangan\JurnalPenerimaan;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class KasirPenerimaanCashForm extends Component
{
    protected $listeners = [
        'resetForm'=> 'resetForm',
        'setAkun'=>'setAkun'
    ];

    public $mode = 'create';

    /**
     * @var
     * variabel untuk id =form-utama
     */
    public $jurnal_penerimaan_id;
    public $akun;
    public $tanggal;
    public $sumber;
    public $keterangan;

    // variabel untuk form detail
    public $akun_id_detail;
    public $akun_detail;
    public $deskripsi_detail;
    public $nominal_detail;
    public $keterangan_detail;

    // variabel untuk total bayar sum(total_bayar)
    public $total_bayar;
    public $total_bayar_rupiah;

    // variable untuk table;
    public $detail = [];

    public $akun_kategori_id, $akun_tipe_id, $deskripsi;
    public $user_id, $user_nama;


    public function render()
    {
        $akun_jenis_penerimaan = Akun::query()->whereRelation('akunTipe', 'kode', '=', '111')->get();
        return view('livewire.keuangan.kasir-penerimaan-cash-form',[
            'akun_jenis_penerimaan'=>$akun_jenis_penerimaan
        ]);
    }

    public function mount($jurnal_penerimaan_id = null)
    {
        // default tanggal
        $this->tanggal = tanggalan_format(strtotime(now()));

        // mounting data for edit
        if ($jurnal_penerimaan_id)
        {
            $this->mode = 'update';
            $jurnal_penerimaan = JurnalPenerimaan::query()->find($jurnal_penerimaan_id);
            $this->jurnal_penerimaan_id = $jurnal_penerimaan->id;
            $this->tanggal = tanggalan_format($jurnal_penerimaan->tgl_penerimaan);
            $this->sumber = $jurnal_penerimaan->sumber;
//            dd($jurnal_penerimaan->sumber);

            // set from jurnal_transaksi
            $jurnal_transaksi = $jurnal_penerimaan->jurnalTransaksi;

            foreach ($jurnal_transaksi as $item)
            {
                // set detail
                if ($item->nominal_kredit){

                    $this->detail[] = [
                        'akun_id_detail'=>$item->akun_id,
                        'akun_detail'=>$item->akun->kode,
                        'deskripsi_detail'=>$item->akun->deskripsi,
                        'nominal_detail'=>$item->nominal_kredit,
                        'keterangan_detail'=>$item->keterangan
                    ];
                }

                // set form-utama
                if ($item->nominal_debet){

                    $this->akun = $item->akun_id;
                    $this->keterangan = $item->keterangan;
                }
//                dd($this->akun);
            }
            // hitung total
            $this->hitung_total();
        }
    }

    public function showAkun()
    {
        $this->emit('showAkunModal');
    }

    public function setAkun(Akun $akun)
    {
        $this->akun_id_detail = $akun->id;
        $this->akun_detail = $akun->kode;
        $this->deskripsi_detail = $akun->deskripsi;
        $this->nominal_detail = $akun->nominal;
        $this->emit('hideAkunModal');

    }

    public function addLine()
    {
        // validate
        $this->validate(
            [
                'nominal_detail'=>'required',
                'akun_detail'=>'required'
            ],
            [
                'akun_detail.required'=>'Data Harus Diisi'
            ],
            [
                'akun_detail'=>'data detail',
                'nominal_detail'=>'nominal'
            ]
        );

        $this->detail [] = [
            'akun_id_detail'=>$this->akun_id_detail,
            'akun_detail'=>$this->akun_detail,
            'deskripsi_detail'=>$this->deskripsi_detail,
            'nominal_detail'=>$this->nominal_detail,
            'keterangan_detail'=>$this->keterangan_detail
        ];
        $this->hitung_total();
        $this->resetForm();
    }

    public function destroyLine($index)
    {
        unset($this->detail[$index]);
        $this->detail = array_values($this->detail);
        $this->hitung_total();
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset([
            'akun_id_detail', 'akun_detail', 'deskripsi_detail', 'nominal_detail', 'keterangan_detail'
        ]);
    }

    public function hitung_total()
    {
        // hitung total
        $this->total_bayar = array_sum(array_column($this->detail, 'nominal_detail'));
        $this->total_bayar_rupiah = rupiah_format($this->total_bayar);
    }

    public function store()
    {
        $this->validate([
            'akun'=>'required',
            'tanggal'=>'required',
            'sumber'=>'required',
            'keterangan'=>'required'
        ]);

        // simpan jurnal penerimaan
        $data = (object)[
            'id'=>$this->jurnal_penerimaan_id,
            'tgl_penerimaan'=>$this->tanggal,
            'total_bayar'=>$this->total_bayar,
            'asal'=>$this->sumber,
            'keterangan'=>$this->keterangan,

            // for jurnal transaksi
            'detail'=>$this->detail,
            'akunDebet'=>$this->akun,
            'keteranganDebet'=>$this->keterangan
        ];

        \DB::beginTransaction();
        try {
            if($this->mode == 'create')
                (new JurnalPenerimaanRepo())->store($data);
            else
                (new JurnalPenerimaanRepo())->update($data);
            \DB::commit();
            return redirect()->to('keuangan/kasir/penerimaan/lain');
        } catch (QueryException $e){
            \DB::rollBack();
            session()->flash('message', $e);
        }
    }

}
