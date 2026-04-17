@extends('layout')

@section('content')
<div class="container mt-4">
    <h2>Tambah Penjualan</h2>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
    @endif

    <div class="card shadow-sm p-3">
        <form action="{{ route('penjualan.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="pelanggan_id" class="form-label">Pilih Pelanggan</label>
                <select name="pelanggan_id" id="pelanggan_id" class="form-select" required>
                    <option value="">-- Pilih Pelanggan --</option>
                    @foreach ($pelanggan as $p)
                    <option value="{{ $p->id }}" {{ old('pelanggan_id') == $p->id ? 'selected' : '' }}>
                        {{ $p->nama_pelanggan }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" name="tanggal_penjualan" id="tanggal" 
                       class="form-control"
                       value="{{ old('tanggal_penjualan', date('Y-m-d')) }}" required>
            </div>

            <h5>Detail Produk</h5>

            <!-- 🔥 FIX: TABLE RESPONSIVE -->
            <div class="table-responsive">
                <table class="table" id="produk-table">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Jumlah</th>
                            <th>Harga Satuan</th>
                            <th>Subtotal</th>
                            <th>
                                <button type="button" class="btn btn-sm btn-success" id="add-row">
                                    Tambah
                                </button>
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
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

                            <td>
                                <input type="number" name="jumlah_produk[]" 
                                       class="form-control jumlah-input" min="1" value="1" required>
                            </td>

                            <td>
                                <input type="text" class="form-control harga-satuan" readonly>
                            </td>

                            <td>
                                <input type="text" class="form-control subtotal" readonly>
                            </td>

                            <td>
                                <button type="button" class="btn btn-sm btn-danger remove-row">
                                    Hapus
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- 🔥 FIX: FLEX WRAP + MIN WIDTH -->
            <div class="mb-3 d-flex flex-wrap gap-3 align-items-end">

                <div class="flex-fill" style="min-width:150px;">
                    <label for="total_harga" class="form-label">Total Harga</label>
                    <input type="text" name="total_harga" id="total_harga" 
                           class="form-control" readonly 
                           value="{{ old('total_harga', '0') }}">
                </div>

                <div class="flex-fill" style="min-width:150px;">
                    <label for="bayar" class="form-label">Bayar</label>
                    <input type="number" name="bayar" id="bayar" 
                           class="form-control" min="0" 
                           value="{{ old('bayar', '0') }}" required>
                </div>

                <div class="flex-fill" style="min-width:150px;">
                    <label for="kembalian" class="form-label">Kembalian</label>
                    <input type="text" name="kembalian" id="kembalian" 
                           class="form-control" readonly 
                           value="{{ old('kembalian', '0') }}">
                </div>

            </div>

            <a href="{{ route('penjualan.index') }}" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan</button>

        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    function updateRow(row) {
        const produkSelect = row.querySelector('.produk-select');
        const jumlahInput = row.querySelector('.jumlah-input');
        const hargaSatuanInput = row.querySelector('.harga-satuan');
        const subtotalInput = row.querySelector('.subtotal');

        const harga = produkSelect.selectedOptions[0]?.dataset.harga 
            ? parseFloat(produkSelect.selectedOptions[0].dataset.harga) : 0;

        const jumlah = parseInt(jumlahInput.value) || 0;
        const subtotal = harga * jumlah;

        hargaSatuanInput.value = harga 
            ? harga.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' }) : '';

        subtotalInput.value = subtotal 
            ? subtotal.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' }) : '';

        updateTotalHarga();
    }

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

    function updateKembalian() {
        const totalText = document.getElementById('total_harga').value;
        const bayarInput = document.getElementById('bayar');
        const kembalianInput = document.getElementById('kembalian');

        let total = 0;
        if(totalText) {
            total = Number(totalText.replace(/[^0-9,-]+/g,"").replace(',', '.'));
        }

        let bayar = parseFloat(bayarInput.value) || 0;
        let kembalian = bayar - total;

        kembalianInput.value = kembalian >= 0 
            ? kembalian.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' }) 
            : '0';
    }

    document.querySelector('#produk-table').addEventListener('change', function(e) {
        if(e.target.classList.contains('produk-select') || 
           e.target.classList.contains('jumlah-input')) {
            updateRow(e.target.closest('tr'));
        }
    });

    document.getElementById('bayar').addEventListener('input', updateKembalian);

    document.getElementById('add-row').addEventListener('click', function () {
        const tbody = document.querySelector('#produk-table tbody');
        const newRow = tbody.rows[0].cloneNode(true);

        newRow.querySelectorAll('input').forEach(input => {
            if(input.classList.contains('jumlah-input')) input.value = 1;
            else input.value = '';
        });

        newRow.querySelector('select').selectedIndex = 0;
        tbody.appendChild(newRow);
    });

    document.querySelector('#produk-table').addEventListener('click', function(e) {
        if(e.target.classList.contains('remove-row')) {
            const tbody = document.querySelector('#produk-table tbody');

            if(tbody.rows.length > 1) {
                e.target.closest('tr').remove();
                updateTotalHarga();
            } else {
                alert('Minimal satu produk harus dipilih.');
            }
        }
    });

    updateRow(document.querySelector('#produk-table tbody tr'));
});
</script>
@endsection