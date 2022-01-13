<?php

namespace App\Http\Livewire\Master;

use App\Models\Master\ProdukKategoriHarga;
use Livewire\Component;

class ProdukKategoriHargaForm extends Component
{
    protected $listeners = [
        'kategoriAdd'=>'kategoriAdd',
        'resetForm'=>'resetForm',
        'kategoriHargaEdit'=>'kategoriHargaEdit',
        'kategoriHargaDelete'=>'kategoriHargaDelete'
    ];
    public $idKategoriHarga, $nama, $keterangan;

    public function render()
    {
        return view('livewire.master.produk-kategori-harga-form');
    }

    public function resetForm()
    {
        $this->resetValidation();
        $this->resetErrorBag();
    }

    public function store()
    {
        $this->validate([
            'nama'=>'required'
        ]);

        ProdukKategoriHarga::updateOrCreate(
            [
                'id'=>$this->idKategoriHarga,
            ],
            [
                'nama'=>$this->nama,
                'keterangan'=>$this->keterangan,
            ]);
        $this->emit('storeKategoriHarga');
        $this->emit('hideKategoriModal');
    }

    public function kategoriHargaEdit(ProdukKategoriHarga $produkKategoriHarga)
    {
        $this->idKategoriHarga = $produkKategoriHarga->id;
        $this->nama = $produkKategoriHarga->nama;
        $this->keterangan = $produkKategoriHarga->keterangan;
        $this->emit('showKategoriModal');
    }

    public function kategoriAdd()
    {
        $this->emit('showKategoriModal');
    }

    public function kategoriHargaDelete($id)
    {
        $this->idKategoriHarga->destroy($this->id);
    }

}
