<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_buku',
        'judul',
        'penulis',
        'penerbit',
        'tahun_terbit',
        'stok',
        'gambar',
        'deskripsi',
        'rak_id',
        'kategori_id',
    ];

    // 🔥 Tambahin ini biar otomatis ikut ke API
    protected $appends = ['gambar_url'];

    // 🔥 Bikin URL gambar full
    public function getGambarUrlAttribute()
    {
        return $this->gambar 
            ? asset('storage/' . $this->gambar)
            : null;
    }

    public function rak()
    {
        return $this->belongsTo(Rak::class);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}