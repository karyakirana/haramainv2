<?php

namespace App\Models\Traits;

use App\Models\Master\Supplier;

trait SupplierTraits
{
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
}
