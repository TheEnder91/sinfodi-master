<?php

namespace App\Http\Controllers\Estimulos\Evaluaciones;

use Illuminate\Http\Request;
use App\Traits\SingleResponse;
use Illuminate\Support\Facades\DB;
use App\Models\Estimulos\Evaluados;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Models\Estimulos\EvaluacionResponsabilidades;
use App\Models\Estimulos\Evaluaciones\EvaluarResponsabilidades;

class DirectoresController extends Controller
{
    use SingleResponse;

    const PERMISSIONS = [
        'index' => 'estimulo-evaluaciones-directores-index',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('estimulos.evaluaciones.responsabilidades.directores.index');
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

    public static function searchDirectores(){
        $queryDirectores = DB::table('sinfodi_evaluados')
                            ->select('clave', 'nombre', 'usuario', 'puesto')
                            ->where('puesto', '=', 'Director')
                            ->get();
        return $queryDirectores;
    }

    public static function puntos(){
        $queryPuntos = DB::table('sinfodi_responsabilidades')
                            ->select('puntos')
                            ->where('nombre', 'like', 'Director%')
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
        if(DB::table('sinfodi_evaluacion_responsabilidades')->where('clave', '=', $request->clave)->where('year', '=', $request->year)->count() == 0){
            $nuevo = new EvaluacionResponsabilidades();
            $nuevo->create($request->all());
            $data['response'] = true;
            return $this->response($data);
        }
    }

    public function getDirectores($year){
        $queryDirectores = DB::table('sinfodi_evaluacion_responsabilidades')
                                ->select('*')
                                ->where('year', '=', $year)
                                ->where('direccion', '=', 'Directores')
                                ->get();
        $data['response'] = $queryDirectores;
        return $this->response($data);
    }
}
