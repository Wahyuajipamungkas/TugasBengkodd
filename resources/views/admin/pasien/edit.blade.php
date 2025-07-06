@extends('layouts.app')

@section('content_header')
    <h1>Edit Pasien</h1>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.pasien.update', $pasien->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Nama Pasien</label>
                <input type="text" name="name" value="{{ old('name', $pasien->name) }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" value="{{ old('email', $pasien->email) }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" name="alamat" value="{{ old('alamat', $pasien->alamat) }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="no_hp">No HP</label>
                <input type="text" name="no_hp" value="{{ old('no_hp', $pasien->no_hp) }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="password">Password Baru (Opsional)</label>
                <input type="password" name="password" class="form-control" placeholder="Isi jika ingin ganti password">
            </div>

            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password baru">
            </div>

            <div class="d-flex justify-content-end" style="gap:10px;">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('admin.pasien.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection
