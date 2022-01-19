<?php

namespace App\Models\Penjualan;

use App\Models\Master\Produk;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjualanReturDetail extends Model
{
    use HasFactory;
    protected $table = 'penjualan_retur_detail';
    protected $fillable = [
        'penjualan_retur_id',
        'produk_id',
        'harga',
        'jumlah',
        'diskon',
        'sub_total',
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }

    public function retur()
    {
        return $this->belongsTo(PenjualanRetur::class, 'penjualan_retur_id');
    }
}
