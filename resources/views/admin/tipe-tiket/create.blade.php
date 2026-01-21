@extends('layouts.admin')

@section('content')

    <div class="container mx-auto p-10">
        <h1 class="text-3xl font-semibold mb-6">Tambah Tipe Tiket</h1>
        
        <div class="bg-white p-8 rounded-box shadow-xs max-w-2xl">
            <form method="POST" action="{{ route('admin.tipe-tiket.store') }}">
                @csrf

                <!-- Nama Tipe Tiket -->
                <div class="form-control w-full mb-6">
                    <label class="label mb-2">
                        <span class="label-text font-semibold">Nama Tipe Tiket <span class="text-red-500">*</span></span>
                    </label>
                    <input 
                        type="text" 
                        placeholder="Contoh: Reguler, VIP, Early Bird" 
                        class="input input-bordered w-full @error('nama') input-error @enderror" 
                        name="nama" 
                        value="{{ old('nama') }}"
                        required 
                    />
                    @error('nama')
                        <label class="label">
                            <span class="label-text-alt text-red-500">{{ $message }}</span>
                        </label>
                    @enderror
                </div>

                <!-- Keterangan -->
                <div class="form-control w-full mb-6">
                    <label class="label mb-2">
                        <span class="label-text font-semibold">Keterangan</span>
                    </label>
                    <textarea 
                        placeholder="Masukkan keterangan untuk tipe tiket ini (opsional)" 
                        class="textarea textarea-bordered w-full @error('keterangan') textarea-error @enderror"
                        name="keterangan"
                        rows="4"
                    >{{ old('keterangan') }}</textarea>
                    @error('keterangan')
                        <label class="label">
                            <span class="label-text-alt text-red-500">{{ $message }}</span>
                        </label>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="flex gap-3">
                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>
                    <a href="{{ route('admin.tipe-tiket.index') }}" class="btn btn-ghost">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

@endsection
