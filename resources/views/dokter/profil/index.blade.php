@extends('layouts.app')

@section('content_header')
    <h1 class="text-gray font-bold p-3">Profile</h1>
@endsection

@section('content')
<div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow-sm sm:p-8 sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Profile') }}
                            </h2>
                        </header>

                        <form class="mt-6" id="formObat" action="{{ route('dokter.profil.update') }}" method="POST">
                            @csrf

                            <div class="mb-3 form-group">
                                <label for="namedokter">Nama Dokter</label>
                                <input type="text" class="bg-gray-600 rounded form-control" id="namedokter" name="name" value="{{old('name',$dokter->name)}}" required>
                            </div>
                            <div class="mb-3 form-group">
                                <label for="email">Email</label>
                                <input type="text" class="rounded form-control" id="email" name="email" value="{{old('email',$dokter->email)}}" required>
                            </div>
                            <div class="mb-3 form-group">
                                <label for="alamat">Alamat</label>
                                <input type="text" class="rounded form-control" id="alamat" name="alamat" value="{{old('alamat',$dokter->alamat)}}" required>
                            </div>
                            <div class="mb-3 form-group">
                                <label for="nohp">No HP</label>
                                <input type="text" class="rounded form-control" id="nohp" name="no_hp" value="{{old('no_hp',$dokter->no_hp)}}" required>
                            </div>
                            <div class="mb-3">
                                <label for="id_poli">Poli</label>
                                <select name="id_poli" class="form-control" required>
                                    <option value="">-- Pilih Poli --</option>
                                    @foreach ($polis as $poli)
                                        <option value="{{ $poli->id }}" {{ $dokter->id_poli == $poli->id ? 'selected' : '' }}>
                                            {{ $poli->nama_poli }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3 form-group">
                                <label for="password">Password</label>
                                <input type="text" class="rounded form-control" id="password" name="password">
                            </div>
                             <div class="mb-3 form-group">
                                <label for="password">Konfirmasi Password</label>
                                <input type="text" class="rounded form-control" id="password" name="password_confirmation">
                            </div>

                            <button type="submit" class="btn btn-primary">
                                Update
                            </button>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection