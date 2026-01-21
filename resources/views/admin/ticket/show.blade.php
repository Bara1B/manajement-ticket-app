@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-10">
    <div class="card bg-base-100 shadow-sm max-w-2xl mx-auto">
        <div class="card-body">
            <div class="flex justify-between items-center mb-6">
                <h2 class="card-title text-2xl">Detail Tiket</h2>
                <a href="{{ route('admin.tickets.index') }}" class="btn btn-outline">Kembali</a>
            </div>

            <div class="space-y-4">
                <!-- Event -->
                <div>
                    <label class="label">
                        <span class="label-text font-semibold">Event</span>
                    </label>
                    <p class="text-lg">{{ $ticket->event->judul }}</p>
                </div>

                <!-- Tipe -->
                <div>
                    <label class="label">
                        <span class="label-text font-semibold">Tipe Ticket</span>
                    </label>
                    <p class="text-lg">{{ $ticket->tipeTiket->nama ?? 'N/A' }}</p>
                </div>

                <!-- Harga -->
                <div>
                    <label class="label">
                        <span class="label-text font-semibold">Harga</span>
                    </label>
                    <p class="text-lg font-semibold text-green-600">Rp {{ number_format($ticket->harga, 0, ',', '.') }}</p>
                </div>

                <!-- Stok -->
                <div>
                    <label class="label">
                        <span class="label-text font-semibold">Stok</span>
                    </label>
                    <p class="text-lg">{{ $ticket->stok }}</p>
                </div>

                <!-- Created At -->
                <div>
                    <label class="label">
                        <span class="label-text font-semibold">Dibuat Pada</span>
                    </label>
                    <p class="text-lg">{{ $ticket->created_at->format('d M Y, H:i') }}</p>
                </div>

                <!-- Updated At -->
                <div>
                    <label class="label">
                        <span class="label-text font-semibold">Terakhir Diupdate</span>
                    </label>
                    <p class="text-lg">{{ $ticket->updated_at->format('d M Y, H:i') }}</p>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-4 mt-8">
                <a href="{{ route('admin.tickets.edit', $ticket->id) }}" class="btn btn-warning">Edit Tiket</a>
                <form action="{{ route('admin.tickets.destroy', $ticket->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-error"
                        onclick="return confirm('Apakah Anda yakin ingin menghapus tiket ini?')">Hapus Tiket</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection