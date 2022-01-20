<?php

namespace App\Http\Controllers\Keuangan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JurnalMutasiController extends Controller
{
    //index
    public function index()
    {
        return view('pages.Keuangan.jurnal-mutasi-index');
    }
}
