<?php

namespace App\Http\Services\Repositories;

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

    protected function fieldStockOpname($query)
    {
        //
    }

    public function updateOrCreateStockInventory($data, $jenis, $gudang, $field)
    {
        // check by active_cash, produk_id, jenis, gudang
        $query = StockInventory::query()
            ->where('active_cash', session('ClosedCash'))
            ->where('jenis', $jenis)
            ->where('gudang_id', $gudang);

        if ($query->get()->count() > 0)
        {
            return $query->update([
                'produk_id'=>$data['produk_id'],
                $field=>DB::raw($field.' +'.$data['jumlah'])
            ]);

        }

        return StockInventory::create([
            'active_cash'=>session('ClosedCash'),
            'jenis'=>$jenis,
            'gudang_id'=>$gudang,
            'produk_id'=>$data['produk_id'],
            $field=>$data['jumlah'],
        ]);
    }

    public function rollback($data, $jenis, $gudang, $field)
    {
        return StockInventory::query()
            ->where('active_cash', session('ClosedCash'))
            ->where('jenis', $jenis)
            ->where('gudang_id', $gudang)
            ->update([
                'produk_id'=>$data->produk_id,
                $field=>DB::raw($field.' -'.$data->jumlah)
            ]);
    }
}
