<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use Illuminate\Support\Facades\Response;

class AdminLaporanController extends Controller
{
    public function exportPesananCSV()
    {
        $fileName = 'laporan_pesanan.csv';
        $pesanan = Pesanan::with('pelanggan')->get();

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['ID', 'Nama Pelanggan', 'Tanggal Pesanan', 'Status'];

        $callback = function () use ($pesanan, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($pesanan as $row) {
                fputcsv($file, [
                    $row->id,
                    $row->pelanggan->nama ?? '-',
                    $row->created_at->format('Y-m-d'),
                    $row->status,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
