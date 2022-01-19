<?php

namespace App\Models\Stock;

use App\Models\Master\Gudang;
use App\Models\Master\Pegawai;
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
        'jenis',
        'tgl_input',
        'gudang_id',
        'user_id',
        'pegawai_id',
        'keterangan',
    ];

    // get lastnum of kode
    public function getLastNumAttribute(): int
    {
        return (int) substr($this->kode, '0', '4');
    }

    // set date tgl_masuk
    public function setTglInputAttribute($value)
    {
        $this->attributes['tgl_input'] = tanggalan_database_format($value, 'd-M-Y');
    }

    public function gudang()
    {
        return $this->belongsTo(Gudang::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }

    public function stockOpnameDetail()
    {
        return $this->hasMany(StockOpnameDetail::class, 'stock_opname_id');
    }
}
