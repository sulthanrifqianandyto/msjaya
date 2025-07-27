<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::table('bahan_baku', function (Blueprint $table) {
        $table->foreignId('provinsi_id')->nullable()->constrained('provinsis');
        $table->foreignId('kabupaten_id')->nullable()->constrained('kabupatens');
        $table->foreignId('kecamatan_id')->nullable()->constrained('kecamatans');
        $table->foreignId('kelurahan_id')->nullable()->constrained('kelurahans');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bahan_baku', function (Blueprint $table) {
        $table->foreignId('provinsi_id')->nullable()->constrained('provinsis');
        $table->foreignId('kabupaten_id')->nullable()->constrained('kabupatens');
        $table->foreignId('kecamatan_id')->nullable()->constrained('kecamatans');
        $table->foreignId('kelurahan_id')->nullable()->constrained('kelurahans');
    });
    }
};
