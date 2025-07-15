<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BahanBaku;

class BahanBakuController extends Controller
{
    public function index()
    {
        // Urutkan berdasarkan tanggal masuk terbaru
        $bahanbaku = BahanBaku::orderBy('tanggal_masuk', 'desc')->get();
        return view('admin.bahanbaku.index', compact('bahanbaku'));
    }

    public function create()
    {
        return view('admin.bahanbaku.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_bahan' => 'required|string',
            'stok' => 'required|numeric|min:0',
            'tanggal_masuk' => 'required|date',
        ]);

        BahanBaku::create($request->only(['nama_bahan', 'stok', 'tanggal_masuk']));

        return redirect()->route('admin.bahanbaku.index')->with('success', 'Bahan baku berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $bahanbaku = BahanBaku::findOrFail($id);
        return view('admin.bahanbaku.edit', compact('bahanbaku'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_bahan' => 'required|string',
            'stok' => 'required|numeric|min:0',
            'tanggal_masuk' => 'required|date',
        ]);

        $bahanbaku = BahanBaku::findOrFail($id);
        $bahanbaku->update($request->only(['nama_bahan', 'stok', 'tanggal_masuk']));

        return redirect()->route('admin.bahanbaku.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $bahanbaku = BahanBaku::findOrFail($id);
        $bahanbaku->delete();

        return redirect()->route('admin.bahanbaku.index')->with('success', 'Data berhasil dihapus.');
    }
}
