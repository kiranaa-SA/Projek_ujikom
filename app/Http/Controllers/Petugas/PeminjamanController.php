<?php
namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::with(['user', 'buku'])->get();
        return view('petugas.peminjamans.index', compact('peminjamans'));
    }

    public function create()
    {
        $users = User::all();
        $bukus = Buku::all();
        return view('petugas.peminjamans.create', compact('users', 'bukus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id'        => 'required|exists:users,id',
            'buku_id'        => 'required|exists:bukus,id',
            'tanggal_pinjam' => 'required|date',
            'status'         => 'required|in:dipinjam,dikembalikan',
        ]);

        // Hitung tenggat tempo otomatis (7 hari setelah tanggal pinjam)
        $tenggatTempo = Carbon::parse($request->tanggal_pinjam)->addDays(7);

        Peminjaman::create([
            'user_id'        => $request->user_id,
            'buku_id'        => $request->buku_id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tenggat_tempo'  => $tenggatTempo,
            'status'         => $request->status,
        ]);

        return redirect()->route('petugas.peminjamans.index')
            ->with('success', 'Data peminjaman berhasil ditambahkan');
    }

    public function show(Peminjaman $peminjaman)
    {
        $peminjaman->load(['user', 'buku']);
        return view('petugas.peminjamans.show', compact('peminjaman'));
    }

    public function edit(Peminjaman $peminjaman)
    {
        $users = User::all();
        $bukus = Buku::all();
        return view('petugas.peminjamans.edit', compact('peminjaman', 'users', 'bukus'));
    }

    public function update(Request $request, Peminjaman $peminjaman)
    {
        $request->validate([
            'user_id'        => 'required|exists:users,id',
            'buku_id'        => 'required|exists:bukus,id',
            'tanggal_pinjam' => 'required|date',
            'status'         => 'required|in:dipinjam,dikembalikan',
        ]);

        $tenggatTempo = Carbon::parse($request->tanggal_pinjam)->addDays(7);

        $peminjaman->update([
            'user_id'        => $request->user_id,
            'buku_id'        => $request->buku_id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tenggat_tempo'  => $tenggatTempo,
            'status'         => $request->status,
        ]);

        return redirect()->route('petugas.peminjamans.index')
            ->with('success', 'Data peminjaman berhasil diperbarui');
    }

    public function destroy(Peminjaman $peminjaman)
    {
        $peminjaman->delete();
        return redirect()->route('petugas.peminjamans.index')
            ->with('success', 'Data peminjaman berhasil dihapus');
    }
}