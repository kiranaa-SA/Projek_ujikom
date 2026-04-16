<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'buku_id'];

    // 🔥 FIX TAMBAHAN (biar aman tipe data)
    protected $casts = [
        'user_id' => 'integer',
        'buku_id' => 'integer',
    ];

    // ======================
    // RELASI USER
    // ======================
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ======================
    // RELASI BUKU
    // ======================
    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }
}