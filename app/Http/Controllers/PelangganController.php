<?php

namespace App\Http\Controllers;

// Import model Pelanggan dan Request untuk menangani input form
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index()
    {
        // Mengambil data pelanggan, diurutkan dari yang terbaru dan dibagi per 10 data (pagination)
        $pelanggan = Pelanggan::orderBy('created_at', 'desc')->paginate(10);        

        // Mengirim data pelanggan ke view index
        return view('pelanggan.index', compact('pelanggan'));
    }

    public function create()
    {
        // Menampilkan halaman form tambah pelanggan
        return view('pelanggan.create');
    }

    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'nama_pelanggan' => 'required',
            'alamat' => 'required',
            'nomor_telepon' => 'required',
            'email' => 'required|email|unique:pelanggan,email' 
        ]);

        // Mengambil data pelanggan terakhir untuk membuat kode pelanggan otomatis
        $lastPelanggan = Pelanggan::orderBy('id', 'desc')->first();

        // Ambil angka terakhir dari kode pelanggan (misal: PLG-0001 → ambil 0001)
        $lastId = $lastPelanggan ? intval(substr($lastPelanggan->kode_pelanggan, 4)) : 0;

        // Membuat kode pelanggan baru dengan format PLG-0001
        $newKode = 'PLG-' . str_pad($lastId + 1, 4, '0', STR_PAD_LEFT);

        // Menyimpan data pelanggan ke database
        Pelanggan::create([
            'nama_pelanggan' => $request->nama_pelanggan,
            'kode_pelanggan' => $newKode,
            'alamat' => $request->alamat,
            'nomor_telepon' => $request->nomor_telepon,
            'email' => $request->email,
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('pelanggan.index')->with('success', 'Data pelanggan berhasil ditambahkan.');
    }

    public function edit(Pelanggan $pelanggan)
    {
        // Menampilkan halaman edit dengan data pelanggan yang dipilih
        return view('pelanggan.edit', compact('pelanggan'));
    }

    public function show($id)
    {
        // Mengambil data pelanggan berdasarkan ID (jika tidak ada akan error 404)
        $pelanggan = Pelanggan::findOrFail($id);

        // Menampilkan detail pelanggan
        return view('pelanggan.show', compact('pelanggan'));
    }

    public function update(Request $request, Pelanggan $pelanggan)
    {
        // Validasi input saat update
        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'nomor_telepon' => 'required',
            // Email harus unik, kecuali milik pelanggan yang sedang diupdate
            'email' => 'required|email|unique:pelanggan,email,' . $pelanggan->id
        ]);

        // Update data pelanggan
        $pelanggan->update([
            'nama_pelanggan' => $request->nama_pelanggan,
            'alamat' => $request->alamat,
            'nomor_telepon' => $request->nomor_telepon,
            'email' => $request->email,
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('pelanggan.index')->with('success', 'Data pelanggan berhasil diperbarui.');   
    }

    public function destroy(Pelanggan $pelanggan)
    {
        // Menghapus data pelanggan
        $pelanggan->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan dihapus!');
    }
}