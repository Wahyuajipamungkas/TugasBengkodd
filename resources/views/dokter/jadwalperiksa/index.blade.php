@extends('layouts.app')
{{-- Customize layout sections --}}
@section('subtitle', 'Dokter')
@section('content_header_title', 'Jadwal Periksa')
@section('content_body')
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow-sm sm:p-8 sm:rounded-lg">
                <div class="p-3 justify-end text-start">
                <a href="{{ route('dokter.jadwalperiksa.create') }}" class="btn btn-primary">Tambah Jadwal Periksa</a>
                </div>
            <table class="p-2 table mt-6 overflow-hidden rounded table-hover">
                <thead class="thead-light">
                    <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center">Hari</th>
                        <th class="text-center">Jam Mulai</th>
                        <th class="text-center">Jam Selesai</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $namaHari = [1 => 'Senin', 2=> 'selasa', 3=> 'rabu', 4=> 'kamis', 5=> 'jumat', 6=> 'sabtu', 7=>'minggu'];
                    @endphp
                @foreach($JadwalPeriksas as $jadwal)
                    <tr>
                        <td class="align-middle text-center">{{ $loop->iteration }}</td>
                        <td class="align-middle text-center">{{ $jadwal->hari ?? 'Tidak Diketahui' }}</td>
                        <td class="align-middle text-center">{{ $jadwal->jam_mulai}}</td>
                        <td class="align-middle text-center">{{ $jadwal->jam_selesai }}</td>
                        <td class="align-middle text-center">
                            @if ($jadwal->status)
                                <span class="badge badge-pill badge-success">Aktif</span>
                            @else
                                <span class="badge badge-pill badge-danger">Nonaktif</span>
                            @endif
                        </td class="align-middle text-center">
                        <td class="align-middle text-center">
    <div class="flex justify-center items-center gap-2">
        <form class="p-1" action="{{ route('dokter.jadwalperiksa.toggleStatus', $jadwal->id) }}" method="POST">
            @csrf
            @method('PATCH')
            @if ($jadwal->status)
                <button type="submit" class="btn btn-danger btn-sm">Nonaktif</button>
            @else
                <button type="submit" class="btn btn-success btn-sm">Aktif</button>
            @endif
        </form>

        <form class="p-1" action="{{ route('dokter.jadwalperiksa.destroy', $jadwal->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus jadwal ini?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-warning btn-sm">Hapus</button>
        </form>
    </div>
</td>

                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        </div>
    </div>
@endsection
