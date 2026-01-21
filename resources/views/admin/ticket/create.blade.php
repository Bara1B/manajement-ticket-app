@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-10">
    <div class="card bg-base-100 shadow-sm max-w-2xl mx-auto">
        <div class="card-body">
            <h2 class="card-title text-2xl mb-6">Tambah Tiket Baru</h2>

            <form method="POST" action="{{ route('admin.tickets.store') }}" class="space-y-4">
                @csrf

                <!-- Event Selection -->
                <div class="form-control">
                    <label class="label">
                        <span class="label-text font-semibold">Event</span>
                    </label>
                    <select name="event_id" class="select select-bordered w-full" required>
                        <option value="" disabled selected>Pilih Event</option>
                        @foreach ($events as $event)
                            <option value="{{ $event->id }}">{{ $event->judul }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Tipe Ticket -->
                <div class="form-control">
                    <label class="label">
                        <span class="label-text font-semibold">Tipe Ticket</span>
                    </label>
                    <select name="tipe_tiket_id" class="select select-bordered w-full" required>
                        <option value="" disabled selected>Pilih Tipe Ticket</option>
                        @foreach ($tipeTikets as $tipeTiket)
                            <option value="{{ $tipeTiket->id }}">{{ $tipeTiket->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Harga -->
                <div class="form-control">
                    <label class="label">
                        <span class="label-text font-semibold">Harga</span>
                    </label>
                    <input type="number" name="harga" placeholder="Masukkan harga tiket"
                        class="input input-bordered w-full" min="0" step="1000" required />
                </div>

                <!-- Stok -->
                <div class="form-control">
                    <label class="label">
                        <span class="label-text font-semibold">Stok</span>
                    </label>
                    <input type="number" name="stok" placeholder="Masukkan jumlah stok"
                        class="input input-bordered w-full" min="0" required />
                </div>

                <!-- Gambar -->
                <div class="form-control">
                    <label class="label">
                        <span class="label-text font-semibold">Gambar Tiket</span>
                    </label>
                    <input type="file" name="gambar" accept="image/*"
                        class="file-input file-input-bordered w-full" />
                    <div class="label">
                        <span class="label-text-alt">Format: JPG, PNG, GIF, SVG. Maksimal 2MB</span>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex gap-4 mt-6">
                    <a href="{{ route('admin.tickets.index') }}" class="btn btn-outline">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan Tiket</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection