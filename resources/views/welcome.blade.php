@extends('layouts.abb')

@section('title', 'Welcome')

@section('content')
        <div class="text-center bg-white bg-opacity-50 px-4 py-4 rounded">
            <h2 class="mb-4">Selamat datang di Sistem Medis Plus</h2>
            <h5 class="mb-4">Sistem aplikasi untuk mendaftar antrian Periksa</h5>
            <p class="mb-4">Silakan login atau registrasi untuk melanjutkan.</p>

            <a href="{{ route('login') }}" class="btn btn-primary m-2">
                <i class="fas fa-sign-in-alt"></i> Login
            </a>
            <a href="{{ route('register') }}" class="btn btn-success m-2">
                <i class="fas fa-user-plus"></i> Register
            </a>
        </div>
@endsection
