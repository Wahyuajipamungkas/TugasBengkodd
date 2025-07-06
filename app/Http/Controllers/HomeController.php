<?php
namespace App\Http\Controllers;

use App\Models\DaftarPoli;
use App\Models\Obat;
use App\Models\Poli;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Periksa;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'pasien') {
            $periksas = Periksa::where('id_pasien', $user->id)->with('dokter', 'admin')->get();
            return view('pasien.index', compact('periksas'));
        } elseif ($user->role === 'dokter') {
             $user = Auth::user();
            $jumlahPeriksa = \App\Models\Periksa::whereHas('daftarpoli.jadwalperiksa', function ($query) use ($user) {
                $query->where('id_dokter', $user->id);
            })->count();
            $jumlahObat = Obat::count();
            $jumlahPoli = Poli::count();
            $periksas = Periksa::where('id_dokter', $user->id)->with('pasien', 'admin')->get();
            return view('dokter.index', compact('periksas',
            'jumlahPeriksa',
            'jumlahObat'));
        } elseif ($user->role === 'admin') {
             $jumlahDokter = User::where('role', 'dokter')->count();
            $jumlahPasien = User::where('role', 'pasien')->count();
            $jumlahObat = Obat::count();
            $jumlahPoli = Poli::count();
            $periksas = Periksa::with(['pasien', 'dokter', 'admin'])->get();
            return view('admin.index', compact(
        'jumlahDokter',
        'jumlahPasien',
        'periksas',
        'jumlahObat',
        'jumlahPoli'));
        } else {
            abort(403, 'Role tidak dikenali');
        }
    }

public function dokter()
{
    $user = Auth::user();
   $jumlahPeriksa = \App\Models\Periksa::whereHas('daftarpoli.jadwalperiksa', function ($query) use ($user) {
        $query->where('id_dokter', $user->id);
    })->count();

    $jumlahObat = Obat::count();
    $periksas = Periksa::with(['pasien', 'dokter', 'admin'])->get(); // Pastikan relasi 'pasien' & 'dokter' sudah benar
    return view('dokter.index', compact('periksas',
            'jumlahPeriksa',
            'jumlahObat'));
}

public function pasien()
{
    $periksas = Periksa::with(['pasien', 'dokter', 'admin'])->get(); // Pastikan relasi 'pasien' & 'dokter' sudah benar
    return view('pasien.index', compact('periksas'));
}

public function admin()
{
    $jumlahDokter = User::where('role', 'dokter')->count();
    $jumlahPasien = User::where('role', 'pasien')->count();
    $jumlahObat = Obat::count();
    $jumlahPoli = Poli::count();
    $periksas = Periksa::with(['pasien', 'dokter', 'admin'])->get(); // Pastikan relasi 'pasien' & 'dokter' sudah benar
    return view('admin.index', compact(
        'jumlahDokter',
        'jumlahPasien',
        'periksas',
        'jumlahObat',
        'jumlahPoli'));
}
}
