<?php
namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Denda;
use App\Models\Pengembalian;
use Illuminate\Http\Request;

class DendaController extends Controller
{
    // =========================
    // LIST DENDA
    // =========================
    public function index()
    {
        $dendas = Denda::with('pengembalian.peminjaman.user', 'pengembalian.peminjaman.buku')
            ->latest()
            ->get();

        return view('petugas.dendas.index', compact('dendas'));
    }

    // =========================
    // FORM CREATE
    // =========================
    public function create()
    {
        $pengembalians = Pengembalian::with('peminjaman.user', 'peminjaman.buku')
            ->whereDoesntHave('denda')
            ->latest()
            ->get();

        return view('petugas.dendas.create', compact('pengembalians'));
    }

    // =========================
    // STORE
    // =========================
    public function store(Request $request)
    {
        $request->validate([
            'pengembalian_id' => 'required|exists:pengembalians,id',
            'status'          => 'required|in:belum_dibayar,lunas',
        ]);

        Denda::create([
            'pengembalian_id' => $request->pengembalian_id,
            'status'          => $request->status,
        ]);

        return redirect()->route('petugas.dendas.index')
            ->with('success', 'Denda berhasil ditambahkan.');
    }

    // =========================
    // SHOW
    // =========================
    public function show(Denda $denda)
    {
        $denda->load('pengembalian.peminjaman.user', 'pengembalian.peminjaman.buku');

        return view('petugas.dendas.show', compact('denda'));
    }

    // =========================
    // EDIT
    // =========================
    public function edit(Denda $denda)
    {
        $pengembalians = Pengembalian::with('peminjaman.user', 'peminjaman.buku')
            ->whereDoesntHave('denda')
            ->orWhere('id', $denda->pengembalian_id)
            ->get();

        return view('petugas.dendas.edit', compact('denda', 'pengembalians'));
    }

    // =========================
    // UPDATE
    // =========================
    public function update(Request $request, Denda $denda)
    {
        $request->validate([
            'pengembalian_id' => 'required|exists:pengembalians,id',
            'status'          => 'required|in:belum_dibayar,lunas',
        ]);

        $denda->update([
            'pengembalian_id' => $request->pengembalian_id,
            'status'          => $request->status,
        ]);

        return redirect()->route('petugas.dendas.index')
            ->with('success', 'Denda berhasil diupdate.');
    }

    // =========================
    // DELETE
    // =========================
    public function destroy(Denda $denda)
    {
        $denda->delete();

        return redirect()->route('petugas.dendas.index')
            ->with('success', 'Denda berhasil dihapus.');
    }
}