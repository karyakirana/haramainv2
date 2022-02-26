<?php

namespace App\Models\Traits;

use App\Models\Master\Customer;

trait CustomerTraits
{
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
