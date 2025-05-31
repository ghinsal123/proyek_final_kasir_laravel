@extends('layout')

@section('content')
<h2>Daftar Penjualan</h2>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<a href="{{ route('penjualan.create') }}" class="btn btn-primary mb-3">Tambah Penjualan</a>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Kode Pelanggan</th>
            <th>Nama Pelanggan</th>
            <th>Total</th>
            <th>Bayar</th>
            <th>Kembalian</th>
            <th>Tanggal</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($penjualan as $index => $item)
        <tr>
            <td>{{ $loop->iteration + ($penjualan->currentPage() - 1) * $penjualan->perPage() }}</td>
            <td>{{ $item->pelanggan->kode_pelanggan ?? '-' }}</td>
            <td>{{ $item->pelanggan->nama_pelanggan ?? '-' }}</td>
            <td>Rp{{ number_format($item->total_harga, 0, ',', '.') }}</td>
            <td>Rp{{ number_format($item->bayar, 0, ',', '.') }}</td>
            <td>Rp{{ number_format($item->kembalian, 0, ',', '.') }}</td>
            <td>{{ $item->tanggal_penjualan }}</td>
            <td>
                <a href="{{ route('penjualan.show', $item->id) }}" class="btn btn-info btn-sm">Detail</a>
                <a href="{{ route('penjualan.cetak', $item->id) }}" target="_blank" class="btn btn-secondary btn-sm">Cetak</a>
                <form action="{{ route('penjualan.destroy', $item->id) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Yakin ingin hapus penjualan ini?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm" type="submit">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="d-flex justify-content-center">
    {{ $penjualan->links() }}
</div>
@endsection
