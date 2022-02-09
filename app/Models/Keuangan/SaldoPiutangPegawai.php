<?php

namespace App\Models\Keuangan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaldoPiutangPegawai extends Model
{
    use HasFactory;
    protected $table = 'saldo_piutang_pegawai';

    protected $fillable = [
        'pegawai_id',
        'tgl_awal',
        'tgl_lunas',
        'saldo',
    ];
}
