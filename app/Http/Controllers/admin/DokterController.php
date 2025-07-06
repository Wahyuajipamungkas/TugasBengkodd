<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Poli;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DokterController extends Controller
{
    public function index()
    {
        $dokters = User::where('role', 'dokter')->get();
        return view('admin.dokter.index', compact('dokters'));
    }

    public function create(){
        $polis = Poli::all();
        return view('admin.dokter.create', compact('polis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_dokter' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_hp' => 'required|numeric|min:0',
            'id_poli' => 'required|exists:polis,id',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name_dokter,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'id_poli' => $request->id_poli,
            'password' => Hash::make($request->password),
            'role' => 'dokter',
        ]);

        return redirect()->route('admin.dokter.index')->with('success', 'Dokter berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $dokter = User::where('role', 'dokter')->findOrFail($id);
        $polis = Poli::all();
        return view('admin.dokter.edit', compact('dokter', 'polis'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'alamat' => 'required|string',
            'no_hp' => 'required|numeric',
            'id_poli' => 'required|exists:polis,id',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $dokter = User::findOrFail($id);
            $dokter->name = $request->name;
            $dokter->email = $request->email;
            $dokter->alamat = $request->alamat;
            $dokter->no_hp = $request->no_hp;
            $dokter->id_poli = $request->id_poli;

        if ($request->filled('password')) {
            $dokter->password = Hash::make($request->password);
        }

        $dokter->save();

        return redirect()->route('admin.dokter.index')->with('success', 'Data dokter berhasil diperbarui.');
    }

     public function destroy($id)
    {
        $dokter = User::where('role', 'dokter')->findOrFail($id);
        $dokter->delete();

        return redirect()->route('admin.dokter.index')->with('status', 'dokter-deleted');
    }


}
