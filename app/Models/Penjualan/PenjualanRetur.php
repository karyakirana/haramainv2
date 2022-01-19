<?php

namespace App\Models\Penjualan;

use App\Models\Master\Customer;
use App\Models\Master\Gudang;
use App\Models\Stock\StockMasuk;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PenjualanRetur extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'penjualan_retur';
    protected $fillable = [
        'kode',
        'active_cash',
        'jenis_retur',
        'customer_id',
        'gudang_id',
        'user_id',
        'tgl_nota',
        'tgl_tempo',
        'status_bayar',
        'total_barang',
        'ppn',
        'biaya_lain',
        'total_bayar',
        'keterangan',
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

    public function stockMasuk()
    {
        return $this->morphOne(StockMasuk::class, 'stockable_masuk', 'stockable_masuk_type', 'stockable_masuk_id');
    }

    public function returDetail()
    {
        return $this->hasMany(PenjualanReturDetail::class, 'penjualan_retur_id');
    }
}
