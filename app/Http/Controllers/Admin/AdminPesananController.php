<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use App\Models\Distribusi;
use Illuminate\Http\Request;
use App\Notifications\StatusPesananBerubah;

class AdminPesananController extends Controller
{
    public function index()
    {
        $pesanan = Pesanan::with('pelanggan')->orderBy('created_at', 'desc')->get();
        return view('admin.pesanan.index', compact('pesanan'));
    }

    public function konfirmasi($id)
    {
        $pesanan = Pesanan::findOrFail($id);

        $pesanan->update(['status' => 'disiapkan']);

        Distribusi::create([
    'pesanan_id' => $pesanan->id_pesanan,
    'id_pelanggan' => $pesanan->pelanggan_id,
    'jumlah' => $pesanan->kuantitas, // ← tambahkan ini
    'tanggal_distribusi' => now(),
    'status' => 'disiapkan',
]);

  // ✅ Kirim notifikasi ke pelanggan
    if ($pesanan->pelanggan) {
        $pesanan->pelanggan->notify(new StatusPesananBerubah($pesanan));
    }
        return back()->with('success', 'Pesanan dikonfirmasi dan masuk distribusi.');
    }

    public function kirim($id)
{
    $pesanan = \App\Models\Pesanan::with('pelanggan')->findOrFail($id);

    // Update status pesanan
    $pesanan->update(['status' => 'dikirim']);

    // Update status distribusi juga
    $distribusi = \App\Models\Distribusi::where('pesanan_id', $pesanan->id_pesanan)->first();
    if ($distribusi) {
        $distribusi->update(['status' => 'dikirim']);
    }

    // Kirim notifikasi ke pelanggan dengan status yang sudah diperbarui
    $pesanan->refresh(); // pastikan data terbaru dari database
    $pesanan->pelanggan?->notify(new \App\Notifications\StatusPesananBerubah($pesanan));

    return back()->with('success', 'Pesanan telah dikirim.');
}


    public function show($id)
{
    $pesanan = \App\Models\Pesanan::with('pelanggan')->findOrFail($id);
    return view('admin.pesanan.show', compact('pesanan'));
}


}
