<?php

namespace App\Http\Controllers\Keuangan;

use App\Http\Controllers\Controller;
use App\Models\Keuangan\AkunSaldoAwal;
use Illuminate\Http\Request;

class NeracaSaldoController extends Controller
{
    public function index()
    {
        // neraca saldo utama atau realtime
        return view('pages.Keuangan.neraca-saldo-index');
    }

    public function neracaSaldoAwal()
    {
        // menampilkan neraca saldo awal
        return view('pages.Keuangan.neraca-saldo-awal');
    }

    public function datatablesNeracaSaldoAwal()
    {
        $data = AkunSaldoAwal::query()
            ->where('activew_cash', $this->getSessionForApi())
            ->oldest('kode')
            ->get();
    }

    public function neracaSaldoAkhir()
    {
        // menampilkan neraca saldo akhir
        return view('pages.Keuangan.neraca-saldo-akhir');
    }
}
