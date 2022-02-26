<?php

namespace App\Models\Kasir;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembelianHarga extends Model
{
    use HasFactory;
    protected $table = 'pembelian_harga';
    protected $fillable = [
        'produk_id',
        'active_cash',
        'harga_average',
        'harga_last',
        'harga_first',
    ];
}
