<?php
namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Peminjaman;
use App\Models\PeminjamanNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class KeranjangController extends Controller
{
    // =========================
    // TAMPILKAN KERANJANG
    // =========================
    public function index()
    {
        $items = Keranjang::where('user_id', Auth::id())
            ->with('buku')
            ->get();

        return view('layouts.component-frontend.keranjang.index', compact('items'));
    }

    // =========================
    // TAMBAH KE KERANJANG
    // =========================
    public function store($buku_id)
    {
        $exists = Keranjang::where('user_id', Auth::id())
            ->where('buku_id', $buku_id)
            ->exists();

        if ($exists) {
            return back()->with('warning', 'Buku sudah ada di keranjang');
        }

        Keranjang::create([
            'user_id' => Auth::id(),
            'buku_id' => $buku_id,
        ]);

        return back()->with('success', 'Buku ditambahkan ke keranjang');
    }

    // =========================
    // HAPUS DARI KERANJANG
    // =========================
    public function destroy($id)
    {
        Keranjang::where('id', $id)
            ->where('user_id', Auth::id())
            ->delete();

        return back()->with('success', 'Buku dihapus dari keranjang');
    }

    // =========================
    // AJUKAN PEMINJAMAN
    // =========================
    public function pinjam(Request $request)
    {
        // ✅ VALIDASI (INI WAJIB BIAR GA DIAM-DIAM GAGAL)
        $request->validate([
            'keranjang_ids' => 'required|array|min:1',
        ], [
            'keranjang_ids.required' => 'Pilih minimal satu buku',
        ]);

        $keranjangIds = $request->keranjang_ids;

        $items = Keranjang::where('user_id', Auth::id())
            ->whereIn('id', $keranjangIds)
            ->get();

        foreach ($items as $item) {
            $peminjaman = Peminjaman::create([
                'kode_peminjaman' => 'PMJ-' . now()->format('Ymd') . '-' . strtoupper(Str::random(4)),
                'user_id'         => Auth::id(),
                'buku_id'         => $item->buku_id,
                'tanggal_pinjam'  => now()->toDateString(),
                'tenggat_tempo'   => now()->addDays(7)->toDateString(),
                'status'          => 'pending',
            ]);

            PeminjamanNotification::create([
                'peminjaman_id' => $peminjaman->id,
                'is_read'       => false,
            ]);
        }

        // ✅ HAPUS YANG DIPINJAM AJA
        Keranjang::whereIn('id', $keranjangIds)->delete();

        return redirect()->route('riwayat.index')
            ->with('success', 'Peminjaman berhasil diajukan');
    }
}