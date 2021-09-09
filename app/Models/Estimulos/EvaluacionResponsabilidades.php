<?php

namespace App\Models\Estimulos;

use Illuminate\Database\Eloquent\Model;

class EvaluacionResponsabilidades extends Model
{
    public $table = 'sinfodi_evaluacion_responsabilidades';

    protected $fillable = [
        'clave', 'nombre', 'direccion', 'responsabilidad','puntos', 'year', 'username',
    ];
}
