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
        'kode_peminjaman', // ✅ TAMBAH
        'user_id',
        'buku_id',
        'tanggal_pinjam',
        'tenggat_tempo',
        'status',
    ];

    // default value
    protected $attributes = [
        'status' => 'pending',
    ];

    /**
     * 🔹 Auto generate kode peminjaman
     * contoh: PMJ-20260202-AB12
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->kode_peminjaman)) {
                $model->kode_peminjaman =
                'PMJ-' .
                now()->format('Ymd') . '-' .
                strtoupper(Str::random(4));
            }
        });
    }

    // ================= RELATION =================

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }

    public function pengembalian()
    {
        return $this->hasOne(Pengembalian::class);
    }
}