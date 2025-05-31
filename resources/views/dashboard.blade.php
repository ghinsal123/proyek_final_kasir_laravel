@extends('layout')

@section('content')
<div class="container">
    <h1 class="mb-4">Dashboard Kasir</h1>

    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card text-white bg-success h-100 shadow">
                <div class="card-body text-center d-flex flex-column justify-content-center">
                    <h5 class="card-title">Total Pelanggan</h5>
                    <p class="display-5 fw-bold">{{ $totalPelanggan }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-dark bg-warning h-100 shadow">
                <div class="card-body text-center d-flex flex-column justify-content-center">
                    <h5 class="card-title">Total Produk</h5>
                    <p class="display-5 fw-bold">{{ $totalProduk }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-primary h-100 shadow">
                <div class="card-body text-center d-flex flex-column justify-content-center">
                    <h5 class="card-title">Total Penjualan</h5>
                    <p class="display-5 fw-bold">{{ $totalPenjualan }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-light">
            <h5 class="mb-0">Penjualan Terakhir</h5>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped table-hover m-0">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Pelanggan</th>
                        <th>Total Harga</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($penjualanTerakhir as $penjualan)
                        <tr>
                            <td>{{ $penjualan->id }}</td>
                            <td>{{ $penjualan->pelanggan->nama_pelanggan ?? '-' }}</td>
                            <td>Rp{{ number_format($penjualan->total_harga, 0, ',', '.') }}</td>
                            <td>{{ $penjualan->tanggal_penjualan }}</td>
                            <td>
                                <a href="{{ route('penjualan.show', $penjualan->id) }}" class="btn btn-info btn-sm">Detail</a>
                            </td>
                        </tr>
                    @endforeach
                    @if ($penjualanTerakhir->isEmpty())
                        <tr>
                            <td colspan="5" class="text-center text-muted">Belum ada penjualan</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
