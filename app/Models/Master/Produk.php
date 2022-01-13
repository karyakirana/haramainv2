<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $table = 'produk';

    protected $fillable = [
        'kode',
        'kategori_id',
        'kategori_harga_id',
        'kode_lokal',
        'penerbit',
        'nama',
        'hal',
        'cover',
        'harga',
        'size',
        'deskripsi',
    ];

    /**
     * Relation
     */
    public function kategori()
    {
        return $this->belongsTo(ProdukKategori::class, 'kategori_id');
    }

    public function kategoriHarga()
    {
        return $this->belongsTo(ProdukKategoriHarga::class, 'kategori_harga_id');
    }

    public function getLastNumKodeAttribute()
    {
        return substr($this->kode, 1, 5);
    }



}
