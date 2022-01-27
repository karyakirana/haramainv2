<?php

namespace App\Http\Controllers\Penjualan;

use App\Http\Controllers\Controller;
use App\Models\Penjualan\PenjualanRetur;
use Illuminate\Http\Request;

class ReturRusakController extends Controller
{
    public function index()
    {
        // view daftar retur rusak
        return view('pages.penjualan.retur-rusak-index');
    }

    public function datatables()
    {
        // return datatables
        $data = PenjualanRetur::query()
            ->with(['customer', 'gudang'])
//            ->where('active_cash', session('ClosedCash'))
            ->latest('kode')
            ->get();
        return $this->datatablesAll($data);
    }

    public function create()
    {
        // create new transaksi retur rusak (view)
        return view('pages.penjualan.retur-rusak-transaksi');
    }

    public function store(Request $request)
    {
        // store new data
    }

    public function edit($id)
    {
        // edit transaksi data (view)
        return view('pages.penjualan.retur-rusak-transaksi', [
           'id'=>$id
        ]);
    }

    public function update(Request $request)
    {
        // update data
    }
}
