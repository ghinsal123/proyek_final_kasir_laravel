@extends('layout')

@section('content')
<div class="container-fluid mt-4">

    <!-- Wrapper biar card ke tengah -->
    <div class="row justify-content-center">

        <!-- Lebar card di desktop -->
        <div class="col-12 col-md-10 col-lg-6">

            <!-- Judul -->
            <h2 class="mb-4 fs-4 fs-md-3">
                <i class="bi bi-person-vcard-fill me-2"></i>
                Detail Pelanggan
            </h2>

            <!-- Card -->
            <div class="card shadow-sm">
                <div class="card-body">

                    <!-- Data pelanggan -->
                    <p class="fs-6">
                        <strong>Nama:</strong> {{ $pelanggan->nama_pelanggan }}
                    </p>

                    <p class="fs-6">
                        <strong>Nomor Telepon:</strong> {{ $pelanggan->nomor_telepon }}
                    </p>

                    <p class="fs-6">
                        <strong>Email:</strong> {{ $pelanggan->email }}
                    </p>

                    <p class="fs-6">
                        <strong>Alamat:</strong> {{ $pelanggan->alamat }}
                    </p>

                    <p class="fs-6 text-nowrap">
                        <strong>Dibuat pada:</strong> 
                        {{ $pelanggan->created_at->format('d M Y H:i') }}
                    </p>

                    <p class="fs-6 text-nowrap">
                        <strong>Diperbarui pada:</strong> 
                        {{ $pelanggan->updated_at->format('d M Y H:i') }}
                    </p>

                    <!-- Tombol -->
                    <div class="mt-4">
                        <a href="{{ route('pelanggan.index') }}" 
                           class="btn btn-secondary btn-sm">
                            Kembali
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection