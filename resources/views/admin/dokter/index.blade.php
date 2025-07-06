@extends('layouts.app')
{{-- Customize layout sections --}}
@section('subtitle', 'Admin')
@section('content_header_title', 'Dokter')
@section('content_body')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('admin.dokter.create') }}" class="btn btn-primary">Tambah Dokter</a>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-center">ID</th>
                        <th class="text-start">Nama Dokter</th>
                        <th class="text-start">Email</th>
                        <th class="text-start">Alamat</th>
                        <th class="text-start">No HP</th>
                        <th class="text-start">Role</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($dokters as $index => $dokter)
                    <tr>
                        <td class="align-middle text-center">{{ $index + 1 }}</td>
                        <td class="align-middle text-start">{{ $dokter->name}}</td>
                        <td class="align-middle text-start">{{ $dokter->email}}</td>
                        <td class="align-middle text-start">{{ $dokter->alamat}}</td>
                        <td class="align-middle text-start">{{ $dokter->no_hp}}</td>
                        <td class="align-middle text-start">{{ $dokter->poli->nama_poli}}</td>
                        <td class="align-middle text-center">
                            <a href="{{ route('admin.dokter.edit', $dokter->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.dokter.destroy', $dokter->id) }}" method="POST" style="display:inline-block;">
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
