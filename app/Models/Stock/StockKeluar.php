<?php

namespace App\Models\Stock;

use App\Models\Master\Gudang;
use App\Models\Master\Supplier;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockKeluar extends Model
{
    use HasFactory;
    protected $table = 'stock_keluar';
    protected $fillable = [
        'kode',
        'supplier_id',
        'active_cash',
        'stockable_keluar_id',
        'stockable_keluar_type',
        'kondisi',
        'gudang_id',
        'tgl_keluar',
        'user_id',
        'keterangan',
    ];

    // get lastnum of kode
    public function getLastNumAttribute(): int
    {
        return (int) substr($this->kode, '0', '4');
    }

    // set date tgl_nota
    public function setTglKeluarAttribute($value)
    {
        $this->attributes['tgl_keluar'] = tanggalan_database_format($value, 'd-M-Y');
    }

    public function gudang()
    {
        return $this->belongsTo(Gudang::class, 'gudang_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function stockKeluarDetail()
    {
        return $this->hasMany(StockKeluarDetail::class, 'stock_keluar_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    // morph to
    public function stockableKeluar()
    {
        return $this->morphTo(__FUNCTION__, 'stockable_keluar_type', 'stockable_keluar_id');
    }
}
