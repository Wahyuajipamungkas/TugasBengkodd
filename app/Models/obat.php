<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Obat extends Model
{
    use HasFactory;
    protected $table = 'obats';
    protected $fillable = [
        'name_obat', // harus sama dengan field di database
        'kemasan',
        'harga'
    ];
    public function periksas()
    {
        return $this->belongsToMany(Periksa::class, 'detail_periksas', 'id_obat', 'id_periksa');
    }

    // app/Models/Obat.php
    public function detailPeriksas()
    {
        return $this->hasMany(DetailPeriksa::class, 'id_obat');
    }




}
