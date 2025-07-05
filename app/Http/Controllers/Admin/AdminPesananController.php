<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use App\Models\Distribusi;
use Illuminate\Http\Request;

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



        return back()->with('success', 'Pesanan dikonfirmasi dan masuk distribusi.');
    }

    public function kirim($id)
    {
        $pesanan = Pesanan::findOrFail($id);

        $pesanan->update(['status' => 'dikirim']);

        $distribusi = Distribusi::where('pesanan_id', $pesanan->id_pesanan)->first();
        if ($distribusi) {
            $distribusi->update(['status' => 'dikirim']);
        }

        return back()->with('success', 'Pesanan telah dikirim.');
    }
}
