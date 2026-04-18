<?php

namespace App\Http\Controllers;

// Mengimpor model yang dibutuhkan
use App\Models\Penjualan;
use App\Models\Pelanggan;
use App\Models\Produk;

class DashboardController extends Controller
{
    public function index()
    {
        // Menampilkan halaman dashboard dengan mengirim data ke view
        return view('dashboard', [

            // Menghitung total seluruh data penjualan
            'totalPenjualan' => Penjualan::count(),

            // Menghitung total seluruh data pelanggan
            'totalPelanggan' => Pelanggan::count(),

            // Menghitung total seluruh data produk
            'totalProduk' => Produk::count(),

            // Mengambil 5 data penjualan terbaru
            // beserta data relasi pelanggan
            'penjualanTerakhir' => Penjualan::with('pelanggan')
                ->orderBy('tanggal_penjualan', 'desc')
                ->limit(5)
                ->get(),
        ]);
    }
}