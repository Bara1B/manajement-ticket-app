@extends('layouts.admin')

@section('content')

@if (session('success'))
    <div class="toast toast-bottom toast-center">
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

@if (session('error'))
    <div class="toast toast-bottom toast-center">
        <div class="alert alert-error">
            <span>{{ session('error') }}</span>
        </div>
    </div>

    <script>
    setTimeout(() => {
        document.querySelector('.toast')?.remove()
    }, 3000)
    </script>
@endif

<div class="container mx-auto p-10">
    <h1 class="text-3xl font-semibold mb-6">Manajemen Tiket</h1>

    <!-- Tabs Navigation -->
    <div class="tabs tabs-bordered mb-6" role="tablist">
        <input type="radio" name="ticket_tabs" role="tab" class="tab" aria-label="Tipe Tiket" checked />
        <div role="tabpanel" class="tab-content p-0">
            <!-- Tipe Tiket Management -->
            <div class="mt-4">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-2xl font-semibold">Manajemen Tipe Tiket</h2>
                    <a href="{{ route('admin.tipe-tiket.create') }}" class="btn btn-primary">Tambah Tipe Tiket</a>
                </div>

                <div class="bg-white rounded-box shadow-xs overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Tipe Tiket</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($tipeTikets as $index => $tipeTiket)
                                    <tr>
                                        <th>{{ $tipeTikets->firstItem() + $index }}</th>
                                        <td class="font-semibold">{{ $tipeTiket->nama }}</td>
                                        <td>{{ $tipeTiket->keterangan ? Str::limit($tipeTiket->keterangan, 40) : '-' }}</td>
                                        <td>
                                            <a href="{{ route('admin.tipe-tiket.edit', $tipeTiket->id) }}" class="btn btn-sm btn-primary mr-2">Edit</a>
                                            <form method="POST" action="{{ route('admin.tipe-tiket.destroy', $tipeTiket->id) }}" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus tipe tiket ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm bg-red-500 text-white">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-4">Tidak ada tipe tiket tersedia.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="flex justify-center p-4">
                        {{ $tipeTikets->links() }}
                    </div>
                </div>
            </div>
        </div>

        <input type="radio" name="ticket_tabs" role="tab" class="tab" aria-label="Tiket" />
        <div role="tabpanel" class="tab-content p-0">
            <!-- Tiket Management -->
            <div class="mt-4">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-2xl font-semibold">Daftar Tiket</h2>
                    <a href="{{ route('admin.tickets.create') }}" class="btn btn-primary">Tambah Tiket</a>
                </div>

                <div class="bg-white rounded-box shadow-xs overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Event</th>
                                    <th>Tipe Tiket</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Gambar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($tickets as $index => $ticket)
                                    <tr>
                                        <th>{{ $tickets->firstItem() + $index }}</th>
                                        <td>{{ $ticket->event->judul ?? 'N/A' }}</td>
                                        <td class="font-semibold">{{ $ticket->tipeTiket->nama ?? 'N/A' }}</td>
                                        <td>Rp {{ number_format($ticket->harga, 0, ',', '.') }}</td>
                                        <td>{{ $ticket->stok }}</td>
                                        <td>
                                            @if($ticket->gambar)
                                                <img src="{{ asset('images/tickets/' . $ticket->gambar) }}" alt="Tiket" class="w-12 h-12 object-cover rounded">
                                            @else
                                                <span class="text-gray-400 text-sm">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.tickets.edit', $ticket->id) }}" class="btn btn-sm btn-primary mr-2">Edit</a>
                                            <form method="POST" action="{{ route('admin.tickets.destroy', $ticket->id) }}" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus tiket ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm bg-red-500 text-white">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-4">Tidak ada tiket tersedia.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="flex justify-center p-4">
                        {{ $tickets->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
