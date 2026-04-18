<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Migration untuk membuat tabel produk
return new class extends Migration
{
    /**
     * Menjalankan migration (membuat tabel produk)
     */
    public function up(): void
    {
        Schema::create('produk', function (Blueprint $table) {

            // Primary key auto increment
            $table->id();

            // Nama produk maksimal 255 karakter
            $table->string('nama_produk', 255);

            // Harga produk (decimal agar bisa menyimpan angka pecahan)
            $table->decimal('harga', 10, 2);

            // Stok barang yang tersedia
            $table->integer('stok');

            // Deskripsi produk (teks panjang)
            $table->text('deskripsi');

            // Foto produk (boleh kosong / null)
            $table->string('foto')->nullable();

            // Created_at dan updated_at otomatis dari Laravel
            $table->timestamps();
        });
    }

    /**
     * Menghapus tabel produk jika migration di-rollback
     */
    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};