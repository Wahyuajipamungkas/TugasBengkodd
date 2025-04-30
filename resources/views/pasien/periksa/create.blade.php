@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="font-bold text-2xl">Ajukan Permintaan Periksa</h2>

    <form action="{{ route('periksa.store.pasien') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="id_dokter" class="form-label">Pilih Dokter</label>
            <select name="id_dokter" id="id_dokter" class="form-select" required>
                <option value="" class="px-4 py-2 rounded-b-lg">-- Pilih Dokter --</option>
                @foreach ($dokters as $dokter)
                    <option value="{{ $dokter->id }}">{{ $dokter->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="tgl_periksa" class="form-label">Tanggal Periksa</label>
            <input type="date" name="tgl_periksa" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="catatan" class="form-label">Catatan (opsional)</label>
            <textarea name="catatan" class="form-control" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-success">Kirim Permintaan</button>
    </form>
    <table class="table p-2 bg-white">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Dokter</th>
                <th>Catatan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($periksas as $periksa)
                <tr>
                    <td>{{ $periksa->tgl_periksa }}</td>
                    <td>{{ $periksa->dokter->name }}</td>
                    <td>{{ $periksa->catatan }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">Belum ada permintaan periksa.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
