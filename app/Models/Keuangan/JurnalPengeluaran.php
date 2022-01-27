<?php

namespace App\Models\Keuangan;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JurnalPengeluaran extends Model
{
    use HasFactory;
    protected $table = 'jurnal_pengeluaran';
    protected $fillable = [
        'kode',
        'active_cash',
        'user_id',
        'tgl_pengeluaran',
        'nominal',
        'keterangan',
    ];

    // get lastnum of kode
    public function getLastNumAttribute(): int
    {
        return (int) before_string_me('/', $this->kode );
    }

    // set date tgl_nota
    public function setTglPengeluaranAttribute($value)
    {
        $this->attributes['tgl_pengeluaran'] = tanggalan_database_format($value, 'd-M-Y');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // morph
    public function jurnalTransaksi()
    {
        return $this->morphMany(JurnalTransaksi::class, 'jurnalable', 'jurnal_type', 'jurnal_id');
    }
}
