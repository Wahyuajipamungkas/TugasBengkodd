@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Riwayat Permintaan Periksa</h2>

    {{-- Tombol Ajukan Periksa --}}
    @if (Auth::user()->role === 'pasien')
        <div class="mb-3">
        <a href="{{ route('periksa.create.pasien') }}" class="btn btn-primary">Ajukan Periksa</a>

        </div>
    @endif

    <table class="table">
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
