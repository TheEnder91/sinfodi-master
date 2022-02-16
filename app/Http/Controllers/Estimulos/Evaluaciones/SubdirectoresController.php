<?php

namespace App\Http\Controllers\Estimulos\Evaluaciones;

use Illuminate\Http\Request;
use App\Traits\SingleResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Estimulos\EvaluacionResponsabilidades;
use App\Models\Estimulos\Evaluaciones\EvaluarResponsabilidades;

class SubdirectoresController extends Controller
{
    use SingleResponse;

    const PERMISSIONS = [
        'index' => 'estimulo-evaluaciones-subdirectores-index',
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
                    ->where('nombre', 'LIKE', '%subdirector%')
                    ->take(1)
                    ->get();
        $ultimoAño = date('Y') - 1;
        $criterio = "Subdirectores";
        $status = 0;
        $queryEvaluados = DB::table('sinfodi_evaluados')
                            ->select('clave', 'nombre', 'usuario')
                            ->where('puesto', '=', 'Subdirector')
                            ->get();
        foreach($queryEvaluados as $itemEvaluados){
            foreach($queryResponsabilidades as $itemResponsabilidades){
                $datos[] = ['clave'=>$itemEvaluados->clave,
                            'nombre'=>$itemEvaluados->nombre,
                            'direccion'=>$criterio,
                            'responsabilidad' =>$itemResponsabilidades->nombre,
                            'puntos'=>$itemResponsabilidades->puntos,
                            'year'=>$ultimoAño,
                            'username'=>$itemEvaluados->usuario,
                            'status'=>$status,
                ];
            }
        }
        self::saveEvaluacionesSubdirectores($datos, $ultimoAño, $criterio);
        $guardadosDatos = DB::table('sinfodi_evaluar_responsabilidades')
                                ->select('clave', 'nombre', 'direccion', 'responsabilidad', 'puntos', 'year', 'username')
                                ->where('direccion', '=', 'Subdirectores')
                                ->get();
        return view('estimulos.evaluaciones.responsabilidades.subdirectores.index', compact('guardadosDatos'));
    }

    public static function saveEvaluacionesSubdirectores($datos, $añoEvaluado, $criterio){
        $queryEvaluaciones = DB::table('sinfodi_evaluar_responsabilidades')
                                ->select('clave')
                                ->where('direccion', '=', $criterio)
                                ->get();
        if(count($queryEvaluaciones) >= 1){
            if(DB::table('sinfodi_evaluar_responsabilidades')->where('direccion', '=', $criterio)->delete()){
                $saveEvaluaciones = new EvaluarResponsabilidades();
                $saveEvaluaciones->insert($datos);
                return true;
            }else{
                return "Hubo un problema, recarge la pagina o llame a soporte.";
            }
        }else{
            $saveEvaluaciones = new EvaluarResponsabilidades();
            $saveEvaluaciones->insert($datos);
            return true;
        }
    }

    /** Consultar personal para consultar a los directores guardardos... */
    public function consultar($clave, $year){
        $subdirectores = DB::table('sinfodi_evaluacion_responsabilidades')->where('clave', $clave)->where('year', $year)->count();
        return $subdirectores;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subdirectores = EvaluacionResponsabilidades::create($request->all());
        $data['response'] = true;
        return $this->response($data);
    }

    /** Consultar personal para ver el historial de los directores guardardos... */
    public function historial(){
        $subdirectores = DB::table('sinfodi_evaluacion_responsabilidades')->where('direccion', '=', 'Subdirectores')->get();
        return view('estimulos.evaluaciones.responsabilidades.subdirectores.historial', compact('subdirectores'));
    }
}
