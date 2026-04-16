<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjamans';

    protected $fillable = [
        'kode_peminjaman',
        'user_id',
        'buku_id',
        'tanggal_pinjam',
        'tenggat_tempo',
        'status',
        'jumlah_perpanjang',
        'status_perpanjang',
    ];

    protected $attributes = [
        'status' => 'pending',
        'jumlah_perpanjang' => 0,
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->kode_peminjaman)) {
                $model->kode_peminjaman =
                    'PMJ-' . now()->format('Ymd') . '-' . strtoupper(Str::random(4));
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }

    // ✅ TAMBAHAN INI (BIAR ERROR HILANG)
    public function pengembalian()
    {
        return $this->hasOne(Pengembalian::class, 'peminjaman_id');
    }
}