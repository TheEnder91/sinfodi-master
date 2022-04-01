<?php

namespace App\Http\Controllers\Estimulos\Evaluaciones\DireccionCiencia;

use Illuminate\Http\Request;
use App\Traits\SingleResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Estimulos\EvaluacionDCiencia;

class SostenibilidadDCController extends Controller
{
    use SingleResponse;

    const PERMISSIONS = [
        'index' => 'estimulo-evaluaciones-ciencia-sostentabilidad-index',
        'indexB' => 'estimulo-evaluaciones-ciencia-sostentabilidadB-index',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('estimulos.evaluaciones.direccionCiencia.sostenibilidad.index');
    }

    public function searchSostentabilidad($year){
        $queryEvaluados = DB::table('sinfodi_evaluados')
                            ->select('clave', 'puesto')
                            ->where('puesto', '=', 'Direccion_Ciencia')
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
    public function datosSostentabilidad($year, $criterio)
    {
        $datos = DB::table('sinfodi_evaluacion_ciencia')->where('year', '=', $year)->where('id_criterio', '=', $criterio)->where('direccion', '=', 'DCiencia')->get();
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
        return view('estimulos.evaluaciones.direccionCiencia.sostenibilidadB.index');
    }
}
