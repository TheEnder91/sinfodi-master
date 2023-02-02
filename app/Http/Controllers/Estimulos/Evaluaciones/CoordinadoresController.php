<?php

namespace App\Http\Controllers\Estimulos\Evaluaciones;

use Illuminate\Http\Request;
use App\Traits\SingleResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Estimulos\EvaluacionResponsabilidades;
use App\Models\Estimulos\Evaluaciones\EvaluarResponsabilidades;

class CoordinadoresController extends Controller
{
    use SingleResponse;

    const PERMISSIONS = [
        'index' => 'estimulo-evaluaciones-coordinadores-index',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('estimulos.evaluaciones.responsabilidades.coordinadores.index');
    }

    public function existe($year, $direccion){
        $existe = DB::table('sinfodi_evaluacion_responsabilidades')->where('direccion', '=', $direccion)->where('year', '=', $year)->count();
        if($existe == 0){
            $count = 0;
        }else{
            $count = 1;
        }
        $data['response'] = $count;
        return $this->response($data);
    }

    public static function searchCoordinadores($year){
        $queryDirectores = DB::table('sinfodi_evaluados')
                            ->select('clave', 'nombre', 'usuario', 'puesto', 'unidad_admin')
                            ->where('puesto', '=', 'Coordinador')
                            ->where('year', '=', $year)
                            ->get();
        return $queryDirectores;
    }

    public static function puntos(){
        $queryPuntos = DB::table('sinfodi_responsabilidades')
                            ->select('puntos')
                            ->where('nombre', 'like', 'Coordinador%')
                            ->get();
        return $queryPuntos;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nuevo = new EvaluacionResponsabilidades();
        $nuevo->create($request->all());
        $data['response'] = true;
        return $this->response($data);
    }

    public function getCoordinadores($year){
        $queryDirectores = DB::table('sinfodi_evaluacion_responsabilidades')
                                ->select('*')
                                ->where('year', '=', $year)
                                ->where('direccion', '=', 'Coordinadores')
                                ->get();
        $data['response'] = $queryDirectores;
        return $this->response($data);
    }
}
