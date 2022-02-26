<?php

namespace App\Models\Traits;

use App\Models\User;

trait UsersTraits
{
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
