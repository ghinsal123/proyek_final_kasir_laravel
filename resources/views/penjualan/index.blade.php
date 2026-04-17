@extends('layout')

@section('content')
<div class="container-fluid">

    <!-- Judul halaman -->
    <h1 class="mb-4 fs-4 fs-md-3">Data Penjualan</h1>

    <!-- Alert sukses -->
    @if(session('success'))
        <div class="alert alert-success fs-6">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tombol tambah -->
    <div class="mb-3">
        <a href="{{ route('penjualan.create') }}" class="btn btn-primary btn-sm">
            Tambah Penjualan
        </a>
    </div>

    <!-- Card -->
    <div class="card shadow-sm">

        <!-- Header -->
        <div class="card-header bg-light">
            <h5 class="mb-0 fs-6 fs-md-5">Daftar Penjualan</h5>
        </div>

        <!-- Body -->
        <div class="card-body p-0">

            <!-- 🔥 Biar bisa geser di HP -->
            <div class="table-responsive">

                <table class="table table-striped table-hover m-0">

                    <!-- Header -->
                    <thead class="table-primary text-nowrap">
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Total</th>
                            <th>Bayar</th>
                            <th>Kembalian</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <!-- Isi -->
                    <tbody>
                        @forelse ($penjualan as $item)
                        <tr>
                            <!-- Nomor urut pagination -->
                            <td>
                                {{ $loop->iteration + ($penjualan->currentPage() - 1) * $penjualan->perPage() }}
                            </td>

                            <td>{{ $item->pelanggan->kode_pelanggan ?? '-' }}</td>

                            <td class="fw-semibold">
                                {{ $item->pelanggan->nama_pelanggan ?? '-' }}
                            </td>

                            <!-- Format uang -->
                            <td class="text-nowrap">
                                Rp{{ number_format($item->total_harga, 0, ',', '.') }}
                            </td>

                            <td class="text-nowrap">
                                Rp{{ number_format($item->bayar, 0, ',', '.') }}
                            </td>

                            <td class="text-nowrap">
                                Rp{{ number_format($item->kembalian, 0, ',', '.') }}
                            </td>

                            <td class="text-nowrap">
                                {{ $item->tanggal_penjualan }}
                            </td>

                            <!-- Aksi -->
                            <td class="text-nowrap">
                                <a href="{{ route('penjualan.show', $item->id) }}" 
                                   class="btn btn-info btn-sm">
                                    Detail
                                </a>

                                <a href="{{ route('penjualan.cetak', $item->id) }}" 
                                   target="_blank"
                                   class="btn btn-secondary btn-sm">
                                    Cetak
                                </a>

                                <form action="{{ route('penjualan.destroy', $item->id) }}" 
                                      method="POST" 
                                      class="d-inline"
                                      onsubmit="return confirm('Yakin ingin hapus penjualan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>

                        @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-3">
                                Data penjualan belum tersedia
                            </td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>

            </div>
        </div>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-3">
        {{ $penjualan->links() }}
    </div>

</div>
@endsection