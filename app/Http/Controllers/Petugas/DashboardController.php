<?php
namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Denda;
use App\Models\Peminjaman;
use App\Models\Pengembalian;

class DashboardController extends Controller
{
    public function index()
    {
        // Data sementara / dummy
        $totalBuku         = Buku::count();
        $totalPeminjaman   = Peminjaman::where('status', 'dipinjam')->count();
        $totalPengembalian = Pengembalian::whereDate('tanggal_pengembalian', now())->count();
        $totalDenda        = Denda::where('status', 'belum_dibayar')->count();

        return view('petugas.dashboard', compact(
            'totalBuku',
            'totalPeminjaman',
            'totalPengembalian',
            'totalDenda'
        ));
    }
}