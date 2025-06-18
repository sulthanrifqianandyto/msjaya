<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BahanBaku;

class BahanBakuController extends Controller
{
    public function index()
    {
        $bahanbaku = BahanBaku::all();
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
            'stok' => 'required|integer',
            'satuan' => 'required|string',
            'tanggal_masuk' => 'required|date',
        ]);

        BahanBaku::create($request->all());

        return redirect()->route('admin.bahanbaku.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit(BahanBaku $bahanbaku)
    {
        return view('admin.bahanbaku.edit', compact('bahanbaku'));
    }

    public function update(Request $request, BahanBaku $bahanbaku)
    {
        $request->validate([
            'nama_bahan' => 'required|string',
            'stok' => 'required|integer',
            'satuan' => 'required|string',
            'tanggal_masuk' => 'required|date',
        ]);

        $bahanbaku->update($request->all());

        return redirect()->route('admin.bahanbaku.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(BahanBaku $bahanbaku)
    {
        $bahanbaku->delete();
        return redirect()->route('admin.bahanbaku.index')->with('success', 'Data berhasil dihapus.');
    }
}
