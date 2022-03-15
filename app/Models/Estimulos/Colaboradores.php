<?php

namespace App\Models\Estimulos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Colaboradores extends Model
{
    use SoftDeletes;

    public $table = 'sinfodi_colaboracion';

    protected $fillable = [
        'clave', 'nombre', 'usuario', 'comites', 'valor', 'cantidad', 'total', 'year',
    ];
}
