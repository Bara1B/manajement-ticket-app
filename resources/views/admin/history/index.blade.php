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
        <h1 class="text-3xl font-semibold">History Pembelian</h1>
    </div>

    <div class="card bg-base-100 shadow-sm">
        <div class="card-body">
            <div class="overflow-x-auto">
                <table class="table table-zebra">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Order</th>
                            <th>Pembeli</th>
                            <th>Event</th>
                            <th>Total Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($histories as $index => $history)
                            <tr>
                                <th>{{ $index + 1 }}</th>
                                <td>{{ $history->order_date->format('d M Y, H:i') }}</td>
                                <td>{{ $history->user->name }}</td>
                                <td>{{ $history->event->judul }}</td>
                                <td>Rp {{ number_format($history->total_harga, 0, ',', '.') }}</td>
                                <td>
                                    <a href="{{ route('admin.histories.show', $history->id) }}" class="btn btn-sm btn-info">Lihat Detail</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Belum ada history pembelian.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection