<?php

namespace App\Http\Livewire\Penjualan;

use App\Models\Master\Customer;
use App\Models\Master\Produk;
use Livewire\Component;

class PenjualanForm extends Component
{
    protected $listeners = [
        'setCustomer'=>'setCustomer',
        'setProduk'=>'setProduk'
    ];

    public $dataDetail =[];

    // properti master
    public $kode, $customer_id, $customer_nama, $customer_diskon, $gudang_id, $user_id;
    public $tgl_nota, $tgl_tempo, $jenis_bayar, $status_bayar, $total_barang, $ppn, $biaya_lain, $total_bayar;
    public $keterangan, $print;
    public $total, $total_bayar_rupiah;

    // properti detail
    public $idDetail, $idProduk, $namaProduk, $kodeLokalProduk, $coverProduk, $halProduk, $hargaProduk, $diskonProduk, $jumlahProduk, $subTotalProduk;
    public $detailProduk, $detailHarga, $detailDiskon, $detailDiskonHarga, $detailSubTotal;

    public function mount()
    {
        //
    }

    public function showCustomer()
    {
        $this->emit('showCustomer');
    }

    public function setCustomer(Customer $customer)
    {
        $this->customer_id = $customer->id;
        $this->customer_nama = $customer->nama;
        $this->customer_diskon = $customer->diskon;
        $this->emit('hideCustomer');
    }

    public function hitungDiskon()
    {
        $this->detailDiskon = (int)$this->hargaProduk - ((int)$this->hargaProduk * ((int)$this->diskonProduk)/100);
        $this->detailDiskonHarga = rupiah_format($this->detailDiskon);
    }

    public function hitungSubTotal()
    {
        $this->hitungDiskon();
        $this->subTotalProduk = $this->detailDiskon * (int)$this->jumlahProduk;
        $this->detailSubTotal = rupiah_format($this->subTotalProduk);
    }

    public function showProduk()
    {
        $this->emit('showProduk');
    }

    public function setProduk(Produk $produk)
    {
        $this->idProduk = $produk->id;
        $this->namaProduk = $produk->nama."\n".$produk->cover."\n".$produk->hal;
        $this->kodeLokalProduk = $produk->kode_lokal;
        $this->halProduk = $produk->hal;
        $this->coverProduk = $produk->cover;
        $this->hargaProduk = $produk->harga;
        $this->diskonProduk = $this->customer_diskon;
        $this->detailHarga = rupiah_format($this->hargaProduk);
        $this->hitungDiskon();
        $this->emit('hideProduk');
    }

    public function addLine()
    {
        // add line transaksi
    }

    public function editLine($index)
    {
        // edit line transaksi
    }

    public function updateLine()
    {
        // update line transaksi
    }

    public function removeLine()
    {
        // remove line transaksi
    }

    public function store()
    {
        // generate key
        // store Penjualan
        // store Stock
        // store Detail
        // update inventory real
    }

    public function render()
    {
        return view('livewire.penjualan.penjualan-form');
    }
}
