<?php

namespace App\Http\Controllers\Keuangan;

use App\Http\Controllers\Controller;
use App\Models\Keuangan\JurnalPenjualan;
use Illuminate\Http\Request;

class JurnalPenjualanController extends Controller
{
     //set piutan
        public function indexSet()
    {
        return view('pages.Keuangan.kasir-set-piutang-index');
    }

    public function datatablesSetPiutang()
    {
        $data = JurnalPenjualan::query()
            ->with(['customer', 'users'])
            ->where('active_cash', $this->getSessionForApi())
            ->oldest('kode')
            ->get();
        return $this->datatablesAll($data);
    }
    public function create()
    {
        // transaksi input penjualan to piutang per customer
        return view('pages.Keuangan.kasir-set-piutang-trans');
    }

    public function edit($id)
    {
        // edit transaksi input penjualan to piutang per customer
        return view('pages.Keuangan.kasir-set-piutang-trans', ['id'=>$id]);
    }
}
