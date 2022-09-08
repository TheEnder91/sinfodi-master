<?php

namespace App\Http\Controllers\Estimulos\Evaluaciones\DireccionServiciosTec;

use Illuminate\Http\Request;
use App\Traits\SingleResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Estimulos\EvaluacionDServTec;

class SostenibilidadDSTController extends Controller
{
    use SingleResponse;

    const PERMISSIONS = [
        'index' => 'estimulo-evaluaciones-servicios-sostentabilidad-index',
        'indexB' => 'estimulo-evaluaciones-servicios-sostentabilidadB-index',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('estimulos.evaluaciones.direccionServTec.sostenibilidad.index');
    }

    public function searchSostentabilidad($year){
        $queryEvaluados = DB::table('sinfodi_evaluados')
                            ->select('clave', 'puesto')
                            ->where('puesto', '=', 'Direccion_Servicios_Tecno')
                            ->orderby('clave', 'ASC')
                            ->get();
        foreach($queryEvaluados as $itemEvaluados){
            $clave[] = $itemEvaluados->clave;
        }
        $evaluacion_sosteniblidad = self::Evaluaciones_Sostenibilidad_Económica($clave, $year);
        $data['response'] = $evaluacion_sosteniblidad;
        return $this->response($data);
    }

    /** Codigo personal... */
    public static function Evaluaciones_Sostenibilidad_Económica($clave, $year){
        $query = DB::table('sinfodi_sostentabilidad')
                    ->select('clave_participante', 'nombre_participante', 'usuario_participante', 'year', DB::raw("SUM(total) as total"))
                    ->whereIn('clave_participante', $clave)
                    ->where('year', '=', $year)
                    ->groupBy('clave_participante')
                    ->groupBy('nombre_participante')
                    ->groupBy('usuario_participante')
                    ->groupBy('year')
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
        if(EvaluacionDServTec::where('clave', '=', $request->clave)->where('year', '=', $request->year)->where('id_criterio', '=', $request->id_criterio)->where('direccion', '=', 'DServTec')->count() == 0){
            $nuevo = new EvaluacionDServTec();
            $nuevo->create($request->all());
            $data['response'] = true;
            return $this->response($data);
        }
    }

    public function calculosSostentabilidad($year, $clave){
        $query = DB::select('SELECT DISTINCT clave_participante,
                                       (SELECT SUM(total) AS sumaProyectos FROM sinfodi_sostentabilidad WHERE clave_participante = '.$clave.' AND year = '.$year.' AND tipo = "Proyectos") AS sumaProyectos,
                                       (SELECT SUM(total) AS sumaServicios FROM sinfodi_sostentabilidad WHERE clave_participante = '.$clave.' AND year = '.$year.' AND tipo = "Servicios Especiales") AS sumaServicios,
                                       (SELECT SUM(total) AS sumaCursos FROM sinfodi_sostentabilidad WHERE clave_participante = '.$clave.' AND year = '.$year.' AND tipo = "Cursos") AS sumaCursos
                                FROM sinfodi_sostentabilidad
                                WHERE clave_participante = '.$clave.' AND year = '.$year.'');
        return $query;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $year
     * @return \Illuminate\Http\Response
     */
    public function datosSostentabilidad($year, $criterio)
    {
        $datos = DB::table('sinfodi_evaluacion_serv_tecno')->where('year', '=', $year)->where('id_criterio', '=', $criterio)->where('direccion', '=', 'DServTec')->get();
        $data['response'] = $datos;
        return $this->response($data);
    }

    public function detallesProyectos($year, $clave){
        $query = DB::table('sinfodi_sostentabilidad')
                    ->select('cgn',
                             'clave_participante',
                             'porcentaje_participacion',
                             'monto_ingresado',
                             'ingreso_participacion',
                             'puntos_totales',
                             'lider_responsable',
                             'puntos_lider',
                             'nuevos_puntos_totales',
                             'puntos_participacion',
                             'total')
                    ->where('clave_participante', '=', $clave)
                    ->where('year', '=', $year)
                    ->where('tipo', '=', 'Proyectos')
                    ->get();
        return $query;
    }

    public function detallesServicios($year, $clave){
        $query = DB::table('sinfodi_sostentabilidad')
                    ->select('cgn',
                             'clave_participante',
                             'porcentaje_participacion',
                             'monto_ingresado',
                             'ingreso_participacion',
                             'total')
                    ->where('clave_participante', '=', $clave)
                    ->where('year', '=', $year)
                    ->where('tipo', '=', 'Servicios Especiales')
                    ->get();
        return $query;
    }

    public function detallesCursos($year, $clave){
        $query = DB::table('sinfodi_sostentabilidad')
                    ->select('cgn',
                             'clave_participante',
                             'porcentaje_participacion',
                             'monto_ingresado',
                             'ingreso_participacion',
                             'total')
                    ->where('clave_participante', '=', $clave)
                    ->where('year', '=', $year)
                    ->where('tipo', '=', 'Cursos')
                    ->get();
        return $query;
    }

    public function getMonto($year){
        $query = DB::table('sinfodi_serv_tecno')
                    ->select('monto')
                    ->where('year', '=', $year)
                    ->value('monto');
        $data['response'] = $query;
        return $this->response($data);
    }

    public function obtenerTotalPersonas($year, $direccion){
        $query = DB::table('sinfodi_personal')
                    ->selectRaw('COUNT(clave) AS totalPersonas')
                    ->where('year', '=', $year)
                    ->where('unidad_admin', '=', $direccion)
                    ->value('totalPersonas');
        return $query;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexB()
    {
        return view('estimulos.evaluaciones.direccionServTec.sostenibilidadB.index');
    }

    public function searchSostenibilidadB($year){
        $queryEvaluados = DB::table('sinfodi_evaluados')
                            ->select('clave', 'puesto')
                            ->where('puesto', '=', 'Direccion_Servicios_Tecno')
                            ->orderby('clave', 'ASC')
                            ->get();
        foreach($queryEvaluados as $itemEvaluados){
            $clave[] = $itemEvaluados->clave;
        }
        $evaluacion_Criterio37 = self::Evaluaciones_Criterio37($clave, $year);
        $data['response'] = $evaluacion_Criterio37;
        return $this->response($data);
    }

    /** Codigo personal... */
    public static function Evaluaciones_Criterio37($clave, $year){
        $query = DB::table('sinfodi_sostentabilidad')
                        ->select('clave_participante', 'nombre_participante', 'usuario_participante', 'remanente', 'year')
                        ->where('year', '=', $year)
                        ->where('tipo', '=', 'Proyectos')
                        ->whereIn('clave_participante', $clave)
                        ->get();
        return $query;
    }

    public function saveDatosB(Request $request){
        if(EvaluacionDServTec::where('clave', '=', $request->clave)->where('year', '=', $request->year)->where('id_criterio', '=', $request->id_criterio)->count() == 0){
            $nuevo = new EvaluacionDServTec();
            $nuevo->create($request->all());
            return response()->json('exito');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function puntosB($id, $objetivo) {
        $puntos = DB::table('sinfodi_criterios')->select('puntos')->where('id', '=', $id)->where('id_objetivo', '=', $objetivo)->get();
        $data['response'] = $puntos;
        return $this->response($data);
    }

    public function datosSostenibilidadB($year, $criterio){
        $datos = DB::table('sinfodi_evaluacion_serv_tecno')->where('year', '=', $year)->where('id_criterio', '=', $criterio)->where('direccion', '=', 'DServTec')->get();
        $data['response'] = $datos;
        return $this->response($data);
    }
}
