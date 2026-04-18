<?php

namespace App\Models;

// Menggunakan factory untuk keperluan seeding/testing data
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    // Menentukan nama tabel yang digunakan di database
    protected $table = 'pelanggan';

    // Kolom yang boleh diisi secara mass assignment
    protected $fillable = [
        'nama_pelanggan',  // Nama pelanggan
        'kode_pelanggan',  // Kode unik pelanggan
        'alamat',          // Alamat pelanggan
        'nomor_telepon',   // Nomor telepon pelanggan
        'email'            // Email pelanggan
    ];

    /**
     * Relasi ke tabel Penjualan
     * Satu pelanggan dapat memiliki banyak transaksi penjualan
     */
    public function penjualan()
    {
        return $this->hasMany(Penjualan::class);
    }
}