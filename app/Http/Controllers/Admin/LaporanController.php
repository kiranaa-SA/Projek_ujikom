<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $laporans = $this->getQuery($request)->get();
        return view('admin.laporans.index', compact('laporans'));
    }

    public function exportPdf(Request $request)
    {
        $laporans = $this->getQuery($request)->get();

        // Debug sementara, hapus setelah yakin data muncul
        // dd($laporans->toArray());

        $pdf = Pdf::loadView('admin.laporans.pdf', compact('laporans'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('laporan_peminjaman_pengembalian.pdf');
    }

    // Fungsi query agar bisa dipakai di index & exportPdf
    private function getQuery(Request $request)
    {
        $query = Peminjaman::with(['buku', 'pengembalian']);

        // Filter tanggal pinjam
        if ($request->filled('tanggal')) {
            // Pastikan format YYYY-MM-DD
            $query->whereDate('tanggal_pinjam', $request->tanggal);
        }

        // Filter kondisi buku dari pengembalian
        if ($request->filled('kondisi')) {
            $query->whereHas('pengembalian', function ($q) use ($request) {
                $q->where('kondisi', $request->kondisi);
            });
        }

        return $query;
    }
}