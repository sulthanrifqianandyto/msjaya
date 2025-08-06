<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Milestone;
use App\Models\Produksi;
use Illuminate\Http\Request;

class MilestoneController extends Controller
{
    // Tampilkan semua milestone
    public function index()
    {
        if (auth()->user()->role !== 'staff') {
        abort(403, 'Akses ditolak.');
    }
        $milestones = Milestone::orderBy('id', 'asc')->get();
        return view('admin.milestone.index', compact('milestones'));
    }

    // Simpan milestone baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'target' => 'required|integer|min:1',
        ]);

        Milestone::create($request->all());

        return redirect()->route('admin.milestone.index')->with('success', 'Target berhasil ditambahkan.');
    }

    // Tampilkan detail dan grafik milestone
    public function show($id)
    {
        $milestone = Milestone::findOrFail($id);

        // Ambil data produksi dari tabel produksi dalam rentang milestone
        $produksi = Produksi::whereBetween('tanggal_produksi', [
                $milestone->tanggal_mulai,
                $milestone->tanggal_selesai,
            ])
            ->orderBy('tanggal_produksi')
            ->get()
            ->groupBy('tanggal_produksi')
            ->map(function ($items) {
                return $items->sum('stok');
            });

        // Hitung total produksi
        $total_produksi = $produksi->sum();
        $persentase = min(100, round(($total_produksi / $milestone->target) * 100, 2));

        return view('admin.milestone.show', compact('milestone', 'produksi', 'total_produksi', 'persentase'));
    }

        public function create()
        {
            return view('admin.milestone.create');
        }
        public function edit($id)
        {
            $milestone = Milestone::findOrFail($id);
            return view('admin.milestone.edit', compact('milestone'));
        }

    // Update milestone
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'target' => 'required|integer|min:1',
        ]);

        $milestone = Milestone::findOrFail($id);
        $milestone->update($request->all());

        return redirect()->route('admin.milestone.index')->with('success', 'Target berhasil diperbarui.');
    }

    // Hapus milestone
    public function destroy($id)
    {
        $milestone = Milestone::findOrFail($id);
        $milestone->delete();

        return redirect()->route('admin.milestone.index')->with('success', 'Target berhasil dihapus.');
    }

    // (Opsional) Endpoint AJAX untuk grafik realtime
    public function data($id)
    {
        $milestone = Milestone::findOrFail($id);

        $produksi = Produksi::whereBetween('tanggal_produksi', [
                $milestone->tanggal_mulai,
                $milestone->tanggal_selesai,
            ])
            ->orderBy('tanggal_produksi')
            ->get()
            ->groupBy('tanggal_produksi')
            ->map(function ($items) {
                return $items->sum('stok');
            });

        return response()->json([
            'labels' => $produksi->keys(),
            'data' => $produksi->values(),
        ]);
    }

    public function konfirmasi($id)
{
    $milestone = Milestone::findOrFail($id);

    // Optional: validasi apakah target sudah tercapai
    $produksi = Produksi::whereBetween('tanggal_produksi', [
        $milestone->tanggal_mulai,
        $milestone->tanggal_selesai,
    ])->sum('stok');

    if ($produksi < $milestone->target) {
        return redirect()->back()->with('error', 'Target belum tercapai. Tidak bisa dikonfirmasi.');
    }

    $milestone->update([
        'status' => 'sudah'
    ]);

    return redirect()->back()->with('success', 'Milestone berhasil dikonfirmasi.');
}

}

