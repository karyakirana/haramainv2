<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use App\Models\Stock\StockMasuk;
use Illuminate\Http\Request;

class StockMasukController extends Controller
{
    public function index()
    {
        // view daftar stock masuk semua
        return view('pages.stock.masuk.masuk-index');
    }

    public function datatablesIndex()
    {
        //
    }

    public function indexBaik()
    {
        // view daftar stock masuk baik
        return view('pages.stock.masuk.masuk-baik-index');
    }

    public function datatablesIndexBaik()
    {
        // datatables stock masuk baik
        $data = StockMasuk::latest('kode')->get();
        return $this->datatablesAll($data);
    }

    public function indexRusak()
    {
        // view daftar stock rusak baik
        return view('pages.stock.masuk.masuk-rusak-index');
    }

    public function datatablesRusak()
    {
        //
    }

    public function createBaik()
    {
        // transaksi stock masuk baik
        return view('pages.stock.masuk.masuk-baik-trans');
    }

    public function createRusak()
    {
        // transaksi stock masuk rusak
        return view('pages.stock.masuk.masuk-rusak-trans');
    }
}
