<?php

namespace App\Http\Controllers;

// Import model yang dibutuhkan
use App\Models\Penjualan;
use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\Produk;

class PenjualanController extends Controller
{
    /**
     * Menampilkan daftar data penjualan
     */
    public function index()
    {
        // Mengambil data penjualan terbaru dengan pagination 10 data per halaman
        $penjualan = Penjualan::orderBy('created_at', 'desc')->paginate(10);        

        // Mengirim data ke view penjualan.index
        return view('penjualan.index', compact('penjualan'));
    }

    /**
     * Menampilkan form tambah penjualan
     */
    public function create()
    {
        // Mengambil semua data pelanggan dan produk untuk ditampilkan di form
        $pelanggan = Pelanggan::all();
        $produk = Produk::all();

        // Mengirim data ke view create penjualan
        return view('penjualan.create', compact('pelanggan', 'produk'));
    }

    /**
     * Menyimpan transaksi penjualan baru
     */
    public function store(Request $request)
    {
        // Validasi input dari form transaksi
        $request->validate([
            'pelanggan_id' => 'required|exists:pelanggan,id',
            'tanggal_penjualan' => 'required|date',
            'produk_id' => 'required|array',
            'produk_id.*' => 'exists:produk,id',
            'jumlah_produk' => 'required|array',
            'jumlah_produk.*' => 'integer|min:1',
            'bayar' => 'required|numeric|min:0',
        ]);

        $total = 0;   // Menyimpan total harga transaksi
        $detail = []; // Menyimpan data detail penjualan

        // Perulangan setiap produk yang dibeli
        foreach ($request->produk_id as $key => $produkId) {

            // Mengambil data produk berdasarkan ID
            $produk = Produk::findOrFail($produkId);

            // Mengambil jumlah pembelian
            $qty = isset($request->jumlah_produk[$key]) ? (int)$request->jumlah_produk[$key] : 0;

            // Menghitung subtotal per produk
            $subtotal = $produk->harga * $qty;

            // Menambahkan ke total keseluruhan
            $total += $subtotal;

            // Menyimpan detail sementara
            $detail[] = [
                'produk_id' => $produkId,
                'jumlah_produk' => $qty,
                'harga_satuan' => $produk->harga,
                'subtotal' => $subtotal,
            ];
        }

        // Validasi apakah uang bayar cukup
        if ($request->bayar < $total) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['bayar' => 'Jumlah bayar harus minimal sama dengan total harga.']);
        }

        // Menghitung kembalian
        $kembalian = $request->bayar - $total;

        // Menyimpan data penjualan utama
        $penjualan = Penjualan::create([
            'pelanggan_id' => $request->pelanggan_id,
            'tanggal_penjualan' => $request->tanggal_penjualan,
            'total_harga' => $total,
            'bayar' => $request->bayar,
            'kembalian' => $kembalian,
        ]);

        // Menyimpan detail penjualan (relasi ke tabel detail)
        foreach ($detail as $d) {
            $penjualan->detailPenjualan()->create($d);
        }

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('penjualan.index')->with('success', 'Penjualan berhasil disimpan');
    }

    /**
     * Menampilkan detail satu transaksi penjualan
     */
    public function show(Penjualan $penjualan)
    {
        // Load relasi pelanggan dan detail produk
        $penjualan->load('pelanggan', 'detailPenjualan.produk');

        // Menampilkan halaman detail penjualan
        return view('penjualan.show', compact('penjualan'));
    }

    /**
     * Menampilkan halaman cetak struk/nota
     */
    public function cetak($id)
    {
        // Mengambil data penjualan beserta relasinya
        $penjualan = Penjualan::with(['pelanggan', 'detailPenjualan.produk'])->findOrFail($id);

        // Menampilkan view cetak
        return view('penjualan.cetak', compact('penjualan'));
    }

    /**
     * Menghapus data penjualan
     */
    public function destroy($id)
    {
        // Mengambil data penjualan berdasarkan ID
        $penjualan = Penjualan::findOrFail($id);

        // Menghapus data penjualan
        $penjualan->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('penjualan.index')->with('success', 'Data penjualan berhasil dihapus.');
    }
}