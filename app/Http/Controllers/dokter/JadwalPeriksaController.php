<?php

namespace App\Http\Controllers\dokter;

use App\Models\JadwalPeriksa;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JadwalPeriksaController extends Controller
{
    public function index()
    {
        $JadwalPeriksas = JadwalPeriksa::where('id_dokter', Auth::user()->id)->get();

        return view('dokter.jadwalperiksa.index')->with([
            'JadwalPeriksas' => $JadwalPeriksas,
        ]);
    }

    public function create()
    {
        return view('dokter.jadwalperiksa.create');
    }

    public function edit($id)
    {
        $jadwal_periksas = JadwalPeriksa::findOrFail($id);

        return view('dokter.jadwalperiksa.edit')->with([
            'jadwal_periksas' => $jadwal_periksas,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'hari' => 'required|string|max:200',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);



        JadwalPeriksa::create([
            'id_dokter' => auth()->user()->id,
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'status' => false, // atau false jika ingin nonaktif default
        ]);

        return redirect()->route('dokter.jadwalperiksa.index')->with('status', 'jadwal-created');
    }
    public function toggleStatus($id)
{
    $jadwal = JadwalPeriksa::findOrFail($id);

    if (!$jadwal->status) {
        // Hanya nonaktifkan jadwal lain milik dokter yang sama
        JadwalPeriksa::where('id', '!=', $id)
            ->where('id_dokter', $jadwal->id_dokter)
            ->update(['status' => false]);

        // Aktifkan jadwal ini
        $jadwal->status = true;
    } else {
        // Kalau status sekarang aktif, kita nonaktifkan
        $jadwal->status = false;
    }

    $jadwal->save();

    return redirect()->route('dokter.jadwalperiksa.index')->with('status', 'Status jadwal diperbarui.');
}




    public function destroy($id)
    {
        $jadwal = JadwalPeriksa::findOrFail($id);
        $jadwal->delete();

        return redirect()->route('dokter.jadwalperiksa.index')->with('status', 'jadwal-deleted');
    }
}
