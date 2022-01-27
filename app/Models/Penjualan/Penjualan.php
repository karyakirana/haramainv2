<?php

namespace App\Models\Penjualan;

use App\Models\Master\Customer;
use App\Models\Master\Gudang;
use App\Models\Stock\StockKeluar;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Penjualan extends Model
{
    use HasFactory;
    protected $table = 'penjualan';
    protected $fillable = [
        'kode',
        'active_cash',
        'customer_id',
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

//    // set date tgl_tempo
//    public function setTglTempoAttribute($value)
//    {
//        $this->attributes['tgl_tempo'] = tanggalan_database_format($value, 'd-M-Y');
//    }

    /**
     * Relational
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function gudang()
    {
        return $this->belongsTo(Gudang::class, 'gudang_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function penjualanDetail()
    {
        return $this->hasMany(PenjualanDetail::class, 'penjualan_id');
    }

    public function penjualanBiaya()
    {
        return $this->hasMany(PenjualanBiaya::class, 'penjualan_id');
    }

    // polimorphism
    public function stockKeluar()
    {
        return $this->morphOne(StockKeluar::class,'stockable_keluar', 'stockable_keluar_type', 'stockable_keluar_id');
    }
}
