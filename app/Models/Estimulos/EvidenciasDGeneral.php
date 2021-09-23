<?php

namespace App\Models\Estimulos;

use Illuminate\Database\Eloquent\Model;

class EvidenciasDGeneral extends Model
{
    public $table = 'sinfodi_evidencias_general';

    protected $fillable = [
        'clave', 'clave_evidencia', 'puntos', 'total_puntos', 'year',
    ];
}