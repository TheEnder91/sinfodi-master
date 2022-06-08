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
        $puntosTotalesGeneral = self::TotalesPuntosGeneral($year);
        $puntosTotalesAdmnistracion = self::TotalesPuntosAdmnistracion($year);
        $puntosTotalesPosgrado = self::TotalesPuntosPosgrado($year);
        $puntosTotalesServicios = self::TotalesPuntosServicios($year);
        $puntosTotalesCiencia = self::TotalesPuntosCiencia($year);
        $puntosTotalesTecnologia = self::TotalesPuntosTecnologia($year);
        $totalPuntosA = array_merge($puntosTotalesGeneral, $puntosTotalesAdmnistracion, $puntosTotalesPosgrado, $puntosTotalesServicios, $puntosTotalesCiencia, $puntosTotalesTecnologia);
        $data['response'] = $totalPuntosA;
        return $this->response($data);
    }

    public static function TotalesPuntosGeneral($year){
        $totalPuntosAGeneral = DB::select('
            SELECT SUM(contar.total_puntos) * 0.3 AS totalGeneral
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
        return $totalPuntosAGeneral;
    }

    public static function TotalesPuntosAdmnistracion($year){
        $totalPuntosAAdministracion = DB::select('
            SELECT SUM(contar.total_puntos) * 0.3 AS totalAdministracion
            FROM (SELECT clave, nombre, SUM(total_puntos) AS total_puntos
                  FROM sinfodi_evaluacion_administracion
                  WHERE year = 2020 AND (id_criterio BETWEEN 1 AND 35)
                  GROUP BY clave, nombre
                  UNION ALL
                  SELECT clave, nombre, "0" AS total_puntos
                  FROM sinfodi_evaluacion_responsabilidades
                  WHERE responsabilidad = "Dirección de Administración" AND year = 2020 AND (direccion = "Directores" OR direccion = "Subdirectores")
                  GROUP BY clave, nombre) AS contar
        ');
        return $totalPuntosAAdministracion;
    }

    public static function TotalesPuntosPosgrado($year){
        $totalPuntosAPosgrado = DB::select('
            SELECT SUM(contar.total_puntos) * 0.3 AS totalPosgrado
            FROM (SELECT clave, nombre, SUM(total_puntos) AS total_puntos
                  FROM sinfodi_evaluacion_posgrado
                  WHERE year = 2020 AND (id_criterio BETWEEN 1 AND 35)
                  GROUP BY clave, nombre
                  UNION ALL
                  SELECT clave, nombre, "0" AS total_puntos
                  FROM sinfodi_evaluacion_responsabilidades
                  WHERE responsabilidad = "Dirección de Posgrado" AND year = 2020 AND (direccion = "Directores" OR direccion = "Subdirectores")
                  GROUP BY clave, nombre) AS contar
        ');
        return $totalPuntosAPosgrado;
    }

    public static function TotalesPuntosServicios($year){
        $totalPuntosAServicios = DB::select('
            SELECT SUM(contar.total_puntos) * 0.3 AS totalServicios
            FROM (SELECT clave, nombre, SUM(total_puntos) AS total_puntos
                FROM sinfodi_evaluacion_serv_tecno
                WHERE year = 2020 AND (id_criterio BETWEEN 1 AND 35)
                GROUP BY clave, nombre
                UNION ALL
                SELECT clave, nombre, "0" AS total_puntos
                FROM sinfodi_evaluacion_responsabilidades
                WHERE responsabilidad = "Dirección de Servicios Tecnológicos" AND year = 2020 AND (direccion = "Directores" OR direccion = "Subdirectores")
                GROUP BY clave, nombre) AS contar
        ');
        return $totalPuntosAServicios;
    }

    public static function TotalesPuntosCiencia($year){
        $totalPuntosACiencia = DB::select('
            SELECT SUM(contar.total_puntos) * 0.3 AS totalCiencia
            FROM (SELECT clave, nombre, SUM(total_puntos) AS total_puntos
                FROM sinfodi_evaluacion_ciencia
                WHERE year = 2020 AND (id_criterio BETWEEN 1 AND 35)
                GROUP BY clave, nombre
                UNION ALL
                SELECT clave, nombre, "0" AS total_puntos
                FROM sinfodi_evaluacion_responsabilidades
                WHERE responsabilidad = "Dirección de Ciencia" AND year = 2020 AND (direccion = "Directores" OR direccion = "Subdirectores")
                GROUP BY clave, nombre) AS contar
        ');
        return $totalPuntosACiencia;
    }

    public static function TotalesPuntosTecnologia($year){
        $totalPuntosATecnologia = DB::select('
            SELECT SUM(contar.total_puntos) * 0.3 AS totalTecnologia
            FROM (SELECT clave, nombre, SUM(total_puntos) AS total_puntos
                FROM sinfodi_evaluacion_proy_tecno
                WHERE year = 2020 AND (id_criterio BETWEEN 1 AND 35)
                GROUP BY clave, nombre
                UNION ALL
                SELECT clave, nombre, "0" AS total_puntos
                FROM sinfodi_evaluacion_responsabilidades
                WHERE responsabilidad = "Dirección de Tecnología" AND year = 2020 AND (direccion = "Directores" OR direccion = "Subdirectores")
                GROUP BY clave, nombre) AS contar
        ');
        return $totalPuntosATecnologia;
    }

    public function verTotalPuntosB($year){
        $puntosTotalesGeneralB = self::TotalesPuntosGeneralB($year);
        $puntosTotalesAdmnistracionB = self::TotalesPuntosAdmnistracionB($year);
        $puntosTotalesPosgradoB = self::TotalesPuntosPosgradoB($year);
        $puntosTotalesServiciosB = self::TotalesPuntosServiciosB($year);
        $puntosTotalesCienciaB = self::TotalesPuntosCienciaB($year);
        $puntosTotalesTecnologiaB = self::TotalesPuntosTecnologiaB($year);
        $totalPuntosB = array_merge($puntosTotalesGeneralB, $puntosTotalesAdmnistracionB, $puntosTotalesPosgradoB, $puntosTotalesServiciosB, $puntosTotalesCienciaB, $puntosTotalesTecnologiaB);
        $data['response'] = $totalPuntosB;
        return $this->response($data);
    }

    public static function TotalesPuntosGeneralB($year){
        $totalPuntosAGeneral = DB::select('
            SELECT SUM(contar.total_puntos) * 0.7 AS totalGeneralB
            FROM (SELECT clave, nombre, SUM(total_puntos) AS total_puntos
                  FROM sinfodi_evaluacion_general
                  WHERE year = 2020 AND (id_criterio BETWEEN 36 AND 41)
                  GROUP BY clave, nombre
                  UNION ALL
                  SELECT clave, nombre, "0" AS total_puntos
                  FROM sinfodi_evaluacion_responsabilidades
                  WHERE responsabilidad = "Dirección General" AND year = 2020 AND (direccion = "Directores" OR direccion = "Subdirectores")
                  GROUP BY clave, nombre) AS contar
        ');
        return $totalPuntosAGeneral;
    }

    public static function TotalesPuntosAdmnistracionB($year){
        $totalPuntosAAdministracion = DB::select('
            SELECT SUM(contar.total_puntos) * 0.7 AS totalAdministracionB
            FROM (SELECT clave, nombre, SUM(total_puntos) AS total_puntos
                  FROM sinfodi_evaluacion_administracion
                  WHERE year = 2020 AND (id_criterio BETWEEN 36 AND 41)
                  GROUP BY clave, nombre
                  UNION ALL
                  SELECT clave, nombre, "0" AS total_puntos
                  FROM sinfodi_evaluacion_responsabilidades
                  WHERE responsabilidad = "Dirección de Administración" AND year = 2020 AND (direccion = "Directores" OR direccion = "Subdirectores")
                  GROUP BY clave, nombre) AS contar
        ');
        return $totalPuntosAAdministracion;
    }

    public static function TotalesPuntosPosgradoB($year){
        $totalPuntosAPosgrado = DB::select('
            SELECT SUM(contar.total_puntos) * 0.7 AS totalPosgradoB
            FROM (SELECT clave, nombre, SUM(total_puntos) AS total_puntos
                  FROM sinfodi_evaluacion_posgrado
                  WHERE year = 2020 AND (id_criterio BETWEEN 36 AND 41)
                  GROUP BY clave, nombre
                  UNION ALL
                  SELECT clave, nombre, "0" AS total_puntos
                  FROM sinfodi_evaluacion_responsabilidades
                  WHERE responsabilidad = "Dirección de Posgrado" AND year = 2020 AND (direccion = "Directores" OR direccion = "Subdirectores")
                  GROUP BY clave, nombre) AS contar
        ');
        return $totalPuntosAPosgrado;
    }

    public static function TotalesPuntosServiciosB($year){
        $totalPuntosAServicios = DB::select('
            SELECT SUM(contar.total_puntos) * 0.7 AS totalServiciosB
            FROM (SELECT clave, nombre, SUM(total_puntos) AS total_puntos
                FROM sinfodi_evaluacion_serv_tecno
                WHERE year = 2020 AND (id_criterio BETWEEN 36 AND 41)
                GROUP BY clave, nombre
                UNION ALL
                SELECT clave, nombre, "0" AS total_puntos
                FROM sinfodi_evaluacion_responsabilidades
                WHERE responsabilidad = "Dirección de Servicios Tecnológicos" AND year = 2020 AND (direccion = "Directores" OR direccion = "Subdirectores")
                GROUP BY clave, nombre) AS contar
        ');
        return $totalPuntosAServicios;
    }

    public static function TotalesPuntosCienciaB($year){
        $totalPuntosACiencia = DB::select('
            SELECT SUM(contar.total_puntos) * 0.7 AS totalCienciaB
            FROM (SELECT clave, nombre, SUM(total_puntos) AS total_puntos
                FROM sinfodi_evaluacion_ciencia
                WHERE year = 2020 AND (id_criterio BETWEEN 36 AND 41)
                GROUP BY clave, nombre
                UNION ALL
                SELECT clave, nombre, "0" AS total_puntos
                FROM sinfodi_evaluacion_responsabilidades
                WHERE responsabilidad = "Dirección de Ciencia" AND year = 2020 AND (direccion = "Directores" OR direccion = "Subdirectores")
                GROUP BY clave, nombre) AS contar
        ');
        return $totalPuntosACiencia;
    }

    public static function TotalesPuntosTecnologiaB($year){
        $totalPuntosATecnologia = DB::select('
            SELECT SUM(contar.total_puntos) * 0.7 AS totalTecnologiaB
            FROM (SELECT clave, nombre, SUM(total_puntos) AS total_puntos
                FROM sinfodi_evaluacion_proy_tecno
                WHERE year = 2020 AND (id_criterio BETWEEN 36 AND 41)
                GROUP BY clave, nombre
                UNION ALL
                SELECT clave, nombre, "0" AS total_puntos
                FROM sinfodi_evaluacion_responsabilidades
                WHERE responsabilidad = "Dirección de Tecnología" AND year = 2020 AND (direccion = "Directores" OR direccion = "Subdirectores")
                GROUP BY clave, nombre) AS contar
        ');
        return $totalPuntosATecnologia;
    }
}
