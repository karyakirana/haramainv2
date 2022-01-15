<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StockKeluarController extends Controller
{
    public function index()
    {
        // view daftar stock masuk semua
        return view('pages.stock.keluar.keluar-index');
    }

    public function datatablesIndex()
    {
        //
    }

    public function indexBaik()
    {
        // view daftar stock masuk baik
        return view('pages.stock.keluar.keluar-baik-index');
    }

    public function datatablesIndexBaik()
    {
        //
    }

    public function indexRusak()
    {
        // view daftar stock rusak baik
        return view('pages.stock.keluar.keluar-rusak-index');
    }

    public function datatablesRusak()
    {
        //
    }

    public function createBaik()
    {
        // transaksi stock keluar baik
        return view('pages.stock.keluar.keluar-baik-trans');
    }

    public function createRusak()
    {
        // transaksi stock keluar
        return view('pages.stock.keluar.keluar-rusak-trans');
    }
}
