<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Poli;
use Illuminate\Http\Request;

class PoliController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $polis = Poli::all();
        return view('admin.poli.index', compact('polis'));

    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.poli.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_poli' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        Poli::create([
            'nama_poli' => $request->nama_poli,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('admin.poli.index')->with('success', 'Poli berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
     public function edit($id)
    {
        $poli = Poli::findOrFail($id);

        return view('admin.poli.edit')->with([
            'poli' => $poli
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_poli' => 'required',
            'deskripsi' => 'required',
        ]);

        $poli = Poli::findOrFail($id);

        $poli->update($request->all());

        return redirect()->route('admin.poli.index')->with('success', 'Data berhasil diperbarui');
    }

   public function destroy($id)
    {
        $poli = Poli::findOrFail($id);
        $poli->delete();
        return redirect()->route('admin.poli.index')->with('status', 'poli-deleted');
    }


}
