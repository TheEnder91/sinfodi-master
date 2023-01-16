<?php

namespace App\Models\Estimulos;

use Illuminate\Database\Eloquent\Model;

class HelpPosgrado extends Model
{
    public $table = 'sinfodi_help_posgrado';

    protected $fillable = [
        'clave', 'nombre', 'puntos', 'total_puntos', 'id_criterio',
    ];
}
