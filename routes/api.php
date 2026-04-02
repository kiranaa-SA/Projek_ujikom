<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Peminjaman;
use App\Models\Pengembalian;

// ================= AUTH =================
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// ================= USER (LOGIN) =================
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// ================= PROTECTED ROUTES =================
Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    // 🔥 DASHBOARD (INI YANG KAMU BUTUHKAN)
    Route::get('/dashboard', function () {
        return response()->json([
            'total_buku' => Buku::count(),
            'total_kategori' => Kategori::count(),
            'total_peminjaman' => Peminjaman::count(),
            'total_pengembalian' => Pengembalian::count(),
        ]);
    });

});