<?php

namespace App\Http\Controllers\Keuangan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JurnalPiutangPegawaiController extends Controller
{
    public function index()
    {
        // daftar transaksi peminjaman pegawai
    }

    public function indexPegawai()
    {
        // daftar saldo hutang pegawai
    }

    public function receipt($status, $id)
    {
        //
    }

    public function report($startDate = null, $endDate = null)
    {
        //
    }

    public function reportPeminjamanByPegawai($idPegawai, $startDate = null, $endDate = null)
    {
        //
    }
}
