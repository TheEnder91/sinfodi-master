<?php

namespace App\Models\Estimulos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PuntosTotales extends Model
{
    use SoftDeletes;

    public $table = 'sinfodi_total_puntos';

    protected $fillable = [
        'importe',
        'porcentaje_importe',
        'importe_act_individual',
        'porcentaje_act_individual',
        'importe_facturacion',
        'porcentaje_facturacion',
        'importe_fondos_admin',
        'porcentaje_fondos_admin',
        'importe_responsabilidad',
        'porcentaje_responsabilidad',
        'porcentaje_participacion',
        'total_puntos_responsabilidad',
        'valor_punto_responsabilidad',
        'total_puntos_actividades',
        'cantidad',
        'valor_punto_actividades',
        'puntos_totales',
        'year',
    ];
}
