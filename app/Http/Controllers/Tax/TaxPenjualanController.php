<?php

namespace App\Http\Controllers\Tax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TaxPenjualanController extends Controller
{
    public function index()
    {
        return view('pages.tax.tax-penjualan-index');
    }

    public function month($month)
    {
        //
    }
}
