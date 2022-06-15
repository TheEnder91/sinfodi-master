<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\UsersController;
use App\Models\Estimulos\SostentabilidadEconomica;
use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Estimulos\ObjetivosController;
use App\Http\Controllers\Modulos\ColaboracionController;
use App\Http\Controllers\Modulos\PuntosTotalesController;
use App\Http\Controllers\Estimulos\LineamientosController;
use App\Http\Controllers\Estimulos\Factor2\MetasController;
use App\Http\Controllers\Modulos\RecursosPropiosController;
use App\Http\Controllers\Estimulos\Factor2\ImpactosController;
use App\Http\Controllers\Estimulos\Factor3\DesempeñoController;
use App\Http\Controllers\Modulos\FondosAdministracionController;
use App\Http\Controllers\Estimulos\Factor1\ActividadesAController;
use App\Http\Controllers\Estimulos\Factor1\ActividadesBController;
use App\Http\Controllers\Modulos\SostentabilidadEconomicaController;
use App\Http\Controllers\Estimulos\Evaluaciones\DirectoresController;
use App\Http\Controllers\Estimulos\Factor1\ResponsabilidadesController;
use App\Http\Controllers\Estimulos\Evaluaciones\CoordinadoresController;
use App\Http\Controllers\Estimulos\Evaluaciones\PersonalApoyoController;
use App\Http\Controllers\Estimulos\Evaluaciones\SubdirectoresController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionCiencia\PosgradoDCController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionGeneral\PosgradoDGController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionPosgrado\PosgradoDPController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionCiencia\FormacionRHDCController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionGeneral\FormacionRHDGController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionCiencia\ColaboracionDCController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionGeneral\AcreditacionesController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionGeneral\ColaboracionDGController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionPosgrado\FormacionRHDPController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionCiencia\InvestigacionDCController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionCiencia\TransferenciaDCController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionGeneral\InvestigacionDGController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionGeneral\TransferenciaDGController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionPosgrado\ColaboracionDPController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionCiencia\AcreditacionesDCController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionCiencia\SostenibilidadDCController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionGeneral\InvestigacionBDGController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionGeneral\TransferenciaBDGController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionPosgrado\InvestigacionDPController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionPosgrado\TransferenciaDPController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionProyectosTec\PosgradoDPTController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionServiciosTec\PosgradoDSTController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionAdministracion\PosgradoDAController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionGeneral\SostentabilidadDGController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionPosgrado\AcreditacionesDPController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionPosgrado\SostenibilidadDPController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionGeneral\SostentabilidadBDGController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionGeneral\DifusionDivulgacionController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionProyectosTec\FormacionRHDPTController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionServiciosTec\FormacionRHDSTController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionAdministracion\FormacionRHDAController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionProyectosTec\ColaboracionDPTController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionServiciosTec\ColaboracionDSTController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionAdministracion\ColaboracionDAController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionCiencia\DifusionDivulgacionDCController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionProyectosTec\InvestigacionDPTController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionProyectosTec\TransferenciaDPTController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionServiciosTec\InvestigacionDSTController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionServiciosTec\TransferenciaDSTController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionAdministracion\InvestigacionDAController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionAdministracion\TransferenciaDAController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionPosgrado\DifusionDivulgacionDPController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionProyectosTec\AcreditacionesDPTController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionProyectosTec\SostenibilidadDPTController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionServiciosTec\AcreditacionesDSTController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionServiciosTec\SostenibilidadDSTController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionAdministracion\AcreditacionesDAController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionAdministracion\SostenibilidadDAController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionProyectosTec\DifusionDivulgacionDPTController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionServiciosTec\DifusionDivulgacionDSTController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionAdministracion\DifusionDivulgacionDAController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['login'])->group(function(){
    Route::get('/', function () {
        saveEvaluados();
        return view('layouts.app');
    });
    /** Rutas para el panel de control de la aplicacion... */
    //Rutas para el modulo de usuarios...
    Route::get('/panelControl/listUsers', [UsersController::class, "index"])->name('panelControl.users');
    Route::get('/panelControl/showUser/{id}', [UsersController::class, "show"])->name('panelControl.users');
    Route::put('/panelControl/updateUser/{id}', [UsersController::class, "update"])->name('panelControl.users');
    // Rutas para el modulo de Roles...
    Route::get('/panelControl/listRoles', [RolesController::class, "index"])->name('panelControl.roles');
    Route::get('/panelControl/createRol', [RolesController::class, "create"])->name('panelControl.roles');
    Route::post('/panelControl/storeRol', [RolesController::class, "store"])->name('panelControl.roles');
    Route::get('/panelControl/showRol/{id}', [RolesController::class, "show"])->name('panelControl.roles');
    Route::put('/panelControl/updateRol/{id}', [RolesController::class, "update"])->name('panelControl.roles');
    Route::delete('/panelControl/destroyRol/{id}', [RolesController::class, "destroy"])->name('panelControl.roles');
    //Rutas para el modulo de permisos...
    Route::get('/panelControl/listPermissions', [PermissionsController::class, "index"])->name('panelControl.permissions');
    /** Rutas para los modulos faltantes para completar las evaluaciones... */
    /** Sostentabilidad economica... */
    Route::get('/modulos/sostenibilidad/listSostenibilidad', [SostentabilidadEconomicaController::class, "index"])->name('modulos.sostenibilidad');
    Route::get('/modulos/sostenibilidad/getPuntos', [SostentabilidadEconomicaController::class, "getPuntos"])->name('modulos.sostentabilidad');
    Route::post('/modulos/sostenibilidad/store', [SostentabilidadEconomicaController::class, "store"])->name('modulos.sostentabilidad');
    Route::get('/modulos/sostenibilidad/datosSostentabilidad/{tipo}', [SostentabilidadEconomicaController::class, "datosSostentabilidad"])->name('modulos.sostentabilidad');
    Route::get('/modulos/sostenibilidad/getSostentabilidad/{id}/{year}', [SostentabilidadEconomicaController::class, "getSostentabilidad"])->name('modulos.sostenibilidad');
    Route::put('/modulos/sostenibilidad/updateSostentabilidad/{id}', [SostentabilidadEconomicaController::class, "update"])->name('modulos.sostenibilidad');
    Route::delete('/modulos/sostenibilidad/destroySostentabilidad/{id}', [SostentabilidadEconomicaController::class, "destroy"])->name('modulos.sostenibilidad');
    /** Colaboración institucional... */
    Route::get('/modulos/colaboracion/listColaboracion', [ColaboracionController::class, "index"])->name('modulos.colaboracion');
    Route::get('/modulos/colaboracion/existeColaboracion/{year}/{clave}', [ColaboracionController::class, "existeColaboracion"])->name('modulos.colaboracion');
    Route::get('/modulos/colaboracion/searchColaboradores/{year}', [ColaboracionController::class, "searchColaboradores"])->name('modulos.colaboracion');
    Route::post('/modulos/colaboracion/savePuntosColaboradores', [ColaboracionController::class, "savePuntosColaboradores"])->name('modulos.colaboracion');
    Route::get('/modulos/colaboracion/datosColaboradores', [ColaboracionController::class, "datosColaboradores"])->name('modulos.colaboracion');
    Route::get('/modulos/colaboracion/getColaboradores/{id}/{claveEmpleado}/{year}', [ColaboracionController::class, "getColaboradores"])->name('modulos.colaboracion');
    Route::put('/modulos/colaboracion/updateColaboracion/{id}', [ColaboracionController::class, "update"])->name('modulos.colaboracion');
    Route::delete('/modulos/colaboracion/destroyColaboracion/{id}', [ColaboracionController::class, "destroy"])->name('modulos.colaboracion');
    /** Puntos totales... */
    Route::get('/modulos/puntosTotales/listPuntosTotales', [PuntosTotalesController::class, "index"])->name('modulos.puntosTotales');
    Route::get('/modulos/puntosTotales/getTotalPuntos', [PuntosTotalesController::class, "getTotalPuntos"])->name('modulos.puntosTotales');
    Route::get('/modulos/puntosTotales/sumarPuntosTotales/{year}', [PuntosTotalesController::class, "sumarPuntosTotales"])->name('modulos.puntosTotales');
    Route::get('/modulos/puntosTotales/existe/{year}', [PuntosTotalesController::class, "existe"])->name('modulos.puntosTotales');
    Route::post('/modulos/puntosTotales/guardarTotalPuntos', [PuntosTotalesController::class, "guardarTotalPuntos"])->name('modulos.puntosTotales');
    Route::get('/modulos/puntosTotales/verTotalPuntos/{id}/{year}', [PuntosTotalesController::class, "verTotalPuntos"])->name('modulos.puntosTotales');
    Route::get('/modulos/puntosTotales/verTotalPuntosA/{year}', [PuntosTotalesController::class, "verTotalPuntosA"])->name('modulos.puntosTotales');
    Route::get('/modulos/puntosTotales/verTotalPuntosB/{year}', [PuntosTotalesController::class, "verTotalPuntosB"])->name('modulos.puntosTotales');
    /** Recursos propios... */
    Route::get('/modulos/recursosPropios/listRecursosPropios', [RecursosPropiosController::class, "index"])->name('modulos.recursosPropios');
    Route::get('/modulos/recursosPropios/ObtenerRecursosPropios/', [RecursosPropiosController::class, "obtenerRecursosPropios"])->name('modulos.recursosPropios');
    Route::get('/modulos/recursosPropios/ObtenerTotalPersonasDirecciones/{year}/{direccion}', [RecursosPropiosController::class, "obtenerTotalPersonasDireccion"])->name('modulos.recursosPropios');
    Route::get('/modulos/recursosPropios/ObtenerDatos/{year}', [RecursosPropiosController::class, "obtenerDatos"])->name('modulos.recursosPropios');
    Route::get('/modulos/recursosPropios/existe/{year}/{id}', [RecursosPropiosController::class, "existe"])->name('modulos.recursosPropios');
    Route::post('/modulos/recursosPropios/guardarRecursosPropios', [RecursosPropiosController::class, "guardarRecursosPropios"])->name('modulos.recursosPropios');
    Route::get('/modulos/recursosPropios/getRecursoPropio/{year}/{id}', [RecursosPropiosController::class, "getRecursoPropio"])->name('modulos.recursosPropios');
    /** fondos en administracion... */
    Route::get('/modulos/fondosAdministracion/listFondosAdministracion', [FondosAdministracionController::class, "index"])->name('modulos.fondosAdministracion');
    Route::get('/modulos/fondosAdministracion/ObtenerTotalFondosAdministracion/', [FondosAdministracionController::class, "obtenerTotalFondosAdministracion"])->name('modulos.fondosAdministracion');
    //Ruta para visualizar los lineamientos de estimulos...
    Route::get('/estimulos/lineamientos/viewLineamientos', [LineamientosController::class, "index"])->name('estimulos.lineamientos');
    //Rutas para el catalogo de objetivos...
    Route::get('/estimulos/objetivos/listObjetivos', [ObjetivosController::class, "index"])->name('estimulos.objetivos');
    Route::post('/estimulos/objetivos/storeObjetivo', [ObjetivosController::class, "store"])->name('estimulos.objetivos');
    Route::get('/estimulos/objetivos/showObjetivo/{id}', [ObjetivosController::class, "show"])->name('estimulos.objetivos');
    Route::put('/estimulos/objetivos/updateObjetivo/{id}', [ObjetivosController::class, "update"])->name('estimulos.objetivos');
    Route::delete('/estimulos/objetivos/destroyObjetivo/{id}', [ObjetivosController::class, "destroy"])->name('estimulos.objetivos');
    // Rutas para el catalogo de las actividades A...
    Route::get('/estimulos/factor1/criterios/listActividadesA', [ActividadesAController::class, "index"])->name('estimulos.factor1.actividadesA');
    Route::post('/estimulos/factor1/criterios/storeActividadesA', [ActividadesAController::class, "store"])->name('estimulos.factor1.actividadesA');
    Route::get('/estimulos/factor1/criterios/showActividadesA/{id}', [ActividadesAController::class, "show"])->name('estimulos.factor1.actividadesA');
    Route::put('/estimulos/factor1/criterios/updateActividadesA/{id}', [ActividadesAController::class, "update"])->name('estimulos.factor1.actividadesA');
    Route::delete('/estimulos/factor1/criterios/destroyActividadesA/{id}', [ActividadesAController::class, "destroy"])->name('estimulos.factor1.actividadesA');
    // Rutas para el catalogo de actividades B...
    Route::get('/estimulos/factor1/criterios/listActividadesB', [ActividadesBController::class, "index"])->name('estimulos.factor1.actividadesB');
    Route::post('/estimulos/factor1/criterios/storeActividadesB', [ActividadesBController::class, "store"])->name('estimulos.factor1.actividadesB');
    Route::get('/estimulos/factor1/criterios/showActividadesB/{id}', [ActividadesBController::class, "show"])->name('estimulos.factor1.actividadesB');
    Route::put('/estimulos/factor1/criterios/updateActividadesB/{id}', [ActividadesBController::class, "update"])->name('estimulos.factor1.actividadesB');
    Route::delete('/estimulos/factor1/criterios/destroyActividadesB/{id}', [ActividadesBController::class, "destroy"])->name('estimulos.factor1.actividadesB');
    /** Rutas para el catalogo de responsabilidades */
    Route::get('/estimulos/factor1/responsabilidades/listResponsabildiades', [ResponsabilidadesController::class, "index"])->name('estimulos.factor1.responsabilidades');
    Route::post('/estimulos/factor1/responsabilidades/storeResponsabildiades', [ResponsabilidadesController::class, "store"])->name('estimulos.factor1.responsabilidades');
    Route::get('/estimulos/factor1/responsabilidades/showResponsabildiades/{id}', [ResponsabilidadesController::class, "show"])->name('estimulos.factor1.responsabilidades');
    Route::put('/estimulos/factor1/responsabilidades/updateResponsabildiades/{id}', [ResponsabilidadesController::class, "update"])->name('estimulos.factor1.responsabilidades');
    Route::delete('/estimulos/factor1/responsabilidades/destroyResponsabildiades/{id}', [ResponsabilidadesController::class, "destroy"])->name('estimulos.factor1.responsabilidades');
    /** Rutas para el catalogo de metas alcanzadas... */
    Route::get('/estimulos/factor2/metas/listMetas', [MetasController::class, "index"])->name('estimulos.factor2.metas');
    Route::post('/estimulos/factor2/metas/storeMetas', [MetasController::class, "store"])->name('estimulos.factor2.metas');
    Route::get('/estimulos/factor2/metas/showMetas/{id}', [MetasController::class, "show"])->name('estimulos.factor2.metas');
    Route::put('/estimulos/factor2/metas/updateMetas/{id}', [MetasController::class, "update"])->name('estimulos.factor2.metas');
    Route::delete('/estimulos/factor2/metas/destroyMetas/{id}', [MetasController::class, "destroy"])->name('estimulos.factor2.metas');
    /** Rutas para el catalogo de nivel de impacto... */
    Route::get('/estimulos/factor2/inpacto/listImpacto', [ImpactosController::class, "index"])->name('estimulos.factor2.impacto');
    Route::post('/estimulos/factor2/inpacto/storeImpacto', [ImpactosController::class, "store"])->name('estimulos.factor2.impacto');
    Route::get('/estimulos/factor2/inpacto/showImpacto/{id}', [ImpactosController::class, "show"])->name('estimulos.factor2.impacto');
    Route::put('/estimulos/factor2/inpacto/updateImpacto/{id}', [ImpactosController::class, "update"])->name('estimulos.factor2.impacto');
    Route::delete('/estimulos/factor2/inpacto/destroyImpacto/{id}', [ImpactosController::class, "destroy"])->name('estimulos.factor2.impacto');
    /** Rutas para el catalogo de desempeño... */
    Route::get('/estimulos/factor3/desempeño/listDesempeño', [DesempeñoController::class, "index"])->name('estimulos.factor3.desempeño');
    Route::post('/estimulos/factor3/desempeño/storeDesempeño', [DesempeñoController::class, "store"])->name('estimulos.factor3.desempeño');
    Route::get('/estimulos/factor3/desempeño/showDesempeño/{id}', [DesempeñoController::class, "show"])->name('estimulos.factor3.desempeño');
    Route::put('/estimulos/factor3/desempeño/updateDesempeño/{id}', [DesempeñoController::class, "update"])->name('estimulos.factor3.desempeño');
    Route::delete('/estimulos/factor3/desempeño/destroyDesempeño/{id}', [DesempeñoController::class, "destroy"])->name('estimulos.factor3.desempeño');
    /** Rutas para las evaluaciones de estimulos responsabilidades->Directores... */
    Route::get('/estimulos/evaluaciones/responsabilidades/directores/listDirectores', [DirectoresController::class, "index"])->name('estimulos.evaluaciones.responsabilidades.directores');
    Route::get('/estimulos/evaluaciones/responsabilidades/directores/existe/{year}/{direccion}', [DirectoresController::class, "existe"])->name('estimulos.evaluaciones.responsabilidades.directores');
    Route::get('/estimulos/evaluaciones/responsabilidades/directores/searchDirectores', [DirectoresController::class, "searchDirectores"])->name('estimulos.evaluaciones.responsabilidades.directores');
    Route::get('/estimulos/evaluaciones/responsabilidades/directores/puntos', [DirectoresController::class, "puntos"])->name('estimulos.evaluaciones.responsabilidades.directores');
    Route::post('/estimulos/evaluaciones/responsabilidades/directores/store', [DirectoresController::class, "store"])->name('estimulos.evaluaciones.responsabilidades.directores');
    Route::get('/estimulos/evaluaciones/responsabilidades/directores/getDirectores/{year}', [DirectoresController::class, "getDirectores"])->name('estimulos.evaluaciones.responsabilidades.directores');
    /** Rutas para las evaluaciones de estimulos responsabilidades->Subdirectores... */
    Route::get('/estimulos/evaluaciones/responsabilidades/subdirectores/listSubdirectores', [SubdirectoresController::class, "index"])->name('estimulos.evaluaciones.responsabilidades.subdirectores');
    Route::get('/estimulos/evaluaciones/responsabilidades/subdirectores/searchSubdirectores', [SubdirectoresController::class, "searchSubdirectores"])->name('estimulos.evaluaciones.responsabilidades.subdirectores');
    Route::get('/estimulos/evaluaciones/responsabilidades/subdirectores/puntos', [SubdirectoresController::class, "puntos"])->name('estimulos.evaluaciones.responsabilidades.subdirectores');
    Route::get('/estimulos/evaluaciones/responsabilidades/subdirectores/existe/{year}/{direccion}', [SubdirectoresController::class, "existe"])->name('estimulos.evaluaciones.responsabilidades.subdirectores');
    Route::post('/estimulos/evaluaciones/responsabilidades/subdirectores/store', [SubdirectoresController::class, "store"])->name('estimulos.evaluaciones.responsabilidades.subdirectores');
    Route::get('/estimulos/evaluaciones/responsabilidades/subdirectores/getSubdirectores/{year}', [SubdirectoresController::class, "getSubdirectores"])->name('estimulos.evaluaciones.responsabilidades.subdirectores');
    /** Rutas para las evaluaciones de estimulos responsabilidades->Coordinadores... */
    Route::get('/estimulos/evaluaciones/responsabilidades/Coordinadores/listCoordinadores', [CoordinadoresController::class, "index"])->name('estimulos.evaluaciones.responsabilidades.Coordinadores');
    Route::get('/estimulos/evaluaciones/responsabilidades/Coordinadores/existe/{year}/{direccion}', [CoordinadoresController::class, "existe"])->name('estimulos.evaluaciones.responsabilidades.Coordinadores');
    Route::get('/estimulos/evaluaciones/responsabilidades/Coordinadores/searchCoordinadores', [CoordinadoresController::class, "searchCoordinadores"])->name('estimulos.evaluaciones.responsabilidades.Coordinadores');
    Route::get('/estimulos/evaluaciones/responsabilidades/Coordinadores/puntos', [CoordinadoresController::class, "puntos"])->name('estimulos.evaluaciones.responsabilidades.Coordinadores');
    Route::post('/estimulos/evaluaciones/responsabilidades/Coordinadores/store', [CoordinadoresController::class, "store"])->name('estimulos.evaluaciones.responsabilidades.Coordinadores');
    Route::get('/estimulos/evaluaciones/responsabilidades/Coordinadores/getCoordinadores/{year}', [CoordinadoresController::class, "getCoordinadores"])->name('estimulos.evaluaciones.responsabilidades.Coordinadores');
    /** Rutas para las evaluaciones de estimulos responsabilidades->Personal de apoyo... */
    Route::get('/estimulos/evaluaciones/responsabilidades/personalApoyo/listPersonalApoyo', [PersonalApoyoController::class, "index"])->name('estimulos.evaluaciones.responsabilidades.personalApoyo');
    Route::get('/estimulos/evaluaciones/responsabilidades/personalApoyo/existe/{year}/{direccion}', [PersonalApoyoController::class, "existe"])->name('estimulos.evaluaciones.responsabilidades.personalApoyo');
    Route::get('/estimulos/evaluaciones/responsabilidades/personalApoyo/searchPersonalApoyo', [PersonalApoyoController::class, "searchPersonalApoyo"])->name('estimulos.evaluaciones.responsabilidades.personalApoyo');
    Route::get('/estimulos/evaluaciones/responsabilidades/personalApoyo/puntos', [PersonalApoyoController::class, "puntos"])->name('estimulos.evaluaciones.responsabilidades.personalApoyo');
    Route::post('/estimulos/evaluaciones/responsabilidades/personalApoyo/store', [PersonalApoyoController::class, "store"])->name('estimulos.evaluaciones.responsabilidades.personalApoyo');
    Route::get('/estimulos/evaluaciones/responsabilidades/personalApoyo/getPersonalApoyo/{year}', [PersonalApoyoController::class, "getPersonalApoyo"])->name('estimulos.evaluaciones.responsabilidades.personalApoyo');

    /** Rutas para las evaluaciones... */
    /** Rutas para las evaluaciones de estimulos Direccion general->Difusion y divulgacion... */
    Route::get('/estimulos/evaluaciones/DireccionGeneral/DifDiv/listDifDIv', [DifusionDivulgacionController::class, "index"])->name('estimulos.evaluaciones.direccionGeneral.DivDif');
    Route::get('/estimulos/evaluaciones/DireccionGeneral/DifDiv/searchDifDIv/{year}', [DifusionDivulgacionController::class, "search"])->name('estimulos.evaluaciones.direccionGeneral.DivDif');
    Route::post('/estimulos/evaluaciones/DireccionGeneral/DifDiv/saveDatosDifDiv', [DifusionDivulgacionController::class, "saveDatos"])->name('estimulos.evaluaciones.direccionGeneral.DivDif');
    Route::get('/estimulos/evaluaciones/DireccionGeneral/DifDiv/datosDifDiv/{year}/{criterio}', [DifusionDivulgacionController::class, "datosDifDiv"])->name('estimulos.evaluaciones.direccionGeneral.DivDif');
    Route::get('/estimulos/evaluaciones/DireccionGeneral/DifDiv/searchEvidenciasDifDiv/{year}/{clave}', [DifusionDivulgacionController::class, "searchEvidencias"])->name('estimulos.evaluaciones.direccionGeneral.DivDif');
    Route::get('/estimulos/evaluaciones/DireccionGeneral/DifDiv/getEvidenciasDifDiv/{clave}/{year}/{criterio}', [DifusionDivulgacionController::class, "getEvidenciasGeneral"])->name('estimulos.evaluaciones.direccionGeneral.DivDif');
    Route::get('/estimulos/evaluaciones/DireccionGeneral/DifDiv/obtenerEvidenciasDifDiv/{clave}/{year}/{criterio}', [DifusionDivulgacionController::class, "obtenerEvidenciasGeneral"])->name('estimulos.evaluaciones.direccionGeneral.DivDif');
    Route::get('/estimulos/evaluaciones/DireccionGeneral/DifDiv/puntosDifDiv/{id}/{objetivo}', [DifusionDivulgacionController::class, "puntos"])->name('estimulos.evaluaciones.direccionGeneral.DivDif');
    Route::post('/estimulos/evaluaciones/DireccionGeneral/DifDiv/savePuntos', [DifusionDivulgacionController::class, "savePuntos"])->name('estimulos.evaluaciones.direccionGeneral.DivDif');
    Route::put('/estimulos/evaluaciones/DireccionGeneral/DifDiv/updateDatosDifDiv', [DifusionDivulgacionController::class, "updateDatosGeneral"])->name('estimulos.evaluaciones.direccionGeneral.DivDif');
    Route::put('/estimulos/evaluaciones/DireccionGeneral/DifDiv/updateDatosPuntos', [DifusionDivulgacionController::class, "updateDatosPuntos"])->name('estimulos.evaluaciones.direccionGeneral.DivDif');
    /** Rutas para las evaluaciones de estimulos Direccion general->Posgrado... */
    Route::get('/estimulos/evaluaciones/DireccionGeneral/posgrado/listPosgrado', [PosgradoDGController::class, "index"])->name('estimulos.evaluaciones.direccionGeneral.posgrado');
    Route::get('/estimulos/evaluaciones/DireccionGeneral/posgrado/searchPosgrado/{year}/{criterio}', [PosgradoDGController::class, "search"])->name('estimulos.evaluaciones.direccionGeneral.posgrado');
    Route::get('/estimulos/evaluaciones/DireccionGeneral/posgrado/searchUsernamePosgrado/{clave}', [PosgradoDGController::class, "searchUsername"])->name('estimulos.evaluaciones.direccionGeneral.posgrado');
    Route::post('/estimulos/evaluaciones/DireccionGeneral/posgrado/saveDatosPosgrado', [PosgradoDGController::class, "saveDatos"])->name('estimulos.evaluaciones.direccionGeneral.posgrado');
    Route::get('/estimulos/evaluaciones/DireccionGeneral/posgrado/datosposgrado/{year}/{criterio}', [PosgradoDGController::class, "datosPosgrado"])->name('estimulos.evaluaciones.direccionGeneral.posgrado');
    Route::get('/estimulos/evaluaciones/DireccionGeneral/posgrado/searchEvidenciasPosgrado/{year}/{clave}/{criterio}', [PosgradoDGController::class, "searchEvidencias"])->name('estimulos.evaluaciones.direccionGeneral.posgrado');
    Route::get('/estimulos/evaluaciones/DireccionGeneral/posgrado/puntosPosgrado/{id}/{objetivo}', [PosgradoDGController::class, "puntos"])->name('estimulos.evaluaciones.direccionGeneral.posgrado');
    Route::get('/estimulos/evaluaciones/DireccionGeneral/posgrado/getEvidenciasPosgrado/{clave}/{year}/{criterio}', [PosgradoDGController::class, "getEvidenciasGeneral"])->name('estimulos.evaluaciones.direccionGeneral.posgrado');
    Route::get('/estimulos/evaluaciones/DireccionGeneral/posgrado/obtenerEvidenciasPosgrado/{clave}/{year}/{criterio}', [PosgradoDGController::class, "obtenerEvidenciasGeneral"])->name('estimulos.evaluaciones.direccionGeneral.posgrado');
    Route::post('/estimulos/evaluaciones/DireccionGeneral/posgrado/savePuntos', [PosgradoDGController::class, "savePuntos"])->name('estimulos.evaluaciones.direccionGeneral.posgrado');
    Route::put('/estimulos/evaluaciones/DireccionGeneral/posgrado/updateDatosPosgrado', [PosgradoDGController::class, "updateDatosGeneral"])->name('estimulos.evaluaciones.direccionGeneral.posgrado');
    Route::put('/estimulos/evaluaciones/DireccionGeneral/posgrado/updateDatosPuntos', [PosgradoDGController::class, "updateDatosPuntos"])->name('estimulos.evaluaciones.direccionGeneral.posgrado');
    /** Rutas para las evaluaciones de estimulos Direccion general->Investigacion Cientifica... */
    Route::get('/estimulos/evaluaciones/DireccionGeneral/investigacion/listInvestigacion', [InvestigacionDGController::class, "index"])->name('estimulos.evaluaciones.direccionGeneral.investigacion');
    Route::get('/estimulos/evaluaciones/DireccionGeneral/investigacion/searchInvestigacion/{year}/{criterio}', [InvestigacionDGController::class, "search"])->name('estimulos.evaluaciones.direccionGeneral.investigacion');
    Route::post('/estimulos/evaluaciones/DireccionGeneral/investigacion/saveDatosInvestigacion', [InvestigacionDGController::class, "saveDatos"])->name('estimulos.evaluaciones.direccionGeneral.investigacion');
    Route::get('/estimulos/evaluaciones/DireccionGeneral/investigacion/datosInvestigacion/{year}/{criterio}', [InvestigacionDGController::class, "datosInvestigacion"])->name('estimulos.evaluaciones.direccionGeneral.investigacion');
    Route::get('/estimulos/evaluaciones/DireccionGeneral/investigacion/searchEvidenciasInvestigacion/{year}/{clave}/{criterio}', [InvestigacionDGController::class, "searchEvidencias"])->name('estimulos.evaluaciones.direccionGeneral.investigacion');
    Route::get('/estimulos/evaluaciones/DireccionGeneral/investigacion/obtenerEvidenciasInvestigacion/{clave}/{year}/{criterio}', [InvestigacionDGController::class, "obtenerEvidenciasGeneral"])->name('estimulos.evaluaciones.direccionGeneral.investigacion');
    Route::get('/estimulos/evaluaciones/DireccionGeneral/investigacion/puntosinvestigacion/{id}/{objetivo}', [InvestigacionDGController::class, "puntos"])->name('estimulos.evaluaciones.direccionGeneral.investigacion');
    Route::post('/estimulos/evaluaciones/DireccionGeneral/investigacion/savePuntos', [InvestigacionDGController::class, "savePuntos"])->name('estimulos.evaluaciones.direccionGeneral.investigacion');
    Route::get('/estimulos/evaluaciones/DireccionGeneral/investigacion/getEvidenciasInvestigacion/{clave}/{year}/{criterio}', [InvestigacionDGController::class, "getEvidenciasGeneral"])->name('estimulos.evaluaciones.direccionGeneral.investigacion');
    Route::put('/estimulos/evaluaciones/DireccionGeneral/investigacion/updateDatos', [DifusionDivulgacionController::class, "updateDatosGeneral"])->name('estimulos.evaluaciones.direccionGeneral.DivDif');
    Route::put('/estimulos/evaluaciones/DireccionGeneral/investigacion/updateDatosPuntos', [DifusionDivulgacionController::class, "updateDatosPuntos"])->name('estimulos.evaluaciones.direccionGeneral.DivDif');
    /** Rutas para las evaluaciones de estimulos Direccion general->Sostentabilidad */
    Route::get('/estimulos/evaluaciones/DireccionGeneral/sostentabilidad/listSostentabilidad', [SostentabilidadDGController::class, "index"])->name('estimulos.evaluaciones.direccionGeneral.sostentabilidad');
    Route::get('/estimulos/evaluaciones/DireccionGeneral/sostentabilidad/searchSostentabilidad/{year}', [SostentabilidadDGController::class, "searchSostentabilidad"])->name('estimulos.evaluaciones.direccionGeneral.sostentabilidad');
    Route::post('/estimulos/evaluaciones/DireccionGeneral/sostentabilidad/saveDatosSostentabilidad', [SostentabilidadDGController::class, "saveDatos"])->name('estimulos.evaluaciones.direccionGeneral.sostentabilidad');
    Route::get('/estimulos/evaluaciones/DireccionGeneral/sostentabilidad/datosSostentabilidad/{year}/{criterio}', [SostentabilidadDGController::class, "datosSostentabilidad"])->name('estimulos.evaluaciones.direccionGeneral.sostentabilidad');
    /** Rutas para ls evaluaciones de estimulos Dirección general->Transferencia de conocimiento e innovación */
    Route::get('/estimulos/evaluaciones/DireccionGeneral/transferencia/listTransferencia', [TransferenciaDGController::class, "index"])->name('estimulos.evaluaciones.direccionGeneral.transferencia');
    Route::get('/estimulos/evaluaciones/DireccionGeneral/transferencia/searchTransferencia/{year}/{criterio}', [TransferenciaDGController::class, "search"])->name('estimulos.evaluaciones.direccionGeneral.transferencia');
    Route::post('/estimulos/evaluaciones/DireccionGeneral/transferencia/saveDatosTransferencia', [TransferenciaDGController::class, "saveDatos"])->name('estimulos.evaluaciones.direccionGeneral.transferencia');
    Route::get('/estimulos/evaluaciones/DireccionGeneral/transferencia/datosTransferencia/{year}/{criterio}', [TransferenciaDGController::class, "datosTransferencia"])->name('estimulos.evaluaciones.direccionGeneral.transferencia');
    Route::get('/estimulos/evaluaciones/DireccionGeneral/transferencia/searchEvidenciasTransferencia/{year}/{clave}/{criterio}', [TransferenciaDGController::class, "searchEvidencias"])->name('estimulos.evaluaciones.direccionGeneral.transferencia');
    Route::get('/estimulos/evaluaciones/DireccionGeneral/transferencia/getEvidenciasTransferencia/{clave}/{year}/{criterio}', [TransferenciaDGController::class, "getEvidenciasGeneral"])->name('estimulos.evaluaciones.direccionGeneral.transferencia');
    Route::get('/estimulos/evaluaciones/DireccionGeneral/transferencia/obtenerEvidenciasTransferencia/{clave}/{year}/{criterio}', [TransferenciaDGController::class, "obtenerEvidenciasGeneral"])->name('estimulos.evaluaciones.direccionGeneral.transferencia');
    Route::get('/estimulos/evaluaciones/DireccionGeneral/transferencia/puntosTransferencia/{id}/{objetivo}', [TransferenciaDGController::class, "puntos"])->name('estimulos.evaluaciones.direccionGeneral.transferencia');
    Route::post('/estimulos/evaluaciones/DireccionGeneral/transferencia/savePuntos', [TransferenciaDGController::class, "savePuntos"])->name('estimulos.evaluaciones.direccionGeneral.transferencia');
    Route::put('/estimulos/evaluaciones/DireccionGeneral/transferencia/updateDatosTransferencia', [TransferenciaDGController::class, "updateDatosGeneral"])->name('estimulos.evaluaciones.direccionGeneral.transferencia');
    Route::put('/estimulos/evaluaciones/DireccionGeneral/transferencia/updateDatosPuntos', [TransferenciaDGController::class, "updateDatosPuntos"])->name('estimulos.evaluaciones.direccionGeneral.transferencia');
    /** Rutas para las evidencias de estimulos Dirección general->Formación de recursos humanos */
    Route::get('/estimulos/evaluaciones/DireccionGeneral/formacionRH/listFormacionRH', [FormacionRHDGController::class, "index"])->name('estimulos.evaluaciones.direccionGeneral.formacionRH');
    Route::get('/estimulos/evaluaciones/DireccionGeneral/formacionRH/searchFormacionRH/{year}/{criterio}', [FormacionRHDGController::class, "search"])->name('estimulos.evaluaciones.direccionGeneral.formacionRH');
    Route::get('/estimulos/evaluaciones/DireccionGeneral/formacionRH/searchUsernameFormacionRH/{clave}', [FormacionRHDGController::class, "searchUsername"])->name('estimulos.evaluaciones.direccionGeneral.formacionRH');
    Route::post('/estimulos/evaluaciones/DireccionGeneral/formacionRH/saveDatosFormacionRH', [FormacionRHDGController::class, "saveDatos"])->name('estimulos.evaluaciones.direccionGeneral.formacionRH');
    Route::get('/estimulos/evaluaciones/DireccionGeneral/formacionRH/datosFormacionRH/{year}/{criterio}', [FormacionRHDGController::class, "datosFormacionRH"])->name('estimulos.evaluaciones.direccionGeneral.formacionRH');
    Route::get('/estimulos/evaluaciones/DireccionGeneral/formacionRH/searchEvidenciasFormacionRH/{year}/{clave}/{criterio}', [FormacionRHDGController::class, "searchEvidencias"])->name('estimulos.evaluaciones.direccionGeneral.formacionRH');
    Route::get('/estimulos/evaluaciones/DireccionGeneral/formacionRH/puntosFormacionRH/{id}/{objetivo}', [FormacionRHDGController::class, "puntos"])->name('estimulos.evaluaciones.direccionGeneral.formacionRH');
    Route::get('/estimulos/evaluaciones/DireccionGeneral/formacionRH/obtenerEvidenciasFormacionRH/{clave}/{year}/{criterio}', [FormacionRHDGController::class, "obtenerEvidencias"])->name('estimulos.evaluaciones.direccionGeneral.formacionRH');
    Route::get('/estimulos/evaluaciones/DireccionGeneral/formacionRH/getEvidenciasFormacionRH/{clave}/{year}/{criterio}', [FormacionRHDGController::class, "getEvidencias"])->name('estimulos.evaluaciones.direccionGeneral.formacionRH');
    Route::post('/estimulos/evaluaciones/DireccionGeneral/formacionRH/savePuntos', [FormacionRHDGController::class, "savePuntos"])->name('estimulos.evaluaciones.direccionGeneral.formacionRH');
    Route::put('/estimulos/evaluaciones/DireccionGeneral/formacionRH/updateDatosFormacionRH', [FormacionRHDGController::class, "updateDatos"])->name('estimulos.evaluaciones.direccionGeneral.formacionRH');
    Route::put('/estimulos/evaluaciones/DireccionGeneral/formacionRH/updateDatosPuntos', [FormacionRHDGController::class, "updateDatosPuntos"])->name('estimulos.evaluaciones.direccionGeneral.formacionRH');
    /** Rutas para las evidencias de estimulos Dirección general->Colaboracion institucional */
    Route::get('/estimulos/evaluaciones/DireccionGeneral/colaboracion/listColaboracion', [ColaboracionDGController::class, "index"])->name('estimulos.evaluaciones.direccionGeneral.colaboracion');
    Route::get('/estimulos/evaluaciones/DireccionGeneral/colaboracion/searchColaboradores/{year}', [ColaboracionDGController::class, "searchColaboradores"])->name('estimulos.evaluaciones.direccionGeneral.colaboracion');
    Route::post('/estimulos/evaluaciones/DireccionGeneral/colaboracion/saveDatos', [ColaboracionDGController::class, "saveDatos"])->name('estimulos.evaluaciones.direccionGeneral.colaboracion');
    Route::get('/estimulos/evaluaciones/DireccionGeneral/colaboracion/datosColaboradores/{year}/{criterio}', [ColaboracionDGController::class, "datosColaboradores"])->name('estimulos.evaluaciones.direccionGeneral.colaboracion');
    /** Rutas para las evidencias de estimulos Dirección general->Acreditaciones */
    Route::get('/estimulos/evaluaciones/DireccionGeneral/acreditaciones/listAcreditaciones', [AcreditacionesController::class, "index"])->name('estimulos.evaluaciones.direccionGeneral.acreditaciones');
    Route::get('/estimulos/evaluaciones/DireccionGeneral/acreditaciones/searchAcreditaciones/{year}/{criterio}', [AcreditacionesController::class, "searchAcreditaciones"])->name('estimulos.evaluaciones.direccionGeneral.acreditaciones');
    Route::get('/estimulos/evaluaciones/DireccionGeneral/acreditaciones/searchUsername/{clave}', [AcreditacionesController::class, "searchUsername"])->name('estimulos.evaluaciones.direccionGeneral.acreditaciones');
    Route::post('/estimulos/evaluaciones/DireccionGeneral/acreditaciones/saveDatosAcreditaciones', [AcreditacionesController::class, "saveDatos"])->name('estimulos.evaluaciones.direccionGeneral.acreditaciones');
    Route::get('/estimulos/evaluaciones/DireccionGeneral/acreditaciones/datosAcreditaciones/{year}/{criterio}', [AcreditacionesController::class, "datosAcreditaciones"])->name('estimulos.evaluaciones.direccionGeneral.acreditaciones');
    Route::get('/estimulos/evaluaciones/DireccionGeneral/acreditaciones/searchEvidencias/{year}/{clave}/{criterio}', [AcreditacionesController::class, "searchEvidencias"])->name('estimulos.evaluaciones.direccionGeneral.acreditaciones');
    Route::get('/estimulos/evaluaciones/DireccionGeneral/acreditaciones/puntos/{id}/{objetivo}', [AcreditacionesController::class, "puntos"])->name('estimulos.evaluaciones.direccionGeneral.acreditaciones');
    Route::get('/estimulos/evaluaciones/DireccionGeneral/acreditaciones/getEvidenciasAcreditaciones/{clave}/{year}/{criterio}', [AcreditacionesController::class, "getEvidencias"])->name('estimulos.evaluaciones.direccionGeneral.acreditaciones');
    Route::get('/estimulos/evaluaciones/DireccionGeneral/acreditaciones/obtenerEvidencias/{clave}/{year}/{criterio}', [AcreditacionesController::class, "obtenerEvidencias"])->name('estimulos.evaluaciones.direccionGeneral.acreditaciones');
    Route::post('/estimulos/evaluaciones/DireccionGeneral/acreditaciones/savePuntos', [AcreditacionesController::class, "savePuntos"])->name('estimulos.evaluaciones.direccionGeneral.acreditaciones');
    Route::put('/estimulos/evaluaciones/DireccionGeneral/acreditaciones/updateDatos', [AcreditacionesController::class, "updateDatos"])->name('estimulos.evaluaciones.direccionGeneral.acreditaciones');
    Route::put('/estimulos/evaluaciones/DireccionGeneral/acreditaciones/updateDatosPuntos', [AcreditacionesController::class, "updateDatosPuntos"])->name('estimulos.evaluaciones.direccionGeneral.acreditaciones');
    /** Rutas para las evidencias de estimulos Dirección general->Investigación cientifica tabla B */
    Route::get('/estimulos/evaluaciones/DireccionGeneral/investigacionB/listInvestigacionB', [InvestigacionBDGController::class, "index"])->name('estimulos.evaluaciones.direccionGeneral.investigacionCientificaB');
    /** Rutas para las evidencias de estimulos Dirección general->Sostenibilidad economica tabla B */
    Route::get('/estimulos/evaluaciones/DireccionGeneral/sostenibilidadB/listSostenibilidadB', [SostentabilidadBDGController::class, "index"])->name('estimulos.evaluaciones.direccionGeneral.sostenibilidadB');
    Route::get('/estimulos/evaluaciones/DireccionGeneral/sostenibilidadB/searchSostenibilidadB/{year}', [SostentabilidadBDGController::class, "searchSostenibilidadB"])->name('estimulos.evaluaciones.direccionGeneral.sostenibilidadB');
    Route::post('/estimulos/evaluaciones/DireccionGeneral/sostenibilidadB/saveDatos', [SostentabilidadBDGController::class, "saveDatos"])->name('estimulos.evaluaciones.direccionGeneral.sostenibilidadB');
    Route::get('/estimulos/evaluaciones/DireccionGeneral/sostenibilidadB/puntos/{id}/{objetivo}', [SostentabilidadBDGController::class, "puntos"])->name('estimulos.evaluaciones.direccionGeneral.sostenibilidadB');
    Route::get('/estimulos/evaluaciones/DireccionGeneral/sostenibilidadB/datosSostenibilidadB/{year}/{criterio}', [SostentabilidadBDGController::class, "datosSostenibilidadB"])->name('estimulos.evaluaciones.direccionGeneral.sostenibilidadB');
    /** Rutas para las evidencias de estimulos Dirección general->Transferencia de conocimiento e innovacion tabla B */
    Route::get('/estimulos/evaluaciones/DireccionGeneral/tranferenciaB/listTransferencia', [TransferenciaBDGController::class, "indexB"])->name('estimulos.evaluaciones.direccionGeneral.tranferenciaB');
    Route::get('/estimulos/evaluaciones/DireccionGeneral/tranferenciaB/searchTransferencia/{year}/{criterio}', [TransferenciaBDGController::class, "searchTransferenciaB"])->name('estimulos.evaluaciones.direccionGeneral.tranferenciaB');
    Route::get('/estimulos/evaluaciones/DireccionGeneral/tranferenciaB/puntos/{id}/{objetivo}', [TransferenciaBDGController::class, "puntosB"])->name('estimulos.evaluaciones.direccionGeneral.tranferenciaB');
    Route::post('/estimulos/evaluaciones/DireccionGeneral/tranferenciaB/saveDatos', [TransferenciaBDGController::class, "saveDatosB"])->name('estimulos.evaluaciones.direccionGeneral.tranferenciaB');
    Route::get('/estimulos/evaluaciones/DireccionGeneral/tranferenciaB/datosTransferenciaB/{year}/{criterio}', [TransferenciaBDGController::class, "datosTransferenciaB"])->name('estimulos.evaluaciones.direccionGeneral.tranferenciaB');

    /** Rutas para las evaluaciones de la direccion de administracion... */
    /** Rutas para las evaluaciones de estimulos Direccion de administración->Difusion y divulgacion... */
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/DifDiv/listDifDIv', [DifusionDivulgacionDAController::class, "index"])->name('estimulos.evaluaciones.direccionAdministracion.DivDif');
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/DifDiv/searchDifDIv/{year}', [DifusionDivulgacionDAController::class, "search"])->name('estimulos.evaluaciones.direccionAdministracion.DivDif');
    Route::post('/estimulos/evaluaciones/DireccionAdministracion/DifDiv/saveDatosDifDiv', [DifusionDivulgacionDAController::class, "saveDatos"])->name('estimulos.evaluaciones.direccionAdministracion.DivDif');
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/DifDiv/datosDifDiv/{year}/{criterio}', [DifusionDivulgacionDAController::class, "datosDifDiv"])->name('estimulos.evaluaciones.direccionAdministracion.DivDif');
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/DifDiv/searchEvidenciasDifDiv/{year}/{clave}', [DifusionDivulgacionDAController::class, "searchEvidencias"])->name('estimulos.evaluaciones.direccionAdministracion.DivDif');
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/DifDiv/getEvidenciasDifDiv/{clave}/{year}/{criterio}', [DifusionDivulgacionDAController::class, "getEvidenciasGeneral"])->name('estimulos.evaluaciones.direccionAdministracion.DivDif');
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/DifDiv/obtenerEvidenciasDifDiv/{clave}/{year}/{criterio}', [DifusionDivulgacionDAController::class, "obtenerEvidenciasGeneral"])->name('estimulos.evaluaciones.direccionAdministracion.DivDif');
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/DifDiv/puntosDifDiv/{id}/{objetivo}', [DifusionDivulgacionDAController::class, "puntos"])->name('estimulos.evaluaciones.direccionAdministracion.DivDif');
    Route::post('/estimulos/evaluaciones/DireccionAdministracion/DifDiv/savePuntos', [DifusionDivulgacionDAController::class, "savePuntos"])->name('estimulos.evaluaciones.direccionAdministracion.DivDif');
    Route::put('/estimulos/evaluaciones/DireccionAdministracion/DifDiv/updateDatosDifDiv', [DifusionDivulgacionDAController::class, "updateDatosGeneral"])->name('estimulos.evaluaciones.direccionAdministracion.DivDif');
    Route::put('/estimulos/evaluaciones/DireccionAdministracion/DifDiv/updateDatosPuntos', [DifusionDivulgacionDAController::class, "updateDatosPuntos"])->name('estimulos.evaluaciones.direccionAdministracion.DivDif');
    /** Rutas para las evaluaciones de estimulos Direccion de administración->Posgrado... */
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/posgrado/listPosgrado', [PosgradoDAController::class, "index"])->name('estimulos.evaluaciones.direccionAdministracion.posgrado');
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/posgrado/searchPosgrado/{year}/{criterio}', [PosgradoDAController::class, "search"])->name('estimulos.evaluaciones.direccionAdministracion.posgrado');
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/posgrado/searchUsernamePosgrado/{clave}', [PosgradoDAController::class, "searchUsername"])->name('estimulos.evaluaciones.direccionAdministracion.posgrado');
    Route::post('/estimulos/evaluaciones/DireccionAdministracion/posgrado/saveDatosPosgrado', [PosgradoDAController::class, "saveDatos"])->name('estimulos.evaluaciones.direccionAdministracion.posgrado');
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/posgrado/datosposgrado/{year}/{criterio}', [PosgradoDAController::class, "datosPosgrado"])->name('estimulos.evaluaciones.direccionAdministracion.posgrado');
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/posgrado/searchEvidenciasPosgrado/{year}/{clave}/{criterio}', [PosgradoDAController::class, "searchEvidencias"])->name('estimulos.evaluaciones.direccionAdministracion.posgrado');
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/posgrado/puntosPosgrado/{id}/{objetivo}', [PosgradoDAController::class, "puntos"])->name('estimulos.evaluaciones.direccionAdministracion.posgrado');
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/posgrado/getEvidenciasPosgrado/{clave}/{year}/{criterio}', [PosgradoDAController::class, "getEvidencias"])->name('estimulos.evaluaciones.direccionAdministracion.posgrado');
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/posgrado/obtenerEvidenciasPosgrado/{clave}/{year}/{criterio}', [PosgradoDAController::class, "obtenerEvidencias"])->name('estimulos.evaluaciones.direccionAdministracion.posgrado');
    Route::post('/estimulos/evaluaciones/DireccionAdministracion/posgrado/savePuntos', [PosgradoDAController::class, "savePuntos"])->name('estimulos.evaluaciones.direccionAdministracion.posgrado');
    Route::put('/estimulos/evaluaciones/DireccionAdministracion/posgrado/updateDatosPosgrado', [PosgradoDAController::class, "updateDatos"])->name('estimulos.evaluaciones.direccionAdministracion.posgrado');
    Route::put('/estimulos/evaluaciones/DireccionAdministracion/posgrado/updateDatosPuntos', [PosgradoDAController::class, "updateDatosPuntos"])->name('estimulos.evaluaciones.direccionAdministracion.posgrado');
    /** Rutas para las evaluaciones de estimulos Direccion administracion->Investigacion Cientifica... */
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/investigacion/listInvestigacion', [InvestigacionDAController::class, "index"])->name('estimulos.evaluaciones.direccionAdministracion.investigacion');
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/investigacion/searchInvestigacion/{year}/{criterio}', [InvestigacionDAController::class, "search"])->name('estimulos.evaluaciones.direccionAdministracion.investigacion');
    Route::post('/estimulos/evaluaciones/DireccionAdministracion/investigacion/saveDatosInvestigacion', [InvestigacionDAController::class, "saveDatos"])->name('estimulos.evaluaciones.direccionAdministracion.investigacion');
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/investigacion/datosInvestigacion/{year}/{criterio}', [InvestigacionDAController::class, "datosInvestigacion"])->name('estimulos.evaluaciones.direccionAdministracion.investigacion');
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/investigacion/searchEvidenciasInvestigacion/{year}/{clave}/{criterio}', [InvestigacionDAController::class, "searchEvidencias"])->name('estimulos.evaluaciones.direccionAdministracion.investigacion');
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/investigacion/obtenerEvidenciasInvestigacion/{clave}/{year}/{criterio}', [InvestigacionDAController::class, "obtenerEvidencias"])->name('estimulos.evaluaciones.direccionAdministracion.investigacion');
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/investigacion/puntosinvestigacion/{id}/{objetivo}', [InvestigacionDAController::class, "puntos"])->name('estimulos.evaluaciones.direccionAdministracion.investigacion');
    Route::post('/estimulos/evaluaciones/DireccionAdministracion/investigacion/savePuntos', [InvestigacionDAController::class, "savePuntos"])->name('estimulos.evaluaciones.direccionAdministracion.investigacion');
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/investigacion/getEvidenciasInvestigacion/{clave}/{year}/{criterio}', [InvestigacionDAController::class, "getEvidencias"])->name('estimulos.evaluaciones.direccionAdministracion.investigacion');
    Route::put('/estimulos/evaluaciones/DireccionAdministracion/investigacion/updateDatos', [InvestigacionDAController::class, "updateDatos"])->name('estimulos.evaluaciones.direccionAdministracion.investigacion');
    Route::put('/estimulos/evaluaciones/DireccionAdministracion/investigacion/updateDatosPuntos', [InvestigacionDAController::class, "updateDatosPuntos"])->name('estimulos.evaluaciones.direccionAdministracion.investigacion');
    /** Rutas para las evaluaciones de estimulos Direccion administracion->Sostentabilidad */
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/sostentabilidad/listSostentabilidad', [SostenibilidadDAController::class, "index"])->name('estimulos.evaluaciones.direccionAdministracion.sostentabilidad');
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/sostentabilidad/searchSostentabilidad/{year}', [SostenibilidadDAController::class, "searchSostentabilidad"])->name('estimulos.evaluaciones.direccionAdministracion.sostentabilidad');
    Route::post('/estimulos/evaluaciones/DireccionAdministracion/sostentabilidad/saveDatosSostentabilidad', [SostenibilidadDAController::class, "saveDatos"])->name('estimulos.evaluaciones.direccionAdministracion.sostentabilidad');
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/sostentabilidad/datosSostentabilidad/{year}/{criterio}', [SostenibilidadDAController::class, "datosSostentabilidad"])->name('estimulos.evaluaciones.direccionAdministracion.sostentabilidad');
    /** Rutas para ls evaluaciones de estimulos Dirección administracion->Transferencia de conocimiento e innovación */
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/transferencia/listTransferencia', [TransferenciaDAController::class, "index"])->name('estimulos.evaluaciones.direccionAdministracion.transferencia');
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/transferencia/searchTransferencia/{year}/{criterio}', [TransferenciaDAController::class, "search"])->name('estimulos.evaluaciones.direccionAdministracion.transferencia');
    Route::post('/estimulos/evaluaciones/DireccionAdministracion/transferencia/saveDatosTransferencia', [TransferenciaDAController::class, "saveDatos"])->name('estimulos.evaluaciones.direccionAdministracion.transferencia');
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/transferencia/datosTransferencia/{year}/{criterio}', [TransferenciaDAController::class, "datosTransferencia"])->name('estimulos.evaluaciones.direccionAdministracion.transferencia');
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/transferencia/searchEvidenciasTransferencia/{year}/{clave}/{criterio}', [TransferenciaDAController::class, "searchEvidencias"])->name('estimulos.evaluaciones.direccionAdministracion.transferencia');
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/transferencia/getEvidenciasTransferencia/{clave}/{year}/{criterio}', [TransferenciaDAController::class, "getEvidencias"])->name('estimulos.evaluaciones.direccionAdministracion.transferencia');
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/transferencia/obtenerEvidenciasTransferencia/{clave}/{year}/{criterio}', [TransferenciaDAController::class, "obtenerEvidencias"])->name('estimulos.evaluaciones.direccionAdministracion.transferencia');
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/transferencia/puntosTransferencia/{id}/{objetivo}', [TransferenciaDAController::class, "puntos"])->name('estimulos.evaluaciones.direccionAdministracion.transferencia');
    Route::post('/estimulos/evaluaciones/DireccionAdministracion/transferencia/savePuntos', [TransferenciaDAController::class, "savePuntos"])->name('estimulos.evaluaciones.direccionAdministracion.transferencia');
    Route::put('/estimulos/evaluaciones/DireccionAdministracion/transferencia/updateDatosTransferencia', [TransferenciaDAController::class, "updateDatos"])->name('estimulos.evaluaciones.direccionAdministracion.transferencia');
    Route::put('/estimulos/evaluaciones/DireccionAdministracion/transferencia/updateDatosPuntos', [TransferenciaDAController::class, "updateDatosPuntos"])->name('estimulos.evaluaciones.direccionAdministracion.transferencia');
    /** Rutas para las evidencias de estimulos Dirección administracion->Formación de recursos humanos */
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/formacionRH/listFormacionRH', [FormacionRHDAController::class, "index"])->name('estimulos.evaluaciones.direccionAdministracion.formacionRH');
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/formacionRH/searchFormacionRH/{year}/{criterio}', [FormacionRHDAController::class, "search"])->name('estimulos.evaluaciones.direccionAdministracion.formacionRH');
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/formacionRH/searchUsernameFormacionRH/{clave}', [FormacionRHDAController::class, "searchUsername"])->name('estimulos.evaluaciones.direccionAdministracion.formacionRH');
    Route::post('/estimulos/evaluaciones/DireccionAdministracion/formacionRH/saveDatosFormacionRH', [FormacionRHDAController::class, "saveDatos"])->name('estimulos.evaluaciones.direccionAdministracion.formacionRH');
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/formacionRH/datosFormacionRH/{year}/{criterio}', [FormacionRHDAController::class, "datosFormacionRH"])->name('estimulos.evaluaciones.direccionAdministracion.formacionRH');
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/formacionRH/searchEvidenciasFormacionRH/{year}/{clave}/{criterio}', [FormacionRHDAController::class, "searchEvidencias"])->name('estimulos.evaluaciones.direccionAdministracion.formacionRH');
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/formacionRH/puntosFormacionRH/{id}/{objetivo}', [FormacionRHDAController::class, "puntos"])->name('estimulos.evaluaciones.direccionAdministracion.formacionRH');
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/formacionRH/obtenerEvidenciasFormacionRH/{clave}/{year}/{criterio}', [FormacionRHDAController::class, "obtenerEvidencias"])->name('estimulos.evaluaciones.direccionAdministracion.formacionRH');
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/formacionRH/getEvidenciasFormacionRH/{clave}/{year}/{criterio}', [FormacionRHDAController::class, "getEvidencias"])->name('estimulos.evaluaciones.direccionAdministracion.formacionRH');
    Route::post('/estimulos/evaluaciones/DireccionAdministracion/formacionRH/savePuntos', [FormacionRHDAController::class, "savePuntos"])->name('estimulos.evaluaciones.direccionAdministracion.formacionRH');
    Route::put('/estimulos/evaluaciones/DireccionAdministracion/formacionRH/updateDatosFormacionRH', [FormacionRHDAController::class, "updateDatos"])->name('estimulos.evaluaciones.direccionAdministracion.formacionRH');
    Route::put('/estimulos/evaluaciones/DireccionAdministracion/formacionRH/updateDatosPuntos', [FormacionRHDAController::class, "updateDatosPuntos"])->name('estimulos.evaluaciones.direccionAdministracion.formacionRH');
    /** Rutas para las evidencias de estimulos Dirección administracion->Colaboracion institucional */
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/colaboracion/listColaboracion', [ColaboracionDAController::class, "index"])->name('estimulos.evaluaciones.direccionAdministracion.colaboracion');
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/colaboracion/searchColaboradores/{year}', [ColaboracionDAController::class, "searchColaboradores"])->name('estimulos.evaluaciones.direccionAdministracion.colaboracion');
    Route::post('/estimulos/evaluaciones/DireccionAdministracion/colaboracion/saveDatos', [ColaboracionDAController::class, "saveDatos"])->name('estimulos.evaluaciones.direccionAdministracion.colaboracion');
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/colaboracion/datosColaboradores/{year}/{criterio}', [ColaboracionDAController::class, "datosColaboradores"])->name('estimulos.evaluaciones.direccionAdministracion.colaboracion');
    /** Rutas para las evidencias de estimulos Dirección administracion->Acreditaciones */
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/acreditaciones/listAcreditaciones', [AcreditacionesDAController::class, "index"])->name('estimulos.evaluaciones.direccionAdministracion.acreditaciones');
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/acreditaciones/searchAcreditaciones/{year}/{criterio}', [AcreditacionesDAController::class, "searchAcreditaciones"])->name('estimulos.evaluaciones.direccionAdministracion.acreditaciones');
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/acreditaciones/searchUsername/{clave}', [AcreditacionesDAController::class, "searchUsername"])->name('estimulos.evaluaciones.direccionAdministracion.acreditaciones');
    Route::post('/estimulos/evaluaciones/DireccionAdministracion/acreditaciones/saveDatosAcreditaciones', [AcreditacionesDAController::class, "saveDatos"])->name('estimulos.evaluaciones.direccionAdministracion.acreditaciones');
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/acreditaciones/datosAcreditaciones/{year}/{criterio}', [AcreditacionesDAController::class, "datosAcreditaciones"])->name('estimulos.evaluaciones.direccionAdministracion.acreditaciones');
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/acreditaciones/searchEvidencias/{year}/{clave}/{criterio}', [AcreditacionesDAController::class, "searchEvidencias"])->name('estimulos.evaluaciones.direccionAdministracion.acreditaciones');
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/acreditaciones/puntos/{id}/{objetivo}', [AcreditacionesDAController::class, "puntos"])->name('estimulos.evaluaciones.direccionAdministracion.acreditaciones');
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/acreditaciones/getEvidenciasAcreditaciones/{clave}/{year}/{criterio}', [AcreditacionesDAController::class, "getEvidencias"])->name('estimulos.evaluaciones.direccionAdministracion.acreditaciones');
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/acreditaciones/obtenerEvidencias/{clave}/{year}/{criterio}', [AcreditacionesDAController::class, "obtenerEvidencias"])->name('estimulos.evaluaciones.direccionAdministracion.acreditaciones');
    Route::post('/estimulos/evaluaciones/DireccionAdministracion/acreditaciones/savePuntos', [AcreditacionesDAController::class, "savePuntos"])->name('estimulos.evaluaciones.direccionAdministracion.acreditaciones');
    Route::put('/estimulos/evaluaciones/DireccionAdministracion/acreditaciones/updateDatos', [AcreditacionesDAController::class, "updateDatos"])->name('estimulos.evaluaciones.direccionAdministracion.acreditaciones');
    Route::put('/estimulos/evaluaciones/DireccionAdministracion/acreditaciones/updateDatosPuntos', [AcreditacionesDAController::class, "updateDatosPuntos"])->name('estimulos.evaluaciones.direccionAdministracion.acreditaciones');
    /** Rutas para las evidencias de estimulos Dirección administracion->Investigación cientifica tabla B */
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/investigacionB/listInvestigacionB', [InvestigacionDAController::class, "indexB"])->name('estimulos.evaluaciones.direccionAdministracion.investigacionB');
    /** Rutas para las evidencias de estimulos Dirección administracion->Sostenibilidad economica tabla B */
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/sostenibilidadB/listSostenibilidadB', [SostenibilidadDAController::class, "indexB"])->name('estimulos.evaluaciones.direccionAdministracion.sostenibilidadB');
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/sostenibilidadB/searchSostenibilidadB/{year}', [SostenibilidadDAController::class, "searchSostenibilidadB"])->name('estimulos.evaluaciones.direccionAdministracion.sostenibilidadB');
    Route::post('/estimulos/evaluaciones/DireccionAdministracion/sostenibilidadB/saveDatos', [SostenibilidadDAController::class, "saveDatosB"])->name('estimulos.evaluaciones.direccionAdministracion.sostenibilidadB');
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/sostenibilidadB/puntos/{id}/{objetivo}', [SostenibilidadDAController::class, "puntosB"])->name('estimulos.evaluaciones.direccionAdministracion.sostenibilidadB');
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/sostenibilidadB/datosSostenibilidadB/{year}/{criterio}', [SostenibilidadDAController::class, "datosSostenibilidadB"])->name('estimulos.evaluaciones.direccionAdministracion.sostenibilidadB');
    /** Rutas para las evidencias de estimulos Dirección administracion->Transferencia de conocimiento e innovacion tabla B */
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/tranferenciaB/listTransferencia', [TransferenciaDAController::class, "indexB"])->name('estimulos.evaluaciones.direccionAdministracion.tranferenciaB');
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/tranferenciaB/searchTransferencia/{year}/{criterio}', [TransferenciaDAController::class, "searchTransferenciaB"])->name('estimulos.evaluaciones.direccionAdministracion.tranferenciaB');
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/tranferenciaB/puntos/{id}/{objetivo}', [TransferenciaDAController::class, "puntosB"])->name('estimulos.evaluaciones.direccionAdministracion.tranferenciaB');
    Route::post('/estimulos/evaluaciones/DireccionAdministracion/tranferenciaB/saveDatos', [TransferenciaDAController::class, "saveDatosB"])->name('estimulos.evaluaciones.direccionAdministracion.tranferenciaB');
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/tranferenciaB/datosTransferenciaB/{year}/{criterio}', [TransferenciaDAController::class, "datosTransferenciaB"])->name('estimulos.evaluaciones.direccionAdministracion.tranferenciaB');

    /** Rutas para las evaluaciones de la direccion de posgrado... */
    /** Rutas para las evaluaciones de estimulos Direccion de posgrado->Difusion y divulgacion... */
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/DifDiv/listDifDIv', [DifusionDivulgacionDPController::class, "index"])->name('estimulos.evaluaciones.direccionPosgrado.DivDif');
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/DifDiv/searchDifDIv/{year}', [DifusionDivulgacionDPController::class, "search"])->name('estimulos.evaluaciones.direccionPosgrado.DivDif');
    Route::post('/estimulos/evaluaciones/DireccionPosgrado/DifDiv/saveDatosDifDiv', [DifusionDivulgacionDPController::class, "saveDatos"])->name('estimulos.evaluaciones.direccionPosgrado.DivDif');
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/DifDiv/datosDifDiv/{year}/{criterio}', [DifusionDivulgacionDPController::class, "datosDifDiv"])->name('estimulos.evaluaciones.direccionPosgrado.DivDif');
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/DifDiv/searchEvidenciasDifDiv/{year}/{clave}', [DifusionDivulgacionDPController::class, "searchEvidencias"])->name('estimulos.evaluaciones.direccionPosgrado.DivDif');
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/DifDiv/getEvidenciasDifDiv/{clave}/{year}/{criterio}', [DifusionDivulgacionDPController::class, "getEvidenciasGeneral"])->name('estimulos.evaluaciones.direccionPosgrado.DivDif');
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/DifDiv/obtenerEvidenciasDifDiv/{clave}/{year}/{criterio}', [DifusionDivulgacionDPController::class, "obtenerEvidenciasGeneral"])->name('estimulos.evaluaciones.direccionPosgrado.DivDif');
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/DifDiv/puntosDifDiv/{id}/{objetivo}', [DifusionDivulgacionDPController::class, "puntos"])->name('estimulos.evaluaciones.direccionPosgrado.DivDif');
    Route::post('/estimulos/evaluaciones/DireccionPosgrado/DifDiv/savePuntos', [DifusionDivulgacionDPController::class, "savePuntos"])->name('estimulos.evaluaciones.direccionPosgrado.DivDif');
    Route::put('/estimulos/evaluaciones/DireccionPosgrado/DifDiv/updateDatosDifDiv', [DifusionDivulgacionDPController::class, "updateDatosGeneral"])->name('estimulos.evaluaciones.direccionPosgrado.DivDif');
    Route::put('/estimulos/evaluaciones/DireccionPosgrado/DifDiv/updateDatosPuntos', [DifusionDivulgacionDPController::class, "updateDatosPuntos"])->name('estimulos.evaluaciones.direccionPosgrado.DivDif');
    /** Rutas para las evaluaciones de estimulos Direccion de posgrado->Posgrado... */
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/posgrado/listPosgrado', [PosgradoDPController::class, "index"])->name('estimulos.evaluaciones.direccionPosgrado.posgrado');
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/posgrado/searchPosgrado/{year}/{criterio}', [PosgradoDPController::class, "search"])->name('estimulos.evaluaciones.direccionPosgrado.posgrado');
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/posgrado/searchUsernamePosgrado/{clave}', [PosgradoDPController::class, "searchUsername"])->name('estimulos.evaluaciones.direccionPosgrado.posgrado');
    Route::post('/estimulos/evaluaciones/DireccionPosgrado/posgrado/saveDatosPosgrado', [PosgradoDPController::class, "saveDatos"])->name('estimulos.evaluaciones.direccionPosgrado.posgrado');
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/posgrado/datosposgrado/{year}/{criterio}', [PosgradoDPController::class, "datosPosgrado"])->name('estimulos.evaluaciones.direccionPosgrado.posgrado');
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/posgrado/searchEvidenciasPosgrado/{year}/{clave}/{criterio}', [PosgradoDPController::class, "searchEvidencias"])->name('estimulos.evaluaciones.direccionPosgrado.posgrado');
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/posgrado/puntosPosgrado/{id}/{objetivo}', [PosgradoDPController::class, "puntos"])->name('estimulos.evaluaciones.direccionPosgrado.posgrado');
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/posgrado/getEvidenciasPosgrado/{clave}/{year}/{criterio}', [PosgradoDPController::class, "getEvidencias"])->name('estimulos.evaluaciones.direccionPosgrado.posgrado');
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/posgrado/obtenerEvidenciasPosgrado/{clave}/{year}/{criterio}', [PosgradoDPController::class, "obtenerEvidencias"])->name('estimulos.evaluaciones.direccionPosgrado.posgrado');
    Route::post('/estimulos/evaluaciones/DireccionPosgrado/posgrado/savePuntos', [PosgradoDPController::class, "savePuntos"])->name('estimulos.evaluaciones.direccionPosgrado.posgrado');
    Route::put('/estimulos/evaluaciones/DireccionPosgrado/posgrado/updateDatosPosgrado', [PosgradoDPController::class, "updateDatos"])->name('estimulos.evaluaciones.direccionPosgrado.posgrado');
    Route::put('/estimulos/evaluaciones/DireccionPosgrado/posgrado/updateDatosPuntos', [PosgradoDPController::class, "updateDatosPuntos"])->name('estimulos.evaluaciones.direccionPosgrado.posgrado');
    /** Rutas para las evaluaciones de estimulos Direccion posgrado->Investigacion Cientifica... */
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/investigacion/listInvestigacion', [InvestigacionDPController::class, "index"])->name('estimulos.evaluaciones.direccionPosgrado.investigacion');
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/investigacion/searchInvestigacion/{year}/{criterio}', [InvestigacionDPController::class, "search"])->name('estimulos.evaluaciones.direccionPosgrado.investigacion');
    Route::post('/estimulos/evaluaciones/DireccionPosgrado/investigacion/saveDatosInvestigacion', [InvestigacionDPController::class, "saveDatos"])->name('estimulos.evaluaciones.direccionPosgrado.investigacion');
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/investigacion/datosInvestigacion/{year}/{criterio}', [InvestigacionDPController::class, "datosInvestigacion"])->name('estimulos.evaluaciones.direccionPosgrado.investigacion');
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/investigacion/searchEvidenciasInvestigacion/{year}/{clave}/{criterio}', [InvestigacionDPController::class, "searchEvidencias"])->name('estimulos.evaluaciones.direccionPosgrado.investigacion');
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/investigacion/obtenerEvidenciasInvestigacion/{clave}/{year}/{criterio}', [InvestigacionDPController::class, "obtenerEvidencias"])->name('estimulos.evaluaciones.direccionPosgrado.investigacion');
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/investigacion/puntosinvestigacion/{id}/{objetivo}', [InvestigacionDPController::class, "puntos"])->name('estimulos.evaluaciones.direccionPosgrado.investigacion');
    Route::post('/estimulos/evaluaciones/DireccionPosgrado/investigacion/savePuntos', [InvestigacionDPController::class, "savePuntos"])->name('estimulos.evaluaciones.direccionPosgrado.investigacion');
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/investigacion/getEvidenciasInvestigacion/{clave}/{year}/{criterio}', [InvestigacionDPController::class, "getEvidencias"])->name('estimulos.evaluaciones.direccionPosgrado.investigacion');
    Route::put('/estimulos/evaluaciones/DireccionPosgrado/investigacion/updateDatos', [InvestigacionDPController::class, "updateDatos"])->name('estimulos.evaluaciones.direccionPosgrado.investigacion');
    Route::put('/estimulos/evaluaciones/DireccionPosgrado/investigacion/updateDatosPuntos', [InvestigacionDPController::class, "updateDatosPuntos"])->name('estimulos.evaluaciones.direccionPosgrado.investigacion');
    /** Rutas para las evaluaciones de estimulos Direccion posgrado->Sostentabilidad */
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/sostentabilidad/listSostentabilidad', [SostenibilidadDPController::class, "index"])->name('estimulos.evaluaciones.direccionPosgrado.sostentabilidad');
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/sostentabilidad/searchSostentabilidad/{year}', [SostenibilidadDPController::class, "searchSostentabilidad"])->name('estimulos.evaluaciones.direccionPosgrado.sostentabilidad');
    Route::post('/estimulos/evaluaciones/DireccionPosgrado/sostentabilidad/saveDatosSostentabilidad', [SostenibilidadDPController::class, "saveDatos"])->name('estimulos.evaluaciones.direccionPosgrado.sostentabilidad');
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/sostentabilidad/datosSostentabilidad/{year}/{criterio}', [SostenibilidadDPController::class, "datosSostentabilidad"])->name('estimulos.evaluaciones.direccionPosgrado.sostentabilidad');
    /** Rutas para ls evaluaciones de estimulos Dirección posgrado->Transferencia de conocimiento e innovación */
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/transferencia/listTransferencia', [TransferenciaDPController::class, "index"])->name('estimulos.evaluaciones.direccionPosgrado.transferencia');
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/transferencia/searchTransferencia/{year}/{criterio}', [TransferenciaDPController::class, "search"])->name('estimulos.evaluaciones.direccionPosgrado.transferencia');
    Route::post('/estimulos/evaluaciones/DireccionPosgrado/transferencia/saveDatosTransferencia', [TransferenciaDPController::class, "saveDatos"])->name('estimulos.evaluaciones.direccionPosgrado.transferencia');
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/transferencia/datosTransferencia/{year}/{criterio}', [TransferenciaDPController::class, "datosTransferencia"])->name('estimulos.evaluaciones.direccionPosgrado.transferencia');
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/transferencia/searchEvidenciasTransferencia/{year}/{clave}/{criterio}', [TransferenciaDPController::class, "searchEvidencias"])->name('estimulos.evaluaciones.direccionPosgrado.transferencia');
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/transferencia/getEvidenciasTransferencia/{clave}/{year}/{criterio}', [TransferenciaDPController::class, "getEvidenciasPosgrado"])->name('estimulos.evaluaciones.direccionPosgrado.transferencia');
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/transferencia/obtenerEvidenciasTransferencia/{clave}/{year}/{criterio}', [TransferenciaDPController::class, "obtenerEvidenciasPosgrado"])->name('estimulos.evaluaciones.direccionPosgrado.transferencia');
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/transferencia/puntosTransferencia/{id}/{objetivo}', [TransferenciaDPController::class, "puntos"])->name('estimulos.evaluaciones.direccionPosgrado.transferencia');
    Route::post('/estimulos/evaluaciones/DireccionPosgrado/transferencia/savePuntos', [TransferenciaDPController::class, "savePuntos"])->name('estimulos.evaluaciones.direccionPosgrado.transferencia');
    Route::put('/estimulos/evaluaciones/DireccionPosgrado/transferencia/updateDatosTransferencia', [TransferenciaDPController::class, "updateDatosPosgrado"])->name('estimulos.evaluaciones.direccionPosgrado.transferencia');
    Route::put('/estimulos/evaluaciones/DireccionPosgrado/transferencia/updateDatosPuntos', [TransferenciaDPController::class, "updateDatosPuntos"])->name('estimulos.evaluaciones.direccionPosgrado.transferencia');
    /** Rutas para las evidencias de estimulos Dirección posgrado->Formación de recursos humanos */
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/formacionRH/listFormacionRH', [FormacionRHDPController::class, "index"])->name('estimulos.evaluaciones.direccionPosgrado.formacionRH');
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/formacionRH/searchFormacionRH/{year}/{criterio}', [FormacionRHDPController::class, "search"])->name('estimulos.evaluaciones.direccionPosgrado.formacionRH');
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/formacionRH/searchUsernameFormacionRH/{clave}', [FormacionRHDPController::class, "searchUsername"])->name('estimulos.evaluaciones.direccionPosgrado.formacionRH');
    Route::post('/estimulos/evaluaciones/DireccionPosgrado/formacionRH/saveDatosFormacionRH', [FormacionRHDPController::class, "saveDatos"])->name('estimulos.evaluaciones.direccionPosgrado.formacionRH');
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/formacionRH/datosFormacionRH/{year}/{criterio}', [FormacionRHDPController::class, "datosFormacionRH"])->name('estimulos.evaluaciones.direccionPosgrado.formacionRH');
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/formacionRH/searchEvidenciasFormacionRH/{year}/{clave}/{criterio}', [FormacionRHDPController::class, "searchEvidencias"])->name('estimulos.evaluaciones.direccionPosgrado.formacionRH');
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/formacionRH/puntosFormacionRH/{id}/{objetivo}', [FormacionRHDPController::class, "puntos"])->name('estimulos.evaluaciones.direccionPosgrado.formacionRH');
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/formacionRH/obtenerEvidenciasFormacionRH/{clave}/{year}/{criterio}', [FormacionRHDPController::class, "obtenerEvidencias"])->name('estimulos.evaluaciones.direccionPosgrado.formacionRH');
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/formacionRH/getEvidenciasFormacionRH/{clave}/{year}/{criterio}', [FormacionRHDPController::class, "getEvidencias"])->name('estimulos.evaluaciones.direccionPosgrado.formacionRH');
    Route::post('/estimulos/evaluaciones/DireccionPosgrado/formacionRH/savePuntos', [FormacionRHDPController::class, "savePuntos"])->name('estimulos.evaluaciones.direccionPosgrado.formacionRH');
    Route::put('/estimulos/evaluaciones/DireccionPosgrado/formacionRH/updateDatosFormacionRH', [FormacionRHDPController::class, "updateDatos"])->name('estimulos.evaluaciones.direccionPosgrado.formacionRH');
    Route::put('/estimulos/evaluaciones/DireccionPosgrado/formacionRH/updateDatosPuntos', [FormacionRHDPController::class, "updateDatosPuntos"])->name('estimulos.evaluaciones.direccionPosgrado.formacionRH');
    /** Rutas para las evidencias de estimulos Dirección posgrado->Colaboracion institucional */
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/colaboracion/listColaboracion', [ColaboracionDPController::class, "index"])->name('estimulos.evaluaciones.direccionPosgrado.colaboracion');
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/colaboracion/searchColaboradores/{year}', [ColaboracionDPController::class, "searchColaboradores"])->name('estimulos.evaluaciones.direccionPosgrado.colaboracion');
    Route::post('/estimulos/evaluaciones/DireccionPosgrado/colaboracion/saveDatos', [ColaboracionDPController::class, "saveDatos"])->name('estimulos.evaluaciones.direccionPosgrado.colaboracion');
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/colaboracion/datosColaboradores/{year}/{criterio}', [ColaboracionDPController::class, "datosColaboradores"])->name('estimulos.evaluaciones.direccionPosgrado.colaboracion');
    /** Rutas para las evidencias de estimulos Dirección posgrado->Acreditaciones */
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/acreditaciones/listAcreditaciones', [AcreditacionesDPController::class, "index"])->name('estimulos.evaluaciones.direccionPosgrado.acreditaciones');
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/acreditaciones/searchAcreditaciones/{year}/{criterio}', [AcreditacionesDPController::class, "searchAcreditaciones"])->name('estimulos.evaluaciones.direccionPosgrado.acreditaciones');
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/acreditaciones/searchUsername/{clave}', [AcreditacionesDPController::class, "searchUsername"])->name('estimulos.evaluaciones.direccionPosgrado.acreditaciones');
    Route::post('/estimulos/evaluaciones/DireccionPosgrado/acreditaciones/saveDatosAcreditaciones', [AcreditacionesDPController::class, "saveDatos"])->name('estimulos.evaluaciones.direccionPosgrado.acreditaciones');
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/acreditaciones/datosAcreditaciones/{year}/{criterio}', [AcreditacionesDPController::class, "datosAcreditaciones"])->name('estimulos.evaluaciones.direccionPosgrado.acreditaciones');
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/acreditaciones/searchEvidencias/{year}/{clave}/{criterio}', [AcreditacionesDPController::class, "searchEvidencias"])->name('estimulos.evaluaciones.direccionPosgrado.acreditaciones');
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/acreditaciones/puntos/{id}/{objetivo}', [AcreditacionesDPController::class, "puntos"])->name('estimulos.evaluaciones.direccionPosgrado.acreditaciones');
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/acreditaciones/getEvidenciasAcreditaciones/{clave}/{year}/{criterio}', [AcreditacionesDPController::class, "getEvidencias"])->name('estimulos.evaluaciones.direccionPosgrado.acreditaciones');
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/acreditaciones/obtenerEvidencias/{clave}/{year}/{criterio}', [AcreditacionesDPController::class, "obtenerEvidencias"])->name('estimulos.evaluaciones.direccionPosgrado.acreditaciones');
    Route::post('/estimulos/evaluaciones/DireccionPosgrado/acreditaciones/savePuntos', [AcreditacionesDPController::class, "savePuntos"])->name('estimulos.evaluaciones.direccionPosgrado.acreditaciones');
    Route::put('/estimulos/evaluaciones/DireccionPosgrado/acreditaciones/updateDatos', [AcreditacionesDPController::class, "updateDatos"])->name('estimulos.evaluaciones.direccionPosgrado.acreditaciones');
    Route::put('/estimulos/evaluaciones/DireccionPosgrado/acreditaciones/updateDatosPuntos', [AcreditacionesDPController::class, "updateDatosPuntos"])->name('estimulos.evaluaciones.direccionPosgrado.acreditaciones');
    /** Rutas para las evidencias de estimulos Dirección posgrado->Investigación cientifica tabla B */
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/investigacionB/listInvestigacionB', [InvestigacionDPController::class, "indexB"])->name('estimulos.evaluaciones.direccionPosgrado.investigacionB');
    /** Rutas para las evidencias de estimulos Dirección posgrado->Sostenibilidad economica tabla B */
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/sostenibilidadB/listSostenibilidadB', [SostenibilidadDPController::class, "indexB"])->name('estimulos.evaluaciones.direccionPosgrado.sostenibilidadB');
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/sostenibilidadB/searchSostenibilidadB/{year}', [SostenibilidadDPController::class, "searchSostenibilidadB"])->name('estimulos.evaluaciones.direccionPosgrado.sostenibilidadB');
    Route::post('/estimulos/evaluaciones/DireccionPosgrado/sostenibilidadB/saveDatos', [SostenibilidadDPController::class, "saveDatosB"])->name('estimulos.evaluaciones.direccionPosgrado.sostenibilidadB');
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/sostenibilidadB/puntos/{id}/{objetivo}', [SostenibilidadDPController::class, "puntosB"])->name('estimulos.evaluaciones.direccionPosgrado.sostenibilidadB');
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/sostenibilidadB/datosSostenibilidadB/{year}/{criterio}', [SostenibilidadDPController::class, "datosSostenibilidadB"])->name('estimulos.evaluaciones.direccionPosgrado.sostenibilidadB');
    /** Rutas para las evidencias de estimulos Dirección posgrado->Transferencia de conocimiento e innovacion tabla B */
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/tranferenciaB/listTransferencia', [TransferenciaDPController::class, "indexB"])->name('estimulos.evaluaciones.direccionPosgrado.tranferenciaB');
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/tranferenciaB/searchTransferencia/{year}/{criterio}', [TransferenciaDPController::class, "searchTransferenciaB"])->name('estimulos.evaluaciones.direccionPosgrado.tranferenciaB');
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/tranferenciaB/puntos/{id}/{objetivo}', [TransferenciaDPController::class, "puntosB"])->name('estimulos.evaluaciones.direccionPosgrado.tranferenciaB');
    Route::post('/estimulos/evaluaciones/DireccionPosgrado/tranferenciaB/saveDatos', [TransferenciaDPController::class, "saveDatosB"])->name('estimulos.evaluaciones.direccionPosgrado.tranferenciaB');
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/tranferenciaB/datosTransferenciaB/{year}/{criterio}', [TransferenciaDPController::class, "datosTransferenciaB"])->name('estimulos.evaluaciones.direccionPosgrado.tranferenciaB');

    /** Rutas para las evaluaciones de la direccion de Ciencia... */
    /** Rutas para las evaluaciones de estimulos Direccion de Ciencia->Difusion y divulgacion... */
    Route::get('/estimulos/evaluaciones/DireccionCiencia/DifDiv/listDifDIv', [DifusionDivulgacionDCController::class, "index"])->name('estimulos.evaluaciones.direccionCiencia.DivDif');
    Route::get('/estimulos/evaluaciones/DireccionCiencia/DifDiv/searchDifDIv/{year}', [DifusionDivulgacionDCController::class, "search"])->name('estimulos.evaluaciones.direccionCiencia.DivDif');
    Route::post('/estimulos/evaluaciones/DireccionCiencia/DifDiv/saveDatosDifDiv', [DifusionDivulgacionDCController::class, "saveDatos"])->name('estimulos.evaluaciones.direccionCiencia.DivDif');
    Route::get('/estimulos/evaluaciones/DireccionCiencia/DifDiv/datosDifDiv/{year}/{criterio}', [DifusionDivulgacionDCController::class, "datosDifDiv"])->name('estimulos.evaluaciones.direccionCiencia.DivDif');
    Route::get('/estimulos/evaluaciones/DireccionCiencia/DifDiv/searchEvidenciasDifDiv/{year}/{clave}', [DifusionDivulgacionDCController::class, "searchEvidencias"])->name('estimulos.evaluaciones.direccionCiencia.DivDif');
    Route::get('/estimulos/evaluaciones/DireccionCiencia/DifDiv/getEvidenciasDifDiv/{clave}/{year}/{criterio}', [DifusionDivulgacionDCController::class, "getEvidenciasGeneral"])->name('estimulos.evaluaciones.direccionCiencia.DivDif');
    Route::get('/estimulos/evaluaciones/DireccionCiencia/DifDiv/obtenerEvidenciasDifDiv/{clave}/{year}/{criterio}', [DifusionDivulgacionDCController::class, "obtenerEvidenciasGeneral"])->name('estimulos.evaluaciones.direccionCiencia.DivDif');
    Route::get('/estimulos/evaluaciones/DireccionCiencia/DifDiv/puntosDifDiv/{id}/{objetivo}', [DifusionDivulgacionDCController::class, "puntos"])->name('estimulos.evaluaciones.direccionCiencia.DivDif');
    Route::post('/estimulos/evaluaciones/DireccionCiencia/DifDiv/savePuntos', [DifusionDivulgacionDCController::class, "savePuntos"])->name('estimulos.evaluaciones.direccionCiencia.DivDif');
    Route::put('/estimulos/evaluaciones/DireccionCiencia/DifDiv/updateDatosDifDiv', [DifusionDivulgacionDCController::class, "updateDatosGeneral"])->name('estimulos.evaluaciones.direccionCiencia.DivDif');
    Route::put('/estimulos/evaluaciones/DireccionCiencia/DifDiv/updateDatosPuntos', [DifusionDivulgacionDCController::class, "updateDatosPuntos"])->name('estimulos.evaluaciones.direccionCiencia.DivDif');
    /** Rutas para las evaluaciones de estimulos Direccion de ciencia->Posgrado... */
    Route::get('/estimulos/evaluaciones/DireccionCiencia/posgrado/listPosgrado', [PosgradoDCController::class, "index"])->name('estimulos.evaluaciones.direccionCiencia.posgrado');
    Route::get('/estimulos/evaluaciones/DireccionCiencia/posgrado/searchPosgrado/{year}/{criterio}', [PosgradoDCController::class, "search"])->name('estimulos.evaluaciones.direccionCiencia.posgrado');
    Route::get('/estimulos/evaluaciones/DireccionCiencia/posgrado/searchUsernamePosgrado/{clave}', [PosgradoDCController::class, "searchUsername"])->name('estimulos.evaluaciones.direccionCiencia.posgrado');
    Route::post('/estimulos/evaluaciones/DireccionCiencia/posgrado/saveDatosPosgrado', [PosgradoDCController::class, "saveDatos"])->name('estimulos.evaluaciones.direccionCiencia.posgrado');
    Route::get('/estimulos/evaluaciones/DireccionCiencia/posgrado/datosposgrado/{year}/{criterio}', [PosgradoDCController::class, "datosPosgrado"])->name('estimulos.evaluaciones.direccionCiencia.posgrado');
    Route::get('/estimulos/evaluaciones/DireccionCiencia/posgrado/searchEvidenciasPosgrado/{year}/{clave}/{criterio}', [PosgradoDCController::class, "searchEvidencias"])->name('estimulos.evaluaciones.direccionCiencia.posgrado');
    Route::get('/estimulos/evaluaciones/DireccionCiencia/posgrado/puntosPosgrado/{id}/{objetivo}', [PosgradoDCController::class, "puntos"])->name('estimulos.evaluaciones.direccionCiencia.posgrado');
    Route::get('/estimulos/evaluaciones/DireccionCiencia/posgrado/getEvidenciasPosgrado/{clave}/{year}/{criterio}', [PosgradoDCController::class, "getEvidencias"])->name('estimulos.evaluaciones.direccionCiencia.posgrado');
    Route::get('/estimulos/evaluaciones/DireccionCiencia/posgrado/obtenerEvidenciasPosgrado/{clave}/{year}/{criterio}', [PosgradoDCController::class, "obtenerEvidencias"])->name('estimulos.evaluaciones.direccionCiencia.posgrado');
    Route::post('/estimulos/evaluaciones/DireccionCiencia/posgrado/savePuntos', [PosgradoDCController::class, "savePuntos"])->name('estimulos.evaluaciones.direccionCiencia.posgrado');
    Route::put('/estimulos/evaluaciones/DireccionCiencia/posgrado/updateDatosPosgrado', [PosgradoDCController::class, "updateDatos"])->name('estimulos.evaluaciones.direccionCiencia.posgrado');
    Route::put('/estimulos/evaluaciones/DireccionCiencia/posgrado/updateDatosPuntos', [PosgradoDCController::class, "updateDatosPuntos"])->name('estimulos.evaluaciones.direccionCiencia.posgrado');
    /** Rutas para las evaluaciones de estimulos Direccion de ciencia->Investigacion Cientifica... */
    Route::get('/estimulos/evaluaciones/DireccionCiencia/investigacion/listInvestigacion', [InvestigacionDCController::class, "index"])->name('estimulos.evaluaciones.direccionCiencia.investigacion');
    Route::get('/estimulos/evaluaciones/DireccionCiencia/investigacion/searchInvestigacion/{year}/{criterio}', [InvestigacionDCController::class, "search"])->name('estimulos.evaluaciones.direccionCiencia.investigacion');
    Route::post('/estimulos/evaluaciones/DireccionCiencia/investigacion/saveDatosInvestigacion', [InvestigacionDCController::class, "saveDatos"])->name('estimulos.evaluaciones.direccionCiencia.investigacion');
    Route::get('/estimulos/evaluaciones/DireccionCiencia/investigacion/datosInvestigacion/{year}/{criterio}', [InvestigacionDCController::class, "datosInvestigacion"])->name('estimulos.evaluaciones.direccionCiencia.investigacion');
    Route::get('/estimulos/evaluaciones/DireccionCiencia/investigacion/searchEvidenciasInvestigacion/{year}/{clave}/{criterio}', [InvestigacionDCController::class, "searchEvidencias"])->name('estimulos.evaluaciones.direccionCiencia.investigacion');
    Route::get('/estimulos/evaluaciones/DireccionCiencia/investigacion/obtenerEvidenciasInvestigacion/{clave}/{year}/{criterio}', [InvestigacionDCController::class, "obtenerEvidencias"])->name('estimulos.evaluaciones.direccionCiencia.investigacion');
    Route::get('/estimulos/evaluaciones/DireccionCiencia/investigacion/puntosinvestigacion/{id}/{objetivo}', [InvestigacionDCController::class, "puntos"])->name('estimulos.evaluaciones.direccionCiencia.investigacion');
    Route::post('/estimulos/evaluaciones/DireccionCiencia/investigacion/savePuntos', [InvestigacionDCController::class, "savePuntos"])->name('estimulos.evaluaciones.direccionCiencia.investigacion');
    Route::get('/estimulos/evaluaciones/DireccionCiencia/investigacion/getEvidenciasInvestigacion/{clave}/{year}/{criterio}', [InvestigacionDCController::class, "getEvidencias"])->name('estimulos.evaluaciones.direccionCiencia.investigacion');
    Route::put('/estimulos/evaluaciones/DireccionCiencia/investigacion/updateDatos', [InvestigacionDCController::class, "updateDatos"])->name('estimulos.evaluaciones.direccionCiencia.investigacion');
    Route::put('/estimulos/evaluaciones/DireccionCiencia/investigacion/updateDatosPuntos', [InvestigacionDCController::class, "updateDatosPuntos"])->name('estimulos.evaluaciones.direccionCiencia.investigacion');
    /** Rutas para las evaluaciones de estimulos Direccion de ciencia->Sostentabilidad */
    Route::get('/estimulos/evaluaciones/DireccionCiencia/sostentabilidad/listSostentabilidad', [SostenibilidadDCController::class, "index"])->name('estimulos.evaluaciones.direccionCiencia.sostentabilidad');
    Route::get('/estimulos/evaluaciones/DireccionCiencia/sostentabilidad/searchSostentabilidad/{year}', [SostenibilidadDCController::class, "searchSostentabilidad"])->name('estimulos.evaluaciones.direccionCiencia.sostentabilidad');
    Route::post('/estimulos/evaluaciones/DireccionCiencia/sostentabilidad/saveDatosSostentabilidad', [SostenibilidadDCController::class, "saveDatos"])->name('estimulos.evaluaciones.direccionCiencia.sostentabilidad');
    Route::get('/estimulos/evaluaciones/DireccionCiencia/sostentabilidad/datosSostentabilidad/{year}/{criterio}', [SostenibilidadDCController::class, "datosSostentabilidad"])->name('estimulos.evaluaciones.direccionCiencia.sostentabilidad');
    /** Rutas para ls evaluaciones de estimulos Dirección de ciencia->Transferencia de conocimiento e innovación */
    Route::get('/estimulos/evaluaciones/DireccionCiencia/transferencia/listTransferencia', [TransferenciaDCController::class, "index"])->name('estimulos.evaluaciones.direccionCiencia.transferencia');
    Route::get('/estimulos/evaluaciones/DireccionCiencia/transferencia/searchTransferencia/{year}/{criterio}', [TransferenciaDCController::class, "search"])->name('estimulos.evaluaciones.direccionCiencia.transferencia');
    Route::post('/estimulos/evaluaciones/DireccionCiencia/transferencia/saveDatosTransferencia', [TransferenciaDCController::class, "saveDatos"])->name('estimulos.evaluaciones.direccionCiencia.transferencia');
    Route::get('/estimulos/evaluaciones/DireccionCiencia/transferencia/datosTransferencia/{year}/{criterio}', [TransferenciaDCController::class, "datosTransferencia"])->name('estimulos.evaluaciones.direccionCiencia.transferencia');
    Route::get('/estimulos/evaluaciones/DireccionCiencia/transferencia/searchEvidenciasTransferencia/{year}/{clave}/{criterio}', [TransferenciaDCController::class, "searchEvidencias"])->name('estimulos.evaluaciones.direccionCiencia.transferencia');
    Route::get('/estimulos/evaluaciones/DireccionCiencia/transferencia/getEvidenciasTransferencia/{clave}/{year}/{criterio}', [TransferenciaDCController::class, "getEvidencias"])->name('estimulos.evaluaciones.direccionCiencia.transferencia');
    Route::get('/estimulos/evaluaciones/DireccionCiencia/transferencia/obtenerEvidenciasTransferencia/{clave}/{year}/{criterio}', [TransferenciaDCController::class, "obtenerEvidencias"])->name('estimulos.evaluaciones.direccionCiencia.transferencia');
    Route::get('/estimulos/evaluaciones/DireccionCiencia/transferencia/puntosTransferencia/{id}/{objetivo}', [TransferenciaDCController::class, "puntos"])->name('estimulos.evaluaciones.direccionCiencia.transferencia');
    Route::post('/estimulos/evaluaciones/DireccionCiencia/transferencia/savePuntos', [TransferenciaDCController::class, "savePuntos"])->name('estimulos.evaluaciones.direccionCiencia.transferencia');
    Route::put('/estimulos/evaluaciones/DireccionCiencia/transferencia/updateDatosTransferencia', [TransferenciaDCController::class, "updateDatos"])->name('estimulos.evaluaciones.direccionCiencia.transferencia');
    Route::put('/estimulos/evaluaciones/DireccionCiencia/transferencia/updateDatosPuntos', [TransferenciaDCController::class, "updateDatosPuntos"])->name('estimulos.evaluaciones.direccionCiencia.transferencia');
    /** Rutas para las evidencias de estimulos Dirección de ciencia->Formación de recursos humanos */
    Route::get('/estimulos/evaluaciones/DireccionCiencia/formacionRH/listFormacionRH', [FormacionRHDCController::class, "index"])->name('estimulos.evaluaciones.direccionCiencia.formacionRH');
    Route::get('/estimulos/evaluaciones/DireccionCiencia/formacionRH/searchFormacionRH/{year}/{criterio}', [FormacionRHDCController::class, "search"])->name('estimulos.evaluaciones.direccionCiencia.formacionRH');
    Route::post('/estimulos/evaluaciones/DireccionCiencia/formacionRH/saveDatosFormacionRH', [FormacionRHDCController::class, "saveDatos"])->name('estimulos.evaluaciones.direccionCiencia.formacionRH');
    Route::get('/estimulos/evaluaciones/DireccionCiencia/formacionRH/datosFormacionRH/{year}/{criterio}', [FormacionRHDCController::class, "datosFormacionRH"])->name('estimulos.evaluaciones.direccionCiencia.formacionRH');
    Route::get('/estimulos/evaluaciones/DireccionCiencia/formacionRH/searchEvidenciasFormacionRH/{year}/{clave}/{criterio}', [FormacionRHDCController::class, "searchEvidencias"])->name('estimulos.evaluaciones.direccionCiencia.formacionRH');
    Route::get('/estimulos/evaluaciones/DireccionCiencia/formacionRH/searchUsernameFormacionRH/{clave}', [FormacionRHDCController::class, "searchUsername"])->name('estimulos.evaluaciones.direccionCiencia.formacionRH');
    Route::get('/estimulos/evaluaciones/DireccionCiencia/formacionRH/puntosFormacionRH/{id}/{objetivo}', [FormacionRHDCController::class, "puntos"])->name('estimulos.evaluaciones.direccionCiencia.formacionRH');
    Route::get('/estimulos/evaluaciones/DireccionCiencia/formacionRH/obtenerEvidenciasFormacionRH/{clave}/{year}/{criterio}', [FormacionRHDCController::class, "obtenerEvidencias"])->name('estimulos.evaluaciones.direccionCiencia.formacionRH');
    Route::get('/estimulos/evaluaciones/DireccionCiencia/formacionRH/getEvidenciasFormacionRH/{clave}/{year}/{criterio}', [FormacionRHDCController::class, "getEvidencias"])->name('estimulos.evaluaciones.direccionCiencia.formacionRH');
    Route::post('/estimulos/evaluaciones/DireccionCiencia/formacionRH/savePuntos', [FormacionRHDCController::class, "savePuntos"])->name('estimulos.evaluaciones.direccionCiencia.formacionRH');
    Route::put('/estimulos/evaluaciones/DireccionCiencia/formacionRH/updateDatosFormacionRH', [FormacionRHDCController::class, "updateDatos"])->name('estimulos.evaluaciones.direccionCiencia.formacionRH');
    Route::put('/estimulos/evaluaciones/DireccionCiencia/formacionRH/updateDatosPuntos', [FormacionRHDCController::class, "updateDatosPuntos"])->name('estimulos.evaluaciones.direccionCiencia.formacionRH');
    /** Rutas para las evidencias de estimulos Dirección de ciencia->Colaboracion institucional */
    Route::get('/estimulos/evaluaciones/DireccionCiencia/colaboracion/listColaboracion', [ColaboracionDCController::class, "index"])->name('estimulos.evaluaciones.direccionCiencia.colaboracion');
    Route::get('/estimulos/evaluaciones/DireccionCiencia/colaboracion/searchColaboradores/{year}', [ColaboracionDCController::class, "searchColaboradores"])->name('estimulos.evaluaciones.direccionCiencia.colaboracion');
    Route::post('/estimulos/evaluaciones/DireccionCiencia/colaboracion/saveDatos', [ColaboracionDCController::class, "saveDatos"])->name('estimulos.evaluaciones.direccionCiencia.colaboracion');
    Route::get('/estimulos/evaluaciones/DireccionCiencia/colaboracion/datosColaboradores/{year}/{criterio}', [ColaboracionDCController::class, "datosColaboradores"])->name('estimulos.evaluaciones.direccionCiencia.colaboracion');
    /** Rutas para las evidencias de estimulos Dirección de ciencia->Acreditaciones */
    Route::get('/estimulos/evaluaciones/DireccionCiencia/acreditaciones/listAcreditaciones', [AcreditacionesDCController::class, "index"])->name('estimulos.evaluaciones.direccionCiencia.acreditaciones');
    Route::get('/estimulos/evaluaciones/DireccionCiencia/acreditaciones/searchAcreditaciones/{year}/{criterio}', [AcreditacionesDCController::class, "searchAcreditaciones"])->name('estimulos.evaluaciones.direccionCiencia.acreditaciones');
    Route::get('/estimulos/evaluaciones/DireccionCiencia/acreditaciones/searchUsername/{clave}', [AcreditacionesDCController::class, "searchUsername"])->name('estimulos.evaluaciones.direccionCiencia.acreditaciones');
    Route::post('/estimulos/evaluaciones/DireccionCiencia/acreditaciones/saveDatosAcreditaciones', [AcreditacionesDCController::class, "saveDatos"])->name('estimulos.evaluaciones.direccionCiencia.acreditaciones');
    Route::get('/estimulos/evaluaciones/DireccionCiencia/acreditaciones/datosAcreditaciones/{year}/{criterio}', [AcreditacionesDCController::class, "datosAcreditaciones"])->name('estimulos.evaluaciones.direccionCiencia.acreditaciones');
    Route::get('/estimulos/evaluaciones/DireccionCiencia/acreditaciones/searchEvidencias/{year}/{clave}/{criterio}', [AcreditacionesDCController::class, "searchEvidencias"])->name('estimulos.evaluaciones.direccionCiencia.acreditaciones');
    Route::get('/estimulos/evaluaciones/DireccionCiencia/acreditaciones/puntos/{id}/{objetivo}', [AcreditacionesDCController::class, "puntos"])->name('estimulos.evaluaciones.direccionCiencia.acreditaciones');
    Route::get('/estimulos/evaluaciones/DireccionCiencia/acreditaciones/getEvidenciasAcreditaciones/{clave}/{year}/{criterio}', [AcreditacionesDCController::class, "getEvidencias"])->name('estimulos.evaluaciones.direccionCiencia.acreditaciones');
    Route::get('/estimulos/evaluaciones/DireccionCiencia/acreditaciones/obtenerEvidencias/{clave}/{year}/{criterio}', [AcreditacionesDCController::class, "obtenerEvidencias"])->name('estimulos.evaluaciones.direccionCiencia.acreditaciones');
    Route::post('/estimulos/evaluaciones/DireccionCiencia/acreditaciones/savePuntos', [AcreditacionesDCController::class, "savePuntos"])->name('estimulos.evaluaciones.direccionCiencia.acreditaciones');
    Route::put('/estimulos/evaluaciones/DireccionCiencia/acreditaciones/updateDatos', [AcreditacionesDCController::class, "updateDatos"])->name('estimulos.evaluaciones.direccionCiencia.acreditaciones');
    Route::put('/estimulos/evaluaciones/DireccionCiencia/acreditaciones/updateDatosPuntos', [AcreditacionesDCController::class, "updateDatosPuntos"])->name('estimulos.evaluaciones.direccionCiencia.acreditaciones');
    /** Rutas para las evidencias de estimulos Dirección de ciencia->Investigación cientifica tabla B */
    Route::get('/estimulos/evaluaciones/DireccionCiencia/investigacionB/listInvestigacionB', [InvestigacionDCController::class, "indexB"])->name('estimulos.evaluaciones.direccionCiencia.investigacionB');
    /** Rutas para las evidencias de estimulos Dirección de ciencia->Sostenibilidad economica tabla B */
    Route::get('/estimulos/evaluaciones/DireccionCiencia/sostenibilidadB/listSostenibilidadB', [SostenibilidadDCController::class, "indexB"])->name('estimulos.evaluaciones.direccionCiencia.sostenibilidadB');
    Route::get('/estimulos/evaluaciones/DireccionCiencia/sostenibilidadB/searchSostenibilidadB/{year}', [SostenibilidadDCController::class, "searchSostenibilidadB"])->name('estimulos.evaluaciones.direccionCiencia.sostenibilidadB');
    Route::post('/estimulos/evaluaciones/DireccionCiencia/sostenibilidadB/saveDatos', [SostenibilidadDCController::class, "saveDatosB"])->name('estimulos.evaluaciones.direccionCiencia.sostenibilidadB');
    Route::get('/estimulos/evaluaciones/DireccionCiencia/sostenibilidadB/puntos/{id}/{objetivo}', [SostenibilidadDCController::class, "puntosB"])->name('estimulos.evaluaciones.direccionCiencia.sostenibilidadB');
    Route::get('/estimulos/evaluaciones/DireccionCiencia/sostenibilidadB/datosSostenibilidadB/{year}/{criterio}', [SostenibilidadDCController::class, "datosSostenibilidadB"])->name('estimulos.evaluaciones.direccionCiencia.sostenibilidadB');
    /** Rutas para las evidencias de estimulos Dirección ciencia->Transferencia de conocimiento e innovacion tabla B */
    Route::get('/estimulos/evaluaciones/DireccionCiencia/tranferenciaB/listTransferencia', [TransferenciaDCController::class, "indexB"])->name('estimulos.evaluaciones.direccionCiencia.tranferenciaB');
    Route::get('/estimulos/evaluaciones/DireccionCiencia/tranferenciaB/searchTransferencia/{year}/{criterio}', [TransferenciaDCController::class, "searchTransferenciaB"])->name('estimulos.evaluaciones.direccionCiencia.tranferenciaB');
    Route::get('/estimulos/evaluaciones/DireccionCiencia/tranferenciaB/puntos/{id}/{objetivo}', [TransferenciaDCController::class, "puntosB"])->name('estimulos.evaluaciones.direccionCiencia.tranferenciaB');
    Route::post('/estimulos/evaluaciones/DireccionCiencia/tranferenciaB/saveDatos', [TransferenciaDCController::class, "saveDatosB"])->name('estimulos.evaluaciones.direccionCiencia.tranferenciaB');
    Route::get('/estimulos/evaluaciones/DireccionCiencia/tranferenciaB/datosTransferenciaB/{year}/{criterio}', [TransferenciaDCController::class, "datosTransferenciaB"])->name('estimulos.evaluaciones.direccionCiencia.tranferenciaB');

    /** Rutas para las evaluaciones de la direccion de servicios tecnologicos... */
    /** Rutas para las evaluaciones de estimulos Direccion de servicios tecnologicos->Difusion y divulgacion... */
    Route::get('/estimulos/evaluaciones/DireccionServTec/DifDiv/listDifDIv', [DifusionDivulgacionDSTController::class, "index"])->name('estimulos.evaluaciones.direccionServTec.DivDif');
    Route::get('/estimulos/evaluaciones/DireccionServTec/DifDiv/searchDifDIv/{year}', [DifusionDivulgacionDSTController::class, "search"])->name('estimulos.evaluaciones.direccionServTec.DivDif');
    Route::post('/estimulos/evaluaciones/DireccionServTec/DifDiv/saveDatosDifDiv', [DifusionDivulgacionDSTController::class, "saveDatos"])->name('estimulos.evaluaciones.direccionServTec.DivDif');
    Route::get('/estimulos/evaluaciones/DireccionServTec/DifDiv/datosDifDiv/{year}/{criterio}', [DifusionDivulgacionDSTController::class, "datosDifDiv"])->name('estimulos.evaluaciones.direccionServTec.DivDif');
    Route::get('/estimulos/evaluaciones/DireccionServTec/DifDiv/searchEvidenciasDifDiv/{year}/{clave}', [DifusionDivulgacionDSTController::class, "searchEvidencias"])->name('estimulos.evaluaciones.direccionServTec.DivDif');
    Route::get('/estimulos/evaluaciones/DireccionServTec/DifDiv/getEvidenciasDifDiv/{clave}/{year}/{criterio}', [DifusionDivulgacionDSTController::class, "getEvidenciasGeneral"])->name('estimulos.evaluaciones.direccionServTec.DivDif');
    Route::get('/estimulos/evaluaciones/DireccionServTec/DifDiv/obtenerEvidenciasDifDiv/{clave}/{year}/{criterio}', [DifusionDivulgacionDSTController::class, "obtenerEvidenciasGeneral"])->name('estimulos.evaluaciones.direccionServTec.DivDif');
    Route::get('/estimulos/evaluaciones/DireccionServTec/DifDiv/puntosDifDiv/{id}/{objetivo}', [DifusionDivulgacionDSTController::class, "puntos"])->name('estimulos.evaluaciones.direccionServTec.DivDif');
    Route::post('/estimulos/evaluaciones/DireccionServTec/DifDiv/savePuntos', [DifusionDivulgacionDSTController::class, "savePuntos"])->name('estimulos.evaluaciones.direccionServTec.DivDif');
    Route::put('/estimulos/evaluaciones/DireccionServTec/DifDiv/updateDatosDifDiv', [DifusionDivulgacionDSTController::class, "updateDatosGeneral"])->name('estimulos.evaluaciones.direccionServTec.DivDif');
    Route::put('/estimulos/evaluaciones/DireccionServTec/DifDiv/updateDatosPuntos', [DifusionDivulgacionDSTController::class, "updateDatosPuntos"])->name('estimulos.evaluaciones.direccionServTec.DivDif');
    /** Rutas para las evaluaciones de estimulos Direccion de servicios tecnologicos->Posgrado... */
    Route::get('/estimulos/evaluaciones/DireccionServTec/posgrado/listPosgrado', [PosgradoDSTController::class, "index"])->name('estimulos.evaluaciones.direccionServTec.posgrado');
    Route::get('/estimulos/evaluaciones/DireccionServTec/posgrado/searchPosgrado/{year}/{criterio}', [PosgradoDSTController::class, "search"])->name('estimulos.evaluaciones.direccionServTec.posgrado');
    Route::get('/estimulos/evaluaciones/DireccionServTec/posgrado/searchUsernamePosgrado/{clave}', [PosgradoDSTController::class, "searchUsername"])->name('estimulos.evaluaciones.direccionServTec.posgrado');
    Route::post('/estimulos/evaluaciones/DireccionServTec/posgrado/saveDatosPosgrado', [PosgradoDSTController::class, "saveDatos"])->name('estimulos.evaluaciones.direccionServTec.posgrado');
    Route::get('/estimulos/evaluaciones/DireccionServTec/posgrado/datosposgrado/{year}/{criterio}', [PosgradoDSTController::class, "datosPosgrado"])->name('estimulos.evaluaciones.direccionServTec.posgrado');
    Route::get('/estimulos/evaluaciones/DireccionServTec/posgrado/searchEvidenciasPosgrado/{year}/{clave}/{criterio}', [PosgradoDSTController::class, "searchEvidencias"])->name('estimulos.evaluaciones.direccionServTec.posgrado');
    Route::get('/estimulos/evaluaciones/DireccionServTec/posgrado/puntosPosgrado/{id}/{objetivo}', [PosgradoDSTController::class, "puntos"])->name('estimulos.evaluaciones.direccionServTec.posgrado');
    Route::get('/estimulos/evaluaciones/DireccionServTec/posgrado/getEvidenciasPosgrado/{clave}/{year}/{criterio}', [PosgradoDSTController::class, "getEvidencias"])->name('estimulos.evaluaciones.direccionServTec.posgrado');
    Route::get('/estimulos/evaluaciones/DireccionServTec/posgrado/obtenerEvidenciasPosgrado/{clave}/{year}/{criterio}', [PosgradoDSTController::class, "obtenerEvidencias"])->name('estimulos.evaluaciones.direccionServTec.posgrado');
    Route::post('/estimulos/evaluaciones/DireccionServTec/posgrado/savePuntos', [PosgradoDSTController::class, "savePuntos"])->name('estimulos.evaluaciones.direccionServTec.posgrado');
    Route::put('/estimulos/evaluaciones/DireccionServTec/posgrado/updateDatosPosgrado', [PosgradoDSTController::class, "updateDatos"])->name('estimulos.evaluaciones.direccionServTec.posgrado');
    Route::put('/estimulos/evaluaciones/DireccionServTec/posgrado/updateDatosPuntos', [PosgradoDSTController::class, "updateDatosPuntos"])->name('estimulos.evaluaciones.direccionServTec.posgrado');
    /** Rutas para las evaluaciones de estimulos Direccion de servicios tecnologicos->Investigacion Cientifica... */
    Route::get('/estimulos/evaluaciones/DireccionServTec/investigacion/listInvestigacion', [InvestigacionDSTController::class, "index"])->name('estimulos.evaluaciones.direccionServTec.investigacion');
    Route::get('/estimulos/evaluaciones/DireccionServTec/investigacion/searchInvestigacion/{year}/{criterio}', [InvestigacionDSTController::class, "search"])->name('estimulos.evaluaciones.direccionServTec.investigacion');
    Route::post('/estimulos/evaluaciones/DireccionServTec/investigacion/saveDatosInvestigacion', [InvestigacionDSTController::class, "saveDatos"])->name('estimulos.evaluaciones.direccionServTec.investigacion');
    Route::get('/estimulos/evaluaciones/DireccionServTec/investigacion/datosInvestigacion/{year}/{criterio}', [InvestigacionDSTController::class, "datosInvestigacion"])->name('estimulos.evaluaciones.direccionServTec.investigacion');
    Route::get('/estimulos/evaluaciones/DireccionServTec/investigacion/searchEvidenciasInvestigacion/{year}/{clave}/{criterio}', [InvestigacionDSTController::class, "searchEvidencias"])->name('estimulos.evaluaciones.direccionServTec.investigacion');
    Route::get('/estimulos/evaluaciones/DireccionServTec/investigacion/obtenerEvidenciasInvestigacion/{clave}/{year}/{criterio}', [InvestigacionDSTController::class, "obtenerEvidencias"])->name('estimulos.evaluaciones.direccionServTec.investigacion');
    Route::get('/estimulos/evaluaciones/DireccionServTec/investigacion/puntosinvestigacion/{id}/{objetivo}', [InvestigacionDSTController::class, "puntos"])->name('estimulos.evaluaciones.direccionServTec.investigacion');
    Route::post('/estimulos/evaluaciones/DireccionServTec/investigacion/savePuntos', [InvestigacionDSTController::class, "savePuntos"])->name('estimulos.evaluaciones.direccionServTec.investigacion');
    Route::get('/estimulos/evaluaciones/DireccionServTec/investigacion/getEvidenciasInvestigacion/{clave}/{year}/{criterio}', [InvestigacionDSTController::class, "getEvidencias"])->name('estimulos.evaluaciones.direccionServTec.investigacion');
    Route::put('/estimulos/evaluaciones/DireccionServTec/investigacion/updateDatos', [InvestigacionDSTController::class, "updateDatos"])->name('estimulos.evaluaciones.direccionServTec.investigacion');
    Route::put('/estimulos/evaluaciones/DireccionServTec/investigacion/updateDatosPuntos', [InvestigacionDSTController::class, "updateDatosPuntos"])->name('estimulos.evaluaciones.direccionServTec.investigacion');
    /** Rutas para las evaluaciones de estimulos Direccion de servicios tecnologicos->Sostentabilidad */
    Route::get('/estimulos/evaluaciones/DireccionServTec/sostentabilidad/listSostentabilidad', [SostenibilidadDSTController::class, "index"])->name('estimulos.evaluaciones.direccionServTec.sostentabilidad');
    Route::get('/estimulos/evaluaciones/DireccionServTec/sostentabilidad/searchSostentabilidad/{year}', [SostenibilidadDSTController::class, "searchSostentabilidad"])->name('estimulos.evaluaciones.direccionServTec.sostentabilidad');
    Route::post('/estimulos/evaluaciones/DireccionServTec/sostentabilidad/saveDatosSostentabilidad', [SostenibilidadDSTController::class, "saveDatos"])->name('estimulos.evaluaciones.direccionServTec.sostentabilidad');
    Route::get('/estimulos/evaluaciones/DireccionServTec/sostentabilidad/datosSostentabilidad/{year}/{criterio}', [SostenibilidadDSTController::class, "datosSostentabilidad"])->name('estimulos.evaluaciones.direccionServTec.sostentabilidad');
    /** Rutas para ls evaluaciones de estimulos Dirección de servicios tecnologicos->Transferencia de conocimiento e innovación */
    Route::get('/estimulos/evaluaciones/DireccionServTec/transferencia/listTransferencia', [TransferenciaDSTController::class, "index"])->name('estimulos.evaluaciones.direccionServTec.transferencia');
    Route::get('/estimulos/evaluaciones/DireccionServTec/transferencia/searchTransferencia/{year}/{criterio}', [TransferenciaDSTController::class, "search"])->name('estimulos.evaluaciones.direccionServTec.transferencia');
    Route::post('/estimulos/evaluaciones/DireccionServTec/transferencia/saveDatosTransferencia', [TransferenciaDSTController::class, "saveDatos"])->name('estimulos.evaluaciones.direccionServTec.transferencia');
    Route::get('/estimulos/evaluaciones/DireccionServTec/transferencia/datosTransferencia/{year}/{criterio}', [TransferenciaDSTController::class, "datosTransferencia"])->name('estimulos.evaluaciones.direccionServTec.transferencia');
    Route::get('/estimulos/evaluaciones/DireccionServTec/transferencia/searchEvidenciasTransferencia/{year}/{clave}/{criterio}', [TransferenciaDSTController::class, "searchEvidencias"])->name('estimulos.evaluaciones.direccionServTec.transferencia');
    Route::get('/estimulos/evaluaciones/DireccionServTec/transferencia/getEvidenciasTransferencia/{clave}/{year}/{criterio}', [TransferenciaDSTController::class, "getEvidencias"])->name('estimulos.evaluaciones.direccionServTec.transferencia');
    Route::get('/estimulos/evaluaciones/DireccionServTec/transferencia/obtenerEvidenciasTransferencia/{clave}/{year}/{criterio}', [TransferenciaDSTController::class, "obtenerEvidencias"])->name('estimulos.evaluaciones.direccionServTec.transferencia');
    Route::get('/estimulos/evaluaciones/DireccionServTec/transferencia/puntosTransferencia/{id}/{objetivo}', [TransferenciaDSTController::class, "puntos"])->name('estimulos.evaluaciones.direccionServTec.transferencia');
    Route::post('/estimulos/evaluaciones/DireccionServTec/transferencia/savePuntos', [TransferenciaDSTController::class, "savePuntos"])->name('estimulos.evaluaciones.direccionServTec.transferencia');
    Route::put('/estimulos/evaluaciones/DireccionServTec/transferencia/updateDatosTransferencia', [TransferenciaDSTController::class, "updateDatos"])->name('estimulos.evaluaciones.direccionServTec.transferencia');
    Route::put('/estimulos/evaluaciones/DireccionServTec/transferencia/updateDatosPuntos', [TransferenciaDSTController::class, "updateDatosPuntos"])->name('estimulos.evaluaciones.direccionServTec.transferencia');
    /** Rutas para las evidencias de estimulos Dirección de servicios->Formación de recursos humanos */
    Route::get('/estimulos/evaluaciones/DireccionServTec/formacionRH/listFormacionRH', [FormacionRHDSTController::class, "index"])->name('estimulos.evaluaciones.direccionServTec.formacionRH');
    Route::get('/estimulos/evaluaciones/DireccionServTec/formacionRH/searchFormacionRH/{year}/{criterio}', [FormacionRHDSTController::class, "search"])->name('estimulos.evaluaciones.direccionServTec.formacionRH');
    Route::get('/estimulos/evaluaciones/DireccionServTec/formacionRH/searchUsernameFormacionRH/{clave}', [FormacionRHDSTController::class, "searchUsername"])->name('estimulos.evaluaciones.direccionServTec.formacionRH');
    Route::post('/estimulos/evaluaciones/DireccionServTec/formacionRH/saveDatosFormacionRH', [FormacionRHDSTController::class, "saveDatos"])->name('estimulos.evaluaciones.direccionServTec.formacionRH');
    Route::get('/estimulos/evaluaciones/DireccionServTec/formacionRH/datosFormacionRH/{year}/{criterio}', [FormacionRHDSTController::class, "datosFormacionRH"])->name('estimulos.evaluaciones.direccionServTec.formacionRH');
    Route::get('/estimulos/evaluaciones/DireccionServTec/formacionRH/searchEvidenciasFormacionRH/{year}/{clave}/{criterio}', [FormacionRHDSTController::class, "searchEvidencias"])->name('estimulos.evaluaciones.direccionServTec.formacionRH');
    Route::get('/estimulos/evaluaciones/DireccionServTec/formacionRH/puntosFormacionRH/{id}/{objetivo}', [FormacionRHDSTController::class, "puntos"])->name('estimulos.evaluaciones.direccionServTec.formacionRH');
    Route::get('/estimulos/evaluaciones/DireccionServTec/formacionRH/obtenerEvidenciasFormacionRH/{clave}/{year}/{criterio}', [FormacionRHDSTController::class, "obtenerEvidencias"])->name('estimulos.evaluaciones.direccionServTec.formacionRH');
    Route::get('/estimulos/evaluaciones/DireccionServTec/formacionRH/getEvidenciasFormacionRH/{clave}/{year}/{criterio}', [FormacionRHDSTController::class, "getEvidencias"])->name('estimulos.evaluaciones.direccionServTec.formacionRH');
    Route::post('/estimulos/evaluaciones/DireccionServTec/formacionRH/savePuntos', [FormacionRHDSTController::class, "savePuntos"])->name('estimulos.evaluaciones.direccionServTec.formacionRH');
    Route::put('/estimulos/evaluaciones/DireccionServTec/formacionRH/updateDatosFormacionRH', [FormacionRHDSTController::class, "updateDatos"])->name('estimulos.evaluaciones.direccionServTec.formacionRH');
    Route::put('/estimulos/evaluaciones/DireccionServTec/formacionRH/updateDatosPuntos', [FormacionRHDSTController::class, "updateDatosPuntos"])->name('estimulos.evaluaciones.direccionServTec.formacionRH');
    /** Rutas para las evidencias de estimulos Dirección de servicios tecnologicos->Colaboracion institucional */
    Route::get('/estimulos/evaluaciones/DireccionServTec/colaboracion/listColaboracion', [ColaboracionDSTController::class, "index"])->name('estimulos.evaluaciones.direccionServTec.colaboracion');
    Route::get('/estimulos/evaluaciones/DireccionServTec/colaboracion/searchColaboradores/{year}', [ColaboracionDSTController::class, "searchColaboradores"])->name('estimulos.evaluaciones.direccionServTec.colaboracion');
    Route::post('/estimulos/evaluaciones/DireccionServTec/colaboracion/saveDatos', [ColaboracionDSTController::class, "saveDatos"])->name('estimulos.evaluaciones.direccionServTec.colaboracion');
    Route::get('/estimulos/evaluaciones/DireccionServTec/colaboracion/datosColaboradores/{year}/{criterio}', [ColaboracionDSTController::class, "datosColaboradores"])->name('estimulos.evaluaciones.direccionServTec.colaboracion');
    /** Rutas para las evidencias de estimulos Dirección servicios tecnologicos->Acreditaciones */
    Route::get('/estimulos/evaluaciones/DireccionServTec/acreditaciones/listAcreditaciones', [AcreditacionesDSTController::class, "index"])->name('estimulos.evaluaciones.direccionServTec.acreditaciones');
    Route::get('/estimulos/evaluaciones/DireccionServTec/acreditaciones/searchAcreditaciones/{year}/{criterio}', [AcreditacionesDSTController::class, "searchAcreditaciones"])->name('estimulos.evaluaciones.direccionServTec.acreditaciones');
    Route::get('/estimulos/evaluaciones/DireccionServTec/acreditaciones/searchUsername/{clave}', [AcreditacionesDSTController::class, "searchUsername"])->name('estimulos.evaluaciones.direccionServTec.acreditaciones');
    Route::post('/estimulos/evaluaciones/DireccionServTec/acreditaciones/saveDatosAcreditaciones', [AcreditacionesDSTController::class, "saveDatos"])->name('estimulos.evaluaciones.direccionServTec.acreditaciones');
    Route::get('/estimulos/evaluaciones/DireccionServTec/acreditaciones/datosAcreditaciones/{year}/{criterio}', [AcreditacionesDSTController::class, "datosAcreditaciones"])->name('estimulos.evaluaciones.direccionServTec.acreditaciones');
    Route::get('/estimulos/evaluaciones/DireccionServTec/acreditaciones/searchEvidencias/{year}/{clave}/{criterio}', [AcreditacionesDSTController::class, "searchEvidencias"])->name('estimulos.evaluaciones.direccionServTec.acreditaciones');
    Route::get('/estimulos/evaluaciones/DireccionServTec/acreditaciones/puntos/{id}/{objetivo}', [AcreditacionesDSTController::class, "puntos"])->name('estimulos.evaluaciones.direccionServTec.acreditaciones');
    Route::get('/estimulos/evaluaciones/DireccionServTec/acreditaciones/getEvidenciasAcreditaciones/{clave}/{year}/{criterio}', [AcreditacionesDSTController::class, "getEvidencias"])->name('estimulos.evaluaciones.direccionServTec.acreditaciones');
    Route::get('/estimulos/evaluaciones/DireccionServTec/acreditaciones/obtenerEvidencias/{clave}/{year}/{criterio}', [AcreditacionesDSTController::class, "obtenerEvidencias"])->name('estimulos.evaluaciones.direccionServTec.acreditaciones');
    Route::post('/estimulos/evaluaciones/DireccionServTec/acreditaciones/savePuntos', [AcreditacionesDSTController::class, "savePuntos"])->name('estimulos.evaluaciones.direccionServTec.acreditaciones');
    Route::put('/estimulos/evaluaciones/DireccionServTec/acreditaciones/updateDatos', [AcreditacionesDSTController::class, "updateDatos"])->name('estimulos.evaluaciones.direccionServTec.acreditaciones');
    Route::put('/estimulos/evaluaciones/DireccionServTec/acreditaciones/updateDatosPuntos', [AcreditacionesDSTController::class, "updateDatosPuntos"])->name('estimulos.evaluaciones.direccionServTec.acreditaciones');
    /** Rutas para las evidencias de estimulos Dirección de servicios tecnologicos->Investigación cientifica tabla B */
    Route::get('/estimulos/evaluaciones/DireccionServTec/investigacionB/listInvestigacionB', [InvestigacionDSTController::class, "indexB"])->name('estimulos.evaluaciones.direccionServTec.investigacionB');
    /** Rutas para las evidencias de estimulos Dirección de servicios->Sostenibilidad economica tabla B */
    Route::get('/estimulos/evaluaciones/DireccionServTec/sostenibilidadB/listSostenibilidadB', [SostenibilidadDSTController::class, "indexB"])->name('estimulos.evaluaciones.direccionServTec.sostenibilidadB');
    Route::get('/estimulos/evaluaciones/DireccionServTec/sostenibilidadB/searchSostenibilidadB/{year}', [SostenibilidadDSTController::class, "searchSostenibilidadB"])->name('estimulos.evaluaciones.direccionServTec.sostenibilidadB');
    Route::post('/estimulos/evaluaciones/DireccionServTec/sostenibilidadB/saveDatos', [SostenibilidadDSTController::class, "saveDatosB"])->name('estimulos.evaluaciones.direccionServTec.sostenibilidadB');
    Route::get('/estimulos/evaluaciones/DireccionServTec/sostenibilidadB/puntos/{id}/{objetivo}', [SostenibilidadDSTController::class, "puntosB"])->name('estimulos.evaluaciones.direccionServTec.sostenibilidadB');
    Route::get('/estimulos/evaluaciones/DireccionServTec/sostenibilidadB/datosSostenibilidadB/{year}/{criterio}', [SostenibilidadDSTController::class, "datosSostenibilidadB"])->name('estimulos.evaluaciones.direccionServTec.sostenibilidadB');
    /** Rutas para las evidencias de estimulos Dirección servicios tecnologicos->Transferencia de conocimiento e innovacion tabla B */
    Route::get('/estimulos/evaluaciones/DireccionServTec/tranferenciaB/listTransferencia', [TransferenciaDSTController::class, "indexB"])->name('estimulos.evaluaciones.direccionServTec.tranferenciaB');
    Route::get('/estimulos/evaluaciones/DireccionServTec/tranferenciaB/searchTransferencia/{year}/{criterio}', [TransferenciaDSTController::class, "searchTransferenciaB"])->name('estimulos.evaluaciones.direccionServTec.tranferenciaB');
    Route::get('/estimulos/evaluaciones/DireccionServTec/tranferenciaB/puntos/{id}/{objetivo}', [TransferenciaDSTController::class, "puntosB"])->name('estimulos.evaluaciones.direccionServTec.tranferenciaB');
    Route::post('/estimulos/evaluaciones/DireccionServTec/tranferenciaB/saveDatos', [TransferenciaDSTController::class, "saveDatosB"])->name('estimulos.evaluaciones.direccionServTec.tranferenciaB');
    Route::get('/estimulos/evaluaciones/DireccionServTec/tranferenciaB/datosTransferenciaB/{year}/{criterio}', [TransferenciaDSTController::class, "datosTransferenciaB"])->name('estimulos.evaluaciones.direccionServTec.tranferenciaB');

    /** Rutas para las evaluaciones de la direccion de proyectos tecnologicos... */
    /** Rutas para las evaluaciones de estimulos Direccion de proyectos tecnologicos->Difusion y divulgacion... */
    Route::get('/estimulos/evaluaciones/DireccionProyTec/DifDiv/listDifDIv', [DifusionDivulgacionDPTController::class, "index"])->name('estimulos.evaluaciones.direccionProyTec.DivDif');
    Route::get('/estimulos/evaluaciones/DireccionProyTec/DifDiv/searchDifDIv/{year}', [DifusionDivulgacionDPTController::class, "search"])->name('estimulos.evaluaciones.direccionProyTec.DivDif');
    Route::post('/estimulos/evaluaciones/DireccionProyTec/DifDiv/saveDatosDifDiv', [DifusionDivulgacionDPTController::class, "saveDatos"])->name('estimulos.evaluaciones.direccionProyTec.DivDif');
    Route::get('/estimulos/evaluaciones/DireccionProyTec/DifDiv/datosDifDiv/{year}/{criterio}', [DifusionDivulgacionDPTController::class, "datosDifDiv"])->name('estimulos.evaluaciones.direccionProyTec.DivDif');
    Route::get('/estimulos/evaluaciones/DireccionProyTec/DifDiv/searchEvidenciasDifDiv/{year}/{clave}', [DifusionDivulgacionDPTController::class, "searchEvidencias"])->name('estimulos.evaluaciones.direccionProyTec.DivDif');
    Route::get('/estimulos/evaluaciones/DireccionProyTec/DifDiv/getEvidenciasDifDiv/{clave}/{year}/{criterio}', [DifusionDivulgacionDPTController::class, "getEvidenciasGeneral"])->name('estimulos.evaluaciones.direccionProyTec.DivDif');
    Route::get('/estimulos/evaluaciones/DireccionProyTec/DifDiv/obtenerEvidenciasDifDiv/{clave}/{year}/{criterio}', [DifusionDivulgacionDPTController::class, "obtenerEvidenciasGeneral"])->name('estimulos.evaluaciones.direccionProyTec.DivDif');
    Route::get('/estimulos/evaluaciones/DireccionProyTec/DifDiv/puntosDifDiv/{id}/{objetivo}', [DifusionDivulgacionDPTController::class, "puntos"])->name('estimulos.evaluaciones.direccionProyTec.DivDif');
    Route::post('/estimulos/evaluaciones/DireccionProyTec/DifDiv/savePuntos', [DifusionDivulgacionDPTController::class, "savePuntos"])->name('estimulos.evaluaciones.direccionProyTec.DivDif');
    Route::put('/estimulos/evaluaciones/DireccionProyTec/DifDiv/updateDatosDifDiv', [DifusionDivulgacionDPTController::class, "updateDatosGeneral"])->name('estimulos.evaluaciones.direccionProyTec.DivDif');
    Route::put('/estimulos/evaluaciones/DireccionProyTec/DifDiv/updateDatosPuntos', [DifusionDivulgacionDPTController::class, "updateDatosPuntos"])->name('estimulos.evaluaciones.direccionProyTec.DivDif');
    /** Rutas para las evaluaciones de estimulos Direccion de servicios tecnologicos->Posgrado... */
    Route::get('/estimulos/evaluaciones/DireccionProyTec/posgrado/listPosgrado', [PosgradoDPTController::class, "index"])->name('estimulos.evaluaciones.direccionProyTec.posgrado');
    Route::get('/estimulos/evaluaciones/DireccionProyTec/posgrado/searchPosgrado/{year}/{criterio}', [PosgradoDPTController::class, "search"])->name('estimulos.evaluaciones.direccionProyTec.posgrado');
    Route::get('/estimulos/evaluaciones/DireccionProyTec/posgrado/searchUsernamePosgrado/{clave}', [PosgradoDPTController::class, "searchUsername"])->name('estimulos.evaluaciones.direccionProyTec.posgrado');
    Route::post('/estimulos/evaluaciones/DireccionProyTec/posgrado/saveDatosPosgrado', [PosgradoDPTController::class, "saveDatos"])->name('estimulos.evaluaciones.direccionProyTec.posgrado');
    Route::get('/estimulos/evaluaciones/DireccionProyTec/posgrado/datosposgrado/{year}/{criterio}', [PosgradoDPTController::class, "datosPosgrado"])->name('estimulos.evaluaciones.direccionProyTec.posgrado');
    Route::get('/estimulos/evaluaciones/DireccionProyTec/posgrado/searchEvidenciasPosgrado/{year}/{clave}/{criterio}', [PosgradoDPTController::class, "searchEvidencias"])->name('estimulos.evaluaciones.direccionProyTec.posgrado');
    Route::get('/estimulos/evaluaciones/DireccionProyTec/posgrado/puntosPosgrado/{id}/{objetivo}', [PosgradoDPTController::class, "puntos"])->name('estimulos.evaluaciones.direccionProyTec.posgrado');
    Route::get('/estimulos/evaluaciones/DireccionProyTec/posgrado/getEvidenciasPosgrado/{clave}/{year}/{criterio}', [PosgradoDPTController::class, "getEvidencias"])->name('estimulos.evaluaciones.direccionProyTec.posgrado');
    Route::get('/estimulos/evaluaciones/DireccionProyTec/posgrado/obtenerEvidenciasPosgrado/{clave}/{year}/{criterio}', [PosgradoDPTController::class, "obtenerEvidencias"])->name('estimulos.evaluaciones.direccionProyTec.posgrado');
    Route::post('/estimulos/evaluaciones/DireccionProyTec/posgrado/savePuntos', [PosgradoDPTController::class, "savePuntos"])->name('estimulos.evaluaciones.direccionProyTec.posgrado');
    Route::put('/estimulos/evaluaciones/DireccionProyTec/posgrado/updateDatosPosgrado', [PosgradoDPTController::class, "updateDatos"])->name('estimulos.evaluaciones.direccionProyTec.posgrado');
    Route::put('/estimulos/evaluaciones/DireccionProyTec/posgrado/updateDatosPuntos', [PosgradoDPTController::class, "updateDatosPuntos"])->name('estimulos.evaluaciones.direccionProyTec.posgrado');
    /** Rutas para las evaluaciones de estimulos Direccion de proyectos tecnologicos->Investigacion Cientifica... */
    Route::get('/estimulos/evaluaciones/DireccionProyTec/investigacion/listInvestigacion', [InvestigacionDPTController::class, "index"])->name('estimulos.evaluaciones.direccionProyTec.investigacion');
    Route::get('/estimulos/evaluaciones/DireccionProyTec/investigacion/searchInvestigacion/{year}/{criterio}', [InvestigacionDPTController::class, "search"])->name('estimulos.evaluaciones.direccionProyTec.investigacion');
    Route::post('/estimulos/evaluaciones/DireccionProyTec/investigacion/saveDatosInvestigacion', [InvestigacionDPTController::class, "saveDatos"])->name('estimulos.evaluaciones.direccionProyTec.investigacion');
    Route::get('/estimulos/evaluaciones/DireccionProyTec/investigacion/datosInvestigacion/{year}/{criterio}', [InvestigacionDPTController::class, "datosInvestigacion"])->name('estimulos.evaluaciones.direccionProyTec.investigacion');
    Route::get('/estimulos/evaluaciones/DireccionProyTec/investigacion/searchEvidenciasInvestigacion/{year}/{clave}/{criterio}', [InvestigacionDPTController::class, "searchEvidencias"])->name('estimulos.evaluaciones.direccionProyTec.investigacion');
    Route::get('/estimulos/evaluaciones/DireccionProyTec/investigacion/obtenerEvidenciasInvestigacion/{clave}/{year}/{criterio}', [InvestigacionDPTController::class, "obtenerEvidencias"])->name('estimulos.evaluaciones.direccionProyTec.investigacion');
    Route::get('/estimulos/evaluaciones/DireccionProyTec/investigacion/puntosinvestigacion/{id}/{objetivo}', [InvestigacionDPTController::class, "puntos"])->name('estimulos.evaluaciones.direccionProyTec.investigacion');
    Route::post('/estimulos/evaluaciones/DireccionProyTec/investigacion/savePuntos', [InvestigacionDPTController::class, "savePuntos"])->name('estimulos.evaluaciones.direccionProyTec.investigacion');
    Route::get('/estimulos/evaluaciones/DireccionProyTec/investigacion/getEvidenciasInvestigacion/{clave}/{year}/{criterio}', [InvestigacionDPTController::class, "getEvidencias"])->name('estimulos.evaluaciones.direccionProyTec.investigacion');
    Route::put('/estimulos/evaluaciones/DireccionProyTec/investigacion/updateDatos', [InvestigacionDPTController::class, "updateDatos"])->name('estimulos.evaluaciones.direccionProyTec.investigacion');
    Route::put('/estimulos/evaluaciones/DireccionProyTec/investigacion/updateDatosPuntos', [InvestigacionDPTController::class, "updateDatosPuntos"])->name('estimulos.evaluaciones.direccionProyTec.investigacion');
    /** Rutas para las evaluaciones de estimulos Direccion de proyectos tecnologicos tecnologicos->Sostentabilidad */
    Route::get('/estimulos/evaluaciones/DireccionProyTec/sostentabilidad/listSostentabilidad', [SostenibilidadDPTController::class, "index"])->name('estimulos.evaluaciones.direccionProyTec.sostentabilidad');
    Route::get('/estimulos/evaluaciones/DireccionProyTec/sostentabilidad/searchSostentabilidad/{year}', [SostenibilidadDPTController::class, "searchSostentabilidad"])->name('estimulos.evaluaciones.direccionProyTec.sostentabilidad');
    Route::post('/estimulos/evaluaciones/DireccionProyTec/sostentabilidad/saveDatosSostentabilidad', [SostenibilidadDPTController::class, "saveDatos"])->name('estimulos.evaluaciones.direccionProyTec.sostentabilidad');
    Route::get('/estimulos/evaluaciones/DireccionProyTec/sostentabilidad/datosSostentabilidad/{year}/{criterio}', [SostenibilidadDPTController::class, "datosSostentabilidad"])->name('estimulos.evaluaciones.direccionProyTec.sostentabilidad');
    /** Rutas para ls evaluaciones de estimulos Dirección de proyectos tecnologicos tecnologicos->Transferencia de conocimiento e innovación */
    Route::get('/estimulos/evaluaciones/DireccionProyTec/transferencia/listTransferencia', [TransferenciaDPTController::class, "index"])->name('estimulos.evaluaciones.direccionProyTec.transferencia');
    Route::get('/estimulos/evaluaciones/DireccionProyTec/transferencia/searchTransferencia/{year}/{criterio}', [TransferenciaDPTController::class, "search"])->name('estimulos.evaluaciones.direccionProyTec.transferencia');
    Route::post('/estimulos/evaluaciones/DireccionProyTec/transferencia/saveDatosTransferencia', [TransferenciaDPTController::class, "saveDatos"])->name('estimulos.evaluaciones.direccionProyTec.transferencia');
    Route::get('/estimulos/evaluaciones/DireccionProyTec/transferencia/datosTransferencia/{year}/{criterio}', [TransferenciaDPTController::class, "datosTransferencia"])->name('estimulos.evaluaciones.direccionProyTec.transferencia');
    Route::get('/estimulos/evaluaciones/DireccionProyTec/transferencia/searchEvidenciasTransferencia/{year}/{clave}/{criterio}', [TransferenciaDPTController::class, "searchEvidencias"])->name('estimulos.evaluaciones.direccionProyTec.transferencia');
    Route::get('/estimulos/evaluaciones/DireccionProyTec/transferencia/getEvidenciasTransferencia/{clave}/{year}/{criterio}', [TransferenciaDPTController::class, "getEvidencias"])->name('estimulos.evaluaciones.direccionProyTec.transferencia');
    Route::get('/estimulos/evaluaciones/DireccionProyTec/transferencia/obtenerEvidenciasTransferencia/{clave}/{year}/{criterio}', [TransferenciaDPTController::class, "obtenerEvidencias"])->name('estimulos.evaluaciones.direccionProyTec.transferencia');
    Route::get('/estimulos/evaluaciones/DireccionProyTec/transferencia/puntosTransferencia/{id}/{objetivo}', [TransferenciaDPTController::class, "puntos"])->name('estimulos.evaluaciones.direccionProyTec.transferencia');
    Route::post('/estimulos/evaluaciones/DireccionProyTec/transferencia/savePuntos', [TransferenciaDPTController::class, "savePuntos"])->name('estimulos.evaluaciones.direccionProyTec.transferencia');
    Route::put('/estimulos/evaluaciones/DireccionProyTec/transferencia/updateDatosTransferencia', [TransferenciaDPTController::class, "updateDatos"])->name('estimulos.evaluaciones.direccionProyTec.transferencia');
    Route::put('/estimulos/evaluaciones/DireccionProyTec/transferencia/updateDatosPuntos', [TransferenciaDPTController::class, "updateDatosPuntos"])->name('estimulos.evaluaciones.direccionProyTec.transferencia');
    /** Rutas para las evidencias de estimulos Dirección de proyectos tecnologicos->Formación de recursos humanos */
    Route::get('/estimulos/evaluaciones/DireccionProyTec/formacionRH/listFormacionRH', [FormacionRHDPTController::class, "index"])->name('estimulos.evaluaciones.direccionProyTec.formacionRH');
    Route::get('/estimulos/evaluaciones/DireccionProyTec/formacionRH/searchFormacionRH/{year}/{criterio}', [FormacionRHDPTController::class, "search"])->name('estimulos.evaluaciones.direccionProyTec.formacionRH');
    Route::get('/estimulos/evaluaciones/DireccionProyTec/formacionRH/searchUsernameFormacionRH/{clave}', [FormacionRHDPTController::class, "searchUsername"])->name('estimulos.evaluaciones.direccionProyTec.formacionRH');
    Route::post('/estimulos/evaluaciones/DireccionProyTec/formacionRH/saveDatosFormacionRH', [FormacionRHDPTController::class, "saveDatos"])->name('estimulos.evaluaciones.direccionProyTec.formacionRH');
    Route::get('/estimulos/evaluaciones/DireccionProyTec/formacionRH/datosFormacionRH/{year}/{criterio}', [FormacionRHDPTController::class, "datosFormacionRH"])->name('estimulos.evaluaciones.direccionProyTec.formacionRH');
    Route::get('/estimulos/evaluaciones/DireccionProyTec/formacionRH/searchEvidenciasFormacionRH/{year}/{clave}/{criterio}', [FormacionRHDPTController::class, "searchEvidencias"])->name('estimulos.evaluaciones.direccionProyTec.formacionRH');
    Route::get('/estimulos/evaluaciones/DireccionProyTec/formacionRH/puntosFormacionRH/{id}/{objetivo}', [FormacionRHDPTController::class, "puntos"])->name('estimulos.evaluaciones.direccionProyTec.formacionRH');
    Route::get('/estimulos/evaluaciones/DireccionProyTec/formacionRH/obtenerEvidenciasFormacionRH/{clave}/{year}/{criterio}', [FormacionRHDPTController::class, "obtenerEvidencias"])->name('estimulos.evaluaciones.direccionProyTec.formacionRH');
    Route::get('/estimulos/evaluaciones/DireccionProyTec/formacionRH/getEvidenciasFormacionRH/{clave}/{year}/{criterio}', [FormacionRHDPTController::class, "getEvidencias"])->name('estimulos.evaluaciones.direccionProyTec.formacionRH');
    Route::post('/estimulos/evaluaciones/DireccionProyTec/formacionRH/savePuntos', [FormacionRHDPTController::class, "savePuntos"])->name('estimulos.evaluaciones.direccionProyTec.formacionRH');
    Route::put('/estimulos/evaluaciones/DireccionProyTec/formacionRH/updateDatosFormacionRH', [FormacionRHDPTController::class, "updateDatos"])->name('estimulos.evaluaciones.direccionProyTec.formacionRH');
    Route::put('/estimulos/evaluaciones/DireccionProyTec/formacionRH/updateDatosPuntos', [FormacionRHDPTController::class, "updateDatosPuntos"])->name('estimulos.evaluaciones.direccionProyTec.formacionRH');
    /** Rutas para las evidencias de estimulos Dirección de proyetos tecnologicos->Colaboracion institucional */
    Route::get('/estimulos/evaluaciones/DireccionProyTec/colaboracion/listColaboracion', [ColaboracionDPTController::class, "index"])->name('estimulos.evaluaciones.direccionProyTec.colaboracion');
    Route::get('/estimulos/evaluaciones/DireccionProyTec/colaboracion/searchColaboradores/{year}', [ColaboracionDPTController::class, "searchColaboradores"])->name('estimulos.evaluaciones.direccionProyTec.colaboracion');
    Route::post('/estimulos/evaluaciones/DireccionProyTec/colaboracion/saveDatos', [ColaboracionDPTController::class, "saveDatos"])->name('estimulos.evaluaciones.direccionProyTec.colaboracion');
    Route::get('/estimulos/evaluaciones/DireccionProyTec/colaboracion/datosColaboradores/{year}/{criterio}', [ColaboracionDPTController::class, "datosColaboradores"])->name('estimulos.evaluaciones.direccionProyTec.colaboracion');
    /** Rutas para las evidencias de estimulos Dirección de proyectos tecnologicos->Acreditaciones */
    Route::get('/estimulos/evaluaciones/DireccionProyTec/acreditaciones/listAcreditaciones', [AcreditacionesDPTController::class, "index"])->name('estimulos.evaluaciones.direccionProyTec.acreditaciones');
    Route::get('/estimulos/evaluaciones/DireccionProyTec/acreditaciones/searchAcreditaciones/{year}/{criterio}', [AcreditacionesDPTController::class, "searchAcreditaciones"])->name('estimulos.evaluaciones.direccionProyTec.acreditaciones');
    Route::get('/estimulos/evaluaciones/DireccionProyTec/acreditaciones/searchUsername/{clave}', [AcreditacionesDPTController::class, "searchUsername"])->name('estimulos.evaluaciones.direccionProyTec.acreditaciones');
    Route::post('/estimulos/evaluaciones/DireccionProyTec/acreditaciones/saveDatosAcreditaciones', [AcreditacionesDPTController::class, "saveDatos"])->name('estimulos.evaluaciones.direccionProyTec.acreditaciones');
    Route::get('/estimulos/evaluaciones/DireccionProyTec/acreditaciones/datosAcreditaciones/{year}/{criterio}', [AcreditacionesDPTController::class, "datosAcreditaciones"])->name('estimulos.evaluaciones.direccionProyTec.acreditaciones');
    Route::get('/estimulos/evaluaciones/DireccionProyTec/acreditaciones/searchEvidencias/{year}/{clave}/{criterio}', [AcreditacionesDPTController::class, "searchEvidencias"])->name('estimulos.evaluaciones.direccionProyTec.acreditaciones');
    Route::get('/estimulos/evaluaciones/DireccionProyTec/acreditaciones/puntos/{id}/{objetivo}', [AcreditacionesDPTController::class, "puntos"])->name('estimulos.evaluaciones.direccionProyTec.acreditaciones');
    Route::get('/estimulos/evaluaciones/DireccionProyTec/acreditaciones/getEvidenciasAcreditaciones/{clave}/{year}/{criterio}', [AcreditacionesDPTController::class, "getEvidencias"])->name('estimulos.evaluaciones.direccionProyTec.acreditaciones');
    Route::get('/estimulos/evaluaciones/DireccionProyTec/acreditaciones/obtenerEvidencias/{clave}/{year}/{criterio}', [AcreditacionesDPTController::class, "obtenerEvidencias"])->name('estimulos.evaluaciones.direccionProyTec.acreditaciones');
    Route::post('/estimulos/evaluaciones/DireccionProyTec/acreditaciones/savePuntos', [AcreditacionesDPTController::class, "savePuntos"])->name('estimulos.evaluaciones.direccionProyTec.acreditaciones');
    Route::put('/estimulos/evaluaciones/DireccionProyTec/acreditaciones/updateDatos', [AcreditacionesDPTController::class, "updateDatos"])->name('estimulos.evaluaciones.direccionProyTec.acreditaciones');
    Route::put('/estimulos/evaluaciones/DireccionProyTec/acreditaciones/updateDatosPuntos', [AcreditacionesDPTController::class, "updateDatosPuntos"])->name('estimulos.evaluaciones.direccionProyTec.acreditaciones');
    /** Rutas para las evidencias de estimulos Dirección de proyectos tecnologicos->Investigación cientifica tabla B */
    Route::get('/estimulos/evaluaciones/DireccionProyTec/investigacionB/listInvestigacionB', [InvestigacionDPTController::class, "indexB"])->name('estimulos.evaluaciones.direccionProyTec.investigacionB');
    /** Rutas para las evidencias de estimulos Dirección de tecnologia->Sostenibilidad economica tabla B */
    Route::get('/estimulos/evaluaciones/DireccionProyTec/sostenibilidadB/listSostenibilidadB', [SostenibilidadDPTController::class, "indexB"])->name('estimulos.evaluaciones.direccionProyTec.sostenibilidadB');
    Route::get('/estimulos/evaluaciones/DireccionProyTec/sostenibilidadB/searchSostenibilidadB/{year}', [SostenibilidadDPTController::class, "searchSostenibilidadB"])->name('estimulos.evaluaciones.direccionProyTec.sostenibilidadB');
    Route::post('/estimulos/evaluaciones/DireccionProyTec/sostenibilidadB/saveDatos', [SostenibilidadDPTController::class, "saveDatosB"])->name('estimulos.evaluaciones.direccionProyTec.sostenibilidadB');
    Route::get('/estimulos/evaluaciones/DireccionProyTec/sostenibilidadB/puntos/{id}/{objetivo}', [SostenibilidadDPTController::class, "puntosB"])->name('estimulos.evaluaciones.direccionProyTec.sostenibilidadB');
    Route::get('/estimulos/evaluaciones/DireccionProyTec/sostenibilidadB/datosSostenibilidadB/{year}/{criterio}', [SostenibilidadDPTController::class, "datosSostenibilidadB"])->name('estimulos.evaluaciones.direccionProyTec.sostenibilidadB');
    /** Rutas para las evidencias de estimulos Dirección de tecnologia->Transferencia de conocimiento e innovacion tabla B */
    Route::get('/estimulos/evaluaciones/DireccionProyTec/tranferenciaB/listTransferencia', [TransferenciaDPTController::class, "indexB"])->name('estimulos.evaluaciones.direccionProyTec.tranferenciaB');
    Route::get('/estimulos/evaluaciones/DireccionProyTec/tranferenciaB/searchTransferencia/{year}/{criterio}', [TransferenciaDPTController::class, "searchTransferenciaB"])->name('estimulos.evaluaciones.direccionProyTec.tranferenciaB');
    Route::get('/estimulos/evaluaciones/DireccionProyTec/tranferenciaB/puntos/{id}/{objetivo}', [TransferenciaDPTController::class, "puntosB"])->name('estimulos.evaluaciones.direccionProyTec.tranferenciaB');
    Route::post('/estimulos/evaluaciones/DireccionProyTec/tranferenciaB/saveDatos', [TransferenciaDPTController::class, "saveDatosB"])->name('estimulos.evaluaciones.direccionProyTec.tranferenciaB');
    Route::get('/estimulos/evaluaciones/DireccionProyTec/tranferenciaB/datosTransferenciaB/{year}/{criterio}', [TransferenciaDPTController::class, "datosTransferenciaB"])->name('estimulos.evaluaciones.direccionProyTec.tranferenciaB');
});

Route::post('buscar-colaborador', [ColaboracionController::class, 'buscarColaborador'])->name('buscar.colaborador');
