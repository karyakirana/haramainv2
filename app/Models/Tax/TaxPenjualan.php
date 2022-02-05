<?php

namespace App\Models\Tax;

use App\Models\Master\Customer;
use App\Models\Master\Perusahaan;
use App\Models\Penjualan\Penjualan;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxPenjualan extends Model
{
    use HasFactory;
    protected $table = 'tax_penjualan';
    protected $fillable = [
        'active_cash',
        'kode',
        'perusahaan_id',
        'customer_id',
        'penjualan_id',
        'total_bayar',
        'user_id',
        'keterangan',
    ];

    // get lastnum of kode
    public function getLastNumAttribute(): int
    {
        return (int) substr($this->kode, '0', '4');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class, 'penjualan_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class, 'perusahaan_id');
    }

}
