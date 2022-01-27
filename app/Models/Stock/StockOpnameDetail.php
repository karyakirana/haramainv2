<?php

namespace App\Models\Stock;

use App\Models\Master\Produk;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockOpnameDetail extends Model
{
    use HasFactory;
    protected $table = 'stock_opname_detail';
    protected $fillable = [
        'stock_opname_id',
        'produk_id',
        'jumlah',
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }

    public function stockOpname()
    {
        return $this->belongsTo(StockOpname::class);
    }
}
