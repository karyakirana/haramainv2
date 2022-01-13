<?php

namespace App\Http\Livewire\Master;

use App\Models\Master\ProdukKategori;
use Livewire\Component;

class ProdukKategoriForm extends Component
{
    protected $listeners = [
        'kategoriProdukAdd'=>'kategoriProdukAdd',
        'resetForm'=>'resetForm',
        'kategoriProdukEdit'=>'kategoriProdukEdit',
        'kategoriProdukDelete'=>'kategoriProdukDelete'
    ];

    public $idKategoriProduk, $kode_lokal, $nama, $keterangan;

    public function render()
    {
        return view('livewire.master.produk-kategori-form');
    }


    public function resetForm()
    {
        $this->resetExcept(['search', 'pagination']);
        $this->resetValidation();
        $this->resetErrorBag();
    }

    public function store()
    {
        $this->validate([
            'kode_lokal'=>'required',
            'nama'=>'required'
        ]);

        ProdukKategori::updateOrCreate(
            [
                'id'=>$this->idKategoriProduk,
            ],
        [
            'kode_lokal'=>$this->kode_lokal,
            'nama'=>$this->nama,
            'keterangan'=>$this->keterangan,
        ]);
        $this->emit('storeKategoriProduk');
        $this->emit('hideKategoriProdukModal');
    }

    public function kategoriProdukEdit(ProdukKategori $kategori)
    {
        $this->idKategoriProduk = $kategori->id;
        $this->kode_lokal = $kategori->kode_lokal;
        $this->nama = $kategori->nama;
        $this->keterangan = $kategori->keterangan;
        $this->emit('showKategoriProdukModal');
    }

    public function kategoriProdukAdd()
    {
        $this->emit('showKategoriProdukModal');
    }

    public function kategoriProdukDelete($id)
    {
        $this->idKategoriProduk->destroy($this->id);
    }

}
