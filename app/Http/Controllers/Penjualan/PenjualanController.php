<?php

namespace App\Http\Controllers\Penjualan;

use App\Http\Controllers\Controller;
use App\Models\Penjualan\Penjualan;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    public function index()
    {
        // daftar / list penjualan view
        return view('pages.penjualan.penjualan-index');
    }

    public function datatables()
    {
        // json datatables
        $data = Penjualan::query()
            ->with(['customer', 'gudang', 'users'])
//            ->where('active_cash', session('ClosedCash'))
            ->latest('kode')
            ->get();
        return $this->datatablesAll($data);
    }

    public function create()
    {
        // transaksi penjualan view
        return view('pages.penjualan.penjualan-transaksi');
    }

    public function store(Request $request)
    {
        // store transaksi penjualan
    }

    public function edit($id)
    {
        // edit transaksi penjualan
        // load data edit
    }

    public function update(Request $request)
    {
        // update transaksi penjualan
    }
}
