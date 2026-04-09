<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\Admin\DashboardController;
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
    ->whereNumber('id')
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
| AUTH (WEB)
|--------------------------------------------------------------------------
*/

// Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Register (WEB tetap ada, kalau kamu butuh)
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

/*
|--------------------------------------------------------------------------
| ADMIN (INI YANG TADI HILANG 🔥)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])
            ->name('dashboard');
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