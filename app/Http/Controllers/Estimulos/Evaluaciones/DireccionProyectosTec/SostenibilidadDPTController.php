<?php

namespace App\Http\Controllers\Estimulos\Evaluaciones\DireccionProyectosTec;

use Illuminate\Http\Request;
use App\Traits\SingleResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Estimulos\EvaluacionDProyTec;

class SostenibilidadDPTController extends Controller
{
    use SingleResponse;

    const PERMISSIONS = [
        'index' => 'estimulo-evaluaciones-proyectos-sostentabilidad-index',
        'indexB' => 'estimulo-evaluaciones-proyectos-sostentabilidadB-index',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('estimulos.evaluaciones.direccionProyTec.sostenibilidad.index');
    }

    public function searchSostentabilidad($year){
        $queryEvaluados = DB::table('sinfodi_evaluados')
                            ->select('clave', 'puesto')
                            ->where('puesto', '=', 'Direccion_Proyectos_Tecno')
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
    public function datosSostentabilidad($year, $criterio)
    {
        $datos = DB::table('sinfodi_evaluacion_proy_tecno')->where('year', '=', $year)->where('id_criterio', '=', $criterio)->where('direccion', '=', 'DProyTec')->get();
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
        return view('estimulos.evaluaciones.direccionProyTec.sostenibilidadB.index');
    }

    public function searchSostenibilidadB($year){
        $queryEvaluados = DB::table('sinfodi_evaluados')
                            ->select('clave', 'puesto')
                            ->where('puesto', '=', 'Direccion_Proyectos_Tecno')
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
                        ->orderBy('clave_participante', 'ASC')
                        ->get();
        return $query;
    }

    public function saveDatosB(Request $request){
        if(EvaluacionDProyTec::where('clave', '=', $request->clave)->where('year', '=', $request->year)->where('id_criterio', '=', $request->id_criterio)->count() == 0){
            $nuevo = new EvaluacionDProyTec();
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
        $datos = DB::table('sinfodi_evaluacion_proy_tecno')->where('year', '=', $year)->where('id_criterio', '=', $criterio)->where('direccion', '=', 'DProyTec')->get();
        $data['response'] = $datos;
        return $this->response($data);
    }
}