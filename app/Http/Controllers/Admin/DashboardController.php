<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Denda;
use App\Models\Kategori;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\Rak;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik utama
        $totalBuku         = Buku::count();
        $totalKategori     = Kategori::count();
        $totalRak          = Rak::count();
        $totalUser         = User::count();
        $totalPeminjaman   = Peminjaman::count();
        $totalPengembalian = Pengembalian::count();
        $totalDenda        = Denda::where('status', 'belum_dibayar')->count();

        // Data peminjaman per minggu
        $peminjaman = Peminjaman::select(
            DB::raw('YEARWEEK(created_at) as minggu'),
            DB::raw('COUNT(*) as total')
        )
            ->groupBy('minggu')
            ->orderBy('minggu', 'asc')
            ->limit(6)
            ->get();

        // Data pengembalian per minggu
        $pengembalian = Pengembalian::select(
            DB::raw('YEARWEEK(created_at) as minggu'),
            DB::raw('COUNT(*) as total')
        )
            ->groupBy('minggu')
            ->orderBy('minggu', 'asc')
            ->limit(6)
            ->get();

        // Label minggu konsisten
        $labels             = [];
        $jumlahPeminjaman   = [];
        $jumlahPengembalian = [];

        $allWeeks = $peminjaman->pluck('minggu')->merge($pengembalian->pluck('minggu'))->unique()->sort();

        foreach ($allWeeks as $week) {
            $labels[]             = "Minggu " . $week;
            $jumlahPeminjaman[]   = $peminjaman->firstWhere('minggu', $week)->total ?? 0;
            $jumlahPengembalian[] = $pengembalian->firstWhere('minggu', $week)->total ?? 0;
        }

        // Data Bar Chart: Jumlah Buku per Kategori
        $labelsKategori     = Kategori::pluck('nama_kategori')->toArray();
        $jumlahBukuKategori = Kategori::withCount('buku')->pluck('buku_count')->toArray();

        return view('admin.dashboard', compact(
            'totalBuku',
            'totalKategori',
            'totalRak',
            'totalUser',
            'totalPeminjaman',
            'totalPengembalian',
            'totalDenda',
            'labels',
            'jumlahPeminjaman',
            'jumlahPengembalian',
            'labelsKategori',
            'jumlahBukuKategori'
        ));
    }
}