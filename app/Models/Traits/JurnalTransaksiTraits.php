<?php

namespace App\Models\Traits;

use App\Models\Keuangan\JurnalTransaksi;

trait JurnalTransaksiTraits
{
    // morph
    public function jurnalTransaksi()
    {
        return $this->morphMany(JurnalTransaksi::class, 'jurnalable', 'jurnal_type', 'jurnal_id');
    }
}
