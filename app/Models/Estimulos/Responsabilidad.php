<?php

namespace App\Models\Estimulos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Responsabilidad extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public $table = 'sinfodi_responsabilidades';

    protected $fillable = [
        'nombre', 'puntos',
    ];
}
