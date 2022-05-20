<?php

namespace App\Http\Controllers\Estimulos\Evaluaciones\DireccionGeneral;

use Illuminate\Http\Request;
use App\Traits\SingleResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Estimulos\EvaluacionDGeneral;

class TransferenciaBDGController extends Controller
{
    use SingleResponse;

    const PERMISSIONS = [
        'index' => 'estimulo-evaluaciones-general-transferenciaB-index',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexB()
    {
        $criterios = self::Get_Criterios_acreditaciones();
        return view('estimulos.evaluaciones.direcionGeneral.transferenciaB.index', compact('criterios'));
    }

    /** Funcion para obtener los criterios para la acreditaciones... */
    public static function Get_Criterios_acreditaciones(){
        $query = DB::table('sinfodi_criterios')
                    ->select('id', 'nombre', 'id_objetivo')
                    ->where('observaciones', '=', 'Tabla 1. Actividad B.')
                    ->where('id_objetivo', '=', 5)
                    ->get();
        return $query;
    }

    public function searchTransferenciaB($year, $criterio){
        $queryEvaluados = DB::table('sinfodi_evaluados')
                            ->select('clave', 'puesto')
                            ->where('puesto', '=', 'Direccion_General')
                            ->orderby('clave', 'ASC')
                            ->get();
        foreach($queryEvaluados as $itemEvaluados){
            $clave[] = $itemEvaluados->clave;
        }
        if($criterio == 38){
            $evaluacion = self::Evaluaciones_Criterio38($clave, $year);
        }elseif($criterio == 39){
            $evaluacion = self::Evaluaciones_Criterio39($clave, $year);
        }elseif($criterio == 40){
            $evaluacion = self::Evaluaciones_Criterio40($clave, $year);
        }
        $data['response'] = $evaluacion;
        return $this->response($data);
    }

    public static function Evaluaciones_Criterio38($clave, $year){
        $query = DB::table('sinfodi_sostentabilidad')
                        ->select('clave_participante', 'nombre_participante', 'usuario_participante', 'interinstitucional', 'year')
                        ->where('year', '=', $year)
                        ->where('tipo', '=', 'Proyectos')
                        ->whereIn('clave_participante', $clave)
                        ->get();
        return $query;
    }

    public static function Evaluaciones_Criterio39($clave, $year){
        $query = DB::table('sinfodi_sostentabilidad')
                        ->select('clave_participante', 'nombre_participante', 'usuario_participante', 'interdirecciones', 'year')
                        ->where('year', '=', $year)
                        ->where('tipo', '=', 'Proyectos')
                        ->whereIn('clave_participante', $clave)
                        ->get();
        return $query;
    }

    public static function Evaluaciones_Criterio40($clave, $year){
        $query = DB::table('sinfodi_sostentabilidad')
                        ->select('clave_participante', 'nombre_participante', 'usuario_participante', 'interareas', 'year')
                        ->where('year', '=', $year)
                        ->where('tipo', '=', 'Proyectos')
                        ->whereIn('clave_participante', $clave)
                        ->get();
        return $query;
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

    public function saveDatosB(Request $request){
        if(EvaluacionDGeneral::where('clave', '=', $request->clave)->where('year', '=', $request->year)->where('id_criterio', '=', $request->id_criterio)->count() == 0){
            $nuevo = new EvaluacionDGeneral();
            $nuevo->create($request->all());
            return response()->json('exito');
        }
    }

    public function datosTransferenciaB($year, $criterio){
        if($criterio == 38){
            $datos = DB::table('sinfodi_evaluacion_general')->where('year', '=', $year)->where('id_criterio', '=', $criterio)->where('direccion', '=', 'DGeneral')->get();
        }elseif($criterio == 39){
            $datos = DB::table('sinfodi_evaluacion_general')->where('year', '=', $year)->where('id_criterio', '=', $criterio)->where('direccion', '=', 'DGeneral')->get();
        }elseif($criterio == 40){
            $datos = DB::table('sinfodi_evaluacion_general')->where('year', '=', $year)->where('id_criterio', '=', $criterio)->where('direccion', '=', 'DGeneral')->get();
        }
        $data['response'] = $datos;
        return $this->response($data);
    }
}
