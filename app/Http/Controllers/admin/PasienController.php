<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Poli;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasienController extends Controller
{
    public function index()
    {
        $pasiens = User::where('role', 'pasien')->get();
        return view('admin.pasien.index', compact('pasiens'));
    }

    public function create(){
        return view('admin.pasien.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_pasien' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_hp' => 'required|numeric|min:0',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name_pasien,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'password' => Hash::make($request->password),
            'role' => 'pasien',
        ]);

        return redirect()->route('admin.pasien.index')->with('success', 'Pasien berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pasien = User::where('role', 'pasien')->findOrFail($id);
        return view('admin.pasien.edit', compact('pasien'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'alamat' => 'required|string',
            'no_hp' => 'required|numeric',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $pasien = User::findOrFail($id);
            $pasien->name = $request->name;
            $pasien->email = $request->email;
            $pasien->alamat = $request->alamat;
            $pasien->no_hp = $request->no_hp;

        if ($request->filled('password')) {
            $pasien->password = Hash::make($request->password);
        }

        $pasien->save();

        return redirect()->route('admin.pasien.index')->with('success', 'Data pasien berhasil diperbarui.');
    }

     public function destroy($id)
    {
        $pasien = User::where('role', 'pasien')->findOrFail($id);
        $pasien->delete();

        return redirect()->route('admin.pasien.index')->with('status', 'pasien-deleted');
    }


}
