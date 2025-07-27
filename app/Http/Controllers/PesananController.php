<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use App\Notifications\StatusPesananBerubah;
use App\Models\Provinsi;
use App\Models\Kabupaten;



class PesananController extends Controller
{
    public function index(Request $request)
{
    $query = Pesanan::query();

    // Filter berdasarkan kabupaten (khusus Jawa Barat)
    if ($request->filled('kabupaten_id')) {
        $query->where('kabupaten_id', $request->kabupaten_id);
    }

    // Ambil semua kabupaten dari Provinsi Jawa Barat (ID = 9 di Emsifa)
    $kabupatens = Kabupaten::where('provinsi_id', 32)->get();

    $pesanan = $query->orderBy('created_at', 'desc')->get();

    return view('admin.pesanan.index', compact('pesanan', 'kabupatens'));
}


    public function store(Request $request)
{
    $request->validate([
        'item' => 'required|string',
        'kuantitas' => 'required|numeric|min:0.1',
        'alamat' => 'required|string',
        'provinsi_id' => 'required|exists:provinsis,id',
        'kabupaten_id' => 'required|exists:kabupatens,id',
        'kecamatan_id' => 'required|exists:kecamatans,id',
        'kelurahan_id' => 'required|exists:kelurahans,id',
    ]);

    $pesanan = Pesanan::create([
        'pelanggan_id'   => auth()->user()->id_pelanggan,
        'item'           => $request->item,
        'kuantitas'      => $request->kuantitas,
        'alamat'         => $request->alamat,
        'provinsi_id'    => $request->provinsi_id,
        'kabupaten_id'   => $request->kabupaten_id,
        'kecamatan_id'   => $request->kecamatan_id,
        'kelurahan_id'   => $request->kelurahan_id,
        'status'         => 'menunggu',
    ]);

    $admins = \App\Models\Admin::all();
    foreach ($admins as $admin) {
        $admin->notify(new StatusPesananBerubah($pesanan));
    }

    return redirect()->route('dashboard')->with('success', 'Pesanan berhasil dibuat.');
}

public function create()
{
    $provinsis = Provinsi::where('id', 32)->get();
    return view('pelanggan.pesanan.create', compact('provinsis'));
}

            public function konfirmasi(Request $request, $id)
    {
        $request->validate([
            'bukti_foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $pesanan = Pesanan::findOrFail($id);

        // Simpan foto
        if ($request->hasFile('bukti_foto')) {
            $path = $request->file('bukti_foto')->store('bukti_pesanan', 'public');
            $pesanan->update([
                'status' => 'diterima',
                'bukti_foto' => $path,
            ]);
                        // Kirim notifikasi ke admin
            $admins = \App\Models\Admin::all();
            foreach ($admins as $admin) {
                $admin->notify(new StatusPesananBerubah($pesanan));
}

            // Kirim notifikasi ke pelanggan sendiri
            $pesanan->pelanggan->notify(new StatusPesananBerubah($pesanan));
        }
    \App\Models\Distribusi::where('pesanan_id', $pesanan->id_pesanan)
        ->update(['status' => 'diterima']);
        return redirect()->route('dashboard')->with('success', 'Pesanan berhasil dikonfirmasi dan bukti diterima.');

    }
    
}
