<?php

namespace App\Http\Controllers\Admin;

use App\Models\Lokasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LokasiController extends Controller
{
    public function index()
    {
        $lokasis = Lokasi::aktif()->orderBy('nama_lokasi')->get();
        return view('admin.lokasi.index', compact('lokasis'));
    }

    // 🔹 Form tambah lokasi
    public function create()
    {
        return view('admin.lokasi.create');
    }

    // 🔹 Simpan data lokasi baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

         Lokasi::create([
        'nama_lokasi' => $request->nama
    ]);

        return redirect()
            ->route('admin.lokasi.index')
            ->with('success', 'Lokasi berhasil ditambahkan');
    }

    // 🔹 Detail lokasi
    public function show(Lokasi $lokasi)
    {
       
    }

    // 🔹 Form edit lokasi
    public function edit(Lokasi $lokasi)
    {
        return view('admin.lokasi.edit', compact('lokasi'));
    }

    // 🔹 Update lokasi
    public function update(Request $request, Lokasi $lokasi)
    {
        $request->validate([
            'nama_lokasi' => 'required|string|max:255',
        ]);

        $lokasi->update($request->all());

        return redirect()
            ->route('admin.lokasi.index')
            ->with('success', 'Lokasi berhasil diupdate');
    }

    // 🔹 Hapus lokasi
    public function destroy($id)
    {
        $lokasi = Lokasi::findOrFail($id);
        $lokasi->update(['aktif' => 'N']);

        return redirect()->route('admin.lokasi.index')->with('success', 'Lokasi berhasil dinonaktifkan');
    }

    public function scopeAktif($query)
    {
        return $query->where('aktif', 'Y');
    }
}