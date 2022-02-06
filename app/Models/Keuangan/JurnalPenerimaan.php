<?php

namespace App\Models\Keuangan;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JurnalPenerimaan extends Model
{
    use HasFactory;
    protected $table = 'jurnal_penerimaan';
    protected $fillable = [
        'kode',
        'active_cash',
        'tgl_penerimaan',
        'sumber',
        'user_id',
        'nominal',
        'keterangan',
    ];

    // get lastnum of kode
    public function getLastNumAttribute(): int
    {
        return (int) before_string_me('/', $this->kode );
    }

    // set date tgl_nota
    public function setTglPenerimaanAttribute($value)
    {
        $this->attributes['tgl_penerimaan'] = tanggalan_database_format($value, 'd-M-Y');
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
