<?php

namespace App\Models\Estimulos;

use Illuminate\Database\Eloquent\Model;

class EvaluacionDServTec extends Model
{
    public $table = 'sinfodi_evaluacion_serv_tecno';

    protected $fillable = [
        'clave', 'nombre', 'id_objetivo', 'id_criterio','direccion', 'puntos', 'total_puntos', 'year', 'username',
    ];
}
