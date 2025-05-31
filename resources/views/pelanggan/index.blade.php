@extends('layout')

@section('content')
<h2>Daftar Pelanggan</h2>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<a href="{{ route('pelanggan.create') }}" class="btn btn-primary mb-3">Tambah Pelanggan</a>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Kode Pelanggan</th>
            <th>Nama Pelanggan</th>
            <th>Nomor Telepon</th>
            <th>Email</th>
            <th>Alamat</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pelanggan as $item)
        <tr>
            <td>{{ $item->kode_pelanggan }}</td>
            <td>{{ $item->nama_pelanggan }}</td>
            <td>{{ $item->nomor_telepon }}</td>
            <td>{{ $item->email }}</td>
            <td>{{ $item->alamat }}</td>
            <td>
                <a href="{{ route('pelanggan.show', $item->id) }}" class="btn btn-info btn-sm">Detail</a>
                <a href="{{ route('pelanggan.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('pelanggan.destroy', $item->id) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Yakin ingin hapus?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="d-flex justify-content-center">
    {{ $pelanggan->links() }}
</div>

@endsection

