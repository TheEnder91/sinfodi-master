<?php

namespace App\Models\Estimulos;

use Illuminate\Database\Eloquent\Model;

class EvaluacionDAdministracion extends Model
{
    public $table = 'sinfodi_evaluacion_administracion';

    protected $fillable = [
        'clave', 'nombre', 'id_objetivo', 'id_criterio','direccion', 'puntos', 'total_puntos', 'year', 'username',
    ];
}
