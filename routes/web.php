<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Estimulos\ObjetivosController;
use App\Http\Controllers\Estimulos\LineamientosController;
use App\Http\Controllers\Estimulos\Factor1\ActividadesAController;
use App\Http\Controllers\Estimulos\Factor1\ActividadesBController;

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
        return view('layouts.app');
    });

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
    //Rutas para el catalogo de objetivos...
    Route::get('/estimulos/objetivos/listObjetivos', [ObjetivosController::class, "index"])->name('estimulos.objetivos');
    Route::post('/estimulos/objetivos/storeObjetivo', [ObjetivosController::class, "store"])->name('estimulos.objetivos');
    Route::get('/estimulos/objetivos/showObjetivo/{id}', [ObjetivosController::class, "show"])->name('estimulos.objetivos');
    Route::put('/estimulos/objetivos/updateObjetivo/{id}', [ObjetivosController::class, "update"])->name('estimulos.objetivos');
    Route::delete('/estimulos/objetivos/destroyObjetivo/{id}', [ObjetivosController::class, "destroy"])->name('estimulos.objetivos');
    //Ruta para visualizar los lineamientos de estimulos...
    Route::get('/estimulos/lineamientos/viewLineamientos', [LineamientosController::class, "index"])->name('estimulos.lineamientos');
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
});
