<?php
namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $laporans = $this->getQuery($request)->get();
        return view('petugas.laporans.index', compact('laporans'));
    }

    public function exportPdf(Request $request)
    {
        $laporans = $this->getQuery($request)->get();

        $pdf = Pdf::loadView('petugas.laporans.pdf', compact('laporans'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('laporan_peminjaman_pengembalian_petugas.pdf');
    }

    private function getQuery(Request $request)
    {
        $query = Peminjaman::with(['buku', 'pengembalian']);

        // Filter tanggal pinjam
        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal_pinjam', $request->tanggal);
        }

        // Filter kondisi buku
        if ($request->filled('kondisi')) {
            $query->whereHas('pengembalian', function ($q) use ($request) {
                $q->where('kondisi', $request->kondisi);
            });
        }

        return $query;
    }
}