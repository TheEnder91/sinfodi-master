<?php

namespace App\Http\Controllers\Estimulos\Evaluaciones;

use Illuminate\Http\Request;
use App\Traits\SingleResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Estimulos\EvaluacionResponsabilidades;
use App\Models\Estimulos\Evaluaciones\EvaluarResponsabilidades;

class PersonalApoyoController extends Controller
{
    use SingleResponse;

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
        $ultimoAño = date('Y') - 1;
        $criterio = "Personal_Apoyo";
        $status = 0;
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
                            'username'=>$itemEvaluados->usuario,
                            'status'=>$status,
                ];
            }
        }
        self::saveEvaluacionesPersonalApoyo($datos, $ultimoAño, $criterio);
        $guardadosDatos = DB::table('sinfodi_evaluar_responsabilidades')
                                ->select('clave', 'nombre', 'direccion', 'responsabilidad', 'puntos', 'year', 'username')
                                ->where('direccion', '=', 'Personal_Apoyo')
                                ->get();
        return view('estimulos.evaluaciones.responsabilidades.personalApoyo.index', compact('guardadosDatos'));
    }

    public static function saveEvaluacionesPersonalApoyo($datos, $añoEvaluado, $criterio){
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
        $personalApoyo = DB::table('sinfodi_evaluacion_responsabilidades')->where('clave', $clave)->where('year', $year)->count();
        return $personalApoyo;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $personalApoyo = EvaluacionResponsabilidades::create($request->all());
        $data['response'] = true;
        return $this->response($data);
    }

    /** Consultar personal para ver el historial de los directores guardardos... */
    public function historial(){
        $personalApoyo = DB::table('sinfodi_evaluacion_responsabilidades')->where('direccion', '=', 'Personal_Apoyo')->get();
        return view('estimulos.evaluaciones.responsabilidades.personalApoyo.historial', compact('personalApoyo'));
    }
}
