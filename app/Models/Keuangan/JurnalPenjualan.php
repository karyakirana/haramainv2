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

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // morph
    public function jurnalTransaksi()
    {
        return $this->morphMany(JurnalTransaksi::class, 'jurnalable', 'jurnal_type', 'jurnal_id');
    }
}
