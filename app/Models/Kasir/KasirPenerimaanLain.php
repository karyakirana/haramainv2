<?php

namespace App\Models\Kasir;

use App\Models\Traits\UsersTraits;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KasirPenerimaanLain extends Model
{
    use HasFactory;
    use UsersTraits;

    protected $table = 'kasir_penerimaan_lain';
    protected $fillable = [
        'user_id',
        'asal',
        'nominal',
        'keterangan'
    ];
}
