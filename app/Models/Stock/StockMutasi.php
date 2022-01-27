<?php

namespace App\Models\Stock;

use App\Models\Master\Gudang;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockMutasi extends Model
{
    use HasFactory;
    protected $table = 'stock_mutasi';
    protected $fillable = [
        'active_cash',
        'kode',
        'jenis_mutasi',
        'gudang_asal_id',
        'gudang_tujuan_id',
        'tgl_mutasi',
        'user_id',
        'keterangan',
    ];

    // get lastnum of kode
    public function getLastNumAttribute(): int
    {
        return (int) substr($this->kode, '0', '4');
    }

    // set date tgl_masuk
    public function setTglMutasiAttribute($value)
    {
        $this->attributes['tgl_mutasi'] = tanggalan_database_format($value, 'd-M-Y');
    }

    public function gudangAsal()
    {
        return $this->belongsTo(Gudang::class, 'gudang_asal_id');
    }

    public function gudangTujuan()
    {
        return $this->belongsTo(Gudang::class, 'gudang_tujuan_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function stockMutasiDetail()
    {
        return $this->hasMany(StockMutasiDetail::class, 'stock_mutasi_id');
    }

    // polimorphism
    public function stockKeluar()
    {
        return $this->morphOne(StockKeluar::class,'stockable_keluar', 'stockable_keluar_type', 'stockable_keluar_id');
    }

    public function stockMasuk()
    {
        return $this->morphOne(StockMasuk::class, 'stockable_masuk', 'stockable_masuk_type', 'stockable_masuk_id');
    }
}
