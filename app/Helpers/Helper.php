<?php

use Illuminate\Support\Str;
use App\Models\Estimulos\Personal;
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
            'unidad_admin'=>$item->unidad_administrativa->nombre,
            'puesto'=>'Director',
            'year'=>date("Y")-1,
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
            'unidad_admin'=>$item->unidad_administrativa->nombre,
            'puesto'=>'Subdirector',
            'year'=>date("Y")-1,
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
            'unidad_admin'=>$item->unidad_administrativa->nombre,
            'puesto'=>'Coordinador',
            'year'=>date("Y")-1,
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
            'unidad_admin'=>$item->unidad_administrativa->nombre,
            'puesto'=>'Personal_Apoyo',
            'year'=>date("Y")-1,
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
            'year'=>date("Y")-1,
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
            'year'=>date("Y")-1,
        ];
    }
    return $datosDA;
}

function GetDireccionPosgrado(){
    $data = Http::get('http://126.107.2.56/SINFODI/capital_humano/api/personas/personal/tecnico');
    $array = json_decode($data);
    foreach($array->unidad_administrativa->direccion_de_posgrado as $item){
        $datosDP[]= [
            'clave'=>$item->clave,
            'nombre'=>$item->nombre,
            'usuario'=>$item->usuario,
            'categoria'=>$item->organigrama->categoria->nombre,
            'unidad_admin'=>$item->tipo_actividad->nombre,
            'puesto'=>'Direccion_Posgrado',
            'year'=>date("Y")-1,
        ];
    }
    return $datosDP;
}

function GetDireccionCiencia(){
    $data = Http::get('http://126.107.2.56/SINFODI/capital_humano/api/personas/personal/tecnico');
    $array = json_decode($data);
    foreach($array->unidad_administrativa->direccion_de_ciencia as $item){
        $datosDC[]= [
            'clave'=>$item->clave,
            'nombre'=>$item->nombre,
            'usuario'=>$item->usuario,
            'categoria'=>$item->organigrama->categoria->nombre,
            'unidad_admin'=>$item->tipo_actividad->nombre,
            'puesto'=>'Direccion_Ciencia',
            'year'=>date("Y")-1,
        ];
    }
    return $datosDC;
}

function GetDireccionServTec(){
    $data = Http::get('http://126.107.2.56/SINFODI/capital_humano/api/personas/personal/tecnico');
    $array = json_decode($data);
    foreach($array->unidad_administrativa->direccion_de_servicios_tecnologicos as $item){
        $datosDST[]= [
            'clave'=>$item->clave,
            'nombre'=>$item->nombre,
            'usuario'=>$item->usuario,
            'categoria'=>$item->organigrama->categoria->nombre,
            'unidad_admin'=>$item->tipo_actividad->nombre,
            'puesto'=>'Direccion_Servicios_Tecno',
            'year'=>date("Y")-1,
        ];
    }
    return $datosDST;
}

function GetDireccionProyTec(){
    $data = Http::get('http://126.107.2.56/SINFODI/capital_humano/api/personas/personal/tecnico');
    $array = json_decode($data);
    foreach($array->unidad_administrativa->direccion_de_tecnologia as $item){
        $datosDPT[]= [
            'clave'=>$item->clave,
            'nombre'=>$item->nombre,
            'usuario'=>$item->usuario,
            'categoria'=>$item->organigrama->categoria->nombre,
            'unidad_admin'=>$item->tipo_actividad->nombre,
            'puesto'=>'Direccion_Proyectos_Tecno',
            'year'=>date("Y")-1,
        ];
    }
    return $datosDPT;
}

