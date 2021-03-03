<?php

namespace App\Entities;

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
