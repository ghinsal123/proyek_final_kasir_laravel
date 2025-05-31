@extends('layout')

@section('content')
<div class="container mt-4">
    <h3><i class="bi bi-pencil-square me-2"></i>Edit Produk</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('produk.update', $produk) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nama_produk" class="form-label">
                        <i class="bi bi-tag-fill me-2"></i>Nama Produk
                    </label>
                    <input type="text" name="nama_produk" class="form-control" value="{{ old('nama_produk', $produk->nama_produk) }}" required>
                </div>

                <div class="mb-3">
                    <label for="harga" class="form-label">
                        <i class="bi bi-cash-stack me-2"></i>Harga
                    </label>
                    <input type="number" name="harga" class="form-control" value="{{ old('harga', $produk->harga) }}" required>
                </div>

                <div class="mb-3">
                    <label for="stok" class="form-label">
                        <i class="bi bi-boxes me-2"></i>Stok
                    </label>
                    <input type="number" name="stok" class="form-control" value="{{ old('stok', $produk->stok) }}" required>
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">
                        <i class="bi bi-info-circle-fill me-2"></i>Deskripsi
                    </label>
                    <textarea name="deskripsi" class="form-control" rows="3" style="resize: none; max-height: 150px;" required>{{ old('deskripsi', $produk->deskripsi) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="foto" class="form-label">
                        <i class="bi bi-image-fill me-2"></i>Foto Produk (Opsional)
                    </label>
                    <input type="file" name="foto" class="form-control" accept="image/*">
                    @if ($produk->foto)
                        <p class="mt-2"><i class="bi bi-image me-1"></i>Foto saat ini:</p>
                        <img src="{{ asset('storage/' . $produk->foto) }}" width="100" alt="Foto Produk">
                    @endif
                </div>

                <a href="{{ route('produk.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left-circle me-1"></i>Kembali
                </a>
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-save2-fill me-1"></i>Update
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
