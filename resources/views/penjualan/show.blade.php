@extends('layout')

@section('content')
<div class="container-fluid mt-4">

    <!-- Judul halaman -->
    <h2 class="mb-4 fs-4 fs-md-3">Detail Penjualan</h2>

    <div class="row g-3">

        {{-- Informasi Transaksi --}}
        <div class="col-12 col-md-6">
            <div class="card shadow-sm h-100">

                <!-- Header card transaksi -->
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0 fs-6 fs-md-5">Informasi Transaksi</h5>
                </div>

                <div class="card-body">

                    <!-- Tabel informasi transaksi -->
                    <div class="table-responsive">
                        <table class="table table-borderless mb-0">
                            <tbody>

                                <!-- Kode pelanggan -->
                                <tr>
                                    <th>Kode Pelanggan</th>
                                    <td class="text-nowrap">
                                        {{ $penjualan->pelanggan->kode_pelanggan ?? '-' }}
                                    </td>
                                </tr>

                                <!-- Tanggal transaksi -->
                                <tr>
                                    <th>Tanggal</th>
                                    <td class="text-nowrap">
                                        {{ $penjualan->tanggal_penjualan }}
                                    </td>
                                </tr>

                                <!-- Nama pelanggan -->
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

                <!-- Header card pembayaran -->
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0 fs-6 fs-md-5">Informasi Pembayaran</h5>
                </div>

                <div class="card-body">

                    <!-- Tabel pembayaran -->
                    <div class="table-responsive">
                        <table class="table table-borderless mb-0">
                            <tbody>

                                <!-- Total harga transaksi -->
                                <tr>
                                    <th>Total Harga</th>
                                    <td class="text-nowrap">
                                        Rp{{ number_format($penjualan->total_harga, 0, ',', '.') }}
                                    </td>
                                </tr>

                                <!-- Uang yang dibayar -->
                                <tr>
                                    <th>Bayar</th>
                                    <td class="text-nowrap">
                                        Rp{{ number_format($penjualan->bayar, 0, ',', '.') }}
                                    </td>
                                </tr>

                                <!-- Kembalian -->
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

        <!-- Header detail produk -->
        <div class="card-header bg-info text-white">
            <h5 class="mb-0 fs-6 fs-md-5">Detail Produk</h5>
        </div>

        <div class="card-body p-0">

            <!-- Tabel responsif produk -->
            <div class="table-responsive">
                <table class="table table-striped table-hover m-0">

                    <!-- Header tabel produk -->
                    <thead class="text-nowrap">
                        <tr>
                            <th>No</th>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>

                    <!-- Isi detail produk -->
                    <tbody>

                        <!-- Loop detail penjualan -->
                        @foreach($penjualan->detailPenjualan as $index => $detail)
                        <tr>

                            <!-- Nomor urut -->
                            <td>{{ $index + 1 }}</td>

                            <!-- Nama produk -->
                            <td class="fw-semibold">
                                {{ $detail->produk->nama_produk ?? 'Produk tidak ditemukan' }}
                            </td>

                            <!-- Harga satuan -->
                            <td class="text-nowrap">
                                Rp{{ number_format($detail->harga_satuan ?? 0, 0, ',', '.') }}
                            </td>

                            <!-- Jumlah produk -->
                            <td>{{ $detail->jumlah_produk ?? 0 }}</td>

                            <!-- Subtotal -->
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

    <!-- Tombol kembali -->
    <div class="mt-3">
        <a href="{{ route('penjualan.index') }}" class="btn btn-secondary btn-sm">
            Kembali
        </a>
    </div>

</div>
@endsection