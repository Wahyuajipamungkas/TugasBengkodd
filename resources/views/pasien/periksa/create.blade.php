@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Ajukan Permintaan Periksa</h2>

    <form action="{{ route('periksa.store.pasien') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="id_dokter" class="form-label">Pilih Dokter</label>
            <select name="id_dokter" id="id_dokter" class="form-select" required>
                <option value="">-- Pilih Dokter --</option>
                @foreach ($dokters as $dokter)
                    <option value="{{ $dokter->id }}">{{ $dokter->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="tgl_periksa" class="form-label">Tanggal Periksa</label>
            <input type="date" name="tgl_periksa" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="catatan" class="form-label">Catatan (opsional)</label>
            <textarea name="catatan" class="form-control" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-success">Kirim Permintaan</button>
    </form>
</div>
@endsection
