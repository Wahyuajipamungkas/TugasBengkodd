<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DaftarPoli extends Model
{
    protected $table = 'daftarpoli';
    protected $fillable = [
        'id_pasien',
        'id_jadwal',
        'keluhan',
        'no_antrian',
    ];
    
    public function pasien(){
        return $this->belongsTo(User::class, 'id_pasien');
    }

   public function periksa(){
        return $this->hasOne(Periksa::class, 'id_daftarpoli', 'id');
    }


    public function jadwalperiksa(){
        return $this->belongsTo(JadwalPeriksa::class, 'id_jadwal');
    }

}
