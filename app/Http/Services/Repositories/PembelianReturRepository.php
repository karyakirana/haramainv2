<?php

namespace App\Http\Services\Repositories;

use App\Models\Kasir\Pembelian;
use App\Models\Kasir\ReturPembelian;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\This;

class PembelianReturRepository
{

    public $stockInventoryRepo;

    public function __construct()
    {
        $this->stockInventoryRepo = new StockInventoryRepo();
    }
    protected static function kode()
    {
        // query
        $query = ReturPembelian::query()
            ->where('active_cash', session('ClosedCash'))
            ->latest('kode');

        // check last num
        if ($query->doesntExist()){
            return '0001/RP/'.date('Y');
        }

        $num = (int)$query->first()->last_num + 1 ;
        return sprintf("%04s", $num)."/RP/".date('Y');
    }

    public function store($data)
    {
        // store retur
        // return value attributes retur
        $retur = ReturPembelian::query()
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

        // store stock keluar
        $stockKeluar = $retur->stockKeluar()->create([
            'kode'=>(new StockKeluarRepository())->kode('baik'),
            'active_cash'=>session('ClosedCash'),
            'kondisi'=>'baik',
            'gudang_id'=>$data->gudang_id,
            'tgl_keluar'=>$data->tgl_nota,
            'user_id'=>Auth::id(),
        ]);

        $this->storeDetail($data, $retur, $stockKeluar);
        return $retur->id;
    }
    public function update($data)
    {
        $retur = ReturPembelian::query()
            ->with(['stockKeluar.stockKeluarDetail'])
            ->find($data->id_retur);

        // rollback inventory
        foreach ($retur->returPembelianDetail as $row)
        {
            $this->stockInventoryRepo->rollback($row, 'baik', $retur->gudang_id, 'stock_keluar');
        }

        // delete retur detail
        $retur->returPembelianDetail()->delete();

        // delete stock keluar detail
        $stockKeluar = $retur->stockKeluar->stockKeluarDetail()->delete();

        // update retur
        $retur->update([
            'customer_id'=>$data->customer_id,
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

        // update stock keluar
        $stockKeluar = $retur->stockKeluar()->update([
            'kondisi'=>'baik',
            'gudang_id'=>$data->gudang_id,
            'tgl_keluar'=>tanggalan_database_format($data->tgl_nota, 'd-M-Y'),
            'user_id'=>Auth::id(),
        ]);

        $stockKeluar = $retur->stockKeluar()->first();
        $this->storeDetail($data, $retur, $stockKeluar);
        return $retur->id;
    }

    /**
     * @param $data
     * @param $retur
     * @param $stockKeluar
     */
    protected function storeDetail($data, $retur, $stockKeluar): void
    {
        foreach ($data->detail as $row) {
            // insert retur detail
            $retur->returPembelianDetail()->create([
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

    public function getBy($param, $search, $paginate)
    {
        return ReturPembelian::query()
            ->where($param->column, $param->condition)
            ->where('active_cash', session('ClosedCash'))
            ->latest('kode')
            ->paginate($paginate);
    }

    public function destroy($id)
    {
        $retur = ReturPembelian::query()->find($id);

        // get stock keluar
        $stockKeluar = $retur->stockKeluar;

        // rollback inventory
        foreach ($retur->returPembelianDetail as $row)
        {
            $this->stockInventoryRepo->rollback($row, 'baik', $retur->gudang_id, 'stock_keluar');
        }

        // delete stockkeluar detail
        $stockKeluar->stockKeluarDetail()->delete();

        // delete stock_keluar
        $stockKeluar->delete();

        // delete retur_detail
        $retur->returPembelianDetail()->delete();

        // delete retur
        $retur->delete();
    }


//    public static function storeDetail($data, $returPembelian, $dataDetail)
//    {
//        return $returPembelian->returPembelianDetail()->create([
//            'produk_id'=>$dataDetail->produk_id,
//            'harga'=>$dataDetail->harga,
//            'jumlah'=>$dataDetail->jumlah,
//            'diskon'=>$dataDetail->diskon,
//            'sub_total'=>$dataDetail->sub_total,
//        ]);
//    }
//
//    public static function stockMasuk($returPembelian, $data)
//    {
//        return $returnPembelian->stockKeluar()->create([
//            'kode',
//            'supplier_id',
//            'active_cash',
//            'stockable_keluar_id',
//            'stockable_keluar_type',
//            'kondisi',
//            'gudang_id',
//            'tgl_keluar',
//            'user_id',
//            'keterangan',
//        ]);
//    }

}
