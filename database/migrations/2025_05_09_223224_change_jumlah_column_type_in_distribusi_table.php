<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeJumlahColumnTypeInDistribusiTable extends Migration
{
    public function up()
    {
        Schema::table('distribusi', function (Blueprint $table) {
            $table->string('jumlah')->change(); // Mengubah tipe data menjadi VARCHAR
        });
    }

    public function down()
    {
        Schema::table('distribusi', function (Blueprint $table) {
            $table->integer('jumlah')->change(); // Mengembalikan ke tipe data INTEGER jika perlu
        });
    }
}

