<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Keuangan\JurnalPengeluaran;
use Illuminate\Http\Request;

class PengeluaranController extends Controller
{

    // index pengeluaran kasir
    public function index()
    {
        return view('pages.Keuangan.kasir-pengeluaran-index');
    }

    //transaksi pengeluaran kasir
    public function create($id = null)
    {
        return view('pages.Keuangan.kasir-pengeluaran-trans', ['id'=>$id]);
    }

    public function datatablesPengeluaran()
    {
        $data = JurnalPengeluaran::query()
            ->with('users')
            ->where('active_cash', $this->getSessionForApi())
            ->oldest('kode')
            ->get();
        return $this->datatablesAll($data);
    }
}
