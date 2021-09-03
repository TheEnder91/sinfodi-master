<?php

namespace App\Http\Controllers\Estimulos\Factor1;

use Illuminate\Http\Request;
use App\Traits\SingleResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Estimulos\Responsabilidad;

class ResponsabilidadesController extends Controller
{
    use SingleResponse;

    const PERMISSIONS = [
        'index' => 'estimulo-responsabilidad-index',
        'create' => 'estimulo-responsabilidad-create',
        'show' => 'estimulo-responsabilidad-show',
        'edit' => 'estimulo-responsabilidad-edit',
        'delete' => 'estimulo-responsabilidad-delete',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $responsabilidades = Responsabilidad::all();
        return view('estimulos.factores.factor1.responsabilidades.index', compact('responsabilidades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nuevo = new Responsabilidad();
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
        $datos = Responsabilidad::findOrFail($id);
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
        $actualizar = Responsabilidad::findOrFail($id);
        $actualizar->nombre = $request->nombre;
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
        DB::table('sinfodi_responsabilidades')->delete($id);
        $data['response'] = true;
        return $this->response($data);
    }
}
