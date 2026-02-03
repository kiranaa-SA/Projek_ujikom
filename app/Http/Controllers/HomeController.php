<?php
namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\HeroBanner;
use App\Models\Kategori;
use App\Models\Peminjaman;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil banner
        $banners = HeroBanner::all();

        // Total Buku
        $totalBuku = Buku::count();

        // Total Kategori
        $totalKategori = Kategori::count();

        // Total Peminjaman
        $totalPeminjaman = Peminjaman::count();

        // Total Pengembalian (ganti totalPenulis)
        $totalPengembalian = Peminjaman::where('status', 'dikembalikan')->count();

        // Redirect jika user login berdasarkan role
        if (auth()->check()) {
            $role = auth()->user()->role;

            if ($role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            if ($role === 'petugas') {
                return redirect()->route('petugas.dashboard');
            }
        }

        // Kirim data ke view
        return view('home', compact(
            'banners',
            'totalBuku',
            'totalKategori',
            'totalPeminjaman',
            'totalPengembalian' // <-- ganti dari totalPenulis
        ));
    }
}