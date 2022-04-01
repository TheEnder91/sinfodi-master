<?php

namespace App\Http\Controllers\Estimulos\Evaluaciones\DireccionCiencia;

use Illuminate\Http\Request;
use App\Traits\SingleResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Estimulos\EvaluacionDCiencia;

class FormacionRHDCController extends Controller
{
    use SingleResponse;

    const PERMISSIONS = [
        'index' => 'estimulo-evaluaciones-ciencia-formacion-index',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $criterios = self::Get_Criterios_transferencia();
        return view('estimulos.evaluaciones.direccionCiencia.formacion.index', compact('criterios'));
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
                            ->where('puesto', '=', 'Direccion_Ciencia')
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
                            ->where('TipoAlumno', '=', "Verano")
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
                            ->where('TipoAlumno', '=', "Servicio Social")
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
                            ->where('TipoAlumno', '=', "Practicas Profesionales")
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
                            ->where('TipoAlumno', '=', "Residencia Profesional")
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
                            ->where('TipoAlumno', '=', "Tesis de TSU")
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
                            ->where('TipoAlumno', '=', "Tesis de Licenciatura")
                            ->whereIn('id_asesor', $clave)
                            ->groupBy('id_asesor')
                            ->groupBy('Nom_asesor')
                            ->get();
        return $queryCriterio29;
    }

    public static function Evaluacion_Objetivo5_Criterio30_FormacionRH($clave, $inicial, $final){
        $queryCriterio30 = DB::connection('posgradoDB')->table('dfa_alumnos')
                            ->selectRaw('id_asesor AS numero_personal,
                                         Nom_asesor AS nombre')
                            ->whereBetween('Fecha_f', [$inicial, $final])
                            ->where('Nivel', '=', "Tesis de Maestría")
                            ->whereIn('id_asesor', $clave)
                            ->groupBy('id_asesor')
                            ->groupBy('Nom_asesor')
                            ->get();
        return $queryCriterio30;
    }

    public static function Evaluacion_Objetivo5_Criterio31_FormacionRH($clave, $inicial, $final){
        $queryCriterio31 = DB::connection('posgradoDB')->table('dfa_alumnos')
                            ->selectRaw('id_asesor AS numero_personal,
                                         Nom_asesor AS nombre')
                            ->whereBetween('Fecha_f', [$inicial, $final])
                            ->where('Nivel', '=', "Tesis de Doctorado")
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
    public function datosFormacionRH($year, $criterio)
    {
        if($criterio == 24){
            $datos = DB::table('sinfodi_evaluacion_ciencia')->where('year', '=', $year)->where('id_criterio', '=', $criterio)->get();
        }elseif($criterio == 25){
            $datos = DB::table('sinfodi_evaluacion_ciencia')->where('year', '=', $year)->where('id_criterio', '=', $criterio)->get();
        }elseif($criterio == 26){
            $datos = DB::table('sinfodi_evaluacion_ciencia')->where('year', '=', $year)->where('id_criterio', '=', $criterio)->get();
        }elseif($criterio == 27){
            $datos = DB::table('sinfodi_evaluacion_ciencia')->where('year', '=', $year)->where('id_criterio', '=', $criterio)->get();
        }elseif($criterio == 28){
            $datos = DB::table('sinfodi_evaluacion_ciencia')->where('year', '=', $year)->where('id_criterio', '=', $criterio)->get();
        }elseif($criterio == 29){
            $datos = DB::table('sinfodi_evaluacion_ciencia')->where('year', '=', $year)->where('id_criterio', '=', $criterio)->get();
        }elseif($criterio == 30){
            $datos = DB::table('sinfodi_evaluacion_ciencia')->where('year', '=', $year)->where('id_criterio', '=', $criterio)->get();
        }elseif($criterio == 31){
            $datos = DB::table('sinfodi_evaluacion_ciencia')->where('year', '=', $year)->where('id_criterio', '=', $criterio)->get();
        }
        $data['response'] = $datos;
        return $this->response($data);
    }
}
