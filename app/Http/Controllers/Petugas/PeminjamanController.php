<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\PeminjamanNotification;
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

        return view('petugas.peminjamans.index', compact('peminjamans'));
    }

    // =========================
    // FORM CREATE
    // =========================
    public function create()
    {
        $users = User::all();
        $bukus = Buku::where('stok', '>', 0)->get();

        return view('petugas.peminjamans.create', compact('users', 'bukus'));
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

        $tanggalPinjam = Carbon::parse($request->tanggal_pinjam);

        $peminjaman = Peminjaman::create([
            'user_id'            => $request->user_id,
            'buku_id'            => $request->buku_id,
            'tanggal_pinjam'     => $tanggalPinjam,
            'tenggat_tempo'      => $tanggalPinjam->copy()->addDays(7),
            'status'             => 'pending',
            'jumlah_perpanjang'  => 0,
            'status_perpanjang'  => null,
        ]);

        PeminjamanNotification::updateOrCreate(
            [
                'user_id' => null,
                'peminjaman_id' => $peminjaman->id,
                'type' => 'pinjam',
            ],
            [
                'is_read' => false,
            ]
        );

        $buku->decrement('stok');

        return redirect()->route('petugas.peminjamans.index')
            ->with('success', 'Peminjaman berhasil ditambahkan.');
    }

    // =========================
    // ACCEPT
    // =========================
    public function accept($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        if ($peminjaman->status !== 'pending') {
            return back()->with('error', 'Tidak bisa di-ACC.');
        }

        if ($peminjaman->buku->stok <= 0) {
            return back()->with('error', 'Stok habis.');
        }

        $peminjaman->update([
            'status' => 'dipinjam',
        ]);

        $peminjaman->buku->decrement('stok');

        PeminjamanNotification::where('peminjaman_id', $peminjaman->id)
            ->where('type', 'pinjam')
            ->delete();

        return back()->with('success', 'Peminjaman berhasil disetujui.');
    }

    // =========================
    // REJECT
    // =========================
    public function reject($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        $peminjaman->update([
            'status' => 'ditolak',
        ]);

        PeminjamanNotification::where('peminjaman_id', $peminjaman->id)
            ->where('type', 'pinjam')
            ->delete();

        return back()->with('success', 'Peminjaman berhasil ditolak.');
    }

    // =========================
    // 🔥 PERPANJANG APPROVE (BARU)
    // =========================
    public function perpanjang($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        // max 1x
        if ($peminjaman->jumlah_perpanjang >= 1) {
            return back()->with('error', 'Sudah maksimal perpanjangan.');
        }

        $peminjaman->jumlah_perpanjang += 1;
        $peminjaman->status_perpanjang = 'approved';

        $peminjaman->tenggat_tempo = Carbon::parse($peminjaman->tenggat_tempo)
            ->addDays(7);

        $peminjaman->save();

        return back()->with('success', 'Perpanjangan disetujui.');
    }

    // =========================
    // 🔥 TOLAK PERPANJANG (BARU)
    // =========================
    public function tolakPerpanjang($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        $peminjaman->status_perpanjang = 'rejected';
        $peminjaman->save();

        return back()->with('success', 'Perpanjangan ditolak.');
    }

    // =========================
    // SHOW
    // =========================
    public function show($id)
    {
        $peminjaman = Peminjaman::with('user', 'buku')
            ->findOrFail($id);

        return view('petugas.peminjamans.show', compact('peminjaman'));
    }

    // =========================
    // EDIT
    // =========================
    public function edit($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $users = User::all();
        $bukus = Buku::all();

        return view('petugas.peminjamans.edit', compact('peminjaman', 'users', 'bukus'));
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
            'status'         => 'required|in:pending,dipinjam,dikembalikan,ditolak',
        ]);

        $peminjaman = Peminjaman::findOrFail($id);

        $peminjaman->update($request->all());

        return redirect()->route('petugas.peminjamans.index')
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

        return redirect()->route('petugas.peminjamans.index')
            ->with('success', 'Peminjaman berhasil dihapus.');
    }
}