<?php

namespace App\Http\Services\Repositories;

use App\Models\Stock\StockOpname;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\Repositories\StockInventoryRepo;


class StockOpnameRepo
{
    public $stockInventoryRepo;

    public function __construct()
    {
        $this->stockInventoryRepo = new StockInventoryRepo();
    }

    public function kode($jenis)
    {
        // query
        $query = StockOpname::query()
            ->where('active_cash', session('ClosedCash'))
            ->where('jenis', $jenis)
            ->latest('kode');

        $kode = ($jenis == 'baik') ? 'SO' : 'SOR';

        // check last num
        if ($query->doesntExist()){
            return "0001/{$kode}/".date('Y');
        }

        $num = (int)$query->first()->last_num + 1 ;
        return sprintf("%04s", $num)."/{$kode}/".date('Y');
    }

    public function store($data) : void
    {
        $stockOpname = StockOpname::query()
            ->create([
                'active_cash'=>session('ClosedCash'),
                'kode'=>$this->kode($data->jenis),
                'jenis'=>$data->jenis,
                'tgl_input'=>$data->tgl_input,
                'gudang_id'=>$data->gudang_id,
                'user_id'=>\Auth::id(),
                'pegawai_id'=>$data->pegawai_id,
                'keterangan'=>$data->keterangan,
            ]);

        foreach ($data->detail as $row)
        {
            $stockOpname->stockOpnameDetail()->create([
                'produk_id'=>$row['produk_id'],
                'jumlah'=>$row['jumlah'],
            ]);

            $this->stockInventoryRepo->updateOrCreateStockInventory($row, $data->jenis, $data->gudang_id, 'stock_opname');
        }
    }

    public function update($data)
    {
        $stockOpname = StockOpname::query()->find($data->id_stock_opname);
        $stockOpname->update([
            'jenis'=>$data->jenis,
            'tgl_input'=>$data->tgl_input,
            'gudang_id'=>$data->gudang_id,
            'user_id'=>Auth::id(),
            'pegawai_id'=>$data->pegawai_id,
            'keterangan'=>$data->keterangan,
        ]);

        foreach ($stockOpname->stockOpnameDetail as $row) {
            $this->stockInventoryRepo->rollback($row, $data->jenis, $data->gudang_id, 'stock_opname');
        }

        $stockOpname->stockOpnameDetail()->delete();

        foreach ($data->detail as $row)
        {
            $stockOpname->stockOpnameDetail()->create([
                'produk_id'=>$row['produk_id'],
                'jumlah'=>$row['jumlah'],
            ]);
        }


    }
}
