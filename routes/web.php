<?php

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

Route::get('/', function () {
    return view('layouts.app');
})->name('home');

Route::resource('estimulos/modulos', 'Estimulos\ModulosController')->except('create', 'show');
Route::get('estimulos/tblModulos', 'Estimulos\ModulosController@tabla');

Route::resource('estimulos/criterios', 'Estimulos\CriteriosController')->except('create', 'show');
Route::get('estimulos/tblCriterios', 'Estimulos\CriteriosController@tabla');
