<?php


namespace App\Http\Controllers\dokter;
use App\Http\Controllers\Controller;
use App\Models\DaftarPoli;
use App\Models\Obat;
use App\Models\Periksa;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // pastikan ini ada di atas


class PeriksaController extends Controller
{


   public function create($id)
    {
        $daftarpoli = DaftarPoli::with(['pasien', 'jadwalperiksa.dokter'])->findOrFail($id);
        $obats = Obat::all();

        return view('dokter.periksa.create', compact('daftarpoli', 'obats'));
    }



   public function store(Request $request)
    {
        $validated = $request->validate([
            'id_daftarpoli' => 'required|exists:daftarpoli,id',
            'tgl_periksa' => 'required|date',
            'catatan' => 'nullable|string',
            'biaya_periksa' => 'required|numeric',
            // 'status' => 'required|in:menunggu,selesai',
             'obat_id' => 'nullable|array',
        ]);

        $periksa = Periksa::create([
            'id_daftarpoli' => $validated['id_daftarpoli'],
            'tgl_periksa' => $validated['tgl_periksa'],
            'catatan' => $validated['catatan'] ?? null,
            'biaya_periksa' => $validated['biaya_periksa'],
            'status' => 'selesai'
        ]);

        $periksa->obats()->sync($request->obat_id);

        return redirect()->route('dokter.periksa.index')->with('success', 'Data periksa berhasil disimpan.');
    }
    // Tambahan jika ingin menampilkan daftar untuk dokter
    public function index()
    {
        $dokterId = Auth::user()->id;

        $daftarpoli = DaftarPoli::whereHas('jadwalperiksa', function ($query) use ($dokterId) {
                $query->where('id_dokter', $dokterId);
            })
            ->with(['pasien', 'periksa.obats', 'jadwalperiksa']) // Include jadwal kalau perlu
            ->get();

        return view('dokter.periksa.index', compact('daftarpoli'));
    }



    public function edit($id)
    {
        $periksa = Periksa::with('obats')->findOrFail($id); // cukup sekali
        $users = User::where('role', 'pasien')->get();
        $dokters = User::where('role', 'dokter')->get();
        $obats = Obat::all();

        return view('dokter.periksa.edit', compact('periksa', 'users', 'dokters', 'obats'));
    }


    /**
     * Update data periksa oleh dokter.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_pasien' => 'required',
            'id_dokter' => 'required',
            'tgl_periksa' => 'required|date',
            'catatan' => 'nullable|string',
            'biaya_periksa' => 'nullable|numeric',
            //  'status' => 'required|in:menunggu,selesai',
        ]);

        $periksa = Periksa::findOrFail($id);

        $periksa->update([
            'id_pasien' => $request->id_pasien,
            'id_dokter' => $request->id_dokter,
            'tgl_periksa' => $request->tgl_periksa,
            'catatan' => $request->catatan,
            'biaya_periksa' => $request->biaya_periksa,
            'status' => 'selesai',
        ]);

        // Sinkronkan obat yang dipilih
        $periksa->obats()->sync($request->obat_id ?? []);

        return redirect()->route('dokter.periksa.index')->with('success', 'Data pemeriksaan berhasil diperbarui.');
    }

    /**
     * Hapus data pemeriksaan.
     */
    public function destroy($id)
    {
        $periksa = Periksa::findOrFail($id);
        $periksa->delete();

        return redirect()->route('dokter.periksa.index')->with('success', 'Data pemeriksaan berhasil dihapus.');
    }
    public function selesaikan($id)
    {
    $periksa = Periksa::findOrFail($id);
    $periksa->status = 'selesai';
    $periksa->save();

    return redirect()->route('dokter.periksa.index')->with('success', 'Pemeriksaan telah diselesaikan.');
    }


}



