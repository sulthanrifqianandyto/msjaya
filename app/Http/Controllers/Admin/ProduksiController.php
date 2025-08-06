<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produksi;

class ProduksiController extends Controller
{
    public function index()
    {
        if (auth()->user()->role !== 'staff') {
        abort(403, 'Akses ditolak.');
    }
                $produksi = \App\Models\Produksi::orderBy('created_at', 'desc')->get();
        return view('admin.produksi.index', compact('produksi'));
    }

    public function create()
    {
        return view('admin.produksi.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'nama_produk' => 'required|in:beras organik,beras medium,beras premium',
        'stok' => 'required|numeric|min:0',
        'tanggal_produksi' => 'required|date',
    ]);

    Produksi::create($request->only(['nama_produk', 'stok', 'tanggal_produksi']));

    return redirect()->route('admin.produksi.index')->with('success', 'Data produksi berhasil ditambahkan.');
}

    public function edit($id)
    {
        $produksi = \App\Models\Produksi::findOrFail($id);
        return view('admin.produksi.edit', compact('produksi'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'nama_produk' => 'required|in:beras organik,beras medium,beras premium',
        'stok' => 'required|numeric|min:0',
        'tanggal_produksi' => 'required|date',
    ]);

    $produksi = Produksi::findOrFail($id);
    $produksi->update($request->only(['nama_produk', 'stok', 'tanggal_produksi']));

    return redirect()->route('admin.produksi.index')->with('success', 'Data produksi berhasil diperbarui.');
}

    public function destroy($id)
    {
        $produksi = \App\Models\Produksi::findOrFail($id);
        $produksi->delete();

        return redirect()->route('admin.produksi.index')->with('success', 'Data produksi berhasil dihapus.');
    }
}
