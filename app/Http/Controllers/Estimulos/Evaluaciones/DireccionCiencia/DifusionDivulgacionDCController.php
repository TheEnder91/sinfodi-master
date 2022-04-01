<?php

namespace App\Http\Controllers\Estimulos\Evaluaciones\DireccionCiencia;

use Illuminate\Http\Request;
use App\Traits\SingleResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Estimulos\EvaluacionDCiencia;

class DifusionDivulgacionDCController extends Controller
{
    use SingleResponse;

    const PERMISSIONS = [
        'index' => 'estimulo-evaluaciones-ciencia-difusiondivulgacion-index',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('estimulos.evaluaciones.direccionCiencia.difusionDivulgacion.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $year
     * @return \Illuminate\Http\Response
     */
    public function search($year)
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
        $evaluacion_dif_div = self::Evaluaciones_Difusion_Divulgacion($clave, $fechaInicial, $fechaFinal);
        $data['response'] = $evaluacion_dif_div;
        return $this->response($data);
    }

    /** Codigo personal... */
    public static function Evaluaciones_Difusion_Divulgacion($clave, $inical, $final){
        $queryDIF = DB::connection('sinfodiDB')->table('sinfodidb.sinfodi_ead_personas')
                        ->selectRaw('sinfodidb.sinfodi_ead_personas.ead_clave_personal AS numero_personal,
                                     sinfodidb.sinfodi_ead_personas.ead_nombre AS nombre,
                                     sinfodi_master.sinfodi_evaluados.usuario as username')
                        ->join('sinfodi_master.sinfodi_evaluados', function($join){
                            $join->on('sinfodi_master.sinfodi_evaluados.clave', '=', 'sinfodidb.sinfodi_ead_personas.ead_clave_personal')
                                 ->where('sinfodi_master.sinfodi_evaluados.puesto', '=', 'Direccion_Ciencia');
                        })
                        ->leftJoin('sinfodidb.sinfodi_ead', 'sinfodidb.sinfodi_ead.ead_clave', '=', 'sinfodidb.sinfodi_ead_personas.ead_clave_ead_persona')
                        ->where('sinfodidb.sinfodi_ead.ead_eliminado', '=', 0)
                        ->whereBetween('sinfodidb.sinfodi_ead.ead_fecha_inicio', [$inical, $final])
                        ->whereBetween('sinfodidb.sinfodi_ead.ead_fecha_fin', [$inical, $final])
                        ->where('sinfodidb.sinfodi_ead_personas.ead_clave_personal', '<>', 0)
                        ->where('sinfodidb.sinfodi_ead_personas.ead_tipo', '=', "Personal")
                        ->groupBy('sinfodidb.sinfodi_ead_personas.ead_clave_personal')
                        ->groupBy('sinfodidb.sinfodi_ead_personas.ead_nombre')
                        ->groupBy('sinfodi_master.sinfodi_evaluados.usuario');
        $queryEAD = DB::connection('sinfodiDB')->table('sinfodidb.sinfodi_dif_persona')
                        ->selectRaw('sinfodidb.sinfodi_dif_persona.dif_clave_personal AS numero_personal,
                                     sinfodidb.sinfodi_dif_persona.dif_nombre AS nombre,
                                     sinfodi_master.sinfodi_evaluados.usuario as username')
                        ->join('sinfodi_master.sinfodi_evaluados', function($join){
                            $join->on('sinfodi_master.sinfodi_evaluados.clave', '=', 'sinfodidb.sinfodi_dif_persona.dif_clave_personal')
                                 ->where('sinfodi_master.sinfodi_evaluados.puesto', '=', 'Direccion_Ciencia');
                        })
                        ->leftJoin('sinfodidb.sinfodi_dif', 'sinfodidb.sinfodi_dif.dif_clave','=', 'sinfodidb.sinfodi_dif_persona.dif_clave_dif_personal')
                        ->where('sinfodidb.sinfodi_dif.dif_eliminado', '=', 0)
                        ->whereBetween('sinfodidb.sinfodi_dif.dif_fecha_inicio', [$inical, $final])
                        ->whereBetween('sinfodidb.sinfodi_dif.dif_fecha_fin', [$inical, $final])
                        ->where('sinfodidb.sinfodi_dif_persona.dif_clave_personal', '<>', 0)
                        ->groupBy('sinfodidb.sinfodi_dif_persona.dif_clave_personal')
                        ->groupBy('sinfodidb.sinfodi_dif_persona.dif_nombre')
                        ->groupBy('sinfodi_master.sinfodi_evaluados.usuario')
                        ->unionAll($queryDIF);
        $queryGral = DB::table($queryEAD)
                        ->selectRaw('numero_personal, nombre, username')
                        ->whereIn('numero_personal', $clave)
                        ->groupBy('numero_personal')
                        ->groupBy('nombre')
                        ->groupBy('username')
                        ->orderBy('numero_personal', 'ASC')
                        ->get();
        return $queryGral;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveDatos(Request $request)
    {
        if(EvaluacionDCiencia::where('clave', '=', $request->clave)->where('year', '=', $request->year)->where('id_criterio', '=', $request->id_criterio)->where('direccion', '=', 'DCiencia')->count() == 0){
            $nuevo = new EvaluacionDCiencia();
            $nuevo->create($request->all());
            $data['response'] = true;
            return $this->response($data);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $year
     * @return \Illuminate\Http\Response
     */
    public function datosDifDiv($year, $criterio)
    {
        $datos = DB::table('sinfodi_evaluacion_ciencia')->where('year', '=', $year)->where('id_criterio', '=', $criterio)->where('direccion', '=', 'DCiencia')->get();
        $data['response'] = $datos;
        return $this->response($data);
    }
}
