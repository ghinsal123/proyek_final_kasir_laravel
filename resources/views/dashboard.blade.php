@extends('layout')

@section('content')
<div class="container-fluid">

    <!-- Judul halaman dashboard -->
    <h1 class="mb-4 fs-4 fs-md-3">Dashboard Kasir</h1>

    <!-- =========================
         SECTION STATISTIK CARD
    ========================== -->
    <div class="row g-3 g-md-4 mb-4">

        <!-- Card total pelanggan -->
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card text-white bg-success h-100 shadow">
                <div class="card-body text-center">

                    <!-- Judul card -->
                    <h6 class="card-title fs-6">Total Pelanggan</h6>

                    <!-- Data total pelanggan dari database -->
                    <p class="fs-1 fw-bold">{{ $totalPelanggan }}</p>

                </div>
            </div>
        </div>

        <!-- Card total produk -->
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card text-dark bg-warning h-100 shadow">
                <div class="card-body text-center">

                    <!-- Judul card -->
                    <h6 class="card-title fs-6">Total Produk</h6>

                    <!-- Data total produk -->
                    <p class="fs-1 fw-bold">{{ $totalProduk }}</p>

                </div>
            </div>
        </div>

        <!-- Card total penjualan -->
        <div class="col-12 col-lg-4">
            <div class="card text-white bg-primary h-100 shadow">
                <div class="card-body text-center">

                    <!-- Judul card -->
                    <h6 class="card-title fs-6">Total Penjualan</h6>

                    <!-- Data total penjualan -->
                    <p class="fs-1 fw-bold">{{ $totalPenjualan }}</p>

                </div>
            </div>
        </div>

    </div>

    <!-- =========================
         SECTION TABEL PENJUALAN
    ========================== -->
    <div class="card shadow-sm">

        <!-- Header tabel -->
        <div class="card-header bg-light">
            <h5 class="mb-0 fs-6 fs-md-5">Penjualan Terakhir</h5>
        </div>

        <!-- Body tabel -->
        <div class="card-body p-0">

            <!-- Wrapper agar tabel bisa scroll di HP -->
            <div class="table-responsive">

                <table class="table table-striped table-hover m-0">

                    <!-- Header kolom tabel -->
                    <thead class="table-primary text-nowrap">
                        <tr>
                            <th>ID</th>
                            <th>Pelanggan</th>
                            <th>Total Harga</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <!-- Isi tabel -->
                    <tbody>

                        <!-- Loop data penjualan terbaru -->
                        @foreach ($penjualanTerakhir as $penjualan)
                        <tr>

                            <!-- ID transaksi -->
                            <td>{{ $penjualan->id }}</td>

                            <!-- Nama pelanggan (relasi) -->
                            <td>{{ $penjualan->pelanggan->nama_pelanggan ?? '-' }}</td>

                            <!-- Total harga format rupiah -->
                            <td class="text-nowrap">
                                Rp{{ number_format($penjualan->total_harga, 0, ',', '.') }}
                            </td>

                            <!-- Tanggal transaksi -->
                            <td class="text-nowrap">
                                {{ $penjualan->tanggal_penjualan }}
                            </td>

                            <!-- Tombol detail -->
                            <td>
                                <a href="{{ route('penjualan.show', $penjualan->id) }}"
                                   class="btn btn-info btn-sm">
                                   Detail
                                </a>
                            </td>

                        </tr>
                        @endforeach

                        <!-- Jika tidak ada data penjualan -->
                        @if ($penjualanTerakhir->isEmpty())
                        <tr>
                            <td colspan="5" class="text-center text-muted">
                                Belum ada penjualan
                            </td>
                        </tr>
                        @endif

                    </tbody>

                </table>

            </div>
        </div>
    </div>

</div>
@endsection