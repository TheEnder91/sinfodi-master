<?php

namespace App\Http\Controllers\Estimulos\Evaluaciones\DireccionServiciosTec;

use Illuminate\Http\Request;
use App\Traits\SingleResponse;
use App\Http\Controllers\Controller;

class InvestigacionDSTController extends Controller
{
    use SingleResponse;

    const PERMISSIONS = [
        'index' => 'estimulo-evaluaciones-servicios-investigacion-index',
        'indexB' => 'estimulo-evaluaciones-servicios-investigacionB-index',
    ];
}
