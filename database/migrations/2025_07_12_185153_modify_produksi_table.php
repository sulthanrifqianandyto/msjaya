<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyProduksiTable extends Migration
{
    public function up(): void
    {
        Schema::table('produksi', function (Blueprint $table) {
            // Hapus kolom 'satuan'
            $table->dropColumn('satuan');

            // Ubah kolom 'stok' jadi decimal
            $table->decimal('stok', 10, 2)->change();

            // (Opsional) Tambahkan validasi enum/cek nama_produk, tapi default hanya bisa 1 value di MySQL
            $table->string('nama_produk', 255)->default('beras organik')->change();
        });
    }

    public function down(): void
    {
        Schema::table('produksi', function (Blueprint $table) {
            // Tambahkan kembali kolom 'satuan'
            $table->string('satuan')->nullable();

            // Kembalikan 'stok' ke tipe int
            $table->integer('stok')->change();

            // Hapus default nama_produk
            $table->string('nama_produk', 255)->default(null)->change();
        });
    }
}
