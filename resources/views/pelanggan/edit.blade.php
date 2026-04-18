@extends('layout')

@section('content')
<div class="container mt-4">

    <!-- Judul halaman -->
    <h2><i class="bi bi-pencil-square me-2"></i>Edit Pelanggan</h2>

    <!-- Menampilkan pesan error validasi jika ada -->
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            <!-- Loop semua error dan tampilkan satu per satu -->
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Card container form edit -->
    <div class="card shadow-sm">
        <div class="card-body">

            <!-- Form untuk update data pelanggan -->
            <form action="{{ route('pelanggan.update', $pelanggan->id) }}" method="POST">
                @csrf
                @method('PUT') <!-- Mengubah method menjadi PUT untuk update data -->

                <!-- Input nama pelanggan -->
                <div class="mb-3">
                    <label for="nama_pelanggan" class="form-label">
                        Nama Pelanggan
                    </label>
                    <input type="text"
                        name="nama_pelanggan"
                        id="nama_pelanggan"
                        class="form-control"
                        value="{{ old('nama_pelanggan', $pelanggan->nama_pelanggan) }}"
                        required>
                </div>

                <!-- Input nomor telepon pelanggan -->
                <div class="mb-3">
                    <label for="nomor_telepon" class="form-label">
                        Nomor Telepon
                    </label>
                    <input type="text"
                        name="nomor_telepon"
                        id="nomor_telepon"
                        class="form-control"
                        value="{{ old('nomor_telepon', $pelanggan->nomor_telepon) }}"
                        required>
                </div>

                <!-- Input email pelanggan -->
                <div class="mb-3">
                    <label for="email" class="form-label">
                        Email
                    </label>
                    <input type="email"
                        name="email"
                        id="email"
                        class="form-control"
                        value="{{ old('email', $pelanggan->email) }}"
                        required>
                </div>

                <!-- Input alamat pelanggan -->
                <div class="mb-3">
                    <label for="alamat" class="form-label">
                        Alamat
                    </label>
                    <textarea name="alamat"
                        id="alamat"
                        class="form-control"
                        style="resize: none; max-height: 150px;"
                        required>{{ old('alamat', $pelanggan->alamat) }}</textarea>
                </div>

                <!-- Tombol kembali ke halaman index -->
                <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary">
                    Batal
                </a>

                <!-- Tombol submit untuk update data -->
                <button type="submit" class="btn btn-primary">
                    Perbarui
                </button>

            </form>
        </div>
    </div>
</div>
@endsection