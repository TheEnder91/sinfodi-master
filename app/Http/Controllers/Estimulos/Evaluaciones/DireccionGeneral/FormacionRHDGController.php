<?php

namespace App\Http\Controllers\Estimulos\Evaluaciones\DireccionGeneral;

use Illuminate\Http\Request;
use App\Traits\SingleResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Estimulos\EvaluacionDGeneral;
use App\Models\Estimulos\EvidenciasDGeneral;

class FormacionRHDGController extends Controller
{
    use SingleResponse;

    const PERMISSIONS = [
        'index' => 'estimulo-evaluaciones-general-formacion-index',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $criterios = self::Get_Criterios_transferencia();
        return view('estimulos.evaluaciones.direcionGeneral.formacionRH.index', compact('criterios'));
    }

    /** Funcion para obtener los criterios para la transferencia de conocimiento e innovación... */
    public static function Get_Criterios_transferencia(){
        $query = DB::table('sinfodi_criterios')
                    ->select('id', 'nombre', 'id_objetivo')
                    ->where('observaciones', '=', 'Tabla 1. Actividad A.')
                    ->where('id_objetivo', '=', 6)
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
                            ->where('puesto', '=', 'Direccion_General')
                            ->orderby('clave', 'ASC')
                            ->get();
        foreach($queryEvaluados as $itemEvaluados){
            $clave[] = $itemEvaluados->clave;
        }
        $fechaInicial = $year.'-01-01';
        $fechaFinal = $year.'-12-31';
        if($criterio == 24){
            $evaluacion_formacion = self::Evaluacion_Objetivo5_Criterio24_FormacionRH($clave, $fechaInicial, $fechaFinal);
        }elseif($criterio == 25){
            $evaluacion_formacion = self::Evaluacion_Objetivo5_Criterio25_FormacionRH($clave, $fechaInicial, $fechaFinal);
        }elseif($criterio == 26){
            $evaluacion_formacion = self::Evaluacion_Objetivo5_Criterio26_FormacionRH($clave, $fechaInicial, $fechaFinal);
        }elseif($criterio == 27){
            $evaluacion_formacion = self::Evaluacion_Objetivo5_Criterio27_FormacionRH($clave, $fechaInicial, $fechaFinal);
        }elseif($criterio == 28){
            $evaluacion_formacion = self::Evaluacion_Objetivo5_Criterio28_FormacionRH($clave, $fechaInicial, $fechaFinal);
        }elseif($criterio == 29){
            $evaluacion_formacion = self::Evaluacion_Objetivo5_Criterio29_FormacionRH($clave, $fechaInicial, $fechaFinal);
        }elseif($criterio == 30){
            $evaluacion_formacion = self::Evaluacion_Objetivo5_Criterio30_FormacionRH($clave, $fechaInicial, $fechaFinal);
        }elseif($criterio == 31){
            $evaluacion_formacion = self::Evaluacion_Objetivo5_Criterio31_FormacionRH($clave, $fechaInicial, $fechaFinal);
        }
        $data['response'] = $evaluacion_formacion;
        return $this->response($data);
    }

