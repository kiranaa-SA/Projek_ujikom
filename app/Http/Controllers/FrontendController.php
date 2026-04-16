<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\HeroBanner;
use App\Models\Kategori;
use App\Models\Peminjaman;
use App\Models\User;
use App\Models\PeminjamanNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function index()
    {
        $bukus     = Buku::with('kategori')->latest()->get();
        $kategoris = Kategori::all();
        $banners   = HeroBanner::all();

        $totalBuku         = Buku::count();
        $totalKategori     = Kategori::count();
        $totalPeminjaman   = Peminjaman::count();
        $totalPengembalian = Peminjaman::where('status', 'dikembalikan')->count();

        return view('welcome', compact(
            'bukus',
            'kategoris',
            'banners',
            'totalBuku',
            'totalKategori',
            'totalPeminjaman',
            'totalPengembalian'
        ));
    }

    public function semuaBuku(Request $request)
    {
        $kategoris   = Kategori::all();
        $kategori_id = $request->query('kategori');

        $bukus = Buku::with('kategori')
            ->when($kategori_id, function ($q) use ($kategori_id) {
                $q->where('kategori_id', $kategori_id);
            })
            ->orderBy('judul', 'asc')
            ->paginate(12);

        return view(
            'layouts.component-frontend.semua_buku.index',
            compact('bukus', 'kategoris', 'kategori_id')
        );
    }

    public function detail($id)
    {
        $buku = Buku::with('kategori')->findOrFail($id);
        return view('detail', compact('buku'));
    }

    public function pinjamBuku(Request $request, $id)
    {
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Silakan login dulu.');
        }

        $user = Auth::user();
        $buku = Buku::findOrFail($id);

        if ($buku->stok <= 0) {
            return back()->with('error', 'Stok habis.');
        }

        $cek = Peminjaman::where('user_id', $user->id)
            ->where('buku_id', $buku->id)
            ->whereIn('status', ['pending', 'dipinjam'])
            ->first();

        if ($cek) {
            return back()->with('error', 'Kamu masih punya peminjaman aktif.');
        }

        $peminjaman = Peminjaman::create([
            'user_id'            => $user->id,
            'buku_id'            => $buku->id,
            'tanggal_pinjam'     => Carbon::now(),
            'tenggat_tempo'      => Carbon::now()->addDays(7),
            'status'             => 'pending',
            'jumlah_perpanjang'  => 0,
            'status_perpanjang'  => null,
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

        return back()->with('success', 'Berhasil mengajukan peminjaman!');
    }

    public function requestPerpanjang($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $peminjaman = Peminjaman::findOrFail($id);

        if ($peminjaman->user_id != Auth::id()) {
            abort(403);
        }

        if ($peminjaman->status !== 'dipinjam') {
            return back()->with('error', 'Tidak bisa request.');
        }

        if ($peminjaman->jumlah_perpanjang >= 2) {
            return back()->with('error', 'Batas perpanjang sudah habis.');
        }

        if ($peminjaman->status_perpanjang === 'menunggu') {
            return back()->with('error', 'Kamu sudah mengajukan.');
        }

        $peminjaman->update([
            'status_perpanjang' => 'menunggu'
        ]);

        $admins = User::whereIn('role', ['admin', 'petugas'])->get();

        foreach ($admins as $admin) {

            PeminjamanNotification::updateOrCreate(
                [
                    'user_id' => $admin->id,
                    'peminjaman_id' => $peminjaman->id,
                    'type' => 'perpanjang'
                ],
                [
                    'is_read' => false
                ]
            );
        }

        return back()->with('success', 'Request perpanjang dikirim ke admin.');
    }

    public function riwayatPeminjaman()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $riwayat = Peminjaman::with('buku')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('layouts.riwayat', compact('riwayat'));
    }
}