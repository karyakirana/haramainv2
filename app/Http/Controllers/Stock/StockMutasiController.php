<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StockMutasiController extends Controller
{
    public function indexBaikBaik()
    {
        return view('pages.stock.mutasi.baik-baik-index');
    }

    public function indexBaikRusak()
    {
        return view('pages.stock.mutasi.baik-rusak-index');
    }

    public function indexRusakRusak()
    {
        return view('pages.stock.mutasi.rusak-rusak-index');
    }

    public function createBaikBaik()
    {
        return view('pages.stock.mutasi.baik-baik-trans');
    }

    public function createBaikRusak()
    {
        return view('pages.stock.mutasi.baik-rusak-trans');
    }

    public function createRusakRusak()
    {
        return view('pages.stock.mutasi.rusak-rusak-trans');
    }

}
