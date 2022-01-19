<?php

namespace App\Http\Services\Repositories;

use App\Models\Stock\StockMutasi;
use Illuminate\Support\Facades\Auth;

class StockMutasiRepo
{
    public $stockInventoryRepo;

    public function __construct()
    {
        $this->stockInventoryRepo = new StockInventoryRepo();
    }

    public function kode($jenis)
    {
        // query
        $query = StockMutasi::query()
            ->where('active_cash', session('ClosedCash'))
            ->where('jenis_mutasi', $jenis)
            ->latest('kode');

        $kode = ($jenis == 'baik') ? 'SMB' : 'SMR';

        // check last num
        if ($query->doesntExist()){
            return "0001/{$kode}/".date('Y');
        }

        $num = (int)$query->first()->last_num + 1 ;
        return sprintf("%04s", $num)."/{$kode}/".date('Y');
    }

    public function store($data)
    {
        $mutasi = StockMutasi::query()
            ->create([
                'active_cash'=>session('ClosedCash'),
                'kode'=>$this->kode($data->jenis_mutasi),
                'jenis_mutasi'=>$data->jenis_mutasi,
                'gudang_asal_id'=>$data->gudang_asal_id,
                'gudang_tujuan_id'=>$data->gudang_tujuan_id,
                'tgl_mutasi'=>$data->tgl_mutasi,
                'user_id'=>\Auth::id(),
                'keterangan'=>$data->keterangan,
            ]);

        // create stock masuk
        $stockMasuk = $mutasi->stockMasuk()->create([
            'kode'=>(new StockMasukRepository())->kode($data->jenis_mutasi),
            'active_cash'=>session('ClosedCash'),
            'kondisi'=>$data->jenis_mutasi,
            'gudang_id'=>$data->gudang_tujuan_id,
            'tgl_masuk'=>$data->tgl_mutasi,
            'user_id'=>Auth::id(),
            'nomor_po'=>null,
            'keterangan'=>$data->keterangan,
        ]);

        $stockKeluar = $mutasi->stockKeluar()->create([
            'kode'=>(new StockKeluarRepository())->kode($data->jenis_mutasi),
            'supplier_id'=>null,
            'active_cash'=>session('ClosedCash'),
            'kondisi'=>$data->jenis_mutasi,
            'gudang_id'=>$data->gudang_asal_id,
            'tgl_keluar'=>$data->tgl_mutasi,
            'user_id'=>Auth::id(),
            'keterangan'=>$data->keterangan,
        ]);

        $this->storeDetail($data, $mutasi, $stockMasuk, $stockKeluar);
    }

    public function update($data)
    {
        $mutasi = StockMutasi::query()->find($data->id_stock_mutasi);

        // rollback
        foreach ($mutasi->stockMutasiDetail as $row)
        {
            $this->stockInventoryRepo->rollback($row, $data->jenis_mutasi, $mutasi->gudang_asal_id, 'stock_keluar');
            $this->stockInventoryRepo->rollback($row, $data->jenis_mutasi, $mutasi->gudang_tujuan_id, 'stock_masuk');
        }

        // update stock mutasi
        $mutasi->update([
            'gudang_asal_id'=>$data->gudang_asal_id,
            'gudang_tujuan_id'=>$data->gudang_tujuan_id,
            'tgl_mutasi'=>$data->tgl_mutasi,
            'user_id'=>\Auth::id(),
            'keterangan'=>$data->keterangan,
        ]);

        $stockKeluar = $mutasi->stockKeluar();
        $stockMasuk = $mutasi->stockMasuk();

        // delete detail mutasi
        $mutasi->stockMutasiDetail()->delete();
        $stockKeluar->first()->stockKeluarDetail()->delete();
        $stockMasuk->first()->stockMasukDetail()->delete();

        // update stock keluar
        $stockKeluar = $stockKeluar->update([
            'kondisi'=>$data->jenis_mutasi,
            'gudang_id'=>$data->gudang_asal_id,
            'tgl_keluar'=>tanggalan_database_format($data->tgl_mutasi, 'd-M-Y'),
            'user_id'=>Auth::id(),
            'keterangan'=>$data->keterangan,
        ]);

        // update stock masuk
        $stockMasuk = $stockMasuk->update([
            'gudang_id'=>$data->gudang_tujuan_id,
            'tgl_masuk'=>tanggalan_database_format($data->tgl_mutasi, 'd-M-Y'),
            'user_id'=>Auth::id(),
            'nomor_po'=>null,
            'keterangan'=>$data->keterangan,
        ]);

        $this->storeDetail($data, $mutasi, $stockMasuk, $stockKeluar);
    }

    /**
     * @param $data
     * @param $mutasi
     * @param $stockMasuk
     * @param $stockKeluar
     */
    protected function storeDetail($data, $mutasi, $stockMasuk, $stockKeluar): void
    {
        foreach ($data->detail as $row) {
            // mutasi detail
            $mutasi->stockMutasiDetail()->create([
                'produk_id' => $row['produk_id'],
                'jumlah' => $row['jumlah'],
            ]);
            // stock masuk detail
            $stockMasuk->stockMasukDetail()->create([
                'produk_id' => $row['produk_id'],
                'jumlah' => $row['jumlah'],
            ]);
            // stock keluar detail
            $stockKeluar->stockKeluarDetail()->create([
                'produk_id' => $row['produk_id'],
                'jumlah' => $row['jumlah'],
            ]);

            $this->stockInventoryRepo->updateOrCreateStockInventory($row, $data->jenis_mutasi, $data->gudang_asal_id, 'stock_keluar');
            $this->stockInventoryRepo->updateOrCreateStockInventory($row, $data->jenis_mutasi, $data->gudang_tujuan_id, 'stock_keluar');
        }
    }
}
