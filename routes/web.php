<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PelangganController;
use App\Http\Controllers\Admin\BahanBakuController;
use App\Http\Controllers\Admin\ProduksiController;
use App\Http\Controllers\Admin\DistribusiController;
use App\Http\Controllers\Auth\UnifiedLoginController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Pelanggan\PelangganDashboardController;
use App\Http\Controllers\Admin\MilestoneController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\Admin\AdminPesananController;
use App\Http\Controllers\NotifikasiController;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Http\Controllers\Admin\AdminLaporanController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\PemilikController;


Route::get('/get-kabupaten/{provinsi_id}', function ($provinsi_id) {
    return response()->json(Kabupaten::where('provinsi_id', $provinsi_id)->get());
});

Route::get('/get-kecamatan/{kabupaten_id}', function ($kabupaten_id) {
    return response()->json(Kecamatan::where('kabupaten_id', $kabupaten_id)->get());
});

Route::get('/get-kelurahan/{kecamatan_id}', function ($kecamatan_id) {
    return response()->json(Kelurahan::where('kecamatan_id', $kecamatan_id)->get());
});

Route::middleware(['web'])->group(function () {

    // UNIFIED LOGIN ROUTES
    Route::get('/login', [UnifiedLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [UnifiedLoginController::class, 'login'])->name('login.submit');
    Route::post('/logout', [UnifiedLoginController::class, 'logout'])->name('logout');

    // Halaman utama (guest)
    Route::get('/', fn() => view('home'))->name('home');
    // Tentang Kami
    Route::get('/tentang', function () {
        return view('tentang');
    })->name('tentang');

    // Kontak
    Route::get('/kontak', function () {
        return view('kontak');
    })->name('kontak');

    // USER (PELANGGAN) SECTION
    Route::middleware(['auth:web'])->group(function () {
        Route::get('/dashboard', [PelangganDashboardController::class, 'index'])->name('dashboard');
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        Route::get('/pesanan/create', [PesananController::class, 'create'])->name('pesanan.create');
        Route::post('/pesanan', [PesananController::class, 'store'])->name('pesanan.store');
        Route::post('/pesanan/{id}/konfirmasi', [PesananController::class, 'konfirmasi'])->name('pesanan.konfirmasi');
        // Route untuk dropdown lokal dinamis
        Route::get('/wilayah/kabupaten', [\App\Http\Controllers\WilayahController::class, 'getKabupaten']);
        Route::get('/wilayah/kecamatan', [\App\Http\Controllers\WilayahController::class, 'getKecamatan']);
        Route::get('/wilayah/kelurahan', [\App\Http\Controllers\WilayahController::class, 'getKelurahan']);


        Route::put('/password/update', function (Request $request) {
            $request->validate([
                'current_password' => ['required'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);

            if (! Hash::check($request->current_password, $request->user()->password)) {
                return back()->withErrors(['current_password' => 'Password lama salah']);
            }

            $request->user()->update([
                'password' => Hash::make($request->password),
            ]);

            return back()->with('status', 'Password berhasil diubah.');
        })->name('password.update');
    });

    Route::middleware('guest')->group(function () {
        Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
        Route::post('/register', [RegisteredUserController::class, 'store']);
    });

    // Group untuk semua admin login
Route::prefix('admin')->as('admin.')->middleware(['auth:admin'])->group(function () {

    // Dashboard: Semua role Bisa Akses
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // === role ADMIN SAJA ===
    Route::middleware('role:admin')->group(function () {
        Route::resource('pelanggan', PelangganController::class);
        Route::resource('staff', \App\Http\Controllers\Admin\StaffController::class);
        Route::resource('pemilik', \App\Http\Controllers\Admin\PemilikController::class);
    });

    // === role STAFF & ADMIN ===
    Route::middleware('role:staff,admin')->group(function () {
        Route::resource('bahanbaku', BahanBakuController::class);
        Route::resource('produksi', ProduksiController::class);
        Route::resource('milestone', MilestoneController::class);
        Route::get('milestone/{id}/data', [MilestoneController::class, 'data']);
        Route::post('milestone/{id}/konfirmasi', [MilestoneController::class, 'konfirmasi'])->name('milestone.konfirmasi');

        Route::get('/pesanan', [AdminPesananController::class, 'index'])->name('pesanan.index');
        Route::get('/pesanan/create', [AdminPesananController::class, 'create'])->name('pesanan.create');
        Route::post('/pesanan', [AdminPesananController::class, 'store'])->name('pesanan.store');
        Route::post('/pesanan/{id}/konfirmasi', [AdminPesananController::class, 'konfirmasi'])->name('pesanan.konfirmasi');
        Route::post('/pesanan/{id}/kirim', [AdminPesananController::class, 'kirim'])->name('pesanan.kirim');
        Route::get('/pesanan/{id}', [AdminPesananController::class, 'show'])->name('pesanan.show');

        Route::resource('distribusi', DistribusiController::class);
        Route::post('/konfirmasi-distribusi/{id}', [DistribusiController::class, 'konfirmasi']);
    });

    // === role PEMILIK SAJA ===
    Route::middleware('role:pemilik')->group(function () {
        Route::get('/laporan/bahanbaku', [AdminLaporanController::class, 'bahanbaku'])->name('laporan.bahanbaku');
        Route::get('/laporan/produksi', [AdminLaporanController::class, 'produksi'])->name('laporan.produksi');
        Route::get('/laporan/milestone', [AdminLaporanController::class, 'milestone'])->name('laporan.milestone');
        Route::get('/laporan/pesanan', [AdminLaporanController::class, 'pesanan'])->name('laporan.pesanan');
        Route::get('/laporan/distribusi', [AdminLaporanController::class, 'distribusi'])->name('laporan.distribusi');
        Route::get('/laporan/pesanan/export-csv', [AdminLaporanController::class, 'exportPesananCSV'])->name('laporan.pesanan.export.csv');
    });

    // Notifikasi & Logout: Semua role Bisa Akses
    Route::get('/notifikasi', [NotifikasiController::class, 'adminIndex'])->name('notifikasi.index');
    Route::post('/logout', [DashboardController::class, 'logout'])->name('logout');

    // Dropdown wilayah lokal
    Route::get('/wilayah/kabupaten', [\App\Http\Controllers\WilayahController::class, 'getKabupaten']);
    Route::get('/wilayah/kecamatan', [\App\Http\Controllers\WilayahController::class, 'getKecamatan']);
    Route::get('/wilayah/kelurahan', [\App\Http\Controllers\WilayahController::class, 'getKelurahan']);
});


    // OPTIONAL: Debug helper (hapus di production)
    Route::get('/check-auth', function () {
        return [
            'auth (default)' => Auth::user(),
            'auth web' => Auth::guard('web')->user(),
            'auth admin' => Auth::guard('admin')->user(),
        ];
    });

    Route::middleware('web')->get('/debug-session', function () {
        session(['check' => 'ok']);
        return session('check');
    });
    
    Route::delete('/notifikasi/hapus', [NotifikasiController::class, 'hapusLama'])->name('notifikasi.bersihkan');

});
