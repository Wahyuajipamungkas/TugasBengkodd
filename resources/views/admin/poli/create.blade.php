@extends('layouts.app') 
@section('content_header')
    <h1>Tambah Poli</h1>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{route('admin.poli.store')}}" method="POST">
                @csrf {{-- harus ada di form untuk proteksi, biar gaada anomali--}}
                <div class="form-group">
                    <label for="name">Nama Poli</label>
                    <input type="text" name="nama_poli" id="name" placeholder="Name Poli" class="form-control" required>

                </div>
                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <input type="text" name="deskripsi" id="deskripsi" placeholder="Deskripsi" class="form-control" required>
                </div>
                <div class="wrappper d-flex justify-content-end" style="gap:10px;">
                    <button type="submit" class="btn btn-success">Tambah</button>
                    <a href="{{route('admin.poli.index')}}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
@endsection
