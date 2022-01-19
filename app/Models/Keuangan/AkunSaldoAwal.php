<?php

namespace App\Models\Keuangan;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AkunSaldoAwal extends Model
{
    use HasFactory;
    protected $table = 'akun_saldo_awal';
    protected $fillable = [
        'active_cash',
        'kode',
        'akun_id',
        'nominal_debet',
        'nominal_kredit',
        'keterangan',
        'user_id',
    ];

    public function akun()
    {
        return $this->belongsTo(Akun::class, 'akun_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
