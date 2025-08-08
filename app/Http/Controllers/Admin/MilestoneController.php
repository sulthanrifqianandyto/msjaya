<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Milestone;
use App\Models\Produksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Barryvdh\DomPDF\Facade\Pdf;

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

public function laporan()
{
    if (auth()->user()->role !== 'pemilik') {
        abort(403, 'Akses ditolak.');
    }

    $milestones = Milestone::orderBy('tanggal_mulai')->get();

    // Untuk setiap milestone, bisa hitung produksi berdasar rentang tanggal saat di view
    return view('admin.laporan.milestone', compact('milestones'));
}

public function exportCSV(Request $request)
{
    $milestones = Milestone::all(); // sesuaikan jika ingin filter

    $csvData = [];
    $csvData[] = ['No', 'Nama Target', 'Tanggal Mulai', 'Tanggal Selesai', 'Target Produksi', 'Total Produksi', 'Pencapaian (%)', 'Status'];

    foreach ($milestones as $i => $milestone) {
        $totalProduksi = Produksi::whereBetween('tanggal_produksi', [
            $milestone->tanggal_mulai,
            $milestone->tanggal_selesai
        ])->sum('stok');

        $pencapaian = $milestone->target > 0 ? round(($totalProduksi / $milestone->target) * 100, 2) : 0;
        $status = $milestone->status === 'sudah' ? 'Tercapai' : 'Belum Tercapai';

        $csvData[] = [
            $i + 1,
            $milestone->nama,
            $milestone->tanggal_mulai,
            $milestone->tanggal_selesai,
            $milestone->target,
            $totalProduksi,
            $pencapaian . '%',
            $status,
        ];
    }

    $filename = 'laporan_target_produksi.csv';
    $handle = fopen('php://temp', 'r+');

    foreach ($csvData as $row) {
        fputcsv($handle, $row);
    }

    rewind($handle);
    $content = stream_get_contents($handle);
    fclose($handle);

    return Response::make($content, 200, [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => "attachment; filename={$filename}",
    ]);
}

public function exportPDF(Request $request)
{
    $milestones = Milestone::all(); // sesuaikan jika ingin filter

    foreach ($milestones as $milestone) {
        $totalProduksi = Produksi::whereBetween('tanggal_produksi', [
            $milestone->tanggal_mulai,
            $milestone->tanggal_selesai
        ])->sum('stok');

        $milestone->total_produksi = $totalProduksi;
        $milestone->pencapaian = $milestone->target > 0 ? round(($totalProduksi / $milestone->target) * 100, 2) : 0;
        $milestone->status_lengkap = $milestone->status === 'sudah' ? 'Tercapai' : 'Belum Tercapai';
    }

    $pdf = Pdf::loadView('admin.laporan.milestone_pdf', compact('milestones'))->setPaper('a4', 'landscape');
    return $pdf->stream('laporan_target_produksi.pdf');
}

}

