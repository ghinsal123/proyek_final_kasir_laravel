@extends('layout')

@section('content')
<div class="container">
    <h3>Daftar Produk</h3>
    <a href="{{ route('produk.create') }}" class="btn btn-primary mb-3">Tambah Produk</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Foto</th>
                <th>Nama</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($produk as $items)
                <tr>
                    <td>{{ $items->id }}</td>
                    <td>
                        @if ($items->foto)
                            <img src="{{ asset('storage/' . $items->foto) }}" width="60" alt="Foto">
                        @else
                            <span>Tidak ada foto</span>
                        @endif
                    </td>
                    <td>{{ $items->nama_produk }}</td>
                    <td>Rp{{ number_format($items->harga, 0, ',', '.') }}</td>
                    <td>{{ $items->stok }}</td>
                    <td>
                        <a href="{{ route('produk.show', $items->id) }}" class="btn btn-info btn-sm">Detail</a>
                        <a href="{{ route('produk.edit', $items) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('produk.destroy', $items) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="d-flex justify-content-center">
    {{ $produk->links() }}
</div>

@endsection
