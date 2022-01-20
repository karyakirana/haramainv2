<?php

namespace App\Models\Keuangan;

use App\Models\Penjualan\Penjualan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JurnalPenjualanDetail extends Model
{
    use HasFactory;
    protected $table = 'jurnal_penjualan_detail';
    protected $fillable = [
        'jurnal_penjualan_id',
        'penjualan_id',
    ];

    public function jurnalPenjualan()
    {
        return $this->belongsTo(JurnalPenjualan::class, 'jurnal_penjualan_id');
    }

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class, 'penjualan_id');
    }
}
