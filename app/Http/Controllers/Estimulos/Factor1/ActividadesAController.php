<?php

namespace App\Http\Controllers\Estimulos\Factor1;

use Illuminate\Http\Request;
use App\Traits\SingleResponse;
use App\Models\Estimulos\Criterio;
use App\Models\Estimulos\Objetivo;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ActividadesAController extends Controller
{
    use SingleResponse;

    const PERMISSIONS = [
        'index' => 'estimulo-actividadA-index',
        'create' => 'estimulo-actividadA-create',
        'show' => 'estimulo-actividadA-show',
        'edit' => 'estimulo-actividadA-edit',
        'delete' => 'estimulo-actividadA-delete',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $objetivos = Objetivo::all();
        $datos = Criterio::all()->where('observaciones', '=', 'Tabla 1. Actividad A.');
        return view('estimulos.factores.factor1.actividadesA.index', compact('objetivos', 'datos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nuevo = new Criterio();
        $nuevo->create($request->all());
        $data['response'] = true;
        return $this->response($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $datos = Criterio::findOrFail($id);
        $data['response'] = $datos;
        return $this->response($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $actualizar = Criterio::findOrFail($id);
        $actualizar->nombre = $request->nombre;
        $actualizar->id_objetivo = $request->id_objetivo;
        $actualizar->puntos = $request->puntos;
        $actualizar->save();
        $data['response'] = true;
        return $this->response($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('sinfodi_criterios')->delete($id);
        $data['response'] = true;
        return $this->response($data);
    }
}
