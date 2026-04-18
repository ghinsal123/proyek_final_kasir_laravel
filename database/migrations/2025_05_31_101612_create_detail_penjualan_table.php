<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Migration untuk membuat tabel detail_penjualan
class CreateDetailPenjualanTable extends Migration
{
    /**
     * Menjalankan migration (membuat tabel detail_penjualan)
     */
    public function up()
    {
        Schema::create('detail_penjualan', function (Blueprint $table) {

            // Primary key auto increment
            $table->id();

            // Foreign key ke tabel penjualan
            // Jika penjualan dihapus, detail ikut terhapus (cascade)
            $table->foreignId('penjualan_id')
                ->constrained('penjualan')
                ->onDelete('cascade');

            // Foreign key ke tabel produk
            // Jika produk dihapus, detail ikut terhapus (cascade)
            $table->foreignId('produk_id')
                ->constrained('produk')
                ->onDelete('cascade');

            // Jumlah produk yang dibeli dalam transaksi
            $table->integer('jumlah_produk');

            // Harga satuan produk saat transaksi (disimpan agar tidak berubah walau harga produk update)
            $table->bigInteger('harga_satuan');

            // Total harga per item (jumlah_produk x harga_satuan)
            $table->bigInteger('subtotal');

            // Created_at dan updated_at otomatis dari Laravel
            $table->timestamps();
        });
    }

    /**
     * Menghapus tabel detail_penjualan jika rollback migration
     */
    public function down()
    {
        Schema::dropIfExists('detail_penjualan');
    }
}