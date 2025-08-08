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
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\PemilikController;


Route::get('/wilayah/kabupaten', [\App\Http\Controllers\WilayahController::class, 'getKabupaten']);
    Route::get('/wilayah/kecamatan', [\App\Http\Controllers\WilayahController::class, 'getKecamatan']);
    Route::get('/wilayah/kelurahan', [\App\Http\Controllers\WilayahController::class, 'getKelurahan']);

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
Route::middleware(['auth'])->group(function () {
    Route::resource('pelanggan', PelangganController::class);
    Route::resource('staff', StaffController::class);
    Route::get('/admin/staff/{staff}/edit', [StaffController::class, 'edit'])->name('admin.staff.edit');
    Route::put('/admin/staff/{staff}', [StaffController::class, 'update'])->name('admin.staff.update');
    Route::resource('pemilik', PemilikController::class);
    Route::get('/admin/pemilik/{pemilik}/edit', [PemilikController::class, 'edit'])->name('admin.pemilik.edit');
    Route::put('/admin/pemilik/{pemilik}', [PemilikController::class, 'update'])->name('admin.pemilik.update');
});


    // === role STAFF & ADMIN ===
    Route::middleware('auth')->group(function () {
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
    Route::middleware('auth')->group(function () {
        Route::get('/laporan/bahanbaku', [LaporanController::class, 'bahanbaku'])->name('laporan.bahanbaku');
        Route::get('/laporan/bahanbaku/export-csv', [BahanBakuController::class, 'exportCsv'])->name('laporan.bahanbaku.export_csv');
        Route::get('/laporan/bahanbaku/export-pdf', [BahanBakuController::class, 'exportPdf'])->name('laporan.bahanbaku.export_pdf');

        Route::get('/laporan/produksi', [ProduksiController::class, 'laporan'])->name('laporan.produksi');
        Route::get('/laporan/produksi/export-csv', [ProduksiController::class, 'exportCsv'])->name('laporan.produksi.export_csv');
        Route::get('/laporan/produksi/export-pdf', [ProduksiController::class, 'exportPdf'])->name('laporan.produksi.export_pdf');

        Route::get('/laporan/milestone', [MilestoneController::class, 'laporan'])->name('laporan.milestone');
        Route::get('/laporan/milestone/export-csv', [MilestoneController::class, 'exportCsv'])->name('laporan.milestone.export_csv');
        Route::get('/laporan/milestone/export-pdf', [MilestoneController::class, 'exportPdf'])->name('laporan.milestone.export_pdf');

        Route::get('/laporan/pesanan', [AdminPesananController::class, 'laporan'])->name('laporan.pesanan');
        Route::get('/laporan/pesanan/export-csv', [AdminPesananController::class, 'exportCsv'])->name('laporan.pesanan.export_csv');
        Route::get('/laporan/pesanan/export-pdf', [AdminPesananController::class, 'exportPdf'])->name('laporan.pesanan.export_pdf');

        Route::get('/laporan/distribusi', [DistribusiController::class, 'laporan'])->name('laporan.distribusi');
        Route::get('/laporan/distribusi/export-csv', [DistribusiController::class, 'exportCsv'])->name('laporan.distribusi.export_csv');
        Route::get('/laporan/distribusi/export-pdf', [DistribusiController::class, 'exportPdf'])->name('laporan.distribusi.export_pdf');
    });

    // Notifikasi & Logout: Semua role Bisa Akses
    Route::get('/notifikasi', [NotifikasiController::class, 'adminIndex'])->name('notifikasi.index');
    Route::post('/logout', [DashboardController::class, 'logout'])->name('logout');

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
