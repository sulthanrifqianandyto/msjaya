<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
{
    Schema::table('pesanan', function (Blueprint $table) {
        $table->foreignId('provinsi_id')->nullable()->constrained('provinsis');
        $table->foreignId('kabupaten_id')->nullable()->constrained('kabupatens');
        $table->foreignId('kecamatan_id')->nullable()->constrained('kecamatans');
        $table->foreignId('kelurahan_id')->nullable()->constrained('kelurahans');
    });
}


    public function down(): void
    {
        Schema::table('pesanan', function (Blueprint $table) {
            $table->dropForeign(['provinsi_id']);
            $table->dropForeign(['kabupaten_id']);
            $table->dropForeign(['kecamatan_id']);
            $table->dropForeign(['kelurahan_id']);

            $table->dropColumn(['provinsi_id', 'kabupaten_id', 'kecamatan_id', 'kelurahan_id']);
        });
    }
};
