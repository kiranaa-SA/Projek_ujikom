<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Denda extends Model
{
    use HasFactory;

    protected $fillable = ['pengembalian_id', 'kondisi_buku', 'status'];

    public function pengembalian()
    {
        return $this->belongsTo(Pengembalian::class);
    }
}