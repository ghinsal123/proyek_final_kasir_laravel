@extends('layout')

@section('content')
<div class="container mt-4">
    <h2><i class="bi bi-person-vcard-fill me-2"></i>Detail Pelanggan</h2>

    <div class="card shadow-sm">
        <div class="card-body">
            <p><i class="bi bi-person-fill me-2"></i><strong>Nama:</strong> {{ $pelanggan->nama_pelanggan }}</p>
            <p><i class="bi bi-telephone-fill me-2"></i><strong>Nomor Telepon:</strong> {{ $pelanggan->nomor_telepon }}</p>
            <p><i class="bi bi-envelope-fill me-2"></i><strong>Email:</strong> {{ $pelanggan->email }}</p>
            <p><i class="bi bi-geo-alt-fill me-2"></i><strong>Alamat:</strong> {{ $pelanggan->alamat }}</p>
            <p><i class="bi bi-calendar-plus-fill me-2"></i><strong>Dibuat pada:</strong> {{ $pelanggan->created_at->format('d M Y H:i') }}</p>
            <p><i class="bi bi-calendar-check-fill me-2"></i><strong>Diperbarui pada:</strong> {{ $pelanggan->updated_at->format('d M Y H:i') }}</p>

            <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary mt-3">
                <i class="bi bi-arrow-left-circle me-1"></i>Kembali
            </a>
        </div>
    </div>
</div>
@endsection
