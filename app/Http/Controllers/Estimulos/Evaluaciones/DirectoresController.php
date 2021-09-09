<?php

namespace App\Http\Controllers\Estimulos\Evaluaciones;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Estimulos\Evaluados;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Models\Estimulos\EvaluacionResponsabilidades;

class DirectoresController extends Controller
{
    const PERMISSIONS = [
        'index' => 'estimulo-evaluaciones-directores-index',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $queryResponsabilidades = DB::table('sinfodi_responsabilidades')
                    ->selectRaw('nombre, puntos')
                    ->where('nombre', 'LIKE', '%director%')
                    ->take(1)
                    ->get();
        $ultimoAño = date('Y');
        $criterio = "Directores";
        $queryEvaluados = DB::table('sinfodi_evaluados')
                            ->select('clave', 'nombre', 'usuario')
                            ->where('puesto', '=', 'Director')
                            ->get();
        foreach($queryEvaluados as $itemEvaluados){
            foreach($queryResponsabilidades as $itemResponsabilidades){
                $datosTemporales[] = ['clave'=>$itemEvaluados->clave,
                            'nombre'=>$itemEvaluados->nombre,
                            'direccion'=>$criterio,
                            'responsabilidad' => $itemResponsabilidades->nombre,
                            'puntos'=>$itemResponsabilidades->puntos,
                            'year'=>$ultimoAño,
                            'username'=>$itemEvaluados->usuario
                ];
            }
        }
        self::saveEvaluacionesDirectores($datosTemporales, $ultimoAño, $criterio);
        $guardadosDatos = DB::table('sinfodi_evaluacion_responsabilidades')
                                ->select('clave', 'nombre', 'direccion', 'responsabilidad', 'puntos', 'year', 'username')
                                ->where('direccion', '=', 'Directores')
                                ->get();
        return view('estimulos.evaluaciones.responsabilidades.directores.index', compact('guardadosDatos'));
    }

    public static function saveEvaluacionesDirectores($datos, $añoEvaluado, $criterio){
        $queryEvaluaciones = DB::table('sinfodi_evaluacion_responsabilidades')
                                    ->select('clave')
                                    ->where('direccion', '=', $criterio)
                                    ->where('year', '=', $añoEvaluado)
                                    ->get();
        if(count($queryEvaluaciones) >= 1){
            if(DB::table('sinfodi_evaluacion_responsabilidades')->where('year', '=', $añoEvaluado)->where('direccion', '=', $criterio)->delete()){
                $saveEvaluaciones = new EvaluacionResponsabilidades();
                $saveEvaluaciones->insert($datos);
                return true;
            }else{
                return "Hubo un problema, recarge la pagina o llame a soporte.";
            }
        }else{
            $saveEvaluaciones = new EvaluacionResponsabilidades();
            $saveEvaluaciones->insert($datos);
            return true;
        }
    }
}
