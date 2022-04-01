<?php

namespace App\Http\Controllers\Estimulos\Evaluaciones\DireccionCiencia;

use Illuminate\Http\Request;
use App\Traits\SingleResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Estimulos\EvaluacionDCiencia;

class InvestigacionDCController extends Controller
{
    use SingleResponse;

    const PERMISSIONS = [
        'index' => 'estimulo-evaluaciones-ciencia-investigacion-index',
        'indexB' => 'estimulo-evaluaciones-ciencia-investigacionB-index',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $criterios = self::Get_Criterios_Investigacion();
        return view('estimulos.evaluaciones.direccionCiencia.investigacion.index', [
            'criterios' => $criterios,
        ]);
    }

    /** Funcion para obtener los criterios para la investigacion cientifica... */
    public static function Get_Criterios_Investigacion(){
        $query = DB::table('sinfodi_criterios')
                    ->select('id', 'nombre', 'id_objetivo')
                    ->where('observaciones', '=', 'Tabla 1. Actividad A.')
                    ->where('id_objetivo', '=', 3)
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
        if($criterio == 6){
            $evaluacion_investigacion = self::Evaluacion_Objetivo3_Criterio6_Invest_Cientifica($clave, $fechaInicial, $fechaFinal);
        }elseif($criterio == 7){
            $evaluacion_investigacion = self::Evaluacion_Objetivo3_Criterio7_Invest_Cientifica($clave, $fechaInicial, $fechaFinal);
        }elseif($criterio == 8){
            $evaluacion_investigacion = self::Evaluacion_Objetivo3_Criterio8_Invest_Cientifica($clave, $fechaInicial, $fechaFinal);
        }elseif($criterio == 9){
            $evaluacion_investigacion = self::Evaluacion_Objetivo3_Criterio9_Invest_Cientifica($clave, $fechaInicial, $fechaFinal);
        }elseif($criterio == 10){
            $evaluacion_investigacion = self::Evaluacion_Objetivo3_Criterio10_Invest_Cientifica($clave, $fechaInicial, $fechaFinal);
        }elseif($criterio == 11){
            $evaluacion_investigacion = self::Evaluacion_Objetivo3_Criterio11_Invest_Cientifica($clave, $fechaInicial, $fechaFinal);
        }elseif($criterio == 13){
            $evaluacion_investigacion = self::Evaluacion_Objetivo3_Criterio13_Invest_Cientifica($clave, $fechaInicial, $fechaFinal);
        }
        $data['response'] = $evaluacion_investigacion;
        return $this->response($data);
    }

