<?php

namespace App\Models\Stock;

use App\Models\Master\Produk;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockMutasiDetail extends Model
{
    use HasFactory;
    protected $table = 'stock_mutasi_detail';
    protected $fillable = [
        'stock_mutasi_id',
        'produk_id',
        'jumlah',
    ];

    public function stockMutasi()
    {
        return $this->belongsTo(StockMutasi::class);
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
