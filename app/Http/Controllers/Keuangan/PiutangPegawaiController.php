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
    public function edit($id)
    {
        // edit transaksi input penjualan to piutang per customer
        return view('livewire.keuangan.jurnal-piutang-pegawai-form', ['id'=>$id]);
    }
}
