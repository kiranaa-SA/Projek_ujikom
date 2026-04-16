<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeminjamanNotification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'peminjaman_id',
        'type', // 🔥 TAMBAHAN
        'is_read',
    ];

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}