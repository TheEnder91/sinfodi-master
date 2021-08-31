<?php

use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Estimulos\ObjetivosController;
use Illuminate\Support\Facades\Route;

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
});
