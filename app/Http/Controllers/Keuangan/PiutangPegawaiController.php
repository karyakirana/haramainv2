<?php

namespace App\Http\Controllers\Keuangan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PiutangPegawaiController extends Controller
{
    //index
    public function index()
    {
        return view('pages.Keuangan.kasir-piutang-pegawai-index');
    }
}
