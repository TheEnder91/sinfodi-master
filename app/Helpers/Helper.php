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
    $directores = Http::get('http://126.107.2.56/SINFODI/capital_humano/api/personas/personal/tecnico');
    $array = json_decode($directores);
    foreach($array->director as $item){
        $datosDirectores[]= [
            'clave'=>$item->clave,
            'nombre'=>$item->nombre,
            'usuario'=>$item->usuario,
            'categoria'=>$item->organigrama->categoria->nombre,
            'unidad_admin'=>$item->tipo_actividad->nombre,
            'puesto'=>'Director',
        ];
    }
    return $datosDirectores;
}

function GetSubdirectores(){
    $subdirectores = Http::get('http://126.107.2.56/SINFODI/capital_humano/api/personas/personal/tecnico');
    $array = json_decode($subdirectores);
    foreach($array->subdirector as $item){
        $datosSubdirectores[]= [
            'clave'=>$item->clave,
            'nombre'=>$item->nombre,
            'usuario'=>$item->usuario,
            'categoria'=>$item->organigrama->categoria->nombre,
            'unidad_admin'=>$item->tipo_actividad->nombre,
            'puesto'=>'Subdirector',
        ];
    }
    return $datosSubdirectores;
}

function GetCoordinadores(){
    $Coordinadores = Http::get('http://126.107.2.56/SINFODI/capital_humano/api/personas/personal/tecnico');
    $array = json_decode($Coordinadores);
    foreach($array->coordinador as $item){
        $datosCoordinadores[]= [
            'clave'=>$item->clave,
            'nombre'=>$item->nombre,
            'usuario'=>$item->usuario,
            'categoria'=>$item->organigrama->categoria->nombre,
            'unidad_admin'=>$item->tipo_actividad->nombre,
            'puesto'=>'Coordinador',
        ];
    }
    return $datosCoordinadores;
}

function GetPersonalApoyo(){
    $personalApoyo = Http::get('http://126.107.2.56/SINFODI/capital_humano/api/personas/personal/tecnico');
    $array = json_decode($personalApoyo);
    foreach($array->personal_apoyo as $item){
        $datosPersonalApoyo[]= [
            'clave'=>$item->clave,
            'nombre'=>$item->nombre,
            'usuario'=>$item->usuario,
            'categoria'=>$item->organigrama->categoria->nombre,
            'unidad_admin'=>$item->tipo_actividad->nombre,
            'puesto'=>'Personal_Apoyo',
        ];
    }
    return $datosPersonalApoyo;
}

function GetDireccionGeneral(){
    $direccionGeneral = Http::get('http://126.107.2.56/SINFODI/capital_humano/api/personas/personal/tecnico');
    $array = json_decode($direccionGeneral);
    foreach($array->unidad_administrativa->direccion_general as $item){
        $datosDG[]= [
            'clave'=>$item->clave,
            'nombre'=>$item->nombre,
            'usuario'=>$item->usuario,
            'categoria'=>$item->organigrama->categoria->nombre,
            'unidad_admin'=>$item->tipo_actividad->nombre,
            'puesto'=>'Direccion_General',
        ];
    }
    return $datosDG;
}

function GetDireccionAdministracion(){
    $direccionAdministracion = Http::get('http://126.107.2.56/SINFODI/capital_humano/api/personas/personal/tecnico');
    $array = json_decode($direccionAdministracion);
    foreach($array->unidad_administrativa->direccion_de_administracion as $item){
        $datosDA[]= [
            'clave'=>$item->clave,
            'nombre'=>$item->nombre,
            'usuario'=>$item->usuario,
            'categoria'=>$item->organigrama->categoria->nombre,
            'unidad_admin'=>$item->tipo_actividad->nombre,
            'puesto'=>'Direccion_Administracion',
        ];
    }
    return $datosDA;
}

// function GetRestoPersonal(){
//     $data = Http::get('http://126.107.2.56/SINFODI/capital_humano/api/personas/personal/tecnico');
//     $array = json_decode($data);
//     foreach($array->data->unidad_administrativa->direccion_general as $item){
//         $datosDG[]= [
//             'clave'=>$item->clave,
//             'nombre'=>$item->nombre,
//             'usuario'=>$item->usuario,
//             'categoria'=>$item->organigrama->categoria->nombre,
//             'unidad_admin'=>$item->tipo_actividad->nombre,
//             'puesto'=>'Direccion_General',
//         ];
//     }
//     foreach($array->data->unidad_administrativa->direccion_de_ciencia as $item){
//         $datosDC[]= [
//             'clave'=>$item->clave,
//             'nombre'=>$item->nombre,
//             'usuario'=>$item->usuario,
//             'categoria'=>$item->organigrama->categoria->nombre,
//             'unidad_admin'=>$item->tipo_actividad->nombre,
//             'puesto'=>'Direccion_Ciencia',
//         ];
//     }
//     foreach($array->data->unidad_administrativa->direccion_de_administracion as $item){
//         $datosDA[]= [
//             'clave'=>$item->clave,
//             'nombre'=>$item->nombre,
//             'usuario'=>$item->usuario,
//             'categoria'=>$item->organigrama->categoria->nombre,
//             'unidad_admin'=>$item->tipo_actividad->nombre,
//             'puesto'=>'Direccion_Admin',
//         ];
//     }
//     foreach($array->data->unidad_administrativa->direccion_de_tecnologia as $item){
//         $datosDT[]= [
//             'clave'=>$item->clave,
//             'nombre'=>$item->nombre,
//             'usuario'=>$item->usuario,
//             'categoria'=>$item->organigrama->categoria->nombre,
//             'unidad_admin'=>$item->tipo_actividad->nombre,
//             'puesto'=>'Direccion_Tecnologia',
//         ];
//     }
//     foreach($array->data->unidad_administrativa->direccion_de_servicios_tecnologicos as $item){
//         $datosDST[]= [
//             'clave'=>$item->clave,
//             'nombre'=>$item->nombre,
//             'usuario'=>$item->usuario,
//             'categoria'=>$item->organigrama->categoria->nombre,
//             'unidad_admin'=>$item->tipo_actividad->nombre,
//             'puesto'=>'Direccion_Servicios_Tecno',
//         ];
//     }
//     foreach($array->data->unidad_administrativa->direccion_de_posgrado as $item){
//         $datosDP[]= [
//             'clave'=>$item->clave,
//             'nombre'=>$item->nombre,
//             'usuario'=>$item->usuario,
//             'categoria'=>$item->organigrama->categoria->nombre,
//             'unidad_admin'=>$item->tipo_actividad->nombre,
//             'puesto'=>'Direccion_Posgrado',
//         ];
//     }
//     $GetDatosDirecciones = array_merge($datosDG, $datosDC, $datosDA, $datosDT, $datosDST, $datosDP);
//     return $GetDatosDirecciones;
// }

function saveEvaluados(){
    $queryDatos = DB::table('sinfodi_evaluados')->select('usuario')->get();
    $datos = array_merge(GetDirectores(), GetSubdirectores(), GetCoordinadores(), GetPersonalApoyo(), GetDireccionGeneral(), GetDireccionAdministracion());
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
    }elseif($tipo == 'administracion'){
        $queryExiste = DB::table('sinfodi_evaluacion_administracion')->select('username')->where('username', '=', $usuario)->where('direccion', '=', $criterio)->get();
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
