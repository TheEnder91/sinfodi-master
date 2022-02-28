<?php

namespace App\Http\Controllers\Estimulos\Evaluaciones\DireccionGeneral;

use Illuminate\Http\Request;
use App\Traits\SingleResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Estimulos\EvaluacionDGeneral;
use App\Models\Estimulos\HelpPosgrado;

class PosgradoDGController extends Controller
{
    use SingleResponse;

    const PERMISSIONS = [
        'index' => 'estimulo-evaluaciones-direccionGral-posgrado-index',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /** Obtenemos los participantes de la direccion general... */
        $queryEvaluados = DB::table('sinfodi_evaluados')
                            ->select('clave', 'puesto')
                            ->whereIn('puesto', ['Direccion_General', 'Direccion_Ciencia', 'Direccion_Admin', 'Direccion_Posgrado'])
                            ->orderby('clave', 'ASC')
                            ->get();
        foreach($queryEvaluados as $itemEvaluados){
            $clave[] = $itemEvaluados->clave;
        }
        /** Obtenemos las fechas del año a evaluar... */
        $ultimoAño = date('Y');
        $añoEvaluado = $ultimoAño - 1;
        $fechaInicial = $añoEvaluado.'-01-01';
        $fechaFinal = $añoEvaluado.'-12-31';
        /** Obtenemos los criterios... */
        $criterios = self::Get_Criterios_Posgrado();
        //Criterio2...
        $evaluacion_Criterio2 = self::Evaluacion_criterio2($clave, $fechaInicial, $fechaFinal, 2);
        self::SaveEvaluaciones($evaluacion_Criterio2, 2, 2, "DireccionGral", $añoEvaluado);
        $GetCriterio2 = self::GetEvaluados(2, $añoEvaluado);
        $GetEvidenciasCriterio2 = self::Get_Evidencias_Criterio2($clave, $fechaInicial, $fechaFinal);
        //criterio3...
        $evaluacion_criterio3 = self::Evaluacion_criterio3($clave, $fechaInicial, $fechaFinal, 3);
        self::SaveEvaluaciones($evaluacion_criterio3, 2, 3, "DireccionGral", $añoEvaluado);
        $GetCriterio3 = self::GetEvaluados(3, $añoEvaluado);
        $GetEvidenciasCriterio3 = self::Get_Evidencias_Criterio3($clave, $fechaInicial, $fechaFinal);
        //criterio4...
        $evaluacion_criterio4 = self::Evaluacion_criterio4($clave, $fechaInicial, $fechaFinal, 4);
        self::SaveEvaluaciones($evaluacion_criterio4, 2, 4, "DireccionGral", $añoEvaluado);
        $GetCriterio4 = self::GetEvaluados(4, $añoEvaluado);
        $GetEvidenciasCriterio4 = self::Get_Evidencias_Criterio4($clave, $fechaInicial, $fechaFinal);
        //criterio5...
        $evaluacion_criterio5 = self::Evaluacion_criterio5($clave, $fechaInicial, $fechaFinal, 5);
        self::SaveEvaluaciones($evaluacion_criterio5, 2, 5, "DireccionGral", $añoEvaluado);
        $GetCriterio5 = self::GetEvaluados(5, $añoEvaluado);
        $GetEvidenciasCriterio5 = self::Get_Evidencias_Criterio5($clave, $fechaInicial, $fechaFinal);
        return view('estimulos.evaluaciones.direcionGeneral.posgrado.index', [
            'criterios' => $criterios,
            'datosCriterio2' => $GetCriterio2,
            'evidenciasCriterio2' => $GetEvidenciasCriterio2,
            'datosCriterio3' => $GetCriterio3,
            'evidenciasCriterio3' => $GetEvidenciasCriterio3,
            'datosCriterio4' => $GetCriterio4,
            'evidenciasCriterio4' => $GetEvidenciasCriterio4,
            'datosCriterio5' => $GetCriterio5,
            'evidenciasCriterio5' => $GetEvidenciasCriterio5,
        ]);
    }

