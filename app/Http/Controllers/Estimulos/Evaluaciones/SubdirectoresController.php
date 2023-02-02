<?php

namespace App\Http\Controllers\Estimulos\Evaluaciones;

use Illuminate\Http\Request;
use App\Traits\SingleResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Estimulos\EvaluacionResponsabilidades;
use App\Models\Estimulos\Evaluaciones\EvaluarResponsabilidades;

class SubdirectoresController extends Controller
{
    use SingleResponse;

    const PERMISSIONS = [
        'index' => 'estimulo-evaluaciones-subdirectores-index',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('estimulos.evaluaciones.responsabilidades.subdirectores.index');
    }

    public static function searchSubdirectores($year){
        $querySubdirectores = DB::table('sinfodi_evaluados')
                            ->select('clave', 'nombre', 'usuario', 'puesto')
                            ->where('puesto', '=', 'Subdirector')
                            ->where('year', '=', $year)
                            ->get();
        return $querySubdirectores;
    }

    public static function puntos(){
        $queryPuntos = DB::table('sinfodi_responsabilidades')
                            ->select('puntos')
                            ->where('nombre', 'like', 'Subdirector%')
                            ->get();
        return $queryPuntos;
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

    public function getSubdirectores($year){
        $querySubdirectores = DB::table('sinfodi_evaluacion_responsabilidades')
                                ->select('*')
                                ->where('year', '=', $year)
                                ->where('direccion', '=', 'Subdirectores')
                                ->get();
        $data['response'] = $querySubdirectores;
        return $this->response($data);
    }
}
