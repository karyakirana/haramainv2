<?php

namespace App\Models\Keuangan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AkunKategori extends Model
{
    use HasFactory;
    protected $table = 'akun_kategori';
    protected $fillable = [
        'kode',
        'deskripsi',
        'keterangan',
    ];
}
