@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Daftar Pemeriksaan</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="min-w-full bg-white border rounded shadow">
        <thead class="bg-gray-100">
            <tr>
                <th class="py-2 px-4 border">Pasien</th>
                <th class="py-2 px-4 border">Dokter</th>
                <th class="py-2 px-4 border">Tanggal</th>
                <th class="py-2 px-4 border">Catatan</th>
                <th class="py-2 px-4 border">Biaya Periksa</th>
                <th class="py-2 px-4 border">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($periksas as $periksa)
            <tr class="border-t">
                <td class="py-2 px-4 border">{{ $periksa->pasien->name ?? '-' }}</td>
                <td class="py-2 px-4 border">{{ $periksa->dokter->name ?? '-' }}</td>
                <td class="py-2 px-4 border">{{ $periksa->tgl_periksa }}</td>
                <td class="py-2 px-4 border">{{ $periksa->catatan ?? '-' }}</td>
                <td class="py-2 px-4 border">Rp {{ number_format($periksa->biaya_periksa ?? 0, 0, ',', '.') }}</td>
                <td class="py-2 px-4 border flex gap-2">
                    <a href="{{ route('periksa.edit', $periksa->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">Edit</a>
                    
                    <form action="{{ route('periksa.destroy', $periksa->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">Hapus</button>
                    </form>

                    <form action="{{ route('periksa.selesai', $periksa->id) }}" method="POST" onsubmit="return confirm('Tandai sebagai selesai?')">
                        @csrf
                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-sm">Selesai</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
