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
        $peminjamans = Peminjaman::with(['user', 'buku'])->latest()->get();
        return view('admin.peminjamans.index', compact('peminjamans'));
    }

    public function create()
    {
        // hanya peminjaman yang masih dipinjam, dengan relasi user & buku
        $peminjamans = Peminjaman::with('user', 'buku')
            ->where('status', 'dipinjam')
            ->get();

        return view('admin.pengembalians.create', compact('peminjamans'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'user_id'        => 'required|exists:users,id',
                'buku_id'        => 'required|exists:bukus,id',
                'tanggal_pinjam' => 'required|date',
            ],
            [
                'user_id.required'        => 'User wajib dipilih',
                'buku_id.required'        => 'Buku wajib dipilih',
                'tanggal_pinjam.required' => 'Tanggal pinjam wajib diisi',
            ]
        );

        Peminjaman::create([
            'user_id'        => $request->user_id,
            'buku_id'        => $request->buku_id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tenggat_tempo'  => Carbon::parse($request->tanggal_pinjam)->addDays(7),
            'status'         => 'pending',
        ]);

        return redirect()
            ->route('admin.peminjamans.index')
            ->with('success', 'Peminjaman berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $bukus      = Buku::all();
        $users      = User::all();

        return view('admin.peminjamans.edit', compact('peminjaman', 'bukus', 'users'));
    }

    public function update(Request $request, $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        $request->validate([
            'status' => 'required|in:pending,dipinjam,ditolak,dikembalikan',
        ]);

        $peminjaman->update([
            'status' => $request->status,
        ]);

        return redirect()
            ->route('admin.peminjamans.index')
            ->with('success', 'Data peminjaman berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $peminjaman = Peminjaman::with('buku')->findOrFail($id);

        if ($peminjaman->status === 'dipinjam') {
            $peminjaman->buku->increment('stok');
        }

        PeminjamanNotification::where('peminjaman_id', $peminjaman->id)->delete();
        $peminjaman->delete();

        return redirect()
            ->route('admin.peminjamans.index')
            ->with('success', 'Data peminjaman berhasil dihapus.');
    }

    // ✅ ACC
    public function accept($id)
    {
        $peminjaman = Peminjaman::with('buku')->findOrFail($id);

        if ($peminjaman->buku->stok < 1) {
            return back()->with('error', 'Stok buku habis.');
        }

        $peminjaman->update([
            'status'         => 'dipinjam',
            'tanggal_pinjam' => Carbon::now(),
            'tenggat_tempo'  => Carbon::now()->addDays(7),
        ]);

        $peminjaman->buku->decrement('stok');
        PeminjamanNotification::where('peminjaman_id', $peminjaman->id)->delete();

        return redirect()
            ->route('admin.peminjamans.index')
            ->with('success', 'Peminjaman telah disetujui.');
    }

    // ❌ Reject
    public function reject($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        $peminjaman->update(['status' => 'ditolak']);
        PeminjamanNotification::where('peminjaman_id', $peminjaman->id)->delete();

        return redirect()
            ->route('admin.peminjamans.index')
            ->with('success', 'Peminjaman telah ditolak.');
    }

    // 🔁 Kembali
    public function kembali($id)
    {
        $peminjaman = Peminjaman::with('buku')->findOrFail($id);

        if ($peminjaman->status === 'dipinjam') {
            $peminjaman->update(['status' => 'dikembalikan']);
            $peminjaman->buku->increment('stok');
        }

        return redirect()
            ->route('admin.peminjamans.index')
            ->with('success', 'Buku berhasil dikembalikan.');
    }
}