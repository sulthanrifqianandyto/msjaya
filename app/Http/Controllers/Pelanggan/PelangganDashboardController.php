<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Distribusi;

class PelangganDashboardController extends Controller
{
    public function index()
    {
        // Ambil pelanggan yang sedang login
        $pelanggan = Auth::guard('web')->user();

        // Ambil distribusi berdasarkan id_pelanggan
        $distribusi = Distribusi::where('id_pelanggan', $pelanggan->id_pelanggan)->get();

        return view('pelanggan.dashboard', compact('distribusi'));
    }

    public function konfirmasi($id)
{
    $distribusi = Distribusi::findOrFail($id);

    // Validasi kepemilikan distribusi
    if ($distribusi->id_pelanggan !== Auth::guard('web')->user()->id_pelanggan) {
        abort(403, 'Akses ditolak');
    }

    $distribusi->status = 'sudah';
    $distribusi->save();

    return redirect()->back()->with('success', 'Distribusi berhasil dikonfirmasi.');
}

}
