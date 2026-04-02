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

        $lastId = Peminjaman::max('id') ?? 0;
        $kode   = 'PMJ-' . str_pad($lastId + 1, 4, '0', STR_PAD_LEFT);

        $tanggalPinjam = Carbon::parse($request->tanggal_pinjam);
        $tenggat       = $tanggalPinjam->copy()->addDays(7);

        Peminjaman::create([
            'kode_peminjaman' => $kode,
            'user_id'         => $request->user_id,
            'buku_id'         => $request->buku_id,
            'tanggal_pinjam'  => $tanggalPinjam,
            'tenggat_tempo'   => $tenggat,
            'status'          => 'dipinjam',
        ]);

        $buku->decrement('stok');

        return redirect()->route('petugas.peminjamans.index')
            ->with('success', 'Peminjaman berhasil ditambahkan.');
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
        $users      = User::all();
        $bukus      = Buku::all();

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
            'status'         => 'required|in:dipinjam,dikembalikan,ditolak',
        ]);

        $peminjaman = Peminjaman::findOrFail($id);

        $peminjaman->update([
            'user_id'        => $request->user_id,
            'buku_id'        => $request->buku_id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tenggat_tempo'  => $request->tenggat_tempo,
            'status'         => $request->status,
        ]);

        return redirect()->route('petugas.peminjamans.index')
            ->with('success', 'Peminjaman berhasil diperbarui.');
    }

    // =========================
    // ACCEPT
    // =========================
    public function accept($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        $peminjaman->update([
            'status' => 'dipinjam',
        ]);

        return redirect()->back()
            ->with('success', 'Peminjaman berhasil disetujui.');
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

        return redirect()->back()
            ->with('success', 'Peminjaman berhasil ditolak.');
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