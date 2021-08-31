<?php

namespace App\Http\Controllers\Estimulos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LineamientosController extends Controller
{
    const PERMISSIONS = [
        'index' => 'estimulo-lineamientos-index',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('estimulos.lineamientos.index');
    }
}
