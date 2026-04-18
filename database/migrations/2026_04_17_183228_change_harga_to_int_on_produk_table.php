<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Migration untuk mengubah tipe data kolom harga pada tabel produk
return new class extends Migration
{
    /**
     * Menjalankan migration (mengubah kolom harga menjadi integer)
     */
    public function up()
    {
        Schema::table('produk', function (Blueprint $table) {

            // Mengubah tipe data kolom harga dari decimal menjadi integer
            // Biasanya digunakan jika ingin harga tanpa angka desimal
            $table->integer('harga')->change();
        });
    }

    /**
     * Rollback migration (mengembalikan kolom harga ke decimal)
     */
    public function down()
    {
        Schema::table('produk', function (Blueprint $table) {

            // Mengembalikan tipe data harga ke decimal (10,2)
            // Agar bisa menyimpan angka pecahan seperti 10000.50
            $table->decimal('harga', 10, 2)->change();
        });
    }
};