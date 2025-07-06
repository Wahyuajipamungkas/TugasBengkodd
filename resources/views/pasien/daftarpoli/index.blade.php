@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="font-bold text-2xl">Ajukan Permintaan Periksa</h2>

    <form action="{{ route('pasien.daftarpoli.store') }}" method="POST">
        @csrf

        <div class="mb-3">
           <label for="dokterSelect">Dokter</label>
                                <select class="form-control" name="id_jadwal" id="jadwalSelect" required>
                                    <option>Pilih Jadwal</option>
                                    @foreach ($dokters as $dokter)
                                        @foreach ($dokter->jadwalPeriksa as $jadwal)
                                            <option value="{{ $jadwal->id }}">
                                                Dr. {{ $dokter->name }} - Spesialis {{ $dokter->poli->nama_poli ?? '-' }} |
                                                {{ $jadwal->hari }},
                                                {{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H.i') }} -
                                                {{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H.i') }}
                                            </option>
                                        @endforeach
                                    @endforeach
                                </select>

        </div>

        <div class="mb-3">
            <label for="keluhan" class="form-label">keluhan</label>
            <textarea name="keluhan" class="form-control" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-success">Kirim Permintaan</button>
    </form>
    <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
    <div class="p-4 container mt-4 bg-white shadow-sm sm:p-8 sm:rounded-2xl">
    <h4>Riwayat Daftar Poli (Belum Diperiksa)</h4>
    <table class="p-4 table mt-6 overflow-hidden rounded table-hover">
        <thead class="thead-light">
            <tr>
                <th scope="col">No.</th>
                <th scope="col">Dokter</th>
                <th scope="col">Poli</th>
                <th scope="col">Hari</th>
                <th scope="col">Jam</th>
                <th scope="col">No Antrian</th>
                <th scope="col">Keluhan</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($riwayat as $index => $item)
                <tr>
                    <td scope="row" class="align-middle text-start">{{ $index + 1 }}</td>
                    <td class="align-middle text-start">{{ $item->jadwalperiksa->dokter->name ?? '-' }}</td>
                    <td class="align-middle text-start">{{ $item->jadwalperiksa->dokter->poli->nama_poli ?? '-' }}</td>
                    <td class="align-middle text-start">{{ $item->jadwalperiksa->hari ?? '-' }}</td>
                    <td class="align-middle text-start">
                        {{ \Carbon\Carbon::parse($item->jadwalperiksa->jam_mulai)->format('H.i') }} -
                        {{ \Carbon\Carbon::parse($item->jadwalperiksa->jam_selesai)->format('H.i') }}
                    </td class="align-middle text-start">
                    <td class="align-middle text-start">{{ $item->no_antrian }}</td>
                    <td class="align-middle text-start">{{ $item->keluhan }}</td>
                    <td class="align-middle text-start">
                        <form action="{{ route('pasien.daftarpoli.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Belum ada riwayat pendaftaran yang menunggu pemeriksaan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
</div>
</div>
@endsection
