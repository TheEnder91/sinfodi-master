<?php

namespace App\Http\Controllers\Estimulos\Evaluaciones\DireccionCiencia;

use Illuminate\Http\Request;
use App\Traits\SingleResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Estimulos\EvaluacionDCiencia;
use App\Models\Estimulos\EvidenciasDCiencia;

class PosgradoDCController extends Controller
{
    use SingleResponse;

    const PERMISSIONS = [
        'index' => 'estimulo-evaluaciones-ciencia-posgrado-index',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $criterios = self::Get_Criterios_Investigacion();
        return view('estimulos.evaluaciones.direccionCiencia.posgrado.index', [
            'criterios' => $criterios,
        ]);
    }

    /** Funcion para obtener los criterios para la investigacion cientifica... */
    public static function Get_Criterios_Investigacion(){
        $query = DB::table('sinfodi_criterios')
                    ->select('id', 'nombre', 'id_objetivo')
                    ->where('observaciones', '=', 'Tabla 1. Actividad A.')
                    ->where('id_objetivo', '=', 2)
                    ->get();
        return $query;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $year
     * @return \Illuminate\Http\Response
     */
    public function search($year, $criterio)
    {
        $queryEvaluados = DB::table('sinfodi_evaluados')
                            ->select('clave', 'puesto')
                            ->where('puesto', '=', 'Direccion_Ciencia')
                            ->where('year', $year)
                            ->orderby('clave', 'ASC')
                            ->get();
        foreach($queryEvaluados as $itemEvaluados){
            $clave[] = $itemEvaluados->clave;
        }
        $fechaInicial = $year.'-01-01';
        $fechaFinal = $year.'-12-31';
        if($criterio == 2){
            $evaluacion_posgrado = self::Evaluacion_Objetivo2_Criterio2_Posgrado($clave, $fechaInicial, $fechaFinal);
        }if($criterio == 3){
            $evaluacion_posgrado = self::Evaluacion_Objetivo2_Criterio3_Posgrado($clave, $fechaInicial, $fechaFinal);
        }if($criterio == 4){
            $evaluacion_posgrado = self::Evaluacion_Objetivo2_Criterio4_Posgrado($clave, $fechaInicial, $fechaFinal);
        }if($criterio == 5){
            $evaluacion_posgrado = self::Evaluacion_Objetivo2_Criterio5_Posgrado($clave, $fechaInicial, $fechaFinal);
        }
        $data['response'] = $evaluacion_posgrado;
        return $this->response($data);
    }

    /** Funciones para obtener los datos necesarios para la evaluacion de posgrado... */
    public static function Evaluacion_Objetivo2_Criterio2_Posgrado($clave, $fechaInicial, $fechaFinal){
        $queryAsesores = DB::connection('posgradoDB')->table('dfa_alumnos')
                            ->selectRaw('id_asesor AS numero_personal,
                                         Nom_asesor AS nombre')
                            ->whereBetween('Fecha_f', [$fechaInicial, $fechaFinal])
                            ->where('Id_Nivel', '=', 6)
                            ->whereRaw('TIMESTAMPDIFF(MONTH, Fecha_i, Fecha_f) BETWEEN 20 AND 30')
                            ->groupBy('id_asesor')
                            ->groupBy('Nom_asesor');
        $queryCoasesor = DB::connection('posgradoDB')->table('dfa_alumnos')
                            ->selectRaw('id_coasesor AS numero_personal,
                                         Nom_coasesor AS nombre')
                            ->whereBetween('Fecha_f', [$fechaInicial, $fechaFinal])
                            ->where('Id_Nivel', '=', 6)
                            ->whereRaw('TIMESTAMPDIFF(MONTH, Fecha_i, Fecha_f) BETWEEN 20 AND 30')
                            ->groupBy('id_coasesor')
                            ->groupBy('Nom_coasesor')
                            ->unionAll($queryAsesores);
        $queryCriterio2 = DB::connection('posgradoDB')->table($queryCoasesor)
                            ->selectRaw('numero_personal, nombre')
                            ->whereIn('numero_personal', $clave)
                            ->groupBy('numero_personal')
                            ->groupBy('nombre')
                            ->orderBy('numero_personal', 'ASC')
                            ->get();
        return $queryCriterio2;
    }

    public static function Evaluacion_Objetivo2_Criterio3_Posgrado($clave, $fechaInicial, $fechaFinal){
        $queryAsesores = DB::connection('posgradoDB')->table('dfa_alumnos')
                            ->selectRaw('id_asesor AS numero_personal,
                                         Nom_asesor AS nombre')
                            ->whereBetween('Fecha_f', [$fechaInicial, $fechaFinal])
                            ->where('Id_Nivel', '=', 6)
                            ->whereRaw('TIMESTAMPDIFF(MONTH, Fecha_i, Fecha_f) BETWEEN 31 AND 36')
                            ->groupBy('id_asesor')
                            ->groupBy('Nom_asesor');
        $queryCoasesor = DB::connection('posgradoDB')->table('dfa_alumnos')
                            ->selectRaw('id_coasesor AS numero_personal,
                                         Nom_coasesor AS nombre')
                            ->whereBetween('Fecha_f', [$fechaInicial, $fechaFinal])
                            ->where('Id_Nivel', '=', 6)
                            ->whereRaw('TIMESTAMPDIFF(MONTH, Fecha_i, Fecha_f) BETWEEN 31 AND 36')
                            ->groupBy('id_coasesor')
                            ->groupBy('Nom_coasesor')
                            ->unionAll($queryAsesores);
        $queryCriterio3 = DB::connection('posgradoDB')->table($queryCoasesor)
                            ->selectRaw('numero_personal, nombre')
                            ->whereIn('numero_personal', $clave)
                            ->groupBy('numero_personal')
                            ->groupBy('nombre')
                            ->orderBy('numero_personal', 'ASC')
                            ->get();
        return $queryCriterio3;
    }

    public static function Evaluacion_Objetivo2_Criterio4_Posgrado($clave, $fechaInicial, $fechaFinal){
        $queryAsesores = DB::connection('posgradoDB')->table('dfa_alumnos')
                            ->selectRaw('id_asesor AS numero_personal,
                                         Nom_asesor AS nombre')
                            ->whereBetween('Fecha_f', [$fechaInicial, $fechaFinal])
                            ->where('Id_Nivel', '=', 8)
                            ->whereRaw('TIMESTAMPDIFF(MONTH, Fecha_i, Fecha_f) BETWEEN 37 AND 42')
                            ->groupBy('id_asesor')
                            ->groupBy('Nom_asesor');
        $queryCoasesor = DB::connection('posgradoDB')->table('dfa_alumnos')
                            ->selectRaw('id_coasesor AS numero_personal,
                                         Nom_coasesor AS nombre')
                            ->whereBetween('Fecha_f', [$fechaInicial, $fechaFinal])
                            ->where('Id_Nivel', '=', 8)
                            ->whereRaw('TIMESTAMPDIFF(MONTH, Fecha_i, Fecha_f) BETWEEN 37 AND 42')
                            ->groupBy('id_coasesor')
                            ->groupBy('Nom_coasesor')
                            ->unionAll($queryAsesores);
        $queryCriterio4 = DB::connection('posgradoDB')->table($queryCoasesor)
                            ->selectRaw('numero_personal, nombre')
                            ->whereIn('numero_personal', $clave)
                            ->groupBy('numero_personal')
                            ->groupBy('nombre')
                            ->orderBy('numero_personal', 'ASC')
                            ->get();
        return $queryCriterio4;
    }

    public static function Evaluacion_Objetivo2_Criterio5_Posgrado($clave, $fechaInicial, $fechaFinal){
        $queryAsesores = DB::connection('posgradoDB')->table('dfa_alumnos')
                            ->selectRaw('id_asesor AS numero_personal,
                                         Nom_asesor AS nombre')
                            ->whereBetween('Fecha_f', [$fechaInicial, $fechaFinal])
                            ->where('Id_Nivel', '=', 8)
                            ->whereRaw('TIMESTAMPDIFF(MONTH, Fecha_i, Fecha_f) BETWEEN 43 AND 48')
                            ->groupBy('id_asesor')
                            ->groupBy('Nom_asesor');
        $queryCoasesor = DB::connection('posgradoDB')->table('dfa_alumnos')
                            ->selectRaw('id_coasesor AS numero_personal,
                                         Nom_coasesor AS nombre')
                            ->whereBetween('Fecha_f', [$fechaInicial, $fechaFinal])
                            ->where('Id_Nivel', '=', 8)
                            ->whereRaw('TIMESTAMPDIFF(MONTH, Fecha_i, Fecha_f) BETWEEN 43 AND 48')
                            ->groupBy('id_coasesor')
                            ->groupBy('Nom_coasesor')
                            ->unionAll($queryAsesores);
        $queryCriterio5 = DB::connection('posgradoDB')->table($queryCoasesor)
                            ->selectRaw('numero_personal, nombre')
                            ->whereIn('numero_personal', $clave)
                            ->groupBy('numero_personal')
                            ->groupBy('nombre')
                            ->orderBy('numero_personal', 'ASC')
                            ->get();
        return $queryCriterio5;
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
        if(EvaluacionDCiencia::where('clave', '=', $request->clave)->where('year', '=', $request->year)->where('id_criterio', '=', $request->id_criterio)->count() == 0){
            $nuevo = new EvaluacionDCiencia();
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
    public function datosPosgrado($year, $criterio)
    {
        if($criterio == 2){
            $datos = DB::table('sinfodi_evaluacion_ciencia')->where('year', '=', $year)->where('id_criterio', '=', $criterio)->get();
        }if($criterio == 3){
            $datos = DB::table('sinfodi_evaluacion_ciencia')->where('year', '=', $year)->where('id_criterio', '=', $criterio)->get();
        }if($criterio == 4){
            $datos = DB::table('sinfodi_evaluacion_ciencia')->where('year', '=', $year)->where('id_criterio', '=', $criterio)->get();
        }if($criterio == 5){
            $datos = DB::table('sinfodi_evaluacion_ciencia')->where('year', '=', $year)->where('id_criterio', '=', $criterio)->get();
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
    public function searchEvidencias($year, $clave, $criterio)
    {
        $fechaInicial = $year.'-01-01';
        $fechaFinal = $year.'-12-31';
        if($criterio == 2){
            $evidencias = self::Get_Evidencias_Criterio2_Posgrado($clave, $fechaInicial, $fechaFinal);
        }elseif($criterio == 3){
            $evidencias = self::Get_Evidencias_Criterio3_Posgrado($clave, $fechaInicial, $fechaFinal);
        }elseif($criterio == 4){
            $evidencias = self::Get_Evidencias_Criterio4_Posgrado($clave, $fechaInicial, $fechaFinal);
        }elseif($criterio == 5){
            $evidencias = self::Get_Evidencias_Criterio5_Posgrado($clave, $fechaInicial, $fechaFinal);
        }
        $data['response'] = $evidencias;
        return $this->response($data);
    }

    public static function Get_Evidencias_Criterio2_Posgrado($clave, $fechaInicial, $fechaFinal){
        $query = "SELECT idAlumno AS id,
                         id_asesor AS numero_personal,
                         Fecha_i AS FechaInicial,
                         Fecha_f AS FechaFinal,
                         TIMESTAMPDIFF(MONTH, Fecha_i, Fecha_f) AS meses,
                         Por_part_asesor AS porcentaje,
                         Evidencia AS evidencias
                  FROM dfa_alumnos
                  WHERE (Fecha_f BETWEEN '$fechaInicial' AND '$fechaFinal') AND Id_Nivel = 6 AND
                        (TIMESTAMPDIFF(MONTH, Fecha_i, Fecha_f) BETWEEN 20 AND 30) AND Id_asesor = $clave
                  UNION ALL
                  SELECT idAlumno AS id,
                         Id_coasesor AS numero_personal,
                         Fecha_i AS FechaInicial,
                         Fecha_f AS FechaFinal,
                         TIMESTAMPDIFF(MONTH, Fecha_i, Fecha_f) AS meses,
                         Por_part_coasesor AS porcentaje,
                         Evidencia AS evidencias
                  FROM dfa_alumnos
                  WHERE (Fecha_f BETWEEN '$fechaInicial' AND '$fechaFinal') AND Id_Nivel = 6 AND
                        (TIMESTAMPDIFF(MONTH, Fecha_i, Fecha_f) BETWEEN 20 AND 30) AND Id_coasesor = $clave";
        $queryEvidencias = DB::connection('posgradoDB')->select($query);
        return $queryEvidencias;
    }

    public static function Get_Evidencias_Criterio3_Posgrado($clave, $fechaInicial, $fechaFinal){
        $query = "SELECT idAlumno AS id,
                         id_asesor AS numero_personal,
                         Fecha_i AS FechaInicial,
                         Fecha_f AS FechaFinal,
                         TIMESTAMPDIFF(MONTH, Fecha_i, Fecha_f) AS meses,
                         Por_part_asesor AS porcentaje,
                         Evidencia AS evidencias
                  FROM dfa_alumnos
                  WHERE (Fecha_f BETWEEN '$fechaInicial' AND '$fechaFinal') AND Id_Nivel = 6 AND
                        (TIMESTAMPDIFF(MONTH, Fecha_i, Fecha_f) BETWEEN 31 AND 36) AND Id_asesor = $clave
                  UNION ALL
                  SELECT idAlumno AS id,
                         Id_coasesor AS numero_personal,
                         Fecha_i AS FechaInicial,
                         Fecha_f AS FechaFinal,
                         TIMESTAMPDIFF(MONTH, Fecha_i, Fecha_f) AS meses,
                         Por_part_coasesor AS porcentaje,
                         Evidencia AS evidencias
                  FROM dfa_alumnos
                  WHERE (Fecha_f BETWEEN '$fechaInicial' AND '$fechaFinal') AND Id_Nivel = 6 AND
                        (TIMESTAMPDIFF(MONTH, Fecha_i, Fecha_f) BETWEEN 31 AND 36) AND Id_coasesor = $clave";
        $queryEvidencias = DB::connection('posgradoDB')->select($query);
        return $queryEvidencias;
    }

    public static function Get_Evidencias_Criterio4_Posgrado($clave, $fechaInicial, $fechaFinal){
        $query = DB::connection('posgradoDB')->table('dfa_alumnos')
                    ->selectRaw('id_asesor AS numero_personal,
                                 Fecha_i AS FechaInicial,
                                 Fecha_f AS FechaFinal,
                                 TIMESTAMPDIFF(MONTH, Fecha_i, Fecha_f) AS meses,
                                 Evidencia AS evidencias')
                    ->whereBetween('Fecha_f', [$fechaInicial, $fechaFinal])
                    ->whereRaw('TIMESTAMPDIFF(MONTH, Fecha_i, Fecha_f) BETWEEN 37 AND 42')
                    ->where('Id_Nivel', '=', 8)
                    ->where('id_asesor', '=', $clave)
                    ->get();
        return $query;
    }

    public static function Get_Evidencias_Criterio5_Posgrado($clave, $fechaInicial, $fechaFinal){
        $query = "SELECT idAlumno AS id,
                         id_asesor AS numero_personal,
                         Fecha_i AS FechaInicial,
                         Fecha_f AS FechaFinal,
                         TIMESTAMPDIFF(MONTH, Fecha_i, Fecha_f) AS meses,
                         Por_part_asesor AS porcentaje,
                         Evidencia AS evidencias
                  FROM dfa_alumnos
                  WHERE (Fecha_f BETWEEN '$fechaInicial' AND '$fechaFinal') AND Id_Nivel = 8 AND
                        (TIMESTAMPDIFF(MONTH, Fecha_i, Fecha_f) BETWEEN 43 AND 48) AND Id_asesor = $clave
                  UNION ALL
                  SELECT idAlumno AS id,
                         Id_coasesor AS numero_personal,
                         Fecha_i AS FechaInicial,
                         Fecha_f AS FechaFinal,
                         TIMESTAMPDIFF(MONTH, Fecha_i, Fecha_f) AS meses,
                         Por_part_coasesor AS porcentaje,
                         Evidencia AS evidencias
                  FROM dfa_alumnos
                  WHERE (Fecha_f BETWEEN '$fechaInicial' AND '$fechaFinal') AND Id_Nivel = 8 AND
                        (TIMESTAMPDIFF(MONTH, Fecha_i, Fecha_f) BETWEEN 43 AND 48) AND Id_coasesor = $clave";
        $queryEvidencias = DB::connection('posgradoDB')->select($query);
        return $queryEvidencias;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function puntos($id, $objetivo) {
        $puntos = DB::table('sinfodi_criterios')->select('puntos')->where('id', '=', $id)->where('id_objetivo', '=', $objetivo)->get();
        $data['response'] = $puntos;
        return $this->response($data);
    }

    //** Codigo personal */
    public function getEvidencias($clave, $year, $criterio){
        $obtener = EvidenciasDCiencia::where('clave', '=', $clave)
                                        ->where('id_criterio', '=', $criterio)
                                        ->where('year', '=', $year)
                                        ->get();
        $data['response'] = $obtener;
        return $this->response($data);
    }

    //** Codigo personal */
    public function obtenerEvidencias($clave, $year, $criterio){
        if(EvidenciasDCiencia::where('clave', '=', $clave)->where('year', '=', $year)->where('id_criterio', '=', $criterio)->count() == 0){
            $count = 0;
        }else{
            $count = 1;
        }
        $data['response'] = $count;
        return $this->response($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function savePuntos(Request $request)
    {
        EvidenciasDCiencia::create($request->all());
        $data['response'] = true;
        return $this->response($data);
    }

    /** Codigo personal */
    public static function updateDatos(Request $request){
        $actualizar = EvidenciasDCiencia::where('clave', $request->clave)
                                            ->where('id_criterio', $request->id_criterio)
                                            ->where('year', $request->year)
                                            ->update(['evidencias' => $request->evidencias, 'puntos' => $request->puntos, 'total_puntos' => $request->total_puntos]);
        return $actualizar;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateDatosPuntos(Request $request)
    {
        $actualizar = EvaluacionDCiencia::where('clave', $request->clave)
                                            ->where('id_criterio', $request->id_criterio)
                                            ->where('year', $request->year)
                                            ->update(['puntos' => $request->puntos, 'total_puntos' => $request->total_puntos]);
        return $actualizar;
    }
}
