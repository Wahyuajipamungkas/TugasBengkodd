@extends('layouts.app')

@section('content_header')
    <h1>Tambah Pemeriksaan</h1>
@endsection

@section('content')
    <form action="{{ route('periksa.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Pasien</label>
            <select name="id_pasien" class="form-control" required>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Dokter</label>
            <select name="id_dokter" class="form-control" required>
                @foreach ($dokters as $dokter)
                    <option value="{{ $dokter->id }}">{{ $dokter->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Tanggal Periksa</label>
            <input type="datetime-local" name="tgl_periksa" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Catatan</label>
            <textarea name="catatan" class="form-control" rows="3"></textarea>
        </div>

        <div class="form-group">
            <label>Biaya Periksa</label>
            <input type="number" name="biaya_periksa" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('periksa.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
@endsection
