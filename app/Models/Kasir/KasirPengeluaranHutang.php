<?php

namespace App\Models\Kasir;

use App\Models\Traits\SupplierTraits;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KasirPengeluaranHutang extends Model
{
    use HasFactory, SupplierTraits;

    protected $table = 'kasir_pengeluaran_hutang';
    protected $fillable = [
        'supplier_id',
        'total_hutang',
        'keterangan',
        'keterangan',
    ];
}
