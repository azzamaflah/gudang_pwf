<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\RakController;
use App\Http\Controllers\TransaksiMasukController;
use App\Http\Controllers\TransaksiKeluarController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\PermintaanBarangController;


// Halaman utama
Route::get('/', function () {
    return view('welcome');
});

// Redirect setelah login berdasarkan role
Route::get('/redirect', function () {
    if (Auth::check()) {
        return Auth::user()->role === 'admin'
            ? redirect()->route('admin.dashboard')
            : redirect()->route('user.dashboard');
    }
    return redirect('/login');
})->middleware('auth');

// Admin Area
Route::middleware(['auth', App\Http\Middleware\IsAdmin::class])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/kategori', KategoriController::class);
    Route::resource('/rak', RakController::class);
    Route::resource('/barang', BarangController::class);
    Route::resource('/transaksi-masuk', TransaksiMasukController::class);
    Route::resource('/transaksi-keluar', TransaksiKeluarController::class);
    Route::get('/permintaan-barang/admin', [PermintaanBarangController::class, 'all'])->name('admin.permintaan-barang.admin');
    Route::post('/permintaan-barang/{id}/status', [PermintaanBarangController::class, 'updateStatus'])->name('admin.permintaan-barang.update-status');
});

// User Area
Route::middleware(['auth'])->group(function () {
    Route::get('/user/dashboard', [DashboardUserController::class, 'index'])->name('user.dashboard');
    Route::resource('/barang', BarangController::class)->only(['index']);
});

// Profil pengguna (akses semua user)
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'can:isUser'])->group(function () {
    Route::resource('permintaan-barang', \App\Http\Controllers\PermintaanBarangController::class)->only(['index', 'create', 'store']);
});

// Untuk user (mengajukan permintaan)
Route::middleware(['auth', 'can:isUser'])->group(function () {
    Route::resource('permintaan-barang', PermintaanBarangController::class)->only(['index', 'create', 'store']);
});

// Untuk admin (melihat dan merespons permintaan)
Route::middleware(['auth', 'can:isAdmin'])->group(function () {
    Route::get('permintaan-barang/admin', [PermintaanBarangController::class, 'adminIndex'])->name('permintaan-barang.admin.index');
    Route::post('permintaan-barang/{id}/approve', [PermintaanBarangController::class, 'approve'])->name('permintaan-barang.approve');
    Route::post('permintaan-barang/{id}/reject', [PermintaanBarangController::class, 'reject'])->name('permintaan-barang.reject');
});

Route::resource('permintaan-barang', PermintaanBarangController::class);

Route::resource('permintaan-barang', PermintaanBarangController::class)->middleware(['auth']);

// Admin: Kelola permintaan barang
Route::prefix('admin')->middleware(['auth', App\Http\Middleware\IsAdmin::class])->group(function () {
    Route::get('/permintaan-barang', [PermintaanBarangController::class, 'adminIndex'])->name('admin.permintaan-barang.index');
    Route::post('/permintaan-barang/{id}/approve', [PermintaanBarangController::class, 'approve'])->name('admin.permintaan-barang.approve');
    Route::post('/permintaan-barang/{id}/reject', [PermintaanBarangController::class, 'reject'])->name('admin.permintaan-barang.reject');
    Route::get('/barang/export-pdf', [BarangController::class, 'exportPdf'])->name('admin.barang.export-pdf');
});


Route::get('/redirect', function () {
    if (Auth::check()) {
        return Auth::user()->role === 'admin'
            ? redirect()->route('admin.dashboard')
            : redirect()->route('user.dashboard');
    }
    return redirect('/login');
})->middleware('auth');





// Laravel Breeze Auth Routes
require __DIR__ . '/auth.php';
