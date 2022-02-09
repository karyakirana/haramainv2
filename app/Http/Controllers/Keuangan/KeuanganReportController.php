<?php

namespace App\Http\Controllers\Keuangan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KeuanganReportController extends Controller
{
    public function index()
    {
        return view('pages.Keuangan.report-keuangan-index');
    }

    public function reportCashFlow($startDate = null, $endDate = null)
    {
        //
    }
}
