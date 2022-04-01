<?php

namespace App\Http\Controllers\Estimulos\Evaluaciones\DireccionPosgrado;

use Illuminate\Http\Request;
use App\Traits\SingleResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Estimulos\EvaluacionDPosgrado;

class TransferenciaDPController extends Controller
{
    use SingleResponse;

    const PERMISSIONS = [
        'index' => 'estimulo-evaluaciones-posgrado-transferencia-index',
        'indexB' => 'estimulo-evaluaciones-posgrado-transferenciaB-index',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $criterios = self::Get_Criterios_transferencia();
        return view('estimulos.evaluaciones.direccionPosgrado.transferencia.index', compact('criterios'));
    }

    /** Funcion para obtener los criterios para la transferencia de conocimiento e innovación... */
    public static function Get_Criterios_transferencia(){
        $query = DB::table('sinfodi_criterios')
                    ->select('id', 'nombre', 'id_objetivo')
                    ->where('observaciones', '=', 'Tabla 1. Actividad A.')
                    ->where('id_objetivo', '=', 5)
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
                            ->where('puesto', '=', 'Direccion_Posgrado')
                            ->orderby('clave', 'ASC')
                            ->get();
        foreach($queryEvaluados as $itemEvaluados){
            $clave[] = $itemEvaluados->clave;
        }
        $fechaInicial = $year.'-01-01';
        $fechaFinal = $year.'-12-31';
        if($criterio == 15){
            $evaluacion_transferencia = self::Evaluacion_Objetivo5_Criterio15_TransferenciaConocimiento($clave, $fechaInicial, $fechaFinal);
        }elseif($criterio == 16){
            $evaluacion_transferencia = self::Evaluacion_Objetivo5_Criterio16_TransferenciaConocimiento($clave, $fechaInicial, $fechaFinal);
        }elseif($criterio == 17){
            $evaluacion_transferencia = self::Evaluacion_Objetivo5_Criterio17_TransferenciaConocimiento($clave, $fechaInicial, $fechaFinal);
        }elseif($criterio == 18){
            $evaluacion_transferencia = self::Evaluacion_Objetivo5_Criterio18_TransferenciaConocimiento($clave, $fechaInicial, $fechaFinal);
        }elseif($criterio == 19){
            $evaluacion_transferencia = self::Evaluacion_Objetivo5_Criterio19_TransferenciaConocimiento($clave, $fechaInicial, $fechaFinal);
        }elseif($criterio == 20){
            $evaluacion_transferencia = self::Evaluacion_Objetivo5_Criterio20_TransferenciaConocimiento($clave, $fechaInicial, $fechaFinal);
        }elseif($criterio == 21){
            $evaluacion_transferencia = self::Evaluacion_Objetivo5_Criterio21_TransferenciaConocimiento($clave, $fechaInicial, $fechaFinal);
        }elseif($criterio == 22){
            $evaluacion_transferencia = self::Evaluacion_Objetivo5_Criterio22_TransferenciaConocimiento($clave, $fechaInicial, $fechaFinal);
        }elseif($criterio == 23){
            $evaluacion_transferencia = self::Evaluacion_Objetivo5_Criterio23_TransferenciaConocimiento($clave, $fechaInicial, $fechaFinal);
        }
        $data['response'] = $evaluacion_transferencia;
        return $this->response($data);
    }

