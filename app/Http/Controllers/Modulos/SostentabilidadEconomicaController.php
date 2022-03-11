<?php

namespace App\Http\Controllers\Modulos;

use Illuminate\Http\Request;
use App\Traits\SingleResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Estimulos\SostentabilidadEconomica;

class SostentabilidadEconomicaController extends Controller
{
    use SingleResponse;

    const PERMISSIONS = [
        'index' => 'modulos-sostenibilidad-index',
        'createProject' => 'modulos-sostenibilidad-createProject',
        'createServEsp' => 'modulos-sostenibilidad-createServEsp',
        'createCursos' => 'modulos-sostenibilidad-createCursos',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('modulos.sostentabilidadEconomica.index');
    }

    /** Funciones con codigo personal... */
    public function getPuntos(){
        $getPuntos = DB::table('sinfodi_criterios')
                        ->select('puntos')
                        ->where('id', '=', 14)
                        ->where('id_objetivo', '=', 4)
                        ->get();
        return $getPuntos;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nuevo = new SostentabilidadEconomica();
        $nuevo->create($request->all());
        $data['response'] = true;
        return $this->response($data);
    }

    public function datosSostentabilidad($tipo){
        $query = SostentabilidadEconomica::where('tipo', $tipo)->orderBy('id', 'ASC')->get();
        return $query;
    }
}
