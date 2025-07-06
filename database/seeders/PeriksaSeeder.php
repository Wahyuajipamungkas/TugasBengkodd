<?php

namespace Database\Seeders;

use App\Models\DaftarPoli;
use App\Models\Periksa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PeriksaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $daftar = DaftarPoli::first();

        Periksa::create([
            'id_daftarpoli' => $daftar->id,
            'tgl_periksa' => now(),
            'catatan' => 'Flu Ringan. Disarankan intirahat dan minum obat',
            'biaya_periksa' => 25000,
        ]);
    }
}
