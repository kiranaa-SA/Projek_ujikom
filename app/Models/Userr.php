<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Userr extends Authenticatable
{
    use Notifiable;

    protected $table = 'userrs';

    // Kolom yang bisa diisi massal
    protected $fillable = [
        'name',
        'email',
        'role',
    ];

    // Kolom yang disembunyikan saat diubah jadi array/JSON
    protected $hidden = [
        'password',       // optional kalau nanti pakai login
        'remember_token', // optional kalau pakai autentikasi
    ];
}