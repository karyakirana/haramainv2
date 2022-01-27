<?php

namespace App\Models\Stock;

use App\Models\Master\Gudang;
use App\Models\Master\Supplier;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockMasuk extends Model
{
    use HasFactory;
    protected $table = 'stock_masuk';
    protected $fillable = [
        'kode',
        'active_cash',
        'stockable_masuk_id',
        'stockable_masuk_type',
        'kondisi',
        'gudang_id',
        'supplier_id',
        'tgl_masuk',
        'user_id',
        'nomor_po',
        'keterangan',
    ];

    // get lastnum of kode
    public function getLastNumAttribute(): int
    {
        return (int) substr($this->kode, '0', '4');
    }

    // set date tgl_masuk
    public function setTglMasukAttribute($value)
    {
        $this->attributes['tgl_masuk'] = tanggalan_database_format($value, 'd-M-Y');
    }

    public function stockableMasuk()
    {
        return $this->morphTo();
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function gudang()
    {
        return $this->belongsTo(Gudang::class, 'gudang_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function stockMasukDetail()
    {
        return $this->hasMany(StockMasukDetail::class, 'stock_masuk_id');
    }
}
