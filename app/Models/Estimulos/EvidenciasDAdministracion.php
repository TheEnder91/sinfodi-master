<?php

namespace App\Models\Estimulos;

use Illuminate\Database\Eloquent\Model;

class EvidenciasDAdministracion extends Model
{
    public $table = 'sinfodi_evidencias_administracion';

    protected $fillable = [
        'clave', 'evidencias', 'puntos', 'total_puntos', 'year', 'id_criterio',
    ];
}
