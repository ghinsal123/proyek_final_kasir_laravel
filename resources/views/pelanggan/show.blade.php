@extends('layout')

@section('content')
<div class="container-fluid mt-4">

    <!-- Wrapper untuk menengahkan card -->
    <div class="row justify-content-center">

        <!-- Mengatur lebar card agar responsif -->
        <div class="col-12 col-md-10 col-lg-6">

            <!-- Judul halaman -->
            <h2 class="mb-4 fs-4 fs-md-3">
                <i class="bi bi-person-vcard-fill me-2"></i>
                Detail Pelanggan
            </h2>

            <!-- Card detail pelanggan -->
            <div class="card shadow-sm">
                <div class="card-body">

                    <!-- Menampilkan nama pelanggan -->
                    <p class="fs-6">
                        <strong>Nama:</strong> {{ $pelanggan->nama_pelanggan }}
                    </p>

                    <!-- Menampilkan nomor telepon -->
                    <p class="fs-6">
                        <strong>Nomor Telepon:</strong> {{ $pelanggan->nomor_telepon }}
                    </p>

                    <!-- Menampilkan email pelanggan -->
                    <p class="fs-6">
                        <strong>Email:</strong> {{ $pelanggan->email }}
                    </p>

                    <!-- Menampilkan alamat pelanggan -->
                    <p class="fs-6">
                        <strong>Alamat:</strong> {{ $pelanggan->alamat }}
                    </p>

                    <!-- Menampilkan tanggal dibuat (format rapi) -->
                    <p class="fs-6 text-nowrap">
                        <strong>Dibuat pada:</strong>
                        {{ $pelanggan->created_at->format('d M Y H:i') }}
                    </p>

                    <!-- Menampilkan tanggal update terakhir -->
                    <p class="fs-6 text-nowrap">
                        <strong>Diperbarui pada:</strong>
                        {{ $pelanggan->updated_at->format('d M Y H:i') }}
                    </p>

                    <!-- Tombol kembali ke halaman index -->
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