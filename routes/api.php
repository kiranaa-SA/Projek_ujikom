<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\FavoriteController;
use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Peminjaman;
use App\Models\Pengembalian;

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

/*
|--------------------------------------------------------------------------
| PUBLIC (TANPA LOGIN)
|--------------------------------------------------------------------------
*/

// 🔹 GET SEMUA BUKU
Route::get('/buku', function () {
    $buku = Buku::all()->map(function ($item) {
        return [
            'id'        => $item->id,
            'judul'     => $item->judul,
            'penulis'   => $item->penulis,
            'penerbit'  => $item->penerbit,
            'kategori'  => $item->kategori,
            'gambar_url'=> $item->gambar
                ? asset('storage/' . $item->gambar)
                : null,
        ];
    });

    return response()->json([
        'success' => true,
        'data' => $buku
    ]);
});

/*
|--------------------------------------------------------------------------
| PROTECTED (LOGIN WAJIB)
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->group(function () {

    // 🔹 USER
    Route::get('/user', [AuthController::class, 'user']);

    // 🔹 LOGOUT
    Route::post('/logout', [AuthController::class, 'logout']);

    // 🔹 DASHBOARD
    Route::get('/dashboard', function () {
        return response()->json([
            'success' => true,
            'data' => [
                'total_buku'         => Buku::count(),
                'total_kategori'     => Kategori::count(),
                'total_peminjaman'   => Peminjaman::count(),
                'total_pengembalian' => Pengembalian::count(),
            ]
        ]);
    });

    /*
    |--------------------------------------------------------------------------
    | FAVORITE
    |--------------------------------------------------------------------------
    */

    // 🔹 GET FAVORITES
    Route::get('/favorites', [FavoriteController::class, 'index']);

    // 🔹 TOGGLE FAVORITE
    Route::post('/favorite/{buku}', [FavoriteController::class, 'toggle'])
        ->whereNumber('buku');

    // 🔹 CHECK FAVORITE
    Route::get('/favorite/{buku}/check', [FavoriteController::class, 'check'])
        ->whereNumber('buku');
});