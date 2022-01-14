<?php

namespace App\Models\Stock;

use App\Models\Master\Produk;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockMasukDetail extends Model
{
    use HasFactory;
    protected $table = 'stock_masuk_detail';
    protected $fillable = [
        'stock_masuk_id',
        'produk_id',
        'jumlah',
    ];

    public function stockMasuk()
    {
        return $this->belongsTo(StockMasuk::class, 'stock_masuk_id');
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
