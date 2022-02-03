<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    use HasFactory;
    protected $table = 'tax_perusahaan';

    protected $fillable = [
        'kode',
        'nama',
        'alamat',
        'npwp',
        'maximal',
        'keterangan',
    ];
}
