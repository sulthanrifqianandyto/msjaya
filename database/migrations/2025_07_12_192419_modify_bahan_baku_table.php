<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('bahan_baku', function (Blueprint $table) {
        $table->dropColumn('satuan'); // Hapus kolom satuan
        $table->decimal('stok', 10, 2)->change(); // Ubah stok jadi desimal (10 digit total, 2 digit di belakang koma)
    });
}

public function down()
{
    Schema::table('bahan_baku', function (Blueprint $table) {
        $table->string('satuan')->after('stok'); // Tambah lagi kalau rollback
        $table->integer('stok')->change(); // Balik ke tipe integer
    });
}

};
