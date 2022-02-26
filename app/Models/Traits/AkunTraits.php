<?php

namespace App\Models\Traits;

use App\Models\Keuangan\Akun;

trait AkunTraits
{
    public function akun()
    {
        return $this->belongTo(Akun::class, 'akun_id');
    }
}
