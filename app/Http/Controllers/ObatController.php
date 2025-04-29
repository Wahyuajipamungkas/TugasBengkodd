<?php

namespace App\Http\Controllers;

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
        return view('dokter/obat.index', compact('obats'));
        
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dokter/obat.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_obat' => 'required',
            'kemasan' => 'required',
            'harga' => 'required',
        ]);
        
        // Create the new Obat record
        Obat::create($request->all());
        return redirect()->route('obat.index');
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
        return view('dokter.obat.edit', compact('obat'));
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
        $obat->delete();
        return redirect()->route('obat.index')->with('success', 'Data berhasil dihapus');
    }
    
}
