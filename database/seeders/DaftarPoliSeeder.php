<?php

namespace Database\Seeders;

use App\Models\DaftarPoli;
use App\Models\JadwalPeriksa;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DaftarPoliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pasien = User::where('role', 'pasien')->first(); 

        $jadwal = JadwalPeriksa::where('hari', 'Senin')->first();

        if ($jadwal) {
            $id = $jadwal->id;
        } else {
            // Data tidak ditemukan
        }


        DaftarPoli::create([
            'id_pasien' => $pasien->id,
            'id_jadwal' => $jadwal->id,
            'keluhan' => 'sakit kepala belakang',
            'no_antrian' => 1,
        ]);
    }
}
