@extends('layouts.app')

@section('content_header')
    <h1>Edit Poli</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.poli.update', $poli->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Nama Poli</label>
                    <input type="text" name="nama_poli" value="{{ $poli->nama_poli }}" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Desjripsi</label>
                    <input type="text" name="deskripsi" value="{{ $poli->deskripsi}}" class="form-control" required>
                </div>
                <div class="d-flex justify-content-end" style="gap:10px;">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('admin.poli.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
@endsection
