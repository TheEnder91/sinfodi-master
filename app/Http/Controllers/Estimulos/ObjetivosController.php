<?php

namespace App\Http\Controllers\Estimulos;

use Illuminate\Http\Request;
use App\Traits\SingleResponse;
use App\Models\Estimulos\Objetivo;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ObjetivosController extends Controller
{
    use SingleResponse;

    const PERMISSIONS = [
        'index' => 'estimulo-objetivo-index',
        'create' => 'estimulo-objetivo-create',
        'show' => 'estimulo-objetivo-show',
        'edit' => 'estimulo-objetivo-edit',
        'delete' => 'estimulo-objetivo-delete',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos = Objetivo::all();
        return view('estimulos.objetivos.index', compact('datos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nuevo = new objetivo();
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
        $datos = objetivo::findOrFail($id);
        $data['response'] = $datos;
        return $this->response($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $actualizar = Objetivo::findOrFail($id);
        $actualizar->nombre = $request->nombre;
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
        try {
            DB::table('sinfodi_objetivos')->delete($id);
            $data['response'] = true;
            return $this->response($data);
        } catch (\Throwable $th) {
            $data['response'] = false;
            return $this->response($data);
        }
    }
}
