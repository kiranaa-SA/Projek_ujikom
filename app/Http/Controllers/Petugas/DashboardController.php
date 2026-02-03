<?php
namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // --- Statistik utama ---
        $totalBuku            = Buku::count();
        $totalUser            = User::count();
        $totalPeminjamanAktif = Peminjaman::where('status', 'dipinjam')->count();
        $totalPengembalian    = Pengembalian::count();

        // --- Data untuk grafik ---
        // ambil 7 hari terakhir
        $dates  = collect(range(6, 0))->map(fn($i) => Carbon::now()->subDays($i)->toDateString());
        $labels = $dates->map(fn($d) => Carbon::parse($d)->format('d M'))->toArray();

        // hitung jumlah peminjaman dan pengembalian per tanggal
        $jumlahPeminjaman = $dates->map(fn($d) =>
            Peminjaman::whereDate('tanggal_pinjam', $d)->count()
        )->toArray();

        $jumlahPengembalian = $dates->map(fn($d) =>
            Pengembalian::whereDate('tanggal_pengembalian', $d)->count()
        )->toArray();

        // kirim ke view
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