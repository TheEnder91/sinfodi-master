<?php

namespace App\Http\Controllers\Estimulos\Evaluaciones\DireccionGeneral;

use Illuminate\Http\Request;
use App\Traits\SingleResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Estimulos\EvaluacionDGeneral;

class SostentabilidadBDGController extends Controller
{
    use SingleResponse;

    const PERMISSIONS = [
        'index' => 'estimulo-evaluaciones-general-sostentabilidadB-index',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('estimulos.evaluaciones.direcionGeneral.sostentabilidadB.index');
    }

    public function searchSostenibilidadB($year){
        $queryEvaluados = DB::table('sinfodi_evaluados')
                            ->select('clave', 'puesto')
                            ->where('puesto', '=', 'Direccion_General')
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

    public function saveDatos(Request $request){
        if(EvaluacionDGeneral::where('clave', '=', $request->clave)->where('year', '=', $request->year)->where('id_criterio', '=', $request->id_criterio)->count() == 0){
            $nuevo = new EvaluacionDGeneral();
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
    public function puntos($id, $objetivo) {
        $puntos = DB::table('sinfodi_criterios')->select('puntos')->where('id', '=', $id)->where('id_objetivo', '=', $objetivo)->get();
        $data['response'] = $puntos;
        return $this->response($data);
    }

    public function datosSostenibilidadB($year, $criterio){
        $datos = DB::table('sinfodi_evaluacion_general')->where('year', '=', $year)->where('id_criterio', '=', $criterio)->where('direccion', '=', 'DGeneral')->get();
        $data['response'] = $datos;
        return $this->response($data);
    }
}
