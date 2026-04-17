<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Set karakter & responsive viewport -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Judul halaman -->
    <title>Kasir Laravel</title>

    <!-- Import CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Import Icon Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<!-- Tambahin padding-top biar gak ketiban navbar -->
<body style="padding-top: 70px;">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm fixed-top">
  <div class="container-fluid px-3 px-md-4">

    <!-- Logo -->
    <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">
        🛒 KasirGhins
    </a>

    <!-- Toggle mobile -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarKasir">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Menu -->
    <div class="collapse navbar-collapse" id="navbarKasir">
      <ul class="navbar-nav ms-auto text-center text-lg-start">

        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" 
             href="{{ route('dashboard') }}">
             Dashboard
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('pelanggan.*') ? 'active' : '' }}" 
             href="{{ route('pelanggan.index') }}">
             Pelanggan
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('produk.*') ? 'active' : '' }}" 
             href="{{ route('produk.index') }}">
             Produk
          </a>
        </li>

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

<!-- Container utama -->
<div class="container-fluid px-3 px-md-4 mt-3 pb-5">
    @yield('content')
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>