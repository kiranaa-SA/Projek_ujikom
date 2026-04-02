<?php
namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // =========================
        // Statistik utama
        // =========================
        $totalBuku            = Buku::count();
        $totalUser            = User::count();
        $totalPeminjamanAktif = Peminjaman::where('status', 'dipinjam')->count();
        $totalPengembalian    = Pengembalian::count();

        // =========================
        // Data Peminjaman per Minggu
        // =========================
        $peminjaman = Peminjaman::select(
            DB::raw('YEARWEEK(created_at) as minggu'),
            DB::raw('COUNT(*) as total')
        )
            ->groupBy('minggu')
            ->orderBy('minggu', 'asc')
            ->limit(6)
            ->get();

        // =========================
        // Data Pengembalian per Minggu
        // =========================
        $pengembalian = Pengembalian::select(
            DB::raw('YEARWEEK(created_at) as minggu'),
            DB::raw('COUNT(*) as total')
        )
            ->groupBy('minggu')
            ->orderBy('minggu', 'asc')
            ->limit(6)
            ->get();

        // =========================
        // Label minggu konsisten
        // =========================
        $labels             = [];
        $jumlahPeminjaman   = [];
        $jumlahPengembalian = [];

        $allWeeks = $peminjaman->pluck('minggu')
            ->merge($pengembalian->pluck('minggu'))
            ->unique()
            ->sort();

        foreach ($allWeeks as $week) {
            $labels[]             = "Minggu " . $week;
            $jumlahPeminjaman[]   = $peminjaman->firstWhere('minggu', $week)->total ?? 0;
            $jumlahPengembalian[] = $pengembalian->firstWhere('minggu', $week)->total ?? 0;
        }

        // =========================
        // Kirim ke view
        // =========================
        return view('petugas.dashboard', compact(
            'totalBuku',
            'totalUser',
            'totalPeminjamanAktif',
            'totalPengembalian',
            'labels',
            'jumlahPeminjaman',
            'jumlahPengembalian'
        ));
    }
}