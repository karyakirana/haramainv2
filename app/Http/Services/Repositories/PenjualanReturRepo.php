<?php

namespace App\Http\Services\Repositories;

use App\Models\Penjualan\PenjualanRetur;
use Illuminate\Support\Facades\Auth;

class PenjualanReturRepo
{
    public $stockInventoryRepo;

    public function __construct()
    {
        $this->stockInventoryRepo = new StockInventoryRepo();
    }

    // kode penjualan
    public function kode($kondisi) :string
    {
        // query
        $query = PenjualanRetur::query()
            ->where('active_cash', session('ClosedCash'))
            ->where('jenis_retur', $kondisi)
            ->latest('kode');

        $kode = ($kondisi == 'baik') ? 'RB' : 'RR';

        // check last num
        if ($query->doesntExist()){
            return "0001/{$kode}/".date('Y');
        }

        $num = (int)$query->first()->last_num + 1 ;
        return sprintf("%04s", $num)."/{$kode}/".date('Y');
    }

    // store penjualan
    public function store($data)
    {
        // store Retur
        // return value attributes penjualan
        $retur = PenjualanRetur::query()
            ->create([
                'kode'=>$this->kode($data->jenis_retur),
                'active_cash'=>session('ClosedCash'),
                'jenis_retur'=>$data->jenis_retur,
                'customer_id'=>$data->customer_id,
                'gudang_id'=>$data->gudang_id,
                'user_id'=>Auth::id(),
                'tgl_nota'=>$data->tgl_nota,
                'status_bayar'=>'belum',
                'total_barang'=>$data->total_barang,
                'ppn'=>$data->ppn,
                'biaya_lain'=>$data->biaya_lain,
                'total_bayar'=>$data->total_bayar,
                'keterangan'=>$data->keterangan,
            ]);

        // store stock masuk
        $stockMasuk = $retur->stockMasuk()->create([
            'kode'=>(new StockKeluarRepository())->kode('baik'),
            'active_cash'=>session('ClosedCash'),
            'kondisi'=>'baik',
            'gudang_id'=>$data->gudang_id,
            'tgl_masuk'=>$data->tgl_nota,
            'user_id'=>Auth::id(),
        ]);

        $this->storeDetail($data, $retur, $data->jenis_retur, $stockMasuk);
        return $retur->id;
    }

    // rollback penjualan
    // edit penjualan
    // update penjualan
    public function update($data)
    {
        $retur = PenjualanRetur::query()
            ->with(['stockMasuk.stockMasukDetail'])
            ->find($data->id_retur);

        dd($retur->stockMasuk());

        // rollback inventory
        foreach ($retur->returDetail as $row)
        {
            $this->stockInventoryRepo->rollback($row, $data->jenis_retur, $retur->gudang_id, 'stock_masuk');
        }

        // delete penjualan detail
        $retur->returDetail()->delete();

        // delete stock keluar detail
        $stockMasuk = $retur->stockMasuk->stockMasukDetail()->delete();

        // update penjualan
        $retur->update([
            'customer_id'=>$data->customer_id,
            'gudang_id'=>$data->gudang_id,
            'user_id'=>Auth::id(),
            'tgl_nota'=>$data->tgl_nota,
            'status_bayar'=>'belum',
            'total_barang'=>$data->total_barang,
            'ppn'=>$data->ppn,
            'biaya_lain'=>$data->biaya_lain,
            'total_bayar'=>$data->total_bayar,
            'keterangan'=>$data->keterangan,
        ]);

        // update stock masuk
        $stockMasuk = $retur->stockMasuk()->update([
            'gudang_id'=>$data->gudang_id,
            'tgl_masuk'=>tanggalan_database_format($data->tgl_nota, 'd-M-Y'),
            'user_id'=>Auth::id(),
        ]);

        $stockMasuk = $retur->stockMasuk()->first();
        $this->storeDetail($data, $retur, $data->jenis_retur, $stockMasuk);
        return $data->id_retur;
    }

    /**
     * @param $data
     * @param $retur
     * @param $jenisRetur
     * @param $stockMasuk
     */
    protected function storeDetail($data, $retur, $jenisRetur, $stockMasuk): void
    {
        foreach ($data->detail as $row) {
            // insert penjualan detail
            $retur->returDetail()->create([
                'produk_id' => $row['produk_id'],
                'harga' => $row['harga'],
                'jumlah' => $row['jumlah'],
                'diskon' => $row['diskon'],
                'sub_total' => $row['sub_total'],
            ]);
            // insert stock keluar detail
            $stockMasuk->stockMasukDetail()->create([
                'produk_id' => $row['produk_id'],
                'jumlah' => $row['jumlah'],
            ]);
            // update or create stock inventory
            $this->stockInventoryRepo->updateOrCreateStockInventory($row, $jenisRetur, $data->gudang_id, 'stock_masuk');
        }
    }
}
