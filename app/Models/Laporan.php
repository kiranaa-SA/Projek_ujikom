<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $fillable = [
        'peminjaman_id',
        'pengembalian_id',
        'kondisi_buku',
        'tanggal',
    ];

    // relasi ke peminjaman
    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class);
    }

    // relasi ke pengembalian
    public function pengembalian()
    {
        return $this->belongsTo(Pengembalian::class);
    }
}