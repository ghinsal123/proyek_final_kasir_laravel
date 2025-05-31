<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\Produk;

class PenjualanController extends Controller
{
    public function index()
    {
        $penjualan = Penjualan::orderBy('created_at', 'desc')->paginate(10);        
        return view('penjualan.index', compact('penjualan'));
    }

    public function create()
    {
        $pelanggan = Pelanggan::all();
        $produk = Produk::all();
        return view('penjualan.create', compact('pelanggan', 'produk'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pelanggan_id' => 'required|exists:pelanggan,id',
            'tanggal_penjualan' => 'required|date',
            'produk_id' => 'required|array',
            'produk_id.*' => 'exists:produk,id',
            'jumlah_produk' => 'required|array',
            'jumlah_produk.*' => 'integer|min:1',
            'bayar' => 'required|numeric|min:0',
        ]);

        $total = 0;
        $detail = [];

        foreach ($request->produk_id as $key => $produkId) {
            $produk = Produk::findOrFail($produkId);
            $qty = isset($request->jumlah_produk[$key]) ? (int)$request->jumlah_produk[$key] : 0;
            $subtotal = $produk->harga * $qty;
            $total += $subtotal;

            $detail[] = [
                'produk_id' => $produkId,
                'jumlah_produk' => $qty,
                'harga_satuan' => $produk->harga,
                'subtotal' => $subtotal,
            ];
        }

        if ($request->bayar < $total) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['bayar' => 'Jumlah bayar harus minimal sama dengan total harga.']);
        }

        $kembalian = $request->bayar - $total;

        $penjualan = Penjualan::create([
            'pelanggan_id' => $request->pelanggan_id,
            'tanggal_penjualan' => $request->tanggal_penjualan,
            'total_harga' => $total,
            'bayar' => $request->bayar,
            'kembalian' => $kembalian,
        ]);

        foreach ($detail as $d) {
            $penjualan->detailPenjualan()->create($d);
        }

        return redirect()->route('penjualan.index')->with('success', 'Penjualan berhasil disimpan');
    }

    public function show(Penjualan $penjualan)
    {
        $penjualan->load('pelanggan', 'detailPenjualan.produk');
        return view('penjualan.show', compact('penjualan'));
    }

    public function cetak($id)
    {
        $penjualan = Penjualan::with(['pelanggan', 'detailPenjualan.produk'])->findOrFail($id);
        return view('penjualan.cetak', compact('penjualan'));
    }
    public function destroy($id)
    {
        $penjualan = Penjualan::findOrFail($id);
        $penjualan->delete();

        return redirect()->route('penjualan.index')->with('success', 'Data penjualan berhasil dihapus.');
    }
}
