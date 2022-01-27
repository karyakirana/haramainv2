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
            return '1/PPJ/'.date('Y');
        }

        $num = $query->first()->last_num + 1;
        return $num."/PPJ/".date('Y');
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

        foreach ($data->detail as $item){
            $jurnalPenerimaan->jurnalPenerimaanDetail()->create([
                'penjualan_id'=>$item['penjualan_id'],
            ]);
            // set lunas
            Penjualan::query()->find($item['penjualan_id'])->update([
                'status_bayar'=>'lunas'
            ]);
        }

        // debet
        $jurnalPenerimaan->jurnalTransaksi()->create([
            'akun_id'=>$data->akunDebet,
            'nominal_debet'=>$data->total_bayar,
            'nominal_kredit'=>null,
        ]);

        // kredit
        $jurnalPenerimaan->jurnalTransaksi()->create([
            'akun_id'=>$data->akunKredit,
            'nominal_debet'=>null,
            'nominal_kredit'=>$data->total_bayar,
        ]);
    }
}
