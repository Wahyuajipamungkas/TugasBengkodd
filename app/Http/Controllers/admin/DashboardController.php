<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Obat;
use App\Models\Poli;

class DashboardController extends Controller
{public function index()
{
    // Asumsinya role 'dokter' disimpan di kolom 'role'
    $jumlahDokter = User::where('role', 'dokter')->count();
    $junlahPasien = User::where('role', 'pasien')->count();
    $jumlahObat = Obat::count();
    $jumlahPoli = Poli::count();

    return view('dashboard.index', compact(
        'jumlahDokter',
        'jumlahPasien',
        'jumlahObat',
        'jumlahPoli'
    ));
}

}
