@extends('layouts.app')

@section('content_header')
    <h1>Tambah Pemeriksaan</h1>
@endsection

@section('content')
    <form action="{{ route('dokter.periksa.store') }}" method="POST">
        @csrf

        <input type="hidden" name="id_daftarpoli" value="{{ $daftarpoli->id }}">
        <input type="hidden" name="id_pasien" value="{{ $daftarpoli->id_pasien }}">
        <input type="hidden" name="id_dokter" value="{{ $daftarpoli->jadwalperiksa->id_dokter }}">

        <div class="form-group">
            <label>Pasien</label>
            <input type="text" class="form-control" value="{{ $daftarpoli->pasien->name }}" readonly>
        </div>

        <div class="form-group">
            <label>Dokter</label>
            <input type="text" class="form-control" value="{{ $daftarpoli->jadwalperiksa->dokter->name }}" readonly>
        </div>

        <div class="form-group">
            <label>Tanggal Periksa</label>
            <input type="datetime-local" name="tgl_periksa" class="form-control" required>
        </div>

    <div class="form-group">
       <label>Obat:</label><br>
            @foreach ($obats as $obat)
                <input type="checkbox" name="obat_id[]" value="{{ $obat->id }}"
                    {{ $obats->contains($obat->id)}} data-harga="{{ $obat->harga }}" onchange="hargaBiayaPeriksa()">
                {{ $obat->name_obat }} ({{ $obat->kemasan }}) - Rp{{ number_format($obat->harga) }}<br>
            @endforeach

    </div>


        <div class="form-group">
            <label>Catatan</label>
            <textarea name="catatan" class="form-control" rows="3"></textarea>
        </div>

        <div class="mb-3 form-group">
            <label for="biaya_periksa">Biaya Pemeriksaan(Rp)</label>
            <input type="text" class="rounded form-control" id="biaya_periksa" name="biaya_periksa" value="100000" readonly>
        </div>
        <input type="hidden" name="status" value="selesai">
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('dokter.periksa.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
     <script>
        function hargaBiayaPeriksa() {
            const biayaPemeriksaan = 100000;
            let totalBiaya = biayaPemeriksaan;

            // Ambil semua checkbox obat yang dicentang
            const obatCheckboxes = document.querySelectorAll('input[name="obat_id[]"]:checked');

            obatCheckboxes.forEach(function(checkbox) {
                const harga = parseInt(checkbox.getAttribute('data-harga')) || 0;
                totalBiaya += harga;
            });

            document.getElementById('biaya_periksa').value = totalBiaya;
        }
    </script>


@endsection
