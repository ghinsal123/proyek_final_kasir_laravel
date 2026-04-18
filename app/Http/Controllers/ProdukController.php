<?php

namespace App\Http\Controllers;

// Import model Produk, Request, dan Storage untuk file handling
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    /**
     * Menampilkan daftar produk
     */
    public function index()
    {
        // Mengambil data produk dengan pagination 10 per halaman
        $produk = Produk::paginate(10);    

        // Mengirim data ke view produk.index
        return view('produk.index', compact('produk'));
    }

    /**
     * Menampilkan form tambah produk
     */
    public function create()
    {
        // Menampilkan halaman form create produk
        return view('produk.create');
    }

    /**
     * Menyimpan data produk baru ke database
     */
    public function store(Request $request)
    {
        // Validasi input form produk
        $request->validate([
            'nama_produk' => 'required',
            'harga' => 'required|integer|min:0',
            'stok' => 'required|integer',
            'deskripsi' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Mengambil semua data dari request
        $data = $request->all();

        // Jika ada file foto yang diupload
        if ($request->hasFile('foto')) {
            // Menyimpan foto ke folder storage/public/foto_produk
            $data['foto'] = $request->file('foto')->store('foto_produk', 'public');
        }

        // Menyimpan data produk ke database
        Produk::create($data);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail satu produk
     */
    public function show(Produk $produk)
    {
        // Menampilkan detail produk
        return view('produk.show', compact('produk'));
    }

    /**
     * Menampilkan form edit produk
     */
    public function edit(Produk $produk)
    {
        // Menampilkan halaman edit dengan data produk
        return view('produk.edit', compact('produk'));
    }

    /**
     * Update data produk di database
     */
    public function update(Request $request, Produk $produk)
    {
        // Validasi input update produk
        $request->validate([
            'nama_produk' => 'required',
            'harga' => 'required|integer|min:0',
            'stok' => 'required|integer',
            'deskripsi' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Ambil semua data request
        $data = $request->all();

        // Jika ada foto baru diupload
        if ($request->hasFile('foto')) {

            // Hapus foto lama jika ada di storage
            if ($produk->foto && Storage::disk('public')->exists($produk->foto)) {
                Storage::disk('public')->delete($produk->foto);
            }

            // Simpan foto baru
            $data['foto'] = $request->file('foto')->store('foto_produk', 'public');
        }

        // Update data produk
        $produk->update($data);

        // Redirect dengan pesan sukses
        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Menghapus data produk dari database
     */
    public function destroy(Produk $produk)
    {
        // Hapus foto dari storage jika ada
        if ($produk->foto && Storage::disk('public')->exists($produk->foto)) {
            Storage::disk('public')->delete($produk->foto);
        }

        // Hapus data produk dari database
        $produk->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus.');
    }
}