<?php

namespace App\Http\Controllers\Modulos;

use Illuminate\Http\Request;
use App\Traits\SingleResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Estimulos\SostentabilidadEconomica;

class SostentabilidadEconomicaController extends Controller
{
    use SingleResponse;

    const PERMISSIONS = [
        'index' => 'modulos-sostenibilidad-index',
        'createProject' => 'modulos-sostenibilidad-createProject',
        'createServEsp' => 'modulos-sostenibilidad-createServEsp',
        'createCursos' => 'modulos-sostenibilidad-createCursos',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('modulos.sostentabilidadEconomica.index');
    }

    /** Funciones con codigo personal... */
    public function getPuntos(){
        $getPuntos = DB::table('sinfodi_criterios')
                        ->select('puntos')
                        ->where('id', '=', 14)
                        ->where('id_objetivo', '=', 4)
                        ->get();
        return $getPuntos;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nuevo = new SostentabilidadEconomica();
        $nuevo->create($request->all());
        $data['response'] = true;
        return $this->response($data);
    }

    public function datosSostentabilidad($tipo){
        $query = SostentabilidadEconomica::where('tipo', $tipo)->orderBy('id', 'ASC')->get();
        return $query;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $year
     * @return \Illuminate\Http\Response
     */
    public function getSostentabilidad($id, $year)
    {
        $datos = DB::table('sinfodi_sostentabilidad')
                    ->where('id', '=', $id)
                    ->where('year', '=', $year)
                    ->get();
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
        $actualizar = SostentabilidadEconomica::findOrFail($id);
        $actualizar->cgn = $request->cgn;
        $actualizar->nombre = $request->nombre;
        $actualizar->clave_responsable = $request->clave_responsable;
        $actualizar->nombre_responsable = $request->nombre_responsable;
        $actualizar->usuario_responsable = $request->usuario_responsable;
        $actualizar->clave_participante = $request->clave_participante;
        $actualizar->nombre_participante = $request->nombre_participante;
        $actualizar->usuario_participante = $request->usuario_participante;
        $actualizar->lider_responsable = $request->lider_responsable;
        $actualizar->participante = $request->participante;
        $actualizar->porcentaje_participacion = $request->porcentaje_participacion;
        $actualizar->monto_ingresado = $request->monto_ingresado;
        $actualizar->ingreso_participacion = $request->ingreso_participacion;
        $actualizar->remanente = $request->remanente;
        $actualizar->interinstitucional = $request->interinstitucional;
        $actualizar->interareas = $request->interareas;
        $actualizar->puntos_totales = $request->puntos_totales;
        $actualizar->puntos_lider = $request->puntos_lider;
        $actualizar->nuevos_puntos_totales = $request->nuevos_puntos_totales;
        $actualizar->puntos_participacion = $request->puntos_participacion;
        $actualizar->total = $request->total;
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
        SostentabilidadEconomica::find($id)->delete();
        $data['response'] = true;
        return $this->response($data);
    }
}
