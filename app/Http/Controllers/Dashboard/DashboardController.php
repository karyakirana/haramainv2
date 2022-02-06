<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Stock\StockInventory;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // view dashboard general (guest)
        return view('pages.dashboard-index');
    }

    public function keuangan()
    {
        return view('pages.dashboard-keuangan');
    }
}
