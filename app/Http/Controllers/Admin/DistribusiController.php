<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Distribusi;
use App\Models\Pelanggan;

class DistribusiController extends Controller
{
    public function index()
{
    // Ambil semua distribusi dan load relasi pelanggan
    $distribusi = Distribusi::with('pelanggan')->get();
    return view('admin.distribusi.index', compact('distribusi'));
}

public function store(Request $request)
{
    $request->validate([
        'id_pelanggan' => 'required|exists:pelanggan,id_pelanggan',
        'jumlah' => 'required|string',
        'tanggal_distribusi' => 'required|date',
        // tambahkan validasi lainnya sesuai field distribusi
    ]);

    $distribusi = new Distribusi();
    $distribusi->id_pelanggan = $request->id_pelanggan;
    $distribusi->jumlah = $request->jumlah;
    $distribusi->tanggal_distribusi = $request->tanggal_distribusi;
    $distribusi->status = 'belum'; // <-- default status
    $distribusi->save();

    return redirect()->route('admin.distribusi.index')->with('success', 'Distribusi berhasil ditambahkan.');

}

public function update(Request $request, $id)
    {
        $request->validate([
        'id_pelanggan' => 'required|exists:pelanggan,id_pelanggan',
        'jumlah' => 'required|string',
        'tanggal_distribusi' => 'required|date',
        ]);

        $distribusi = \App\Models\Distribusi::findOrFail($id);
        $distribusi->update($request->all());

        return redirect()->route('admin.distribusi.index')->with('success', 'Data berhasil diperbarui.');
    }

public function create()
{
    $pelanggan = Pelanggan::all(); // Untuk ditampilkan sebagai dropdown
    return view('admin.distribusi.create', compact('pelanggan'));
}

public function edit($id)
{
    $distribusi = Distribusi::findOrFail($id);
    $pelanggan = Pelanggan::all(); // Agar dropdown tetap tersedia
    return view('admin.distribusi.edit', compact('distribusi', 'pelanggan'));
}


public function konfirmasi($id)
{
    $distribusi = Distribusi::findOrFail($id);
    $distribusi->status = 'sudah';
    $distribusi->save();

    return back()->with('success', 'Distribusi telah dikonfirmasi.');
}
public function destroy($id)
    {
        $distribusi = \App\Models\Distribusi::findOrFail($id);
        $distribusi->delete();

        return redirect()->route('admin.distribusi.index')->with('success', 'Data berhasil dihapus.');
    }
}
