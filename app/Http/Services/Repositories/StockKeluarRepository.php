<?php

namespace App\Services\Repositories;

use App\Models\Stock\StockKeluar;

class StockKeluarRepository
{
    // kode stock keluar (baik atau rusak)
    public function kode($kondisi) :string
    {
        // query
        $query = StockKeluar::query()
            ->where('active_cash', session('ClosedCash'))
            ->where('kondisi', $kondisi)
            ->latest('kode');

        $kodeKondisi = ($kondisi == 'baik') ? 'RB' : 'RR';

        // check last num
        if ($query->doesntExist()){
            return "0001/{$kodeKondisi}/".date('Y');
        }

        $num = $query->first()->last_num;
        return sprintf("%04s", $num)."/{$kodeKondisi}/".date('Y');
    }
    // insert stock keluar
    // rollback stock keluar
    // update stock keluar
    // delete stock keluar
}
