<?php

namespace App\Models\Estimulos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SostentabilidadEconomica extends Model
{
    use SoftDeletes;

    public $table = 'sinfodi_sostentabilidad';

    protected $fillable = [
        'cgn',
        'nombre',
        'clave_responsable',
        'nombre_responsable',
        'usuario_responsable',
        'clave_participante',
        'nombre_participante',
        'usuario_participante',
        'lider_responsable',
        'participante',
        'porcentaje_participacion',
        'monto_ingresado',
        'ingreso_participacion',
        'remanente',
        'interinstitucional',
        'interareas',
        'puntos_totales',
        'puntos_lider',
        'nuevos_puntos_totales',
        'puntos_participacion',
        'total',
        'year',
        'tipo',
    ];
}
