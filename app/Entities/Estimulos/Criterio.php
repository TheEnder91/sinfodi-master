<?php

namespace App\Entities\Estimulos;

use App\Entities\Modulo;
use Illuminate\Database\Eloquent\Model;

class Criterio extends Model
{
    protected $fillable = [
        'nombre', 'id_modulo',
    ];

    public function modulo(){
        return $this->belongsTo(Modulo::class, 'id_modulo', 'id');
    }
}
