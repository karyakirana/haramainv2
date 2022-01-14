<?php

namespace App\Models\Stock;

use App\Models\Master\Gudang;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockOpname extends Model
{
    use HasFactory;
    protected $table = 'stock_opname';
    protected $fillable = [
        'active_cash',
        'kode',
        'tgl_input',
        'gudang_id',
        'user_id',
        'pegawai_id',
        'keterangan',
    ];

    public function gudang()
    {
        return $this->belongsTo(Gudang::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
