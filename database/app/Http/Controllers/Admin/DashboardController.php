<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\Produksi;
use App\Models\BahanBaku;
use App\Models\Distribusi;

class DashboardController extends Controller
{
    public function index()
{
    return view('admin.dashboard', [
        'bahanBakuCount' => BahanBaku::count(),
        'produksiCount' => Produksi::count(),
        'distribusiCount' => Distribusi::count(),
        'pelangganCount' => Pelanggan::count(),
    ]);
}

}