    public static function Evaluacion_Objetivo3_Criterio6_Invest_Cientifica($clave, $inicial, $final){
        $query = DB::connection('sinfodiDB')->table('sinfodidb.sinfodi_art_personas')
                    ->selectRaw('sinfodidb.sinfodi_art_personas.art_clave_personal AS numero_personal,
                                 sinfodidb.sinfodi_art_personas.art_nombre AS nombre,
                                 sinfodi_master.sinfodi_evaluados.usuario as username')
                    ->join('sinfodi_master.sinfodi_evaluados', function($join){
                        $join->on('sinfodi_master.sinfodi_evaluados.clave', '=', 'sinfodidb.sinfodi_art_personas.art_clave_personal')
                             ->where('sinfodi_master.sinfodi_evaluados.puesto', '=', 'Direccion_Ciencia');
                    })
                    ->leftJoin('sinfodidb.sinfodi_art', 'sinfodidb.sinfodi_art.art_clave', '=', 'sinfodidb.sinfodi_art_personas.art_clave_art_persona')
                    ->leftJoin('sinfodidb.sinfodi_art_cuartiles', 'sinfodidb.sinfodi_art_cuartiles.art_clave_art_cuartil', '=', 'sinfodidb.sinfodi_art_personas.art_clave_art_persona')
                    ->where('sinfodidb.sinfodi_art.art_eliminado', '=', 0)
                    ->where('sinfodidb.sinfodi_art_personas.art_clave_personal', '<>', 0)
                    ->whereBetween('sinfodidb.sinfodi_art.art_fecha_pub', [$inicial, $final])
                    ->where('sinfodidb.sinfodi_art_cuartiles.art_factor_impacto', '<=', 2.0)
                    ->whereIn('sinfodidb.sinfodi_art_personas.art_clave_personal', $clave)
                    ->groupBy('sinfodidb.sinfodi_art_personas.art_clave_personal')
                    ->groupBy('sinfodidb.sinfodi_art_personas.art_nombre')
                    ->groupBy('sinfodi_master.sinfodi_evaluados.usuario')
                    ->get();
        return $query;
    }

    public static function Evaluacion_Objetivo3_Criterio7_Invest_Cientifica($clave, $inicial, $final){
        $query = DB::connection('sinfodiDB')->table('sinfodidb.sinfodi_art_personas')
                    ->selectRaw('sinfodidb.sinfodi_art_personas.art_clave_personal AS numero_personal,
                                 sinfodidb.sinfodi_art_personas.art_nombre AS nombre,
                                 sinfodi_master.sinfodi_evaluados.usuario as username')
                    ->join('sinfodi_master.sinfodi_evaluados', function($join){
                        $join->on('sinfodi_master.sinfodi_evaluados.clave', '=', 'sinfodidb.sinfodi_art_personas.art_clave_personal')
                             ->where('sinfodi_master.sinfodi_evaluados.puesto', '=', 'Direccion_Ciencia');
                    })
                    ->leftJoin('sinfodidb.sinfodi_art', 'sinfodidb.sinfodi_art.art_clave', '=', 'sinfodidb.sinfodi_art_personas.art_clave_art_persona')
                    ->leftJoin('sinfodidb.sinfodi_art_cuartiles', 'sinfodidb.sinfodi_art_cuartiles.art_clave_art_cuartil', '=', 'sinfodidb.sinfodi_art_personas.art_clave_art_persona')
                    ->where('sinfodidb.sinfodi_art.art_eliminado', '=', 0)
                    ->where('sinfodidb.sinfodi_art_personas.art_clave_personal', '<>', 0)
                    ->whereBetween('sinfodidb.sinfodi_art.art_fecha_pub', [$inicial, $final])
                    ->where('sinfodidb.sinfodi_art_cuartiles.art_factor_impacto', '>', 2.0)
                    ->where('sinfodidb.sinfodi_art_cuartiles.art_factor_impacto', '<=', 4.0)
                    ->whereIn('sinfodidb.sinfodi_art_personas.art_clave_personal', $clave)
                    ->groupBy('sinfodidb.sinfodi_art_personas.art_clave_personal')
                    ->groupBy('sinfodidb.sinfodi_art_personas.art_nombre')
                    ->groupBy('sinfodi_master.sinfodi_evaluados.usuario')
                    ->get();
        return $query;
    }

    public static function Evaluacion_Objetivo3_Criterio8_Invest_Cientifica($clave, $inicial, $final){
        $query = DB::connection('sinfodiDB')->table('sinfodidb.sinfodi_art_personas')
                    ->selectRaw('sinfodidb.sinfodi_art_personas.art_clave_personal AS numero_personal,
                                 sinfodidb.sinfodi_art_personas.art_nombre AS nombre,
                                 sinfodi_master.sinfodi_evaluados.usuario as username')
                    ->join('sinfodi_master.sinfodi_evaluados', function($join){
                        $join->on('sinfodi_master.sinfodi_evaluados.clave', '=', 'sinfodidb.sinfodi_art_personas.art_clave_personal')
                             ->where('sinfodi_master.sinfodi_evaluados.puesto', '=', 'Direccion_Ciencia');
                    })
                    ->leftJoin('sinfodidb.sinfodi_art', 'sinfodidb.sinfodi_art.art_clave', '=', 'sinfodidb.sinfodi_art_personas.art_clave_art_persona')
                    ->leftJoin('sinfodidb.sinfodi_art_cuartiles', 'sinfodidb.sinfodi_art_cuartiles.art_clave_art_cuartil', '=', 'sinfodidb.sinfodi_art_personas.art_clave_art_persona')
                    ->where('sinfodidb.sinfodi_art.art_eliminado', '=', 0)
                    ->where('sinfodidb.sinfodi_art_personas.art_clave_personal', '<>', 0)
                    ->whereBetween('sinfodidb.sinfodi_art.art_fecha_pub', [$inicial, $final])
                    ->where('sinfodidb.sinfodi_art_cuartiles.art_factor_impacto', '>', 4.0)
                    ->whereIn('sinfodidb.sinfodi_art_personas.art_clave_personal', $clave)
                    ->groupBy('sinfodidb.sinfodi_art_personas.art_clave_personal')
                    ->groupBy('sinfodidb.sinfodi_art_personas.art_nombre')
                    ->groupBy('sinfodi_master.sinfodi_evaluados.usuario')
                    ->get();
        return $query;
    }

    public static function Evaluacion_Objetivo3_Criterio9_Invest_Cientifica($clave, $inicial, $final){
        $query = DB::connection('sinfodiDB')->table('sinfodidb.sinfodi_lfc_personas')
                    ->selectRaw('sinfodidb.sinfodi_lfc_personas.lfc_clave_persona AS numero_personal,
                                 sinfodidb.sinfodi_lfc_personas.lfc_nombre AS nombre,
                                 productivo_sinfodi.sinfodi_evaluados.usuario as username')
                    ->join('productivo_sinfodi.sinfodi_evaluados', function($join){
                        $join->on('productivo_sinfodi.sinfodi_evaluados.clave', '=', 'sinfodidb.sinfodi_lfc_personas.lfc_clave_persona')
                             ->where('productivo_sinfodi.sinfodi_evaluados.puesto', '=', 'Direccion_Ciencia');
                    })
                    ->leftJoin('sinfodidb.sinfodi_lfc', 'sinfodidb.sinfodi_lfc.lfc_clave', '=', 'sinfodidb.sinfodi_lfc_personas.lfc_clave_lfc_persona')
                    ->where('sinfodidb.sinfodi_lfc.lfc_eliminado', '=', 0)
                    ->where('sinfodidb.sinfodi_lfc_personas.lfc_clave_persona', '<>', 0)
                    ->where('sinfodidb.sinfodi_lfc.lfc_editorial_recon', '=', 1)
                    ->where('sinfodidb.sinfodi_lfc.lfc_tipo_pub', '=', 2)
                    ->whereBetween('sinfodidb.sinfodi_lfc.lfc_fecha_pub', [$inicial, $final])
                    ->whereIn('sinfodi_lfc_personas.lfc_clave_persona', $clave)
                    ->groupBy('sinfodidb.sinfodi_lfc_personas.lfc_clave_persona')
                    ->groupBy('sinfodidb.sinfodi_lfc_personas.lfc_nombre')
                    ->groupBy('productivo_sinfodi.sinfodi_evaluados.usuario')
                    ->get();
        return $query;
    }

    public static function Evaluacion_Objetivo3_Criterio10_Invest_Cientifica($clave, $inicial, $final){
        $query = DB::connection('sinfodiDB')->table('sinfodidb.sinfodi_mem_personas')
                    ->selectRaw('sinfodidb.sinfodi_mem_personas.mem_clave_personal AS numero_personal,
                                 sinfodidb.sinfodi_mem_personas.mem_nombre AS nombre,
                                 productivo_sinfodi.sinfodi_evaluados.usuario AS username')
                    ->join('productivo_sinfodi.sinfodi_evaluados', function($join){
                        $join->on('productivo_sinfodi.sinfodi_evaluados.clave', '=', 'sinfodidb.sinfodi_mem_personas.mem_clave_personal')
                             ->where('productivo_sinfodi.sinfodi_evaluados.puesto', '=', 'Direccion_Ciencia');
                    })
                    ->leftJoin('sinfodidb.sinfodi_mem', 'sinfodidb.sinfodi_mem.mem_clave', '=', 'sinfodidb.sinfodi_mem_personas.mem_clave_mem_persona')
                    ->where('sinfodidb.sinfodi_mem.mem_eliminado', '=', 0)
                    ->where('sinfodidb.sinfodi_mem_personas.mem_clave_personal', '<>', 0)
                    ->where('sinfodidb.sinfodi_mem.mem_circulacion', '=', 2)
                    ->where('sinfodidb.sinfodi_mem.mem_arbitraje', '=', 1)
                    ->whereBetween('sinfodidb.sinfodi_mem.mem_fecha_pub', [$inicial, $final])
                    ->whereIn('sinfodidb.sinfodi_mem_personas.mem_clave_personal', $clave)
                    ->groupBy('sinfodidb.sinfodi_mem_personas.mem_clave_personal')
                    ->groupBy('sinfodidb.sinfodi_mem_personas.mem_nombre')
                    ->groupBy('productivo_sinfodi.sinfodi_evaluados.usuario')
                    ->get();
        return $query;
    }

    public static function Evaluacion_Objetivo3_Criterio11_Invest_Cientifica($clave, $inicial, $final){
        $query = DB::connection('sinfodiDB')->table('sinfodidb.sinfodi_mem_personas')
                    ->selectRaw('sinfodidb.sinfodi_mem_personas.mem_clave_personal AS numero_personal,
                                 sinfodidb.sinfodi_mem_personas.mem_nombre AS nombre,
                                 productivo_sinfodi.sinfodi_evaluados.usuario AS username')
                    ->join('productivo_sinfodi.sinfodi_evaluados', function($join){
                        $join->on('productivo_sinfodi.sinfodi_evaluados.clave', '=', 'sinfodidb.sinfodi_mem_personas.mem_clave_personal')
                             ->where('productivo_sinfodi.sinfodi_evaluados.puesto', '=', 'Direccion_Ciencia');
                    })
                    ->leftJoin('sinfodidb.sinfodi_mem', 'sinfodidb.sinfodi_mem.mem_clave', '=', 'sinfodidb.sinfodi_mem_personas.mem_clave_mem_persona')
                    ->where('sinfodidb.sinfodi_mem.mem_eliminado', '=', 0)
                    ->where('sinfodidb.sinfodi_mem_personas.mem_clave_personal', '<>', 0)
                    ->where('sinfodidb.sinfodi_mem.mem_circulacion', '=', 1)
                    ->where('sinfodidb.sinfodi_mem.mem_arbitraje', '=', 1)
                    ->whereBetween('sinfodidb.sinfodi_mem.mem_fecha_pub', [$inicial, $final])
                    ->whereIn('sinfodidb.sinfodi_mem_personas.mem_clave_personal', $clave)
                    ->groupBy('sinfodidb.sinfodi_mem_personas.mem_clave_personal')
                    ->groupBy('sinfodidb.sinfodi_mem_personas.mem_nombre')
                    ->groupBy('productivo_sinfodi.sinfodi_evaluados.usuario')
                    ->get();
        return $query;
    }

    public static function Evaluacion_Objetivo3_Criterio13_Invest_Cientifica($clave, $inicial, $final){
        $query = DB::connection('sinfodiDB')->table('sinfodidb.sinfodi_lfc_personas')
                    ->selectRaw('sinfodidb.sinfodi_lfc_personas.lfc_clave_persona AS numero_personal,
                                 sinfodidb.sinfodi_lfc_personas.lfc_nombre AS nombre,
                                 productivo_sinfodi.sinfodi_evaluados.usuario as username')
                    ->join('productivo_sinfodi.sinfodi_evaluados', function($join){
                        $join->on('productivo_sinfodi.sinfodi_evaluados.clave', '=', 'sinfodidb.sinfodi_lfc_personas.lfc_clave_persona')
                             ->where('productivo_sinfodi.sinfodi_evaluados.puesto', '=', 'Direccion_Ciencia');
                    })
                    ->leftJoin('sinfodidb.sinfodi_lfc', 'sinfodidb.sinfodi_lfc.lfc_clave', '=', 'sinfodidb.sinfodi_lfc_personas.lfc_clave_lfc_persona')
                    ->where('sinfodidb.sinfodi_lfc.lfc_eliminado', '=', 0)
                    ->where('sinfodidb.sinfodi_lfc_personas.lfc_clave_persona', '<>', 0)
                    ->where('sinfodidb.sinfodi_lfc.lfc_editorial_recon', '=', 1)
                    ->where('sinfodidb.sinfodi_lfc.lfc_tipo_pub', '=', 1)
                    ->whereBetween('sinfodidb.sinfodi_lfc.lfc_fecha_pub', [$inicial, $final])
                    ->whereIn('sinfodi_lfc_personas.lfc_clave_persona', $clave)
                    ->groupBy('sinfodidb.sinfodi_lfc_personas.lfc_clave_persona')
                    ->groupBy('sinfodidb.sinfodi_lfc_personas.lfc_nombre')
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
    public function datosInvestigacion($year, $criterio)
    {
        if($criterio == 6){
            $datos = DB::table('sinfodi_evaluacion_ciencia')->where('year', '=', $year)->where('id_criterio', '=', $criterio)->get();
        }elseif($criterio == 7){
            $datos = DB::table('sinfodi_evaluacion_ciencia')->where('year', '=', $year)->where('id_criterio', '=', $criterio)->get();
        }elseif($criterio == 8){
            $datos = DB::table('sinfodi_evaluacion_ciencia')->where('year', '=', $year)->where('id_criterio', '=', $criterio)->get();
        }elseif($criterio == 9){
            $datos = DB::table('sinfodi_evaluacion_ciencia')->where('year', '=', $year)->where('id_criterio', '=', $criterio)->get();
        }elseif($criterio == 10){
            $datos = DB::table('sinfodi_evaluacion_ciencia')->where('year', '=', $year)->where('id_criterio', '=', $criterio)->get();
        }elseif($criterio == 11){
            $datos = DB::table('sinfodi_evaluacion_ciencia')->where('year', '=', $year)->where('id_criterio', '=', $criterio)->get();
        }elseif($criterio == 13){
            $datos = DB::table('sinfodi_evaluacion_ciencia')->where('year', '=', $year)->where('id_criterio', '=', $criterio)->get();
        }
        $data['response'] = $datos;
        return $this->response($data);
    }

    /** Apartir de aqui es codigo para la tabla B... */
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexB()
    {
        return view('estimulos.evaluaciones.direccionCiencia.investigacionB.index');
    }
}