    /** Funcion para obtener los criterios... */
    public static function Get_Criterios_Posgrado(){
        $query = DB::table('sinfodi_criterios')
                    ->select('id', 'nombre', 'id_objetivo')
                    ->where('observaciones', '=', 'Tabla 1. Actividad A.')
                    ->where('id_objetivo', '=', 2)
                    ->get();
        return $query;
    }

    /** Funcion para obtener a los evaluados... */
    public static function GetEvaluados($criterio, $añoEvaluado){
        $GetEvaluados = DB::table('sinfodi_evaluacion_general')
                            ->select('clave', 'nombre', 'puntos', 'total_puntos', 'year', 'username')
                            ->where('id_criterio', '=', $criterio)
                            ->where('year', '=', $añoEvaluado)
                            ->get();
        return $GetEvaluados;
    }

    /** Funcion para guardar a los evaluados correpondientes de la direccion general para el criterio 2... */
    public static function SaveEvaluaciones($datos, $id_objetivo, $id_criterio, $direccion, $añoEvaluado){
        if(!empty($datos)){
            foreach($datos as $itemSaveEvaluados){
                $saveDatos[] = [
                    'clave' => $itemSaveEvaluados->clave,
                    'nombre' => $itemSaveEvaluados->nombre,
                    'id_objetivo' => $id_objetivo,
                    'id_criterio' => $id_criterio,
                    'direccion' => $direccion,
                    'puntos' => $itemSaveEvaluados->total,
                    'total_puntos' => $itemSaveEvaluados->total_puntos,
                    'year' => $añoEvaluado,
                    'username' => $itemSaveEvaluados->username,
                ];
            }
            $queryValidar = DB::table('sinfodi_evaluacion_general')
                                ->where('year', '=', $añoEvaluado)
                                ->where('id_criterio', '=', $id_criterio)
                                ->get();
            if(count($queryValidar) >= 1){
                if(DB::table('sinfodi_evaluacion_general')->where('year', '=', $añoEvaluado)->where('id_criterio', '=', $id_criterio)->delete()){
                    $saveEvaluados = new EvaluacionDGeneral();
                    $saveEvaluados->insert($saveDatos);
                    return $saveDatos;
                }else{
                    return "Hubo un problema, recarge la pagina o llame a soporte.";
                }
            }else{
                $saveEvaluados = new EvaluacionDGeneral();
                $saveEvaluados->insert($saveDatos);
                return $saveDatos;
            }
        }
    }

