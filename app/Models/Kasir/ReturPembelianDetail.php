<?php

namespace App\Models\Kasir;

use App\Models\Master\Produk;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturPembelianDetail extends Model
{
    use HasFactory;
    protected $table = 'pembelian_retur_detail';
    protected $fillable = [
        'pembelian_retur_id',
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
        return $this->belongsTo(ReturPembelian::class, 'pembelian_retur_id');
    }
}
