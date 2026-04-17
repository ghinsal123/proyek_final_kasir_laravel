@extends('layout')

@section('content')
<div class="container-fluid">

    <!-- Judul halaman -->
    <h1 class="mb-4 fs-4 fs-md-3">Dashboard Kasir</h1>

    <!-- Section Card Statistik -->
    <div class="row g-3 g-md-4 mb-4">

        <!-- Card Total Pelanggan -->
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card text-white bg-success h-100 shadow">
                <div class="card-body text-center">
                    <h6 class="card-title fs-6">Total Pelanggan</h6>
                    <p class="fs-1 fw-bold">{{ $totalPelanggan }}</p>
                </div>
            </div>
        </div>

        <!-- Card Total Produk -->
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card text-dark bg-warning h-100 shadow">
                <div class="card-body text-center">
                    <h6 class="card-title fs-6">Total Produk</h6>
                    <p class="fs-1 fw-bold">{{ $totalProduk }}</p>
                </div>
            </div>
        </div>

        <!-- Card Total Penjualan -->
        <div class="col-12 col-lg-4">
            <div class="card text-white bg-primary h-100 shadow">
                <div class="card-body text-center">
                    <h6 class="card-title fs-6">Total Penjualan</h6>
                    <p class="fs-1 fw-bold">{{ $totalPenjualan }}</p>
                </div>
            </div>
        </div>

    </div>

    <!-- Section Tabel Penjualan -->
    <div class="card shadow-sm">

        <!-- Header tabel -->
        <div class="card-header bg-light">
            <h5 class="mb-0 fs-6 fs-md-5">Penjualan Terakhir</h5>
        </div>

        <!-- Body tabel -->
        <div class="card-body p-0">

            <!-- Membuat tabel bisa discroll di layar kecil -->
            <div class="table-responsive">

                <table class="table table-striped table-hover m-0">

                    <!-- Header kolom -->
                    <thead class="table-primary text-nowrap">
                        <tr>
                            <th>ID</th>
                            <th>Pelanggan</th>
                            <th>Total Harga</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <!-- Isi data -->
                    <tbody>
                        @foreach ($penjualanTerakhir as $penjualan)
                        <tr>
                            <td>{{ $penjualan->id }}</td>

                            <!-- Menampilkan nama pelanggan (jika ada) -->
                            <td>{{ $penjualan->pelanggan->nama_pelanggan ?? '-' }}</td>

                            <!-- Format mata uang -->
                            <td class="text-nowrap">
                                Rp{{ number_format($penjualan->total_harga, 0, ',', '.') }}
                            </td>

                            <!-- Tanggal penjualan -->
                            <td class="text-nowrap">
                                {{ $penjualan->tanggal_penjualan }}
                            </td>

                            <!-- Tombol aksi -->
                            <td>
                                <a href="{{ route('penjualan.show', $penjualan->id) }}" 
                                   class="btn btn-info btn-sm">
                                   Detail
                                </a>
                            </td>
                        </tr>
                        @endforeach

                        <!-- Jika tidak ada data -->
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