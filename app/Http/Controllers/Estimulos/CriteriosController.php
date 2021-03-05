<?php

namespace App\Http\Controllers\Estimulos;

use App\Entities\Estimulos\Criterio;
use App\Entities\Estimulos\Modulo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CriteriosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modulos = Modulo::all();
        return view('estimulos.criterios.index', compact('modulos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'nombre' => 'required',
            'id_modulo' => 'required',
            'puntos' => 'required',
        ];

        $this->validate($request, $rules);

        $nuevo = new Criterio();
        if($nuevo->create($request->all())){
            return back()->with('exito', 'Guardado con exio');
        }
    }

    //Codigo personal...
    public function tabla(){
        $datos = Criterio::paginate(10);
        return view('estimulos.criterios.tabla', compact('datos'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editar = Criterio::findOrFail($id);
        return response()->json($editar);
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
        if($actualizar->update($request->all())){
            return response()->json(['ok']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $eliminar = Criterio::findOrFail($id);
        if($eliminar->delete()){
            return response()->json(['ok']);
        }
    }
}
