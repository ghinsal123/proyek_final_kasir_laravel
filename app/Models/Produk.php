<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';

    protected $fillable = ['nama_produk', 'harga', 'stok', 'deskripsi','foto'];

    public function detailPenjualan()
    {
        return $this->hasMany(DetailPenjualan::class);
    }
}
