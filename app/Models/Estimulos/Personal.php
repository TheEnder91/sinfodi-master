<?php

namespace App\Models\Estimulos;

use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    public $table = 'sinfodi_personal';

    protected $fillable = [
        'clave', 'nombre', 'usuario', 'unidad_admin', 'year',
    ];
}
