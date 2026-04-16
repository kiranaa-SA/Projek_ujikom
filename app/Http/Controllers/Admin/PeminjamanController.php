<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\PeminjamanNotification;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::with('user', 'buku')->latest()->get();
        return view('admin.peminjamans.index', compact('peminjamans'));
    }

    public function create()
    {
        $users = User::all();
        $bukus = Buku::where('stok', '>', 0)->get();
        return view('admin.peminjamans.create', compact('users', 'bukus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id'        => 'required|exists:users,id',
            'buku_id'        => 'required|exists:bukus,id',
            'tanggal_pinjam' => 'required|date',
        ]);

        $buku = Buku::findOrFail($request->buku_id);

        if ($buku->stok <= 0) {
            return back()->with('error', 'Stok buku habis.');
        }

        $tanggalPinjam = Carbon::parse($request->tanggal_pinjam);

        $peminjaman = Peminjaman::create([
            'user_id'        => $request->user_id,
            'buku_id'        => $request->buku_id,
            'tanggal_pinjam' => $tanggalPinjam,
            'tenggat_tempo'  => $tanggalPinjam->copy()->addDays(7),
            'status'         => 'pending',
            'jumlah_perpanjang' => 0,
            'status_perpanjang' => null,
        ]);

        $admins = User::whereIn('role', ['admin', 'petugas'])->get();

        foreach ($admins as $admin) {
            PeminjamanNotification::updateOrCreate(
                [
                    'user_id' => $admin->id,
                    'peminjaman_id' => $peminjaman->id,
                    'type' => 'pinjam'
                ],
                [
                    'is_read' => false
                ]
            );
        }

        return redirect()->route('admin.peminjamans.index')
            ->with('success', 'Peminjaman berhasil ditambahkan.');
    }

    public function show($id)
    {
        $peminjaman = Peminjaman::with('user', 'buku')->findOrFail($id);
        return view('admin.peminjamans.show', compact('peminjaman'));
    }

    public function accept($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        if ($peminjaman->status !== 'pending') {
            return back()->with('error', 'Tidak bisa di-ACC.');
        }

        if ($peminjaman->buku->stok <= 0) {
            return back()->with('error', 'Stok habis.');
        }

        $peminjaman->update(['status' => 'dipinjam']);
        $peminjaman->buku->decrement('stok');

        PeminjamanNotification::where('peminjaman_id', $peminjaman->id)
            ->where('type', 'pinjam')
            ->delete();

        return back()->with('success', 'Peminjaman di-ACC.');
    }

    public function reject($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        if ($peminjaman->status !== 'pending') {
            return back()->with('error', 'Tidak bisa ditolak.');
        }

        $peminjaman->update(['status' => 'ditolak']);

        PeminjamanNotification::where('peminjaman_id', $peminjaman->id)
            ->where('type', 'pinjam')
            ->delete();

        return back()->with('success', 'Peminjaman ditolak.');
    }

    public function return($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        if ($peminjaman->status !== 'dipinjam') {
            return back()->with('error', 'Tidak valid.');
        }

        $peminjaman->update(['status' => 'dikembalikan']);
        $peminjaman->buku->increment('stok');

        return back()->with('success', 'Buku dikembalikan.');
    }

    public function perpanjang($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        if ($peminjaman->status_perpanjang !== 'menunggu') {
            return back()->with('error', 'Tidak ada request perpanjang.');
        }

        if ($peminjaman->jumlah_perpanjang >= 2) {
            return back()->with('error', 'Batas maksimal tercapai.');
        }

        $peminjaman->update([
            'tenggat_tempo' => Carbon::parse($peminjaman->tenggat_tempo)->addDays(7),
            'jumlah_perpanjang' => $peminjaman->jumlah_perpanjang + 1,
            'status_perpanjang' => null
        ]);

        PeminjamanNotification::where('peminjaman_id', $peminjaman->id)
            ->where('type', 'perpanjang')
            ->delete();

        return back()->with('success', 'Perpanjang disetujui.');
    }

    public function tolakPerpanjang($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        $peminjaman->update([
            'status_perpanjang' => 'ditolak'
        ]);

        PeminjamanNotification::where('peminjaman_id', $peminjaman->id)
            ->where('type', 'perpanjang')
            ->delete();

        return back()->with('success', 'Request ditolak.');
    }

    // ✅ TAMBAHAN INI (FIX ERROR DELETE)
    public function destroy($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        // kalau masih dipinjam, balikin stok
        if ($peminjaman->status === 'dipinjam') {
            $peminjaman->buku->increment('stok');
        }

        $peminjaman->delete();

        return back()->with('success', 'Data peminjaman berhasil dihapus.');
    }
}