<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $fillable = ['user_id', 'buku_id'];

    // 🔥 relasi ke buku
    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }

    // 🔥 relasi ke user (WAJIB BIAR LENGKAP)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}