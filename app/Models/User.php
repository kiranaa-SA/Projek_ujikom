<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users'; // default Laravel

    /**
     * Kolom yang bisa diisi massal
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * Kolom yang disembunyikan saat diubah ke array/JSON
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Tipe cast untuk kolom tertentu
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}