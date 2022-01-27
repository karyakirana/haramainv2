<?php

namespace App\Http\Controllers\Keuangan;

use App\Http\Controllers\Controller;
use App\Models\Keuangan\Akun;
use App\Models\Keuangan\AkunSaldoAwal;
use Illuminate\Http\Request;

class NeracaSaldoController extends Controller
{
    public function index()
    {
        // neraca saldo utama atau realtime
        return view('pages.Keuangan.neraca-saldo-index', [
            'akun'=>Akun::query()->get(),
        ]);
    }

    public function neracaSaldoAwal()
    {
        // menampilkan neraca saldo awal
        return view('pages.Keuangan.neraca-saldo-awal');
    }

    public function datatablesNeracaSaldoAwal()
    {
        $data = AkunSaldoAwal::query()
            ->where('active_cash', $this->getSessionForApi())
            ->oldest('kode')
            ->get();
        return $this->datatablesAll($data);
    }

    public function neracaSaldoAkhir()
    {
        // menampilkan neraca saldo akhir
        return view('pages.Keuangan.neraca-saldo-akhir');
    }
}
