<?php

namespace App\Http\Controllers\pasien;

use App\Http\Controllers\Controller;
use App\Models\DaftarPoli;
use App\Models\JadwalPeriksa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class DaftarPoliController extends Controller
{
    public function index(){
       $no_rm = Auth::user()->no_rm;
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
            ->whereDoesntHave('periksa') // tampilkan hanya yang belum diperiksa
            ->get();


    return view('pasien.daftarpoli.index', compact('dokters', 'riwayat'));

    }

     public function store(Request $request)
        {
            $request->validate([
                'id_jadwal' => 'required|exists:jadwalPeriksa,id',
                'keluhan' => 'required',
            ]);

            $jadwalPeriksa = JadwalPeriksa::findOrFail($request->id_jadwal);

            $jumlahDaftar = DaftarPoli::where('id_jadwal', $jadwalPeriksa->id)->count();
            $noAntrian = $jumlahDaftar + 1;

            DaftarPoli::create([
                'id_pasien' => Auth::user()->id,
                'id_jadwal' => $jadwalPeriksa->id,
                'keluhan' => $request->keluhan,
                'no_antrian' => $noAntrian,
            ]);

            return redirect()->route('pasien.daftarpoli.index')->with('status', 'Pendaftaran berhasil.');
        }


    public function destroy($id)
    {
        $daftarPoli = DaftarPoli::findOrFail($id);
        $daftarPoli->delete();

        return redirect()->back()->with('status', 'Data berhasil dihapus.');
    }
}
