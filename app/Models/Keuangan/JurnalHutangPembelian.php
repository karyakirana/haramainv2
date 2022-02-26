<?php

namespace App\Models\Keuangan;

use App\Models\Traits\AkunTraits;
use App\Models\Traits\KodeTraits;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JurnalHutangPembelian extends Model
{
    use HasFactory, KodeTraits, AkunTraits;

    protected $table = 'jurnal_hutang_pembelian_table';
    protected $fillable = [
        'kode',
        'active_cash',
        'hutang_type',
        'hutang_id',
        'akun_id',
        'nominal_debet',
        'nominal_kredit',
        'nominal_saldo',
    ];
}
