@extends('layout')

@section('content')
<div class="container mt-4">

    <!-- Judul halaman -->
    <h2><i class="bi bi-person-plus-fill me-2"></i>Tambah Pelanggan</h2>

    <!-- Menampilkan error validasi jika ada -->
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Card form input -->
    <div class="card shadow-sm">
        <div class="card-body">

            <!-- Form tambah pelanggan -->
            <form action="{{ route('pelanggan.store') }}" method="POST">
                @csrf

                <!-- Input nama pelanggan -->
                <div class="mb-3">
                    <label for="nama_pelanggan" class="form-label">
                        Nama Pelanggan
                    </label>
                    <input type="text" name="nama_pelanggan" id="nama_pelanggan"
                        class="form-control"
                        value="{{ old('nama_pelanggan') }}"
                        required>
                </div>

                <!-- Input nomor telepon pelanggan -->
                <div class="mb-3">
                    <label for="nomor_telepon" class="form-label">
                        Nomor Telepon
                    </label>
                    <input type="text" name="nomor_telepon" id="nomor_telepon"
                        class="form-control"
                        value="{{ old('nomor_telepon') }}"
                        required>
                </div>

                <!-- Input email pelanggan -->
                <div class="mb-3">
                    <label for="email" class="form-label">
                        Email
                    </label>
                    <input type="email" name="email" id="email"
                        class="form-control"
                        value="{{ old('email') }}">
                </div>

                <!-- Input alamat pelanggan -->
                <div class="mb-3">
                    <label for="alamat" class="form-label">
                        Alamat
                    </label>
                    <textarea name="alamat" id="alamat"
                        class="form-control"
                        rows="3"
                        style="resize: none; max-height: 150px;"
                        required>{{ old('alamat') }}</textarea>
                </div>

                <!-- Tombol aksi -->
                <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary">
                    Batal
                </a>

                <button type="submit" class="btn btn-primary">
                    Simpan
                </button>

            </form>
        </div>
    </div>
</div>
@endsection