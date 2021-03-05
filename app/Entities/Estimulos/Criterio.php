<?php

namespace App\Entities\Estimulos;

use App\Entities\Estimulos\Modulo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Criterio extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nombre', 'id_modulo', 'puntos',
    ];

    public function modulo(){
        return $this->belongsTo(Modulo::class, 'id_modulo', 'id');
    }
}
