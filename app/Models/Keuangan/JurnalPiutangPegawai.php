<?php

namespace App\Models\Keuangan;

use App\Models\Master\Pegawai;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JurnalPiutangPegawai extends Model
{
    use HasFactory;
    protected $table = 'jurnal_piutang_pegawai';
    protected $fillable = [
        'active_cash',
        'kode',
        'pegawai_id',
        'tgl_piutang',
        'status',
        'nominal',
        'user_id',
        'keterangan',
    ];

    // get lastnum of kode
    public function getLastNumAttribute(): int
    {
        return (int) before_string_me('/', $this->kode );
    }

    public function setTglPiutangAttribute($value)
    {
        $this->attributes['tgl_piutang'] = tanggalan_database_format($value, 'd-M-Y');
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function jurnalPiutangPegawaiDetail()
    {
        return $this->hasMany(JurnalPiutangPegawaiDetail::class, 'jurnal_piutang_pegawai_id');
    }

    // morph
    public function jurnalTransaksi()
    {
        return $this->morphMany(JurnalTransaksi::class, 'jurnalable', 'jurnal_type', 'jurnal_id');
    }
}
