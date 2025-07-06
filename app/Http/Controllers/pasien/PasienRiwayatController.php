<?php

namespace App\Http\Controllers\pasien;

use App\Http\Controllers\Controller;
use App\Models\DaftarPoli;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class PasienRiwayatController extends Controller
{
    public function index(){
        $dokters = User::with([
            'poli',
            'jadwalPeriksa' => function ($query) {
                $query->where('status', true);
            },
        ])
            ->where('role', 'dokter')
            ->get();

       $riwayat = DaftarPoli::with(['jadwalperiksa.dokter.poli', 'periksa'])
            ->where('id_pasien', Auth::id())
            ->whereHas('periksa') 
            ->get();


    return view('pasien.riwayat.index', compact('dokters', 'riwayat'));

    }
}
