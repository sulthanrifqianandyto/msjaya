<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PelangganController;
use App\Http\Controllers\Admin\BahanBakuController;
use App\Http\Controllers\Admin\ProduksiController;
use App\Http\Controllers\Admin\DistribusiController;

require __DIR__.'/auth.php';

Route::get('/', function () {
    return view('home');
})->name('home');

/**Route::get('/', function () {
    return view('welcome');
});
**/
// Dashboard Pelanggan
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', fn() => view('pelanggan.dashboard'))->name('dashboard');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Login Admin
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

Route::middleware(['auth:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('pelanggan', PelangganController::class);
    Route::resource('bahanbaku', BahanBakuController::class);
    Route::resource('produksi', ProduksiController::class);
    Route::resource('distribusi', DistribusiController::class);
});


