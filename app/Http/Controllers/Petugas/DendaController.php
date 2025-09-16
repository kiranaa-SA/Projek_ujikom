<?php
namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Denda;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class DendaController extends Controller
{
    public function index()
    {
        $dendas = Denda::with('pengembalian.peminjaman.user', 'pengembalian.peminjaman.buku')->get();
        return view('petugas.dendas.index', compact('dendas'));
    }

    public function create()
    {
        $peminjamans = Peminjaman::with('user', 'buku')->get();
        return view('petugas.dendas.create', compact('peminjamans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'peminjaman_id' => 'required|exists:peminjamans,id',
            'kondisi_buku'  => 'required|in:baik,rusak',
            'status'        => 'required|in:belum_dibayar,lunas',
        ]);

        Denda::create([
            'pengembalian_id' => $request->peminjaman_id, // pastikan sesuai relasi
            'kondisi_buku'    => $request->kondisi_buku,
            'status'          => $request->status,
        ]);

        return redirect()->route('petugas.dendas.index')->with('success', 'Denda berhasil ditambahkan.');
    }

    public function show(Denda $denda)
    {
        $denda->load('pengembalian.peminjaman.user', 'pengembalian.peminjaman.buku');
        return view('petugas.dendas.show', compact('denda'));
    }

    public function edit(Denda $denda)
    {
        $peminjamans = Peminjaman::with('user', 'buku')->get();
        return view('petugas.dendas.edit', compact('denda', 'peminjamans'));
    }

    public function update(Request $request, Denda $denda)
    {
        $request->validate([
            'peminjaman_id' => 'required|exists:peminjamans,id',
            'kondisi_buku'  => 'required|in:baik,rusak',
            'status'        => 'required|in:belum_dibayar,lunas',
        ]);

        $denda->update([
            'pengembalian_id' => $request->peminjaman_id,
            'kondisi_buku'    => $request->kondisi_buku,
            'status'          => $request->status,
        ]);

        return redirect()->route('petugas.dendas.index')->with('success', 'Denda berhasil diupdate.');
    }

    public function destroy(Denda $denda)
    {
        $denda->delete();
        return redirect()->route('petugas.dendas.index')->with('success', 'Denda berhasil dihapus.');
    }
}