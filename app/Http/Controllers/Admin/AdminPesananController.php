<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use App\Models\Distribusi;
use Illuminate\Http\Request;
use App\Notifications\StatusPesananBerubah;
use App\Models\Kabupaten;
use App\Models\Provinsi;
use App\Models\Pelanggan;



class AdminPesananController extends Controller
{
    public function index(Request $request)
{
    if (auth()->user()->role !== 'pemilik' && auth()->user()->role !== 'staff') {
        abort(403, 'Akses ditolak.');
    }
    $query = Pesanan::with('pelanggan');

    // Filter berdasarkan kabupaten (khusus Jawa Barat, ID = 32)
    if ($request->filled('kabupaten_id')) {
        $query->where('kabupaten_id', $request->kabupaten_id);
    }

    $kabupatens = Kabupaten::where('provinsi_id', 32)->get();
    $pesanan = $query->orderBy('created_at', 'desc')->get();

    return view('admin.pesanan.index', compact('pesanan', 'kabupatens'));
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

public function create()
{
    $pelanggan = Pelanggan::all(); // untuk dropdown pelanggan
    $provinsis = Provinsi::where('id', 32)->get();
    return view('admin.pesanan.create', compact('pelanggan', 'provinsis'));
}



public function store(Request $request)
{
    $validated = $request->validate([
        'pelanggan_id' => 'required|exists:pelanggan,id_pelanggan',
        'item' => 'required|string|max:255',
        'kuantitas' => 'required|numeric|min:1',
        'alamat' => 'required|string',
        'provinsi_id' => 'required|exists:provinsis,id',
        'kabupaten_id' => 'required|exists:kabupatens,id',
        'kecamatan_id' => 'required|exists:kecamatans,id',
        'kelurahan_id' => 'required|exists:kelurahans,id',
    ]);

    $pesanan = \App\Models\Pesanan::create([
        'pelanggan_id' => $validated['pelanggan_id'],
        'item' => $validated['item'],
        'kuantitas' => $validated['kuantitas'],
        'alamat' => $validated['alamat'],
        'provinsi_id' => $validated['provinsi_id'],
        'kabupaten_id' => $validated['kabupaten_id'],
        'kecamatan_id' => $validated['kecamatan_id'],
        'kelurahan_id' => $validated['kelurahan_id'],
        'status' => 'menunggu',
    ]);

    // Kirim notifikasi
    $pesanan->pelanggan->notify(new \App\Notifications\StatusPesananBerubah($pesanan));

    return redirect()->route('admin.pesanan.index')->with('success', 'Pesanan berhasil dibuat.');
}


}
