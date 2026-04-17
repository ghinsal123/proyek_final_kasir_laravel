@extends('layout')

@section('content')
<div class="container-fluid">

    <!-- Judul halaman -->
    <h1 class="mb-4 fs-4 fs-md-3">Data Produk</h1>

    <!-- Tombol tambah -->
    <div class="mb-3">
        <a href="{{ route('produk.create') }}" class="btn btn-primary btn-sm">
            Tambah Produk
        </a>
    </div>

    <!-- Alert sukses -->
    @if (session('success'))
        <div class="alert alert-success fs-6">
            {{ session('success') }}
        </div>
    @endif

    <!-- Card -->
    <div class="card shadow-sm">

        <!-- Header -->
        <div class="card-header bg-light">
            <h5 class="mb-0 fs-6 fs-md-5">Daftar Produk</h5>
        </div>

        <!-- Body -->
        <div class="card-body p-0">

            <!-- 🔥 Responsive table -->
            <div class="table-responsive">

                <table class="table table-striped table-hover m-0">

                    <!-- Header -->
                    <thead class="table-primary text-nowrap">
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <!-- Isi -->
                    <tbody>
                        @forelse ($produk as $items)
                        <tr>
                            <td>{{ $items->id }}</td>

                            <!-- Foto produk -->
                            <td class="text-nowrap">
                                @if ($items->foto)
                                    <img src="{{ asset('storage/' . $items->foto) }}" 
                                         class="img-fluid rounded" 
                                         style="max-width:60px;" 
                                         alt="Foto">
                                @else
                                    <span class="text-muted">Tidak ada</span>
                                @endif
                            </td>

                            <!-- Nama -->
                            <td class="fw-semibold">
                                {{ $items->nama_produk }}
                            </td>

                            <!-- Harga -->
                            <td class="text-nowrap">
                                Rp{{ number_format($items->harga, 0, ',', '.') }}
                            </td>

                            <!-- Stok -->
                            <td>{{ $items->stok }}</td>

                            <!-- Aksi -->
                            <td class="text-nowrap">
                                <a href="{{ route('produk.show', $items->id) }}" 
                                   class="btn btn-info btn-sm">
                                    Detail
                                </a>

                                <a href="{{ route('produk.edit', $items->id) }}" 
                                   class="btn btn-warning btn-sm">
                                    Edit
                                </a>

                                <form action="{{ route('produk.destroy', $items->id) }}" 
                                      method="POST" 
                                      class="d-inline"
                                      onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
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
                            <td colspan="6" class="text-center text-muted py-3">
                                Data produk belum tersedia
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
        {{ $produk->links() }}
    </div>

</div>
@endsection