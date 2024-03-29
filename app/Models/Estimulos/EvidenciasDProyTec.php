<?php

namespace App\Models\Estimulos;

use Illuminate\Database\Eloquent\Model;

class EvidenciasDProyTec extends Model
{
    public $table = 'sinfodi_evidencias_proy_tecno';

    protected $fillable = [
        'clave', 'evidencias', 'puntos', 'total_puntos', 'id_criterio', 'year',
    ];
}
