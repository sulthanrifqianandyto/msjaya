<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produksi;
use Illuminate\Support\Facades\Response;
use Barryvdh\DomPDF\Facade\Pdf;

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

    public function laporan(Request $request)
{
    $produksi = \App\Models\Produksi::query();

    // Filter tanggal (opsional)
    if ($request->filled('tanggal_awal') && $request->filled('tanggal_akhir')) {
        $produksi->whereBetween('tanggal', [$request->tanggal_awal, $request->tanggal_akhir]);
    }

    return view('admin.laporan.produksi', [
        'produksi' => $produksi->get()
    ]);
}


    public function exportCsv(Request $request)
{
    $produksi = \App\Models\Produksi::query()
        ->when($request->filled('start_date') && $request->filled('end_date'), function ($q) use ($request) {
            $q->whereBetween('tanggal_produksi', [$request->start_date, $request->end_date]);
        })
        ->latest()
        ->get();

    $filename = 'laporan-produksi.csv';

    $headers = [
        "Content-type" => "text/csv",
        "Content-Disposition" => "attachment; filename=$filename",
        "Pragma" => "no-cache",
        "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
        "Expires" => "0"
    ];

    $callback = function () use ($produksi) {
        $file = fopen('php://output', 'w');
        // Header kolom
        fputcsv($file, ['ID', 'Nama Produk', 'Stok', 'Tanggal Produksi', 'Dibuat']);

        foreach ($produksi as $row) {
            fputcsv($file, [
                $row->id_produksi,
                $row->nama_produk,
                $row->stok,
                $row->tanggal_produksi,
                $row->created_at,
            ]);
        }

        fclose($file);
    };

    return Response::stream($callback, 200, $headers);
}

public function exportPdf(Request $request)
{
    $produksi = \App\Models\Produksi::query()
        ->when($request->filled('start_date') && $request->filled('end_date'), function ($q) use ($request) {
            $q->whereBetween('tanggal_produksi', [$request->start_date, $request->end_date]);
        })
        ->latest()
        ->get();

    $pdf = Pdf::loadView('admin.laporan.produksi_pdf', compact('produksi'));

    return $pdf->download('laporan_produksi.pdf');
}

}
