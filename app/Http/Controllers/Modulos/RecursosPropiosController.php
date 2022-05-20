<?php

namespace App\Http\Controllers\Modulos;

use Illuminate\Http\Request;
use App\Traits\SingleResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class RecursosPropiosController extends Controller
{
    use SingleResponse;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('modulos.recursosPropios.index');
    }

    public function obtenerDatos($year){
        $query = DB::table('sinfodi_total_puntos')
                    ->select('importe_facturacion')
                    ->where('year', '=', $year)
                    ->get();
        return $query;
    }
}