    public static function Evaluacion_Objetivo5_Criterio15_TransferenciaConocimiento($clave, $inicial, $final){
        $query = DB::connection('sinfodiDB')->table('sinfodidb.sinfodi_pat_personas')
                    ->selectRaw('sinfodidb.sinfodi_pat_personas.pat_clave_persona AS numero_personal,
                                 sinfodidb.sinfodi_pat_personas.pat_nombre AS nombre,
                                 productivo_sinfodi.sinfodi_evaluados.usuario AS username')
                    ->leftJoin('productivo_sinfodi.sinfodi_evaluados', 'productivo_sinfodi.sinfodi_evaluados.clave', '=', 'sinfodidb.sinfodi_pat_personas.pat_clave_persona')
                    ->leftJoin('sinfodidb.sinfodi_pat', 'sinfodidb.sinfodi_pat.pat_clave', '=', 'sinfodidb.sinfodi_pat_personas.pat_clave_pat_persona')
                    ->where('sinfodidb.sinfodi_pat.pat_eliminado', '=', 0)
                    ->where('sinfodidb.sinfodi_pat_personas.pat_clave_persona', '<>', 0)
                    ->where('sinfodidb.sinfodi_pat.pat_tipo', '=', 1)
                    ->where('sinfodidb.sinfodi_pat.pat_status', '=', 1)
                    ->whereBetween('sinfodidb.sinfodi_pat.pat_fecha', [$inicial, $final])
                    ->whereIn('sinfodidb.sinfodi_pat_personas.pat_clave_persona', $clave)
                    ->groupBy('sinfodidb.sinfodi_pat_personas.pat_clave_persona')
                    ->groupBy('sinfodidb.sinfodi_pat_personas.pat_nombre')
                    ->groupBy('productivo_sinfodi.sinfodi_evaluados.usuario')
                    ->get();
        return $query;
    }

    public static function Evaluacion_Objetivo5_Criterio16_TransferenciaConocimiento($clave, $inicial, $final){
        $query = DB::connection('sinfodiDB')->table('sinfodidb.sinfodi_pat_personas')
                    ->selectRaw('sinfodidb.sinfodi_pat_personas.pat_clave_persona AS numero_personal,
                                 sinfodidb.sinfodi_pat_personas.pat_nombre AS nombre,
                                 productivo_sinfodi.sinfodi_evaluados.usuario AS username')
                    ->leftJoin('productivo_sinfodi.sinfodi_evaluados', 'productivo_sinfodi.sinfodi_evaluados.clave', '=', 'sinfodidb.sinfodi_pat_personas.pat_clave_persona')
                    ->leftJoin('sinfodidb.sinfodi_pat', 'sinfodidb.sinfodi_pat.pat_clave', '=', 'sinfodidb.sinfodi_pat_personas.pat_clave_pat_persona')
                    ->where('sinfodidb.sinfodi_pat.pat_eliminado', '=', 0)
                    ->where('sinfodidb.sinfodi_pat_personas.pat_clave_persona', '<>', 0)
                    ->where('sinfodidb.sinfodi_pat.pat_tipo', '=', 2)
                    ->where('sinfodidb.sinfodi_pat.pat_status', '=', 1)
                    ->whereBetween('sinfodidb.sinfodi_pat.pat_fecha', [$inicial, $final])
                    ->whereIn('sinfodidb.sinfodi_pat_personas.pat_clave_persona', $clave)
                    ->groupBy('sinfodidb.sinfodi_pat_personas.pat_clave_persona')
                    ->groupBy('sinfodidb.sinfodi_pat_personas.pat_nombre')
                    ->groupBy('productivo_sinfodi.sinfodi_evaluados.usuario')
                    ->get();
        return $query;
    }

    public static function Evaluacion_Objetivo5_Criterio17_TransferenciaConocimiento($clave, $inicial, $final){
        $query = DB::connection('sinfodiDB')->table('sinfodidb.sinfodi_pat_personas')
                    ->selectRaw('sinfodidb.sinfodi_pat_personas.pat_clave_persona AS numero_personal,
                                 sinfodidb.sinfodi_pat_personas.pat_nombre AS nombre,
                                 productivo_sinfodi.sinfodi_evaluados.usuario AS username')
                    ->leftJoin('productivo_sinfodi.sinfodi_evaluados', 'productivo_sinfodi.sinfodi_evaluados.clave', '=', 'sinfodidb.sinfodi_pat_personas.pat_clave_persona')
                    ->leftJoin('sinfodidb.sinfodi_pat', 'sinfodidb.sinfodi_pat.pat_clave', '=', 'sinfodidb.sinfodi_pat_personas.pat_clave_pat_persona')
                    ->where('sinfodidb.sinfodi_pat.pat_eliminado', '=', 0)
                    ->where('sinfodidb.sinfodi_pat_personas.pat_clave_persona', '<>', 0)
                    ->where('sinfodidb.sinfodi_pat.pat_tipo', '=', 2)
                    ->where('sinfodidb.sinfodi_pat.pat_status', '=', 2)
                    ->whereBetween('sinfodidb.sinfodi_pat.pat_fecha', [$inicial, $final])
                    ->whereIn('sinfodidb.sinfodi_pat_personas.pat_clave_persona', $clave)
                    ->groupBy('sinfodidb.sinfodi_pat_personas.pat_clave_persona')
                    ->groupBy('sinfodidb.sinfodi_pat_personas.pat_nombre')
                    ->groupBy('productivo_sinfodi.sinfodi_evaluados.usuario')
                    ->get();
        return $query;
    }

    public static function Evaluacion_Objetivo5_Criterio18_TransferenciaConocimiento($clave, $inicial, $final){
        $query = DB::connection('sinfodiDB')->table('sinfodidb.sinfodi_pat_personas')
                    ->selectRaw('sinfodidb.sinfodi_pat_personas.pat_clave_persona AS numero_personal,
                                 sinfodidb.sinfodi_pat_personas.pat_nombre AS nombre,
                                 productivo_sinfodi.sinfodi_evaluados.usuario AS username,
                                 COUNT(*) AS total,
                                 COUNT(*) * (SELECT puntos FROM productivo_sinfodi.sinfodi_criterios WHERE id = 18) AS total_puntos')
                    ->leftJoin('productivo_sinfodi.sinfodi_evaluados', 'productivo_sinfodi.sinfodi_evaluados.clave', '=', 'sinfodidb.sinfodi_pat_personas.pat_clave_persona')
                    ->leftJoin('sinfodidb.sinfodi_pat', 'sinfodidb.sinfodi_pat.pat_clave', '=', 'sinfodidb.sinfodi_pat_personas.pat_clave_pat_persona')
                    ->where('sinfodidb.sinfodi_pat.pat_eliminado', '=', 0)
                    ->where('sinfodidb.sinfodi_pat_personas.pat_clave_persona', '<>', 0)
                    ->where('sinfodidb.sinfodi_pat.pat_tipo', '=', 3)
                    ->where('sinfodidb.sinfodi_pat.pat_status', '=', 1)
                    ->whereBetween('sinfodidb.sinfodi_pat.pat_fecha', [$inicial, $final])
                    ->whereIn('sinfodidb.sinfodi_pat_personas.pat_clave_persona', $clave)
                    ->groupBy('sinfodidb.sinfodi_pat_personas.pat_clave_persona')
                    ->groupBy('sinfodidb.sinfodi_pat_personas.pat_nombre')
                    ->groupBy('productivo_sinfodi.sinfodi_evaluados.usuario')
                    ->get();
        return $query;
    }

    public static function Evaluacion_Objetivo5_Criterio19_TransferenciaConocimiento($clave, $inicial, $final){
        $query = DB::connection('sinfodiDB')->table('sinfodidb.sinfodi_pat_personas')
                    ->selectRaw('sinfodidb.sinfodi_pat_personas.pat_clave_persona AS numero_personal,
                                 sinfodidb.sinfodi_pat_personas.pat_nombre AS nombre,
                                 productivo_sinfodi.sinfodi_evaluados.usuario AS username')
                    ->leftJoin('productivo_sinfodi.sinfodi_evaluados', 'productivo_sinfodi.sinfodi_evaluados.clave', '=', 'sinfodidb.sinfodi_pat_personas.pat_clave_persona')
                    ->leftJoin('sinfodidb.sinfodi_pat', 'sinfodidb.sinfodi_pat.pat_clave', '=', 'sinfodidb.sinfodi_pat_personas.pat_clave_pat_persona')
                    ->where('sinfodidb.sinfodi_pat.pat_eliminado', '=', 0)
                    ->where('sinfodidb.sinfodi_pat_personas.pat_clave_persona', '<>', 0)
                    ->where('sinfodidb.sinfodi_pat.pat_tipo', '=', 3)
                    ->where('sinfodidb.sinfodi_pat.pat_status', '=', 1)
                    ->whereBetween('sinfodidb.sinfodi_pat.pat_fecha', [$inicial, $final])
                    ->whereIn('sinfodidb.sinfodi_pat_personas.pat_clave_persona', $clave)
                    ->groupBy('sinfodidb.sinfodi_pat_personas.pat_clave_persona')
                    ->groupBy('sinfodidb.sinfodi_pat_personas.pat_nombre')
                    ->groupBy('productivo_sinfodi.sinfodi_evaluados.usuario')
                    ->get();
        return $query;
    }

    public static function Evaluacion_Objetivo5_Criterio20_TransferenciaConocimiento($clave, $inicial, $final){
        $query = DB::connection('sinfodiDB')->table('sinfodidb.sinfodi_pat_personas')
                    ->selectRaw('sinfodidb.sinfodi_pat_personas.pat_clave_persona AS numero_personal,
                                 sinfodidb.sinfodi_pat_personas.pat_nombre AS nombre,
                                 productivo_sinfodi.sinfodi_evaluados.usuario AS username')
                    ->leftJoin('productivo_sinfodi.sinfodi_evaluados', 'productivo_sinfodi.sinfodi_evaluados.clave', '=', 'sinfodidb.sinfodi_pat_personas.pat_clave_persona')
                    ->leftJoin('sinfodidb.sinfodi_pat', 'sinfodidb.sinfodi_pat.pat_clave', '=', 'sinfodidb.sinfodi_pat_personas.pat_clave_pat_persona')
                    ->where('sinfodidb.sinfodi_pat.pat_eliminado', '=', 0)
                    ->where('sinfodidb.sinfodi_pat_personas.pat_clave_persona', '<>', 0)
                    ->where('sinfodidb.sinfodi_pat.pat_tipo', '=', 5)
                    ->where('sinfodidb.sinfodi_pat.pat_status', '=', 1)
                    ->whereBetween('sinfodidb.sinfodi_pat.pat_fecha', [$inicial, $final])
                    ->whereIn('sinfodidb.sinfodi_pat_personas.pat_clave_persona', $clave)
                    ->groupBy('sinfodidb.sinfodi_pat_personas.pat_clave_persona')
                    ->groupBy('sinfodidb.sinfodi_pat_personas.pat_nombre')
                    ->groupBy('productivo_sinfodi.sinfodi_evaluados.usuario')
                    ->get();
        return $query;
    }

    public static function Evaluacion_Objetivo5_Criterio21_TransferenciaConocimiento($clave, $inicial, $final){
        $query = DB::connection('sinfodiDB')->table('sinfodidb.sinfodi_pat_personas')
                    ->selectRaw('sinfodidb.sinfodi_pat_personas.pat_clave_persona AS numero_personal,
                                 sinfodidb.sinfodi_pat_personas.pat_nombre AS nombre')
                    ->leftJoin('productivo_sinfodi.sinfodi_evaluados', 'productivo_sinfodi.sinfodi_evaluados.clave', '=', 'sinfodidb.sinfodi_pat_personas.pat_clave_persona')
                    ->leftJoin('sinfodidb.sinfodi_pat', 'sinfodidb.sinfodi_pat.pat_clave', '=', 'sinfodidb.sinfodi_pat_personas.pat_clave_pat_persona')
                    ->where('sinfodidb.sinfodi_pat.pat_eliminado', '=', 0)
                    ->where('sinfodidb.sinfodi_pat_personas.pat_clave_persona', '<>', 0)
                    ->where('sinfodidb.sinfodi_pat.pat_tipo', '=', 5)
                    ->where('sinfodidb.sinfodi_pat.pat_status', '=', 2)
                    ->whereBetween('sinfodidb.sinfodi_pat.pat_fecha', [$inicial, $final])
                    ->whereIn('sinfodidb.sinfodi_pat_personas.pat_clave_persona', $clave)
                    ->groupBy('sinfodidb.sinfodi_pat_personas.pat_clave_persona')
                    ->groupBy('sinfodidb.sinfodi_pat_personas.pat_nombre')
                    ->groupBy('productivo_sinfodi.sinfodi_evaluados.usuario')
                    ->get();
        return $query;
    }

    public static function Evaluacion_Objetivo5_Criterio22_TransferenciaConocimiento($clave, $inicial, $final){
        $query = DB::connection('sinfodiDB')->table('sinfodidb.sinfodi_pat_personas')
                    ->selectRaw('sinfodidb.sinfodi_pat_personas.pat_clave_persona AS numero_personal,
                                 sinfodidb.sinfodi_pat_personas.pat_nombre AS nombre,
                                 productivo_sinfodi.sinfodi_evaluados.usuario AS username')
                    ->leftJoin('productivo_sinfodi.sinfodi_evaluados', 'productivo_sinfodi.sinfodi_evaluados.clave', '=', 'sinfodidb.sinfodi_pat_personas.pat_clave_persona')
                    ->leftJoin('sinfodidb.sinfodi_pat', 'sinfodidb.sinfodi_pat.pat_clave', '=', 'sinfodidb.sinfodi_pat_personas.pat_clave_pat_persona')
                    ->where('sinfodidb.sinfodi_pat.pat_eliminado', '=', 0)
                    ->where('sinfodidb.sinfodi_pat_personas.pat_clave_persona', '<>', 0)
                    ->where('sinfodidb.sinfodi_pat.pat_tipo', '=', 1)
                    ->where('sinfodidb.sinfodi_pat.pat_status', '=', 2)
                    ->whereBetween('sinfodidb.sinfodi_pat.pat_fecha', [$inicial, $final])
                    ->whereIn('sinfodidb.sinfodi_pat_personas.pat_clave_persona', $clave)
                    ->groupBy('sinfodidb.sinfodi_pat_personas.pat_clave_persona')
                    ->groupBy('sinfodidb.sinfodi_pat_personas.pat_nombre')
                    ->groupBy('productivo_sinfodi.sinfodi_evaluados.usuario')
                    ->get();
        return $query;
    }

    public static function Evaluacion_Objetivo5_Criterio23_TransferenciaConocimiento($clave, $inicial, $final){
        $query = DB::connection('sinfodiDB')->table('sinfodidb.sinfodi_pat_personas')
                    ->selectRaw('sinfodidb.sinfodi_pat_personas.pat_clave_persona AS numero_personal,
                                 sinfodidb.sinfodi_pat_personas.pat_nombre AS nombre,
                                 productivo_sinfodi.sinfodi_evaluados.usuario AS username')
                    ->leftJoin('productivo_sinfodi.sinfodi_evaluados', 'productivo_sinfodi.sinfodi_evaluados.clave', '=', 'sinfodidb.sinfodi_pat_personas.pat_clave_persona')
                    ->leftJoin('sinfodidb.sinfodi_pat', 'sinfodidb.sinfodi_pat.pat_clave', '=', 'sinfodidb.sinfodi_pat_personas.pat_clave_pat_persona')
                    ->where('sinfodidb.sinfodi_pat.pat_eliminado', '=', 0)
                    ->where('sinfodidb.sinfodi_pat_personas.pat_clave_persona', '<>', 0)
                    ->where('sinfodidb.sinfodi_pat.pat_tipo', '=', 3)
                    ->where('sinfodidb.sinfodi_pat.pat_status', '=', 4)
                    ->whereBetween('sinfodidb.sinfodi_pat.pat_fecha', [$inicial, $final])
                    ->whereIn('sinfodidb.sinfodi_pat_personas.pat_clave_persona', $clave)
                    ->groupBy('sinfodidb.sinfodi_pat_personas.pat_clave_persona')
                    ->groupBy('sinfodidb.sinfodi_pat_personas.pat_nombre')
                    ->groupBy('productivo_sinfodi.sinfodi_evaluados.usuario')
                    ->get();
        return $query;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveDatos(Request $request)
    {
        if(EvaluacionDPosgrado::where('clave', '=', $request->clave)->where('year', '=', $request->year)->where('id_criterio', '=', $request->id_criterio)->count() == 0){
            $nuevo = new EvaluacionDPosgrado();
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
    public function datosTransferencia($year, $criterio)
    {
        if($criterio == 15){
            $datos = DB::table('sinfodi_evaluacion_posgrado')->where('year', '=', $year)->where('id_criterio', '=', $criterio)->get();
        }elseif($criterio == 16){
            $datos = DB::table('sinfodi_evaluacion_posgrado')->where('year', '=', $year)->where('id_criterio', '=', $criterio)->get();
        }elseif($criterio == 17){
            $datos = DB::table('sinfodi_evaluacion_posgrado')->where('year', '=', $year)->where('id_criterio', '=', $criterio)->get();
        }elseif($criterio == 18){
            $datos = DB::table('sinfodi_evaluacion_posgrado')->where('year', '=', $year)->where('id_criterio', '=', $criterio)->get();
        }elseif($criterio == 19){
            $datos = DB::table('sinfodi_evaluacion_posgrado')->where('year', '=', $year)->where('id_criterio', '=', $criterio)->get();
        }elseif($criterio == 20){
            $datos = DB::table('sinfodi_evaluacion_posgrado')->where('year', '=', $year)->where('id_criterio', '=', $criterio)->get();
        }elseif($criterio == 21){
            $datos = DB::table('sinfodi_evaluacion_posgrado')->where('year', '=', $year)->where('id_criterio', '=', $criterio)->get();
        }elseif($criterio == 22){
            $datos = DB::table('sinfodi_evaluacion_posgrado')->where('year', '=', $year)->where('id_criterio', '=', $criterio)->get();
        }elseif($criterio == 23){
            $datos = DB::table('sinfodi_evaluacion_posgrado')->where('year', '=', $year)->where('id_criterio', '=', $criterio)->get();
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
        if($criterio == 15){
            $evidencias = self::Get_Evidencias_Obj5_Criterio15_TransferenciaConocimiento($clave, $fechaInicial, $fechaFinal);
        }elseif($criterio == 16){
            $evidencias = self::Get_Evidencias_Obj5_Criterio16_TransferenciaConocimiento($clave, $fechaInicial, $fechaFinal);
        }elseif($criterio == 17){
            $evidencias = self::Get_Evidencias_Obj5_Criterio17_TransferenciaConocimiento($clave, $fechaInicial, $fechaFinal);
        }elseif($criterio == 18){
            $evidencias = self::Get_Evidencias_Obj5_Criterio18_TransferenciaConocimiento($clave, $fechaInicial, $fechaFinal);
        }elseif($criterio == 19){
            $evidencias = self::Get_Evidencias_Obj5_Criterio19_TransferenciaConocimiento($clave, $fechaInicial, $fechaFinal);
        }elseif($criterio == 20){
            $evidencias = self::Get_Evidencias_Obj5_Criterio20_TransferenciaConocimiento($clave, $fechaInicial, $fechaFinal);
        }elseif($criterio == 21){
            $evidencias = self::Get_Evidencias_Obj5_Criterio21_TransferenciaConocimiento($clave, $fechaInicial, $fechaFinal);
        }elseif($criterio == 22){
            $evidencias = self::Get_Evidencias_Obj5_Criterio22_TransferenciaConocimiento($clave, $fechaInicial, $fechaFinal);
        }elseif($criterio == 23){
            $evidencias = self::Get_Evidencias_Obj5_Criterio23_TransferenciaConocimiento($clave, $fechaInicial, $fechaFinal);
        }
        $data['response'] = $evidencias;
        return $this->response($data);
    }

    public static function Get_Evidencias_Obj5_Criterio15_TransferenciaConocimiento($clave, $inicial, $final){
        $query = DB::connection('sinfodiDB')->table('sinfodi_pat_personas')
                    ->select('sinfodi_pat_personas.pat_clave_persona AS numero_personal', 'sinfodi_pat_personas.pat_clave_pat_persona AS clave', 'sinfodi_pat.pat_status AS status')
                    ->leftJoin('sinfodi_pat', 'sinfodi_pat.pat_clave', '=', 'sinfodi_pat_personas.pat_clave_pat_persona')
                    ->where('sinfodi_pat.pat_eliminado', '=', 0)
                    ->where('sinfodi_pat_personas.pat_clave_persona', '<>', 0)
                    ->where('sinfodi_pat.pat_tipo', '=', 1)
                    ->where('sinfodi_pat.pat_status', '=', 1)
                    ->whereBetween('sinfodi_pat.pat_fecha', [$inicial, $final])
                    ->where('sinfodi_pat_personas.pat_clave_persona', '=', $clave)
                    ->orderBy('sinfodi_pat_personas.pat_clave_persona', 'ASC')
                    ->get();
        return $query;
    }

    public static function Get_Evidencias_Obj5_Criterio16_TransferenciaConocimiento($clave, $inicial, $final){
        $query = DB::connection('sinfodiDB')->table('sinfodi_pat_personas')
                    ->select('sinfodi_pat_personas.pat_clave_persona AS numero_personal', 'sinfodi_pat_personas.pat_clave_pat_persona AS clave', 'sinfodi_pat.pat_status AS status')
                    ->leftJoin('sinfodi_pat', 'sinfodi_pat.pat_clave', '=', 'sinfodi_pat_personas.pat_clave_pat_persona')
                    ->where('sinfodi_pat.pat_eliminado', '=', 0)
                    ->where('sinfodi_pat_personas.pat_clave_persona', '<>', 0)
                    ->where('sinfodi_pat.pat_tipo', '=', 2)
                    ->where('sinfodi_pat.pat_status', '=', 1)
                    ->whereBetween('sinfodi_pat.pat_fecha', [$inicial, $final])
                    ->where('sinfodi_pat_personas.pat_clave_persona', '=', $clave)
                    ->orderBy('sinfodi_pat_personas.pat_clave_persona', 'ASC')
                    ->get();
        return $query;
    }

    public static function Get_Evidencias_Obj5_Criterio17_TransferenciaConocimiento($clave, $inicial, $final){
        $query = DB::connection('sinfodiDB')->table('sinfodi_pat_personas')
                    ->select('sinfodi_pat_personas.pat_clave_persona AS numero_personal', 'sinfodi_pat_personas.pat_clave_pat_persona AS clave', 'sinfodi_pat.pat_status AS status')
                    ->leftJoin('sinfodi_pat', 'sinfodi_pat.pat_clave', '=', 'sinfodi_pat_personas.pat_clave_pat_persona')
                    ->where('sinfodi_pat.pat_eliminado', '=', 0)
                    ->where('sinfodi_pat_personas.pat_clave_persona', '<>', 0)
                    ->where('sinfodi_pat.pat_tipo', '=', 2)
                    ->where('sinfodi_pat.pat_status', '=', 2)
                    ->whereBetween('sinfodi_pat.pat_fecha', [$inicial, $final])
                    ->where('sinfodi_pat_personas.pat_clave_persona', '=', $clave)
                    ->orderBy('sinfodi_pat_personas.pat_clave_persona', 'ASC')
                    ->get();
        return $query;
    }

    public static function Get_Evidencias_Obj5_Criterio18_TransferenciaConocimiento($clave, $inicial, $final){
        $query = DB::connection('sinfodiDB')->table('sinfodi_pat_personas')
                    ->select('sinfodi_pat_personas.pat_clave_persona AS numero_personal', 'sinfodi_pat_personas.pat_clave_pat_persona AS clave', 'sinfodi_pat.pat_status AS status')
                    ->leftJoin('sinfodi_pat', 'sinfodi_pat.pat_clave', '=', 'sinfodi_pat_personas.pat_clave_pat_persona')
                    ->where('sinfodi_pat.pat_eliminado', '=', 0)
                    ->where('sinfodi_pat_personas.pat_clave_persona', '<>', 0)
                    ->where('sinfodi_pat.pat_tipo', '=', 3)
                    ->where('sinfodi_pat.pat_status', '=', 1)
                    ->whereBetween('sinfodi_pat.pat_fecha', [$inicial, $final])
                    ->where('sinfodi_pat_personas.pat_clave_persona', '=', $clave)
                    ->orderBy('sinfodi_pat_personas.pat_clave_persona', 'ASC')
                    ->get();
        return $query;
    }

    public static function Get_Evidencias_Obj5_Criterio19_TransferenciaConocimiento($clave, $inicial, $final){
        $query = DB::connection('sinfodiDB')->table('sinfodi_pat_personas')
                    ->select('sinfodi_pat_personas.pat_clave_persona AS numero_personal', 'sinfodi_pat_personas.pat_clave_pat_persona AS clave', 'sinfodi_pat.pat_status AS status')
                    ->leftJoin('sinfodi_pat', 'sinfodi_pat.pat_clave', '=', 'sinfodi_pat_personas.pat_clave_pat_persona')
                    ->where('sinfodi_pat.pat_eliminado', '=', 0)
                    ->where('sinfodi_pat_personas.pat_clave_persona', '<>', 0)
                    ->where('sinfodi_pat.pat_tipo', '=', 3)
                    ->where('sinfodi_pat.pat_status', '=', 1)
                    ->whereBetween('sinfodi_pat.pat_fecha', [$inicial, $final])
                    ->where('sinfodi_pat_personas.pat_clave_persona', '=', $clave)
                    ->orderBy('sinfodi_pat_personas.pat_clave_persona', 'ASC')
                    ->get();
        return $query;
    }

    public static function Get_Evidencias_Obj5_Criterio20_TransferenciaConocimiento($clave, $inicial, $final){
        $query = DB::connection('sinfodiDB')->table('sinfodi_pat_personas')
                    ->select('sinfodi_pat_personas.pat_clave_persona AS numero_personal', 'sinfodi_pat_personas.pat_clave_pat_persona AS clave', 'sinfodi_pat.pat_status AS status')
                    ->leftJoin('sinfodi_pat', 'sinfodi_pat.pat_clave', '=', 'sinfodi_pat_personas.pat_clave_pat_persona')
                    ->where('sinfodi_pat.pat_eliminado', '=', 0)
                    ->where('sinfodi_pat_personas.pat_clave_persona', '<>', 0)
                    ->where('sinfodi_pat.pat_tipo', '=', 5)
                    ->where('sinfodi_pat.pat_status', '=', 1)
                    ->whereBetween('sinfodi_pat.pat_fecha', [$inicial, $final])
                    ->where('sinfodi_pat_personas.pat_clave_persona', '=', $clave)
                    ->orderBy('sinfodi_pat_personas.pat_clave_persona', 'ASC')
                    ->get();
        return $query;
    }

    public static function Get_Evidencias_Obj5_Criterio21_TransferenciaConocimiento($clave, $inicial, $final){
        $query = DB::connection('sinfodiDB')->table('sinfodi_pat_personas')
                    ->select('sinfodi_pat_personas.pat_clave_persona AS numero_personal', 'sinfodi_pat_personas.pat_clave_pat_persona AS clave', 'sinfodi_pat.pat_status AS status')
                    ->leftJoin('sinfodi_pat', 'sinfodi_pat.pat_clave', '=', 'sinfodi_pat_personas.pat_clave_pat_persona')
                    ->where('sinfodi_pat.pat_eliminado', '=', 0)
                    ->where('sinfodi_pat_personas.pat_clave_persona', '<>', 0)
                    ->where('sinfodi_pat.pat_tipo', '=', 5)
                    ->where('sinfodi_pat.pat_status', '=', 2)
                    ->whereBetween('sinfodi_pat.pat_fecha', [$inicial, $final])
                    ->where('sinfodi_pat_personas.pat_clave_persona', '=', $clave)
                    ->orderBy('sinfodi_pat_personas.pat_clave_persona', 'ASC')
                    ->get();
        return $query;
    }

    public static function Get_Evidencias_Obj5_Criterio22_TransferenciaConocimiento($clave, $inicial, $final){
        $query = DB::connection('sinfodiDB')->table('sinfodi_pat_personas')
                    ->select('sinfodi_pat_personas.pat_clave_persona AS numero_personal', 'sinfodi_pat_personas.pat_clave_pat_persona AS clave', 'sinfodi_pat.pat_status AS status')
                    ->leftJoin('sinfodi_pat', 'sinfodi_pat.pat_clave', '=', 'sinfodi_pat_personas.pat_clave_pat_persona')
                    ->where('sinfodi_pat.pat_eliminado', '=', 0)
                    ->where('sinfodi_pat_personas.pat_clave_persona', '<>', 0)
                    ->where('sinfodi_pat.pat_tipo', '=', 1)
                    ->where('sinfodi_pat.pat_status', '=', 2)
                    ->whereBetween('sinfodi_pat.pat_fecha', [$inicial, $final])
                    ->where('sinfodi_pat_personas.pat_clave_persona', '=', $clave)
                    ->orderBy('sinfodi_pat_personas.pat_clave_pat_persona', 'ASC')
                    ->get();
        return $query;
    }

    public static function Get_Evidencias_Obj5_Criterio23_TransferenciaConocimiento($clave, $inicial, $final){
        $query = DB::connection('sinfodiDB')->table('sinfodi_pat_personas')
                    ->select('sinfodi_pat_personas.pat_clave_persona AS numero_personal', 'sinfodi_pat_personas.pat_clave_pat_persona AS clave', 'sinfodi_pat.pat_status AS status')
                    ->leftJoin('sinfodi_pat', 'sinfodi_pat.pat_clave', '=', 'sinfodi_pat_personas.pat_clave_pat_persona')
                    ->where('sinfodi_pat.pat_eliminado', '=', 0)
                    ->where('sinfodi_pat_personas.pat_clave_persona', '<>', 0)
                    ->where('sinfodi_pat.pat_tipo', '=', 3)
                    ->where('sinfodi_pat.pat_status', '=', 4)
                    ->whereBetween('sinfodi_pat.pat_fecha', [$inicial, $final])
                    ->whereIn('sinfodi_pat_personas.pat_clave_persona', $clave)
                    ->orderBy('sinfodi_pat_personas.pat_clave_persona', 'ASC')
                    ->get();
        return $query;
    }

    //** Codigo personal */
    public function getEvidenciasPosgrado($clave, $year, $criterio){
        // $obtener = EvidenciasDPosgrado::where('clave', '=', $clave)->where('id_criterio', '=', $criterio)->where('year', '=', $year)->orWhere('clave_evidencia', 'like', 'PAT%')->get();
        $obtener = true;
        $data['response'] = $obtener;
        return $this->response($data);
    }

    //** Codigo personal */
    public function obtenerEvidenciasPosgrado($clave, $year, $criterio){
        // if(EvidenciasDPosgrado::where('clave', '=', $clave)->where('year', '=', $year)->where('id_criterio', '=', $criterio)->where('clave_evidencia', 'like', 'PAT%')->count() == 0){
        //     $count = 0;
        // }else{
        //     $count = 1;
        // }
        $count = 0;
        $data['response'] = $count;
        return $this->response($data);
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function savePuntos(Request $request)
    {
        // EvidenciasDPosgrado::create($request->all());
        $data['response'] = true;
        return $this->response($data);
    }

    /** Codigo personal */
    public static function updateDatosPosgrado($clave, $year, $criterio){
        $obtener = DB::table('sinfodi_evidencias_Posgrado')->select('puntos', 'total_puntos')->where('clave', '=', $clave)->where('year', '=', $year)->where('id_criterio', '=', $criterio)->take(1)->get();
        foreach ($obtener as $item){
            $puntos = $item->puntos;
            $total_puntos = $item->total_puntos;
            EvaluacionDPosgrado::where('clave', '=', $clave)->where('id_criterio', '=',  $criterio)->where('year', '=', $year)->update( array('puntos'=>$puntos, 'total_puntos'=>$total_puntos));
        }
        return true;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deletePuntos($clave, $year, $criterio)
    {
        // EvidenciasDPosgrado::where('clave', '=', $clave)->where('year', '=', $year)->where('id_criterio', '=', $criterio)->delete();
        $data['response'] = true;
        return $this->response($data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexB()
    {
        $criterios = self::Get_Criterios_acreditacionesB();
        return view('estimulos.evaluaciones.direccionPosgrado.transferenciaB.index', compact('criterios'));
    }

    /** Funcion para obtener los criterios para la acreditaciones... */
    public static function Get_Criterios_acreditacionesB(){
        $query = DB::table('sinfodi_criterios')
                    ->select('id', 'nombre', 'id_objetivo')
                    ->where('observaciones', '=', 'Tabla 1. Actividad B.')
                    ->where('id_objetivo', '=', 5)
                    ->get();
        return $query;
    }
}
