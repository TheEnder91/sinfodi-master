<?php

namespace App\Http\Controllers\Estimulos\Evaluaciones;

use Illuminate\Http\Request;
use App\Traits\SingleResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Estimulos\EvaluacionResponsabilidades;
use App\Models\Estimulos\Evaluaciones\EvaluarResponsabilidades;

class PersonalApoyoController extends Controller
{
    use SingleResponse;

    const PERMISSIONS = [
        'index' => 'estimulo-evaluaciones-apoyo-index',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('estimulos.evaluaciones.responsabilidades.personalApoyo.index');
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

    public static function searchPersonalApoyo($year){
        $queryDirectores = DB::table('sinfodi_evaluados')
                            ->select('clave', 'nombre', 'usuario', 'puesto')
                            ->where('puesto', '=', 'Personal_Apoyo')
                            ->where('year', '=', $year)
                            ->get();
        return $queryDirectores;
    }

    public static function puntos(){
        $queryPuntos = DB::table('sinfodi_responsabilidades')
                            ->select('puntos')
                            ->where('nombre', 'like', 'Personal%')
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

    public function getPersonalApoyo($year){
        $queryPersonalApoyo = DB::table('sinfodi_evaluacion_responsabilidades')
                                ->select('*')
                                ->where('year', '=', $year)
                                ->where('direccion', '=', 'Personal_Apoyo')
                                ->get();
        $data['response'] = $queryPersonalApoyo;
        return $this->response($data);
    }
}
