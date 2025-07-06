<?php

use App\Http\Controllers\dokter\RiwayatController;
use App\Http\Controllers\admin\DokterController;
use App\Http\Controllers\pasien\PasienRiwayatController;
use App\Http\Controllers\pasien\DaftarPoliController;
use App\Http\Controllers\dokter\JadwalPeriksaController;
use App\Http\Controllers\dokter\ProfilController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\dokter\PeriksaController;
use App\Http\Controllers\dokter\ObatController;
use App\Http\Controllers\admin\AdminObatController;
use App\Http\Controllers\admin\PasienController;
use App\Http\Controllers\admin\PoliController;

// Default route ke login
Route::get('/', fn () => view('welcome'));

// Auth bawaan Laravel
Auth::routes();

// Home setelah login
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Route untuk role: dokter
Route::prefix('dokter')->middleware(['auth', 'role:dokter'])->group(function () {
    Route::get('/', [HomeController::class, 'dokter'])->name('dokter');
    Route::prefix('profil')->group(function(){
        Route::get('/', [ProfilController::class, 'index'])->name('dokter.profil.index');
        Route::post('/update', [ProfilController::class, 'update'])->name('dokter.profil.update');
    });

    // Obat & Periksa resource
     Route::prefix('obat')->group(function(){
        Route::get('/',[ObatController::class, 'index'])->name('dokter.obat.index');
        Route::get('/create',[ObatController::class, 'create'])->name('dokter.obat.create');
        Route::get('/{id}/edit',[ObatController::class, 'edit'])->name('dokter.obat.edit');
        Route::put('/{id}/update',[ObatController::class, 'update'])->name('dokter.obat.update');
        Route::post('/', [ObatController::class, 'store'])->name('dokter.obat.store');
        Route::delete('/obat/{id}', [ObatController::class, 'destroy'])->name('dokter.obat.destroy');
    });

    Route::prefix('jadwalperiksa')->group(function(){
        Route::get('/',[JadwalPeriksaController::class, 'index'])->name('dokter.jadwalperiksa.index');
        Route::get('/create',[JadwalPeriksaController::class, 'create'])->name('dokter.jadwalperiksa.create');
        Route::patch('/jadwal_periksa/{id}/toggle_status', [JadwalPeriksaController::class, 'toggleStatus'])->name('dokter.jadwalperiksa.toggleStatus');
        Route::post('/', [JadwalPeriksaController::class, 'store'])->name('dokter.jadwalperiksa.store');
        Route::delete('/jadwal_periksa/{id}', [JadwalPeriksaController::class, 'destroy'])->name('dokter.jadwalperiksa.destroy');
    });

    Route::prefix('periksa')->group(function(){
        Route::get('/', [PeriksaController::class, 'index'])->name('dokter.periksa.index');
        Route::get('/{id}/create', [PeriksaController::class, 'create'])->name('dokter.periksa.create');
        Route::post('/', [PeriksaController::class, 'store'])->name('dokter.periksa.store');
        Route::delete('/{id}', [PeriksaController::class, 'destroy'])->name('dokter.periksa.destroy');
        Route::get('/{id}/edit',[PeriksaController::class, 'edit'])->name('dokter.periksa.edit');
        Route::put('/{id}/update',[PeriksaController::class, 'update'])->name('dokter.periksa.update');
    });
    Route::get('/riwayat', [RiwayatController::class, 'index'])->name('dokter.riwayat.index');
    // Custom route jika butuh form khusus dokter

});

// Route untuk role: pasien
Route::prefix('pasien')->middleware(['auth', 'role:pasien'])->group(function () {
    Route::get('/', [HomeController::class, 'pasien'])->name('pasien');
    // Route::get('/create', [PeriksaController::class, 'createForPasien'])->name('periksa.create.pasien');
    // Route::post('/store', [PeriksaController::class, 'storeForPasien'])->name('periksa.store.pasien');
    Route::get('/riwayat', [PasienRiwayatController::class, 'index'])->name('pasien.riwayat.index');
    Route::prefix('daftarpoli')->group(function(){
        Route::get('/', [DaftarPoliController::class, 'index'])->name('pasien.daftarpoli.index');
        Route::post('/', [DaftarPoliController::class, 'store'])->name('pasien.daftarpoli.store');
        Route::delete('/{id}', [DaftarPoliController::class, 'destroy'])->name('pasien.daftarpoli.destroy');
    });
});

Route::prefix('admin')->middleware(['auth','role:admin'])->group(function (){
    Route::get('/', [HomeController::class, 'admin'])->name('admin');
    Route::resource('obat', AdminObatController::class);
    Route::prefix('dokter')->group(function(){
        Route::get('/',[DokterController::class, 'index'])->name('admin.dokter.index');
        Route::get('/create',[DokterController::class, 'create'])->name('admin.dokter.create');
        Route::get('/{id}/edit}',[DokterController::class, 'edit'])->name('admin.dokter.edit');
        Route::put('/{id}/update}',[DokterController::class, 'update'])->name('admin.dokter.update');
        Route::post('/', [DokterController::class, 'store'])->name('admin.dokter.store');
        Route::delete('/hapus/{id}', [DokterController::class, 'destroy'])->name('admin.dokter.destroy');
    });
    Route::prefix('pasien')->group(function(){
        Route::get('/',[PasienController::class, 'index'])->name('admin.pasien.index');
        Route::get('/create',[PasienController::class, 'create'])->name('admin.pasien.create');
        Route::get('/{id}/edit}',[PasienController::class, 'edit'])->name('admin.pasien.edit');
        Route::put('/{id}/update}',[PasienController::class, 'update'])->name('admin.pasien.update');
        Route::post('/', [PasienController::class, 'store'])->name('admin.pasien.store');
        Route::delete('/hapus/{id}', [PasienController::class, 'destroy'])->name('admin.pasien.destroy');
    });

    Route::prefix('poli')->group(function(){
        Route::get('/',[PoliController::class, 'index'])->name('admin.poli.index');
        Route::get('/create',[PoliController::class, 'create'])->name('admin.poli.create');
        Route::get('/{id}/edit}',[PoliController::class, 'edit'])->name('admin.poli.edit');
        Route::put('/{id}/update}',[PoliController::class, 'update'])->name('admin.poli.update');
        Route::post('/', [PoliController::class, 'store'])->name('admin.poli.store');
        Route::delete('/hapus/{id}', [PoliController::class, 'destroy'])->name('admin.poli.destroy');
    });

});
