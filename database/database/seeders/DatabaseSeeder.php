<?php

namespace Database\Seeders;

use App\Models\Pelanggan;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
Pelanggan::firstOrCreate(
    ['email' => 'test@example.com'],
    [
        'nama' => 'Test User',
        'alamat' => 'Contoh Alamat',
        'no_hp' => '08123456789',
        'password' => bcrypt('password')
    ]
);

        

         // Admin
    Admin::create([
        'name' => 'Super Admin',
        'email' => 'admin@example.com',
        'password' => Hash::make('password'),
        'role' => 'admin',
    ]);

    // Pemilik
    Admin::create([
        'name' => 'Pemilik Utama',
        'email' => 'pemilik@example.com',
        'password' => Hash::make('password'),
        'role' => 'pemilik',
    ]);

    // Staff
    Admin::create([
        'name' => 'Staff Produksi',
        'email' => 'staff@example.com',
        'password' => Hash::make('password'),
        'role' => 'staff',
    ]);
    }
}
