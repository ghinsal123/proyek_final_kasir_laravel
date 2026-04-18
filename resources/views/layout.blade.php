<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Charset agar mendukung semua karakter -->
    <meta charset="UTF-8" />

    <!-- Agar tampilan responsive di semua device -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Judul aplikasi di tab browser -->
    <title>Kasir Laravel</title>

    <!-- Import Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Import Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<!-- Padding top supaya konten tidak tertutup navbar fixed -->
<body style="padding-top: 70px;">

<!-- =========================
        NAVBAR UTAMA
========================= -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm fixed-top">

  <div class="container-fluid px-3 px-md-4">

    <!-- Logo / Brand aplikasi -->
    <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">
        🛒 KasirGhins
    </a>

    <!-- Tombol toggle untuk tampilan mobile -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarKasir">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Menu navbar -->
    <div class="collapse navbar-collapse" id="navbarKasir">

      <!-- ms-auto = dorong menu ke kanan -->
      <ul class="navbar-nav ms-auto text-center text-lg-start">

        <!-- Menu Dashboard -->
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" 
             href="{{ route('dashboard') }}">
             Dashboard
          </a>
        </li>

        <!-- Menu Pelanggan -->
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('pelanggan.*') ? 'active' : '' }}" 
             href="{{ route('pelanggan.index') }}">
             Pelanggan
          </a>
        </li>

        <!-- Menu Produk -->
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('produk.*') ? 'active' : '' }}" 
             href="{{ route('produk.index') }}">
             Produk
          </a>
        </li>

        <!-- Menu Penjualan -->
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('penjualan.*') ? 'active' : '' }}" 
             href="{{ route('penjualan.index') }}">
             Penjualan
          </a>
        </li>

      </ul>
    </div>
  </div>
</nav>

<!-- =========================
      CONTAINER UTAMA
========================= -->
<div class="container-fluid px-3 px-md-4 mt-3 pb-5">

    <!-- Tempat semua halaman child (dashboard, produk, dll) -->
    @yield('content')

</div>

<!-- Import Bootstrap JS (untuk navbar toggle dll) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>