<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalPeriksa extends Model
{
    protected $table = 'jadwalperiksa';
        protected $fillable = [
        'id_dokter',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'status',

    ];

    public function dokter(){
        return $this->belongsTo(User::class, 'id_dokter');
    }

    public function daftarpoli(){
        return $this->hasMany(DaftarPoli::class, 'id_jadwal');
    }
}