    public static function Evaluacion_Objetivo5_Criterio24_FormacionRH($clave, $inicial, $final){
        $queryCriterio24 = DB::connection('posgradoDB')->table('va_alumnospregrado')
                            ->selectRaw('id_asesor AS numero_personal,
                                         Nom_asesor AS nombre')
                            ->whereBetween('Fecha_f', [$inicial, $final])
                            ->where('Id_TipoAlumno', '=', 1)
                            ->whereIn('id_asesor', $clave)
                            ->groupBy('id_asesor')
                            ->groupBy('Nom_asesor')
                            ->get();
        return $queryCriterio24;
    }

    public static function Evaluacion_Objetivo5_Criterio25_FormacionRH($clave, $inicial, $final){
        $queryCriterio25 = DB::connection('posgradoDB')->table('va_alumnospregrado')
                            ->selectRaw('id_asesor AS numero_personal,
                                         Nom_asesor AS nombre')
                            ->whereBetween('Fecha_f', [$inicial, $final])
                            ->where('Id_TipoAlumno', '=', 2)
                            ->whereIn('id_asesor', $clave)
                            ->groupBy('id_asesor')
                            ->groupBy('Nom_asesor')
                            ->get();
        return $queryCriterio25;
    }

    public static function Evaluacion_Objetivo5_Criterio26_FormacionRH($clave, $inicial, $final){
        $queryCriterio26 = DB::connection('posgradoDB')->table('va_alumnospregrado')
                            ->selectRaw('id_asesor AS numero_personal,
                                         Nom_asesor AS nombre')
                            ->whereBetween('Fecha_f', [$inicial, $final])
                            ->where('Id_TipoAlumno', '=', 3)
                            ->whereIn('id_asesor', $clave)
                            ->groupBy('id_asesor')
                            ->groupBy('Nom_asesor')
                            ->get();
        return $queryCriterio26;
    }

    public static function Evaluacion_Objetivo5_Criterio27_FormacionRH($clave, $inicial, $final){
        $queryCriterio27 = DB::connection('posgradoDB')->table('va_alumnospregrado')
                            ->selectRaw('id_asesor AS numero_personal,
                                         Nom_asesor AS nombre')
                            ->whereBetween('Fecha_f', [$inicial, $final])
                            ->where('Id_TipoAlumno', '=', 11)
                            ->whereIn('id_asesor', $clave)
                            ->groupBy('id_asesor')
                            ->groupBy('Nom_asesor')
                            ->get();
        return $queryCriterio27;
    }

    public static function Evaluacion_Objetivo5_Criterio28_FormacionRH($clave, $inicial, $final){
        $queryCriterio28 = DB::connection('posgradoDB')->table('va_alumnospregrado')
                            ->selectRaw('id_asesor AS numero_personal,
                                         Nom_asesor AS nombre')
                            ->whereBetween('Fecha_f', [$inicial, $final])
                            ->where('Id_TipoAlumno', '=', 10)
                            ->whereIn('id_asesor', $clave)
                            ->groupBy('id_asesor')
                            ->groupBy('Nom_asesor')
                            ->get();
        return $queryCriterio28;
    }

    public static function Evaluacion_Objetivo5_Criterio29_FormacionRH($clave, $inicial, $final){
        $queryCriterio29 = DB::connection('posgradoDB')->table('va_alumnospregrado')
                            ->selectRaw('id_asesor AS numero_personal,
                                         Nom_asesor AS nombre')
                            ->whereBetween('Fecha_f', [$inicial, $final])
                            ->where('Id_TipoAlumno', '=', 4)
                            ->whereIn('id_asesor', $clave)
                            ->groupBy('id_asesor')
                            ->groupBy('Nom_asesor')
                            ->get();
        return $queryCriterio29;
    }

    public static function Evaluacion_Objetivo5_Criterio30_FormacionRH($clave, $inicial, $final){
        $queryCriterio30 = DB::connection('posgradoDB')->table('va_alumnospregrado')
                            ->selectRaw('id_asesor AS numero_personal,
                                         Nom_asesor AS nombre')
                            ->whereBetween('Fecha_f', [$inicial, $final])
                            ->where('Id_TipoAlumno', '=', 6)
                            ->whereIn('id_asesor', $clave)
                            ->groupBy('id_asesor')
                            ->groupBy('Nom_asesor')
                            ->get();
        return $queryCriterio30;
    }

    public static function Evaluacion_Objetivo5_Criterio31_FormacionRH($clave, $inicial, $final){
        $queryCriterio31 = DB::connection('posgradoDB')->table('va_alumnospregrado')
                            ->selectRaw('id_asesor AS numero_personal,
                                         Nom_asesor AS nombre')
                            ->whereBetween('Fecha_f', [$inicial, $final])
                            ->where('Id_TipoAlumno', '=', 8)
                            ->whereIn('id_asesor', $clave)
                            ->groupBy('id_asesor')
                            ->groupBy('Nom_asesor')
                            ->get();
        return $queryCriterio31;
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
    public function datosFormacionRH($year, $criterio)
    {
        if($criterio == 24){
            $datos = DB::table('sinfodi_evaluacion_general')->where('year', '=', $year)->where('id_criterio', '=', $criterio)->get();
        }elseif($criterio == 25){
            $datos = DB::table('sinfodi_evaluacion_general')->where('year', '=', $year)->where('id_criterio', '=', $criterio)->get();
        }elseif($criterio == 26){
            $datos = DB::table('sinfodi_evaluacion_general')->where('year', '=', $year)->where('id_criterio', '=', $criterio)->get();
        }elseif($criterio == 27){
            $datos = DB::table('sinfodi_evaluacion_general')->where('year', '=', $year)->where('id_criterio', '=', $criterio)->get();
        }elseif($criterio == 28){
            $datos = DB::table('sinfodi_evaluacion_general')->where('year', '=', $year)->where('id_criterio', '=', $criterio)->get();
        }elseif($criterio == 29){
            $datos = DB::table('sinfodi_evaluacion_general')->where('year', '=', $year)->where('id_criterio', '=', $criterio)->get();
        }elseif($criterio == 30){
            $datos = DB::table('sinfodi_evaluacion_general')->where('year', '=', $year)->where('id_criterio', '=', $criterio)->get();
        }elseif($criterio == 31){
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
    public function searchEvidencias($year, $clave, $criterio)
    {
        $fechaInicial = $year.'-01-01';
        $fechaFinal = $year.'-12-31';
        if($criterio == 24){
            $evidencias_formacion = self::Evidencias_Objetivo6_Criterio24_FormacionRH($clave, $fechaInicial, $fechaFinal);
        }elseif($criterio == 25){
            $evidencias_formacion = self::Evidencias_Objetivo6_Criterio25_FormacionRH($clave, $fechaInicial, $fechaFinal);
        }elseif($criterio == 26){
            $evidencias_formacion = self::Evidencias_Objetivo6_Criterio26_FormacionRH($clave, $fechaInicial, $fechaFinal);
        }elseif($criterio == 27){
            $evidencias_formacion = self::Evidencias_Objetivo6_Criterio27_FormacionRH($clave, $fechaInicial, $fechaFinal);
        }elseif($criterio == 28){
            $evidencias_formacion = self::Evidencias_Objetivo6_Criterio28_FormacionRH($clave, $fechaInicial, $fechaFinal);
        }elseif($criterio == 29){
            $evidencias_formacion = self::Evidencias_Objetivo6_Criterio29_FormacionRH($clave, $fechaInicial, $fechaFinal);
        }elseif($criterio == 30){
            $evidencias_formacion = self::Evidencias_Objetivo6_Criterio30_FormacionRH($clave, $fechaInicial, $fechaFinal);
        }elseif($criterio == 31){
            $evidencias_formacion = self::Evidencias_Objetivo6_Criterio31_FormacionRH($clave, $fechaInicial, $fechaFinal);
        }
        $data['response'] = $evidencias_formacion;
        return $this->response($data);
    }

    public static function Evidencias_Objetivo6_Criterio24_FormacionRH($clave, $fechaInicial, $fechaFinal){
        $query = DB::connection('posgradoDB')->table('va_alumnospregrado')
                    ->selectRaw('IdAlumnoPregrado,
                                 Id_asesor AS numero_personal,
                                 Nom_asesor AS nombre,
                                 Evidencia AS evidencias')
                    ->whereBetween('Fecha_f', [$fechaInicial, $fechaFinal])
                    ->where('Id_TipoAlumno', '=', 1)
                    ->where('id_asesor', '=', $clave)
                    ->get();
        return $query;
    }

    public static function Evidencias_Objetivo6_Criterio25_FormacionRH($clave, $fechaInicial, $fechaFinal){
        $query = DB::connection('posgradoDB')->table('va_alumnospregrado')
                    ->selectRaw('IdAlumnoPregrado,
                                 Id_asesor AS numero_personal,
                                 Nom_asesor AS nombre,
                                 Evidencia AS evidencias')
                    ->whereBetween('Fecha_f', [$fechaInicial, $fechaFinal])
                    ->where('Id_TipoAlumno', '=', 2)
                    ->where('id_asesor', '=', $clave)
                    ->get();
        return $query;
    }

    public static function Evidencias_Objetivo6_Criterio26_FormacionRH($clave, $fechaInicial, $fechaFinal){
        $query = DB::connection('posgradoDB')->table('va_alumnospregrado')
                    ->selectRaw('IdAlumnoPregrado,
                                 Id_asesor AS numero_personal,
                                 Nom_asesor AS nombre,
                                 Evidencia AS evidencias')
                    ->whereBetween('Fecha_f', [$fechaInicial, $fechaFinal])
                    ->where('Id_TipoAlumno', '=', 3)
                    ->where('id_asesor', '=', $clave)
                    ->get();
        return $query;
    }

    public static function Evidencias_Objetivo6_Criterio27_FormacionRH($clave, $fechaInicial, $fechaFinal){
        $query = DB::connection('posgradoDB')->table('va_alumnospregrado')
                    ->selectRaw('IdAlumnoPregrado,
                                 Id_asesor AS numero_personal,
                                 Nom_asesor AS nombre,
                                 Evidencia AS evidencias')
                    ->whereBetween('Fecha_f', [$fechaInicial, $fechaFinal])
                    ->where('Id_TipoAlumno', '=', 11)
                    ->where('id_asesor', '=', $clave)
                    ->get();
        return $query;
    }

    public static function Evidencias_Objetivo6_Criterio28_FormacionRH($clave, $fechaInicial, $fechaFinal){
        $query = DB::connection('posgradoDB')->table('va_alumnospregrado')
                    ->selectRaw('IdAlumnoPregrado,
                                 Id_asesor AS numero_personal,
                                 Nom_asesor AS nombre,
                                 Evidencia AS evidencias')
                    ->whereBetween('Fecha_f', [$fechaInicial, $fechaFinal])
                    ->where('Id_TipoAlumno', '=', 10)
                    ->where('id_asesor', '=', $clave)
                    ->get();
        return $query;
    }

    public static function Evidencias_Objetivo6_Criterio29_FormacionRH($clave, $fechaInicial, $fechaFinal){
        $query = DB::connection('posgradoDB')->table('va_alumnospregrado')
                    ->selectRaw('IdAlumnoPregrado,
                                 Id_asesor AS numero_personal,
                                 Nom_asesor AS nombre,
                                 Evidencia AS evidencias')
                    ->whereBetween('Fecha_f', [$fechaInicial, $fechaFinal])
                    ->where('Id_TipoAlumno', '=', 4)
                    ->where('id_asesor', '=', $clave)
                    ->get();
        return $query;
    }

    public static function Evidencias_Objetivo6_Criterio30_FormacionRH($clave, $fechaInicial, $fechaFinal){
        $query = DB::connection('posgradoDB')->table('va_alumnospregrado')
                    ->selectRaw('IdAlumnoPregrado,
                                 Id_asesor AS numero_personal,
                                 Nom_asesor AS nombre,
                                 Evidencia AS evidencias')
                    ->whereBetween('Fecha_f', [$fechaInicial, $fechaFinal])
                    ->where('Id_TipoAlumno', '=', 6)
                    ->where('id_asesor', '=', $clave)
                    ->get();
        return $query;
    }

    public static function Evidencias_Objetivo6_Criterio31_FormacionRH($clave, $fechaInicial, $fechaFinal){
        $query = DB::connection('posgradoDB')->table('va_alumnospregrado')
                    ->selectRaw('IdAlumnoPregrado,
                                 Id_asesor AS numero_personal,
                                 Nom_asesor AS nombre,
                                 Evidencia AS evidencias')
                    ->whereBetween('Fecha_f', [$fechaInicial, $fechaFinal])
                    ->where('Id_TipoAlumno', '=', 8)
                    ->where('id_asesor', '=', $clave)
                    ->get();
        return $query;
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
    public function obtenerEvidencias($clave, $year, $criterio){
        if(EvidenciasDGeneral::where('clave', '=', $clave)->where('year', '=', $year)->where('id_criterio', '=', $criterio)->count() == 0){
            $count = 0;
        }else{
            $count = 1;
        }
        $data['response'] = $count;
        return $this->response($data);
    }

    //** Codigo personal */
    public function getEvidencias($clave, $year, $criterio){
        $obtener = EvidenciasDGeneral::where('clave', '=', $clave)
                                        ->where('id_criterio', '=', $criterio)
                                        ->where('year', '=', $year)
                                        ->get();
        $data['response'] = $obtener;
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
        EvidenciasDGeneral::create($request->all());
        $data['response'] = true;
        return $this->response($data);
    }

    /** Codigo personal */
    public static function updateDatos(Request $request){
        $actualizar = EvidenciasDGeneral::where('clave', $request->clave)
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
        $actualizar = EvaluacionDGeneral::where('clave', $request->clave)
                                            ->where('id_criterio', $request->id_criterio)
                                            ->where('year', $request->year)
                                            ->update(['puntos' => $request->puntos, 'total_puntos' => $request->total_puntos]);
        return $actualizar;
    }
}
