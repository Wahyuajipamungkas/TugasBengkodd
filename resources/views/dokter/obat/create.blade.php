@extends('layouts.app') 
@section('content_header')
    <h1>Tambah Obat</h1>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{route('dokter.obat.store')}}" method="POST">
                @csrf {{-- harus ada di form untuk proteksi, biar gaada anomali--}}
                <div class="form-group">
                    <label for="name">Nama obat</label>
                    <input type="text" name="name_obat" id="name" placeholder="Name obat" class="form-control" required>

                </div>
                <div class="form-group">
                    <label for="nama">Kemasan</label>
                    {{-- ambil template option di bawah ini di adminLTE nya https://jeroennoten.github.io/Laravel-AdminLTE/ -> components -> basic form components --}}
                    <x-adminlte-select name="kemasan">
                        <x-adminlte-options :options="['pill' => 'Pill', 'sachet' => 'Sachet', 'botol' => 'Botol']"
                            empty-option="Pilih kemasan"/>
                    </x-adminlte-select>
                </div>
                <div class="form-group">
                    <label for="nama">Harga</label>
                    <input type="number" name="harga" id="harga" placeholder="Harga obat" class="form-control" required>
                </div>
                <div class="wrappper d-flex justify-content-end" style="gap:10px;">
                    <button type="submit" class="btn btn-success">Tambah</button>
                    <a href="{{route('dokter.obat.index')}}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
@endsection
