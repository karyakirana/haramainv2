<?php

namespace App\Models\Keuangan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AkunTipe extends Model
{
    use HasFactory;
    protected $table = 'akun_tipe';
    protected $fillable = [
        'kode',
        'deskripsi',
        'keterangan',
    ];
}
