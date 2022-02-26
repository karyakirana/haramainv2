<?php

namespace App\Models\Kasir;

use App\Models\Master\Supplier;
use App\Models\Traits\JurnalTransaksiTraits;
use App\Models\Traits\UsersTraits;
use App\Models\Traits\SupplierTraits;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KasirPembelian extends Model
{
    use HasFactory;
    use JurnalTransaksiTraits, UsersTraits, SuppLierTraits;

    protected $table = 'kasir_pembelian';
    protected $fillable = [
        'supplier_id',
        'total_nota',
        'total_tunai',
        'total_hutang',
        'user_id'
    ];
}
