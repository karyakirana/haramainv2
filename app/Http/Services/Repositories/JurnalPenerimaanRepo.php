<?php

namespace App\Http\Services\Repositories;

use App\Models\Keuangan\JurnalPenerimaan;

class JurnalPenerimaanRepo
{
    public function kode()
    {
        // query
        $query = JurnalPenerimaan::query()
            ->where('active_cash', session('ClosedCash'))
            ->latest('kode');

        // check last num
        if ($query->doesntExist()){
            return '1/KJP/'.date('Y');
        }

        $num = $query->first()->last_num + 1;
        return $num."/KJP/".date('Y');
    }

    public function store($data)
    {
        $jurnalPenerimaan = JurnalPenerimaan::query()->create([
            'kode'=>$this->kode(),
            'active_cash'=>session('ClosedCash'),
            'tgl_penerimaan'=>$data->tgl_penerimaan,
            'user_id'=>\Auth::id(),
            'nominal'=>$data->total_bayar,
            'keterangan'=>$data->keterangan,
        ]);

        // debet
        $jurnalPenerimaan->jurnalTransaksi()->create([
            'akun_id'=>$data->akunDebet,
            'nominal_debet'=>$data->total_bayar,
            'nominal_kredit'=>null,
        ]);

        // kredit
        foreach ($data->detail as $item){
            $jurnalPenerimaan->jurnalTransaksi()->create([
                'akun_id'=>$item['akun_id'],
                'nominal_debet'=>null,
                'nominal_kredit'=>$item['nominal'],
            ]);
        }
    }

    public function update($data)
    {
        //
    }

    public function destroy($id)
    {
        $penerimaanLain = JurnalPenerimaan::query()->find($id);

        // delete jurnal transaksi
        $penerimaanLain->jurnalTransaksi()->delete();

        $penerimaanLain->delete();
    }
}
