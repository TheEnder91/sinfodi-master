<?php

namespace App\Http\Controllers\Estimulos\Evaluaciones\DireccionCiencia;

use Illuminate\Http\Request;
use App\Traits\SingleResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Estimulos\EvaluacionDCiencia;

class TransferenciaDCController extends Controller
{
    use SingleResponse;

    const PERMISSIONS = [
        'index' => 'estimulo-evaluaciones-ciencia-transferencia-index',
        'indexB' => 'estimulo-evaluaciones-ciencia-transferenciaB-index',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $criterios = self::Get_Criterios_transferencia();
        return view('estimulos.evaluaciones.direccionCiencia.transferencia.index', compact('criterios'));
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
                            ->where('puesto', '=', 'Direccion_Ciencia')
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
    public function datosTransferencia($year, $criterio)
    {
        if($criterio == 15){
            $datos = DB::table('sinfodi_evaluacion_ciencia')->where('year', '=', $year)->where('id_criterio', '=', $criterio)->get();
        }elseif($criterio == 16){
            $datos = DB::table('sinfodi_evaluacion_ciencia')->where('year', '=', $year)->where('id_criterio', '=', $criterio)->get();
        }elseif($criterio == 17){
            $datos = DB::table('sinfodi_evaluacion_ciencia')->where('year', '=', $year)->where('id_criterio', '=', $criterio)->get();
        }elseif($criterio == 18){
            $datos = DB::table('sinfodi_evaluacion_ciencia')->where('year', '=', $year)->where('id_criterio', '=', $criterio)->get();
        }elseif($criterio == 19){
            $datos = DB::table('sinfodi_evaluacion_ciencia')->where('year', '=', $year)->where('id_criterio', '=', $criterio)->get();
        }elseif($criterio == 20){
            $datos = DB::table('sinfodi_evaluacion_ciencia')->where('year', '=', $year)->where('id_criterio', '=', $criterio)->get();
        }elseif($criterio == 21){
            $datos = DB::table('sinfodi_evaluacion_ciencia')->where('year', '=', $year)->where('id_criterio', '=', $criterio)->get();
        }elseif($criterio == 22){
            $datos = DB::table('sinfodi_evaluacion_ciencia')->where('year', '=', $year)->where('id_criterio', '=', $criterio)->get();
        }elseif($criterio == 23){
            $datos = DB::table('sinfodi_evaluacion_ciencia')->where('year', '=', $year)->where('id_criterio', '=', $criterio)->get();
        }
        $data['response'] = $datos;
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
        return view('estimulos.evaluaciones.direccionCiencia.transferenciaB.index', compact('criterios'));
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
