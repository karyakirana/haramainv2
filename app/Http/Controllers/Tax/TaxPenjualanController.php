<?php

namespace App\Http\Controllers\Tax;

use App\Http\Controllers\Controller;
use App\Models\Master\Perusahaan;
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

    public function masterPerusahaan()
    {
        return view('pages.tax.tax-master-perusahaan');
    }

    public function datatablesPerusahaan()
    {
        $data = Perusahaan::latest('kode')->get();
        return $this->datatablesAll($data);
    }
}
