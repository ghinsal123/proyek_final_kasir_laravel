@extends('layout')

@section('content')
<div class="container-fluid mt-4">

    <!-- Wrapper agar card berada di tengah -->
    <div class="row justify-content-center">

        <!-- Lebar card responsif -->
        <div class="col-12 col-md-10 col-lg-6">

            <!-- Judul halaman -->
            <h2 class="mb-4 fs-4 fs-md-3">Detail Produk</h2>

            <!-- Card detail produk -->
            <div class="card shadow-sm">

                <div class="row g-0">

                    <!-- Menampilkan foto produk jika ada -->
                    @if ($produk->foto)
                    <div class="col-12 col-md-4">

                        <!-- Gambar produk -->
                        <img src="{{ asset('storage/' . $produk->foto) }}"
                             class="img-fluid w-100 h-100 object-fit-cover rounded-start"
                             alt="Foto Produk">
                    </div>
                    @endif

                    <!-- Bagian informasi produk -->
                    <div class="col-12 col-md-8">
                        <div class="card-body">

                            <!-- Nama produk -->
                            <h5 class="card-title fw-semibold">
                                {{ $produk->nama_produk }}
                            </h5>

                            <!-- Harga produk -->
                            <p class="card-text fs-6">
                                <strong>Harga:</strong>
                                Rp{{ number_format($produk->harga, 0, ',', '.') }}
                            </p>

                            <!-- Stok produk -->
                            <p class="card-text fs-6">
                                <strong>Stok:</strong>
                                {{ $produk->stok }}
                            </p>

                            <!-- Deskripsi produk -->
                            <p class="card-text fs-6">
                                <strong>Deskripsi:</strong>
                                {{ $produk->deskripsi }}
                            </p>

                            <!-- Informasi tanggal dibuat -->
                            <p class="card-text text-nowrap">
                                <small class="text-muted">
                                    <strong>Dibuat pada:</strong>
                                    {{ $produk->created_at->format('d M Y H:i') }}
                                </small>
                            </p>

                            <!-- Informasi tanggal update -->
                            <p class="card-text text-nowrap">
                                <small class="text-muted">
                                    <strong>Diperbarui pada:</strong>
                                    {{ $produk->updated_at->format('d M Y H:i') }}
                                </small>
                            </p>

                            <!-- Tombol kembali -->
                            <div class="mt-3">
                                <a href="{{ route('produk.index') }}"
                                   class="btn btn-secondary btn-sm">
                                    Kembali
                                </a>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection