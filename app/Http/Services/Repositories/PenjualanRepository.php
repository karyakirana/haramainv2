<?php

namespace App\Services\Repositories;

use App\Models\Penjualan\Penjualan;
use App\Models\Stock\StockKeluar;
use Illuminate\Support\Facades\Auth;

class PenjualanRepository
{
    public $stockInventoryRepo;

    public function __construct()
    {
        $this->stockInventoryRepo = new StockInventoryRepo();
    }

    // kode penjualan
    public function kode() :string
    {
        // query
        $query = Penjualan::query()
            ->where('active_cash', session('ClosedCash'))
            ->latest('kode');

        // check last num
        if ($query->doesntExist()){
            return '0001/PJ/'.date('Y');
        }

        $num = $query->first()->last_num;
        return sprintf("%04s", $num)."/PJ/".date('Y');
    }

    // store penjualan
    public function store($data)
    {
        // store penjualan
        // return value attributes penjualan
        $penjualan = Penjualan::query()
            ->create([
                'kode'=>$this->kode(),
                'active_cash'=>session('ClosedCash'),
                'customer_id'=>$data->customer_id,
                'gudang_id'=>$data->gudang_id,
                'user_id'=>Auth::id(),
                'tgl_nota'=>$data->tgl_nota,
                'tgl_tempo'=>$data->tgl_tempo ?? null,
                'jenis_bayar'=>$data->jenis_bayar,
                'status_bayar'=>'belum',
                'total_barang'=>$data->total_barang,
                'ppn'=>$data->ppn,
                'biaya_lain'=>$data->biaya_lain,
                'total_bayar'=>$data->total_bayar,
                'keterangan'=>$data->keterangan,
            ]);

        // store stock keluar
        $stockKeluar = $penjualan->stockKeluar->create([
            'kode'=>(new StockKeluarRepository())->kode('baik'),
            'active_cash'=>session('ClosedCash'),
            'kondisi'=>'baik',
            'gudang_id'=>$data->gudang_id,
            'tgl_keluar'=>$data->tgl_nota,
            'user_id'=>Auth::id(),
        ]);

        foreach ($data->detail as $row)
        {
            // insert penjualan detail
            $penjualan->penjualanDetail->create([
                'produk_id'=>$row->produk_id,
                'harga'=>$row->harga,
                'jumlah'=>$row->jumlah,
                'diskon'=>$row->diskon,
                'sub_total'=>$row->sub_total,
            ]);
            // insert stock keluar detail
            $stockKeluar->stockKeluarDetail->create([
                'produk_id'=>$row->produk_id,
                'jumlah'=>$row->jumlah,
            ]);
            // update or create stock inventory
            $this->stockInventoryRepo->updateOrCreateStockInventory($row, 'stock_masuk');
        }

    }

    // rollback penjualan
    // edit penjualan
    // update penjualan
    // update print penjualan
    // update status penjualan (disable edit penjualan)
    // print penjualan (query)
    // delete penjualan (urgensi)
}
