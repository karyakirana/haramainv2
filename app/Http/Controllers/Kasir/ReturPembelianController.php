<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReturPembelianController extends Controller
{
    public function index()
    {
        return view('pages.Keuangan.retur-rusak-pembelian-index');
    }


    public function indexBaik()
    {
        return view('pages.Keuangan.retur-baik-pembelian-index');
    }

}
