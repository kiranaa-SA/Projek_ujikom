<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategoris';

    // Tambahkan 'deskripsi' supaya bisa diisi lewat mass assignment
    protected $fillable = ['nama_kategori', 'deskripsi', 'slug'];

    // Relasi ke Buku
    public function buku()
    {
        return $this->hasMany(Buku::class, 'kategori_id');
    }
}