<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    // =========================
    // LIST
    // =========================
    public function index()
    {
        $peminjamans = Peminjaman::with('user', 'buku')
            ->latest()
            ->get();

        return view('admin.peminjamans.index', compact('peminjamans'));
    }

    // =========================
    // FORM CREATE
    // =========================
    public function create()
    {
        $users = User::all();
        $bukus = Buku::where('stok', '>', 0)->get();

        return view('admin.peminjamans.create', compact('users', 'bukus'));
    }

    // =========================
    // STORE
    // =========================
    public function store(Request $request)
    {
        $request->validate([
            'user_id'        => 'required|exists:users,id',
            'buku_id'        => 'required|exists:bukus,id',
            'tanggal_pinjam' => 'required|date',
        ]);

        $buku = Buku::findOrFail($request->buku_id);

        if ($buku->stok <= 0) {
            return back()->with('error', 'Stok buku habis.')->withInput();
        }

        // kode otomatis
        $lastId = Peminjaman::max('id') ?? 0;
        $kode   = 'PMJ-' . str_pad($lastId + 1, 4, '0', STR_PAD_LEFT);

        $tanggalPinjam = Carbon::parse($request->tanggal_pinjam);
        $tenggat = $tanggalPinjam->copy()->addDays(7);

        Peminjaman::create([
            'kode_peminjaman' => $kode,
            'user_id'         => $request->user_id,
            'buku_id'         => $request->buku_id,
            'tanggal_pinjam'  => $tanggalPinjam,
            'tenggat_tempo'   => $tenggat,
            'status'          => 'pending', // 🔥 default pending
        ]);

        return redirect()->route('admin.peminjamans.index')
            ->with('success', 'Peminjaman berhasil ditambahkan (menunggu ACC).');
    }

    // =========================
    // ACCEPT (ACC)
    // =========================
    public function accept($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $buku = $peminjaman->buku;

        if ($peminjaman->status !== 'pending') {
            return back()->with('error', 'Peminjaman tidak bisa di-ACC.');
        }

        if ($buku->stok <= 0) {
            return back()->with('error', 'Stok buku habis.');
        }

        // ubah status + kurangi stok
        $peminjaman->update([
            'status' => 'dipinjam'
        ]);

        $buku->decrement('stok');

        return back()->with('success', 'Peminjaman berhasil di-ACC.');
    }

    // =========================
    // RETURN (KEMBALIKAN)
    // =========================
    public function return($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $buku = $peminjaman->buku;

        if ($peminjaman->status !== 'dipinjam') {
            return back()->with('error', 'Peminjaman tidak valid.');
        }

        $peminjaman->update([
            'status' => 'dikembalikan'
        ]);

        $buku->increment('stok');

        return back()->with('success', 'Buku berhasil dikembalikan.');
    }

    // =========================
    // SHOW
    // =========================
    public function show($id)
    {
        $peminjaman = Peminjaman::with('user', 'buku')
            ->findOrFail($id);

        return view('admin.peminjamans.show', compact('peminjaman'));
    }

    // =========================
    // EDIT
    // =========================
    public function edit($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $users      = User::all();
        $bukus      = Buku::all();

        return view('admin.peminjamans.edit', compact('peminjaman', 'users', 'bukus'));
    }

    // =========================
    // UPDATE
    // =========================
    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id'        => 'required|exists:users,id',
            'buku_id'        => 'required|exists:bukus,id',
            'tanggal_pinjam' => 'required|date',
            'tenggat_tempo'  => 'required|date|after_or_equal:tanggal_pinjam',
            'status'         => 'required|in:pending,dipinjam,dikembalikan',
        ]);

        $peminjaman = Peminjaman::findOrFail($id);

        $peminjaman->update($request->all());

        return redirect()->route('admin.peminjamans.index')
            ->with('success', 'Peminjaman berhasil diperbarui.');
    }

    // =========================
    // DELETE
    // =========================
    public function destroy($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        if ($peminjaman->status === 'dipinjam') {
            $peminjaman->buku->increment('stok');
        }

        $peminjaman->delete();

        return redirect()->route('admin.peminjamans.index')
            ->with('success', 'Peminjaman berhasil dihapus.');
    }
}