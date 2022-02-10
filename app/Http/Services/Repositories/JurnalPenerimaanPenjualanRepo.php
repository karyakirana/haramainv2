<?php

namespace App\Http\Services\Repositories;

use App\Models\Keuangan\JurnalPenerimaanPenjualan;
use App\Models\Penjualan\Penjualan;

class JurnalPenerimaanPenjualanRepo
{
    public function kode()
    {
        // query
        $query = JurnalPenerimaanPenjualan::query()
            ->where('active_cash', session('ClosedCash'))
            ->latest('kode');

        // check last num
        if ($query->doesntExist()){
            return '1/KMP/'.date('Y');
        }

        $num = $query->first()->last_num + 1;
        return $num."/KMP/".date('Y');
    }

    public function store($data)
    {
        $jurnalPenerimaan = JurnalPenerimaanPenjualan::query()->create([
            'kode'=>$this->kode(),
            'active_cash'=>session('ClosedCash'),
            'tgl_penerimaan'=>$data->tgl_penerimaan,
            'customer_id'=>$data->customer_id,
            'user_id'=>\Auth::id(),
            'total_bayar'=>$data->total_bayar,
            'keterangan'=>$data->keterangan,
        ]);

        $this->storeDetail($data, $jurnalPenerimaan);
        return $jurnalPenerimaan->id;
    }

    public function rollback($jurnalPenerimaanPenjualan)
    {
        // rollback
        foreach ($jurnalPenerimaanPenjualan->jurnalPenerimaanDetail as $item){
            Penjualan::query()->find($item['penjualan_id'])->update([
                'status_bayar'=>'belum'
            ]);
        }
    }

    public function update($data)
    {
        $jurnalPenerimaanPenjualan = JurnalPenerimaanPenjualan::query()->find($data->id);

        // delete
        $jurnalPenerimaanPenjualan->jurnalPenerimaanDetail()->delete();

        $this->rollback($jurnalPenerimaanPenjualan);

        $jurnalPenerimaanPenjualan->jurnalPenerimaanDetail()->delete();

        $this->storeDetail($data, $jurnalPenerimaanPenjualan);

        return $jurnalPenerimaanPenjualan->id;
    }

    public function destroy($id)
    {
        $jurnalPenerimaanPenjualan = JurnalPenerimaanPenjualan::query()->find($id);

        $jurnalPenerimaanPenjualan->jurnalTransaksi()->delete();

        $this->rollback($jurnalPenerimaanPenjualan);

        $jurnalPenerimaanPenjualan->jurnalPenerimaanDetail()->delete();
        $jurnalPenerimaanPenjualan->delete();
    }

    /**
     * @param $data
     * @param $jurnalPenerimaanPenjualan
     */
    protected function storeDetail($data, $jurnalPenerimaanPenjualan): void
    {
        foreach ($data->detail as $item) {
            $jurnalPenerimaanPenjualan->jurnalPenerimaanDetail()->create([
                'penjualan_id' => $item['penjualan_id'],
            ]);
            // set lunas
            Penjualan::query()->find($item['penjualan_id'])->update([
                'status_bayar' => 'lunas'
            ]);
        }

        // debet
        $jurnalPenerimaanPenjualan->jurnalTransaksi()->create([
            'akun_id' => $data->akunDebet,
            'nominal_debet' => $data->total_bayar,
            'nominal_kredit' => null,
        ]);

        // kredit
        $jurnalPenerimaanPenjualan->jurnalTransaksi()->create([
            'akun_id' => $data->akunKredit,
            'nominal_debet' => null,
            'nominal_kredit' => $data->total_bayar,
        ]);
    }
}
