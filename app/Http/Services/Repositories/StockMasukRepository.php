<?php

namespace App\Http\Services\Repositories;

use App\Http\Services\Repositories\StockInventoryRepo;
use App\Models\Stock\StockMasuk;
use Illuminate\Support\Facades\Auth;

class StockMasukRepository
{
    public $stockInventoryRepo;


    public function __construct()
    {
        $this->stockInventoryRepo = new StockInventoryRepo();
    }
    // kode stock masuk (rusak atau baik)
    public function kode($kondisi) :string
    {
        // query
        $query = StockMasuk::query()
            ->where('active_cash', session('ClosedCash'))
            ->where('kondisi', $kondisi)
            ->latest('kode');

        $kode = ($kondisi == 'baik') ? 'SM' : 'SMR';

        // check last num
        if ($query->doesntExist()){
            return "0001/{$kode}/".date('Y');
        }

        $num = (int)$query->first()->last_num + 1 ;
        return sprintf("%04s", $num)."/{$kode}/".date('Y');
    }
    // insert stock masuk
    public function store($data)
    {
        // store stock masuk
        // return value attributes stock masuk
        $stockMasuk = StockMasuk::query()
            ->create([
                'kode'=>$this->kode($data->kondisi),
                'active_cash'=>session('ClosedCash'),
                'stockable_masuk_id'=>$data->stockable_masuk_id ?? null,
                'stockable_masuk_type'=>$data->stockable_masuk_type ?? null,
                'kondisi'=>$data->kondisi,
                'gudang_id'=>$data->gudang_id,
                'user_id'=>Auth::id(),
                'tgl_masuk'=>$data->tgl_masuk,
                'nomor_po'=>$data->nomor_po ?? null,
                'keterangan'=>$data->keterangan,
            ]);

        foreach ($data->detail as $row)
        {
            // insert penjualan detail
            $stockMasuk->stockMasukDetail()->create([
                'produk_id'=>$row['produk_id'],
                'jumlah'=>$row['jumlah'],
            ]);
            // update or create stock inventory
            $this->stockInventoryRepo->updateOrCreateStockInventory($row, 'baik', $data->gudang_id,'stock_masuk');
        }

    }

    // update stock masuk
    public function update($data)
    {
        $stockMasuk = StockMasuk::query()->find($data->id_stock_masuk);
        $stockMasuk->update([
            'stockable_masuk_id'=>$data->stockable_masuk_id ?? null,
            'stockable_masuk_type'=>$data->stockable_masuk_type ?? null,
            'gudang_id'=>$data->gudang_id,
            'user_id'=>Auth::id(),
            'tgl_masuk'=>$data->tgl_masuk,
            'nomor_po'=>$data->nomor_po ?? null,
            'keterangan'=>$data->keterangan,
        ]);

        foreach ($stockMasuk->stockMasukDetail as $row)
        {
            // rollback
            $this->stockInventoryRepo->rollback($row, $data->kondisi, $data->gudang_id, 'stock_masuk');
        }

        $stockMasuk->stockMasukDetail()->delete();

        foreach ($data->detail as $row)
        {
            $stockMasuk->stockMasukDetail()->create([
                'produk_id'=>$row['produk_id'],
                'jumlah'=>$row['jumlah'],
            ]);

            $this->stockInventoryRepo->updateOrCreateStockInventory($row, $data->kondisi, $data->gudang_id, 'stock_masuk');
        }


    }
    // delete stock masuk (urgensi)
}
