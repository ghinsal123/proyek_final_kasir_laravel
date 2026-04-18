<?php

namespace App\Models;

// Menggunakan fitur factory untuk seeding data
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPenjualan extends Model
{
    use HasFactory;

    // Menentukan nama tabel di database
    protected $table = 'detail_penjualan';

    // Kolom yang boleh diisi secara mass assignment
    protected $fillable = [
        'penjualan_id',    // Relasi ke tabel penjualan
        'produk_id',       // Relasi ke tabel produk
        'jumlah_produk',   // Jumlah produk yang dibeli
        'harga_satuan',    // Harga per satuan produk saat transaksi
        'subtotal',        // Total harga per item (harga_satuan x jumlah_produk)
    ];

    /**
     * Relasi ke tabel Penjualan
     * Satu detail penjualan milik satu transaksi penjualan
     */
    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class);
    }

    /**
     * Relasi ke tabel Produk
     * Setiap detail penjualan berhubungan dengan satu produk
     */
    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}