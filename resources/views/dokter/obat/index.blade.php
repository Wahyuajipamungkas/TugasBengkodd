@extends('layouts.app')
{{-- Customize layout sections --}}
@section('subtitle', 'Dokter')
@section('content_header_title', 'Obat')
@section('content_body')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('obat.create') }}" class="btn btn-primary">Tambah Obat</a>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Obat</th>
                        <th>Kemasan</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($obats as $index => $obat)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $obat->name_obat }}</td>
                        <td>{{ $obat->kemasan }}</td>
                        <td>{{ $obat->harga }}</td>
                        <td>
                            <a href="{{ route('obat.edit', $obat->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('obat.destroy', $obat->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin ingin menghapus?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
