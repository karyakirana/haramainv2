<?php

namespace App\Models\Kasir;

use App\Models\Master\Gudang;
use App\Models\Master\Supplier;
use App\Models\Stock\StockKeluar;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturPembelian extends Model
{
    use HasFactory;
    protected $table = 'pembelian_retur';
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

    /**
     * Relational
     */
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

    public function returPembelianDetail()
    {
        return $this->hasMany(ReturPembelianDetail::class, 'pembelian_retur_id');
    }

    // polimorphism
    public function stockKeluar()
    {
        return $this->morphOne(StockKeluar::class,'stockable_keluar', 'stockable_keluar_type', 'stockable_keluar_id');
    }
}
