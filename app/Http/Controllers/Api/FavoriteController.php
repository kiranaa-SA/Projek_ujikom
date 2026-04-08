<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use App\Models\Buku;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    // =========================
    // GET ALL FAVORITES (USER LOGIN)
    // =========================
    public function index(Request $request)
    {
        $favorites = Favorite::with('buku')
            ->where('user_id', $request->user()->id)
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'data' => $favorites
        ]);
    }

    // =========================
    // TOGGLE FAVORITE
    // =========================
    public function toggle(Request $request, $bukuId)
    {
        $user = $request->user();

        // cek buku ada atau tidak
        $buku = Buku::find($bukuId);
        if (!$buku) {
            return response()->json([
                'success' => false,
                'message' => 'Buku tidak ditemukan'
            ], 404);
        }

        // cek apakah sudah difavorite
        $favorite = Favorite::where('user_id', $user->id)
            ->where('buku_id', $bukuId)
            ->first();

        if ($favorite) {
            // ❌ remove favorite
            $favorite->delete();

            return response()->json([
                'success' => true,
                'message' => 'Berhasil dihapus dari favorite',
                'is_favorite' => false
            ]);
        }

        // ✅ tambah favorite
        Favorite::create([
            'user_id' => $user->id,
            'buku_id' => $bukuId,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Berhasil ditambahkan ke favorite',
            'is_favorite' => true
        ]);
    }

    // =========================
    // CHECK STATUS FAVORITE (OPTIONAL)
    // =========================
    public function check($bukuId, Request $request)
    {
        $isFavorite = Favorite::where('user_id', $request->user()->id)
            ->where('buku_id', $bukuId)
            ->exists();

        return response()->json([
            'is_favorite' => $isFavorite
        ]);
    }
}