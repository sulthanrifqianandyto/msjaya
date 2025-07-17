<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;

class WilayahSeeder extends Seeder
{
    public function run(): void
    {
        // ========== 1. PROVINSI ==========
        $provinsiData = json_decode(File::get(database_path('seeders/data/provinces.json')), true);
        foreach ($provinsiData as $prov) {
            Provinsi::create([
                'id' => $prov['id'],
                'nama' => $prov['name'],
            ]);
        }

        // ========== 2. KABUPATEN (REGENCIES) ==========
        $regencyFiles = File::files(database_path('seeders/data/regencies'));
        foreach ($regencyFiles as $file) {
            $regencyData = json_decode(File::get($file), true);
            foreach ($regencyData as $kab) {
                Kabupaten::create([
                    'id' => $kab['id'],
                    'provinsi_id' => $kab['province_id'],
                    'nama' => $kab['name'],
                ]);
            }
        }

        // ========== 3. KECAMATAN (DISTRICTS) ==========
        $districtFiles = File::files(database_path('seeders/data/districts'));
        foreach ($districtFiles as $file) {
            $districtData = json_decode(File::get($file), true);
            foreach ($districtData as $kec) {
                Kecamatan::create([
                    'id' => $kec['id'],
                    'kabupaten_id' => $kec['regency_id'],
                    'nama' => $kec['name'],
                ]);
            }
        }

        // ========== 4. KELURAHAN (VILLAGES) ==========
        $villageFiles = File::files(database_path('seeders/data/villages'));
        foreach ($villageFiles as $file) {
            $villageData = json_decode(File::get($file), true);
            foreach ($villageData as $kel) {
                Kelurahan::create([
                    'id' => $kel['id'],
                    'kecamatan_id' => $kel['district_id'],
                    'nama' => $kel['name'],
                ]);
            }
        }

        echo "\n✅ Wilayah Indonesia berhasil disimpan ke database!\n";
    }
}
