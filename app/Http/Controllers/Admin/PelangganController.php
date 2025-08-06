<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    protected $fillable = ['nama', 'email', 'alamat', 'no_hp']; // atau kolom lain yang kamu pakai

    public function index()
{
    if (auth()->user()->role !== 'admin') {
        abort(403, 'Akses ditolak.');
    }
    $pelanggan = \App\Models\Pelanggan::all();
    return view('admin.pelanggan.index', compact('pelanggan'));
}
public function create()
{
    return view('admin.pelanggan.create');
}
public function store(Request $request)
{
    \App\Models\Pelanggan::create($request->all());
    return redirect()->route('admin.pelanggan.index')->with('success', 'Pelanggan berhasil ditambahkan.');
}
public function edit($id)
{
    $pelanggan = \App\Models\Pelanggan::findOrFail($id);
    return view('admin.pelanggan.edit', compact('pelanggan'));
}
public function update(Request $request, $id)
{
    $request->validate([
        'nama' => 'required|string|max:255',
        'email' => 'required|email',
        'alamat' => 'required',
        'no_hp' => 'required'
    ]);

    $pelanggan = \App\Models\Pelanggan::findOrFail($id);
    $pelanggan->update($request->all());

    return redirect()->route('admin.pelanggan.index')->with('success', 'Data pelanggan berhasil diperbarui.');
}
public function destroy($id)
{
    $pelanggan = \App\Models\Pelanggan::findOrFail($id);
    $pelanggan->delete();

    return redirect()->route('admin.pelanggan.index')->with('success', 'Pelanggan berhasil dihapus.');
}

    //
}
