<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use App\Models\Stock\StockOpname;
use Illuminate\Http\Request;

class StockOpnameController extends Controller
{
    public function index()
    {
        // view stock opname semua
        return view('pages.stock.opname.opname-index');
    }

    public function datatablesIndex()
    {
        // datatables stock opname
        $data = StockOpname::query()
            ->with([ 'gudang', 'users', 'pegawai'])
            ->where('active_cash', $this->getSessionForApi())
            ->latest('kode')
            ->get();
        return $this->datatablesAll($data);
    }

    public function indexBaik()
    {
        // view stock opname baik
        return view('pages.stock.opname.opname-baik-index');
    }

    public function datatablesBaik()
    {
        // datatables stock opname Baik
        $data = StockOpname::query()
            ->with([ 'gudang', 'users', 'pegawai'])
            ->where('active_cash', $this->getSessionForApi())
            ->where('jenis', 'baik')
            ->latest('kode')
            ->get();
        return $this->datatablesAll($data);
    }

    public function indexRusak()
    {
        // view stock opname rusak
        return view('pages.stock.opname.opname-rusak-index');
    }

    public function datatablesRusak()
    {
        // datatables stock opname Rusak
        $data = StockOpname::query()
            ->with([ 'gudang', 'users', 'pegawai'])
            ->where('active_cash', $this->getSessionForApi())
            ->where('jenis', 'rusak')
            ->latest('kode')
            ->get();
        return $this->datatablesAll($data);    }

    public function createBaik()
    {
        // transaksi stock opname baik
        return view('pages.stock.opname.opname-baik-form');
    }

    public function createRusak()
    {
        // transaksi stock opname rusak
        return view('pages.stock.opname.opname-rusak-form');
    }

    public function editBaik($id)
    {
        return view('pages.stock.opname.opname-baik-form', [
            'id'=>$id
        ]);
    }

    public function editRusak($id)
    {
        return view('pages.stock.opname.opname-rusak-form', [
            'id'=>$id
        ]);
    }
}
