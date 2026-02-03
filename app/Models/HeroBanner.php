<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeroBanner extends Model
{
    use HasFactory;

    protected $table = 'hero_banners';

    // Kolom yang boleh diisi (mass assignable)
    protected $fillable = [
        'judul_utama',
        'judul',
        'deskripsi',
        'gambar',
    ];
}