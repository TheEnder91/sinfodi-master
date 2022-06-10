<?php

namespace App\Models\Estimulos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RecursosPropios extends Model
{
    use SoftDeletes;

    public $table = 'sinfodi_recursos_propios';

    protected $fillable = [
        'id_direccion',
        'direccion',
        'facturacion',
        'contribucion',
        'personas_direccion',
        'recursos_propios',
        'year',
    ];
}
