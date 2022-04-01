<?php

namespace App\Http\Controllers\Estimulos\Evaluaciones\DireccionCiencia;

use Illuminate\Http\Request;
use App\Traits\SingleResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AcreditacionesDCController extends Controller
{
    use SingleResponse;

    const PERMISSIONS = [
        'index' => 'estimulo-evaluaciones-ciencia-acreditaciones-index',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $criterios = self::Get_Criterios_acreditaciones();
        return view('estimulos.evaluaciones.direccionCiencia.acreditaciones.index', compact('criterios'));
    }

    /** Funcion para obtener los criterios para la acreditaciones... */
    public static function Get_Criterios_acreditaciones(){
        $query = DB::table('sinfodi_criterios')
                    ->select('id', 'nombre', 'id_objetivo')
                    ->where('observaciones', '=', 'Tabla 1. Actividad A.')
                    ->where('id_objetivo', '=', 8)
                    ->get();
        return $query;
    }
}
