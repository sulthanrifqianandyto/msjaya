<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabel Provinsi
        Schema::create('provinsis', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->timestamps();
        });

        // Tabel Kabupaten
        Schema::create('kabupatens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('provinsi_id')->constrained('provinsis')->onDelete('cascade');
            $table->string('nama');
            $table->timestamps();
        });

        // Tabel Kecamatan
        Schema::create('kecamatans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kabupaten_id')->constrained('kabupatens')->onDelete('cascade');
            $table->string('nama');
            $table->timestamps();
        });

        // Tabel Kelurahan
        Schema::create('kelurahans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kecamatan_id')->constrained('kecamatans')->onDelete('cascade');
            $table->string('nama');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kelurahans');
        Schema::dropIfExists('kecamatans');
        Schema::dropIfExists('kabupatens');
        Schema::dropIfExists('provinsis');
    }
};
