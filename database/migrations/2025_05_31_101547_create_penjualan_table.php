<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Migration untuk membuat tabel penjualan
return new class extends Migration
{
    /**
     * Menjalankan migration (membuat tabel penjualan)
     */
    public function up(): void
    {
        Schema::create('penjualan', function (Blueprint $table) {

            // Primary key auto increment
            $table->id();

            // Foreign key ke tabel pelanggan
            // Jika pelanggan dihapus, data penjualan ikut terhapus (cascade)
            $table->foreignId('pelanggan_id')
                ->constrained('pelanggan')
                ->cascadeOnDelete();

            // Tanggal transaksi penjualan
            $table->date('tanggal_penjualan');

            // Total harga transaksi (decimal untuk angka desimal)
            $table->decimal('total_harga', 10, 2);

            // Jumlah uang yang dibayarkan pelanggan
            $table->integer('bayar');

            // Kembalian dari transaksi
            $table->integer('kembalian');

            // Created_at dan updated_at otomatis
            $table->timestamps();
        });
    }

    /**
     * Menghapus tabel penjualan jika rollback migration
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualan');
    }
};