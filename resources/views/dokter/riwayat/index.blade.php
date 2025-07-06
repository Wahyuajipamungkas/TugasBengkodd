@extends('layouts.app')

@section('content_header')
    <h1 class="text-gray font-bold p-3">Data Pemeriksaan Pasien</h1>
@endsection

@section('content')
<div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
    <div class="p-4 bg-white shadow-sm sm:p-8 sm:rounded-lg">
    <table class="table mt-6 overflow-hidden rounded table-hover">
        <thead class="thead-light"> 
            <tr>
                <th class="text-center">No Atrian</th>
                <th class="text-center">Nama Pasien</th>
                <th class="text-center">Keluhan</th>
                <th class="text-center">Biaya Periksa</th>
                <th class="text-center">Obat</th>
                <th class="text-center">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($daftarpoli as $daftar)
                <tr>
                    <td class="align-middle text-center">{{ $daftar->no_antrian }}</td>
                    <td class="align-middle text-center">{{ $daftar->pasien->name }}</td>
                    <td class="align-middle text-center">{{ $daftar->keluhan }}</td>
                    <td class="align-middle text-center">
                        Rp {{ number_format($daftar->periksa->biaya_periksa ?? 0, 0, ',', '.') }}
                    </td>
                    <td class="align-middle text-center">
                        @if($daftar->periksa && $daftar->periksa->obats->isNotEmpty())
                            @foreach($daftar->periksa->obats as $obat)
                                <span class="badge bg-info text-dark">{{ $obat->name_obat }}</span><br>
                            @endforeach
                        @else
                            <span>Tidak ada obat</span>
                        @endif
                    </td>
                    <td class="align-middle text-center">
                        <span class="badge
                            @if(optional($daftar->periksa)->status == 'menunggu')
                                bg-danger text-dark
                            @elseif(optional($daftar->periksa)->status == 'selesai')
                                bg-success text-dark
                            @endif">
                            {{ ucfirst(optional($daftar->periksa)->status ?? '-') }}
                        </span>
                    </td>
                    {{-- <td>
                        @if ($daftar->periksa)
                            <a href="{{ route('dokter.periksa.edit', $daftar->periksa->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        @else
                            <a href="{{ route('dokter.periksa.create', $daftar->id) }}" class="btn btn-success btn-sm">Periksa</a>
                        @endif
                        @if ($daftar->periksa)
                            <form action="{{ route('dokter.periksa.destroy', $daftar->periksa->id) }}" method="POST" style="display:inline-block">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Yakin ingin menghapus data ini?')" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        @endif

                    </td> --}}
                </tr>
            @endforeach

        </tbody>
    </table>
    </div>
</div>
@endsection
