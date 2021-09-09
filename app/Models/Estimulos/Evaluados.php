<?php

namespace App\Models\Estimulos;

use Illuminate\Database\Eloquent\Model;

class Evaluados extends Model
{
    public $table = 'sinfodi_evaluados';

    protected $fillable = [
        'clave', 'nombre', 'usuario', 'categoria', 'unidad_admin', 'puesto',
    ];
}
