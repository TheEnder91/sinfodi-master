<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Estimulos\Evaluados;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

/**
 * Valida si la ruta esta siendo usada
 * @param string $route
 * @param string #class
 * @return string
 */
function isRouteActive($route, $class = 'active'){
    if(Str::contains(Route::currentRouteName(), $route)){
        return $class;
    }
    return null;
}

function isMenuOpen($route, $class = 'menu-open'){
    if(Str::contains(Route::currentRouteName(), $route)){
        return $class;
    }
    return null;
}

function GetDirectores(){
    $data = Http::get('http://126.107.2.56/SINFODI/capital_humano/api/personas/personal/tecnico');
    $array = json_decode($data);
    foreach($array->data->director->data as $item){
        $datos[]= [
            'clave'=>$item->clave,
            'nombre'=>$item->nombre,
            'usuario'=>$item->usuario,
            'categoria'=>$item->organigrama->categoria->nombre,
            'unidad_admin'=>$item->tipo_actividad->nombre,
            'puesto'=>'Director',
        ];
    }
    return $datos;
}

function GetSubdirectores(){
    $data = Http::get('http://126.107.2.56/SINFODI/capital_humano/api/personas/personal/tecnico');
    $array = json_decode($data);
    foreach($array->data->subdirector->data as $item){
        $datos[]= [
            'clave'=>$item->clave,
            'nombre'=>$item->nombre,
            'usuario'=>$item->usuario,
            'categoria'=>$item->organigrama->categoria->nombre,
            'unidad_admin'=>$item->tipo_actividad->nombre,
            'puesto'=>'Subdirector',
        ];
    }
    return $datos;
}

function GetCoordinadores(){
    $data = Http::get('http://126.107.2.56/SINFODI/capital_humano/api/personas/personal/tecnico');
    $array = json_decode($data);
    foreach($array->data->coordinador->data as $item){
        $datos[]= [
            'clave'=>$item->clave,
            'nombre'=>$item->nombre,
            'usuario'=>$item->usuario,
            'categoria'=>$item->organigrama->categoria->nombre,
            'unidad_admin'=>$item->tipo_actividad->nombre,
            'puesto'=>'Coordinador',
        ];
    }
    return $datos;
}

function GetPersonalApoyo(){
    $data = Http::get('http://126.107.2.56/SINFODI/capital_humano/api/personas/personal/tecnico');
    $array = json_decode($data);
    foreach($array->data->personal_apoyo->data as $item){
        $datos[]= [
            'clave'=>$item->clave,
            'nombre'=>$item->nombre,
            'usuario'=>$item->usuario,
            'categoria'=>$item->organigrama->categoria->nombre,
            'unidad_admin'=>$item->tipo_actividad->nombre,
            'puesto'=>'Personal_Apoyo',
        ];
    }
    return $datos;
}

function GetRestoPersonal(){
    $data = Http::get('http://126.107.2.56/SINFODI/capital_humano/api/personas/personal/tecnico');
    $array = json_decode($data);
    foreach($array->data->unidad_administrativa->direccion_general as $item){
        $datosDG[]= [
            'clave'=>$item->clave,
            'nombre'=>$item->nombre,
            'usuario'=>$item->usuario,
            'categoria'=>$item->organigrama->categoria->nombre,
            'unidad_admin'=>$item->tipo_actividad->nombre,
            'puesto'=>'Direccion_General',
        ];
    }
    foreach($array->data->unidad_administrativa->direccion_de_ciencia as $item){
        $datosDC[]= [
            'clave'=>$item->clave,
            'nombre'=>$item->nombre,
            'usuario'=>$item->usuario,
            'categoria'=>$item->organigrama->categoria->nombre,
            'unidad_admin'=>$item->tipo_actividad->nombre,
            'puesto'=>'Direccion_Ciencia',
        ];
    }
    foreach($array->data->unidad_administrativa->direccion_de_administracion as $item){
        $datosDA[]= [
            'clave'=>$item->clave,
            'nombre'=>$item->nombre,
            'usuario'=>$item->usuario,
            'categoria'=>$item->organigrama->categoria->nombre,
            'unidad_admin'=>$item->tipo_actividad->nombre,
            'puesto'=>'Direccion_Admin',
        ];
    }
    foreach($array->data->unidad_administrativa->direccion_de_tecnologia as $item){
        $datosDT[]= [
            'clave'=>$item->clave,
            'nombre'=>$item->nombre,
            'usuario'=>$item->usuario,
            'categoria'=>$item->organigrama->categoria->nombre,
            'unidad_admin'=>$item->tipo_actividad->nombre,
            'puesto'=>'Direccion_Tecnologia',
        ];
    }
    foreach($array->data->unidad_administrativa->direccion_de_servicios_tecnologicos as $item){
        $datosDST[]= [
            'clave'=>$item->clave,
            'nombre'=>$item->nombre,
            'usuario'=>$item->usuario,
            'categoria'=>$item->organigrama->categoria->nombre,
            'unidad_admin'=>$item->tipo_actividad->nombre,
            'puesto'=>'Direccion_Servicios_Tecno',
        ];
    }
    foreach($array->data->unidad_administrativa->direccion_de_posgrado as $item){
        $datosDP[]= [
            'clave'=>$item->clave,
            'nombre'=>$item->nombre,
            'usuario'=>$item->usuario,
            'categoria'=>$item->organigrama->categoria->nombre,
            'unidad_admin'=>$item->tipo_actividad->nombre,
            'puesto'=>'Direccion_Posgrado',
        ];
    }
    $GetDatosDirecciones = array_merge($datosDG, $datosDC, $datosDA, $datosDT, $datosDST, $datosDP);
    return $GetDatosDirecciones;
}

function saveEvaluados(){
    $queryDatos = DB::table('sinfodi_evaluados')->select('usuario')->get();
    $datos = array_merge(GetDirectores(), GetSubdirectores(), GetCoordinadores(), GetPersonalApoyo());
    if(count($queryDatos) >= 1){
        if(DB::table('sinfodi_evaluados')->delete()){
            DB::table('sinfodi_evaluados')->truncate();
            $saveEvaluados = new Evaluados();
            $saveEvaluados->insert($datos);
            return $datos;
        }
    }else{
        $saveEvaluados = new Evaluados();
        $saveEvaluados->insert($datos);
        return $datos;
    }
}

function existeUsuario($usuario, $tipo, $criterio){
    if($tipo == 'responsabilidades'){
        $queryExiste = DB::table('sinfodi_evaluacion_responsabilidades')->select('username')->where('username', '=', $usuario)->where('direccion', '=', $criterio)->get();
    }elseif($tipo == 'general'){
        $queryExiste = DB::table('sinfodi_evaluados')->select('usuario')->where('usuario', '=', $usuario)->where('puesto', '=', $criterio)->get();
    }
    // elseif($tipo == 'ciencia'){
    //     $queryExiste = DB::table('sinfodi_evaluacion_ciencia')->select('username')->where('username', '=', $usuario)->where('direccion', '=', $criterio)->get();
    // }elseif($tipo == 'servTecno'){
    //     $queryExiste = DB::table('sinfodi_evaluacion_servtecno')->select('username')->where('username', '=', $usuario)->where('direccion', '=', $criterio)->get();
    // }elseif($tipo == 'proyTecno'){
    //     $queryExiste = DB::table('sinfodi_evaluacion_proytecno')->select('username')->where('username', '=', $usuario)->where('direccion', '=', $criterio)->get();
    // }
    if(count($queryExiste) >= 1){
        return true;
    }else{
        return false;
    }
}