function getPersonalSinFiltros(){
    $json = Http::get('http://126.107.2.56/SINFODI/capital_humano/api/personas/personal/tecnico');
    $array = json_decode($json);
    foreach($array->unidad_administrativa_sin_filtro->direccion_general as $item){
        $direccion_general[] = [
            'clave'=>$item->clave,
            'nombre'=>eliminar_acentos($item->nombre),
            'usuario'=>$item->usuario,
            'unidad_admin'=>'Direccion_General',
            'year'=>date("Y")-1,
        ];
    }
    foreach($array->unidad_administrativa_sin_filtro->direccion_de_administracion as $item){
        $direccion_administracion[] = [
            'clave'=>$item->clave,
            'nombre'=>eliminar_acentos($item->nombre),
            'usuario'=>$item->usuario,
            'unidad_admin'=>'Direccion_Administracion',
            'year'=>date("Y")-1,
        ];
    }
    foreach($array->unidad_administrativa_sin_filtro->direccion_de_posgrado as $item){
        $direccion_posgrado[] = [
            'clave'=>$item->clave,
            'nombre'=>eliminar_acentos($item->nombre),
            'usuario'=>$item->usuario,
            'unidad_admin'=>'Direccion_Posgrado',
            'year'=>date("Y")-1,
        ];
    }
    foreach($array->unidad_administrativa_sin_filtro->direccion_de_ciencia as $item){
        $direccion_ciencia[] = [
            'clave'=>$item->clave,
            'nombre'=>eliminar_acentos($item->nombre),
            'usuario'=>$item->usuario,
            'unidad_admin'=>'Direccion_Ciencia',
            'year'=>date("Y")-1,
        ];
    }
    foreach($array->unidad_administrativa_sin_filtro->direccion_de_servicios_tecnologicos as $item){
        $direccion_servicios[] = [
            'clave'=>$item->clave,
            'nombre'=>eliminar_acentos($item->nombre),
            'usuario'=>$item->usuario,
            'unidad_admin'=>'Direccion_Servicios',
            'year'=>date("Y")-1,
        ];
    }
    foreach($array->unidad_administrativa_sin_filtro->direccion_de_tecnologia as $item){
        $direccion_tecnologia[] = [
            'clave'=>$item->clave,
            'nombre'=>eliminar_acentos($item->nombre),
            'usuario'=>$item->usuario,
            'unidad_admin'=>'Direccion_Tecnologia',
            'year'=>date("Y")-1,
        ];
    }
    $direcciones = array_merge($direccion_general, $direccion_administracion, $direccion_posgrado, $direccion_ciencia, $direccion_servicios, $direccion_tecnologia);
    $existe = DB::table('sinfodi_personal')->where('year', date("Y")-1)->count();
    // dd($direcciones);
    if($existe == 0){
        $savePersonal = new Personal();
        $savePersonal->insert($direcciones);
        return true;
    }else{
        return false;
    }
}

function saveEvaluados(){
    $queryDatos = DB::table('sinfodi_evaluados')->select('usuario')->get();
    $datos = array_merge(GetDirectores(), GetSubdirectores(), GetCoordinadores(), GetPersonalApoyo(), GetDireccionGeneral(), GetDireccionAdministracion(), GetDireccionPosgrado(), GetDireccionCiencia(), GetDireccionServTec(), GetDireccionProyTec());
    // var_dump($datos);
    if(count($queryDatos) >= 1){
        return true;
    }else{
        $saveEvaluados = new Evaluados();
        $saveEvaluados->insert($datos);
        return $datos;
    }
}

