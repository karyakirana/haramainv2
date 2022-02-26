<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KasirPembelianController extends Controller
{
    public function index()
    {
        return view('pages.Keuangan.kasir-pembelian-index');
    }

    public function edit($id)
    {
        // edit transaksi penjualan
        // load data edit
        return view('livewire.keuangan.kasir-pembelian-form',[
            'id'=>$id
        ]);
    }

}
