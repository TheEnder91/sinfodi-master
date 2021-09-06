<?php

namespace App\Http\Controllers\Estimulos\Factor2;

use Illuminate\Http\Request;
use App\Traits\SingleResponse;
use App\Models\Estimulos\Impacto;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ImpactosController extends Controller
{
    use SingleResponse;

    const PERMISSIONS = [
        'index' => 'estimulo-impacto-index',
        'create' => 'estimulo-impacto-create',
        'show' => 'estimulo-impacto-show',
        'edit' => 'estimulo-impacto-edit',
        'delete' => 'estimulo-impacto-delete',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $impacto = Impacto::all();
        return view('estimulos.factores.factor2.impacto.index', compact('impacto'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nuevo = new Impacto();
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
        $datos = Impacto::findOrFail($id);
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
        $actualizar = Impacto::findOrFail($id);
        $actualizar->factor = $request->factor;
        $actualizar->nivel = $request->nivel;
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
        Impacto::find($id)->delete();
        $data['response'] = true;
        return $this->response($data);
    }
}