function existeUsuario($usuario, $tipo, $criterio){
    // if($usuario == 'yunnm017' && $tipo == 'responsabilidades'){
    //     return false;
    // }
    if($tipo == 'responsabilidades'){
        if($usuario == 'yunnm017'){
            return false;
        }else{
            $queryExiste = DB::table('sinfodi_evaluados')
                    ->select('usuario')
                    ->where('usuario', '=', $usuario)
                    ->where('puesto', '=', $criterio)
                    ->count();
            if($queryExiste >= 1){
                return true;
            }else{
                return false;
            }
        }
    }
    if($tipo == 'administracion'){
        return false;
    }
    if($tipo == 'general' && $criterio == 'Direccion_General'){
        if($usuario == 'yunnm017'){
            $queryExiste = DB::table('sinfodi_evaluados')
                            ->select('usuario')
                            ->where('usuario', '=', $usuario)
                            ->where('puesto', '<>', 'Personal_Apoyo')
                            ->where('puesto', '=', $criterio)
                            ->where('unidad_admin', '<>', 'Personal de Apoyo')
                            ->count();
            if($queryExiste >= 1){
                return true;
            }else{
                return false;
            }
        }else{
            $queryExiste = DB::table('sinfodi_evaluados')
                            ->select('usuario')
                            ->where('usuario', '=', $usuario)
                            ->where('puesto', '<>', 'Coordinador')
                            ->where('puesto', '<>', 'Personal_Apoyo')
                            ->where('puesto', '=', $criterio)
                            ->where('unidad_admin', '<>', 'Personal de Apoyo')
                            ->where('categoria', '<>', 'Coordinador')
                            ->count();
            if($queryExiste >= 1){
                return true;
            }else{
                return false;
            }
        }
    }elseif($tipo == 'posgrado' && $criterio == 'Direccion_Posgrado'){
        $queryExiste = DB::table('sinfodi_evaluados')
                        ->select('usuario')
                        ->where('usuario', '=', $usuario)
                        ->where('puesto', '<>', 'Coordinador')
                        ->where('puesto', '<>', 'Personal_Apoyo')
                        ->where('categoria', '<>', 'Subdirector')
                        ->where('puesto', '=', $criterio)
                        ->where('unidad_admin', '<>', 'Personal de Apoyo')
                        ->where('categoria', '<>', 'Coordinador')
                        ->count();
        if($queryExiste >= 1){
            return true;
        }else{
            return false;
        }
    }elseif($tipo == 'ciencia' && $criterio == 'Direccion_Ciencia'){
        $queryExiste = DB::table('sinfodi_evaluados')
                        ->select('usuario')
                        ->where('usuario', '=', $usuario)
                        ->where('puesto', '<>', 'Coordinador')
                        ->where('puesto', '<>', 'Personal_Apoyo')
                        ->where('puesto', '=', $criterio)
                        ->where('unidad_admin', '<>', 'Personal de Apoyo')
                        ->where('categoria', '<>', 'Coordinador')
                        ->count();
        if($queryExiste >= 1){
            return true;
        }else{
            return false;
        }
    }elseif($tipo == 'servicios' && $criterio == 'Direccion_Servicios_Tecno'){
        $queryExiste = DB::table('sinfodi_evaluados')
                        ->select('usuario')
                        ->where('usuario', '=', $usuario)
                        ->where('puesto', '<>', 'Coordinador')
                        ->where('puesto', '<>', 'Personal_Apoyo')
                        ->where('puesto', '=', $criterio)
                        ->where('unidad_admin', '<>', 'Personal de Apoyo')
                        ->where('categoria', '<>', 'Coordinador')
                        ->count();
        if($queryExiste >= 1){
            return true;
        }else{
            return false;
        }
    }elseif($tipo == 'proyectos' && $criterio == 'Direccion_Proyectos_Tecno'){
        $queryExiste = DB::table('sinfodi_evaluados')
                        ->select('usuario')
                        ->where('usuario', '=', $usuario)
                        ->where('puesto', '<>', 'Coordinador')
                        ->where('puesto', '<>', 'Personal_Apoyo')
                        ->where('puesto', '=', $criterio)
                        ->where('unidad_admin', '<>', 'Personal de Apoyo')
                        ->where('categoria', '<>', 'Coordinador')
                        ->count();
        if($queryExiste >= 1){
            return true;
        }else{
            return false;
        }
    }elseif($tipo = 'acuses' && $criterio == 'acuses'){
        $queryExiste = DB::table('sinfodi_evaluados')
                        ->select('usuario')
                        ->where('usuario', '=', $usuario)
                        ->count();
        if($queryExiste >= 1){
            return true;
        }else{
            return false;
        }
    }
    // if($criterio == 'Direccion_General'){
    //     $queryExiste = DB::table('sinfodi_evaluados')
    //                     ->select('usuario')
    //                     ->where('usuario', '=', $usuario)
    //                     ->where('puesto', '=', $criterio)
    //                     ->count();
    // }
}
    // if($tipo == 'administracion'){
    //     $queryEvaluados = DB::table('sinfodi_evaluados')
    //                             ->select('clave')
    //                             ->whereOr('puesto', '=', 'Direccion_Administracion')
    //                             ->whereOr('puesto', '=', 'Coordinador')
    //                             ->orderBy('clave', 'ASC')
    //                             ->get();
    //     foreach($queryEvaluados as $itemEvaluados){
    //         $clave[] = $itemEvaluados->clave;
    //     }
    //     $queryExiste = DB::table('sinfodi_evaluados')
    //                         ->select('usuario')
    //                         ->where('usuario', '=', $usuario)
    //                         ->where('puesto', '=', $criterio)
    //                         ->whereNotIn('clave', $clave)
    //                         ->groupBy('usuario')
    //                         ->count();
    //     // var_dump($queryExiste);
    //     if($queryExiste >= 1){
    //         return true;
    //     }else{
    //         return false;
    //     }
    // }else{
    //     $queryExiste = DB::table('sinfodi_evaluados')
    //                         ->select('usuario')
    //                         ->where('usuario', '=', $usuario)
    //                         ->where('puesto', '=', $criterio)
    //                         ->groupBy('usuario')
    //                         ->count();
    //     if($queryExiste >= 1){
    //         return true;
    //     }else{
    //         return false;
    //     }
    // }
    // if($tipo !== 'responsabilidades'){
    //     // var_dump($tipo);
    //     $queryEvaluados = DB::table('sinfodi_evaluados')
    //                     ->select('clave')
    //                     ->whereOr('puesto', '=', 'Coordinador')
    //                     ->whereOr('puesto', '=', 'Personal_Apoyo')
    //                     ->whereOr('puesto', '=', 'Direccion_Administracion')
    //                     ->get();
    //     foreach($queryEvaluados as $itemEvaluados){
    //         $clave[] = $itemEvaluados->clave;
    //     }
    //     $queryExiste = DB::table('sinfodi_evaluados')
    //                     ->select('usuario')
    //                     ->where('usuario', '=', $usuario)
    //                     ->where('puesto', '=', $criterio)
    //                     ->whereNotIn('clave', $clave)
    //                     ->groupBy('usuario')
    //                     ->count();
    // }else{
    //     if($tipo == 'administracion'){
    //         $queryExiste = DB::table('sinfodi_evaluados')
    //                     ->select('usuario')
    //                     ->where('usuario', '=', $usuario)
    //                     ->where('puesto', '=', $criterio)
    //                     ->groupBy('usuario')
    //                     ->count();
    //     }else{
    //         $queryExiste = 0;
    //     }
    // }

    // var_dump($queryExiste);
    // if($tipo <> 'responsabilidades'){
    //     $queryEvaluados = DB::table('sinfodi_evaluacion_responsabilidades')
    //                         ->select('clave')
    //                         ->where('direccion', '=', 'Coordinadores')
    //                         ->whereOr('dirección', '=', 'Personal_Apoyo')
    //                         ->whereOr('responsabilidad', '=', 'Direccion administracion')
    //                         ->groupBy('clave')
    //                         ->orderby('clave', 'ASC')
    //                         ->get();
    //     foreach($queryEvaluados as $itemEvaluados){
    //         $clave[] = $itemEvaluados->clave;
    //     }
    //     $queryExiste = DB::table('sinfodi_evaluados')
    //                     ->select('usuario')
    //                     ->where('usuario', '=', $usuario)
    //                     ->where('puesto', '=', $criterio)
    //                     ->whereNotIn('clave', $clave)
    //                     ->count();
    // }
    // if($tipo = 'responsabilidades'){
    //     if($criterio == 'Direccion_Administracion'){
    //         $queryExiste = DB::table('sinfodi_evaluados')
    //                     ->select('usuario')
    //                     ->where('usuario', '=', $usuario)
    //                     ->where('puesto', '<>', 'Direccion_Administracion')
    //                     ->groupBy('usuario')
    //                     ->count();
    //     }else{
    //         $queryExiste = DB::table('sinfodi_evaluados')
    //                     ->select('usuario')
    //                     ->where('usuario', '=', $usuario)
    //                     ->where('puesto', '=', $criterio)
    //                     ->groupBy('usuario')
    //                     ->count();
    //     }
    // }
    // if($queryExiste >= 1){
    //     return true;
    // }else{
    //     return false;
    // }

