<?php

namespace App\Models\Estimulos;

use Illuminate\Database\Eloquent\Model;

class Colaboradores extends Model
{
    public $table = 'sinfodi_colaboracion';

    protected $fillable = [
        'clave', 'nombre', 'usuario', 'comites', 'valor', 'cantidad', 'total', 'year',
    ];
}
