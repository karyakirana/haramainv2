<?php

namespace App\Http\Services\Repositories;

use App\Models\Kasir\Pembelian;
use App\Http\Services\Repositories\StockMasukRepository;
use App\Models\Stock\StockMasuk;
use Illuminate\Support\Facades\Auth;

class KasirPembelianRepository
{
    public $stockInventoryRepo;

    public function __construct()
    {
        $this->stockInventoryRepo = new StockInventoryRepo();
    }


    // kode pembelian
    public function kode(): string
    {
        // query
        $query = Pembelian::query()
            ->where('active_cash', session('ClosedCash'))
            ->latest('kode');

        // check last num
        if ($query->doesntExist()) {
            return '0001/PB/' . date('Y');
        }

        $num = (int)$query->first()->last_num + 1;
        return sprintf("%04s", $num) . "/PB/" . date('Y');
    }

    //store pembelian
    public function store($data)
    {
        //store pembelian
        // return value pembelian
        $pembelian = Pembelian::query()
            ->create([
                'kode'=>$this->kode(),
                'active_cash'=>session('ClosedCash'),
                'supplier_id'=>$data->supplier_id,
                'gudang_id'=>$data->gudang_id,
                'user_id'=>Auth::id(),
                'tgl_nota'=>$data->tgl_nota,
                'tgl_tempo'=> ($data->jenis_bayar == 'tempo') ?  tanggalan_database_format($data->tgl_tempo, 'd-M-Y') : null,
                'jenis_bayar'=>$data->jenis_bayar,
                'status_bayar'=>'belum',
                'total_barang'=>$data->total_barang,
                'ppn'=>$data->ppn,
                'biaya_lain'=>$data->biaya_lain,
                'total_bayar'=>$data->total_bayar,
                'keterangan'=>$data->keterangan,
            ]);
        // store stock masuk
        $stockMasuk = $pembelian->stockMasuk()->create([
            'kode'=>(new stockMasukRepository())->kode('baik'),
            'active_cash'=>session('ClosedCash'),
            'kondisi'=>'baik',
            'gudang_id'=>$data->gudang_id,
            'tgl_masuk'=>$data->tgl_nota,
            'user_id'=>Auth::id(),
        ]);

        $this->storeDetail($data, $pembelian, $stockMasuk);
        return $pembelian->id;

    }

    // rollback pembelian
    // edit update pembelian
    public function update($data)
    {
        $pembelian = Pembelian::query()
            ->with(['stockMasuk.StockMasukDetail'])
            ->find($data->id_pembelian);

        //rollback inven
        foreach ($pembelian->pembelianDetail as $row)
        {
            $this->stockInventoryRepo->rollback($row, 'baik', $pembelian->gudang_id, 'stock_masuk');
        }

        //delete pembelian detail
        $pembelian->pembelianDetail()->delete();

        // delete stock masuk detail
        $stockMasuk = $pembelian->stockMasuk->stockMasukDetail()->delete();

        // update pembelian
        $pembelian->update([
            'supplier_id'=>$data->supplier_id,
            'gudang_id'=>$data->gudang_id,
            'user_id'=>Auth::id(),
            'tgl_nota'=>$data->tgl_nota,
            'tgl_tempo'=>$data->tgl_tempo,
            'jenis_bayar'=>$data->jenis_bayar,
            'status_bayar'=>'belum',
            'total_barang'=>$data->total_barang,
            'ppn'=>$data->ppn,
            'biaya_lain'=>$data->biaya_lain,
            'total_bayar'=>$data->total_bayar,
            'keterangan'=>$data->keterangan,
        ]);

        //update stock masuk
        $stockMasuk = $pembelian->stockMasuk()->update([
            'kondisi'=>'baik',
            'gudang_id'=>$data->gudang_id,
            'tgl_masuk'=>tanggalan_database_format($data->tgl_nota, 'd-M-Y'),
            'user_id'=>Auth::id(),
        ]);

        $stockMasuk = $pembelian->stockMasuk()->first();
        $this->storeDetail($data, $pembelian, $stockMasuk);
        return $pembelian->id;
    }

    /**
     * @param $data
     * @param $pembelian
     * @param $stockMasuk
     */
    protected function storeDetail($data, $pembelian, $stockMasuk): void
    {
        foreach ($data->detail as $row) {
            // insert pembelian detail
            $pembelian->pembelianDetail()->create([
                'produk_id' => $row['produk_id'],
                'harga' => $row['harga'],
                'jumlah' => $row['jumlah'],
                'diskon' => $row['diskon'],
                'sub_total' => $row['sub_total'],
            ]);
            // insert stock masuk detail
            $stockMasuk->stockMasukDetail()->create([
                'produk_id' => $row['produk_id'],
                'jumlah' => $row['jumlah'],
            ]);
            // update or create stock inventory
            $this->stockInventoryRepo->updateOrCreateStockInventory($row, 'baik', $data->gudang_id, 'stock_masuk');
        }
    }

    public function getBy($param, $search, $paginate)
    {
        return Pembelian::query()
            ->where($param->column, $param->condition)
            ->where('active_cash', session('ClosedCash'))
            ->latest('kode')
            ->paginate($paginate);
    }

    public function destroy($id)
    {
        $pembelian = Pembelian::query()->find($id);

        //get stock masuk
        $stockMasuk = $pembelian->stockMasuk;

        //rollback inven
        foreach ($pembelian->pembelianDetail as $row)
        {
            $this->stockInventoryRepo->rollback($row, 'baik', $pembelian->gudang_id, 'stock_masuk');
        }

        // delete stockmasuk detail
        $stockMasuk->stockMasukDetail()->delete();

        // delete stock masuk
        $stockMasuk->delete();

        // delete pembelian detail
        $pembelian->pembelianDetail()->delete();

        // delete pembelian
        $pembelian->delete();
    }

}
