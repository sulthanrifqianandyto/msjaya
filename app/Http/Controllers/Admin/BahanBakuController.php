<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BahanBaku;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;

class BahanBakuController extends Controller
{
    public function index(Request $request)
{
    if (auth()->user()->role !== 'pemilik' && auth()->user()->role !== 'staff') {
        abort(403, 'Akses ditolak.');
    }
    $query = BahanBaku::query();

    // Filter nama bahan
    if ($request->filled('nama_bahan')) {
        $query->where('nama_bahan', 'like', '%' . $request->nama_bahan . '%');
    }

    // Filter tanggal masuk
    if ($request->filled('tanggal_mulai') && $request->filled('tanggal_selesai')) {
        $query->whereBetween('tanggal_masuk', [$request->tanggal_mulai, $request->tanggal_selesai]);
    }

    // Filter kabupaten (khusus Jawa Barat)
    if ($request->filled('kabupaten_id')) {
        $query->where('kabupaten_id', $request->kabupaten_id);
    }

    // Ambil kabupaten yang hanya ada di Jawa Barat (id = 9 sesuai data emsifa)
    $kabupatens = Kabupaten::where('provinsi_id', 32)->get();

    $bahanbaku = $query->orderBy('tanggal_masuk', 'desc')->get();

    return view('admin.bahanbaku.index', compact('bahanbaku', 'kabupatens'));
}



    public function create()
    {
        $provinsis = Provinsi::all();
    return view('admin.bahanbaku.create', compact('provinsis'));
    }

    public function store(Request $request)
{
    $request->validate([
        'nama_bahan' => 'required|string',
        'stok' => 'required|numeric|min:0',
        'tanggal_masuk' => 'required|date',
        'provinsi_id' => 'required|exists:provinsis,id',
        'kabupaten_id' => 'required|exists:kabupatens,id',
        'kecamatan_id' => 'required|exists:kecamatans,id',
        'kelurahan_id' => 'required|exists:kelurahans,id',
    ]);

    // Gabungkan nama alamat
    $provinsi = Provinsi::find($request->provinsi_id)->nama ?? '';
    $kabupaten = Kabupaten::find($request->kabupaten_id)->nama ?? '';
    $kecamatan = Kecamatan::find($request->kecamatan_id)->nama ?? '';
    $kelurahan = Kelurahan::find($request->kelurahan_id)->nama ?? '';

    $alamat = "$kelurahan, $kecamatan, $kabupaten, $provinsi";

    BahanBaku::create([
    'nama_bahan' => $request->nama_bahan,
    'stok' => $request->stok,
    'tanggal_masuk' => $request->tanggal_masuk,
    'provinsi_id' => $request->provinsi_id,
    'kabupaten_id' => $request->kabupaten_id,
    'kecamatan_id' => $request->kecamatan_id,
    'kelurahan_id' => $request->kelurahan_id,
    'alamat_suplier' => $alamat,
]);


    return redirect()->route('admin.bahanbaku.index')->with('success', 'Bahan baku berhasil ditambahkan.');
}

    public function edit($id)
{
    $bahanbaku = BahanBaku::findOrFail($id);

    // Ambil semua provinsi untuk dropdown pertama
    $provinsis = Provinsi::all();

    // Ambil kabupaten sesuai dengan provinsi_id bahan baku
    $kabupatens = Kabupaten::where('provinsi_id', $bahanbaku->provinsi_id)->get();

    // Ambil kecamatan sesuai dengan kabupaten_id bahan baku
    $kecamatans = Kecamatan::where('kabupaten_id', $bahanbaku->kabupaten_id)->get();

    // Ambil kelurahan sesuai dengan kecamatan_id bahan baku
    $kelurahans = Kelurahan::where('kecamatan_id', $bahanbaku->kecamatan_id)->get();

    return view('admin.bahanbaku.edit', compact(
        'bahanbaku',
        'provinsis',
        'kabupatens',
        'kecamatans',
        'kelurahans'
    ));
}



    public function update(Request $request, $id)
{
    $request->validate([
        'nama_bahan' => 'required|string',
        'stok' => 'required|numeric|min:0',
        'tanggal_masuk' => 'required|date',
        'provinsi_id' => 'required|exists:provinsis,id',
        'kabupaten_id' => 'required|exists:kabupatens,id',
        'kecamatan_id' => 'required|exists:kecamatans,id',
        'kelurahan_id' => 'required|exists:kelurahans,id',
    ]);

    $bahanbaku = BahanBaku::findOrFail($id);

    // Buat alamat baru dari wilayah yang dipilih
    $provinsi = Provinsi::find($request->provinsi_id)->nama ?? '';
    $kabupaten = Kabupaten::find($request->kabupaten_id)->nama ?? '';
    $kecamatan = Kecamatan::find($request->kecamatan_id)->nama ?? '';
    $kelurahan = Kelurahan::find($request->kelurahan_id)->nama ?? '';

    $alamat = "$kelurahan, $kecamatan, $kabupaten, $provinsi";

    $bahanbaku->update([
    'nama_bahan' => $request->nama_bahan,
    'stok' => $request->stok,
    'tanggal_masuk' => $request->tanggal_masuk,
    'provinsi_id' => $request->provinsi_id,
    'kabupaten_id' => $request->kabupaten_id,
    'kecamatan_id' => $request->kecamatan_id,
    'kelurahan_id' => $request->kelurahan_id,
    'alamat_suplier' => $alamat,
]);


    return redirect()->route('admin.bahanbaku.index')->with('success', 'Data berhasil diperbarui.');
}   

    public function destroy($id)
    {
        $bahanbaku = BahanBaku::findOrFail($id);
        $bahanbaku->delete();

        return redirect()->route('admin.bahanbaku.index')->with('success', 'Data berhasil dihapus.');
    }

    public function exportCsv(Request $request)
{
    $query = BahanBaku::query();

    if ($request->filled('start_date') && $request->filled('end_date')) {
        $query->whereBetween('tanggal_masuk', [$request->start_date, $request->end_date]);
    }

    if ($request->filled('kabupaten_id')) {
        $query->where('kabupaten_id', $request->kabupaten_id);
    }

    $data = $query->get();

    $filename = "laporan_bahan_baku.csv";
    $headers = [
        "Content-type"        => "text/csv",
        "Content-Disposition" => "attachment; filename=$filename",
        "Pragma"              => "no-cache",
        "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
        "Expires"             => "0"
    ];

    $columns = ['ID', 'Nama Bahan', 'Stok', 'Tanggal Masuk', 'Alamat Suplier'];

    $callback = function () use ($data, $columns) {
        $file = fopen('php://output', 'w');
        fputcsv($file, $columns);

        foreach ($data as $bahan) {
            fputcsv($file, [
                $bahan->id_bahan,
                $bahan->nama_bahan,
                $bahan->stok,
                $bahan->tanggal_masuk,
                $bahan->alamat_suplier
            ]);
        }

        fclose($file);
    };

    return response()->stream($callback, 200, $headers);
}
}