<?php

namespace App\Models;

// Menggunakan HasFactory untuk keperluan seeding dan testing data
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    // Menentukan nama tabel di database
    protected $table = 'produk';

    // Kolom yang diizinkan untuk diisi secara mass assignment
    protected $fillable = [
        'nama_produk',  // Nama produk
        'harga',        // Harga satuan produk
        'stok',         // Jumlah stok produk yang tersedia
        'deskripsi',    // Deskripsi produk
        'foto'          // Gambar/foto produk
    ];

    /**
     * Relasi ke tabel DetailPenjualan
     * Satu produk dapat muncul di banyak detail transaksi penjualan
     */
    public function detailPenjualan()
    {
        return $this->hasMany(DetailPenjualan::class);
    }
}