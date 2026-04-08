<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| CONTROLLERS
|--------------------------------------------------------------------------
*/

// ADMIN
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\RakController;
use App\Http\Controllers\Admin\BukuController as AdminBukuController;
use App\Http\Controllers\Admin\PeminjamanController;
use App\Http\Controllers\Admin\PengembalianController;
use App\Http\Controllers\Admin\DendaController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\HeroBannerController;
use App\Http\Controllers\Admin\LaporanController;

// PETUGAS
use App\Http\Controllers\Petugas\DashboardController as PetugasDashboardController;
use App\Http\Controllers\Petugas\BukuController as PetugasBukuController;
use App\Http\Controllers\Petugas\PeminjamanController as PetugasPeminjamanController;
use App\Http\Controllers\Petugas\PengembalianController as PetugasPengembalianController;
use App\Http\Controllers\Petugas\DendaController as PetugasDendaController;
use App\Http\Controllers\Petugas\UserController as PetugasUserController;
use App\Http\Controllers\Petugas\LaporanController as PetugasLaporanController;

// AUTH
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

// FRONTEND
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\FavoriteController;

// MODEL
use App\Models\PeminjamanNotification;


/*
|--------------------------------------------------------------------------
| FRONTEND (USER)
|--------------------------------------------------------------------------
*/

Route::get('/', [FrontendController::class, 'index'])->name('home');

Route::get('/semua-buku', [FrontendController::class, 'semuaBuku'])
    ->name('semua_buku.index');

Route::get('/buku/{id}', [FrontendController::class, 'detail'])
    ->whereNumber('id')
    ->name('buku.detail');

Route::post('/buku/{id}/pinjam', [FrontendController::class, 'pinjamBuku'])
    ->middleware('auth')
    ->name('pinjam.buku');

Route::get('/riwayat', [FrontendController::class, 'riwayatPeminjaman'])
    ->middleware('auth')
    ->name('riwayat.index');


/*
|--------------------------------------------------------------------------
| KERANJANG
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/keranjang', [KeranjangController::class, 'index'])
        ->name('keranjang.index');

    Route::post('/keranjang/{buku}', [KeranjangController::class, 'store'])
        ->whereNumber('buku')
        ->name('keranjang.store');

    Route::delete('/keranjang/{id}', [KeranjangController::class, 'destroy'])
        ->whereNumber('id')
        ->name('keranjang.destroy');

    Route::post('/keranjang/pinjam', [KeranjangController::class, 'pinjam'])
        ->name('keranjang.pinjam');
});


/*
|--------------------------------------------------------------------------
| FAVORITE
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::post('/favorite/{buku}', [FavoriteController::class, 'toggle'])
        ->whereNumber('buku')
        ->name('favorite.toggle');

    Route::get('/favorites', [FavoriteController::class, 'index'])
        ->name('favorites.index');
});


/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);


/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::resources([
            'kategoris'     => KategoriController::class,
            'raks'          => RakController::class,
            'bukus'         => AdminBukuController::class,
            'peminjamans'   => PeminjamanController::class,
            'pengembalians' => PengembalianController::class,
            'dendas'        => DendaController::class,
            'users'         => UserController::class,
            'hero-banners'  => HeroBannerController::class,
        ]);

        // 🔥 CUSTOM ACTION
        Route::post('/peminjamans/{id}/accept', [PeminjamanController::class, 'accept'])
            ->whereNumber('id')
            ->name('peminjamans.accept');

        Route::post('/peminjamans/{id}/reject', [PeminjamanController::class, 'reject'])
            ->whereNumber('id')
            ->name('peminjamans.reject');

        Route::post('/peminjamans/{id}/return', [PeminjamanController::class, 'return'])
            ->whereNumber('id')
            ->name('peminjamans.return');

        Route::get('/ajax-peminjaman', [PeminjamanController::class, 'ajaxPeminjaman'])
            ->name('ajax-peminjaman');

        Route::get('/laporans', [LaporanController::class, 'index'])
            ->name('laporans.index');

        Route::get('/laporans/export-pdf', [LaporanController::class, 'exportPdf'])
            ->name('laporans.exportPdf');
    });


/*
|--------------------------------------------------------------------------
| PETUGAS
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:petugas'])
    ->prefix('petugas')
    ->name('petugas.')
    ->group(function () {

        Route::get('/', [PetugasDashboardController::class, 'index'])
            ->name('dashboard');

        Route::resources([
            'bukus'         => PetugasBukuController::class,
            'peminjamans'   => PetugasPeminjamanController::class,
            'pengembalians' => PetugasPengembalianController::class,
            'dendas'        => PetugasDendaController::class,
            'users'         => PetugasUserController::class,
        ]);

        // 🔥 CUSTOM ACTION
        Route::post('/peminjamans/{id}/accept', [PetugasPeminjamanController::class, 'accept'])
            ->whereNumber('id')
            ->name('peminjamans.accept');

        Route::post('/peminjamans/{id}/reject', [PetugasPeminjamanController::class, 'reject'])
            ->whereNumber('id')
            ->name('peminjamans.reject');

        Route::post('/peminjamans/{id}/return', [PetugasPeminjamanController::class, 'return'])
            ->whereNumber('id')
            ->name('peminjamans.return');

        Route::get('/ajax-peminjaman', [PetugasPeminjamanController::class, 'ajaxPeminjaman'])
            ->name('ajax-peminjaman');

        Route::get('/laporans', [PetugasLaporanController::class, 'index'])
            ->name('laporans.index');

        Route::get('/laporans/export-pdf', [PetugasLaporanController::class, 'exportPdf'])
            ->name('laporans.exportPdf');
    });


/*
|--------------------------------------------------------------------------
| NOTIFICATIONS
|--------------------------------------------------------------------------
*/

Route::post('/notifications/{id}/read', function ($id) {
    PeminjamanNotification::where('id', $id)->update(['is_read' => true]);
    return response()->noContent();
})->middleware('auth')->name('notifications.read');