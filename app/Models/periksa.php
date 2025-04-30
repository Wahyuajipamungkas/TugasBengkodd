<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periksa extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_pasien',
        'id_dokter',
        'tgl_periksa',
        'catatan',
        'biaya_periksa',
    ];

public function pasien()
{
    return $this->belongsTo(User::class, 'id_pasien');
}

public function dokter()
{
    return $this->belongsTo(User::class, 'id_dokter');
}

public function obats()
    {
        return $this->belongsToMany(Obat::class, 'detail_periksas', 'id_periksa', 'id_obat');
    }


public function user()
{
    return $this->belongsTo(User::class);
}



}
