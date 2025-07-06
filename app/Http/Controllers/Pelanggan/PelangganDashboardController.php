<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Pesanan;

class PelangganDashboardController extends Controller
{
    public function index()
    {
        // Ambil pelanggan yang sedang login
        $pelanggan = Auth::guard('web')->user();

        // Ambil pesanan berdasarkan id_pelanggan
        $pesanan = Pesanan::where('pelanggan_id', $pelanggan->id_pelanggan)->orderBy('created_at', 'desc')->get();
 // Ambil notifikasi pelanggan
    $notifications = $pelanggan->notifications;

    // Tandai semua notifikasi sebagai dibaca (opsional)
    $pelanggan->unreadNotifications->markAsRead();

    return view('pelanggan.dashboard', compact('pesanan', 'notifications'));
    }

    public function konfirmasi($id)
{
    $pesanan = Pesanan::findOrFail($id);

    // Validasi kepemilikan pesanan
    if ($pesanan->id_pelanggan !== Auth::guard('web')->user()->id_pelanggan) {
        abort(403, 'Akses ditolak');
    }

    $pesanan->status = 'sudah';
    $pesanan->save();

    return redirect()->back()->with('success', 'pesanan berhasil dikonfirmasi.');
}

}
