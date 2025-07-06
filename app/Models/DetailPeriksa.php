<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailPeriksa extends Model
{
     protected $fillable = [
        'id_periksa',
        'id_obat',
        'jumlah',
        'biaya',
    ];

    public function periksa(){
        return $this->belongsTo(Periksa::class. 'id_periksa');
    }

    public function obat(){
        return $this->belongsTo(Periksa::class, 'id_obat');
    }
}
