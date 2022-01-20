<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PembayaranPiutangController extends Controller
{
    //index pembayaran
    public function index()
    {
        return view('pages.Keuangan.kasir-pembayaran-piutang-index');
    }

}
