<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('pesanan', function (Blueprint $table) {
        $table->id('id_pesanan');
        $table->unsignedBigInteger('pelanggan_id');
        $table->foreign('pelanggan_id')->references('id_pelanggan')->on('pelanggan')->onDelete('cascade');
        $table->string('item'); // nama beras
        $table->decimal('kuantitas', 8, 2); // per kg
        $table->text('alamat');
        $table->string('status')->default('menunggu');
        $table->timestamps(); // created_at akan otomatis jadi tanggal pembuatan
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
{
    Schema::dropIfExists('pesanan');
}

};
