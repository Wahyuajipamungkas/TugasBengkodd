<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController; 
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PeriksaController;
use App\Http\Controllers\ObatController;

// Default route ke login
Route::get('/', fn () => view('welcome'));

// Auth bawaan Laravel
Auth::routes();

// Home setelah login
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Route untuk role: dokter
Route::prefix('dokter')->middleware(['auth', 'role:dokter'])->group(function () {
    Route::get('/', [HomeController::class, 'dokter'])->name('dokter');

    // Obat & Periksa resource
    Route::resource('obat', ObatController::class);
    Route::resource('periksa', PeriksaController::class);

    // Custom route jika butuh form khusus dokter
    Route::get('periksa/create', [PeriksaController::class, 'createForDokter'])->name('dokter.periksa.create');
    Route::post('periksa', [PeriksaController::class, 'store'])->name('periksa.store');
    Route::post('periksa/{id}/selesai', [PeriksaController::class, 'selesaikan'])->name('periksa.selesai');
});

// Route untuk role: pasien
Route::prefix('pasien')->middleware(['auth', 'role:pasien'])->group(function () {
    Route::get('/', [HomeController::class, 'pasien'])->name('pasien');
    Route::get('/create', [PeriksaController::class, 'createForPasien'])->name('periksa.create.pasien');
    Route::post('/store', [PeriksaController::class, 'storeForPasien'])->name('periksa.store.pasien');
    Route::get('/riwayat', [PeriksaController::class, 'riwayatForPasien'])->name('pasien.riwayat.index');
});
