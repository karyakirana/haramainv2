<?php

namespace App\Models\Keuangan;

use App\Models\Penjualan\Penjualan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JurnalPenerimaanPenjualanDetail extends Model
{
    use HasFactory;
    protected $table = 'jurnal_penerimaan_penjualan_detail';
    protected $fillable = [
        'jurnal_penerimaan_penjualan_id',
        'penjualan_id',
    ];

    public function jurnalPenerimaanPenjualan()
    {
        return $this->belongsTo(JurnalPenerimaanPenjualan::class, 'jurnal_penerimaan_id');
    }

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class, 'penjualan_id');
    }
}
