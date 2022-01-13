<?php

namespace App\Http\Livewire\Master;

use App\Models\Master\Produk;
use App\Models\Master\ProdukKategori;
use App\Models\Master\ProdukKategoriHarga;
use Livewire\Component;

class ProdukForm extends Component
{
    protected $listeners = [
        'produkAdd'=>'produkAdd',
        'resetForm'=>'resetForm',
        'produkEdit'=>'produkEdit',
        'produkDelete'=>'produkDelete'
    ];

    public $idProduk, $kode, $kode_lokal, $kategori_id, $kategori_harga_id;
    public $penerbit, $nama, $hal, $cover, $harga, $size, $deskripsi, $kategoriProduk, $kategoriHarga;
    protected $produk;

    public function mount()
    {
        $this->kategoriProduk = ProdukKategori::all();
        $this->kategoriHarga = ProdukKategoriHarga::all();
    }
    public function kode()
    {
        $produk = Produk::latest('kode')->first();
        if (!$produk){
            $num = 1;
        } else {
            $lastNum = (int) $produk->last_num_kode;
            $num = $lastNum + 1;
        }
        return "P".sprintf("%05s", $num);
    }
    public function render()
    {
        return view('livewire.master.produk-form');
    }

    public function resetForm()
    {
        $this->resetValidation();
        $this->resetErrorBag();
    }

    public function store()
    {
        $this->validate([
            'kode_lokal'=>'required',
            'nama'=>'required|min:3'
        ]);

        Produk::updateOrCreate(
            [
                'id'=>$this->idProduk,
            ],
            [
                'kode'=>$this->kode ?? $this->kode(),
                'kode_lokal'=>$this->kode_lokal,
                'nama'=>$this->nama,
                'kategori_id'=>$this->kategori_id,
                'kategori_harga_id'=>$this->kategori_harga_id,
                'hal'=>$this->hal,
                'size'=>$this->size,
                'cover'=>$this->cover,
                'harga'=>$this->harga,
                'penerbit'=>$this->penerbit,
                'deskripsi'=>$this->deskripsi
            ]
        );
        $this->emit('storeProduk');
        $this->emit('hideProdukModal');
    }

    public function produkEdit(Produk $produk)
    {
        $this->idProduk = $produk->id;
        $this->kode = $produk->kode;
        $this->kode_lokal = $produk->kode_lokal;
        $this->nama = $produk->nama;
        $this->kategori_id = $produk->kategori_id;
        $this->kategori_harga_id = $produk->kategori_harga_id;
        $this->hal = $produk->hal;
        $this->size = $produk->size;
        $this->cover = $produk->cover;
        $this->harga = $produk->harga;
        $this->penerbit = $produk->penerbit;
        $this->deskripsi = $produk->deskripsi;
        $this->emit('showProdukModal');
    }

    public function produkAdd()
    {
        $this->emit('showProdukModal');
    }

    public function produkDelete($id)
    {
        $this->idProduk->destroy($this->id);
    }


}
