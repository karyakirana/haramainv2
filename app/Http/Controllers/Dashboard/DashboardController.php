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
        return view('pages.dashboard-index', [
            'stockInventory'=>StockInventory::query()->with(['produk', 'gudang'])->limit(20)
        ]);
    }
}
