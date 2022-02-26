<?php

namespace App\Http\Controllers\Keuangan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SaldoPiutangController extends Controller
{
    public function index()
    {
        return view('pages.Keuangan.keuangan-saldo-piutang-index');
    }
}
