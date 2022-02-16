<?php

namespace App\Models\Estimulos\Evaluaciones;

use Illuminate\Database\Eloquent\Model;

class EvaluarResponsabilidades extends Model
{
    public $table = 'sinfodi_evaluar_responsabilidades';

    protected $fillable = [
        'clave', 'nombre', 'direccion', 'responsabilidad','puntos', 'year', 'username', 'status',
    ];
}
