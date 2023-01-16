<?php

namespace App\Models\Estimulos;

use Illuminate\Database\Eloquent\Model;

class EvaluacionDProyTec extends Model
{
    public $table = 'sinfodi_evaluacion_proy_tecno';

    protected $fillable = [
        'clave', 'nombre', 'id_objetivo', 'id_criterio','direccion', 'puntos', 'total_puntos', 'year', 'username',
    ];
}
