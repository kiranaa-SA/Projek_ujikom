<?php
namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    // =========================
    // INDEX
    // =========================
    public function index()
    {
        $pengembalians = Pengembalian::with('peminjaman.user', 'peminjaman.buku')
            ->latest()
            ->get();

        return view('petugas.pengembalians.index', compact('pengembalians'));
    }

    // =========================
    // CREATE
    // =========================
    public function create()
    {
        $peminjamans = Peminjaman::where('status', 'dipinjam')
            ->with('user', 'buku')
            ->get();

        return view('petugas.pengembalians.create', compact('peminjamans'));
    }

    // =========================
    // STORE
    // =========================
    public function store(Request $request)
    {
        $request->validate([
            'peminjaman_id'        => 'required|exists:peminjamans,id',
            'tanggal_pengembalian' => 'required|date',
            'kondisi'              => 'required|in:baik,rusak,hilang',
        ]);

        $peminjaman = Peminjaman::with('buku', 'user')
            ->findOrFail($request->peminjaman_id);

        $lastId            = Pengembalian::max('id') ?? 0;
        $kode_pengembalian = 'KMB-' . str_pad($lastId + 1, 4, '0', STR_PAD_LEFT);

        $tanggalKembali = Carbon::parse($request->tanggal_pengembalian);
        $jatuhTempo     = Carbon::parse($peminjaman->tenggat_tempo);

        // Anti minus
        if ($tanggalKembali->gt($jatuhTempo)) {
            $terlambat = $jatuhTempo->diffInDays($tanggalKembali);
        } else {
            $terlambat = 0;
        }

        // Hitung denda kombinasi
        $dendaTerlambat = $terlambat * 5000;

        $dendaKondisi = match ($request->kondisi) {
            'rusak'  => 35000,
            'hilang' => 50000,
            default  => 0,
        };

        $denda = $dendaTerlambat + $dendaKondisi;

        $pengembalian = Pengembalian::create([
            'kode_pengembalian'    => $kode_pengembalian,
            'peminjaman_id'        => $peminjaman->id,
            'tanggal_pengembalian' => $request->tanggal_pengembalian,
            'terlambat'            => $terlambat,
            'kondisi'              => $request->kondisi,
            'denda'                => $denda,
        ]);

        // Update status peminjaman
        $peminjaman->update([
            'status' => 'dikembalikan',
        ]);

        // Tambah stok jika tidak hilang
        if ($request->kondisi !== 'hilang') {
            $peminjaman->buku->increment('stok');
        }

        // Simpan laporan
        Laporan::create([
            'peminjaman_id'   => $peminjaman->id,
            'pengembalian_id' => $pengembalian->id,
            'kondisi_buku'    => $request->kondisi,
            'tanggal'         => $request->tanggal_pengembalian,
        ]);

        return redirect()->route('petugas.pengembalians.index')
            ->with('success', 'Pengembalian berhasil ditambahkan. Denda: Rp ' . number_format($denda, 0, ',', '.'));
    }

    // =========================
    // SHOW
    // =========================
    public function show($id)
    {
        $pengembalian = Pengembalian::with('peminjaman.user', 'peminjaman.buku')
            ->findOrFail($id);

        return view('petugas.pengembalians.show', compact('pengembalian'));
    }

    // =========================
    // EDIT
    // =========================
    public function edit($id)
    {
        $pengembalian = Pengembalian::with('peminjaman.user', 'peminjaman.buku')
            ->findOrFail($id);

        $peminjamans = Peminjaman::with('user', 'buku')->get();

        return view('petugas.pengembalians.edit', compact('pengembalian', 'peminjamans'));
    }

    // =========================
    // UPDATE
    // =========================
    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal_pengembalian' => 'required|date',
            'kondisi'              => 'required|in:baik,rusak,hilang',
        ]);

        $pengembalian = Pengembalian::findOrFail($id);
        $peminjaman   = $pengembalian->peminjaman;

        $tanggalKembali = Carbon::parse($request->tanggal_pengembalian);
        $jatuhTempo     = Carbon::parse($peminjaman->tenggat_tempo);

        if ($tanggalKembali->gt($jatuhTempo)) {
            $terlambat = $jatuhTempo->diffInDays($tanggalKembali);
        } else {
            $terlambat = 0;
        }

        $dendaTerlambat = $terlambat * 5000;

        $dendaKondisi = match ($request->kondisi) {
            'rusak'  => 35000,
            'hilang' => 50000,
            default  => 0,
        };

        $denda = $dendaTerlambat + $dendaKondisi;

        $pengembalian->update([
            'tanggal_pengembalian' => $request->tanggal_pengembalian,
            'kondisi'              => $request->kondisi,
            'terlambat'            => $terlambat,
            'denda'                => $denda,
        ]);

        $peminjaman->update([
            'status' => 'dikembalikan',
        ]);

        return redirect()->route('petugas.pengembalians.index')
            ->with('success', 'Pengembalian berhasil diperbarui. Denda: Rp ' . number_format($denda, 0, ',', '.'));
    }

    // =========================
    // DELETE
    // =========================
    public function destroy($id)
    {
        $pengembalian = Pengembalian::findOrFail($id);
        $pengembalian->delete();

        return redirect()->route('petugas.pengembalians.index')
            ->with('success', 'Pengembalian berhasil dihapus');
    }
}