<?php

namespace App\Models\Estimulos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Criterio extends Model
{
    use SoftDeletes;

    public $table = 'sinfodi_criterios';

    protected $fillable = [
        'nombre', 'id_objetivo', 'puntos', 'observaciones',
    ];

    public function modulo(){
        return $this->belongsTo(objetivo::class, 'id_objetivo', 'id');
    }
}
