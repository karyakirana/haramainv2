<?php

namespace App\Http\Controllers\Penjualan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    public function index()
    {
        // daftar / list penjualan view
    }

    public function datatables()
    {
        // json datatables
    }

    public function create()
    {
        // transaksi penjualan view
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
