<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use App\Models\Stock\StockMasuk;
use Illuminate\Http\Request;

class StockMasukController extends Controller
{
    public function index()
    {
        // view daftar stock masuk semua
        return view('pages.stock.masuk.masuk-index');
    }

    public function datatablesIndex()
    {
        // datatables stock masuk baik
        $data = StockMasuk::query()
            ->with([ 'gudang', 'users'])
            ->where('active_cash', $this->getSessionForApi())
            ->latest('kode')
            ->get();
        return $this->datatablesAll($data);
    }

    public function indexBaik()
    {
        // view daftar stock masuk baik
        return view('pages.stock.masuk.masuk-baik-index');
    }

    public function datatablesIndexBaik()
    {
        // datatables stock masuk baik
        $data = StockMasuk::query()
            ->with([ 'gudang', 'users'])
            ->where('active_cash', $this->getSessionForApi())
            ->where('kondisi', 'baik')
            ->latest('kode')
            ->get();
        return $this->datatablesAll($data);
    }


    public function editBaik($id)
    {
        // edit transaksi stock masuk baik
        // load data edit
        return view('pages.stock.masuk.masuk-baik-trans',[
            'id'=>$id
        ]);
    }

    public function indexRusak()
    {
        // view daftar stock rusak baik
        return view('pages.stock.masuk.masuk-rusak-index');
    }

    public function datatablesIndexRusak()
    {
        // datatables stock masuk baik
        $data = StockMasuk::query()
            ->with([ 'gudang', 'users'])
            ->where('active_cash', $this->getSessionForApi())
            ->where('kondisi', 'rusak')
            ->latest('kode')
            ->get();
        return $this->datatablesAll($data);
    }

    public function editRusak($id)
    {
        // edit transaksi stock masuk rusak
        // load data edit
        return view('pages.stock.masuk.masuk-rusak-trans',[
            'id'=>$id
        ]);
    }

    public function createBaik()
    {
        // transaksi stock masuk baik
        return view('pages.stock.masuk.masuk-baik-trans');
    }

    public function createRusak()
    {
        // transaksi stock masuk rusak
        return view('pages.stock.masuk.masuk-rusak-trans');
    }
}
