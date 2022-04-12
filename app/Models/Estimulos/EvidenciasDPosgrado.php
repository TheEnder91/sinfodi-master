<?php

namespace App\Models\Estimulos;

use Illuminate\Database\Eloquent\Model;

class EvidenciasDPosgrado extends Model
{
    public $table = 'sinfodi_evidencias_posgrado';

    protected $fillable = [
        'clave', 'evidencias', 'puntos', 'total_puntos', 'year', 'id_criterio',
    ];
}
