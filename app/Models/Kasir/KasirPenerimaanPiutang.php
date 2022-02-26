<?php

namespace App\Models\Kasir;

use App\Models\Traits\CustomerTraits;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KasirPenerimaanPiutang extends Model
{
    use HasFactory, CustomerTraits;

    protected $table = 'kasir_penerimaan_piutang';
    protected $fillable = [
        'customer_id',
        'total_piutang',
        'keterangan',
    ];
}
