@extends('layouts.app')

@section('content_header')
    <h1>Data Pemeriksaan</h1>
@endsection

@section('content')

    <table class="table table-bordered bg-light">
    <thead>
    <tr>
        <th>No</th>
        <th>Nama Pasien</th>
        <th>Nama Dokter</th>
        <th>Tanggal Periksa</th>
        <th>Catatan</th>
        <th>Biaya</th>
        <th>Obat</th> 
        <th>Status</th>
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
                        @if($item->obats && $item->obats->isNotEmpty())
                            @foreach($item->obats as $obat)
                                <span class="badge bg-info text-dark">{{ $obat->name_obat }}</span><br>
                            @endforeach
                        @else
                            <span>Tidak ada obat</span>
                        @endif
                    </td>
                    <td>
                    <!-- Menampilkan status -->
                    <span class="badge 
                        @if($item->status == 'menunggu') 
                            bg-warning text-dark 
                        @elseif($item->status == 'selesai') 
                            bg-success text-dark 
                        @endif">
                        {{ ucfirst($item->status) }}
                    </span>
                </td>
        </tr>
    @endforeach
</tbody>

    </table>
@endsection
