<?php

use App\Http\Controllers\Admin\BukuController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DendaController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\PeminjamanController;
use App\Http\Controllers\Admin\PengembalianController;
use App\Http\Controllers\Admin\RakController;
use App\Http\Controllers\Admin\UserController; // ✅ sudah pakai UserController
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Petugas\BukuController as PetugasBukuController;
use App\Http\Controllers\Petugas\DashboardController as PetugasDashboardController;
use App\Http\Controllers\Petugas\DendaController as PetugasDendaController;
use App\Http\Controllers\Petugas\PeminjamanController as PetugasPeminjamanController;
use App\Http\Controllers\Petugas\PengembalianController as PetugasPengembalianController;
use Illuminate\Support\Facades\Route;

// ===================
// LANDING PAGE
// ===================
Route::get('/', fn() => view('welcome'));
Route::get('/home', fn() => view('home'))->name('home');

// ===================
// AUTH ROUTES
// ===================
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ===================
// ADMIN
// ===================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resources([
        'kategoris'     => KategoriController::class,
        'raks'          => RakController::class,
        'bukus'         => BukuController::class,
        'peminjamans'   => PeminjamanController::class,
        'pengembalians' => PengembalianController::class,
        'dendas'        => DendaController::class,
        'users'         => UserController::class, // ✅ ganti dari userrs ke users
    ]);

    // Laporan
    Route::get('laporans', [LaporanController::class, 'index'])->name('laporans.index');
    Route::get('laporans/export-pdf', [LaporanController::class, 'exportPdf'])->name('laporans.exportPdf');
});

// ===================
// PETUGAS
// ===================
Route::middleware(['auth', 'role:petugas'])->prefix('petugas')->name('petugas.')->group(function () {
    Route::get('/', [PetugasDashboardController::class, 'index'])->name('dashboard');

    Route::resources([
        'bukus'         => PetugasBukuController::class,
        'peminjamans'   => PetugasPeminjamanController::class,
        'pengembalians' => PetugasPengembalianController::class,
        'dendas'        => PetugasDendaController::class,
    ]);
});

// ===================
// SISWA
// ===================
Route::middleware(['auth', 'role:siswa'])->prefix('siswa')->name('siswa.')->group(function () {
    Route::get('/', fn() => redirect()->route('siswa.bukus.index'))->name('dashboard');
    Route::get('bukus', [PetugasBukuController::class, 'index'])->name('bukus.index');
    Route::get('bukus/{buku}', [PetugasBukuController::class, 'show'])->name('bukus.show');
});