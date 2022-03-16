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
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionGeneral\PosgradoDGController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionGeneral\FormacionRHDGController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionGeneral\ColaboracionDGController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionGeneral\InvestigacionDGController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionGeneral\TransferenciaDGController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionGeneral\SostentabilidadDGController;
use App\Http\Controllers\Estimulos\Evaluaciones\DireccionGeneral\DifusionDivulgacionController;

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

    /** Rutas para las evaluaciones... */





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
    Route::get('/estimulos/evaluaciones/responsabilidades/directores/consultarDirectores/{clave}/{year}', [DirectoresController::class, "consultar"])->name('estimulos.evaluaciones.responsabilidades.directores');
    Route::post('/estimulos/evaluaciones/responsabilidades/directores/storeDirectores', [DirectoresController::class, "store"])->name('estimulos.evaluaciones.responsabilidades.directores');
    Route::get('/estimulos/evaluaciones/responsabilidades/directores/historialDirectores', [DirectoresController::class, "historial"])->name('estimulos.evaluaciones.responsabilidades.directores');
    /** Rutas para las evaluaciones de estimulos responsabilidades->Subdirectores... */
    Route::get('/estimulos/evaluaciones/responsabilidades/subdirectores/listSubdirectores', [SubdirectoresController::class, "index"])->name('estimulos.evaluaciones.responsabilidades.subdirectores');
    Route::get('/estimulos/evaluaciones/responsabilidades/Subdirectores/consultarSubdirectores/{clave}/{year}', [SubdirectoresController::class, "consultar"])->name('estimulos.evaluaciones.responsabilidades.subdirectores');
    Route::post('/estimulos/evaluaciones/responsabilidades/Subdirectores/storeSubdirectores', [SubdirectoresController::class, "store"])->name('estimulos.evaluaciones.responsabilidades.subdirectores');
    Route::get('/estimulos/evaluaciones/responsabilidades/Subdirectores/historialSubdirectores', [SubdirectoresController::class, "historial"])->name('estimulos.evaluaciones.responsabilidades.subdirectores');
    /** Rutas para las evaluaciones de estimulos responsabilidades->Coordinadores... */
    Route::get('/estimulos/evaluaciones/responsabilidades/Coordinadores/listCoordinadores', [CoordinadoresController::class, "index"])->name('estimulos.evaluaciones.responsabilidades.Coordinadores');
    Route::get('/estimulos/evaluaciones/responsabilidades/Coordinadores/consultarCoordinadores/{clave}/{year}', [CoordinadoresController::class, "consultar"])->name('estimulos.evaluaciones.responsabilidades.Coordinadores');
    Route::post('/estimulos/evaluaciones/responsabilidades/Coordinadores/storeCoordinadores', [CoordinadoresController::class, "store"])->name('estimulos.evaluaciones.responsabilidades.Coordinadores');
    Route::get('/estimulos/evaluaciones/responsabilidades/Coordinadores/historialCoordinadores', [CoordinadoresController::class, "historial"])->name('estimulos.evaluaciones.responsabilidades.Coordinadores');
    /** Rutas para las evaluaciones de estimulos responsabilidades->Personal de apoyo... */
    Route::get('/estimulos/evaluaciones/responsabilidades/personalApoyo/listPersonalApoyo', [PersonalApoyoController::class, "index"])->name('estimulos.evaluaciones.responsabilidades.personalApoyo');
    Route::get('/estimulos/evaluaciones/responsabilidades/personalApoyo/consultarPersonalApoyo/{clave}/{year}', [PersonalApoyoController::class, "consultar"])->name('estimulos.evaluaciones.responsabilidades.personalApoyo');
    Route::post('/estimulos/evaluaciones/responsabilidades/personalApoyo/storePersonalApoyo', [PersonalApoyoController::class, "store"])->name('estimulos.evaluaciones.responsabilidades.personalApoyo');
    Route::get('/estimulos/evaluaciones/responsabilidades/personalApoyo/historialPersonalApoyo', [PersonalApoyoController::class, "historial"])->name('estimulos.evaluaciones.responsabilidades.personalApoyo');
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
    Route::get('/estimulos/evaluaciones/DireccionGeneral/DifDiv/updateDatosDifDiv/{clave}/{year}/{criterio}', [DifusionDivulgacionController::class, "updateDatosGeneral"])->name('estimulos.evaluaciones.direccionGeneral.DivDif');
    Route::delete('/estimulos/evaluaciones/DireccionGeneral/DifDiv/deletePuntosDifDiv/{clave}/{year}/{criterio}', [DifusionDivulgacionController::class, "deletePuntos"])->name('estimulos.evaluaciones.direccionGeneral.DivDif');
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

    /** Rutas para las evaluaciones... */
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
    /** Rutas para las evidencias de estimulos Dirección general->Colaboracion institucional */
    Route::get('/estimulos/evaluaciones/DireccionGeneral/colaboracion/listColaboracion', [ColaboracionDGController::class, "index"])->name('estimulos.evaluaciones.direccionGeneral.colaboracion');
    Route::get('/estimulos/evaluaciones/DireccionGeneral/colaboracion/searchColaboradores/{year}', [ColaboracionDGController::class, "searchColaboradores"])->name('estimulos.evaluaciones.direccionGeneral.colaboracion');
    Route::get('/estimulos/evaluaciones/DireccionGeneral/colaboracion/datosColaboradores/{year}/{criterio}', [ColaboracionDGController::class, "datosColaboradores"])->name('estimulos.evaluaciones.direccionGeneral.colaboracion');
});

Route::post('buscar-colaborador', [ColaboracionController::class, 'buscarColaborador'])->name('buscar.colaborador');
