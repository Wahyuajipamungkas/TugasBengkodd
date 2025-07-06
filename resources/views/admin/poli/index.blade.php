@extends('layouts.app')
{{-- Customize layout sections --}}
@section('subtitle', 'Admin')
@section('content_header_title', 'Poli')
@section('content_body')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('admin.poli.create') }}" class="btn btn-primary">Tambah Poli</a>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-center">ID</th>
                        <th class="text-start">Nama Poli</th>
                        <th class="text-start">Deskripsi</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($polis as $index => $poli)
                    <tr>
                        <td class="align-middle text-center">{{ $index + 1 }}</td>
                        <td class="align-middle text-start">{{ $poli->nama_poli }}</td>
                        <td class="align-middle text-start">{{ $poli->deskripsi }}</td>
                        <td class="align-middle text-center">
                            <a href="{{ route('admin.poli.edit', $poli->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.poli.destroy', $poli->id) }}" method="POST" style="display:inline-block;">
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
