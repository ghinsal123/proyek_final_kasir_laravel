<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Struk Penjualan</title>
    <style>
        body {
            font-family: monospace;
            font-size: 18px;
            width: 400px;
            margin: 0 auto;
            padding: 16px;
        }
        h2, p {
            text-align: center;
            margin: 10px 0;
        }
        .info {
            margin-bottom: 16px;
        }
        .info p{
            text-align: left;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        td {
            padding: 5px 0;
        }
        .right { text-align: right; }
        .center { text-align: center; }
        .line { border-top: 1px dashed #000; margin: 12px 0; }
        .total-row td {
            font-weight: bold;
        }
    </style>
</head>
<body>

    <h2>Toko ButikGhins</h2>
    <p>Jl. Lombok No. 49</p>
    <p>Telp. 0812-3456-7890</p>
    <div class="line"></div>

    <div class="info">
        <p>Kode Pelanggan: {{ $penjualan->pelanggan->kode_pelanggan }}</p>
        <p>Tanggal: {{ $penjualan->tanggal_penjualan }}</p>
        <p>Pelanggan: {{ $penjualan->pelanggan->nama_pelanggan ?? '-' }}</p>
    </div>

    <div class="line"></div>

    <table>
        @foreach ($penjualan->detailPenjualan as $detail)
            <tr>
                <td colspan="2">{{ $detail->produk->nama_produk ?? 'Produk tidak ditemukan' }}</td>
            </tr>
            <tr>
                <td>{{ $detail->jumlah_produk }} x Rp{{ number_format($detail->harga_satuan, 0, ',', '.') }}</td>
                <td class="right">Rp{{ number_format($detail->subtotal ?? ($detail->jumlah_produk * $detail->harga_satuan), 0, ',', '.') }}</td>
            </tr>
        @endforeach
    </table>

    <div class="line"></div>

    <table>
        <tr class="total-row">
            <td>Total</td>
            <td class="right">Rp{{ number_format($penjualan->total_harga, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>Bayar</td>
            <td class="right">Rp{{ number_format($penjualan->bayar, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>Kembali</td>
            <td class="right">Rp{{ number_format($penjualan->kembalian, 0, ',', '.') }}</td>
        </tr>
    </table>

    <div class="line"></div>
    <p class="center">~~ TERIMA KASIH ~~</p>
    <p class="center">Barang yang sudah dibeli</p>
    <p class="center">tidak dapat ditukar/dikembalikan</p>

    <script>
        window.print();
    </script>

</body>
</html>
