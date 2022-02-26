<?php

namespace App\Models\Kasir;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KasirPembelianDetail extends Model
{
    use HasFactory;

    protected $table = 'kasir_pembelian_detail';
    protected $fillable = [
        'kasir_pembelian_id',
        'pembelian_id',
    ];

    public function kasirPembelian()
    {
        return $this->belongsTo(KasirPembelian::class, 'kasir_pembelian_id');
    }

    public function pembelian()
    {
        return $this->belongsTo(Pembelian::class, 'pembelian_id');
    }
}
