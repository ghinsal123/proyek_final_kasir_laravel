<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">

    <!-- Judul halaman struk -->
    <title>Struk Penjualan</title>

    <style>
        /* Styling utama struk (format printer thermal) */
        body {
            font-family: monospace; /* font mirip mesin struk */
            font-size: 18px;
            width: 400px;
            margin: 0 auto;
            padding: 16px;
        }

        /* Judul dan teks rata tengah */
        h2, p {
            text-align: center;
            margin: 10px 0;
        }

        /* Informasi pelanggan & transaksi */
        .info {
            margin-bottom: 16px;
        }

        /* Isi info dibuat rata kiri */
        .info p {
            text-align: left;
        }

        /* Tabel produk */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        /* Padding baris tabel */
        td {
            padding: 5px 0;
        }

        /* Rata kanan untuk harga */
        .right { text-align: right; }

        /* Rata tengah */
        .center { text-align: center; }

        /* Garis putus-putus seperti struk */
        .line {
            border-top: 1px dashed #000;
            margin: 12px 0;
        }

        /* Baris total dibuat tebal */
        .total-row td {
            font-weight: bold;
        }
    </style>
</head>

<body>

    <!-- Nama toko -->
    <h2>Toko ButikGhins</h2>

    <!-- Alamat toko -->
    <p>Jl. Lombok No. 49</p>

    <!-- Nomor telepon toko -->
    <p>Telp. 0812-3456-7890</p>

    <div class="line"></div>

    <!-- Informasi transaksi -->
    <div class="info">

        <!-- Kode pelanggan -->
        <p>Kode Pelanggan: {{ $penjualan->pelanggan->kode_pelanggan }}</p>

        <!-- Tanggal transaksi -->
        <p>Tanggal: {{ $penjualan->tanggal_penjualan }}</p>

        <!-- Nama pelanggan -->
        <p>Pelanggan: {{ $penjualan->pelanggan->nama_pelanggan ?? '-' }}</p>
    </div>

    <div class="line"></div>

    <!-- Daftar produk yang dibeli -->
    <table>

        <!-- Loop detail penjualan -->
        @foreach ($penjualan->detailPenjualan as $detail)

            <!-- Nama produk -->
            <tr>
                <td colspan="2">
                    {{ $detail->produk->nama_produk ?? 'Produk tidak ditemukan' }}
                </td>
            </tr>

            <!-- Qty x harga + subtotal -->
            <tr>
                <td>
                    {{ $detail->jumlah_produk }} x Rp{{ number_format($detail->harga_satuan, 0, ',', '.') }}
                </td>

                <td class="right">
                    Rp{{ number_format($detail->subtotal ?? ($detail->jumlah_produk * $detail->harga_satuan), 0, ',', '.') }}
                </td>
            </tr>

        @endforeach
    </table>

    <div class="line"></div>

    <!-- Ringkasan pembayaran -->
    <table>

        <!-- Total belanja -->
        <tr class="total-row">
            <td>Total</td>
            <td class="right">Rp{{ number_format($penjualan->total_harga, 0, ',', '.') }}</td>
        </tr>

        <!-- Uang bayar -->
        <tr>
            <td>Bayar</td>
            <td class="right">Rp{{ number_format($penjualan->bayar, 0, ',', '.') }}</td>
        </tr>

        <!-- Uang kembalian -->
        <tr>
            <td>Kembali</td>
            <td class="right">Rp{{ number_format($penjualan->kembalian, 0, ',', '.') }}</td>
        </tr>

    </table>

    <div class="line"></div>

    <!-- Footer struk -->
    <p class="center">~~ TERIMA KASIH ~~</p>
    <p class="center">Barang yang sudah dibeli</p>
    <p class="center">tidak dapat ditukar/dikembalikan</p>

    <!-- Auto print saat halaman dibuka -->
    <script>
        window.print();
    </script>

</body>
</html>