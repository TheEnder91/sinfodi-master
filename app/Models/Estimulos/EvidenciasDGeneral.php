<?php

namespace App\Models\Estimulos;

use Illuminate\Database\Eloquent\Model;

class EvidenciasDGeneral extends Model
{
    public $table = 'sinfodi_evidencias_general';

    protected $fillable = [
        'clave', 'evidencias', 'puntos', 'total_puntos', 'year', 'id_criterio',
    ];
}
