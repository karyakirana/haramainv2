<?php

namespace App\Http\Controllers\Keuangan;

use App\Http\Controllers\Controller;
use App\Models\Keuangan\JurnalPenerimaanPenjualan;
use Illuminate\Http\Request;

class JurnalPenerimaanController extends Controller
{
    //index
    public function index()
    {
        // daftar pemasukan bayar
        return view('pages.Keuangan.jurnal-penerimaan-index');
    }

    public function datatablesPenerimaan()
    {
        $data = JurnalPenerimaanPenjualan::query()
            ->where('active_cash', $this->getSessionForApi())
            ->oldest('kode')
            ->get();
        return $this->datatablesAll($data);
    }

    public function create($id = null)
    {
        // transaksi jurnal penerimaan
        return view('pages.Keuangan.jurnal-penerimaan-trans', ['id'=>$id]);
    }

    public function createCash()
    {
        // transaksi penjualan cash
    }

    public function createTempo()
    {
        // transaksi penjualan dari piutang tempo
    }

    public function editCash($id)
    {
        // edit transaksi penjualan cash
    }

    public function editTempo($id)
    {
        // edit transaksi penjualan dari piutang tempo
    }
}
