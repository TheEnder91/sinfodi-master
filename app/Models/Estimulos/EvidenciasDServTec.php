<?php

namespace App\Models\Estimulos;

use Illuminate\Database\Eloquent\Model;

class EvidenciasDServTec extends Model
{
    public $table = 'sinfodi_evidencias_serv_tecno';

    protected $fillable = [
        'clave', 'evidencias', 'puntos', 'total_puntos', 'id_criterio', 'year',
    ];
}
