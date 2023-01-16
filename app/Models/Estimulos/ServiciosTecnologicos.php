<?php

namespace App\Models\Estimulos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiciosTecnologicos extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public $table = 'sinfodi_serv_tecno';

    protected $fillable = [
        'monto', 'year',
    ];
}
