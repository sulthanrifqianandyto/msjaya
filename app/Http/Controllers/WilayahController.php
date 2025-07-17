<?php

namespace App\Http\Controllers;

use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use Illuminate\Http\Request;

class WilayahController extends Controller
{
    public function getKabupaten(Request $request)
    {
        $kabupatens = Kabupaten::where('provinsi_id', $request->provinsi_id)->get();
        return response()->json($kabupatens);
    }

    public function getKecamatan(Request $request)
    {
        $kecamatans = Kecamatan::where('kabupaten_id', $request->kabupaten_id)->get();
        return response()->json($kecamatans);
    }

    public function getKelurahan(Request $request)
    {
        $kelurahans = Kelurahan::where('kecamatan_id', $request->kecamatan_id)->get();
        return response()->json($kelurahans);
    }
}
