<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periksa extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_daftarpoli',
        'tgl_periksa',
        'catatan',
        'biaya_periksa',
        'status',
    ];

    public function pasien()
    {
        return $this->belongsTo(User::class, 'id_pasien');
    }

    public function daftarpoli(){
        return $this->belongsTo(DaftarPoli::class, 'id_daftarpoli');
    }

    public function dokter()
    {
        return $this->belongsTo(User::class, 'id_dokter');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'id_admin');
    }

    public function obats()
    {
        return $this->belongsToMany(Obat::class, 'detail_periksas', 'id_periksa', 'id_obat');
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function detailperiksa(){
        return $this->hasMany(DetailPeriksa::class, 'id_periksa');
    }

    


}
