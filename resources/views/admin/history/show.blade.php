@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-10">
    <div class="card bg-base-100 shadow-sm max-w-4xl mx-auto">
        <div class="card-body">
            <div class="flex justify-between items-center mb-6">
                <h2 class="card-title text-2xl">Detail Order #{{ $order->id }}</h2>
                <a href="{{ route('admin.histories.index') }}" class="btn btn-outline">Kembali</a>
            </div>

            <!-- Order Information -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="space-y-4">
                    <div>
                        <label class="label">
                            <span class="label-text font-semibold">Tanggal Order</span>
                        </label>
                        <p class="text-lg">{{ $order->order_date->format('d M Y, H:i') }}</p>
                    </div>

                    <div>
                        <label class="label">
                            <span class="label-text font-semibold">Pembeli</span>
                        </label>
                        <p class="text-lg">{{ $order->user->name }}</p>
                        <p class="text-sm text-gray-600">{{ $order->user->email }}</p>
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="label">
                            <span class="label-text font-semibold">Event</span>
                        </label>
                        <div class="flex items-center gap-4">
                            @if($order->event->gambar)
                                <img src="{{ asset('images/events/' . $order->event->gambar) }}"
                                     alt="{{ $order->event->judul }}"
                                     class="w-16 h-16 object-cover rounded-lg">
                            @endif
                            <div>
                                <p class="text-lg font-semibold">{{ $order->event->judul }}</p>
                                <p class="text-sm text-gray-600">{{ $order->event->lokasi }}</p>
                                <p class="text-sm text-gray-600">{{ $order->event->tanggal_waktu->format('d M Y, H:i') }}</p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="label">
                            <span class="label-text font-semibold">Total Pembayaran</span>
                        </label>
                        <p class="text-2xl font-bold text-green-600">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>

            <!-- Ticket Details -->
            <div class="divider">Detail Tiket</div>

            <div class="overflow-x-auto">
                <table class="table table-zebra">
                    <thead>
                        <tr>
                            <th>Tipe Tiket</th>
                            <th>Jumlah</th>
                            <th>Harga Satuan</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->detailOrders as $detail)
                            <tr>
                                <td>{{ $detail->tiket->tipe }}</td>
                                <td>{{ $detail->jumlah }}</td>
                                <td>Rp {{ number_format($detail->tiket->harga, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($detail->subtotal_harga, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Summary -->
            <div class="divider"></div>
            <div class="flex justify-end">
                <div class="text-right">
                    <p class="text-lg">Total Pembayaran:</p>
                    <p class="text-2xl font-bold text-green-600">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection