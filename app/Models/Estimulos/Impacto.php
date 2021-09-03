<?php

namespace App\Models\Estimulos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Impacto extends Model
{
    use SoftDeletes;

    public $table = 'sinfodi_impacto';

    protected $fillable = [
        'factor', 'nivel',
    ];
}
