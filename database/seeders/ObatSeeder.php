<?php

namespace Database\Seeders;

use App\Models\Obat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ObatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Obat::insert([
            ['name_obat' => 'Paratusin', 'kemasan' => 'Tablet 500ml', 'harga' => 10000],
            ['name_obat' => 'Parameks', 'kemasan' => 'Kapsul', 'harga' => 8000],
        ]);
    }
}
