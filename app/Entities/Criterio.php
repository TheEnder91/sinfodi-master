<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Criterio extends Model
{
    protected $fillable = [
        'nombre', 'id_modulo',
    ];
}
