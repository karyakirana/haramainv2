<?php

namespace App\Models\Kasir;

use App\Models\Master\Gudang;
use App\Models\Master\Supplier;
use App\Models\Stock\StockMasuk;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;
    protected $table = 'pembelian';

    protected $fillable = [
        'kode',
        'active_cash',
        'supplier_id',
        'gudang_id',
        'user_id',
        'tgl_nota',
        'tgl_tempo',
        'jenis_bayar',
        'status_bayar',
        'total_barang',
        'ppn',
        'biaya_lain',
        'total_bayar',
        'keterangan',
        'print',
    ];

    // get lastnum of kode
    public function getLastNumAttribute(): int
    {
        return (int) substr($this->kode, '0', '4');
    }

    // set date tgl_nota
    public function setTglNotaAttribute($value)
    {
        $this->attributes['tgl_nota'] = tanggalan_database_format($value, 'd-M-Y');
    }
    // set date tgl_tempo
//    public function setTglTempoAttribute($value)
//    {
//        $this->attributes['tgl_tempo'] = tanggalan_database_format($value, 'd-M-Y');
//    }

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

    public function pembelianDetail()
    {
        return $this->hasMany(PembelianDetail::class, 'pembelian_id');
    }

    // polimorphism
    public function stockMasuk()
    {
        return $this->morphOne(StockMasuk::class,'stockable_masuk', 'stockable_masuk_type', 'stockable_masuk_id');
    }
}
