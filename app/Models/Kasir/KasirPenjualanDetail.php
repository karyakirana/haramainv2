<?php

namespace App\Models\Kasir;

use App\Models\Traits\PenjualanTraits;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KasirPenjualanDetail extends Model
{
    use HasFactory, PenjualanTraits;

    protected $table ='kasir_penjualan_detail';
    protected $fillable = [
        'kasir_penjualan_id',
        'penjualan_id'
    ];

    public function kasirPenjualan()
    {
        return $this->belongsTo(KasirPenjualan::class, 'kasir_penjualan_id');
    }
}
