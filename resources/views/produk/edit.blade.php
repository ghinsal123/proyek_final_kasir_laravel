@extends('layout')

@section('content')
<div class="container mt-4">

    <!-- Judul halaman -->
    <h3><i class="bi bi-pencil-square me-2"></i>Edit Produk</h3>

    <!-- Menampilkan error validasi -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Card form edit produk -->
    <div class="card shadow-sm">
        <div class="card-body">

            <!-- Form update produk -->
            <form action="{{ route('produk.update', $produk) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Input nama produk -->
                <div class="mb-3">
                    <label for="nama_produk" class="form-label">
                        Nama Produk
                    </label>
                    <input type="text"
                        name="nama_produk"
                        class="form-control"
                        value="{{ old('nama_produk', $produk->nama_produk) }}"
                        required>
                </div>

                <!-- Input harga produk -->
                <div class="mb-3">
                    <label for="harga" class="form-label">
                        Harga
                    </label>
                    <input type="number"
                        name="harga"
                        class="form-control"
                        value="{{ old('harga', (int) $produk->harga) }}"
                        step="1"
                        min="0"
                        required>
                </div>

                <!-- Input stok produk -->
                <div class="mb-3">
                    <label for="stok" class="form-label">
                        Stok
                    </label>
                    <input type="number"
                        name="stok"
                        class="form-control"
                        value="{{ old('stok', $produk->stok) }}"
                        required>
                </div>

                <!-- Input deskripsi produk -->
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">
                        Deskripsi
                    </label>
                    <textarea name="deskripsi"
                        class="form-control"
                        rows="3"
                        style="resize: none; max-height: 150px;"
                        required>{{ old('deskripsi', $produk->deskripsi) }}</textarea>
                </div>

                <!-- Upload / update foto produk -->
                <div class="mb-3">
                    <label for="foto" class="form-label">
                        Foto Produk (Opsional)
                    </label>

                    <input type="file"
                        name="foto"
                        class="form-control"
                        accept="image/*">

                    <!-- Tampilkan foto lama jika ada -->
                    @if ($produk->foto)
                        <p class="mt-2">
                            <i class="bi bi-image me-1"></i>
                            Foto saat ini:
                        </p>

                        <img src="{{ asset('storage/' . $produk->foto) }}"
                            width="100"
                            alt="Foto Produk">
                    @endif
                </div>

                <!-- Tombol aksi -->
                <a href="{{ route('produk.index') }}" class="btn btn-secondary">
                    Kembali
                </a>

                <button type="submit" class="btn btn-success">
                    Perbarui
                </button>

            </form>

        </div>
    </div>
</div>
@endsection