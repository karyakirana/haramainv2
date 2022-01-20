<?php

namespace App\Http\Controllers\Keuangan;

use App\Http\Controllers\Controller;
use App\Models\Keuangan\JurnalPenerimaanPenjualan;
use Illuminate\Http\Request;

class JurnalPengeluaranController extends Controller
{
    //index
    public function index()
    {
        return view('pages.Keuangan.jurnal-pengeluaran-index');
    }

    public function datatablesPengeluaran()
    {
        $data = JurnalPenerimaanPenjualan::query()
            ->where('active_cash', $this->getSessionForApi())
            ->oldest('kode')
            ->get();
        return $this->datatablesAll($data);
    }
}
