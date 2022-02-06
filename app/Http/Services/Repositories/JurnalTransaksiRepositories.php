<?php

namespace App\Http\Services\Repositories;

use App\Models\Keuangan\JurnalTransaksi;

class JurnalTransaksiRepositories
{
    public function store($data)
    {
        return JurnalTransaksi::query()->create([
            ''
        ]);
    }
}
