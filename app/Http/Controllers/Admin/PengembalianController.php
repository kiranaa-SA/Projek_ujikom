<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    public function index()
    {
        $pengembalians = Pengembalian::with('peminjaman.user', 'peminjaman.buku')->get();
        return view('admin.pengembalians.index', compact('pengembalians'));
    }

    public function create()
    {
        $peminjamans = Peminjaman::all();
        return view('admin.pengembalians.create', compact('peminjamans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'peminjaman_id'        => 'required|exists:peminjamans,id',
            'tanggal_pengembalian' => 'required|date',
            'kondisi'              => 'required|in:baik,rusak,hilang',
        ]);

        $peminjaman = Peminjaman::findOrFail($request->peminjaman_id);

        // hitung keterlambatan
        $tanggalKembali = new \DateTime($request->tanggal_pengembalian);
        $jatuhTempo     = new \DateTime($peminjaman->tenggat_tempo);
        $terlambat      = $tanggalKembali > $jatuhTempo ? $tanggalKembali->diff($jatuhTempo)->days : 0;

        // hitung denda otomatis
        if ($request->kondisi == 'hilang') {
            $denda = 50000;
        } else {
            $denda = $terlambat * 5000;
            if ($request->kondisi == 'rusak') {
                $denda += 10000;
            }
        }

        $pengembalian = Pengembalian::create([
            'peminjaman_id'        => $request->peminjaman_id,
            'tanggal_pengembalian' => $request->tanggal_pengembalian,
            'terlambat'            => $terlambat,
            'kondisi'              => $request->kondisi,
            'denda'                => $denda,
        ]);

        // simpan laporan otomatis
        Laporan::create([
            'peminjaman_id'   => $request->peminjaman_id,
            'pengembalian_id' => $pengembalian->id,
            'kondisi_buku'    => $request->kondisi,
            'tanggal'         => $request->tanggal_pengembalian,
        ]);

        return redirect()->route('admin.pengembalians.index')
            ->with('success', 'Data pengembalian berhasil ditambahkan');
    }

    // ===== Tambahkan method show =====
    public function show($id)
    {
        $pengembalian = Pengembalian::with('peminjaman.user', 'peminjaman.buku')->findOrFail($id);
        return view('admin.pengembalians.show', compact('pengembalian'));
    }
}