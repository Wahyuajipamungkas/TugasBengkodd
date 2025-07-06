<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable; 
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'alamat',
        'no_hp',
        'id_poli',
        'role'
    ];

    public function jadwalperiksa(){
        return $this->hasMany(JadwalPeriksa::class, 'id_dokter');
    }

    public function daftarpoli(){
        return $this->hasMany(DaftarPoli::class, 'id_pasien');
    }

    public function poli()
    {
        return $this->belongsTo(Poli::class, 'id_poli');
    }


}
