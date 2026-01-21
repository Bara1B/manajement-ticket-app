@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-10">
    <div class="card bg-base-100 shadow-sm max-w-2xl mx-auto">
        <div class="card-body">
            <h2 class="card-title text-2xl mb-6">Edit Tiket</h2>

            <form method="POST" action="{{ route('admin.tickets.update', $ticket->id) }}" class="space-y-4">
                @csrf
                @method('PUT')

                <!-- Event Selection -->
                <div class="form-control">
                    <label class="label">
                        <span class="label-text font-semibold">Event</span>
                    </label>
                    <select name="event_id" class="select select-bordered w-full" required>
                        <option value="" disabled>Pilih Event</option>
                        @foreach ($events as $event)
                            <option value="{{ $event->id }}" {{ $ticket->event_id == $event->id ? 'selected' : '' }}>
                                {{ $event->judul }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Tipe Ticket -->
                <div class="form-control">
                    <label class="label">
                        <span class="label-text font-semibold">Tipe Ticket</span>
                    </label>
                    <select name="tipe_tiket_id" class="select select-bordered w-full" required>
                        <option value="" disabled>Pilih Tipe Ticket</option>
                        @foreach ($tipeTikets as $tipeTiket)
                            <option value="{{ $tipeTiket->id }}" {{ $ticket->tipe_tiket_id == $tipeTiket->id ? 'selected' : '' }}>
                                {{ $tipeTiket->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Harga -->
                <div class="form-control">
                    <label class="label">
                        <span class="label-text font-semibold">Harga</span>
                    </label>
                    <input type="number" name="harga" value="{{ $ticket->harga }}"
                        class="input input-bordered w-full" min="0" step="1000" required />
                </div>

                <!-- Stok -->
                <div class="form-control">
                    <label class="label">
                        <span class="label-text font-semibold">Stok</span>
                    </label>
                    <input type="number" name="stok" value="{{ $ticket->stok }}"
                        class="input input-bordered w-full" min="0" required />
                </div>

                <!-- Gambar -->
                <div class="form-control">
                    <label class="label">
                        <span class="label-text font-semibold">Gambar Tiket</span>
                    </label>
                    @if($ticket->gambar)
                        <div class="mb-2">
                            <img src="{{ asset('images/tickets/' . $ticket->gambar) }}" alt="Current Image" class="w-32 h-32 object-cover rounded">
                        </div>
                    @endif
                    <input type="file" name="gambar" accept="image/*"
                        class="file-input file-input-bordered w-full" />
                    <div class="label">
                        <span class="label-text-alt">Format: JPG, PNG, GIF, SVG. Maksimal 2MB. Biarkan kosong jika tidak ingin mengubah gambar.</span>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex gap-4 mt-6">
                    <a href="{{ route('admin.tickets.show', $ticket->id) }}" class="btn btn-outline">Batal</a>
                    <button type="submit" class="btn btn-primary">Update Tiket</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection