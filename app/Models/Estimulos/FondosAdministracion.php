<?php

namespace App\Models\Estimulos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FondosAdministracion extends Model
{
    use SoftDeletes;

    public $table = 'sinfodi_fondos_administracion';

    protected $fillable = [
        'id_direccion',
        'direccion',
        'facturacion',
        'contribucion',
        'personas_direccion',
        'fondos_admin',
        'year',
    ];
}
