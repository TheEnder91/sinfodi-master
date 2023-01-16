<?php

namespace App\Models\Estimulos;

use Illuminate\Database\Eloquent\Model;

class EvidenciasDCiencia extends Model
{
    public $table = 'sinfodi_evidencias_ciencia';

    protected $fillable = [
        'clave', 'evidencias', 'puntos', 'total_puntos', 'id_criterio', 'year',
    ];
}
