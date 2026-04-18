@extends('layout')

@section('content')
<div class="container mt-4">

    <!-- Judul halaman -->
    <h2>Tambah Penjualan</h2>

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

    <!-- Card form transaksi -->
    <div class="card shadow-sm p-3">

        <!-- Form submit penjualan -->
        <form action="{{ route('penjualan.store') }}" method="POST">
            @csrf

            <!-- Pilih pelanggan -->
            <div class="mb-3">
                <label for="pelanggan_id" class="form-label">Pilih Pelanggan</label>

                <select name="pelanggan_id" id="pelanggan_id" class="form-select" required>
                    <option value="">-- Pilih Pelanggan --</option>

                    <!-- Loop data pelanggan -->
                    @foreach ($pelanggan as $p)
                    <option value="{{ $p->id }}"
                        {{ old('pelanggan_id') == $p->id ? 'selected' : '' }}>
                        {{ $p->nama_pelanggan }}
                    </option>
                    @endforeach
                </select>
            </div>

            <!-- Input tanggal transaksi -->
            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>

                <input type="date"
                    name="tanggal_penjualan"
                    id="tanggal"
                    class="form-control"
                    value="{{ old('tanggal_penjualan', date('Y-m-d')) }}"
                    required>
            </div>

            <!-- Detail produk -->
            <h5>Detail Produk</h5>

            <!-- Tabel produk (responsive untuk mobile) -->
            <div class="table-responsive">
                <table class="table" id="produk-table">

                    <!-- Header tabel -->
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Jumlah</th>
                            <th>Harga Satuan</th>
                            <th>Subtotal</th>
                            <th>
                                <!-- Tombol tambah row -->
                                <button type="button" class="btn btn-sm btn-success" id="add-row">
                                    Tambah
                                </button>
                            </th>
                        </tr>
                    </thead>

                    <!-- Isi tabel produk -->
                    <tbody>
                        <tr>

                            <!-- Pilih produk -->
                            <td>
                                <select name="produk_id[]" class="form-select produk-select" required>
                                    <option value="">-- Pilih Produk --</option>

                                    @foreach ($produk as $prd)
                                    <option value="{{ $prd->id }}" data-harga="{{ $prd->harga }}">
                                        {{ $prd->nama_produk }}
                                    </option>
                                    @endforeach
                                </select>
                            </td>

                            <!-- Input jumlah produk -->
                            <td>
                                <input type="number"
                                    name="jumlah_produk[]"
                                    class="form-control jumlah-input"
                                    min="1"
                                    value="1"
                                    required>
                            </td>

                            <!-- Harga satuan (readonly hasil JS) -->
                            <td>
                                <input type="text" class="form-control harga-satuan" readonly>
                            </td>

                            <!-- Subtotal (readonly hasil JS) -->
                            <td>
                                <input type="text" class="form-control subtotal" readonly>
                            </td>

                            <!-- Tombol hapus row -->
                            <td>
                                <button type="button" class="btn btn-sm btn-danger remove-row">
                                    Hapus
                                </button>
                            </td>

                        </tr>
                    </tbody>

                </table>
            </div>

            <!-- Ringkasan pembayaran -->
            <div class="mb-3 d-flex flex-wrap gap-3 align-items-end">

                <!-- Total harga -->
                <div class="flex-fill" style="min-width:150px;">
                    <label for="total_harga" class="form-label">Total Harga</label>
                    <input type="text" name="total_harga" id="total_harga"
                        class="form-control" readonly
                        value="{{ old('total_harga', '0') }}">
                </div>

                <!-- Input bayar -->
                <div class="flex-fill" style="min-width:150px;">
                    <label for="bayar" class="form-label">Bayar</label>
                    <input type="number" name="bayar" id="bayar"
                        class="form-control" min="0"
                        value="{{ old('bayar', '0') }}" required>
                </div>

                <!-- Kembalian -->
                <div class="flex-fill" style="min-width:150px;">
                    <label for="kembalian" class="form-label">Kembalian</label>
                    <input type="text" name="kembalian" id="kembalian"
                        class="form-control" readonly
                        value="{{ old('kembalian', '0') }}">
                </div>

            </div>

            <!-- Tombol aksi -->
            <a href="{{ route('penjualan.index') }}" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan</button>

        </form>
    </div>
</div>

<!-- SCRIPT PERHITUNGAN TRANSAKSI -->
<script>
document.addEventListener('DOMContentLoaded', function () {

    // Update 1 baris produk
    function updateRow(row) {

        const produkSelect = row.querySelector('.produk-select');
        const jumlahInput = row.querySelector('.jumlah-input');
        const hargaSatuanInput = row.querySelector('.harga-satuan');
        const subtotalInput = row.querySelector('.subtotal');

        // Ambil harga dari data attribute option
        const harga = produkSelect.selectedOptions[0]?.dataset.harga
            ? parseFloat(produkSelect.selectedOptions[0].dataset.harga) : 0;

        const jumlah = parseInt(jumlahInput.value) || 0;

        // Hitung subtotal
        const subtotal = harga * jumlah;

        // Format harga satuan (Rupiah)
        hargaSatuanInput.value = harga
            ? harga.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' }) : '';

        // Format subtotal (Rupiah)
        subtotalInput.value = subtotal
            ? subtotal.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' }) : '';

        // Update total keseluruhan
        updateTotalHarga();
    }

    // Hitung total harga semua produk
    function updateTotalHarga() {
        let total = 0;

        document.querySelectorAll('.subtotal').forEach(input => {
            let value = input.value.replace(/[^0-9,-]+/g,"").replace(',', '.');
            total += parseFloat(value) || 0;
        });

        document.getElementById('total_harga').value =
            total.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });

        updateKembalian();
    }

    // Hitung kembalian
    function updateKembalian() {
        const totalText = document.getElementById('total_harga').value;
        const bayarInput = document.getElementById('bayar');
        const kembalianInput = document.getElementById('kembalian');

        let total = 0;
        if (totalText) {
            total = Number(totalText.replace(/[^0-9,-]+/g,"").replace(',', '.'));
        }

        let bayar = parseFloat(bayarInput.value) || 0;
        let kembalian = bayar - total;

        kembalianInput.value = kembalian >= 0
            ? kembalian.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' })
            : '0';
    }

    // Event perubahan produk/jumlah
    document.querySelector('#produk-table').addEventListener('change', function(e) {
        if (e.target.classList.contains('produk-select') ||
            e.target.classList.contains('jumlah-input')) {
            updateRow(e.target.closest('tr'));
        }
    });

    // Event input bayar
    document.getElementById('bayar').addEventListener('input', updateKembalian);

    // Tambah baris produk
    document.getElementById('add-row').addEventListener('click', function () {
        const tbody = document.querySelector('#produk-table tbody');
        const newRow = tbody.rows[0].cloneNode(true);

        newRow.querySelectorAll('input').forEach(input => {
            if (input.classList.contains('jumlah-input')) input.value = 1;
            else input.value = '';
        });

        newRow.querySelector('select').selectedIndex = 0;
        tbody.appendChild(newRow);
    });

    // Hapus baris produk
    document.querySelector('#produk-table').addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-row')) {

            const tbody = document.querySelector('#produk-table tbody');

            if (tbody.rows.length > 1) {
                e.target.closest('tr').remove();
                updateTotalHarga();
            } else {
                alert('Minimal satu produk harus dipilih.');
            }
        }
    });

    // Inisialisasi pertama
    updateRow(document.querySelector('#produk-table tbody tr'));
});
</script>
@endsection