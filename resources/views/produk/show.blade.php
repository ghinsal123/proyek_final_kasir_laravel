@extends('layout')

@section('content')
<h2>Detail Produk</h2>

<div class="card mb-3" style="max-width: 540px;">
    <div class="row g-0">
        @if ($produk->foto)
            <div class="col-md-4">
                <img src="{{ asset('storage/' . $produk->foto) }}" class="img-fluid rounded-start" alt="Foto Produk">
            </div>
        @endif
        <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title">{{ $produk->nama_produk }}</h5>
                <p class="card-text"><strong>Harga:</strong> Rp{{ number_format($produk->harga, 0, ',', '.') }}</p>
                <p class="card-text"><strong>Stok:</strong> {{ $produk->stok }}</p>
                <p class="card-text"><strong>Deskripsi:</strong> {{ $produk->deskripsi }}</p>
                <p class="card-text"><small class="text-muted"><strong>Dibuat pada:</strong> {{ $produk->created_at->format('d M Y H:i') }}</small></p>
                <p class="card-text"><small class="text-muted"><strong>Diperbarui pada:</strong> {{ $produk->updated_at->format('d M Y H:i') }}</small></p>
                <a href="{{ route('produk.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection
