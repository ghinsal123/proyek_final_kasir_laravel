<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Migration untuk membuat tabel pelanggan
return new class extends Migration
{
    /**
     * Menjalankan migration (membuat tabel)
     */
    public function up(): void
    {
        Schema::create('pelanggan', function (Blueprint $table) {

            // Primary key auto increment
            $table->id();

            // Kode unik pelanggan (contoh: PLG-0001)
            $table->string('kode_pelanggan');

            // Nama pelanggan maksimal 255 karakter
            $table->string('nama_pelanggan', 255);

            // Alamat pelanggan (teks panjang)
            $table->text('alamat');

            // Nomor telepon pelanggan (maks 15 karakter)
            $table->string('nomor_telepon', 15);

            // Email pelanggan
            $table->string('email');

            // Created_at dan updated_at otomatis dari Laravel
            $table->timestamps();
        });
    }

    /**
     * Menghapus tabel jika migration di rollback
     */
    public function down(): void
    {
        Schema::dropIfExists('pelanggan');
    }
};