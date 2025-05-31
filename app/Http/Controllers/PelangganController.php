<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggan = Pelanggan::orderBy('created_at', 'desc')->paginate(10);        
        return view('pelanggan.index', compact('pelanggan'));
    }

    public function create()
    {
        return view('pelanggan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required',
            'alamat' => 'required',
            'nomor_telepon' => 'required',
            'email' => 'required|email|unique:pelanggan,email' 
        ]);

        $lastPelanggan = Pelanggan::orderBy('id', 'desc')->first();
        $lastId = $lastPelanggan ? intval(substr($lastPelanggan->kode_pelanggan, 4)) : 0;
        $newKode = 'PLG-' . str_pad($lastId + 1, 4, '0', STR_PAD_LEFT);

        Pelanggan::create([
            'nama_pelanggan' => $request->nama_pelanggan,
            'kode_pelanggan' => $newKode,
            'alamat' => $request->alamat,
            'nomor_telepon' => $request->nomor_telepon,
            'email' => $request->email,
        ]);

        return redirect()->route('pelanggan.index')->with('success', 'Data pelanggan berhasil ditambahkan.');    }

    public function edit(Pelanggan $pelanggan)
    {
        return view('pelanggan.edit', compact('pelanggan'));
    }

    public function show($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        return view('pelanggan.show', compact('pelanggan'));
    }


    public function update(Request $request, Pelanggan $pelanggan)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'nomor_telepon' => 'required',
            'email' => 'required|email|unique:pelanggan,email,' . $pelanggan->id
        ]);

        $pelanggan->update([
            'nama_pelanggan' => $request->nama_pelanggan,
            'alamat' => $request->alamat,
            'nomor_telepon' => $request->nomor_telepon,
            'email' => $request->email,
        ]);

        return redirect()->route('pelanggan.index')->with('success', 'Data pelanggan berhasil diperbarui.');   
    }

    public function destroy(Pelanggan $pelanggan)
    {

        $pelanggan->delete();

        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan dihapus!');
    }
}
