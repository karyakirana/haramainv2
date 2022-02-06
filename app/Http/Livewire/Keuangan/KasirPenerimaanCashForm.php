<?php

namespace App\Http\Livewire\Keuangan;

use App\Models\Keuangan\Akun;
use App\Http\Services\Repositories\JurnalPenerimaanRepo;
use App\Models\Keuangan\JurnalPenerimaan;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class KasirPenerimaanCashForm extends Component
{
    protected $listeners = [
        'setAkun'=> 'setAkun',
    ];
    public $daftarAkun = [];
    public $mode = 'create';

    public $akun_kategori_nama;
    public $penerimaan;

    // variabel untuk form utama
    public $penerimaan_id, $tgl_penerimaan, $sumber, $keterangan;

    // variabel untuk form detail
    public $akun_id, $akun_kode, $akun_deskripsi, $akun_nominal, $keterangan_detail;

    // variable untuk table;

    public $akun_kategori_id, $akun_tipe_id, $deskripsi;
    public $user_id, $user_nama;

    public $total_bayar, $total_bayar_rupiah;


    public function render()
    {
        return view('livewire.keuangan.kasir-penerimaan-cash-form',[
            'akunPenerimaan'=>Akun::query()->whereRelation('akunTipe', 'kode', '=', '111')->get()
        ]);
    }

    public function mount($kasirPenerimaan = null)
    {
        $this->tgl_penerimaan = tanggalan_format(strtotime(now()));
        if ($kasirPenerimaan){
            $this->mode = 'update';
            $kasirPenerimaan = JurnalPenerimaan::query()->with(['users', 'jurnalTransaksi'])->find($kasirPenerimaan);

//            dd($kasirPenerimaan);
            $this->penerimaan_id = $kasirPenerimaan ->id;
            $this->user_id = $kasirPenerimaan ->user_id;
            $this->user_nama =$kasirPenerimaan->users->name;
            $this->tgl_penerimaan = tanggalan_format( $kasirPenerimaan ->tgl_penerimaan);
            $this->sumber = $kasirPenerimaan->sumber;
            $this->keterangan = $kasirPenerimaan ->keterangan;
            $this->total_bayar = $kasirPenerimaan ->nominal;

            foreach ($kasirPenerimaan->jurnalTransaksi as $row)
            {
                if ($row->nominal_kredit){
                    $this->daftarAkun[] = [
                        'akun_id'=>$row->akun_id,
                        'akun_kategori_id'=>$row->akun_kategori_id,
                        'akun_kategori_nama'=>$row->akun->akunKategori->deskripsi,
                        'akun_tipe_id'=>$row->akun_tipe_id,
                        'kode'=>$row->akun->kode,
                        'deskripsi'=>$row->akun->deskripsi,
                        'nominal'=>$row->nominal_kredit,
                        'keterangan_detail'=>$row->keterangan
                    ];
                }
                if ($row->nominal_debet){
                    $this->penerimaan = $row -> akun_id;
                    $this->keterangan = $row->keterangan;
                }
            }

        }
    }

    public function showAkun()
    {
        $this->emit('showAkunModal');
    }

    public function setAkun(Akun $akun)
    {
        $this->akun_id = $akun->id;
        $this->kode =$akun->kode;
        $this->akun_kategori_id = $akun->akun_kategori_id;
        $this->akun_kategori_nama = $akun->akunKategori->deskripsi;
        $this->deskripsi =$akun->deskripsi;
        $this->nominal=$akun->nominal;
        $this->emit('hideAkunModal');

    }

    public function addLine()
    {
        $this->validate([
            'nominal'=>'required',
            'kode'=>'required'
        ]);

        $this->daftarAkun [] = [
            'akun_id'=>$this->akun_id,
            'akun_kategori_id'=>$this->akun_kategori_id,
            'akun_kategori_nama'=>$this->akun_kategori_nama,
            'akun_tipe_id'=>$this->akun_tipe_id,
            'kode'=>$this->kode,
            'deskripsi'=>$this->deskripsi,
            'nominal'=>$this->nominal,
            'keterangan_detail'=>$this->keterangan_detail,
        ];
        $this->hitung_total();
        $this->resetForm();
    }

    public function destroyLine($index)
    {
        unset($this->daftarAkun[$index]);
        $this->daftarAkun = array_values($this->daftarAkun);
        $this->hitung_total();
    }
    protected function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset([
            'akun_kategori_id', 'akun_tipe_id', 'kode', 'deskripsi', 'nominal'
        ]);
    }

    public function hitung_total()
    {
        // hitung total
        $this->total_bayar = array_sum(array_column($this->daftarAkun, 'nominal'));
        $this->total_bayar_rupiah = rupiah_format($this->total_bayar);
    }

    public function store()
    {
        $this->validate([
            'penerimaan'=>'required',
            'tgl_penerimaan'=>'required'
        ]);

        // simpan jurnal penerimaan
        $data = (object)[
            'tgl_penerimaan'=>$this->tgl_penerimaan,
            'total_bayar'=>$this->total_bayar,
            'asal'=>$this->sumber,
            'keterangan'=>$this->keterangan,

            'detail'=>$this->daftarAkun,

            'akunDebet'=>$this->penerimaan,
        ];

        \DB::beginTransaction();
        try {
            (new JurnalPenerimaanRepo())->store($data);
            \DB::commit();
            return redirect()->to('keuangan/kasir/penerimaan/lain');
        } catch (ModelNotFoundException $e){
            \DB::rollBack();
            session()->flash('message', $e);
        }
    }

}
