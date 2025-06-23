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
        
Schema::create('milestones', function (Blueprint $table) {
    $table->id();
    $table->string('nama'); // Nama milestone, contoh: "Target Juni"
    $table->date('tanggal_mulai');
    $table->date('tanggal_selesai');
    $table->integer('target'); // Target produksi dalam kg
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('milestones');
    }
};
