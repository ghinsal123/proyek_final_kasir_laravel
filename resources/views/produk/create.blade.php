@extends('layout')

@section('content')
<div class="container mt-4">
    <h3><i class="bi bi-box-seam me-2"></i>Tambah Produk</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="nama_produk" class="form-label">
                        Nama Produk
                    </label>
                    <input type="text" name="nama_produk" class="form-control" value="{{ old('nama_produk') }}" required>
                </div>

                <div class="mb-3">
                    <label for="harga" class="form-label">
                        Harga
                    </label>
                    <input type="number" name="harga" class="form-control" value="{{ old('harga') }}" required>
                </div>

                <div class="mb-3">
                    <label for="stok" class="form-label">
                        Stok
                    </label>
                    <input type="number" name="stok" class="form-control" value="{{ old('stok') }}" required>
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">
                        Deskripsi
                    </label>
                    <textarea name="deskripsi" class="form-control" rows="3" style="resize: none; max-height: 150px;" required>{{ old('deskripsi') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="foto" class="form-label">
                        Foto Produk
                    </label>
                    <input type="file" name="foto" class="form-control" accept="image/*">
                </div>

                <a href="{{ route('produk.index') }}" class="btn btn-secondary">
                    Kembali
                </a>
                <button type="submit" class="btn btn-primary">
                    Simpan
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
