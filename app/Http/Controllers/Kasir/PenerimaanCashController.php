<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Keuangan\JurnalPenerimaanPenjualan;
use Illuminate\Http\Request;

class PenerimaanCashController extends Controller
{
    //index
    public function index()
    {
        return view('pages.Keuangan.kasir-penerimaan-cash-index');
    }

    //datatables

    public function datatablesPenerimaanCash()
    {
        $data = JurnalPenerimaanPenjualan::query()
            ->where('active_cash', $this->getSessionForApi())
            ->oldest('kode')
            ->get();
        return $this->datatablesAll($data);
    }

    public function create()
    {
        return view('pages.Keuangan.kasir-penerimaan-cash-trans');
    }
}
