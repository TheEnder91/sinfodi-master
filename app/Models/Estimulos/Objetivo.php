<?php

namespace App\Models\Estimulos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Objetivo extends Model
{
    use SoftDeletes;

    public $table = 'sinfodi_objetivos';

    protected $fillable = [
        'nombre',
    ];

    public function criterio(){
        return $this->hasMany(Criterio::class);
    }
}
