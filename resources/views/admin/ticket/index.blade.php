@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-10">
    @if (session('success'))
        <div class="toast toast-bottom toast-center z-50">
            <div class="alert alert-success">
                <span>{{ session('success') }}</span>
            </div>
        </div>

        <script>
            setTimeout(() => {
                document.querySelector('.toast')?.remove()
            }, 3000)
        </script>
    @endif

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-semibold">Manajemen Tiket</h1>
        <a href="{{ route('admin.tickets.create') }}" class="btn btn-primary">Tambah Tiket</a>
    </div>

    <div class="card bg-base-100 shadow-sm">
        <div class="card-body">
            <div class="overflow-x-auto">
                <table class="table table-zebra">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Event</th>
                            <th>Tipe</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tickets as $index => $ticket)
                            <tr>
                                <th>{{ $tickets->firstItem() + $index }}</th>
                                <td>
                                    @if($ticket->gambar)
                                        <img src="{{ asset('images/tickets/' . $ticket->gambar) }}" alt="Ticket Image" class="w-16 h-16 object-cover rounded">
                                    @else
                                        <span class="text-gray-400">No Image</span>
                                    @endif
                                </td>
                                <td>{{ $ticket->event->judul }}</td>
                                <td>{{ $ticket->tipeTiket->nama ?? 'N/A' }}</td>
                                <td>Rp {{ number_format($ticket->harga, 0, ',', '.') }}</td>
                                <td>{{ $ticket->stok }}</td>
                                <td>
                                    <div class="flex gap-2">
                                        <a href="{{ route('admin.tickets.show', $ticket->id) }}" class="btn btn-sm btn-info">Lihat</a>
                                        <a href="{{ route('admin.tickets.edit', $ticket->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('admin.tickets.destroy', $ticket->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-error"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus tiket ini?')">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada tiket tersedia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($tickets->hasPages())
                <div class="flex justify-center mt-4">
                    {{ $tickets->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection