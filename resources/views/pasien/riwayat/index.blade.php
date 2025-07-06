@extends('layouts.app')

@section('content_header')
    <h1>Data Pemeriksaan</h1>
@endsection

@section('content')

    <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
        <div class="p-4 bg-white shadow-sm sm:p-8 sm:rounded-lg">
    <table class="table mt-6 overflow-hidden rounded table-hover">
    <thead class="thead-light">
    <tr>
        <th scope="col">No</th>
        <th scope="col">Nama Dokter</th>
        <th scope="col">No Antrian</th>
        <th scope="col">Tanggal Periksa</th>
        <th scope="col">Catatan</th>
        <th scope="col">Biaya</th>
        <th scope="col">Obat</th> 
        <th scope="col">Status</th>
    </tr>
</thead>
<tbody>
    @foreach ($riwayat as $riwayats)
        <tr>
            <td scope="row" class="align-middle text-start">{{ $loop->iteration }}</td>
            <td class="align-middle text-start">{{ $riwayats->jadwalPeriksa->dokter->name }}</td>
            <td class="align-middle text-start">{{$riwayats->no_antrian}}</td>
            <td class="align-middle text-start">{{ $riwayats->periksa->tgl_periksa }}</td>
            <td class="align-middle text-start">{{ $riwayats->periksa->catatan}}</td>
            <td class="align-middle text-start">Rp {{ number_format($riwayats->periksa->biaya_periksa, 0, ',', '.') }}</td>
            <td class="align-middle text-start">
                        @if($riwayats->periksa && $riwayats->periksa->obats->isNotEmpty())
                            @foreach($riwayats->periksa->obats as $obat)
                                <span class="badge bg-info text-dark">{{ $obat->name_obat }}</span><br>
                            @endforeach
                        @else
                            <span>Tidak ada obat</span>
                        @endif
                    </td>
                   <td class="align-middle text-start">
                        <span class="badge
                            @if(optional($riwayats->periksa)->status == 'menunggu')
                                bg-danger text-dark
                            @elseif(optional($riwayats->periksa)->status == 'selesai')
                                bg-success text-dark
                            @endif">
                            {{ ucfirst(optional($riwayats->periksa)->status ?? '-') }}
                        </span>
                    </td>
        </tr>
    @endforeach
</tbody>

    </table>
    </div>
    </div>
@endsection
