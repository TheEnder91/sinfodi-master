<?php

namespace App\Http\Controllers\Estimulos\Evaluaciones\DireccionProyectosTec;

use Illuminate\Http\Request;
use App\Traits\SingleResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Estimulos\EvaluacionDProyTec;
use App\Models\Estimulos\EvidenciasDProyTec;

class DifusionDivulgacionDPTController extends Controller
{
    use SingleResponse;

    const PERMISSIONS = [
        'index' => 'estimulo-evaluaciones-proyectos-difusiondivulgacion-index',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('estimulos.evaluaciones.direccionProyTec.difusionDivulgacion.index');
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
                            ->where('puesto', '=', 'Direccion_Proyectos_Tecno')
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
                                 ->where('sinfodi_master.sinfodi_evaluados.puesto', '=', 'Direccion_Proyectos_Tecno');
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
                                 ->where('sinfodi_master.sinfodi_evaluados.puesto', '=', 'Direccion_Proyectos_Tecno');
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
        if(EvaluacionDProyTec::where('clave', '=', $request->clave)->where('year', '=', $request->year)->where('id_criterio', '=', $request->id_criterio)->where('direccion', '=', 'DProyTec')->count() == 0){
            $nuevo = new EvaluacionDProyTec();
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
        $datos = DB::table('sinfodi_evaluacion_proy_tecno')->where('year', '=', $year)->where('id_criterio', '=', $criterio)->where('direccion', '=', 'DProyTec')->get();
        $data['response'] = $datos;
        return $this->response($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $year
     * @return \Illuminate\Http\Response
     */
    public function searchEvidencias($year, $clave)
    {
        $fechaInicial = $year.'-01-01';
        $fechaFinal = $year.'-12-31';
        $queryDIF = DB::connection('sinfodiDB')->table('sinfodi_dif_persona')
                        ->selectRaw('sinfodi_dif_persona.dif_clave_personal AS numeroPersonal,
                                     sinfodi_dif_persona.dif_clave_dif_personal AS clave,
                                     SUBSTRING(sinfodi_dif_persona.dif_clave_dif_personal, 1, 3) AS abreviatura,
                                     sinfodi_dif.dif_fecha_inicio as fechaini,
                                     sinfodi_dif.dif_fecha_fin as fechafin')
                        ->leftJoin('sinfodi_dif', 'sinfodi_dif.dif_clave', '=', 'sinfodi_dif_persona.dif_clave_dif_personal');
        $queryEAD = DB::connection('sinfodiDB')->table('sinfodi_ead_personas')
                        ->selectRaw('sinfodi_ead_personas.ead_clave_personal AS numeroPersonal,
                                     sinfodi_ead_personas.ead_clave_ead_persona AS clave,
                                     SUBSTRING(sinfodi_ead_personas.ead_clave_ead_persona, 1, 3) AS abreviatura,
                                     sinfodi_ead.ead_fecha_inicio as fechaini,
                                     sinfodi_ead.ead_fecha_fin as fechafin')
                        ->leftJoin('sinfodi_ead', 'sinfodi_ead.ead_clave', '=', 'sinfodi_ead_personas.ead_clave_ead_persona')
                        ->unionAll($queryDIF);
        $queryGral = DB::connection('sinfodiDB')->table($queryEAD)
                        ->selectRaw('numeroPersonal, clave, abreviatura, fechaini, fechafin')
                        ->whereBetween('fechaini', [$fechaInicial, $fechaFinal])
                        ->whereBetween('fechafin', [$fechaInicial, $fechaFinal])
                        ->where('numeroPersonal', '=', $clave)
                        ->orderBy('clave', 'ASC')
                        ->get();
        return $queryGral;
    }

    //** Codigo personal */
    public function getEvidenciasGeneral($clave, $year, $criterio){
        $obtener = EvidenciasDProyTec::where('clave', '=', $clave)
                                        ->where('id_criterio', '=', $criterio)
                                        ->where('year', '=', $year)
                                        ->get();
        $data['response'] = $obtener;
        return $this->response($data);
    }

    //** Codigo personal */
    public function obtenerEvidenciasGeneral($clave, $year, $criterio){
        $contar = EvidenciasDProyTec::where('clave', '=', $clave)
                                        ->where('id_criterio', '=', $criterio)
                                        ->where('year', '=', $year)
                                        ->where(function($query){
                                            $query->orWhere('evidencias', 'like', 'EAD%')
                                                  ->orWhere('evidencias', 'like', 'DIF%');
                                        })
                                        ->count();
        if($contar == 0){
            $count = 0;
        }else{
            $count = 1;
        }
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
        EvidenciasDProyTec::create($request->all());
        $data['response'] = true;
        return $this->response($data);
    }

    /** Codigo personal */
    public static function updateDatosGeneral(Request $request){
        $actualizar = EvidenciasDProyTec::where('clave', $request->clave)
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
        $actualizar = EvaluacionDProyTec::where('clave', $request->clave)
                                            ->where('id_criterio', $request->id_criterio)
                                            ->where('year', $request->year)
                                            ->update(['puntos' => $request->puntos, 'total_puntos' => $request->total_puntos]);
        return $actualizar;
    }
}
