<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('distribusi', function (Blueprint $table) {
            $table->unsignedBigInteger('pesanan_id')->nullable()->after('id_distribusi');

            // Buat foreign key ke tabel pesanan
            $table->foreign('pesanan_id')->references('id_pesanan')->on('pesanan')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('distribusi', function (Blueprint $table) {
            $table->dropForeign(['pesanan_id']);
            $table->dropColumn('pesanan_id');
        });
    }
};

