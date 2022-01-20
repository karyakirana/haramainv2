<?php

namespace App\Models\Keuangan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JurnalTransaksi extends Model
{
    use HasFactory;
    protected $table = 'jurnal_transaksi';
    protected $fillable = [
        'jurnal_type',
        'jurnal_id',
        'akun_id',
        'nominal_debet',
        'nominal_kredit',
    ];

    public function jurnalable()
    {
        return $this->morphTo(__FUNCTION__, 'jurnal_type', 'jurnal_id');
    }

    public function akun()
    {
        return $this->belongsTo(Akun::class, 'akun_id');
    }
}
