<?php

namespace App\Http\Controllers\Modulos;

use Illuminate\Http\Request;
use App\Traits\SingleResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Estimulos\PuntosTotales;

class PuntosTotalesController extends Controller
{
    use SingleResponse;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('modulos.puntosTotales.index');
    }

    public function getTotalPuntos(){
        $datos = PuntosTotales::get();
        $data['response'] = $datos;
        return $this->response($data);
    }

    public function sumarPuntosTotales($year){
        $query = DB::table('sinfodi_evaluacion_responsabilidades')
                    ->selectRaw('SUM(puntos) AS suma')
                    ->where('year', '=', $year)
                    ->get();
        return $query;
    }

    public function existe($year){
        $datos = DB::table('sinfodi_total_puntos')->where('year', '=', $year)->count();
        if($datos == 0){
            $count = 0;
        }else{
            $count = 1;
        }
        $data['response'] = $count;
        return $this->response($data);
    }

    public function guardarTotalPuntos(Request $request){
        $nuevo = new PuntosTotales();
        $nuevo->create($request->all());
        $data['response'] = true;
        return $this->response($data);
    }

    public function verTotalPuntos($id, $year){
        $datos = DB::table('sinfodi_total_puntos')
                    ->where('id', '=', $id)
                    ->where('year', '=', $year)
                    ->get();
        $data['response'] = $datos;
        return $this->response($data);
    }

    public function verTotalPuntosA($year){
        $puntosTotalesCiencia = self::TotalesPuntosCiencia($year);
        $data['response'] = $puntosTotalesCiencia;
        return $this->response($data);
    }

    public static function TotalesPuntosCiencia($year){
        $totalPuntosACiencia = DB::select('
            SELECT SUM(contar.total_puntos) * 0.3 AS totalCiencia
            FROM (SELECT clave, nombre, SUM(total_puntos) AS total_puntos
                  FROM sinfodi_evaluacion_general
                  WHERE year = 2020 AND (id_criterio BETWEEN 1 AND 35)
                  GROUP BY clave, nombre
                  UNION ALL
                  SELECT clave, nombre, "0" AS total_puntos
                  FROM sinfodi_evaluacion_responsabilidades
                  WHERE responsabilidad = "Dirección General" AND year = 2020 AND (direccion = "Directores" OR direccion = "Subdirectores")
                  GROUP BY clave, nombre) AS contar
        ');
        return $totalPuntosACiencia;
    }
}
