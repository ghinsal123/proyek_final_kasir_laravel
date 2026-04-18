<?php

namespace App\Models;

// Menggunakan HasFactory untuk fitur seeding/testing data
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    // Menentukan nama tabel yang digunakan di database
    protected $table = 'penjualan';

    // Kolom yang diizinkan untuk diisi secara mass assignment
    protected $fillable = [
        'pelanggan_id',        // ID pelanggan yang melakukan transaksi
        'tanggal_penjualan',   // Tanggal transaksi penjualan
        'total_harga',         // Total harga seluruh produk dalam transaksi
        'bayar',               // Jumlah uang yang dibayarkan pelanggan
        'kembalian',           // Uang kembalian dari transaksi
    ];

    /**
     * Relasi ke tabel Pelanggan
     * Setiap penjualan dimiliki oleh satu pelanggan
     */
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    /**
     * Relasi ke tabel DetailPenjualan
     * Satu penjualan memiliki banyak detail produk yang dibeli
     */
    public function detailPenjualan()
    {
        return $this->hasMany(DetailPenjualan::class, 'penjualan_id');
    }
}