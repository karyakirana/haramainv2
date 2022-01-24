<?php

namespace App\Http\Controllers\Penjualan;

use App\Http\Controllers\Controller;
use App\Models\Penjualan\PenjualanRetur;
use Illuminate\Http\Request;

class ReturBaikController extends Controller
{
    public function index()
    {
        // view daftar retur baik
        return view('pages.penjualan.retur-baik-index');
    }

    public function datatables()
    {
        // return datatables
        $data = PenjualanRetur::query()
            ->with(['customer', 'gudang'])
//            ->where('active_cash', session('ClosedCash'))
            ->latest('kode')
            ->get();
        return $this->datatablesAll($data);
    }

    public function create()
    {
        // create new transaksi retur (view)
        return view('pages.penjualan.retur-baik-transaksi');
    }

    public function store(Request $request)
    {
        // store new data
    }

    public function edit($id)
    {
        // edit transaksi data (view)
    }

    public function update(Request $request)
    {
        // update data
    }

    public function print(PenjualanRetur $penjualan)
    {
        $penjualan = $penjualan->with(['customer', 'penjualanDetail'])->first();
        $dataPenjualan = [
            'penjualanId' => $penjualan->kode,
            'namaCustomer' => $penjualan->customer->nama,
            'addr_cust' => $penjualan->customer->alamat,
            'tgl_nota' => tanggalan_format($penjualan->tgl_nota),
            'tgl_tempo' => ( strtotime($penjualan->tgl_tempo) > 0) ? tanggalan_format($penjualan->tgl_tempo) : '',
            'status_bayar' => $penjualan->jenis_bayar,
            'sudahBayar' => $penjualan->status_bayar,
            'total_jumlah' => $penjualan->total_jumlah,
            'ppn' => $penjualan->ppn,
            'biaya_lain' => $penjualan->biaya_lain,
            'total_bayar' => $penjualan->total_bayar,
            'penket' => $penjualan->keterangan,
            'print' => $penjualan->print,
        ];
        // update print
        $updatePrint = $penjualan->update(['print' => $penjualan->print + 1]);
        $dataPenjualanDetail = $penjualan->penjualanDetail();

        return view('pages.print.sales-receipt', [
            'dataUtama' => json_encode($dataPenjualan),
            'dataDetail' => $dataPenjualanDetail->with('produk')->get()
        ]);
    }
}
