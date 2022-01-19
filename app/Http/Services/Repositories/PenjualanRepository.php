<?php

namespace App\Http\Services\Repositories;

use App\Models\Penjualan\Penjualan;
use App\Http\Services\Repositories\StockKeluarRepository;
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

        $num = (int)$query->first()->last_num + 1 ;
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
                'tgl_tempo'=> ($data->jenis_bayar == 'tempo') ?  $data->tgl_tempo : null,
                'jenis_bayar'=>$data->jenis_bayar,
                'status_bayar'=>'belum',
                'total_barang'=>$data->total_barang,
                'ppn'=>$data->ppn,
                'biaya_lain'=>$data->biaya_lain,
                'total_bayar'=>$data->total_bayar,
                'keterangan'=>$data->keterangan,
            ]);

        // store stock keluar
        $stockKeluar = $penjualan->stockKeluar()->create([
            'kode'=>(new StockKeluarRepository())->kode('baik'),
            'active_cash'=>session('ClosedCash'),
            'kondisi'=>'baik',
            'gudang_id'=>$data->gudang_id,
            'tgl_keluar'=>$data->tgl_nota,
            'user_id'=>Auth::id(),
        ]);

        $this->storeDetail($data, $penjualan, $stockKeluar);

    }

    // rollback penjualan
    // edit penjualan
    // update penjualan
    public function update($data)
    {
        $penjualan = Penjualan::query()
            ->with(['stockKeluar.stockKeluarDetail'])
            ->find($data->id_penjualan);

        // rollback inventory
        foreach ($penjualan->penjualanDetail as $row)
        {
            $this->stockInventoryRepo->rollback($row, 'baik', $penjualan->gudang_id, 'stock_keluar');
        }

        // delete penjualan detail
        $penjualan->penjualanDetail()->delete();

        // delete stock keluar detail
        $stockKeluar = $penjualan->stockKeluar()->first()->stockKeluarDetail()->delete();

        // update penjualan
        $penjualan->update([
            'customer_id'=>$data->customer_id,
            'gudang_id'=>$data->gudang_id,
            'user_id'=>Auth::id(),
            'tgl_nota'=>$data->tgl_nota,
            'tgl_tempo'=>($data->jenis_bayar == 'tempo') ?  $data->tgl_tempo : null,
            'jenis_bayar'=>$data->jenis_bayar,
            'status_bayar'=>'belum',
            'total_barang'=>$data->total_barang,
            'ppn'=>$data->ppn,
            'biaya_lain'=>$data->biaya_lain,
            'total_bayar'=>$data->total_bayar,
            'keterangan'=>$data->keterangan,
        ]);

        // update stock keluar
        $stockKeluar = $penjualan->stockKeluar()->update([
            'kondisi'=>'baik',
            'gudang_id'=>$data->gudang_id,
            'tgl_keluar'=>tanggalan_database_format($data->tgl_nota, 'd-M-Y'),
            'user_id'=>Auth::id(),
        ]);

        $stockKeluar = $penjualan->stockKeluar()->first();
        $this->storeDetail($data, $penjualan, $stockKeluar);
    }

    /**
     * @param $data
     * @param $penjualan
     * @param $stockKeluar
     */
    protected function storeDetail($data, $penjualan, $stockKeluar): void
    {
        foreach ($data->detail as $row) {
            // insert penjualan detail
            $penjualan->penjualanDetail()->create([
                'produk_id' => $row['produk_id'],
                'harga' => $row['harga'],
                'jumlah' => $row['jumlah'],
                'diskon' => $row['diskon'],
                'sub_total' => $row['sub_total'],
            ]);
            // insert stock keluar detail
            $stockKeluar->stockKeluarDetail()->create([
                'produk_id' => $row['produk_id'],
                'jumlah' => $row['jumlah'],
            ]);
            // update or create stock inventory
            $this->stockInventoryRepo->updateOrCreateStockInventory($row, 'baik', $data->gudang_id, 'stock_keluar');
        }
    }
    // update print penjualan
    // update status penjualan (disable edit penjualan)
    // print penjualan (query)
    // delete penjualan (urgensi)
}
