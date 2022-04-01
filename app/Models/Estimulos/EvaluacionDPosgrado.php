<?php

namespace App\Models\Estimulos;

use Illuminate\Database\Eloquent\Model;

class EvaluacionDPosgrado extends Model
{
    public $table = 'sinfodi_evaluacion_posgrado';

    protected $fillable = [
        'clave', 'nombre', 'id_objetivo', 'id_criterio','direccion', 'puntos', 'total_puntos', 'year', 'username',
    ];
}
