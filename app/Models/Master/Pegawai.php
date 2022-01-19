<?php

namespace App\Models\Master;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;
    protected $table = 'pegawai';
    protected $fillable = [
        'kode',
        'user_id',
        'nama',
        'gender',
        'jabatan',
        'telepon',
        'alamat',
        'keterangan',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getLastNumKodeAttribute()
    {
        return substr($this->kode, 1, 5);
    }
}
