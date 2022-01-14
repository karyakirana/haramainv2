<?php

namespace App\Services\Repositories;

use App\Models\Stock\StockInventory;
use Illuminate\Support\Facades\DB;

class StockInventoryRepo
{
    public function daftarStockInventory($jenis, $gudang = null)
    {
        $data = StockInventory::query()
            ->where('active_cash', session('ClosedCash'))
            ->where('jenis', $jenis);

        if ($gudang)
        {
            return $data->where('gudang', $gudang)
                ->latest('produk_id')
                ->get();
        }

        return $data->latest('produk_id')->get();
    }

    public function updateOrCreateStockInventory($data, $field)
    {
        // check by active_cash, produk_id, jenis, gudang
        $query = StockInventory::query()
            ->where('active_cash', session('ClosedCash'))
            ->where('jenis', $data->jenis)
            ->where('gudang_id', $data->gudang);

        if ($query->get()->count() > 0)
        {
            return StockInventory::create([
                'produk_id'=>$data->produk_id,
                $field=>$data->jumlah,
            ]);
        }

        return $query->update([
            'produk_id'=>$data->produk_id,
            $field=>DB::raw($field.' +'.$data->jumlah)
        ]);
    }

    public function rollback($data, $field)
    {
        return StockInventory::query()
            ->where('active_cash', session('ClosedCash'))
            ->where('jenis', $data->jenis)
            ->where('gudang_id', $data->gudang)
            ->update([
                'produk_id'=>$data->produk_id,
                $field=>DB::raw($field.' +'.$data->jumlah)
            ]);
    }
}
