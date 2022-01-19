<?php

namespace App\Http\Services\Repositories;

use App\Models\Stock\StockKeluar;
use Illuminate\Support\Facades\Auth;

class StockKeluarRepository
{
    public $stockInventoryRepo;

    public function __construct()
    {
        $this->stockInventoryRepo = new StockInventoryRepo();
    }

    // kode stock keluar (baik atau rusak)
    public function kode($kondisi) :string
    {
        // query
        $query = StockKeluar::query()
            ->where('active_cash', session('ClosedCash'))
            ->where('kondisi', $kondisi)
            ->latest('kode');

        $kodeKondisi = ($kondisi == 'baik') ? 'SK' : 'SKR';

        // check last num
        if ($query->doesntExist()){
            return "0001/{$kodeKondisi}/".date('Y');
        }

        $num = (int) $query->first()->last_num + 1;
        return sprintf("%04s", $num)."/{$kodeKondisi}/".date('Y');
    }
    // insert stock keluar
    public function store($data)
    {
        $stockKeluar = StockKeluar::query()
            ->create([
                'kode'=>$this->kode($data->kondisi),
                'supplier_id'=>$data->supplier_id,
                'active_cash'=>session('ClosedCash'),
                'stockable_keluar_id'=>null,
                'stockable_keluar_type'=>null,
                'kondisi'=>$data->kondisi,
                'gudang_id'=>$data->gudang_id,
                'tgl_keluar'=>$data->tgl_keluar,
                'user_id'=>Auth::id(),
                'keterangan'=>$data->keterangan,
            ]);

        // insert detail
        foreach ($data->detail as $row)
        {
            $stockKeluar->stockKeluarDetail()
                ->create([
                    'produk_id'=>$row['produk_id'],
                    'jumlah'=>$row['jumlah'],
                ]);
            $this->stockInventoryRepo->updateOrCreateStockInventory($row, $data->kondisi, $data->gudang_id,'stock_keluar');
        }
    }
    // rollback stock keluar
    // update stock keluar
    public function update($data)
    {
        $stockKeluar = StockKeluar::query()->find($data->id_stock_keluar);
        $stockKeluar->update([
                'supplier_id'=>$data->supplier_id,
                'stockable_keluar_id'=>null,
                'stockable_keluar_type'=>null,
                'gudang_id'=>$data->gudang_id,
                'tgl_keluar'=>$data->tgl_keluar,
                'user_id'=>Auth::id(),
                'keterangan'=>$data->keterangan,
            ]);

        foreach ($stockKeluar->stockKeluarDetail as $row)
        {
            $this->stockInventoryRepo->rollback($row, $data->kondisi, $data->gudang_id, 'stock_keluar');
        }

        $stockKeluar->stockKeluarDetail()->delete();

        // insert detail
        foreach ($data->detail as $row)
        {
            $stockKeluar->stockKeluarDetail()->create([
                    'produk_id'=>$row['produk_id'],
                    'jumlah'=>$row['jumlah'],
                ]);
            $this->stockInventoryRepo->updateOrCreateStockInventory($row, $data->kondisi, $data->gudang_id,'stock_keluar');
        }
    }
    // delete stock keluar
}
