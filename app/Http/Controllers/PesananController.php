<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pesanan;
use App\Models\Admin;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\Distribusi;
use App\Notifications\StatusPesananBerubah;

class PesananController extends Controller
{
    public function index(Request $request)
    {
        $query = Pesanan::query();

        // Filter kabupaten
        if ($request->filled('kabupaten_id')) {
            $query->where('kabupaten_id', $request->kabupaten_id);
        }

        $kabupatens = Kabupaten::where('provinsi_id', 32)->get(); // Jawa Barat
        $pesanan = $query->orderBy('created_at', 'desc')->get();

        return view('admin.pesanan.index', compact('pesanan', 'kabupatens'));
    }

    public function create()
    {
        $provinsis = Provinsi::where('id', 32)->get(); // Jawa Barat saja
        return view('pelanggan.pesanan.create', compact('provinsis'));
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

        $kabupaten = Kabupaten::find($request->kabupaten_id);
        $nama_kabupaten = $kabupaten?->nama;

        $zona1 = ['KABUPATEN INDRAMAYU', 'Cirebon', 'Majalengka', 'Subang'];
        $zona2 = ['Sumedang', 'Kuningan', 'Bandung', 'Cimahi', 'Purwakarta'];
        $zona3 = ['Bogor', 'Bekasi', 'Sukabumi', 'Cianjur', 'Garut', 'Tasikmalaya', 'Banjar', 'Pangandaran'];

        if (in_array($nama_kabupaten, $zona1)) {
            $estimasi = '1-2 Hari';
        } elseif (in_array($nama_kabupaten, $zona2)) {
            $estimasi = '2-3 Hari';
        } elseif (in_array($nama_kabupaten, $zona3)) {
            $estimasi = '3-4 Hari';
        } else {
            $estimasi = 'Diluar jangkauan distribusi';
        }

        $pesanan = Pesanan::create([
            'pelanggan_id' => Auth::user()->id_pelanggan,
            'item' => $request->item,
            'kuantitas' => $request->kuantitas,
            'alamat' => $request->alamat,
            'provinsi_id' => $request->provinsi_id,
            'kabupaten_id' => $request->kabupaten_id,
            'kecamatan_id' => $request->kecamatan_id,
            'kelurahan_id' => $request->kelurahan_id,
            'status' => 'menunggu',
            'estimasi_pengiriman' => $estimasi,
        ]);

        // Kirim notifikasi ke semua admin
        Admin::all()->each(function ($admin) use ($pesanan) {
            $admin->notify(new StatusPesananBerubah($pesanan));
        });

        return redirect()->route('dashboard')->with('success', 'Pesanan berhasil dibuat.');
    }

    public function konfirmasi(Request $request, $id)
    {
        $request->validate([
            'bukti_foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $pesanan = Pesanan::findOrFail($id);

        if ($request->hasFile('bukti_foto')) {
            $path = $request->file('bukti_foto')->store('bukti_pesanan', 'public');

            $pesanan->update([
                'status' => 'diterima',
                'bukti_foto' => $path,
            ]);

            // Update status distribusi
            Distribusi::where('pesanan_id', $pesanan->id_pesanan)
                ->update(['status' => 'diterima']);

            // Notifikasi admin
            Admin::all()->each(fn($admin) => $admin->notify(new StatusPesananBerubah($pesanan)));

            // Notifikasi pelanggan
            $pesanan->pelanggan->notify(new StatusPesananBerubah($pesanan));
        }

        return redirect()->route('dashboard')->with('success', 'Pesanan berhasil dikonfirmasi dan bukti diterima.');
    }
}
