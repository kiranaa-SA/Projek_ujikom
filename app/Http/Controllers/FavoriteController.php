<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function __construct()
    {
        // 🔐 Wajib login semua method
        $this->middleware('auth');
    }

    // 🔁 Toggle Favorit
    public function toggle($buku_id)
    {
        $userId = Auth::id();

        // 🔍 Cek sudah ada atau belum
        $favorite = Favorite::where('user_id', $userId)
            ->where('buku_id', $buku_id)
            ->first();

        if ($favorite) {
            // ❌ Hapus favorit
            $favorite->delete();

            return redirect()->back()->with('success', 'Berhasil dihapus dari favorit');
        }

        // ✅ Tambah favorit
        Favorite::create([
            'user_id' => $userId,
            'buku_id' => $buku_id
        ]);

        return redirect()->back()->with('success', 'Berhasil ditambahkan ke favorit');
    }

    // 📚 List Favorit
    public function index()
    {
        $favorites = Favorite::with('buku')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('favorites.index', compact('favorites'));
    }
}