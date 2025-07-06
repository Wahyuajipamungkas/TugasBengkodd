@extends('layouts.app') 
@section('content_header')
    <h1>Tambah Dokter</h1>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{route('admin.dokter.store')}}" method="POST">
                @csrf {{-- harus ada di form untuk proteksi, biar gaada anomali--}}
                <div class="form-group">
                    <label for="name">Nama Dokter</label>
                    <input type="text" name="name_dokter" id="name" placeholder="Name Dokter" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="Email Dokter" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" name="alamat" id="alamat" placeholder="Alamat" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="no_hp">No HP</label>
                    <input type="number" name="no_hp" id="no_hp" placeholder="No Hp" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="poli">Poli</label>
                    {{-- ambil template option di bawah ini di adminLTE nya https://jeroennoten.github.io/Laravel-AdminLTE/ -> components -> basic form components --}}
                    <x-adminlte-select name="id_poli">
                    <x-adminlte-options 
                        :options="$polis->pluck('nama_poli', 'id')->toArray()" 
                        empty-option="Pilih Poli" />
                    </x-adminlte-select>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Password" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Konfirmasi Password" class="form-control" required>
                </div>

                <div class="wrappper d-flex justify-content-end" style="gap:10px;">
                    <button type="submit" class="btn btn-success">Tambah</button>
                    <a href="{{route('admin.dokter.index')}}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
@endsection
