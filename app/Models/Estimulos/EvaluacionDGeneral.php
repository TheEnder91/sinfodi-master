<?php

namespace App\Models\Estimulos;

use Illuminate\Database\Eloquent\Model;

class EvaluacionDGeneral extends Model
{
    public $table = 'sinfodi_evaluacion_general';

    protected $fillable = [
        'clave', 'nombre', 'id_objetivo', 'id_criterio','direccion', 'puntos', 'total_puntos', 'year', 'username',
    ];
}
