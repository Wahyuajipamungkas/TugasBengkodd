<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Budi Suntaso',
                'alamat' => 'Jl ini',
                'no_hp' => '081234567',
                'role' => 'dokter',
                'email' => 'budi@gmail.com',
                'password' => Hash::make('dokter123'), // password asli sebelum hash
            ],
            [
                'name' => 'Isul',
                'alamat' => 'Jl ini',
                'no_hp' => '081234567',
                'role' => 'dokter',
                'email' => 'Isul@gmail.com',
                'password' => Hash::make('dokter123'), // password asli sebelum hash
            ],
            [
                'name' => 'Baguaji',
                'alamat' => 'Jl itu',
                'no_hp' => '087654321',
                'role' => 'pasien',
                'email' => 'bagus@gmail.com',
                'password' => Hash::make('12345678'), // password asli sebelum hash
            ],
             [
                'name' => 'Hasan',
                'alamat' => 'Jl itu',
                'no_hp' => '087654321',
                'role' => 'admin',
                'email' => 'hasan@gmail.com',
                'password' => Hash::make('admin123'), // password asli sebelum hash
            ],
        ];

        foreach($data as $d){
            User::create([
                'name' => $d['name'],
                'alamat' => $d['alamat'],
                'no_hp' => $d['no_hp'],
                'role' => $d['role'],
                'email' => $d['email'],
                'password' => $d['password'],
            ]);
        }
    }
}
