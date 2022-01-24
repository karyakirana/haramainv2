<?php

namespace App\Http\Services\Repositories;

use App\Models\Keuangan\JurnalPengeluaran;

class JurnalPengeluaranRepo
{
    public function kode()
    {
        // query
        $query = JurnalPengeluaran::query()
            ->where('active_cash', session('ClosedCash'))
            ->latest('kode');

        // check last num
        if ($query->doesntExist()){
            return '1/KJP/'.date('Y');
        }

        $num = $query->first()->last_num + 1;
        return $num."/KPO/".date('Y');
    }

    public function store($data)
    {
        $jurnalPengeluaran = JurnalPengeluaran::query()->create([
            'kode'=>$this->kode(),
            'active_cash'=>session('ClosedCash'),
            'tgl_pengeluaran'=>$data->tgl_pengeluaran,
            'user_id'=>\Auth::id(),
            'nominal'=>$data->total_bayar,
            'keterangan'=>$data->keterangan,
        ]);

        // kredit
        foreach ($data->detail as $item){
            $jurnalPengeluaran->jurnalTransaksi()->create([
                'akun_id'=>$item['akun_id'],
                'nominal_debet'=>$item['nominal'],
                'nominal_kredit'=>null,
            ]);
        }

        // debet
        $jurnalPengeluaran->jurnalTransaksi()->create([
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
