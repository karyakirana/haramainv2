<?php

namespace App\Http\Services\Repositories;

use App\Models\Keuangan\JurnalTransaksi;

class KeuanganReportRepository
{
    public static function getCashFlow()
    {
        $data = JurnalTransaksi::query()
            ->whereRelation('akun', '');
    }
}
