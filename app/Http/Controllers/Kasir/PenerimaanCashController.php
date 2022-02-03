<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Keuangan\JurnalPenerimaan;
use App\Models\Keuangan\JurnalPenerimaanPenjualan;
use Illuminate\Http\Request;

class PenerimaanCashController extends Controller
{
    //index
    public function index($id = null)
    {
        return view('pages.Keuangan.kasir-penerimaan-cash-index', ['id'=>$id]);
    }

    //datatables

    public function datatablesPenerimaanCash()
    {
        $data = JurnalPenerimaan::query()
            ->with('users')
            ->where('active_cash', $this->getSessionForApi())
            ->oldest('kode')
            ->get();
        return $this->datatablesAll($data);
    }

    public function create($id = null)
    {
        return view('pages.Keuangan.kasir-penerimaan-cash-trans', ['id'=>$id]);
    }
}
