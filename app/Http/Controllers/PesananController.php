<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pesanan;
use Illuminate\Support\Facades\Auth;



class PesananController extends Controller
{
    public function index()
{
    $pesanan = Pesanan::where('pelanggan_id', auth()->user()->id)->latest()->get();
    return view('pelanggan.dashboard', compact('pesanan'));
}

    public function store(Request $request)
{
    $request->validate([
        'item' => 'required|string',
        'kuantitas' => 'required|numeric|min:0.1',
        'alamat' => 'required|string',
    ]);

    Pesanan::create([
        'pelanggan_id' => Auth::user()->id_pelanggan, // pakai default karena guard-nya 'web'
        'item' => $request->item,
        'kuantitas' => $request->kuantitas,
        'alamat' => $request->alamat,
        'status' => 'menunggu',
    ]);

    return redirect()->route('dashboard')->with('success', 'Pesanan berhasil dibuat.');
}
    public function create()
        {
            return view('pelanggan.pesanan.create');
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
        }
    \App\Models\Distribusi::where('pesanan_id', $pesanan->id_pesanan)
        ->update(['status' => 'diterima']);
        return redirect()->route('dashboard')->with('success', 'Pesanan berhasil dikonfirmasi dan bukti diterima.');

    }
}
