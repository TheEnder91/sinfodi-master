<?php

namespace App\Http\Controllers\Modulos;

use stdClass;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Traits\SingleResponse;
use App\Models\Estimulos\Comites;
use App\Models\Estimulos\Criterio;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Estimulos\Colaboradores;

class ColaboracionController extends Controller
{
    use SingleResponse;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $puntos = Criterio::findOrFail(32);
        return view('modulos.colaboracion.index', [
            'puntos' => $puntos,
        ]);
    }

    public static function Get_Comites(){
        $query = DB::table('sinfodi_comites')
                    ->select('id', 'nombre')
                    ->get();
        return $query;
    }

    public function listarComites($year){
        $query = DB::table('sinfodi_comites')
                    ->select('consecutivo', 'nombre')
                    ->where('year', $year)
                    ->get();
        return $query;
    }

    public function ultimoComite($year){
        $query = DB::table('sinfodi_comites')
                    ->select('consecutivo')
                    ->where('year', $year)
                    ->orderBy('consecutivo', 'DESC')
                    ->limit(1)
                    ->get();
        return $query;
    }

    public function ObtenerComites(){
        $query = DB::table('sinfodi_comites')
                    ->get();
        return $query;
    }

    public function existeComite($year, $ultimoConsecutivo){
        $query = DB::table('sinfodi_comites')
                    ->select('nombre')
                    ->where('year', $year)
                    ->where('consecutivo', '=', $ultimoConsecutivo)
                    ->count();
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

    public function saveComite(Request $request){
        // rename(string $oldname, string $newname, resource $context = ?);

        $nuevo = new Comites();
        $nuevo->create($request->all());
        $data['response'] = true;
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
    public function datosColaboradores()
    {
        $datos = Colaboradores::get();
        $data['response'] = $datos;
        return $this->response($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $year
     * @return \Illuminate\Http\Response
     */
    public function getColaboradores($id, $claveEmpleado, $year)
    {
        $datos = DB::table('sinfodi_colaboracion')
                    ->where('id', '=', $id)
                    ->where('clave', '=', $claveEmpleado)
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
        $actualizar = Colaboradores::findOrFail($id);
        $actualizar->clave = $request->clave;
        $actualizar->nombre = $request->nombre;
        $actualizar->usuario = $request->usuario;
        $actualizar->comites = $request->comites;
        $actualizar->cantidad = $request->cantidad;
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
        Colaboradores::find($id)->delete();
        $data['response'] = true;
        return $this->response($data);
    }
}