function eliminar_acentos($cadena){
    //Reemplazamos la A y a
    $cadena = str_replace(
    array('Á', 'À', 'Â', 'Ä', 'á', 'à', 'ä', 'â', 'ª'),
    array('A', 'A', 'A', 'A', 'a', 'a', 'a', 'a', 'a'),
    $cadena
    );
    //Reemplazamos la E y e
    $cadena = str_replace(
    array('É', 'È', 'Ê', 'Ë', 'é', 'è', 'ë', 'ê'),
    array('E', 'E', 'E', 'E', 'e', 'e', 'e', 'e'),
    $cadena );
    //Reemplazamos la I y i
    $cadena = str_replace(
    array('Í', 'Ì', 'Ï', 'Î', 'í', 'ì', 'ï', 'î'),
    array('I', 'I', 'I', 'I', 'i', 'i', 'i', 'i'),
    $cadena );
    //Reemplazamos la O y o
    $cadena = str_replace(
    array('Ó', 'Ò', 'Ö', 'Ô', 'ó', 'ò', 'ö', 'ô'),
    array('O', 'O', 'O', 'O', 'o', 'o', 'o', 'o'),
    $cadena );
    //Reemplazamos la U y u
    $cadena = str_replace(
    array('Ú', 'Ù', 'Û', 'Ü', 'ú', 'ù', 'ü', 'û'),
    array('U', 'U', 'U', 'U', 'u', 'u', 'u', 'u'),
    $cadena );
    //Reemplazamos la N, n, C y c
    // $cadena = str_replace(
    // array('Ñ', 'ñ', 'Ç', 'ç'),
    // array('N', 'n', 'C', 'c'),
    // $cadena
    // );
    return $cadena;
}
