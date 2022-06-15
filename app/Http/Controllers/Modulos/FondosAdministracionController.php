<?php

namespace App\Http\Controllers\Modulos;

use Illuminate\Http\Request;
use App\Traits\SingleResponse;
use App\Http\Controllers\Controller;

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

    public function FondosAdministracionController(){

    }
}
