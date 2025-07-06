<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Obat;
use Illuminate\Http\Request;

class AdminObatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $obats = Obat::all();
        return view('admin/obat.index', compact('obats'));

    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin/obat.create');
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

        return redirect()->route('obat.index')->with('success', 'Obat berhasil ditambahkan.');
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
    public function edit(Obat $obat)
    {
        return view('admin.obat.edit', compact('obat'));
    }

    public function update(Request $request, Obat $obat)
    {
        $request->validate([
            'name_obat' => 'required',
            'kemasan' => 'required',
            'harga' => 'required',
        ]);

        $obat->update($request->all());

        return redirect()->route('obat.index')->with('success', 'Data berhasil diperbarui');
    }

   public function destroy(Obat $obat)
{
    // Hapus relasi dulu (jika kamu ingin paksa hapus)
    $obat->detailPeriksas()->delete(); // ini hapus semua yang terkait

    // Baru hapus obat
    $obat->delete();

    return redirect()->route('obat.index')->with('success', 'Obat berhasil dihapus beserta data relasinya');
}


}
