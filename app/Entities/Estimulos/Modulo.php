<?php

namespace App\Entities\Estimulos;

use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    protected $fillable = [
        'nombre',
    ];

    public function criterio(){
        return $this->hasMany(Criterio::class);
    }
}
