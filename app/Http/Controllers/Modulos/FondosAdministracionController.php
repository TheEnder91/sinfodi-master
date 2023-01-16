<?php

namespace App\Http\Controllers\Modulos;

use Illuminate\Http\Request;
use App\Traits\SingleResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Estimulos\FondosAdministracion;

class FondosAdministracionController extends Controller
{
    use SingleResponse;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('modulos.fondosAdministracion.index');
    }

    public function verFondosAdministracion(){
        $query = DB::table('sinfodi_fondos_administracion')
                    ->select('*')
                    ->get();
        $data['response'] = $query;
        return $this->response($data);
    }

    public function obtenerTotalFondosAdministracion($year){
        $query = DB::table('sinfodi_total_puntos')
                    ->select('importe_fondos_admin')
                    ->where('year', '=', $year)
                    ->get();
        return $query;
    }

    public function obtenerTotalPersonasDireccion($year, $direccion){
        $query = DB::table('sinfodi_personal')
                    ->selectRaw('COUNT(clave) AS totalPersonas')
                    ->where('year', '=', $year)
                    ->where('unidad_admin', '=', $direccion)
                    ->get();
        return $query;
    }

    public function existe($year, $idDireccion){
        $datos = DB::table('sinfodi_fondos_administracion')->where('year', '=', $year)->where('id_direccion', '=', $idDireccion)->count();
        if($datos == 0){
            $count = 0;
        }else{
            $count = 1;
        }
        $data['response'] = $count;
        return $this->response($data);
    }

    public function guardarFondosAdministracion(Request $request){
        $nuevo = new FondosAdministracion();
        $nuevo->create($request->all());
        $data['response'] = true;
        return $this->response($data);
    }

    public function getFondosAdministracion($year, $idDireccion){
        $datos = DB::table('sinfodi_fondos_administracion')->where('year', '=', $year)->where('id_direccion', '=', $idDireccion)->get();
        $data['response'] = $datos;
        return $this->response($data);
    }
}
