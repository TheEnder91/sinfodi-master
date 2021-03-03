<?php

namespace App\Entities\Estimulos;

use Illuminate\Database\Eloquent\Model;

class Criterio extends Model
{
    protected $fillable = [
        'nombre', 'id_modulo',
    ];
}
