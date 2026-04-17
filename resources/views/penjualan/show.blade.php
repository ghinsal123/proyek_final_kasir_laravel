@extends('layout')

@section('content')
<div class="container-fluid mt-4">

    <!-- Judul -->
    <h2 class="mb-4 fs-4 fs-md-3">Detail Penjualan</h2>

    <div class="row g-3">

        {{-- Informasi Transaksi --}}
        <div class="col-12 col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0 fs-6 fs-md-5">Informasi Transaksi</h5>
                </div>
                <div class="card-body">

                    <!-- Responsive table -->
                    <div class="table-responsive">
                        <table class="table table-borderless mb-0">
                            <tbody>
                                <tr>
                                    <th>Kode Pelanggan</th>
                                    <td class="text-nowrap">
                                        {{ $penjualan->pelanggan->kode_pelanggan ?? '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Tanggal</th>
                                    <td class="text-nowrap">
                                        {{ $penjualan->tanggal_penjualan }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Pelanggan</th>
                                    <td>
                                        {{ $penjualan->pelanggan->nama_pelanggan ?? '-' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

        {{-- Informasi Pembayaran --}}
        <div class="col-12 col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0 fs-6 fs-md-5">Informasi Pembayaran</h5>
                </div>
                <div class="card-body">

                    <!-- Responsive table -->
                    <div class="table-responsive">
                        <table class="table table-borderless mb-0">
                            <tbody>
                                <tr>
                                    <th>Total Harga</th>
                                    <td class="text-nowrap">
                                        Rp{{ number_format($penjualan->total_harga, 0, ',', '.') }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Bayar</th>
                                    <td class="text-nowrap">
                                        Rp{{ number_format($penjualan->bayar, 0, ',', '.') }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Kembalian</th>
                                    <td class="text-nowrap">
                                        Rp{{ number_format($penjualan->kembalian, 0, ',', '.') }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

    </div>

    {{-- Detail Produk --}}
    <div class="card shadow-sm mt-4">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0 fs-6 fs-md-5">Detail Produk</h5>
        </div>

        <div class="card-body p-0">

            <!-- 🔥 FIX: table bisa scroll -->
            <div class="table-responsive">
                <table class="table table-striped table-hover m-0">

                    <thead class="text-nowrap">
                        <tr>
                            <th>No</th>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($penjualan->detailPenjualan as $index => $detail)
                        <tr>
                            <td>{{ $index + 1 }}</td>

                            <td class="fw-semibold">
                                {{ $detail->produk->nama_produk ?? 'Produk tidak ditemukan' }}
                            </td>

                            <td class="text-nowrap">
                                Rp{{ number_format($detail->harga_satuan ?? 0, 0, ',', '.') }}
                            </td>

                            <td>{{ $detail->jumlah_produk ?? 0 }}</td>

                            <td class="text-nowrap">
                                Rp{{ number_format($detail->subtotal ?? ($detail->jumlah_produk * $detail->harga_satuan), 0, ',', '.') }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

        </div>
    </div>

    <!-- Tombol -->
    <div class="mt-3">
        <a href="{{ route('penjualan.index') }}" class="btn btn-secondary btn-sm">
            Kembali
        </a>
    </div>

</div>
@endsection