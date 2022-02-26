<?php

namespace App\Models\Keuangan;

use App\Models\Master\Supplier;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaldoHutangPembelian extends Model
{
    use HasFactory;
    protected $table = 'saldo_hutang_pembelian';

    protected $fillable = [
      'supplier_id',
      'tgl_awal',
      'tgl_akhir',
      'saldo',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
}
