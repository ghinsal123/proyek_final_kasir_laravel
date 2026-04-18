<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| ROUTE CRUD PELANGGAN
|--------------------------------------------------------------------------
| Menggunakan Route::resource untuk otomatis membuat:
| index, create, store, show, edit, update, destroy
*/
Route::resource('pelanggan', PelangganController::class);

/*
|--------------------------------------------------------------------------
| ROUTE CRUD PRODUK
|--------------------------------------------------------------------------
| Mengelola data produk (tambah, edit, hapus, dll)
*/
Route::resource('produk', ProdukController::class);

/*
|--------------------------------------------------------------------------
| ROUTE CRUD PENJUALAN
|--------------------------------------------------------------------------
| Mengelola transaksi penjualan
*/
Route::resource('penjualan', PenjualanController::class);

/*
|--------------------------------------------------------------------------
| ROUTE CETAK STRUK PENJUALAN
|--------------------------------------------------------------------------
| Menampilkan halaman struk untuk dicetak (print)
| berdasarkan ID penjualan
*/
Route::get('/penjualan/{id}/cetak', [PenjualanController::class, 'cetak'])
    ->name('penjualan.cetak');

/*
|--------------------------------------------------------------------------
| ROUTE DASHBOARD
|--------------------------------------------------------------------------
| Halaman utama yang menampilkan statistik:
| total pelanggan, produk, penjualan, dan transaksi terbaru
*/
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');