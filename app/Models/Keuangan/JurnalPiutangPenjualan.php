<?php

namespace App\Models\Keuangan;

use App\Models\Traits\AkunTraits;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JurnalPiutangPenjualan extends Model
{
    use HasFactory, AkunTraits;

    protected $table = 'jurnal_piutang_penjualan_table';
    protected $fillable = [
        'kode',
        'active_cash',
        'piutang_type',
        'piutang_id',
        'akun_id',
        'nominal_debet',
        'nominal_kredit',
        'nominal_saldo',
    ];
}
