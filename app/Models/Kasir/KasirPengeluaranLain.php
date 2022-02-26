<?php

namespace App\Models\Kasir;

use App\Models\Traits\UsersTraits;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KasirPengeluaranLain extends Model
{
    use HasFactory, UsersTraits;
    protected $table = 'kasir_pengeluaran_lain';
    protected $fillable = [
        'user_id',
        'tujuan',
        'nominal',
        'keterangan',
    ];
}
