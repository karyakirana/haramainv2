<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Produk;
use App\Models\Master\ProdukKategori;
use App\Models\Master\ProdukKategoriHarga;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProdukController extends Controller
{
    public function index()
    {
        // view produk
        return view('pages.master.produk-index');
    }

    public function datatablesProduk()
    {
        // datatables produk
        $data = Produk::query()
        ->with(['kategori', 'kategoriHarga'])
        ->latest('kode')
        ->get();
        return $this->datatablesAll($data);
    }

    public function componentDatatables()
    {
        // datatables produk
        $data = Produk::latest('kode')->get();
        return $this->datatablesForSet($data, 'setProduk');
    }

    public function indexKategori()
    {
        // view Kategori Index
        return view('pages.master.produk-kategori');
    }

    public function datatablesKategori()
    {
        // datatables kategori
        $data = ProdukKategori::latest('id')->get();
        return $this->datatablesAll($data);
    }

    public function indexKategoriHarga()
    {
        // view kategori harga
        return view('pages.master.produk-kategori-harga');
    }

    public function datatablesKategoriHarga()
    {
        // datatables kategori harga
        $data = ProdukKategoriHarga::latest('id')->get();
        return $this->datatablesAll($data);
    }
}
