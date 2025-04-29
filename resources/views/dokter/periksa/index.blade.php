@extends('layouts.app')

@section('content_header')
    <h1>Data Pemeriksaan</h1>
@endsection

@section('content')
    <a href="{{ route('dokter.periksa.create') }}" class="btn btn-success mb-3">Tambah Pemeriksaan</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Pasien</th>
                <th>Dokter</th>
                <th>Tanggal Periksa</th>
                <th>Catatan</th>
                <th>Biaya</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($periksas as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->pasien->name }}</td>
                    <td>{{ $item->dokter->name }}</td>
                    <td>{{ $item->tgl_periksa }}</td>
                    <td>{{ $item->catatan }}</td>
                    <td>Rp {{ number_format($item->biaya_periksa, 0, ',', '.') }}</td>
                    <td>
                        <a href="{{ route('periksa.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('periksa.destroy', $item->id) }}" method="POST" style="display:inline-block">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Yakin ingin menghapus data ini?')" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
