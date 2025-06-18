<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\Produksi;
use App\Models\BahanBaku;
use App\Models\Distribusi;

class DashboardController extends Controller
{
    public function index(Request $request)
{
    $selectedDate = $request->query('tanggal');

    // Query builder dengan filter tanggal kalau ada
    $bahanBakuQuery = BahanBaku::query();
    $produksiQuery = Produksi::query();
    $distribusiQuery = Distribusi::query();
    $pelangganQuery = Pelanggan::query();

    if ($selectedDate) {
        // Filter berdasarkan kolom tanggal yang benar, bukan ID
        $bahanBakuQuery->whereDate('tanggal_masuk', $selectedDate);
        $produksiQuery->whereDate('tanggal_produksi', $selectedDate);
        $distribusiQuery->whereDate('tanggal_distribusi', $selectedDate);  // contoh kolom tanggal_kirim
        //$pelangganQuery->whereDate('created_at', $selectedDate);  // contoh kolom tanggal_daftar
    }

    // Hitung total stok (sum) untuk chart
    $totalBahanBaku = $bahanBakuQuery->sum('stok');
    $totalProduksi = $produksiQuery->sum('stok');

    // Hitung jumlah data (count) untuk statistik kartu
    $bahanBakuCount = $bahanBakuQuery->count();
    $produksiCount = $produksiQuery->count();
    $distribusiCount = $distribusiQuery->count();
    $pelangganCount = $pelangganQuery->count();

    $labels = ['Bahan Baku', 'Produksi'];
    $values = [$totalBahanBaku, $totalProduksi];

    return view('admin.dashboard', [
        'pelangganCount' => $pelangganCount,
        'bahanBakuCount' => $bahanBakuCount,
        'produksiCount' => $produksiCount,
        'distribusiCount' => $distribusiCount,
        'labels' => $labels,
        'values' => $values,
        'selectedDate' => $selectedDate
    ]);
}



    public function logout(Request $request)
    {
        Auth::guard('admin')->logout(); // Keluar dari session

        $request->session()->invalidate(); // Hapus session
        $request->session()->regenerateToken(); // Regenerasi CSRF token

        return redirect('/login'); // Redirect ke halaman login
    }


}
