@extends('layouts.app')

@section('content_header')
    <h1>Edit Obat</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('obat.update', $obat->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Nama Obat</label>
                    <input type="text" name="name_obat" value="{{ $obat->name_obat }}" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Kemasan</label>
                    <x-adminlte-select name="kemasan">
                        <x-adminlte-options :options="['pill' => 'Pill', 'sachet' => 'Sachet', 'botol' => 'Botol']"
                            :selected="$obat->kemasan" />
                    </x-adminlte-select>
                </div>
                <div class="form-group">
                    <label>Harga</label>
                    <input type="number" name="harga" value="{{ $obat->harga }}" class="form-control" required>
                </div>
                <div class="d-flex justify-content-end" style="gap:10px;">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('obat.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
@endsection
