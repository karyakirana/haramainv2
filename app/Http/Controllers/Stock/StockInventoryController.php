<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use App\Models\Stock\StockInventory;
use App\Services\Repositories\StockInventoryRepo;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class StockInventoryController extends Controller
{
    protected $stockInventoryRepo;

    public function __construct()
    {
        $this->stockInventoryRepo = new StockInventoryRepo();
    }

    public function index()
    {
        // view index
    }

    public function datatablesIndex()
    {
        $data = StockInventory::query()
            ->where('active_cash', session('CLosedCash'))
            ->latest('produk_id')
            ->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function indexBaik($gudangId = null)
    {
        // view daftar stock baik
    }

    public function datatablesIndexBaik($gudangId = null)
    {
        $data = $this->stockInventoryRepo->daftarStockInventory('baik', $gudangId);
        return DataTables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function indexRusak($gudangId = null)
    {
        // view daftar stock rusak
    }

    public function datatablesIndexRusak($gudangId = null)
    {
        $data = $this->stockInventoryRepo->daftarStockInventory('rusak', $gudangId);
        return DataTables::of($data)
            ->addIndexColumn()
            ->make(true);
    }
}
