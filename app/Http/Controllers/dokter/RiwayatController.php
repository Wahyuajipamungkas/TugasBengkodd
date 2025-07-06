<?php

namespace App\Http\Controllers\dokter;

use App\Http\Controllers\Controller;
use App\Models\DaftarPoli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatController extends Controller
{
     public function index()
    {
        $dokterId = Auth::user()->id;

        $daftarpoli = DaftarPoli::whereHas('jadwalperiksa', function ($query) use ($dokterId) {
                $query->where('id_dokter', $dokterId);
            })
            ->whereHas('periksa')
            ->with(['pasien', 'periksa.obats', 'jadwalperiksa']) // Include jadwal kalau perlu
            ->get();

        return view('dokter.periksa.index', compact('daftarpoli'));
    }

}
