@extends('layout')

@section('content')
<div class="container-fluid mt-4">

    <!-- Biar ke tengah -->
    <div class="row justify-content-center">

        <!-- Lebar responsive -->
        <div class="col-12 col-md-10 col-lg-6">

            <!-- Judul -->
            <h2 class="mb-4 fs-4 fs-md-3">Detail Produk</h2>

            <!-- Card -->
            <div class="card shadow-sm">

                <div class="row g-0">

                    <!-- Foto -->
                    @if ($produk->foto)
                    <div class="col-12 col-md-4">
                        <img src="{{ asset('storage/' . $produk->foto) }}" 
                             class="img-fluid w-100 h-100 object-fit-cover rounded-start" 
                             alt="Foto Produk">
                    </div>
                    @endif

                    <!-- Detail -->
                    <div class="col-12 col-md-8">
                        <div class="card-body">

                            <h5 class="card-title fw-semibold">
                                {{ $produk->nama_produk }}
                            </h5>

                            <p class="card-text fs-6">
                                <strong>Harga:</strong> 
                                Rp{{ number_format($produk->harga, 0, ',', '.') }}
                            </p>

                            <p class="card-text fs-6">
                                <strong>Stok:</strong> {{ $produk->stok }}
                            </p>

                            <p class="card-text fs-6">
                                <strong>Deskripsi:</strong> {{ $produk->deskripsi }}
                            </p>

                            <p class="card-text text-nowrap">
                                <small class="text-muted">
                                    <strong>Dibuat pada:</strong> 
                                    {{ $produk->created_at->format('d M Y H:i') }}
                                </small>
                            </p>

                            <p class="card-text text-nowrap">
                                <small class="text-muted">
                                    <strong>Diperbarui pada:</strong> 
                                    {{ $produk->updated_at->format('d M Y H:i') }}
                                </small>
                            </p>

                            <!-- Tombol -->
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