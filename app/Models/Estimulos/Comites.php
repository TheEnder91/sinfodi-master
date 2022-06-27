<?php

namespace App\Models\Estimulos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comites extends Model
{
    use SoftDeletes;

    public $table = 'sinfodi_comites';

    protected $fillable = [
        'nombre', 'descripcion', 'url_archivo', 'year',
    ];
}
