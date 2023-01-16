<?php

namespace App\Http\Controllers\Estimulos\Evaluaciones\DireccionServiciosTec;

use Illuminate\Http\Request;
use App\Traits\SingleResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Estimulos\EvaluacionDServTec;
use App\Models\Estimulos\EvidenciasDServTec;

class AcreditacionesDSTController extends Controller
{
    use SingleResponse;

    const PERMISSIONS = [
        'index' => 'estimulo-evaluaciones-servicios-acreditaciones-index',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $criterios = self::Get_Criterios_acreditaciones();
        return view('estimulos.evaluaciones.direccionServTec.acreditaciones.index', compact('criterios'));
    }

    /** Funcion para obtener los criterios para la acreditaciones... */
    public static function Get_Criterios_acreditaciones(){
        $query = DB::table('sinfodi_criterios')
                    ->select('id', 'nombre', 'id_objetivo')
                    ->where('observaciones', '=', 'Tabla 1. Actividad A.')
                    ->where('id_objetivo', '=', 8)
                    ->get();
        return $query;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $year
     * @return \Illuminate\Http\Response
     */
    public function searchAcreditaciones($year, $criterio){
        $queryEvaluados = DB::table('sinfodi_evaluados')
                            ->select('clave', 'puesto')
                            ->where('puesto', '=', 'Direccion_Servicios_Tecno')
                            ->orderby('clave', 'ASC')
                            ->get();
        foreach($queryEvaluados as $itemEvaluados){
            $clave[] = $itemEvaluados->clave;
        }
        $fechaInicial = $year.'-01-01';
        $fechaFinal = $year.'-12-31';
        if($criterio == 33){
            $evaluacion_acreditaciones = self::Evaluacion_Criterio33($clave, $fechaInicial, $fechaFinal);
        }elseif($criterio == 34){
            $evaluacion_acreditaciones = self::Evaluacion_Criterio34($clave, $fechaInicial, $fechaFinal);
        }elseif($criterio == 35){
            $evaluacion_acreditaciones = self::Evaluacion_Criterio35($clave, $fechaInicial, $fechaFinal);
        }
        $data['response'] = $evaluacion_acreditaciones;
        return $this->response($data);
    }

    public static function Evaluacion_Criterio33($clave, $inicial, $final){
        $queryPersona = DB::connection('acreditaciones')->table('performancetests')
                                ->selectRaw('persons.employees_number AS numeroPersonal, persons.employees_name_p AS nombrePersonal, performancetests.is_group_or_person')
                                ->join('persons', 'persons.groups_id', '=', 'performancetests.groups_id')
                                ->whereBetween('performancetests.date_end', [$inicial, $final])
                                ->whereIn('persons.employees_number', $clave)
                                ->where('performancetests.is_group_or_person', '=', 0)
                                ->distinct();

        $queryGrupo = DB::connection('acreditaciones')->table('performancetests')
                                ->selectRaw('employees_number AS numeroPersonal, employees_name AS nombrePersonal, is_group_or_person')
                                ->whereBetween('date_end', [$inicial, $final])
                                ->whereIn('employees_number', $clave)
                                ->where('is_group_or_person', '=', 1)
                                ->distinct()
                                ->unionAll($queryPersona);

        $queryCriterio33 = DB::connection('acreditaciones')->table($queryGrupo)
                                ->selectRaw('numeroPersonal, nombrePersonal')
                                ->distinct()
                                ->groupBy('numeroPersonal')
                                ->groupBy('nombrePersonal')
                                ->orderBy('numeroPersonal', 'ASC')
                                ->get();
        return $queryCriterio33;
    }

    public static function Evaluacion_Criterio34($clave, $inicial, $final){
        $queryPersona = DB::connection('acreditaciones')->table('accreditedtechniques')
                                ->selectRaw('persons.employees_number AS numeroPersonal, persons.employees_name_p AS nombrePersonal, accreditedtechniques.is_group_or_person')
                                ->join('persons', 'persons.groups_id', '=', 'accreditedtechniques.groups_id')
                                ->whereBetween('accreditedtechniques.date_end', [$inicial, $final])
                                ->whereIn('persons.employees_number', $clave)
                                ->where('accreditedtechniques.is_group_or_person', '=', 0)
                                ->distinct();

        $queryGrupo = DB::connection('acreditaciones')->table('accreditedtechniques')
                                ->selectRaw('employees_number AS numeroPersonal, employees_name AS nombrePersonal, is_group_or_person')
                                ->whereBetween('date_end', [$inicial, $final])
                                ->whereIn('employees_number', $clave)
                                ->where('is_group_or_person', '=', 1)
                                ->distinct()
                                ->unionAll($queryPersona);

        $queryCriterio34 = DB::connection('acreditaciones')->table($queryGrupo)
                                ->selectRaw('numeroPersonal, nombrePersonal')
                                ->distinct()
                                ->groupBy('numeroPersonal')
                                ->groupBy('nombrePersonal')
                                ->orderBy('numeroPersonal', 'ASC')
                                ->get();
        return $queryCriterio34;
    }

    public static function Evaluacion_Criterio35($clave, $inicial, $final){
        $queryPersona = DB::connection('acreditaciones')->table('interlaboratorytests')
                                ->selectRaw('persons.employees_number AS numeroPersonal, persons.employees_name_p AS nombrePersonal, interlaboratorytests.is_group_or_person')
                                ->join('persons', 'persons.groups_id', '=', 'interlaboratorytests.groups_id')
                                ->whereBetween('interlaboratorytests.date_end', [$inicial, $final])
                                ->whereIn('persons.employees_number', $clave)
                                ->where('interlaboratorytests.is_group_or_person', '=', 0)
                                ->distinct();

        $queryGrupo = DB::connection('acreditaciones')->table('interlaboratorytests')
                                ->selectRaw('employees_number AS numeroPersonal, employees_name AS nombrePersonal, is_group_or_person')
                                ->whereBetween('date_end', [$inicial, $final])
                                ->whereIn('employees_number', $clave)
                                ->where('is_group_or_person', '=', 1)
                                ->distinct()
                                ->unionAll($queryPersona);

        $queryCriterio34 = DB::connection('acreditaciones')->table($queryGrupo)
                                ->selectRaw('numeroPersonal, nombrePersonal')
                                ->distinct()
                                ->groupBy('numeroPersonal')
                                ->groupBy('nombrePersonal')
                                ->orderBy('numeroPersonal', 'ASC')
                                ->get();
        return $queryCriterio34;
    }

    /** Funcion para obtener el username de los participantes... */
    public function searchUsername($clave){
        $queryUsername = DB::table('sinfodi_evaluados')
                            ->select('username')
                            ->where('clave', '=', $clave)
                            ->get();
        $data['response'] = $queryUsername;
        return $this->response($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveDatos(Request $request)
    {
        if(EvaluacionDServTec::where('clave', '=', $request->clave)->where('year', '=', $request->year)->where('id_criterio', '=', $request->id_criterio)->count() == 0){
            $nuevo = new EvaluacionDServTec();
            $nuevo->create($request->all());
            return response()->json('exito');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $year
     * @return \Illuminate\Http\Response
     */
    public function datosAcreditaciones($year, $criterio)
    {
        if($criterio == 33){
            $datos = DB::table('sinfodi_evaluacion_serv_tecno')->where('year', '=', $year)->where('id_criterio', '=', $criterio)->get();
        }elseif($criterio == 34){
            $datos = DB::table('sinfodi_evaluacion_serv_tecno')->where('year', '=', $year)->where('id_criterio', '=', $criterio)->get();
        }elseif($criterio == 35){
            $datos = DB::table('sinfodi_evaluacion_serv_tecno')->where('year', '=', $year)->where('id_criterio', '=', $criterio)->get();
        }
        $data['response'] = $datos;
        return $this->response($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $year
     * @return \Illuminate\Http\Response
     */
    public function searchEvidencias($year, $clave, $criterio){
        $fechaInicial = $year.'-01-01';
        $fechaFinal = $year.'-12-31';
        if($criterio == 33){
            $evidencias_acreditaciones = self::Evidencias_Criterio33($clave, $fechaInicial, $fechaFinal);
        }elseif($criterio == 34){
            $evidencias_acreditaciones = self::Evidencias_Criterio34($clave, $fechaInicial, $fechaFinal);
        }elseif($criterio == 35){
            $evidencias_acreditaciones = self::Evidencias_Criterio35($clave, $fechaInicial, $fechaFinal);
        }
        $data['response'] = $evidencias_acreditaciones;
        return $this->response($data);
    }

    public static function Evidencias_Criterio33($clave, $fechaInicial, $fechaFinal){
        $queryPersona = DB::connection('acreditaciones')->table('performancetests')
                                ->selectRaw('persons.employees_number AS numeroPersonal, persons.employees_name_p AS nombrePersonal, performancetests.file AS archivo, performancetests.name AS nombre, performancetests.is_group_or_person')
                                ->join('persons', 'persons.groups_id', '=', 'performancetests.groups_id')
                                ->whereBetween('performancetests.date_end', [$fechaInicial, $fechaFinal])
                                ->where('persons.employees_number', $clave)
                                ->where('performancetests.is_group_or_person', '=', 0);

        $queryGrupo = DB::connection('acreditaciones')->table('performancetests')
                                ->selectRaw('employees_number AS numeroPersonal, employees_name AS nombrePersonal, file AS archivo, name AS nombre, is_group_or_person')
                                ->whereBetween('date_end', [$fechaInicial, $fechaFinal])
                                ->where('employees_number', $clave)
                                ->where('is_group_or_person', '=', 1)
                                ->unionAll($queryPersona);

        $queryCriterio33 = DB::connection('acreditaciones')->table($queryGrupo)
                                ->selectRaw('numeroPersonal, nombrePersonal, archivo, nombre')
                                ->orderBy('numeroPersonal', 'ASC')
                                ->get();
        return $queryCriterio33;
    }

    public static function Evidencias_Criterio34($clave, $fechaInicial, $fechaFinal){
        $queryPersona = DB::connection('acreditaciones')->table('accreditedtechniques')
                                ->selectRaw('persons.employees_number AS numeroPersonal, persons.employees_name_p AS nombrePersonal, accreditedtechniques.file AS archivo, accreditedtechniques.name AS nombre, accreditedtechniques.is_group_or_person')
                                ->join('persons', 'persons.groups_id', '=', 'accreditedtechniques.groups_id')
                                ->whereBetween('accreditedtechniques.date_end', [$fechaInicial, $fechaFinal])
                                ->where('persons.employees_number', $clave)
                                ->where('accreditedtechniques.is_group_or_person', '=', 0);

        $queryGrupo = DB::connection('acreditaciones')->table('accreditedtechniques')
                                ->selectRaw('employees_number AS numeroPersonal, employees_name AS nombrePersonal, file AS archivo, name AS nombre, is_group_or_person')
                                ->whereBetween('date_end', [$fechaInicial, $fechaFinal])
                                ->where('employees_number', $clave)
                                ->where('is_group_or_person', '=', 1)
                                ->unionAll($queryPersona);

        $queryCriterio34 = DB::connection('acreditaciones')->table($queryGrupo)
                                ->selectRaw('numeroPersonal, nombrePersonal, archivo, nombre')
                                ->orderBy('numeroPersonal', 'ASC')
                                ->get();
        return $queryCriterio34;
    }

    public static function Evidencias_Criterio35($clave, $fechaInicial, $fechaFinal){
        $queryPersona = DB::connection('acreditaciones')->table('interlaboratorytests')
                                ->selectRaw('persons.employees_number AS numeroPersonal, persons.employees_name_p AS nombrePersonal, interlaboratorytests.file AS archivo, interlaboratorytests.name AS nombre, interlaboratorytests.is_group_or_person')
                                ->join('persons', 'persons.groups_id', '=', 'interlaboratorytests.groups_id')
                                ->whereBetween('interlaboratorytests.date_end', [$fechaInicial, $fechaFinal])
                                ->where('persons.employees_number', $clave)
                                ->where('interlaboratorytests.is_group_or_person', '=', 0);

        $queryGrupo = DB::connection('acreditaciones')->table('interlaboratorytests')
                                ->selectRaw('employees_number AS numeroPersonal, employees_name AS nombrePersonal, file AS archivo, name AS nombre, is_group_or_person')
                                ->whereBetween('date_end', [$fechaInicial, $fechaFinal])
                                ->where('employees_number', $clave)
                                ->where('is_group_or_person', '=', 1)
                                ->unionAll($queryPersona);

        $queryCriterio34 = DB::connection('acreditaciones')->table($queryGrupo)
                                ->selectRaw('numeroPersonal, nombrePersonal, archivo, nombre')
                                ->orderBy('numeroPersonal', 'ASC')
                                ->get();
        return $queryCriterio34;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function puntos($id, $objetivo) {
        $puntos = DB::table('sinfodi_criterios')->select('puntos')->where('id', '=', $id)->where('id_objetivo', '=', $objetivo)->get();
        $data['response'] = $puntos;
        return $this->response($data);
    }

    //** Codigo personal */
    public function getEvidencias($clave, $year, $criterio){
        $obtener = EvidenciasDServTec::where('clave', '=', $clave)->where('id_criterio', '=', $criterio)->where('year', '=', $year)->get();
        $data['response'] = $obtener;
        return $this->response($data);
    }

    //** Codigo personal */
    public function obtenerEvidencias($clave, $year, $criterio){
        if(EvidenciasDServTec::where('clave', '=', $clave)->where('year', '=', $year)->where('id_criterio', '=', $criterio)->count() == 0){
            $count = 0;
        }else{
            $count = 1;
        }
        $data['response'] = $count;
        return $this->response($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function savePuntos(Request $request)
    {
        EvidenciasDServTec::create($request->all());
        $data['response'] = true;
        return $this->response($data);
    }

    /** Codigo personal */
    public static function updateDatos(Request $request){
        $actualizar = EvidenciasDServTec::where('clave', $request->clave)
                                            ->where('id_criterio', $request->id_criterio)
                                            ->where('year', $request->year)
                                            ->update(['evidencias' => $request->evidencias, 'puntos' => $request->puntos, 'total_puntos' => $request->total_puntos]);
        return $actualizar;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateDatosPuntos(Request $request)
    {
        $actualizar = EvaluacionDServTec::where('clave', $request->clave)
                                            ->where('id_criterio', $request->id_criterio)
                                            ->where('year', $request->year)
                                            ->update(['puntos' => $request->puntos, 'total_puntos' => $request->total_puntos]);
        return $actualizar;
    }
}
