<?php

namespace App\Models\Keuangan;

use App\Models\Master\Customer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JurnalPenjualan extends Model
{
    use HasFactory;
    protected $table = 'jurnal_penjualan';
    protected $fillable = [
        'kode',
        'active_cash',
        'tgl_jurnal',
        'customer_id',
        'total_bayar',
        'user_id',
        'keterangan',
    ];

    // get lastnum of kode
    public function getLastNumAttribute(): int
    {
        return (int) before_string_me('/', $this->kode );
    }

    // set date tgl_nota
    public function setTglJurnalAttribute($value)
    {
        $this->attributes['tgl_jurnal'] = tanggalan_database_format($value, 'd-M-Y');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function jurnalPenjualanDetail()
    {
        return $this->hasMany(JurnalPenjualanDetail::class, 'jurnal_penjualan_id');
    }

    // morph
    public function jurnalTransaksi()
    {
        return $this->morphMany(JurnalTransaksi::class, 'jurnalable', 'jurnal_type', 'jurnal_id');
    }
}
