<?php

namespace App\Http\Controllers\Penjualan;

use App\Http\Controllers\Controller;
use App\Models\Penjualan\Penjualan;
use App\Models\Penjualan\PenjualanDetail;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    public function index()
    {
        // daftar / list penjualan view
        return view('pages.penjualan.penjualan-index');
    }

    public function datatables()
    {
        // json datatables
        $data = Penjualan::query()
            ->with(['customer', 'gudang', 'users'])
            ->where('active_cash', $this->getSessionForApi())
            ->latest('kode')
            ->get();
        return $this->datatablesAll($data);
    }

    public function datatablesPenjualan()
    {
        $data = Penjualan::query()
            ->with(['customer', 'gudang', 'users'])
            ->where('active_cash', $this->getSessionForApi())
            ->latest('kode')
            ->get();
        return $this->datatablesForSet($data, 'setPenjualan');
    }

    public function create()
    {
        // transaksi penjualan view
        return view('pages.penjualan.penjualan-transaksi');
    }

    public function edit($id)
    {
        // edit transaksi penjualan
        // load data edit
        return view('pages.penjualan.penjualan-transaksi',[
            'id'=>$id
        ]);
    }

    public function update(Request $request)
    {
        // update transaksi penjualan
    }

    public function print(Penjualan $penjualan)
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

    public function detail()
    {
        return view('livewire.detail.penjualan-detail-view');
    }
}
