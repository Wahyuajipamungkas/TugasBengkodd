<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Periksa;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Hanya ambil periksa milik pasien yang login
        if ($user->role === 'pasien') {
            $periksas = Periksa::where('id_pasien', $user->id)->with('dokter')->get();
        } else {
            $periksas = []; // atau bisa juga Periksa::all() jika admin/dokter
        }

        return view('home', compact('periksas'));
    }

public function dokter()
{
    $periksas = Periksa::with(['pasien', 'dokter'])->get(); // Pastikan relasi 'pasien' & 'dokter' sudah benar
    return view('dokter.index', compact('periksas'));
}

public function pasien()
{
    $periksas = Periksa::with(['pasien', 'dokter'])->get(); // Pastikan relasi 'pasien' & 'dokter' sudah benar
    return view('pasien.index', compact('periksas'));
}

}
