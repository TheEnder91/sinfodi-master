<?php

namespace App\Http\Controllers\Estimulos\Evaluaciones;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Estimulos\EvaluacionResponsabilidades;

class PersonalApoyoController extends Controller
{
    const PERMISSIONS = [
        'index' => 'estimulo-evaluaciones-apoyo-index',
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
                    ->where('nombre', 'LIKE', '%apoyo%')
                    ->take(1)
                    ->get();
        $ultimoAño = date('Y');
        $criterio = "Personal_Apoyo";
        $queryEvaluados = DB::table('sinfodi_evaluados')
                            ->select('clave', 'nombre', 'usuario')
                            ->where('puesto', '=', 'Personal_Apoyo')
                            ->get();
        foreach($queryEvaluados as $itemEvaluados){
            foreach($queryResponsabilidades as $itemResponsabilidades){
                $datos[] = ['clave'=>$itemEvaluados->clave,
                            'nombre'=>$itemEvaluados->nombre,
                            'direccion'=>$criterio,
                            'responsabilidad' =>$itemResponsabilidades->nombre,
                            'puntos'=>$itemResponsabilidades->puntos,
                            'year'=>$ultimoAño,
                            'username'=>$itemEvaluados->usuario
                ];
            }
        }
        self::saveEvaluacionesPersonalApoyo($datos, $ultimoAño, $criterio);
        $guardadosDatos = DB::table('sinfodi_evaluacion_responsabilidades')
                                ->select('clave', 'nombre', 'direccion', 'responsabilidad', 'puntos', 'year', 'username')
                                ->where('direccion', '=', 'Personal_Apoyo')
                                ->get();
        return view('estimulos.evaluaciones.responsabilidades.personalApoyo.index', compact('guardadosDatos'));
    }

    public static function saveEvaluacionesPersonalApoyo($datos, $añoEvaluado, $criterio){
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
