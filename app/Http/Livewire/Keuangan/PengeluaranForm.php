<?php

namespace App\Http\Livewire\Keuangan;

use App\Models\Keuangan\Akun;
use Livewire\Component;

class PengeluaranForm extends Component
{
    public function render()
    {
        return view('livewire.keuangan.pengeluaran-form',[
            'akunPenerimaan'=>Akun::query()->whereRelation('akunTipe', 'kode', '=', '1')->get()
        ]);
    }
    protected $listeners = [
        'setAkun'=> 'setAkun',
    ];
    public $daftarAkun = [];
    public $nominal;
    public $akun_kategori_nama;
    public $akun_kategori_id, $akun_tipe_id, $kode, $deskripsi;



    public function showAkun()
    {
        $this->emit('showAkunModal');
    }

    public function setAkun(Akun $akun)
    {
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
            'akun_kategori_id'=>$this->akun_kategori_id,
            'akun_kategori_nama'=>$this->akun_kategori_nama,
            'akun_tipe_id'=>$this->akun_tipe_id,
            'kode'=>$this->kode,
            'deskripsi'=>$this->deskripsi,
            'nominal'=>$this->nominal
        ];
        $this->resetForm();
    }
    protected function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset([
            'akun_kategori_id', 'akun_tipe_id', 'kode', 'deskripsi', 'nominal'
        ]);
    }

}
