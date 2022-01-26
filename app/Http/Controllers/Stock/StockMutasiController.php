<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use App\Models\Stock\StockMutasi;
use Illuminate\Http\Request;

class StockMutasiController extends Controller
{
    public function indexBaikBaik()
    {
        return view('pages.stock.mutasi.baik-baik-index');
    }


    public function datatablesBaikBaik()
    {
        // datatables stock opname
        $data = StockMutasi::query()
            ->with([ 'gudangAsal', 'gudangTujuan', 'users'])
            ->where('active_cash', $this->getSessionForApi())
            ->where('jenis_mutasi', 'baik_baik')
            ->latest('kode')
            ->get();
        return $this->datatablesAll($data);
    }

    public function indexBaikRusak()
    {
        return view('pages.stock.mutasi.baik-rusak-index');
    }

    public function datatablesBaikRusak()
    {
        // datatables stock opname
        $data = StockMutasi::query()
            ->with([ 'gudangAsal', 'gudangTujuan', 'users'])
            ->where('active_cash', $this->getSessionForApi())
            ->where('jenis_mutasi', 'baik_rusak')
            ->latest('kode')
            ->get();
        return $this->datatablesAll($data);
    }


    public function indexRusakRusak()
    {
        return view('pages.stock.mutasi.rusak-rusak-index');
    }

    public function datatablesRusakRusak()
    {
        // datatables stock opname
        $data = StockMutasi::query()
            ->with([ 'gudangAsal', 'gudangTujuan', 'users'])
            ->where('active_cash', $this->getSessionForApi())
            ->where('jenis_mutasi', 'rusak_rusak')
            ->latest('kode')
            ->get();
        return $this->datatablesAll($data);
    }


    public function createBaikBaik()
    {
        return view('pages.stock.mutasi.baik-baik-trans');
    }

    public function createBaikRusak()
    {
        return view('pages.stock.mutasi.baik-rusak-trans');
    }

    public function createRusakRusak()
    {
        return view('pages.stock.mutasi.rusak-rusak-trans');
    }


    public function editBaikBaik($id)
    {
        return view('pages.stock.mutasi.baik-baik-trans', [
            'id'=>$id
        ]);
    }

    public function editBaikRusak($id)
    {
        return view('pages.stock.mutasi.baik-rusak-trans', [
            'id'=>$id
        ]);
    }

    public function editRusakRusak($id)
    {
        return view('pages.stock.mutasi.rusak-rusak-trans', [
            'id'=>$id
        ]);
    }

}
