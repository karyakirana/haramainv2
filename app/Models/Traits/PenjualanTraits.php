<?php

namespace App\Models\Traits;

use App\Models\Penjualan\Penjualan;

trait PenjualanTraits
{
    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class, 'penjualan_id');
    }
}
