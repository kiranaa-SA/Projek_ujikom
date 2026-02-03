<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Denda;
use App\Models\Pengembalian;
use Illuminate\Http\Request;

class DendaController extends Controller
{
    public function index()
    {
        $dendas = Denda::with('pengembalian.peminjaman.user', 'pengembalian.peminjaman.buku')->get();
        return view('admin.dendas.index', compact('dendas'));
    }

    public function create()
    {
        // Ambil data pengembalian (karena denda terkait pengembalian)
        $pengembalians = Pengembalian::with('peminjaman.user', 'peminjaman.buku')->get();
        return view('admin.dendas.create', compact('pengembalians'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pengembalian_id' => 'required|exists:pengembalians,id',
            'kondisi_buku'    => 'required|in:baik,rusak',
            'status'          => 'required|in:belum_dibayar,lunas',
        ]);

        Denda::create([
            'pengembalian_id' => $request->pengembalian_id,
            'kondisi_buku'    => $request->kondisi_buku,
            'status'          => $request->status,
        ]);

        return redirect()->route('admin.dendas.index')->with('success', 'Denda berhasil ditambahkan.');
    }

    public function show(Denda $denda)
    {
        $denda->load('pengembalian.peminjaman.user', 'pengembalian.peminjaman.buku');
        return view('admin.dendas.show', compact('denda'));
    }

    public function edit(Denda $denda)
    {
        $pengembalians = Pengembalian::with('peminjaman.user', 'peminjaman.buku')->get();
        return view('admin.dendas.edit', compact('denda', 'pengembalians'));
    }

    public function update(Request $request, Denda $denda)
    {
        $request->validate([
            'pengembalian_id' => 'required|exists:pengembalians,id',
            'kondisi_buku'    => 'required|in:baik,rusak',
            'status'          => 'required|in:belum_dibayar,lunas',
        ]);

        $denda->update([
            'pengembalian_id' => $request->pengembalian_id,
            'kondisi_buku'    => $request->kondisi_buku,
            'status'          => $request->status,
        ]);

        return redirect()->route('admin.dendas.index')->with('success', 'Denda berhasil diupdate.');
    }

    public function destroy(Denda $denda)
    {
        $denda->delete();
        return redirect()->route('admin.dendas.index')->with('success', 'Denda berhasil dihapus.');
    }
}