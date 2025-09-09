<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\DendaController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\RakController;
use Illuminate\Support\Facades\Route;

// ============================
// LANDING PAGE
// ============================
Route::get('/', function () {
    return view('welcome');
});

// Dashboard / Home
Route::get('/home', function () {
    return view('home'); // pastikan ada resources/views/home.blade.php
})->name('home');

// ============================
// AUTH ROUTES
// ============================
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ============================
// ADMIN (semua bisa diakses)
// ============================
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resources([
        'kategoris'     => KategoriController::class,
        'raks'          => RakController::class,
        'bukus'         => BukuController::class,
        'peminjamans'   => PeminjamanController::class,
        'pengembalians' => PengembalianController::class,
        'dendas'        => DendaController::class,
    ]);
});

// ============================
// PETUGAS (hanya buku, peminjaman, pengembalian, denda)
// ============================
Route::middleware(['auth', 'role:petugas'])->group(function () {
    Route::resources([
        'bukus'         => BukuController::class,
        'peminjamans'   => PeminjamanController::class,
        'pengembalians' => PengembalianController::class,
        'dendas'        => DendaController::class,
    ]);
});

// ============================
// SISWA (hanya lihat buku / index & show)
// ============================
Route::middleware(['auth', 'role:siswa'])->group(function () {
    Route::get('bukus', [BukuController::class, 'index'])->name('bukus.index');
    Route::get('bukus/{buku}', [BukuController::class, 'show'])->name('bukus.show');
});