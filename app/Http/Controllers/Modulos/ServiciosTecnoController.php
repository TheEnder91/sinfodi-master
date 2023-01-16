<?php

namespace App\Http\Controllers\Modulos;

use Illuminate\Http\Request;
use App\Traits\SingleResponse;
use App\Http\Controllers\Controller;
use App\Models\Estimulos\ServiciosTecnologicos;

class ServiciosTecnoController extends Controller
{
    use SingleResponse;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('modulos.serviciosTecnologicos.index');
    }

    public function getDatos(){
        $query = ServiciosTecnologicos::get();
        $data["response"] = $query;
        return $this->response($data);
    }

    public function saveDatos(Request $request){
        $nuevo = new ServiciosTecnologicos();
        $nuevo->create($request->all());
        $data['response'] = true;
        return $this->response($data);
    }
}
