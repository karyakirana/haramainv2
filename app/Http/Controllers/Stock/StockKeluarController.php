<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use App\Models\Stock\StockKeluar;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class StockKeluarController extends Controller
{
    public function index()
    {
        // view daftar stock masuk semua
        return view('pages.stock.keluar.keluar-index');
    }

    public function datatablesIndex()
    {
        $data = StockKeluar::with(['gudang', 'users', 'stockableKeluar', 'supplier'])
            ->where('active_cash', $this->getSessionForApi())
            ->latest()->get();
        return DataTables::of($data)
            ->addColumn('actions', function ($row){
                if (is_null($row->stockable_keluar_id)){
                    return $this->buttonMaster($row->id);
                }
                return null;
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function indexBaik()
    {
        // view daftar stock masuk baik
        return view('pages.stock.keluar.keluar-baik-index');
    }

    public function datatablesIndexBaik()
    {
        // datatables stock keluar baik
        $data = StockKeluar::with(['gudang', 'users', 'stockableKeluar', 'supplier'])
            ->where('active_cash', $this->getSessionForApi())
            ->where('kondisi', 'baik')
            ->latest()->get();
        return DataTables::of($data)
            ->addColumn('actions', function ($row){
                if (is_null($row->stockable_keluar_id)){
                    return $this->buttonMaster($row->id);
                }
                return null;
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function indexRusak()
    {
        // view daftar stock rusak baik
        return view('pages.stock.keluar.keluar-rusak-index');
    }

    public function datatablesIndexRusak()
    {
        // datatables stock keluar baik
        $data = StockKeluar::with(['gudang', 'users', 'stockableKeluar', 'supplier'])
            ->where('active_cash', $this->getSessionForApi())
            ->where('kondisi', 'rusak')
            ->latest()->get();
        return DataTables::of($data)
            ->addColumn('actions', function ($row){
                if (is_null($row->stockable_keluar_id)){
                    return $this->buttonMaster($row->id);
                }
                return null;
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function createBaik()
    {
        // transaksi stock keluar baik
        return view('pages.stock.keluar.keluar-baik-trans');
    }

    public function createRusak()
    {
        // transaksi stock keluar
        return view('pages.stock.keluar.keluar-rusak-trans');
    }

    public function editBaik($id)
    {
        return view('pages.stock.keluar.keluar-baik-trans', [
            'id'=>$id
        ]);
    }

    public function editRusak($id)
    {
        return view('pages.stock.keluar.keluar-rusak-trans', [
            'id'=>$id
        ]);
    }
}
