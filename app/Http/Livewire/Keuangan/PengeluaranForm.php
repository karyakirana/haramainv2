<?php

namespace App\Http\Livewire\Keuangan;

use App\Http\Services\Repositories\JurnalPengeluaranRepo;
use App\Models\Keuangan\Akun;
use App\Models\Keuangan\JurnalPengeluaran;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Livewire\Component;

class PengeluaranForm extends Component
{
    public function render()
    {
        return view('livewire.keuangan.pengeluaran-form',[
            'akunPengeluaran'=>Akun::query()->whereRelation('akunTipe', 'kode', '=', '111')->get()
        ]);
    }
    protected $listeners = [
        'setAkun'=> 'setAkun',
    ];

    public $mode = 'create';

    // variabel form utama
    public $pengeluaran_id;
    public $akun;
    public $tanggal;
    public $tujuan;
    public $keterangan;

    // variabel form detail
    public $akun_id_detail;
    public $kode_detail;
    public $deskripsi_detail;
    public $nominal_detail;
    public $keterangan_detail;

    // variabel for table
    public $detail = [];

    public $total_bayar, $total_bayar_rupiah;


    public function mount($kasirPengeluaran = null)
    {
        $this->tgl_pengeluaran = tanggalan_format(strtotime(now()));

        //set edit
        if ($kasirPengeluaran){
            $this->mode = 'update';
            $kasirPengeluaran = JurnalPengeluaran::query()->with(['users', 'jurnalTransaksi'])->find($kasirPengeluaran);

            $this->pengeluaran_id = $kasirPengeluaran ->id;
            $this->tanggal = tanggalan_format( $kasirPengeluaran ->tgl_pengeluaran);
            $this->tujuan = $kasirPengeluaran->tujuan;
//            dd($this->tujuan);

            foreach ($kasirPengeluaran->jurnalTransaksi as $row)
            {
                if ($row->nominal_debet){
                    $this->detail[] = [
                        'akun_id_detail'=>$row->akun_id,
                        'kode_detail'=>$row->akun->kode,
                        'deskripsi_detail'=>$row->akun->deskripsi,
                        'nominal_detail'=>$row->nominal_debet,
                        'keterangan_detail'=>$row->keterangan,
                    ];
                }
                if ($row->nominal_kredit){
                    $this->akun = $row -> akun_id;
                    $this->keterangan = $row->keterangan;
                }
            }
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
        $this->kode_detail = $akun->kode;
        $this->deskripsi_detail = $akun->deskripsi;
        $this->emit('hideAkunModal');

    }

    public function addLine()
    {
        $this->validate(
            [
                'nominal_detail'=>'required',
                'kode_detail'=>'required',
                'keterangan_detail'=>'required'
            ],
            [],
            [
                'nominal_detail'=>'Nominal',
                'kode_detail'=>'akun',
                'keterangan_detail'=>'keterangan'
            ]
        );

        $this->detail [] = [
            'akun_id_detail'=>$this->akun_id_detail,
            'kode_detail'=>$this->kode_detail,
            'deskripsi_detail'=>$this->deskripsi_detail,
            'nominal_detail'=>$this->nominal_detail,
            'keterangan_detail'=>$this->keterangan_detail,
        ];
        $this->hitung_total();
        $this->resetForm();
    }

    public function destroyLine($index)
    {
        unset($this->detail[$index]);
        $this->daftarAkun = array_values($this->detail);
        $this->hitung_total();
    }
    protected function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset([
            'akun_id_detail', 'kode_detail', 'deskripsi_detail', 'nominal_detail', 'keterangan_detail'
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
            'tujuan'=>'required',
            'keterangan'=>'required',
        ]);

        // simpan jurnal pengeluaran
        $data = (object)[
            'id'=>$this->pengeluaran_id,
            'tanggal_pengeluaran'=>$this->tanggal,
            'total_bayar'=>$this->total_bayar,
            'tujuan'=>$this->tujuan,
            'keterangan'=>$this->keterangan,

            'detail'=>$this->detail,

            'akunKredit'=>$this->akun,
            'keteranganKredit'=>$this->keterangan,
        ];

        \DB::beginTransaction();
        try {
            if ($this->mode == 'create'){
                $id = (new JurnalPengeluaranRepo())->store($data);
            } else {
                $id = (new JurnalPengeluaranRepo())->update($data);
            }
            \DB::commit();
            return redirect()->to('keuangan/kasir/pengeluaran');
        } catch (ModelNotFoundException $e){
            \DB::rollBack();
            session()->flash('message', $e);
        }
    }

}
