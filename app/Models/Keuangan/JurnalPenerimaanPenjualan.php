<?php

namespace App\Models\Keuangan;

use App\Models\Master\Customer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JurnalPenerimaanPenjualan extends Model
{
    use HasFactory;
    protected $table = 'jurnal_penerimaan_penjualan';
    protected $fillable = [
        'kode',
        'tgl',
        'active_cash',
        'customer_id',
        'user_id',
        'total_bayar',
        'keterangan',
    ];

    // get lastnum of kode
    public function getLastNumAttribute(): int
    {
        return (int) before_string($this->kode, '/');
    }

    // set date tgl_nota
    public function setTglPenerimaanAttribute($value)
    {
        $this->attributes['tgl_penerimaan'] = tanggalan_database_format($value, 'd-M-Y');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function users()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function jurnalPenerimaanDetail()
    {
        return $this->hasMany(JurnalPenerimaanPenjualanDetail::class, 'jurnal_penerimaan_penjualan_id');
    }

    // morph
    public function jurnalTransaksi()
    {
        return $this->morphMany(JurnalTransaksi::class, 'jurnalable', 'jurnal_type', 'jurnal_id');
    }
}
