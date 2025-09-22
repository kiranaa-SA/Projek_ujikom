<?php
namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Denda;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik utama
        $totalBuku         = Buku::count();
        $totalPeminjaman   = Peminjaman::where('status', 'dipinjam')->count();
        $totalPengembalian = Pengembalian::count();
        $totalDenda        = Denda::where('status', 'belum_dibayar')->count();

        // 6 minggu terakhir
        $currentWeek = Carbon::now()->weekOfYear;
        $weeks       = collect(range($currentWeek - 5, $currentWeek));

        // Ambil data per minggu
        $peminjaman = Peminjaman::select(
            DB::raw('WEEK(created_at, 1) as minggu'),
            DB::raw('COUNT(*) as total')
        )
            ->whereBetween(DB::raw('WEEK(created_at,1)'), [$currentWeek - 5, $currentWeek])
            ->groupBy('minggu')
            ->pluck('total', 'minggu');

        $pengembalian = Pengembalian::select(
            DB::raw('WEEK(tanggal_pengembalian, 1) as minggu'),
            DB::raw('COUNT(*) as total')
        )
            ->whereBetween(DB::raw('WEEK(tanggal_pengembalian,1)'), [$currentWeek - 5, $currentWeek])
            ->groupBy('minggu')
            ->pluck('total', 'minggu');

        $denda = Denda::select(
            DB::raw('WEEK(created_at, 1) as minggu'),
            DB::raw('COUNT(*) as total')
        )
            ->where('status', 'belum_dibayar')
            ->whereBetween(DB::raw('WEEK(created_at,1)'), [$currentWeek - 5, $currentWeek])
            ->groupBy('minggu')
            ->pluck('total', 'minggu');

        // Siapkan array untuk chart
        $labels             = [];
        $jumlahPeminjaman   = [];
        $jumlahPengembalian = [];
        $jumlahDenda        = [];

        foreach ($weeks as $week) {
            $labels[]             = "Minggu " . $week;
            $jumlahPeminjaman[]   = $peminjaman[$week] ?? 0;
            $jumlahPengembalian[] = $pengembalian[$week] ?? 0;
            $jumlahDenda[]        = $denda[$week] ?? 0;
        }

        return view('petugas.dashboard', compact(
            'totalBuku',
            'totalPeminjaman',
            'totalPengembalian',
            'totalDenda',
            'labels',
            'jumlahPeminjaman',
            'jumlahPengembalian',
            'jumlahDenda'
        ));
    }
}