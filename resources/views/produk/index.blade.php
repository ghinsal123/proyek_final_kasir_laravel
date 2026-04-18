@extends('layout')

@section('content')
<div class="container-fluid">

    <!-- Judul halaman -->
    <h1 class="mb-4 fs-4 fs-md-3">Data Produk</h1>

    <!-- Tombol menuju form tambah produk -->
    <div class="mb-3">
        <a href="{{ route('produk.create') }}" class="btn btn-primary btn-sm">
            Tambah Produk
        </a>
    </div>

    <!-- Alert jika berhasil tambah/edit/hapus -->
    @if (session('success'))
        <div class="alert alert-success fs-6">
            {{ session('success') }}
        </div>
    @endif

    <!-- Card pembungkus tabel -->
    <div class="card shadow-sm">

        <!-- Header card -->
        <div class="card-header bg-light">
            <h5 class="mb-0 fs-6 fs-md-5">Daftar Produk</h5>
        </div>

        <!-- Body card -->
        <div class="card-body p-0">

            <!-- Wrapper agar tabel bisa scroll di mobile -->
            <div class="table-responsive">

                <!-- Tabel data produk -->
                <table class="table table-striped table-hover m-0">

                    <!-- Header tabel -->
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

                    <!-- Isi tabel -->
                    <tbody>

                        <!-- Loop data produk -->
                        @forelse ($produk as $items)
                        <tr>

                            <!-- ID produk -->
                            <td>{{ $items->id }}</td>

                            <!-- Foto produk -->
                            <td class="text-nowrap">

                                @if ($items->foto)
                                    <img src="{{ asset('storage/' . $items->foto) }}"
                                        class="img-fluid rounded"
                                        style="max-width:60px;"
                                        alt="Foto Produk">
                                @else
                                    <!-- Jika tidak ada foto -->
                                    <span class="text-muted">Tidak ada</span>
                                @endif

                            </td>

                            <!-- Nama produk -->
                            <td class="fw-semibold">
                                {{ $items->nama_produk }}
                            </td>

                            <!-- Harga produk -->
                            <td class="text-nowrap">
                                Rp{{ number_format($items->harga, 0, ',', '.') }}
                            </td>

                            <!-- Stok produk -->
                            <td>
                                {{ $items->stok }}
                            </td>

                            <!-- Tombol aksi -->
                            <td class="text-nowrap">

                                <!-- Detail produk -->
                                <a href="{{ route('produk.show', $items->id) }}"
                                   class="btn btn-info btn-sm">
                                    Detail
                                </a>

                                <!-- Edit produk -->
                                <a href="{{ route('produk.edit', $items->id) }}"
                                   class="btn btn-warning btn-sm">
                                    Edit
                                </a>

                                <!-- Hapus produk -->
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

                        <!-- Jika data kosong -->
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

    <!-- Pagination Laravel -->
    <div class="d-flex justify-content-center mt-3">
        {{ $produk->links() }}
    </div>

</div>
@endsection