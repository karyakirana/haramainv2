<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PembayaranCashController extends Controller
{
    //index
    public function index()
    {
        return view('pages.Keuangan.kasir-pembayaran-cash-index');
    }

    // transaksi pembayaran cash
    public function create()
    {
        return view('pages.Keuangan.kasir-pembayaran-cash-trans');
    }

    public function edit()
    {
        //
    }
}
