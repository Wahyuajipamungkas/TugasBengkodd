@extends('layouts.app')

@section('content_header')
    <h1>Edit Pemeriksaan</h1>
@endsection

@section('content')
    <form action="{{ route('periksa.update', $periksa->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Pasien</label>
            <select name="id_pasien" class="form-control" required>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ $periksa->id_pasien == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Dokter</label>
            <select name="id_dokter" class="form-control" required>
                @foreach ($dokters as $dokter)
                    <option value="{{ $dokter->id }}" {{ $periksa->id_dokter == $dokter->id ? 'selected' : '' }}>{{ $dokter->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Tambahkan daftar obat -->
    <label>Obat:</label><br>
    @foreach ($obats as $obat)
        <input type="checkbox" name="obat_id[]" value="{{ $obat->id }}"
            {{ $periksa->obats->contains($obat->id) ? 'checked' : '' }}>
        {{ $obat->name_obat }} ({{ $obat->kemasan }}) - Rp{{ number_format($obat->harga) }}<br>
    @endforeach

    <!-- Tambahkan status -->
    <label>Status:</label>
    <select name="status" class="form-select">
        <option value="menunggu" {{ $periksa->status == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
        <option value="selesai" {{ $periksa->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
    </select>

    <button type="submit">Simpan</button>

        <div class="form-group">
            <label>Tanggal Periksa</label>
            <input type="datetime-local" name="tgl_periksa" value="{{ \Carbon\Carbon::parse($periksa->tgl_periksa)->format('Y-m-d\TH:i') }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Catatan</label>
            <textarea name="catatan" class="form-control" rows="3">{{ $periksa->catatan }}</textarea>
        </div>

        <div class="form-group">
            <label>Biaya Periksa</label>
            <input type="number" name="biaya_periksa" value="{{ $periksa->biaya_periksa }}" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('periksa.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
@endsection
