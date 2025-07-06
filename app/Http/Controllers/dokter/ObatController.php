<?php

namespace App\Http\Controllers\dokter;

use App\Http\Controllers\Controller;
use App\Models\Obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $obats = Obat::all();
        return view('dokter.obat.index', compact('obats'));

    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dokter.obat.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'name_obat' => 'required|string|max:255',
        'kemasan' => 'required|string',
        'harga' => 'required|numeric|min:0',
    ]);

    Obat::create([
        'name_obat' => $request->name_obat,
        'kemasan' => $request->kemasan,
        'harga' => $request->harga,
    ]);

    return redirect()->route('dokter.obat.index')->with('success', 'Obat berhasil ditambahkan.');
}



    /**
     * Display the specified resource.
     */
    public function show(Obat $obat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $obat = Obat::findOrFail($id);

        return view('dokter.obat.edit')->with([
            'obat' => $obat
        ]);
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'name_obat' => 'required',
            'kemasan' => 'required',
            'harga' => 'required',
        ]);

        $obat = Obat::findOrFail($id);

        $obat->update($request->all());

        return redirect()->route('dokter.obat.index')->with('success', 'Data berhasil diperbarui');
    }

   public function destroy(Obat $obat)
{
    // Hapus relasi dulu (jika kamu ingin paksa hapus)
    $obat->detailPeriksas()->delete(); // ini hapus semua yang terkait

    // Baru hapus obat
    $obat->delete();

    return redirect()->route('dokter.obat.index')->with('success', 'Obat berhasil dihapus beserta data relasinya');
}


}
