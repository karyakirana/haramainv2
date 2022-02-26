<?php

namespace App\Models\Keuangan;

use App\Models\Master\Supplier;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JurnalPembelian extends Model
{
    use HasFactory;
    protected $table = 'jurnal_pembelian';
    protected $fillable = [
        'tipe',
        'active_cash',
        'kode',
        'tgl_jurnal',
        'supplier_id',
        'user_id',
        'nominal_hutang',
        'jumlah_nota',
        'keterangan',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    // morph
    public function jurnalTransaksi()
    {
        return $this->morphMany(JurnalTransaksi::class, 'jurnalable', 'jurnal_type', 'jurnal_id');
    }
}
