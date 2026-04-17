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
                        Nama Pelanggan
                    </label>
                    <input type="text" name="nama_pelanggan" id="nama_pelanggan" class="form-control" value="{{ old('nama_pelanggan', $pelanggan->nama_pelanggan) }}" required>
                </div>

                <div class="mb-3">
                    <label for="nomor_telepon" class="form-label">
                        Nomor Telepon
                    </label>
                    <input type="text" name="nomor_telepon" id="nomor_telepon" class="form-control" value="{{ old('nomor_telepon', $pelanggan->nomor_telepon) }}" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">
                        Email
                    </label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $pelanggan->email) }}" required>
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label">
                        Alamat
                    </label>
                    <textarea name="alamat" id="alamat" class="form-control" style="resize: none; max-height: 150px;" required>{{ old('alamat', $pelanggan->alamat) }}</textarea>
                </div>

                <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary">
                    Batal
                </a>
                <button type="submit" class="btn btn-primary">
                    Perbarui
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
