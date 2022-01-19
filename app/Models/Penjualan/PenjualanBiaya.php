<?php

namespace App\Models\Penjualan;

use App\Models\Keuangan\Akun;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjualanBiaya extends Model
{
    use HasFactory;
    protected $table = 'penjualan_biaya';
    protected $fillable = [
        'penjualan_id',
        'akun_id',
        'nominal',
    ];

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class, 'penjualan_id');
    }

    public function akun()
    {
        return $this->belongsTo(Akun::class, 'akun_id');
    }
}
