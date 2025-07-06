@extends('layouts.app') 
@section('content_header')
    <h1>Tambah Jadwal Periksa</h1>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{route('dokter.jadwalperiksa.store')}}" method="POST">
                @csrf {{-- harus ada di form untuk proteksi, biar gaada anomali--}}
                <div class="form-group">
                    <label for="name" class="block font-medium text-sm text-gray-700">Hari</label>
                    <select name="hari" id="hari">
                        <option value="">Pilih Hari</option>
                        @foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $hari)
                            <option value="{{$hari}}">{{$hari}}</option>               
                        @endforeach
                    </select>

                </div>
                <div class="mb-4 form-group">
                    <label for="jammulai">Jam Mulai</label>
                    {{-- ambil template option di bawah ini di adminLTE nya https://jeroennoten.github.io/Laravel-AdminLTE/ -> components -> basic form components --}}
                   <input type="time" id="jammulai" class="rounded form-control" name="jam_mulai">
                </div>
                   <div class="form-group">
                    <label for="jamselesai">Jam Selesai</label>
                    {{-- ambil template option di bawah ini di adminLTE nya https://jeroennoten.github.io/Laravel-AdminLTE/ -> components -> basic form components --}}
                   <input type="time" id="jamselesai" class="rounded form-control" name="jam_selesai">
                </div>
                <a type="button" href="{{ route('dokter.jadwalperiksa.index') }}" class="btn btn-secondary">
                                Batal
                </a>
                <button type="submit" class="btn btn-primary">
                Simpan
                </button>
            </form>
        </div>
    </div>
@endsection
