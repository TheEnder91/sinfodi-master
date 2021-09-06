<?php

namespace App\Models\Estimulos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meta extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public $table = 'sinfodi_metas';

    protected $fillable = [
        'cumplimiento', 'f2',
    ];
}
