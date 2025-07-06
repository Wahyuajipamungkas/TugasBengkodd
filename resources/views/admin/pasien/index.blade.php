@extends('layouts.app')
{{-- Customize layout sections --}}
@section('subtitle', 'Admin')
@section('content_header_title', 'Pasien')
@section('content_body')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('admin.pasien.create') }}" class="btn btn-primary">Tambah Pasien</a>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-center">ID</th>
                        <th class="text-start">Nama Pasien</th>
                        <th class="text-start">Email</th>
                        <th class="text-start">Alamat</th>
                        <th class="text-start">No HP</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($pasiens as $index => $pasien)
                    <tr>
                        <td class="align-middle text-center">{{ $index + 1 }}</td>
                        <td class="align-middle text-start">{{ $pasien->name}}</td>
                        <td class="align-middle text-start">{{ $pasien->email}}</td>
                        <td class="align-middle text-start">{{ $pasien->alamat}}</td>
                        <td class="align-middle text-start">{{ $pasien->no_hp}}</td>
                        <td class="align-middle text-center">
                            <a href="{{ route('admin.pasien.edit', $pasien->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.pasien.destroy', $pasien->id) }}" method="POST" style="display:inline-block;">
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
