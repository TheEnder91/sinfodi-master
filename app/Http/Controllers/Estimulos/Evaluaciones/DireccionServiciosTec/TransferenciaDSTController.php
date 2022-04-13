<?php

namespace App\Http\Controllers\Estimulos\Evaluaciones\DireccionServiciosTec;

use Illuminate\Http\Request;
use App\Traits\SingleResponse;
use App\Http\Controllers\Controller;

class TransferenciaDSTController extends Controller
{
    use SingleResponse;

    const PERMISSIONS = [
        'index' => 'estimulo-evaluaciones-servicios-transferencia-index',
        'indexB' => 'estimulo-evaluaciones-servicios-transferenciaB-index',
    ];
}
