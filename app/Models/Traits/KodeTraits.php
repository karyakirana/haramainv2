<?php

namespace App\Models\Traits;

trait KodeTraits
{
    // get lastnum of kode
    public function getLastNumAttribute(): int
    {
        return (int) before_string_me('/', $this->kode );
    }
}
