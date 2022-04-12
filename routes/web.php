<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\UsersController;
use App\Models\Estimulos\SostentabilidadEconomica;
use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Estimulos\ObjetivosController;
use App\Http\Controllers\Modulos\ColaboracionController;
use App\Http\Controllers\Estimulos\LineamientosController;
use App\Http\Controllers\Estimulos\Factor2\MetasController;
use App\Http\Controllers\Estimulos\Factor2\ImpactosController;
use App\Http\Controllers\Estimulos\Factor3\DesempeñoController;
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
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionAdministracion\PosgradoDAController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionGeneral\SostentabilidadDGController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionPosgrado\AcreditacionesDPController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionPosgrado\SostenibilidadDPController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionGeneral\SostentabilidadBDGController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionGeneral\DifusionDivulgacionController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionAdministracion\FormacionRHDAController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionAdministracion\ColaboracionDAController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionCiencia\DifusionDivulgacionDCController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionAdministracion\InvestigacionDAController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionAdministracion\TransferenciaDAController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionPosgrado\DifusionDivulgacionDPController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionAdministracion\AcreditacionesDAController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionAdministracion\SostenibilidadDAController;
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

    /** Rutas para las evaluaciones de la direccion de administracion... */
    /** Rutas para las evaluaciones de estimulos Direccion de administración->Difusion y divulgacion... */
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/DifDiv/listDifDIv', [DifusionDivulgacionDAController::class, "index"])->name('estimulos.evaluaciones.direccionAdministracion.DivDif');
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/DifDiv/searchDifDIv/{year}', [DifusionDivulgacionDAController::class, "search"])->name('estimulos.evaluaciones.direccionAdministracion.DivDif');
    Route::post('/estimulos/evaluaciones/DireccionAdministracion/DifDiv/saveDatosDifDiv', [DifusionDivulgacionDAController::class, "saveDatos"])->name('estimulos.evaluaciones.direccionAdministracion.DivDif');
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/DifDiv/datosDifDiv/{year}/{criterio}', [DifusionDivulgacionDAController::class, "datosDifDiv"])->name('estimulos.evaluaciones.direccionAdministracion.DivDif');
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/DifDiv/searchEvidenciasDifDiv/{year}/{clave}', [DifusionDivulgacionController::class, "searchEvidencias"])->name('estimulos.evaluaciones.direccionAdministracion.DivDif');
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/DifDiv/getEvidenciasDifDiv/{clave}/{year}/{criterio}', [DifusionDivulgacionController::class, "getEvidenciasGeneral"])->name('estimulos.evaluaciones.direccionAdministracion.DivDif');
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/DifDiv/obtenerEvidenciasDifDiv/{clave}/{year}/{criterio}', [DifusionDivulgacionController::class, "obtenerEvidenciasGeneral"])->name('estimulos.evaluaciones.direccionAdministracion.DivDif');
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/DifDiv/puntosDifDiv/{id}/{objetivo}', [DifusionDivulgacionController::class, "puntos"])->name('estimulos.evaluaciones.direccionAdministracion.DivDif');
    Route::post('/estimulos/evaluaciones/DireccionAdministracion/DifDiv/savePuntos', [DifusionDivulgacionController::class, "savePuntos"])->name('estimulos.evaluaciones.direccionAdministracion.DivDif');
    Route::put('/estimulos/evaluaciones/DireccionAdministracion/DifDiv/updateDatosDifDiv', [DifusionDivulgacionController::class, "updateDatosGeneral"])->name('estimulos.evaluaciones.direccionAdministracion.DivDif');
    Route::put('/estimulos/evaluaciones/DireccionAdministracion/DifDiv/updateDatosPuntos', [DifusionDivulgacionController::class, "updateDatosPuntos"])->name('estimulos.evaluaciones.direccionAdministracion.DivDif');

    /** Rutas para las evaluaciones de la direccion de posgrado... */
    /** Rutas para las evaluaciones de estimulos Direccion de posgrado->Difusion y divulgacion... */
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/DifDiv/listDifDIv', [DifusionDivulgacionDPController::class, "index"])->name('estimulos.evaluaciones.direccionPosgrado.DivDif');
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/DifDiv/searchDifDIv/{year}', [DifusionDivulgacionDPController::class, "search"])->name('estimulos.evaluaciones.direccionPosgrado.DivDif');
    Route::post('/estimulos/evaluaciones/DireccionPosgrado/DifDiv/saveDatosDifDiv', [DifusionDivulgacionDPController::class, "saveDatos"])->name('estimulos.evaluaciones.direccionPosgrado.DivDif');
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/DifDiv/datosDifDiv/{year}/{criterio}', [DifusionDivulgacionDPController::class, "datosDifDiv"])->name('estimulos.evaluaciones.direccionPosgrado.DivDif');
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/DifDiv/searchEvidenciasDifDiv/{year}/{clave}', [DifusionDivulgacionController::class, "searchEvidencias"])->name('estimulos.evaluaciones.direccionPosgrado.DivDif');
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/DifDiv/getEvidenciasDifDiv/{clave}/{year}/{criterio}', [DifusionDivulgacionController::class, "getEvidenciasGeneral"])->name('estimulos.evaluaciones.direccionPosgrado.DivDif');
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/DifDiv/obtenerEvidenciasDifDiv/{clave}/{year}/{criterio}', [DifusionDivulgacionController::class, "obtenerEvidenciasGeneral"])->name('estimulos.evaluaciones.direccionPosgrado.DivDif');
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/DifDiv/puntosDifDiv/{id}/{objetivo}', [DifusionDivulgacionController::class, "puntos"])->name('estimulos.evaluaciones.direccionPosgrado.DivDif');
    Route::post('/estimulos/evaluaciones/DireccionPosgrado/DifDiv/savePuntos', [DifusionDivulgacionController::class, "savePuntos"])->name('estimulos.evaluaciones.direccionPosgrado.DivDif');
    Route::put('/estimulos/evaluaciones/DireccionPosgrado/DifDiv/updateDatosDifDiv', [DifusionDivulgacionController::class, "updateDatosGeneral"])->name('estimulos.evaluaciones.direccionPosgrado.DivDif');
    Route::put('/estimulos/evaluaciones/DireccionPosgrado/DifDiv/updateDatosPuntos', [DifusionDivulgacionController::class, "updateDatosPuntos"])->name('estimulos.evaluaciones.direccionPosgrado.DivDif');

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




    /** Rutas para las evaluaciones de estimulos Direccion general->Posgrado... */
    Route::get('/estimulos/evaluaciones/DireccionGeneral/posgrado/listPosgrado', [PosgradoDGController::class, "index"])->name('estimulos.evaluaciones.direccionGeneral.posgrado');
    Route::get('/estimulos/evaluaciones/DireccionGeneral/posgrado/searchPosgrado/{year}/{criterio}', [PosgradoDGController::class, "search"])->name('estimulos.evaluaciones.direccionGeneral.posgrado');
    Route::get('/estimulos/evaluaciones/DireccionGeneral/posgrado/searchUsernamePosgrado/{clave}', [PosgradoDGController::class, "searchUsername"])->name('estimulos.evaluaciones.direccionGeneral.posgrado');
    Route::post('/estimulos/evaluaciones/DireccionGeneral/posgrado/saveDatosPosgrado', [PosgradoDGController::class, "saveDatos"])->name('estimulos.evaluaciones.direccionGeneral.posgrado');
    Route::get('/estimulos/evaluaciones/DireccionGeneral/posgrado/datosposgrado/{year}/{criterio}', [PosgradoDGController::class, "datosPosgrado"])->name('estimulos.evaluaciones.direccionGeneral.posgrado');
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
    Route::delete('/estimulos/evaluaciones/DireccionGeneral/investigacion/deletePuntosInvestigacion/{clave}/{year}/{criterio}', [InvestigacionDGController::class, "deletePuntos"])->name('estimulos.evaluaciones.direccionGeneral.investigacion');
    Route::get('/estimulos/evaluaciones/DireccionGeneral/investigacion/updateDatosInvestigacion/{clave}/{year}/{criterio}', [InvestigacionDGController::class, "updateDatosGeneral"])->name('estimulos.evaluaciones.direccionGeneral.investigacion');
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
    Route::get('/estimulos/evaluaciones/DireccionGeneral/transferencia/updateDatosTransferencia/{clave}/{year}/{criterio}', [TransferenciaDGController::class, "updateDatosGeneral"])->name('estimulos.evaluaciones.direccionGeneral.transferencia');
    Route::delete('/estimulos/evaluaciones/DireccionGeneral/transferencia/deletePuntosTransferencia/{clave}/{year}/{criterio}', [TransferenciaDGController::class, "deletePuntos"])->name('estimulos.evaluaciones.direccionGeneral.transferencia');
    /** Rutas para las evidencias de estimulos Dirección general->Formación de recursos humanos */
    Route::get('/estimulos/evaluaciones/DireccionGeneral/formacionRH/listFormacionRH', [FormacionRHDGController::class, "index"])->name('estimulos.evaluaciones.direccionGeneral.formacionRH');
    Route::get('/estimulos/evaluaciones/DireccionGeneral/formacionRH/searchFormacionRH/{year}/{criterio}', [FormacionRHDGController::class, "search"])->name('estimulos.evaluaciones.direccionGeneral.formacionRH');
    Route::get('/estimulos/evaluaciones/DireccionGeneral/formacionRH/searchUsernameFormacionRH/{clave}', [FormacionRHDGController::class, "searchUsername"])->name('estimulos.evaluaciones.direccionGeneral.formacionRH');
    Route::post('/estimulos/evaluaciones/DireccionGeneral/formacionRH/saveDatosFormacionRH', [FormacionRHDGController::class, "saveDatos"])->name('estimulos.evaluaciones.direccionGeneral.formacionRH');
    Route::get('/estimulos/evaluaciones/DireccionGeneral/formacionRH/datosFormacionRH/{year}/{criterio}', [FormacionRHDGController::class, "datosFormacionRH"])->name('estimulos.evaluaciones.direccionGeneral.formacionRH');
    /** Rutas para las evidencias de estimulos Dirección general->Colaboracion institucional */
    Route::get('/estimulos/evaluaciones/DireccionGeneral/colaboracion/listColaboracion', [ColaboracionDGController::class, "index"])->name('estimulos.evaluaciones.direccionGeneral.colaboracion');
    Route::get('/estimulos/evaluaciones/DireccionGeneral/colaboracion/searchColaboradores/{year}', [ColaboracionDGController::class, "searchColaboradores"])->name('estimulos.evaluaciones.direccionGeneral.colaboracion');
    Route::get('/estimulos/evaluaciones/DireccionGeneral/colaboracion/datosColaboradores/{year}/{criterio}', [ColaboracionDGController::class, "datosColaboradores"])->name('estimulos.evaluaciones.direccionGeneral.colaboracion');
    /** Rutas para las evidencias de estimulos Dirección general->Acreditaciones */
    Route::get('/estimulos/evaluaciones/DireccionGeneral/acreditaciones/listAcreditaciones', [AcreditacionesController::class, "index"])->name('estimulos.evaluaciones.direccionGeneral.acreditaciones');
    Route::get('/estimulos/evaluaciones/DireccionGeneral/acreditaciones/searchAcreditaciones/{year}/{criterio}', [AcreditacionesController::class, "searchAcreditaciones"])->name('estimulos.evaluaciones.direccionGeneral.acreditaciones');
    Route::get('/estimulos/evaluaciones/DireccionGeneral/acreditaciones/searchUsername/{clave}', [AcreditacionesController::class, "searchUsername"])->name('estimulos.evaluaciones.direccionGeneral.acreditaciones');
    Route::post('/estimulos/evaluaciones/DireccionGeneral/acreditaciones/saveDatosAcreditaciones', [AcreditacionesController::class, "saveDatos"])->name('estimulos.evaluaciones.direccionGeneral.acreditaciones');
    Route::get('/estimulos/evaluaciones/DireccionGeneral/acreditaciones/datosAcreditaciones/{year}/{criterio}', [AcreditacionesController::class, "datosAcreditaciones"])->name('estimulos.evaluaciones.direccionGeneral.acreditaciones');
    Route::get('/estimulos/evaluaciones/DireccionGeneral/acreditaciones/searchEvidencias/{year}/{clave}/{criterio}', [AcreditacionesController::class, "searchEvidencias"])->name('estimulos.evaluaciones.direccionGeneral.acreditaciones');
    /** Rutas para las evidencias de estimulos Dirección general->Investigación cientifica tabla B */
    Route::get('/estimulos/evaluaciones/DireccionGeneral/investigacionB/listInvestigacion', [InvestigacionBDGController::class, "index"])->name('estimulos.evaluaciones.direccionGeneral.investigacionB');
    /** Rutas para las evidencias de estimulos Dirección general->Sostenibilidad economica tabla B */
    Route::get('/estimulos/evaluaciones/DireccionGeneral/sostenibilidadB/listSostenibilidad', [SostentabilidadBDGController::class, "index"])->name('estimulos.evaluaciones.direccionGeneral.sostenibilidadB');
    /** Rutas para las evidencias de estimulos Dirección general->Transferencia de conocimiento e innovacion tabla B */
    Route::get('/estimulos/evaluaciones/DireccionGeneral/tranferenciaB/listTransferencia', [TransferenciaBDGController::class, "index"])->name('estimulos.evaluaciones.direccionGeneral.tranferenciaB');


    /** Rutas para las evaluaciones de estimulos Direccion de administración->Posgrado... */
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/posgrado/listPosgrado', [PosgradoDAController::class, "index"])->name('estimulos.evaluaciones.direccionAdministracion.posgrado');
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/posgrado/searchPosgrado/{year}/{criterio}', [PosgradoDAController::class, "search"])->name('estimulos.evaluaciones.direccionAdministracion.posgrado');
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/posgrado/searchUsernamePosgrado/{clave}', [PosgradoDAController::class, "searchUsername"])->name('estimulos.evaluaciones.direccionAdministracion.posgrado');
    Route::post('/estimulos/evaluaciones/DireccionAdministracion/posgrado/saveDatosPosgrado', [PosgradoDAController::class, "saveDatos"])->name('estimulos.evaluaciones.direccionAdministracion.posgrado');
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/posgrado/datosposgrado/{year}/{criterio}', [PosgradoDAController::class, "datosPosgrado"])->name('estimulos.evaluaciones.direccionAdministracion.posgrado');
    /** Rutas para las evaluaciones de estimulos Direccion administracion->Investigacion Cientifica... */
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/investigacion/listInvestigacion', [InvestigacionDAController::class, "index"])->name('estimulos.evaluaciones.direccionAdministracion.investigacion');
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/investigacion/searchInvestigacion/{year}/{criterio}', [InvestigacionDAController::class, "search"])->name('estimulos.evaluaciones.direccionAdministracion.investigacion');
    Route::post('/estimulos/evaluaciones/DireccionAdministracion/investigacion/saveDatosInvestigacion', [InvestigacionDAController::class, "saveDatos"])->name('estimulos.evaluaciones.direccionAdministracion.investigacion');
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/investigacion/datosInvestigacion/{year}/{criterio}', [InvestigacionDAController::class, "datosInvestigacion"])->name('estimulos.evaluaciones.direccionAdministracion.investigacion');
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/investigacion/searchEvidenciasInvestigacion/{year}/{clave}/{criterio}', [InvestigacionDAController::class, "searchEvidencias"])->name('estimulos.evaluaciones.direccionAdministracion.investigacion');
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/investigacion/obtenerEvidenciasInvestigacion/{clave}/{year}/{criterio}', [InvestigacionDAController::class, "obtenerEvidenciasGeneral"])->name('estimulos.evaluaciones.direccionAdministracion.investigacion');
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/investigacion/puntosinvestigacion/{id}/{objetivo}', [InvestigacionDAController::class, "puntos"])->name('estimulos.evaluaciones.direccionAdministracion.investigacion');
    Route::post('/estimulos/evaluaciones/DireccionAdministracion/investigacion/savePuntos', [InvestigacionDAController::class, "savePuntos"])->name('estimulos.evaluaciones.direccionAdministracion.investigacion');
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/investigacion/getEvidenciasInvestigacion/{clave}/{year}/{criterio}', [InvestigacionDAController::class, "getEvidenciasGeneral"])->name('estimulos.evaluaciones.direccionAdministracion.investigacion');
    Route::delete('/estimulos/evaluaciones/DireccionAdministracion/investigacion/deletePuntosInvestigacion/{clave}/{year}/{criterio}', [InvestigacionDAController::class, "deletePuntos"])->name('estimulos.evaluaciones.direccionAdministracion.investigacion');
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/investigacion/updateDatosInvestigacion/{clave}/{year}/{criterio}', [InvestigacionDAController::class, "updateDatosGeneral"])->name('estimulos.evaluaciones.direccionAdministracion.investigacion');
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
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/transferencia/getEvidenciasTransferencia/{clave}/{year}/{criterio}', [TransferenciaDAController::class, "getEvidenciasGeneral"])->name('estimulos.evaluaciones.direccionAdministracion.transferencia');
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/transferencia/obtenerEvidenciasTransferencia/{clave}/{year}/{criterio}', [TransferenciaDAController::class, "obtenerEvidenciasGeneral"])->name('estimulos.evaluaciones.direccionAdministracion.transferencia');
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/transferencia/puntosTransferencia/{id}/{objetivo}', [TransferenciaDAController::class, "puntos"])->name('estimulos.evaluaciones.direccionAdministracion.transferencia');
    Route::post('/estimulos/evaluaciones/DireccionAdministracion/transferencia/savePuntos', [TransferenciaDAController::class, "savePuntos"])->name('estimulos.evaluaciones.direccionAdministracion.transferencia');
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/transferencia/updateDatosTransferencia/{clave}/{year}/{criterio}', [TransferenciaDAController::class, "updateDatosGeneral"])->name('estimulos.evaluaciones.direccionAdministracion.transferencia');
    Route::delete('/estimulos/evaluaciones/DireccionAdministracion/transferencia/deletePuntosTransferencia/{clave}/{year}/{criterio}', [TransferenciaDAController::class, "deletePuntos"])->name('estimulos.evaluaciones.direccionAdministracion.transferencia');
    /** Rutas para las evidencias de estimulos Dirección administracion->Formación de recursos humanos */
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/formacionRH/listFormacionRH', [FormacionRHDAController::class, "index"])->name('estimulos.evaluaciones.direccionAdministracion.formacionRH');
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/formacionRH/searchFormacionRH/{year}/{criterio}', [FormacionRHDAController::class, "search"])->name('estimulos.evaluaciones.direccionAdministracion.formacionRH');
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/formacionRH/searchUsernameFormacionRH/{clave}', [FormacionRHDAController::class, "searchUsername"])->name('estimulos.evaluaciones.direccionAdministracion.formacionRH');
    Route::post('/estimulos/evaluaciones/DireccionAdministracion/formacionRH/saveDatosFormacionRH', [FormacionRHDAController::class, "saveDatos"])->name('estimulos.evaluaciones.direccionAdministracion.formacionRH');
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/formacionRH/datosFormacionRH/{year}/{criterio}', [FormacionRHDAController::class, "datosFormacionRH"])->name('estimulos.evaluaciones.direccionAdministracion.formacionRH');
    /** Rutas para las evidencias de estimulos Dirección administracion->Colaboracion institucional */
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/colaboracion/listColaboracion', [ColaboracionDAController::class, "index"])->name('estimulos.evaluaciones.direccionAdministracion.colaboracion');
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/colaboracion/searchColaboradores/{year}', [ColaboracionDAController::class, "searchColaboradores"])->name('estimulos.evaluaciones.direccionAdministracion.colaboracion');
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/colaboracion/datosColaboradores/{year}/{criterio}', [ColaboracionDAController::class, "datosColaboradores"])->name('estimulos.evaluaciones.direccionAdministracion.colaboracion');
    /** Rutas para las evidencias de estimulos Dirección administracion->Acreditaciones */
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/acreditaciones/listAcreditaciones', [AcreditacionesDAController::class, "index"])->name('estimulos.evaluaciones.direccionAdministracion.acreditaciones');
    /** Rutas para las evidencias de estimulos Dirección administracion->Investigación cientifica tabla B */
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/investigacionB/listInvestigacionB', [InvestigacionDAController::class, "indexB"])->name('estimulos.evaluaciones.direccionAdministracion.investigacionB');
    /** Rutas para las evidencias de estimulos Dirección administracion->Sostenibilidad economica tabla B */
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/sostenibilidadB/listSostenibilidad', [SostenibilidadDAController::class, "indexB"])->name('estimulos.evaluaciones.direccionAdministracion.sostenibilidadB');
    /** Rutas para las evidencias de estimulos Dirección general->Transferencia de conocimiento e innovacion tabla B */
    Route::get('/estimulos/evaluaciones/DireccionAdministracion/tranferenciaB/listTransferencia', [TransferenciaDAController::class, "indexB"])->name('estimulos.evaluaciones.direccionAdministracion.tranferenciaB');


    /** Rutas para las evaluaciones de estimulos Direccion de posgrado->Posgrado... */
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/posgrado/listPosgrado', [PosgradoDPController::class, "index"])->name('estimulos.evaluaciones.direccionPosgrado.posgrado');
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/posgrado/searchPosgrado/{year}/{criterio}', [PosgradoDPController::class, "search"])->name('estimulos.evaluaciones.direccionPosgrado.posgrado');
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/posgrado/searchUsernamePosgrado/{clave}', [PosgradoDPController::class, "searchUsername"])->name('estimulos.evaluaciones.direccionPosgrado.posgrado');
    Route::post('/estimulos/evaluaciones/DireccionPosgrado/posgrado/saveDatosPosgrado', [PosgradoDPController::class, "saveDatos"])->name('estimulos.evaluaciones.direccionPosgrado.posgrado');
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/posgrado/datosposgrado/{year}/{criterio}', [PosgradoDPController::class, "datosPosgrado"])->name('estimulos.evaluaciones.direccionPosgrado.posgrado');
    /** Rutas para las evaluaciones de estimulos Direccion posgrado->Investigacion Cientifica... */
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/investigacion/listInvestigacion', [InvestigacionDPController::class, "index"])->name('estimulos.evaluaciones.direccionPosgrado.investigacion');
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/investigacion/searchInvestigacion/{year}/{criterio}', [InvestigacionDPController::class, "search"])->name('estimulos.evaluaciones.direccionPosgrado.investigacion');
    Route::post('/estimulos/evaluaciones/DireccionPosgrado/investigacion/saveDatosInvestigacion', [InvestigacionDPController::class, "saveDatos"])->name('estimulos.evaluaciones.direccionPosgrado.investigacion');
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/investigacion/datosInvestigacion/{year}/{criterio}', [InvestigacionDPController::class, "datosInvestigacion"])->name('estimulos.evaluaciones.direccionPosgrado.investigacion');
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/investigacion/searchEvidenciasInvestigacion/{year}/{clave}/{criterio}', [InvestigacionDPController::class, "searchEvidencias"])->name('estimulos.evaluaciones.direccionPosgrado.investigacion');
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/investigacion/obtenerEvidenciasInvestigacion/{clave}/{year}/{criterio}', [InvestigacionDPController::class, "obtenerEvidenciasGeneral"])->name('estimulos.evaluaciones.direccionPosgrado.investigacion');
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/investigacion/puntosinvestigacion/{id}/{objetivo}', [InvestigacionDPController::class, "puntos"])->name('estimulos.evaluaciones.direccionPosgrado.investigacion');
    Route::post('/estimulos/evaluaciones/DireccionPosgrado/investigacion/savePuntos', [InvestigacionDPController::class, "savePuntos"])->name('estimulos.evaluaciones.direccionPosgrado.investigacion');
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/investigacion/getEvidenciasInvestigacion/{clave}/{year}/{criterio}', [InvestigacionDPController::class, "getEvidenciasGeneral"])->name('estimulos.evaluaciones.direccionPosgrado.investigacion');
    Route::delete('/estimulos/evaluaciones/DireccionPosgrado/investigacion/deletePuntosInvestigacion/{clave}/{year}/{criterio}', [InvestigacionDPController::class, "deletePuntos"])->name('estimulos.evaluaciones.direccionPosgrado.investigacion');
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/investigacion/updateDatosInvestigacion/{clave}/{year}/{criterio}', [InvestigacionDPController::class, "updateDatosGeneral"])->name('estimulos.evaluaciones.direccionPosgrado.investigacion');
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
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/transferencia/updateDatosTransferencia/{clave}/{year}/{criterio}', [TransferenciaDPController::class, "updateDatosPosgrado"])->name('estimulos.evaluaciones.direccionPosgrado.transferencia');
    Route::delete('/estimulos/evaluaciones/DireccionPosgrado/transferencia/deletePuntosTransferencia/{clave}/{year}/{criterio}', [TransferenciaDPController::class, "deletePuntos"])->name('estimulos.evaluaciones.direccionPosgrado.transferencia');
    /** Rutas para las evidencias de estimulos Dirección posgrado->Formación de recursos humanos */
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/formacionRH/listFormacionRH', [FormacionRHDPController::class, "index"])->name('estimulos.evaluaciones.direccionPosgrado.formacionRH');
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/formacionRH/searchFormacionRH/{year}/{criterio}', [FormacionRHDPController::class, "search"])->name('estimulos.evaluaciones.direccionPosgrado.formacionRH');
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/formacionRH/searchUsernameFormacionRH/{clave}', [FormacionRHDPController::class, "searchUsername"])->name('estimulos.evaluaciones.direccionPosgrado.formacionRH');
    Route::post('/estimulos/evaluaciones/DireccionPosgrado/formacionRH/saveDatosFormacionRH', [FormacionRHDPController::class, "saveDatos"])->name('estimulos.evaluaciones.direccionPosgrado.formacionRH');
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/formacionRH/datosFormacionRH/{year}/{criterio}', [FormacionRHDPController::class, "datosFormacionRH"])->name('estimulos.evaluaciones.direccionPosgrado.formacionRH');
    /** Rutas para las evidencias de estimulos Dirección posgrado->Colaboracion institucional */
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/colaboracion/listColaboracion', [ColaboracionDPController::class, "index"])->name('estimulos.evaluaciones.direccionPosgrado.colaboracion');
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/colaboracion/searchColaboradores/{year}', [ColaboracionDPController::class, "searchColaboradores"])->name('estimulos.evaluaciones.direccionPosgrado.colaboracion');
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/colaboracion/datosColaboradores/{year}/{criterio}', [ColaboracionDPController::class, "datosColaboradores"])->name('estimulos.evaluaciones.direccionPosgrado.colaboracion');
    /** Rutas para las evidencias de estimulos Dirección posgrado->Acreditaciones */
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/acreditaciones/listAcreditaciones', [AcreditacionesDPController::class, "index"])->name('estimulos.evaluaciones.direccionPosgrado.acreditaciones');
    /** Rutas para las evidencias de estimulos Dirección posgrado->Investigación cientifica tabla B */
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/investigacionB/listInvestigacionB', [InvestigacionDPController::class, "indexB"])->name('estimulos.evaluaciones.direccionPosgrado.investigacionB');
    /** Rutas para las evidencias de estimulos Dirección posgrado->Sostenibilidad economica tabla B */
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/sostenibilidadB/listSostenibilidad', [SostenibilidadDPController::class, "indexB"])->name('estimulos.evaluaciones.direccionPosgrado.sostenibilidadB');
    /** Rutas para las evidencias de estimulos Dirección posgrado->Transferencia de conocimiento e innovacion tabla B */
    Route::get('/estimulos/evaluaciones/DireccionPosgrado/tranferenciaB/listTransferencia', [TransferenciaDPController::class, "indexB"])->name('estimulos.evaluaciones.direccionPosgrado.tranferenciaB');


    /** Rutas para las evaluaciones de estimulos Direccion de ciencia->Posgrado... */
    Route::get('/estimulos/evaluaciones/DireccionCiencia/posgrado/listPosgrado', [PosgradoDCController::class, "index"])->name('estimulos.evaluaciones.direccionCiencia.posgrado');
    Route::get('/estimulos/evaluaciones/DireccionCiencia/posgrado/searchPosgrado/{year}/{criterio}', [PosgradoDCController::class, "search"])->name('estimulos.evaluaciones.direccionCiencia.posgrado');
    Route::get('/estimulos/evaluaciones/DireccionCiencia/posgrado/searchUsernamePosgrado/{clave}', [PosgradoDCController::class, "searchUsername"])->name('estimulos.evaluaciones.direccionCiencia.posgrado');
    Route::post('/estimulos/evaluaciones/DireccionCiencia/posgrado/saveDatosPosgrado', [PosgradoDCController::class, "saveDatos"])->name('estimulos.evaluaciones.direccionCiencia.posgrado');
    Route::get('/estimulos/evaluaciones/DireccionCiencia/posgrado/datosposgrado/{year}/{criterio}', [PosgradoDCController::class, "datosPosgrado"])->name('estimulos.evaluaciones.direccionCiencia.posgrado');
    /** Rutas para las evaluaciones de estimulos Direccion de ciencia->Investigacion Cientifica... */
    Route::get('/estimulos/evaluaciones/DireccionCiencia/investigacion/listInvestigacion', [InvestigacionDCController::class, "index"])->name('estimulos.evaluaciones.direccionCiencia.investigacion');
    Route::get('/estimulos/evaluaciones/DireccionCiencia/investigacion/searchInvestigacion/{year}/{criterio}', [InvestigacionDCController::class, "search"])->name('estimulos.evaluaciones.direccionCiencia.investigacion');
    Route::post('/estimulos/evaluaciones/DireccionCiencia/investigacion/saveDatosInvestigacion', [InvestigacionDCController::class, "saveDatos"])->name('estimulos.evaluaciones.direccionCiencia.investigacion');
    Route::get('/estimulos/evaluaciones/DireccionCiencia/investigacion/datosInvestigacion/{year}/{criterio}', [InvestigacionDCController::class, "datosInvestigacion"])->name('estimulos.evaluaciones.direccionCiencia.investigacion');
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
    /** Rutas para las evidencias de estimulos Dirección de ciencia->Formación de recursos humanos */
    Route::get('/estimulos/evaluaciones/DireccionCiencia/formacionRH/listFormacionRH', [FormacionRHDCController::class, "index"])->name('estimulos.evaluaciones.direccionCiencia.formacionRH');
    Route::get('/estimulos/evaluaciones/DireccionCiencia/formacionRH/searchFormacionRH/{year}/{criterio}', [FormacionRHDCController::class, "search"])->name('estimulos.evaluaciones.direccionCiencia.formacionRH');
    Route::get('/estimulos/evaluaciones/DireccionCiencia/formacionRH/searchUsernameFormacionRH/{clave}', [FormacionRHDCController::class, "searchUsername"])->name('estimulos.evaluaciones.direccionCiencia.formacionRH');
    Route::post('/estimulos/evaluaciones/DireccionCiencia/formacionRH/saveDatosFormacionRH', [FormacionRHDCController::class, "saveDatos"])->name('estimulos.evaluaciones.direccionCiencia.formacionRH');
    Route::get('/estimulos/evaluaciones/DireccionCiencia/formacionRH/datosFormacionRH/{year}/{criterio}', [FormacionRHDCController::class, "datosFormacionRH"])->name('estimulos.evaluaciones.direccionCiencia.formacionRH');
    /** Rutas para las evidencias de estimulos Dirección de ciencia->Colaboracion institucional */
    Route::get('/estimulos/evaluaciones/DireccionCiencia/colaboracion/listColaboracion', [ColaboracionDCController::class, "index"])->name('estimulos.evaluaciones.direccionCiencia.colaboracion');
    Route::get('/estimulos/evaluaciones/DireccionCiencia/colaboracion/searchColaboradores/{year}', [ColaboracionDCController::class, "searchColaboradores"])->name('estimulos.evaluaciones.direccionCiencia.colaboracion');
    Route::get('/estimulos/evaluaciones/DireccionCiencia/colaboracion/datosColaboradores/{year}/{criterio}', [ColaboracionDCController::class, "datosColaboradores"])->name('estimulos.evaluaciones.direccionCiencia.colaboracion');
    /** Rutas para las evidencias de estimulos Dirección de ciencia->Acreditaciones */
    Route::get('/estimulos/evaluaciones/DireccionCiencia/acreditaciones/listAcreditaciones', [AcreditacionesDCController::class, "index"])->name('estimulos.evaluaciones.direccionCiencia.acreditaciones');
    /** Rutas para las evidencias de estimulos Dirección de ciencia->Investigación cientifica tabla B */
    Route::get('/estimulos/evaluaciones/DireccionCiencia/investigacionB/listInvestigacionB', [InvestigacionDCController::class, "indexB"])->name('estimulos.evaluaciones.direccionCiencia.investigacionB');
    /** Rutas para las evidencias de estimulos Dirección de ciencia->Sostenibilidad economica tabla B */
    Route::get('/estimulos/evaluaciones/DireccionCiencia/sostenibilidadB/listSostenibilidad', [SostenibilidadDCController::class, "indexB"])->name('estimulos.evaluaciones.direccionCiencia.sostenibilidadB');
    /** Rutas para las evidencias de estimulos Dirección de ciencia->Transferencia de conocimiento e innovacion tabla B */
    Route::get('/estimulos/evaluaciones/DireccionCiencia/tranferenciaB/listTransferencia', [TransferenciaDCController::class, "indexB"])->name('estimulos.evaluaciones.direccionCiencia.tranferenciaB');
});

Route::post('buscar-colaborador', [ColaboracionController::class, 'buscarColaborador'])->name('buscar.colaborador');
