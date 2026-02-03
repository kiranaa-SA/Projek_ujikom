<?php

use App\Http\Controllers\Admin\BukuController as AdminBukuController;

// ===================
// FRONTEND CONTROLLERS
// ===================
use App\Http\Controllers\Admin\DashboardController;

// ===================
// AUTH CONTROLLERS
// ===================
use App\Http\Controllers\Admin\DendaController;
use App\Http\Controllers\Admin\HeroBannerController;

// ===================
// ADMIN CONTROLLERS
// ===================
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\PeminjamanController;
use App\Http\Controllers\Admin\PengembalianController;
use App\Http\Controllers\Admin\RakController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Petugas\BukuController as PetugasBukuController;

// ===================
// PETUGAS CONTROLLERS
// ===================
use App\Http\Controllers\Petugas\DashboardController as PetugasDashboardController;
use App\Http\Controllers\Petugas\DendaController as PetugasDendaController;
use App\Http\Controllers\Petugas\PeminjamanController as PetugasPeminjamanController;
use App\Http\Controllers\Petugas\PengembalianController as PetugasPengembalianController;
use App\Http\Controllers\Petugas\UserController as PetugasUserController;
use App\Models\PeminjamanNotification;

// ===================
// MODELS
// ===================
use Illuminate\Support\Facades\Route;

// ===================
// FRONTEND (LANDING PAGE & HALAMAN UMUM)
// ===================

// 🔹 Halaman utama
Route::get('/', [FrontendController::class, 'index'])->name('home');

// 🔹 Halaman semua buku
Route::get('/semua-buku', [FrontendController::class, 'semuaBuku'])->name('semua_buku.index');

// 🔹 Halaman detail buku
Route::get('/buku/{id}', [FrontendController::class, 'detail'])->name('buku.detail');

// 🔹 Aksi pinjam buku (hanya jika login)
Route::post('/buku/{id}/pinjam', [FrontendController::class, 'pinjamBuku'])
    ->middleware('auth')
    ->name('pinjam.buku');

// 🔹 Halaman riwayat peminjaman (hanya jika login)
Route::get('/riwayat', [FrontendController::class, 'riwayatPeminjaman'])
    ->middleware('auth')
    ->name('riwayat.index');

// ===================
// AUTH
// ===================
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// ===================
// ADMIN
// ===================
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // 🔹 Dashboard
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // 🔹 CRUD Resources
        Route::resources([
            'kategoris'     => KategoriController::class,
            'raks'          => RakController::class,
            'bukus'         => AdminBukuController::class,
            'peminjamans'   => PeminjamanController::class,
            'pengembalians' => PengembalianController::class,
            'dendas'        => DendaController::class,
            'users'         => UserController::class,
            'hero-banners'  => HeroBannerController::class, // ✅ Resource Hero Banner
        ]);

        // 🔹 Aksi konfirmasi peminjaman
        Route::post('peminjamans/{id}/accept', [PeminjamanController::class, 'accept'])->name('peminjamans.accept');
        Route::post('peminjamans/{id}/reject', [PeminjamanController::class, 'reject'])->name('peminjamans.reject');

        // 🔹 Laporan
        Route::get('laporans', [LaporanController::class, 'index'])->name('laporans.index');
        Route::get('laporans/export-pdf', [LaporanController::class, 'exportPdf'])->name('laporans.exportPdf');
    });

// ===================
// PETUGAS
// ===================
Route::middleware(['auth', 'role:petugas'])
    ->prefix('petugas')
    ->name('petugas.')
    ->group(function () {

        // 🔹 Dashboard
        Route::get('/', [PetugasDashboardController::class, 'index'])->name('dashboard');

        // 🔹 CRUD Resources
        Route::resources([
            'bukus'         => PetugasBukuController::class,
            'peminjamans'   => PetugasPeminjamanController::class,
            'pengembalians' => PetugasPengembalianController::class,
            'dendas'        => PetugasDendaController::class,
            'users'         => PetugasUserController::class,
        ]);
    });

// ===================
// NOTIFIKASI (GLOBAL - AJAX MARK AS READ)
// ===================
Route::post('/notifications/{id}/read', function ($id) {
    PeminjamanNotification::where('id', $id)->update(['is_read' => true]);
    return response()->noContent();
})->middleware('auth')->name('notifications.read');