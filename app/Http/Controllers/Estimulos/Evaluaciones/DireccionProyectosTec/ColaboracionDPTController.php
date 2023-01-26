<?php

namespace App\Http\Controllers\Estimulos\Evaluaciones\DireccionProyectosTec;

use Illuminate\Http\Request;
use App\Traits\SingleResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Estimulos\EvaluacionDProyTec;

class ColaboracionDPTController extends Controller
{
    use SingleResponse;

    const PERMISSIONS = [
        'index' => 'estimulo-evaluaciones-proyectos-colaboracion-index',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('estimulos.evaluaciones.direccionProyTec.colaboracion.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $year
     * @return \Illuminate\Http\Response
     */
    public function searchColaboradores($year)
    {
        $queryEvaluados = DB::table('sinfodi_evaluados')
                            ->select('clave', 'puesto')
                            ->where('puesto', '=', 'Direccion_Proyectos_Tecno')
                            ->where('year', $year)
                            ->orderby('clave', 'ASC')
                            ->get();
        foreach($queryEvaluados as $itemEvaluados){
            $clave[] = $itemEvaluados->clave;
        }
        $evaluacion_dif_div = self::Evaluaciones_Colaboradores($clave, $year);
        $data['response'] = $evaluacion_dif_div;
        return $this->response($data);
    }

    /** Codigo personal... */
    public static function Evaluaciones_Colaboradores($clave, $year){
        $query = DB::table('sinfodi_colaboracion')
                        ->select('*')
                        ->where('year', '=', $year)
                        ->whereIn('clave', $clave)
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
    public function datosColaboradores($year, $criterio)
    {
        $datos = DB::table('sinfodi_evaluacion_proy_tecno')->where('year', '=', $year)->where('id_criterio', '=', $criterio)->where('direccion', '=', 'DProyTec')->get();
        $data['response'] = $datos;
        return $this->response($data);
    }

    public function getComiteColaboracion($year, $clave){
        $query = DB::table('sinfodi_colaboracion')
                    ->select('comites')
                    ->where('year', '=', $year)
                    ->where('clave', '=', $clave)
                    ->value('comites');
        $comite = explode(',', $query);
        $queryComites = DB::table('sinfodi_comites')
                            ->where('year', '=', $year)
                            ->whereIn('consecutivo', $comite)
                            ->get();
        return $queryComites;
    }
}
