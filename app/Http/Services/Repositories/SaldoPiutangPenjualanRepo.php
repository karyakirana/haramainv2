<?php

namespace App\Http\Services\Repositories;

use App\Models\Keuangan\SaldoPiutangPenjualan;

class SaldoPiutangPenjualanRepo
{
    public static function create($data)
    {
        return SaldoPiutangPenjualan::query()
            ->create([
                'customer_id'=>$data->customer_id,
                'tgl_awal'=>$data->tgl_awal,
                'tgl_akhir'=>($data->tgl_awal) ? null : $data->tgl_akhir,
                'saldo'=>$data->total_piutang
            ]);
    }

    public static function update($data)
    {
        //
    }
}
