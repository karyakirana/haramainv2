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
    public $nominal, $penerimaan_id;
    public $akun_kategori_nama;
    public $penerimaan;

    public $akun_kategori_id, $akun_tipe_id, $akun_id, $kode, $deskripsi;
    public $tgl_penerimaan, $user_id, $keterangan;

    public $total_bayar, $total_bayar_rupiah;


    public function render()
    {
        return view('livewire.keuangan.kasir-penerimaan-cash-form',[
            'akunPenerimaan'=>Akun::query()->whereRelation('akunTipe', 'kode', '=', '111')->get()
        ]);
    }

    public function mount()
    {
        $this->tgl_penerimaan = tanggalan_format(strtotime(now()));
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
            'nominal'=>$this->nominal
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
