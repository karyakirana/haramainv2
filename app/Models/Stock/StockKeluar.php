<?php

namespace App\Models\Stock;

use App\Models\Master\Gudang;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockKeluar extends Model
{
    use HasFactory;
    protected $table = 'stock_keluar';
    protected $fillable = [
        'kode',
        'active_cash',
        'stockable_keluar_id',
        'stockable_keluar_type',
        'kondisi',
        'gudang_id',
        'tgl_keluar',
        'user_id',
        'keterangan',
    ];

    public function gudang()
    {
        return $this->belongsTo(Gudang::class, 'gudang_id');
    }

    public function users()
    {
        $this->belongsTo(User::class, 'user_id');
    }

    // morph to
    public function stockableKeluar()
    {
        return $this->morphTo();
    }
}