    /** Funcion para obtener a las evaluaciones de los participantes para el criterio 2... */
    public static function Evaluacion_criterio2($clave, $inicial, $final, $id_criterio){
        $queryPuntosCriterio2 = DB::table('sinfodi_criterios')
                                    ->selectRaw('puntos')
                                    ->where('id', '=', 2)
                                    ->get();
        foreach($queryPuntosCriterio2 as $item){
            $item = $item->puntos;
        }
        $queryCriterio2 = DB::connection('posgradoDB')->table('dfa_alumnos')
                            ->selectRaw('id_asesor AS numero_personal,
                                         Nom_asesor AS nombre,
                                         COUNT(id_asesor) AS total,
                                         COUNT(*) * ('.$item.') AS total_puntos')
                            ->whereBetween('Fecha_f', [$inicial, $final])
                            ->where('Nivel', '=', "Tesis de Maestría")
                            ->whereRaw('TIMESTAMPDIFF(MONTH, Fecha_i, Fecha_f) BETWEEN 20 AND 30')
                            ->whereIn('id_asesor', $clave)
                            ->groupBy('id_asesor')
                            ->groupBy('Nom_asesor')
                            ->get();
        foreach($queryCriterio2 as $itemPosgrado){
            $datosPosgrado[] = [
                'clave' => $itemPosgrado->numero_personal,
                'nombre' => $itemPosgrado->nombre,
                'puntos' => $itemPosgrado->total,
                'total_puntos' => $itemPosgrado->total_puntos,
                'id_criterio' => $id_criterio,
            ];
        }
        if(!empty($datosPosgrado)){
            $queryValidar = DB::table('sinfodi_help_posgrado')
                                ->where('id_criterio', '=', $id_criterio)
                                ->get();
            if(count($queryValidar) >= 1){
                if(DB::table('sinfodi_help_posgrado')->where('id_criterio', '=', $id_criterio)->delete()){
                    $saveEvaluados = new HelpPosgrado();
                    $saveEvaluados->insert($datosPosgrado);
                }else{
                    return "Hubo un problema, recarge la pagina o llame a soporte.";
                }
            }else{
                $saveEvaluados = new HelpPosgrado();
                $saveEvaluados->insert($datosPosgrado);
            }
            $queryDatosReal = DB::table('sinfodi_help_posgrado')
                                ->selectRaw('sinfodi_evaluados.clave AS clave,
                                             sinfodi_evaluados.nombre AS nombre,
                                             sinfodi_evaluados.usuario AS username,
                                             sinfodi_help_posgrado.puntos AS total,
                                             sinfodi_help_posgrado.total_puntos as total_puntos')
                                ->leftJoin('sinfodi_evaluados', 'sinfodi_evaluados.clave', '=', 'sinfodi_help_posgrado.clave')
                                ->where('sinfodi_help_posgrado.id_criterio', '=', $id_criterio)
                                ->orderBy('sinfodi_evaluados.clave', 'ASC')
                                ->distinct()
                                ->get();
            return $queryDatosReal;
        }
    }

    /** Funcion para obtener las evidencias del criterio 2... */
    public static function Get_Evidencias_Criterio2($clave, $inicial, $final){
        $queryEvidenciasCriterio2 = DB::connection('posgradoDB')->table('dfa_alumnos')
                                        ->select('id_asesor AS numero_personal', 'Nom_asesor AS nombre', 'Evidencia AS documentacion')
                                        ->whereBetween('Fecha_f', [$inicial, $final])
                                        ->where('Nivel', '=', "Tesis de Maestría")
                                        ->whereRaw('TIMESTAMPDIFF(MONTH, Fecha_i, Fecha_f) BETWEEN 20 AND 30')
                                        ->whereIn('id_asesor', $clave)
                                        ->get();
        return $queryEvidenciasCriterio2;
    }

    /** Funcion para obtener a las evaluaciones de los participantes para el criterio 3... */
    public static function Evaluacion_criterio3($clave, $inicial, $final, $id_criterio){
        $queryPuntosCriterio2 = DB::table('sinfodi_criterios')
                                    ->selectRaw('puntos')
                                    ->where('id', '=', 2)
                                    ->get();
        foreach($queryPuntosCriterio2 as $item){
            $item = $item->puntos;
        }
        $queryCriterio2 = DB::connection('posgradoDB')->table('dfa_alumnos')
                            ->selectRaw('id_asesor AS numero_personal,
                                         Nom_asesor AS nombre,
                                         COUNT(id_asesor) AS total,
                                         COUNT(*) * ('.$item.') AS total_puntos')
                            ->whereBetween('Fecha_f', [$inicial, $final])
                            ->where('Nivel', '=', "Tesis de Maestría")
                            ->whereRaw('TIMESTAMPDIFF(MONTH, Fecha_i, Fecha_f) BETWEEN 31 AND 36')
                            ->whereIn('id_asesor', $clave)
                            ->groupBy('id_asesor')
                            ->groupBy('Nom_asesor')
                            ->get();
        foreach($queryCriterio2 as $itemPosgrado){
            $datosPosgrado[] = [
                'clave' => $itemPosgrado->numero_personal,
                'nombre' => $itemPosgrado->nombre,
                'puntos' => $itemPosgrado->total,
                'total_puntos' => $itemPosgrado->total_puntos,
                'id_criterio' => $id_criterio,
            ];
        }
        if(!empty($datosPosgrado)){
            $queryValidar = DB::table('sinfodi_help_posgrado')
                                ->where('id_criterio', '=', $id_criterio)
                                ->get();
            if(count($queryValidar) >= 1){
                if(DB::table('sinfodi_help_posgrado')->where('id_criterio', '=', $id_criterio)->delete()){
                    $saveEvaluados = new HelpPosgrado();
                    $saveEvaluados->insert($datosPosgrado);
                }else{
                    return "Hubo un problema, recarge la pagina o llame a soporte.";
                }
            }else{
                $saveEvaluados = new HelpPosgrado();
                $saveEvaluados->insert($datosPosgrado);
            }
            $queryDatosReal = DB::table('sinfodi_help_posgrado')
                                ->selectRaw('sinfodi_evaluados.clave AS clave,
                                             sinfodi_evaluados.nombre AS nombre,
                                             sinfodi_evaluados.usuario AS username,
                                             sinfodi_help_posgrado.puntos AS total,
                                             sinfodi_help_posgrado.total_puntos as total_puntos')
                                ->leftJoin('sinfodi_evaluados', 'sinfodi_evaluados.clave', '=', 'sinfodi_help_posgrado.clave')
                                ->where('sinfodi_help_posgrado.id_criterio', '=', $id_criterio)
                                ->orderBy('sinfodi_evaluados.clave', 'ASC')
                                ->distinct()
                                ->get();
            return $queryDatosReal;
        }
    }

    /** Funcion para obtener las evidencias del criterio ... */
    public static function Get_Evidencias_Criterio3($clave, $inicial, $final){
        $queryEvidenciasCriterio2 = DB::connection('posgradoDB')->table('dfa_alumnos')
                                        ->select('id_asesor AS numero_personal', 'Nom_asesor AS nombre', 'Evidencia AS documentacion')
                                        ->whereBetween('Fecha_f', [$inicial, $final])
                                        ->where('Nivel', '=', "Tesis de Maestría")
                                        ->whereRaw('TIMESTAMPDIFF(MONTH, Fecha_i, Fecha_f) BETWEEN 31 AND 36')
                                        ->whereIn('id_asesor', $clave)
                                        ->get();
        return $queryEvidenciasCriterio2;
    }

    /** Funcion para obtener a las evaluaciones de los participantes para el criterio 4... */
    public static function Evaluacion_criterio4($clave, $inicial, $final, $id_criterio){
        $queryPuntosCriterio2 = DB::table('sinfodi_criterios')
                                    ->selectRaw('puntos')
                                    ->where('id', '=', 2)
                                    ->get();
        foreach($queryPuntosCriterio2 as $item){
            $item = $item->puntos;
        }
        $queryCriterio2 = DB::connection('posgradoDB')->table('dfa_alumnos')
                            ->selectRaw('id_asesor AS numero_personal,
                                         Nom_asesor AS nombre,
                                         COUNT(id_asesor) AS total,
                                         COUNT(*) * ('.$item.') AS total_puntos')
                            ->whereBetween('Fecha_f', [$inicial, $final])
                            ->where('Nivel', '=', "Tesis de Doctorado")
                            ->whereRaw('TIMESTAMPDIFF(MONTH, Fecha_i, Fecha_f) BETWEEN 37 AND 42')
                            ->whereIn('id_asesor', $clave)
                            ->groupBy('id_asesor')
                            ->groupBy('Nom_asesor')
                            ->get();
        foreach($queryCriterio2 as $itemPosgrado){
            $datosPosgrado[] = [
                'clave' => $itemPosgrado->numero_personal,
                'nombre' => $itemPosgrado->nombre,
                'puntos' => $itemPosgrado->total,
                'total_puntos' => $itemPosgrado->total_puntos,
                'id_criterio' => $id_criterio,
            ];
        }
        if(!empty($datosPosgrado)){
            $queryValidar = DB::table('sinfodi_help_posgrado')
                                ->where('id_criterio', '=', $id_criterio)
                                ->get();
            if(count($queryValidar) >= 1){
                if(DB::table('sinfodi_help_posgrado')->where('id_criterio', '=', $id_criterio)->delete()){
                    $saveEvaluados = new HelpPosgrado();
                    $saveEvaluados->insert($datosPosgrado);
                }else{
                    return "Hubo un problema, recarge la pagina o llame a soporte.";
                }
            }else{
                $saveEvaluados = new HelpPosgrado();
                $saveEvaluados->insert($datosPosgrado);
            }
            $queryDatosReal = DB::table('sinfodi_help_posgrado')
                                ->selectRaw('sinfodi_evaluados.clave AS clave,
                                             sinfodi_evaluados.nombre AS nombre,
                                             sinfodi_evaluados.usuario AS username,
                                             sinfodi_help_posgrado.puntos AS total,
                                             sinfodi_help_posgrado.total_puntos as total_puntos')
                                ->leftJoin('sinfodi_evaluados', 'sinfodi_evaluados.clave', '=', 'sinfodi_help_posgrado.clave')
                                ->where('sinfodi_help_posgrado.id_criterio', '=', $id_criterio)
                                ->orderBy('sinfodi_evaluados.clave', 'ASC')
                                ->distinct()
                                ->get();
            return $queryDatosReal;
        }
    }

    /** Funcion para obtener las evidencias del criterio ... */
    public static function Get_Evidencias_Criterio4($clave, $inicial, $final){
        $queryEvidenciasCriterio2 = DB::connection('posgradoDB')->table('dfa_alumnos')
                                        ->select('id_asesor AS numero_personal', 'Nom_asesor AS nombre', 'Evidencia AS documentacion')
                                        ->whereBetween('Fecha_f', [$inicial, $final])
                                        ->where('Nivel', '=', "Tesis de Doctorado")
                                        ->whereRaw('TIMESTAMPDIFF(MONTH, Fecha_i, Fecha_f) BETWEEN 37 AND 42')
                                        ->whereIn('id_asesor', $clave)
                                        ->get();
        return $queryEvidenciasCriterio2;
    }

    /** Funcion para obtener a las evaluaciones de los participantes para el criterio 4... */
    public static function Evaluacion_criterio5($clave, $inicial, $final, $id_criterio){
        $queryPuntosCriterio2 = DB::table('sinfodi_criterios')
                                    ->selectRaw('puntos')
                                    ->where('id', '=', 2)
                                    ->get();
        foreach($queryPuntosCriterio2 as $item){
            $item = $item->puntos;
        }
        $queryCriterio2 = DB::connection('posgradoDB')->table('dfa_alumnos')
                            ->selectRaw('id_asesor AS numero_personal,
                                         Nom_asesor AS nombre,
                                         COUNT(id_asesor) AS total,
                                         COUNT(*) * ('.$item.') AS total_puntos')
                            ->whereBetween('Fecha_f', [$inicial, $final])
                            ->where('Nivel', '=', "Tesis de Doctorado")
                            ->whereRaw('TIMESTAMPDIFF(MONTH, Fecha_i, Fecha_f) BETWEEN 43 AND 48')
                            ->whereIn('id_asesor', $clave)
                            ->groupBy('id_asesor')
                            ->groupBy('Nom_asesor')
                            ->get();
        foreach($queryCriterio2 as $itemPosgrado){
            $datosPosgrado[] = [
                'clave' => $itemPosgrado->numero_personal,
                'nombre' => $itemPosgrado->nombre,
                'puntos' => $itemPosgrado->total,
                'total_puntos' => $itemPosgrado->total_puntos,
                'id_criterio' => $id_criterio,
            ];
        }
        if(!empty($datosPosgrado)){
            $queryValidar = DB::table('sinfodi_help_posgrado')
                                ->where('id_criterio', '=', $id_criterio)
                                ->get();
            if(count($queryValidar) >= 1){
                if(DB::table('sinfodi_help_posgrado')->where('id_criterio', '=', $id_criterio)->delete()){
                    $saveEvaluados = new HelpPosgrado();
                    $saveEvaluados->insert($datosPosgrado);
                }else{
                    return "Hubo un problema, recarge la pagina o llame a soporte.";
                }
            }else{
                $saveEvaluados = new HelpPosgrado();
                $saveEvaluados->insert($datosPosgrado);
            }
            $queryDatosReal = DB::table('sinfodi_help_posgrado')
                                ->selectRaw('sinfodi_evaluados.clave AS clave,
                                             sinfodi_evaluados.nombre AS nombre,
                                             sinfodi_evaluados.usuario AS username,
                                             sinfodi_help_posgrado.puntos AS total,
                                             sinfodi_help_posgrado.total_puntos as total_puntos')
                                ->leftJoin('sinfodi_evaluados', 'sinfodi_evaluados.clave', '=', 'sinfodi_help_posgrado.clave')
                                ->where('sinfodi_help_posgrado.id_criterio', '=', $id_criterio)
                                ->orderBy('sinfodi_evaluados.clave', 'ASC')
                                ->distinct()
                                ->get();
            return $queryDatosReal;
        }
    }

    /** Funcion para obtener las evidencias del criterio ... */
    public static function Get_Evidencias_Criterio5($clave, $inicial, $final){
        $queryEvidenciasCriterio2 = DB::connection('posgradoDB')->table('dfa_alumnos')
                                        ->select('id_asesor AS numero_personal', 'Nom_asesor AS nombre', 'Evidencia AS documentacion')
                                        ->whereBetween('Fecha_f', [$inicial, $final])
                                        ->where('Nivel', '=', "Tesis de Doctorado")
                                        ->whereRaw('TIMESTAMPDIFF(MONTH, Fecha_i, Fecha_f) BETWEEN 43 AND 48')
                                        ->whereIn('id_asesor', $clave)
                                        ->get();
        return $queryEvidenciasCriterio2;
    }



    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  int  $year
    //  * @return \Illuminate\Http\Response
    //  */
    // public function search($year)
    // {
    //     $queryEvaluados = DB::table('sinfodi_evaluados')
    //                         ->select('clave', 'puesto')
    //                         ->where('puesto', '=', 'Direccion_General')
    //                         ->orderby('clave', 'ASC')
    //                         ->get();
    //     foreach($queryEvaluados as $itemEvaluados){
    //         $clave[] = $itemEvaluados->clave;
    //     }
    //     $fechaInicial = $year.'-01-01';
    //     $fechaFinal = $year.'-12-31';
    //     $evaluaciones2 = self::Evaluaciones_Posgrado($clave, $fechaInicial, $fechaFinal);
    //     $data['response'] = $evaluaciones2;
    //     return $this->response($data);
    // }

    // /** Codigo personal... */
    // public static function Evaluaciones_Posgrado($clave, $inicial, $final){
    //     $queryCriterio2 = DB::connection('posgradoDB')->table('dfa_alumnos')
    //                         ->selectRaw('id_asesor AS numero_personal,
    //                                      Nom_asesor AS nombre')
    //                         ->whereBetween('Fecha_f', [$inicial, $final])
    //                         ->where('Nivel', '=', "Tesis de Maestría")
    //                         ->whereRaw('TIMESTAMPDIFF(MONTH, Fecha_i, Fecha_f) BETWEEN 20 AND 30')
    //                         ->whereIn('id_asesor', $clave)
    //                         ->get();
    //     return $queryCriterio2;
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function saveDatos(Request $request)
    // {
    //     if(EvaluacionDGeneral::where('clave', '=', $request->clave)->where('year', '=', $request->year)->count() == 0){
    //         $nuevo = new EvaluacionDGeneral();
    //         $nuevo->create($request->all());
    //         $data['response'] = true;
    //         return $this->response($data);
    //     }
    // }
}
