<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TipeTiket;
use Illuminate\Http\Request;

class TipeTiketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tipeTikets = TipeTiket::paginate(10);
        return view('admin.tipe-tiket.index', compact('tipeTikets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tipe-tiket.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255|unique:tipe_tikets,nama',
            'keterangan' => 'nullable|string',
        ]);

        TipeTiket::create($validated);

        return redirect()->route('admin.tipe-tiket.index')
            ->with('success', 'Tipe tiket berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TipeTiket $tipeTiket)
    {
        return view('admin.tipe-tiket.edit', compact('tipeTiket'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TipeTiket $tipeTiket)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255|unique:tipe_tikets,nama,' . $tipeTiket->id,
            'keterangan' => 'nullable|string',
        ]);

        $tipeTiket->update($validated);

        return redirect()->route('admin.tipe-tiket.index')
            ->with('success', 'Tipe tiket berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TipeTiket $tipeTiket)
    {
        if ($tipeTiket->tikets()->exists()) {
            return redirect()->route('admin.tipe-tiket.index')
                ->with('error', 'Tipe tiket tidak dapat dihapus karena masih memiliki tiket.');
        }

        $tipeTiket->delete();

        return redirect()->route('admin.tipe-tiket.index')
            ->with('success', 'Tipe tiket berhasil dihapus.');
    }
}
