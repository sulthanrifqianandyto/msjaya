<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BahanBaku;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function bahanBaku()
    {
        $bahanBakus = BahanBaku::with(['provinsi', 'kabupaten', 'kecamatan', 'kelurahan'])->get();
    return view('admin.laporan.bahanbaku', compact('bahanBakus'));
    }
}
