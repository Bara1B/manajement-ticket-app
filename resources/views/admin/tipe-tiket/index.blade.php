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
        <div class="flex">
            <h1 class="text-3xl font-semibold mb-4">Manajemen Tipe Tiket</h1>
            <a href="{{ route('admin.tipe-tiket.create') }}" class="btn btn-primary ml-auto">Tambah Tipe Tiket</a>
        </div>
        <div class="overflow-x-auto rounded-box bg-white p-5 shadow-xs">
            <table class="table">
                <!-- head -->
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
                            <td>{{ $tipeTiket->keterangan ? Str::limit($tipeTiket->keterangan, 30) : '-' }}</td>
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
                            <td colspan="4" class="text-center">Tidak ada tipe tiket tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="flex justify-center mt-6">
            {{ $tipeTikets->links() }}
        </div>
    </div>

@endsection
