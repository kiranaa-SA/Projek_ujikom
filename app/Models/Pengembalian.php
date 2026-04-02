<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_pengembalian',
        'peminjaman_id',
        'tanggal_pengembalian',
        'terlambat',
        'kondisi',
        'denda',
    ];

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class);
    }

    // 🔥 WAJIB ADA biar whereDoesntHave('denda') & edit jalan
    public function denda()
    {
        return $this->hasOne(Denda::class);
    }
}