<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Denda;
use App\Models\Kategori;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\Rak;
use App\Models\Userr;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalBuku'         => Buku::count(),
            'totalKategori'     => Kategori::count(),
            'totalRak'          => Rak::count(),
            'totalUser'         => Userr::count(),
            'totalPeminjaman'   => Peminjaman::count(),
            'totalPengembalian' => Pengembalian::count(),
            'totalDenda'        => Denda::where('status', 'belum_dibayar')->count(),
            'bulan'             => ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            'jumlahPeminjaman'  => [5, 7, 3, 8, 6, 4, 9, 10, 2, 6, 7, 5], // contoh dummy
        ]);
    }
}