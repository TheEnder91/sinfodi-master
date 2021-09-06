<?php

namespace App\Http\Controllers\Estimulos\Factor2;

use Illuminate\Http\Request;
use App\Models\Estimulos\Meta;
use App\Traits\SingleResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class MetasController extends Controller
{
    use SingleResponse;

    const PERMISSIONS = [
        'index' => 'estimulo-meta-index',
        'create' => 'estimulo-meta-create',
        'show' => 'estimulo-meta-show',
        'edit' => 'estimulo-meta-edit',
        'delete' => 'estimulo-meta-delete',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $metas = Meta::all();
        return view('estimulos.factores.factor2.metas.index', compact('metas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nuevo = new Meta();
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
        $datos = Meta::findOrFail($id);
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
        $actualizar = Meta::findOrFail($id);
        $actualizar->cumplimiento = $request->cumplimiento;
        $actualizar->f2 = $request->f2;
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
        Meta::find($id)->delete();
        $data['response'] = true;
        return $this->response($data);
    }
}
