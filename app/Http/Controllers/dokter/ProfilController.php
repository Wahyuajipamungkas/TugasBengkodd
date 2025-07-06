<?php

namespace App\Http\Controllers\dokter;

use App\Http\Controllers\Controller;
use App\Models\Poli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    public function index()
{
    $dokter = Auth::user();
    $polis = Poli::all(); // untuk dropdown
    return view('dokter.profil.index', compact('dokter', 'polis'));
}

public function update(Request $request)
{
    $dokter = Auth::user();

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . $dokter->id,
        'alamat' => 'required|string|max:255',
        'no_hp' => 'required|numeric',
        'id_poli' => 'required|exists:polis,id',
        'password' => 'nullable|string|min:6|confirmed',
    ]);

    $dokter->name = $request->name;
    $dokter->email = $request->email;
    $dokter->alamat = $request->alamat;
    $dokter->no_hp = $request->no_hp;
    $dokter->id_poli = $request->id_poli;

    if ($request->filled('password')) {
        $dokter->password = Hash::make($request->password);
    }

    $dokter->save();

    return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
}
}
