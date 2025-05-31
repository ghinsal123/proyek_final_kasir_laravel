<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Pelanggan;
use App\Models\Produk;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'totalPenjualan' => Penjualan::count(),
            'totalPelanggan' => Pelanggan::count(),
            'totalProduk' => Produk::count(),
            'penjualanTerakhir' => Penjualan::with('pelanggan')->orderBy('tanggal_penjualan', 'desc')->limit(5)->get(),
        ]);
    }
}
