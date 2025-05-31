@extends('layout')

@section('content')
<div class="container">
    <h2>Detail Penjualan</h2>

    <div class="row">
        {{-- Informasi Transaksi --}}
        <div class="col-md-6 mb-3">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Informasi Transaksi</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless mb-0">
                        <tbody>
                            <tr>
                                <th>Kode Pelanggan</th>
                                <td>{{ $penjualan->pelanggan->kode_pelanggan ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal</th>
                                <td>{{ $penjualan->tanggal_penjualan }}</td>
                            </tr>
                            <tr>
                                <th>Pelanggan</th>
                                <td>{{ $penjualan->pelanggan->nama_pelanggan ?? '-' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Informasi Pembayaran --}}
        <div class="col-md-6 mb-3">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Informasi Pembayaran</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless mb-0">
                        <tbody>
                            <tr>
                                <th>Total Harga</th>
                                <td>Rp{{ number_format($penjualan->total_harga, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <th>Bayar</th>
                                <td>Rp{{ number_format($penjualan->bayar, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <th>Kembalian</th>
                                <td>Rp{{ number_format($penjualan->kembalian, 0, ',', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Detail Produk --}}
    <div class="card shadow-sm">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0">Detail Produk</h5>
        </div>
        <div class="card-body p-0">
            <table class="table table-bordered mb-0">
                <thead>
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
                            <td>{{ $detail->produk->nama_produk ?? 'Produk tidak ditemukan' }}</td>
                            <td>Rp{{ number_format($detail->harga_satuan ?? 0, 0, ',', '.') }}</td>
                            <td>{{ $detail->jumlah_produk ?? 0 }}</td>
                            <td>Rp{{ number_format($detail->subtotal ?? ($detail->jumlah_produk * $detail->harga_satuan), 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <a href="{{ route('penjualan.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
@endsection
