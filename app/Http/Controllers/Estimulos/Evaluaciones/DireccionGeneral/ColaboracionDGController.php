<?php

namespace App\Http\Controllers\Estimulos\Evaluaciones\DireccionGeneral;

use stdClass;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Traits\SingleResponse;
use App\Models\Estimulos\Criterio;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Estimulos\Colaboradores;
use App\Models\Estimulos\EvaluacionDGeneral;

class ColaboracionDGController extends Controller
{
    use SingleResponse;

    const PERMISSIONS = [
        'index' => 'estimulo-evaluaciones-general-colaboracion-index',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comites = self::Get_Comites();
        $puntos = Criterio::findOrFail(32);
        return view('estimulos.evaluaciones.direcionGeneral.colaboracion.index', [
            'comites' => $comites,
            'puntos' => $puntos,
        ]);
    }

    /** Funcion para obtener los criterios para la investigacion cientifica... */
    public static function Get_Comites(){
        $query = DB::table('sinfodi_comites')
                    ->select('id', 'nombre')
                    ->get();
        return $query;
    }

    // Edgar Carrasco->(08/11/2021): Funcion para buscar al personal en la base de datos...
    public function buscarColaborador(Request $request){
        $data = [
            'response' => [],
        ];

        $url_service_colaboradores = config('general.url_service_colaboradores');
        $timeout = config('general.connect_timeout');

        $colaboradores = array();
        $client = new Client(['base_uri' => $url_service_colaboradores, 'verify' => false]);

        $responseHttp = $client->post(
            'personas/buscar',
            array(
                'form_params' => array(
                    'q' => $request->nombre,
                ),
                'connect_timeout' => $timeout
            )
        );
        $datosService = json_decode((string) $responseHttp->getBody(), true);

        if($datosService == false){
            return $this->response($data);
        }
        foreach($datosService as $colaboradorWs){
            $colaborador = new stdClass;
            $colaborador->nombre = $colaboradorWs["nombre"]. ' '.$colaboradorWs["a_paterno"].' '.$colaboradorWs["a_materno"];
            $colaborador->correo = $colaboradorWs["email"];
            $login = $colaboradorWs["usuario"];
            $colaborador->clave = $colaboradorWs["clave"];
            $colaborador->usuario = $colaboradorWs["usuario"];
            if($colaborador->correo == null || $colaborador->correo == ''){
                continue;
            }
            if(!isset( $login)){
                continue;
            }
            $colaboradores[] = $colaborador;
        }
        $data["response"] = $colaboradores;
        return $this->response($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $year
     * @return \Illuminate\Http\Response
     */
    public function existeColaboracion($year, $clave)
    {
        $datos = DB::table('sinfodi_colaboracion')->where('year', '=', $year)->where('clave', '=', $clave)->count();
        if($datos == 0){
            $count = 0;
        }else{
            $count = 1;
        }
        $data['response'] = $count;
        return $this->response($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $year
     * @return \Illuminate\Http\Response
     */
    public function savePuntosColaboradores(Request $request)
    {
        if(Colaboradores::where('clave', '=', $request->clave)->where('year', '=', $request->year)->count() == 0){
            $nuevo = new Colaboradores();
            $nuevo->create($request->all());
            $data['response'] = true;
            return $this->response($data);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $year
     * @return \Illuminate\Http\Response
     */
    public function searchColaboradores($year)
    {
        $queryEvaluados = DB::table('sinfodi_evaluados')
                            ->select('clave', 'puesto')
                            ->where('puesto', '=', 'Direccion_General')
                            ->orderby('clave', 'ASC')
                            ->get();
        foreach($queryEvaluados as $itemEvaluados){
            $clave[] = $itemEvaluados->clave;
        }
        $evaluacion_dif_div = self::Evaluaciones_Colaboradores($clave, $year);
        $data['response'] = $evaluacion_dif_div;
        return $this->response($data);
    }

    /** Codigo personal... */
    public static function Evaluaciones_Colaboradores($clave, $year){
        $query = DB::table('sinfodi_colaboracion')
                        ->select('*')
                        ->where('year', '=', $year)
                        ->whereIn('clave', $clave)
                        ->get();
        return $query;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveDatos(Request $request)
    {
        if(EvaluacionDGeneral::where('clave', '=', $request->clave)->where('year', '=', $request->year)->where('id_criterio', '=', $request->id_criterio)->where('direccion', '=', 'DGeneral')->count() == 0){
            $nuevo = new EvaluacionDGeneral();
            $nuevo->create($request->all());
            $data['response'] = true;
            return $this->response($data);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $year
     * @return \Illuminate\Http\Response
     */
    public function datosColaboradores($year, $criterio)
    {
        $datos = DB::table('sinfodi_evaluacion_general')->where('year', '=', $year)->where('id_criterio', '=', $criterio)->where('direccion', '=', 'DGeneral')->get();
        $data['response'] = $datos;
        return $this->response($data);
    }
}
