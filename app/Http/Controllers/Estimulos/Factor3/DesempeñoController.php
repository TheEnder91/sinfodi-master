<?php

namespace App\Http\Controllers\Estimulos\Factor3;

use Illuminate\Http\Request;
use App\Traits\SingleResponse;
use Illuminate\Support\Facades\DB;
use App\Models\Estimulos\Desempeño;
use App\Http\Controllers\Controller;

class DesempeñoController extends Controller
{
    use SingleResponse;

    const PERMISSIONS = [
        'index' => 'estimulo-desempeño-index',
        'create' => 'estimulo-desempeño-create',
        'show' => 'estimulo-desempeño-show',
        'edit' => 'estimulo-desempeño-edit',
        'delete' => 'estimulo-desempeño-delete',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $desempeño = Desempeño::all();
        return view('estimulos.factores.factor3.desempeños.index', compact('desempeño'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nuevo = new Desempeño();
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
        $datos = Desempeño::findOrFail($id);
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
        $actualizar = Desempeño::findOrFail($id);
        $actualizar->resultados = $request->resultados;
        $actualizar->f3 = $request->f3;
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
            DB::table('sinfodi_desempeños')->delete($id);
            $data['response'] = true;
            return $this->response($data);
        } catch (\Throwable $th) {
            $data['response'] = false;
            return $this->response($data);
        }
    }
}
