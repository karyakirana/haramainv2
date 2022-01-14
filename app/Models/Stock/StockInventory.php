<?php

namespace App\Models\Stock;

use App\Models\Master\Gudang;
use App\Models\Master\Produk;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockInventory extends Model
{
    use HasFactory;
    protected $table = 'stock_inventory';
    protected $fillable = [
        'active_cash',
        'jenis',
        'gudang_id',
        'produk_id',
        'stock_awal',
        'stock_opname',
        'stock_masuk',
        'stock_keluar',
        'stock_lost',
    ];

    public function gudang()
    {
        return $this->belongsTo(Gudang::class, 'gudang_id');
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }
}
