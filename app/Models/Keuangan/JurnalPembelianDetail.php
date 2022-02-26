<?php

namespace App\Models\Keuangan;

use App\Models\Kasir\Pembelian;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JurnalPembelianDetail extends Model
{
    use HasFactory;
    protected $table = 'jurnal_pembelian_id';
    protected $fillable = [
        'jurnal_pembelian_id',
        'pembelian_id',
        'total_bayar',
    ];

    public function jurnalPembelian()
    {
        return $this->belongsTo(JurnalPembelian::class, 'jurnal_pembelian_id');
    }

    public function pembelian()
    {
        return $this->belongsTo(Pembelian::class, 'pembelian_id');
    }
}
