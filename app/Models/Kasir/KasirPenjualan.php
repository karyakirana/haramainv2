<?php

namespace App\Models\Kasir;

use App\Models\Traits\CustomerTraits;
use App\Models\Traits\UsersTraits;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KasirPenjualan extends Model
{
    use HasFactory;
    use CustomerTraits, UsersTraits;

    protected $table = 'kasir_penjualan';
    protected $fillable = [
        'customer_id',
        'total_nota',
        'total_tunai',
        'total_piutang',
        'user_id',
    ];
}
