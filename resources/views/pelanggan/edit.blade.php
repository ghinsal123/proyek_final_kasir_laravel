@extends('layout')

@section('content')
<div class="container mt-4">
    <h2><i class="bi bi-pencil-square me-2"></i>Edit Pelanggan</h2>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('pelanggan.update', $pelanggan->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nama_pelanggan" class="form-label">
                        <i class="bi bi-person-fill me-1"></i>Nama Pelanggan
                    </label>
                    <input type="text" name="nama_pelanggan" id="nama_pelanggan" class="form-control" value="{{ old('nama_pelanggan', $pelanggan->nama_pelanggan) }}" required>
                </div>

                <div class="mb-3">
                    <label for="nomor_telepon" class="form-label">
                        <i class="bi bi-telephone-fill me-1"></i>Nomor Telepon
                    </label>
                    <input type="text" name="nomor_telepon" id="nomor_telepon" class="form-control" value="{{ old('nomor_telepon', $pelanggan->nomor_telepon) }}" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">
                        <i class="bi bi-envelope-fill me-1"></i>Email
                    </label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $pelanggan->email) }}" required>
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label">
                        <i class="bi bi-geo-alt-fill me-1"></i>Alamat
                    </label>
                    <textarea name="alamat" id="alamat" class="form-control" style="resize: none; max-height: 150px;" required>{{ old('alamat', $pelanggan->alamat) }}</textarea>
                </div>

                <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left-circle me-1"></i>Batal
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save-fill me-1"></i>Update
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
