<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tiket;
use Illuminate\Http\Request;

class TiketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets = Tiket::with('event', 'tipeTiket')->paginate(10);
        return view('admin.ticket.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $events = \App\Models\Event::all();
        $tipeTikets = \App\Models\TipeTiket::all();
        return view('admin.ticket.create', compact('events', 'tipeTikets'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = request()->validate([
            'event_id' => 'required|exists:events,id',
            'tipe_tiket_id' => 'required|exists:tipe_tikets,id',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('gambar')) {
            $imageName = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('images/tickets'), $imageName);
            $validatedData['gambar'] = $imageName;
        }

        // Create the ticket
        Tiket::create($validatedData);

        return redirect()->route('admin.tickets.index')->with('success', 'Ticket berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ticket = Tiket::with('event')->findOrFail($id);
        return view('admin.ticket.show', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $ticket = Tiket::findOrFail($id);
        $events = \App\Models\Event::all();
        $tipeTikets = \App\Models\TipeTiket::all();
        return view('admin.ticket.edit', compact('ticket', 'events', 'tipeTikets'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $ticket = Tiket::findOrFail($id);

        $validatedData = $request->validate([
            'tipe_tiket_id' => 'required|exists:tipe_tikets,id',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('gambar')) {
            $imageName = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('images/tickets'), $imageName);
            $validatedData['gambar'] = $imageName;
        }

        $ticket->update($validatedData);

        return redirect()->route('admin.tickets.index')->with('success', 'Ticket berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ticket = Tiket::findOrFail($id);
        $eventId = $ticket->event_id;
        $ticket->delete();

        return redirect()->route('admin.events.show', $eventId)->with('success', 'Ticket berhasil dihapus.');
    }
}
