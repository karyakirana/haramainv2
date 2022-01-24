<?php

namespace App\Http\Services\Repositories;

use App\Models\Keuangan\JurnalPenjualan;
use App\Models\Penjualan\Penjualan;
use Illuminate\Support\Facades\Auth;

class JurnalSetPiutangRepo
{
    public function kode()
    {
        // query
        $query = JurnalPenjualan::query()
            ->where('active_cash', session('ClosedCash'))
            ->latest('kode');

        // check last num
        if ($query->doesntExist()){
            return '1/PIPJ/'.date('Y');
        }

        $num = $query->first()->last_num + 1;
        return $num."/PIPJ/".date('Y');
    }

    public function store($data)
    {
        $jurnalSetPiutang = JurnalPenjualan::query()->create([
            'kode'=>$this->kode(),
            'active_cash'=>session('ClosedCash'),
            'tgl_jurnal'=>$data->tgl_jurnal,
            'customer_id'=>$data->customer_id,
            'total_bayar'=>$data->total_bayar,
            'user_id'=>Auth::id(),
            'keterangan'=>$data->keterangan,
        ]);

        foreach ($data->detail as $item){
            $jurnalSetPiutang->jurnalPenjualanDetail()->create([
                'penjualan_id'=>$item['penjualan_id'],
            ]);
            // set lunas
            Penjualan::query()->find($item['penjualan_id'])->update([
                'status_bayar'=>'piutang'
            ]);
        }

        // debet
        $jurnalSetPiutang->jurnalTransaksi()->create([
            'akun_id'=>$data->akunDebet,
            'nominal_debet'=>$data->total_bayar,
            'nominal_kredit'=>null,
        ]);

        // kredit
        $jurnalSetPiutang->jurnalTransaksi()->create([
            'akun_id'=>$data->akunKredit,
            'nominal_debet'=>null,
            'nominal_kredit'=>$data->total_bayar,
        ]);
    }

    public function update($data)
    {
        //
    }
}
