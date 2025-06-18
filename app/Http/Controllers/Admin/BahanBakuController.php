<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BahanBakuController extends Controller
{
        protected $fillable = ['nama_bahan', 'stok', 'satuan', 'tanggal_masuk']; // atau kolom lain yang kamu pakai

    public function index()
    {
        $bahanbaku = \App\Models\BahanBaku::all();
        return view('admin.bahanbaku.index', compact('bahanbaku'));
    }

    public function create()
    {
        return view('admin.bahanbaku.create');
    }

    public function store(Request $request)
    {
    \App\Models\BahanBaku::create($request->all());
    return redirect()->route('admin.bahanbaku.index')->with('success', 'Bahanbaku berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $bahanbaku = \App\Models\Bahanbaku::findOrFail($id);
        return view('admin.bahanbaku.edit', compact('bahanbaku'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_bahan' => 'required|string',
            'stok' => 'required|integer',
            'satuan' => 'required|string',
            'tanggal_masuk' => 'required|date',
        ]);

        $bahanbaku = \App\Models\Bahanbaku::findOrFail($id);
        $bahanbaku->update($request->all());

        return redirect()->route('admin.bahanbaku.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
                $bahanbaku = \App\Models\Bahanbaku::findOrFail($id);
        $bahanbaku->delete();

        return redirect()->route('admin.bahanbaku.index')->with('success', 'Data berhasil dihapus.');
    }
}
