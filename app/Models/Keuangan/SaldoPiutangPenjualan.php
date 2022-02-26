<?php

namespace App\Models\Keuangan;

use App\Models\Master\Customer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaldoPiutangPenjualan extends Model
{
    use HasFactory;
    protected $table = 'saldo_piutang_penjualan';
    protected $fillable = [
        'customer_id',
        'tgl_awal',
        'tgl_akhir',
        'saldo',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
