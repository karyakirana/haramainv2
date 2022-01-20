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
        'active_cash',
        'customer_id',
        'user_id',
        'total_bayar',
        'keterangan',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function users()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    // morph
    public function jurnalTransaksi()
    {
        return $this->morphMany(JurnalTransaksi::class, 'jurnalable', 'jurnal_type', 'jurnal_id');
    }
}
