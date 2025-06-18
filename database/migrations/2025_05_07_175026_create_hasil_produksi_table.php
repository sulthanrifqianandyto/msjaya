<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hasil_produksi', function (Blueprint $table) {
            $table->id('id_hasil');
            $table->string('nama_produk');
            $table->integer('stok');
            $table->string('satuan');
            $table->date('tanggal');
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_produksi');
    }
};
