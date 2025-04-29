@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4 max-w-xl">
    <h1 class="text-2xl font-bold mb-4">Edit Pemeriksaan</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('periksa.update', $periksa->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label for="id_pasien" class="block font-medium">Pasien</label>
            <select name="id_pasien" id="id_pasien" class="w-full border px-3 py-2 rounded">
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $periksa->id_pasien == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="id_dokter" class="block font-medium">Dokter</label>
            <select name="id_dokter" id="id_dokter" class="w-full border px-3 py-2 rounded">
                @foreach($dokters as $dokter)
                    <option value="{{ $dokter->id }}" {{ $periksa->id_dokter == $dokter->id ? 'selected' : '' }}>
                        {{ $dokter->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="tgl_periksa" class="block font-medium">Tanggal Pemeriksaan</label>
            <input type="date" name="tgl_periksa" id="tgl_periksa" class="w-full border px-3 py-2 rounded"
                value="{{ old('tgl_periksa', $periksa->tgl_periksa) }}">
        </div>

        <div>
            <label for="catatan" class="block font-medium">Catatan</label>
            <textarea name="catatan" id="catatan" class="w-full border px-3 py-2 rounded" rows="3">{{ old('catatan', $periksa->catatan) }}</textarea>
        </div>

        <div>
            <label for="biaya_periksa" class="block font-medium">Biaya Pemeriksaan (Rp)</label>
            <input type="number" name="biaya_periksa" id="biaya_periksa" class="w-full border px-3 py-2 rounded"
                value="{{ old('biaya_periksa', $periksa->biaya_periksa) }}">
        </div>

        <div class="flex justify-between">
            <a href="{{ route('periksa.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">Batal</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Simpan</button>
        </div>
    </form>
</div>
@endsection
