<?php
namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    public function index()
    {
        $pengembalians = Pengembalian::with('peminjaman.user', 'peminjaman.buku')->get();
        return view('petugas.pengembalians.index', compact('pengembalians'));
    }

    public function create()
    {
        $peminjamans = Peminjaman::all();
        return view('petugas.pengembalians.create', compact('peminjamans'));
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
        $terlambat      = 0;
        if ($tanggalKembali > $jatuhTempo) {
            $terlambat = $tanggalKembali->diff($jatuhTempo)->days;
        }

        // hitung denda otomatis
        if ($request->kondisi == 'hilang') {
            $denda = 50000; // hilang langsung 50rb
        } else {
            $denda = $terlambat * 5000; // denda keterlambatan
            if ($request->kondisi == 'rusak') {
                $denda += 10000; // tambahan rusak
            }
        }

        Pengembalian::create([
            'peminjaman_id'        => $request->peminjaman_id,
            'tanggal_pengembalian' => $request->tanggal_pengembalian,
            'terlambat'            => $terlambat,
            'kondisi'              => $request->kondisi,
            'denda'                => $denda,
        ]);

        return redirect()->route('petugas.pengembalians.index')
            ->with('success', 'Data pengembalian berhasil ditambahkan');
    }

    public function show(Pengembalian $pengembalian)
    {
        $pengembalian->load('peminjaman.user', 'peminjaman.buku');
        return view('petugas.pengembalians.show', compact('pengembalian'));
    }

    public function edit(Pengembalian $pengembalian)
    {
        $peminjamans = Peminjaman::all();
        return view('petugas.pengembalians.edit', compact('pengembalian', 'peminjamans'));
    }

    public function update(Request $request, Pengembalian $pengembalian)
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
        $terlambat      = 0;
        if ($tanggalKembali > $jatuhTempo) {
            $terlambat = $tanggalKembali->diff($jatuhTempo)->days;
        }

        // hitung denda otomatis
        if ($request->kondisi == 'hilang') {
            $denda = 50000;
        } else {
            $denda = $terlambat * 5000;
            if ($request->kondisi == 'rusak') {
                $denda += 10000;
            }
        }

        $pengembalian->update([
            'peminjaman_id'        => $request->peminjaman_id,
            'tanggal_pengembalian' => $request->tanggal_pengembalian,
            'terlambat'            => $terlambat,
            'kondisi'              => $request->kondisi,
            'denda'                => $denda,
        ]);

        return redirect()->route('petugas.pengembalians.index')
            ->with('success', 'Data pengembalian berhasil diperbarui');
    }

    public function destroy(Pengembalian $pengembalian)
    {
        $pengembalian->delete();
        return redirect()->route('petugas.pengembalians.index')
            ->with('success', 'Data pengembalian berhasil dihapus');
    }
}