@extends('layout')

@section('content')
<div class="container-fluid"> <!-- Container full lebar agar konsisten dengan dashboard -->

    <!-- Judul halaman -->
    <h1 class="mb-4 fs-4 fs-md-3">Data Pelanggan</h1>
    <!-- fs = font size (responsive), mb-4 = margin bawah -->

    <!-- Alert jika ada pesan sukses -->
    @if(session('success'))
        <div class="alert alert-success fs-6">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tombol tambah pelanggan -->
    <div class="mb-3">
        <a href="{{ route('pelanggan.create') }}" class="btn btn-primary btn-sm">
            Tambah Pelanggan
        </a>
    </div>

    <!-- Card pembungkus tabel -->
    <div class="card shadow-sm">
        <!-- shadow-sm = bayangan ringan -->

        <!-- Header card -->
        <div class="card-header bg-light">
            <h5 class="mb-0 fs-6 fs-md-5">Daftar Pelanggan</h5>
        </div>

        <!-- Body card -->
        <div class="card-body p-0">
            <!-- p-0 = padding dihapus biar tabel full -->

            <!-- Membuat tabel responsive (bisa scroll horizontal di HP) -->
            <div class="table-responsive">

                <!-- Tabel -->
                <table class="table table-striped table-hover m-0">
                    <!-- table-striped = garis selang-seling -->
                    <!-- table-hover = efek hover -->
                    <!-- m-0 = hilangkan margin -->

                    <!-- Header tabel -->
                    <thead class="table-primary text-nowrap">
                        <!-- text-nowrap = teks tidak turun -->
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
                        @forelse ($pelanggan as $item)
                        <tr>
                            <!-- Data pelanggan -->
                            <td>{{ $item->kode_pelanggan }}</td>

                            <!-- Nama ditebalkan -->
                            <td class="fw-semibold">
                                {{ $item->nama_pelanggan }}
                            </td>

                            <!-- Tidak turun ke bawah -->
                            <td class="text-nowrap">
                                {{ $item->nomor_telepon }}
                            </td>

                            <td>{{ $item->email }}</td>
                            <td>{{ $item->alamat }}</td>

                            <!-- Tombol aksi -->
                            <td class="text-nowrap">
                                <!-- Detail -->
                                <a href="{{ route('pelanggan.show', $item->id) }}" 
                                   class="btn btn-info btn-sm">
                                    Detail
                                </a>

                                <!-- Edit -->
                                <a href="{{ route('pelanggan.edit', $item->id) }}" 
                                   class="btn btn-warning btn-sm">
                                    Edit
                                </a>

                                <!-- Hapus -->
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

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-3">
        {{ $pelanggan->links() }}
    </div>

</div>
@endsection