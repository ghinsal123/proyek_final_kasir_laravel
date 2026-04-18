@extends('layout')

@section('content')
<div class="container-fluid">

    <!-- Judul halaman -->
    <h1 class="mb-4 fs-4 fs-md-3">Data Pelanggan</h1>

    <!-- Menampilkan pesan sukses jika ada session success -->
    @if(session('success'))
        <div class="alert alert-success fs-6">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tombol menuju form tambah pelanggan -->
    <div class="mb-3">
        <a href="{{ route('pelanggan.create') }}" class="btn btn-primary btn-sm">
            Tambah Pelanggan
        </a>
    </div>

    <!-- Card pembungkus tabel -->
    <div class="card shadow-sm">

        <!-- Header card -->
        <div class="card-header bg-light">
            <h5 class="mb-0 fs-6 fs-md-5">Daftar Pelanggan</h5>
        </div>

        <!-- Body card -->
        <div class="card-body p-0">

            <!-- Membuat tabel responsive agar bisa scroll di layar kecil -->
            <div class="table-responsive">

                <!-- Tabel data pelanggan -->
                <table class="table table-striped table-hover m-0">

                    <!-- Header tabel -->
                    <thead class="table-primary text-nowrap">
                        <tr>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>No Telepon</th>
                            <th>Email</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <!-- Isi tabel -->
                    <tbody>

                        <!-- Loop data pelanggan -->
                        @forelse ($pelanggan as $item)
                        <tr>

                            <!-- Kode pelanggan -->
                            <td>{{ $item->kode_pelanggan }}</td>

                            <!-- Nama pelanggan (dibuat tebal) -->
                            <td class="fw-semibold">
                                {{ $item->nama_pelanggan }}
                            </td>

                            <!-- Nomor telepon -->
                            <td class="text-nowrap">
                                {{ $item->nomor_telepon }}
                            </td>

                            <!-- Email pelanggan -->
                            <td>{{ $item->email }}</td>

                            <!-- Alamat pelanggan -->
                            <td>{{ $item->alamat }}</td>

                            <!-- Tombol aksi (detail, edit, hapus) -->
                            <td class="text-nowrap">

                                <!-- Button lihat detail -->
                                <a href="{{ route('pelanggan.show', $item->id) }}"
                                   class="btn btn-info btn-sm">
                                    Detail
                                </a>

                                <!-- Button edit data -->
                                <a href="{{ route('pelanggan.edit', $item->id) }}"
                                   class="btn btn-warning btn-sm">
                                    Edit
                                </a>

                                <!-- Form hapus data -->
                                <form action="{{ route('pelanggan.destroy', $item->id) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Yakin ingin hapus?')">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm">
                                        Hapus
                                    </button>
                                </form>

                            </td>
                        </tr>

                        <!-- Jika data kosong -->
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-3">
                                Data pelanggan belum tersedia
                            </td>
                        </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>
        </div>
    </div>

    <!-- Pagination Laravel -->
    <div class="d-flex justify-content-center mt-3">
        {{ $pelanggan->links() }}
    </div>

</div>
@endsection