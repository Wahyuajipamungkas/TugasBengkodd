<?php


namespace App\Http\Controllers;
use App\Models\Obat;
use App\Models\Periksa;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // pastikan ini ada di atas


class PeriksaController extends Controller
{
    public function createForDokter()
    {
        $users = User::where('role', 'pasien')->get();
        $dokters = User::where('role', 'dokter')->get();
        return view('dokter.periksa.create', compact('users', 'dokters'));
    }

    public function create()
    {
        $users = User::where('role', 'pasien')->get();
        $dokters = User::where('role', 'dokter')->get();
        return view('dokter.periksa.create', compact('users', 'dokters'));
    }

    public function store(Request $request)
{
    // Validasi input
    $validated = $request->validate([
        'id_pasien' => 'required',
        'id_dokter' => 'required',
        'tgl_periksa' => 'required|date',
        'catatan' => 'nullable|string',
        'biaya_periksa' => 'required|numeric',
    ]);

    // Simpan data
    Periksa::create($validated);

    return redirect()->route('periksa.index')->with('success', 'Data periksa berhasil disimpan.');
}


    public function storeForDokter(Request $request)
    {
        $request->validate([
            'id_pasien' => 'required',
            'id_dokter' => 'required',
            'tgl_periksa' => 'required|date',
            'catatan' => 'nullable|string',
            'biaya_periksa' => 'nullable|numeric',
        ]);

        Periksa::create($request->only([
            'id_pasien', 'id_dokter', 'tgl_periksa', 'catatan', 'biaya_periksa'
        ]));

        return redirect()->route('periksa.index');
    }

    public function createForPasien()
    {
        if (auth()->user()->role !== 'pasien') {
            return redirect()->route('home')->with('error', 'Akses ditolak');
        }

        $dokters = User::where('role', 'dokter')->get();
        return view('pasien.periksa.create', compact('dokters'));
    }

    public function storeForPasien(Request $request)
    {
        $request->validate([
            'id_dokter' => 'required',
            'tgl_periksa' => 'required|date',
            'catatan' => 'nullable|string',
        ]);

        Periksa::create([
            'id_pasien' => auth()->user()->id,
            'id_dokter' => $request->id_dokter,
            'tgl_periksa' => $request->tgl_periksa,
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('home')->with('success', 'Permintaan pemeriksaan berhasil dikirim.');
    }

    // Tambahan jika ingin menampilkan daftar untuk dokter
    public function index()
    {
        $periksas = Periksa::with(['pasien', 'dokter'])->get();
         $periksas = Periksa::with('user')->orderBy('status')->get();
        return view('dokter.periksa.index', compact('periksas'));
    }

    public function edit($id)
    {
        $periksa = Periksa::findOrFail($id);
        $users = User::where('role', 'pasien')->get();
        $dokters = User::where('role', 'dokter')->get();
        $periksa = Periksa::with('obats')->findOrFail($id);
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
        ]);

        $periksa = Periksa::findOrFail($id);
        $periksa->update([
            'id_pasien' => $request->id_pasien,
            'id_dokter' => $request->id_dokter,
            'tgl_periksa' => $request->tgl_periksa,
            'catatan' => $request->catatan,
            'biaya_periksa' => $request->biaya_periksa,
        ]);
         $periksa = Periksa::findOrFail($id);
        $periksa->status = $request->status;
        $periksa->save();

    // Sinkronkan obat yang dipilih
    $periksa->obats()->sync($request->obat_id ?? []);

        return redirect()->route('periksa.index')->with('success', 'Data pemeriksaan berhasil diperbarui.');
    }

    /**
     * Hapus data pemeriksaan.
     */
    public function destroy($id)
    {
        $periksa = Periksa::findOrFail($id);
        $periksa->delete();

        return redirect()->route('periksa.index')->with('success', 'Data pemeriksaan berhasil dihapus.');
    }
    public function selesaikan($id)
    {
    $periksa = Periksa::findOrFail($id);
    $periksa->status = 'selesai';
    $periksa->save();

    return redirect()->route('periksa.index')->with('success', 'Pemeriksaan telah diselesaikan.');
    }


}



 