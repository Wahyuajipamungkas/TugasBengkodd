<?php

namespace Database\Seeders;

use App\Models\JadwalPeriksa;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JadwalPeriksaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dokters = User::where('role', 'dokter')->get();

        foreach ($dokters as $dokter) {
            // Buat jadwal pertama (aktif)
            JadwalPeriksa::create([
                'id_dokter' => $dokter->id,
                'hari' => 1, // Senin
                'jam_mulai' => '08:00:00',
                'jam_selesai' => '12:00:00',
                'status' => 1, // aktif
            ]);

            // Buat jadwal kedua (nonaktif) hanya jika ID dokter genap
            if ($dokter->id % 2 == 0) {
                JadwalPeriksa::create([
                    'id_dokter' => $dokter->id,
                    'hari' => 2, // Selasa
                    'jam_mulai' => '13:00:00',
                    'jam_selesai' => '16:00:00',
                    'status' => 0, // nonaktif
                ]);
            }
    }
}
}
