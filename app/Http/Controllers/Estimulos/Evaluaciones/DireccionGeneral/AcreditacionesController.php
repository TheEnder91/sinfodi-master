<?php

namespace App\Http\Controllers\Estimulos\Evaluaciones\DireccionGeneral;

use Illuminate\Http\Request;
use App\Traits\SingleResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Estimulos\EvaluacionDGeneral;

class AcreditacionesController extends Controller
{
    use SingleResponse;

    const PERMISSIONS = [
        'index' => 'estimulo-evaluaciones-general-acreditaciones-index',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $criterios = self::Get_Criterios_acreditaciones();
        return view('estimulos.evaluaciones.direcionGeneral.acreditaciones.index', compact('criterios'));
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $year
     * @return \Illuminate\Http\Response
     */
    public function searchAcreditaciones($year, $criterio){
        $queryEvaluados = DB::table('sinfodi_evaluados')
                            ->select('clave', 'puesto')
                            ->where('puesto', '=', 'Direccion_General')
                            ->orderby('clave', 'ASC')
                            ->get();
        foreach($queryEvaluados as $itemEvaluados){
            $clave[] = $itemEvaluados->clave;
        }
        $fechaInicial = $year.'-01-01';
        $fechaFinal = $year.'-12-31';
        if($criterio == 33){
            $evaluacion_acreditaciones = self::Evaluacion_Criterio33($clave, $fechaInicial, $fechaFinal);
        }elseif($criterio == 34){
            $evaluacion_acreditaciones = self::Evaluacion_Criterio34($clave, $fechaInicial, $fechaFinal);
        }elseif($criterio == 35){
            $evaluacion_acreditaciones = self::Evaluacion_Criterio35($clave, $fechaInicial, $fechaFinal);
        }
        $data['response'] = $evaluacion_acreditaciones;
        return $this->response($data);
    }

    public static function Evaluacion_Criterio33($clave, $inicial, $final){
        $queryCriterio33 = DB::connection('acreditaciones')->table('performancetests')
                            ->selectRaw('persons.employees_name_p AS nombre_personal,
                                         persons.employees_number AS numero_personal,
                                         performancetests.date_start AS fecha_inicio,
                                         performancetests.date_end AS fecha_fin')
                            ->join('persons', 'performancetests.groups_id', '=', 'persons.groups_id')
                            ->whereBetween('performancetests.date_start', [$inicial, $final])
                            ->whereBetween('performancetests.date_end', [$inicial, $final])
                            ->whereIn('persons.employees_number', $clave)
                            ->get();
        return $queryCriterio33;
    }

    public static function Evaluacion_Criterio34($clave, $inicial, $final){
        $queryCriterio34 = DB::connection('acreditaciones')->table('accreditedtechniques')
                            ->selectRaw('persons.employees_name_p AS nombre_personal,
                                         persons.employees_number AS numero_personal,
                                         accreditedtechniques.date_start AS fecha_inicio,
                                         accreditedtechniques.date_end AS fecha_fin')
                            ->join('persons', 'accreditedtechniques.groups_id', '=', 'persons.groups_id')
                            ->whereBetween('accreditedtechniques.date_start', [$inicial, $final])
                            ->whereBetween('accreditedtechniques.date_end', [$inicial, $final])
                            ->whereIn('persons.employees_number', $clave)
                            ->get();
        return $queryCriterio34;
    }

    public static function Evaluacion_Criterio35($clave, $inicial, $final){
        $queryCriterio35 = DB::connection('acreditaciones')->table('interlaboratorytests')
                            ->selectRaw('persons.employees_name_p AS nombre_personal,
                                         persons.employees_number AS numero_personal,
                                         interlaboratorytests.date_start AS fecha_inicio,
                                         interlaboratorytests.date_end AS fecha_fin')
                            ->join('persons', 'interlaboratorytests.groups_id', '=', 'persons.groups_id')
                            ->whereBetween('interlaboratorytests.date_start', [$inicial, $final])
                            ->whereBetween('interlaboratorytests.date_end', [$inicial, $final])
                            ->whereIn('persons.employees_number', $clave)
                            ->take(1)
                            ->get();
        return $queryCriterio35;
    }

    /** Funcion para obtener el username de los participantes... */
    public function searchUsername($clave){
        $queryUsername = DB::table('sinfodi_evaluados')
                            ->select('*')
                            ->where('clave', '=', $clave)
                            ->get();
        $data['response'] = $queryUsername;
        return $this->response($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveDatos(Request $request)
    {
        if(EvaluacionDGeneral::where('clave', '=', $request->clave)->where('year', '=', $request->year)->where('id_criterio', '=', $request->id_criterio)->count() == 0){
            $nuevo = new EvaluacionDGeneral();
            $nuevo->create($request->all());
            return response()->json('exito');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $year
     * @return \Illuminate\Http\Response
     */
    public function datosAcreditaciones($year, $criterio)
    {
        if($criterio == 33){
            $datos = DB::table('sinfodi_evaluacion_general')->where('year', '=', $year)->where('id_criterio', '=', $criterio)->get();
        }elseif($criterio == 34){
            $datos = DB::table('sinfodi_evaluacion_general')->where('year', '=', $year)->where('id_criterio', '=', $criterio)->get();
        }elseif($criterio == 35){
            $datos = DB::table('sinfodi_evaluacion_general')->where('year', '=', $year)->where('id_criterio', '=', $criterio)->get();
        }
        $data['response'] = $datos;
        return $this->response($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $year
     * @return \Illuminate\Http\Response
     */
    public function searchEvidencias($year, $clave, $criterio){
        $fechaInicial = $year.'-01-01';
        $fechaFinal = $year.'-12-31';
        if($criterio == 33){
            $evidencias_acreditaciones = self::Evaluacion_Criterio33($clave, $fechaInicial, $fechaFinal);
        }elseif($criterio == 34){
            $evidencias_acreditaciones = self::Evidencias_Criterio34($clave, $fechaInicial, $fechaFinal);
        }
        $data['response'] = $evidencias_acreditaciones;
        return $this->response($data);
    }

    public static function Evidencias_Criterio34($clave, $fechaInicial, $fechaFinal){
        $queryCriterio34 = DB::connection('acreditaciones')->table('accreditedtechniques')
                            ->selectRaw('persons.employees_number AS numero_personal,
                                         accreditedtechniques.file AS archivo')
                            ->join('persons', 'accreditedtechniques.groups_id', '=', 'persons.groups_id')
                            ->whereBetween('accreditedtechniques.date_start', [$fechaInicial, $fechaFinal])
                            ->whereBetween('accreditedtechniques.date_end', [$fechaInicial, $fechaFinal])
                            ->where('persons.employees_number', '=', $clave)
                            ->get();
        return $queryCriterio34;
    }
}
