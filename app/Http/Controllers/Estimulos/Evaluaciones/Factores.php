<?php

namespace App\Http\Controllers\Estimulos\Evaluaciones;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Factores extends Controller
{
    public function grupo1_factor2(){
        return view('grupo1.factor2.index');
    }

    public function grupo1_factor3(){
        return view('grupo1.factor3.index');
    }

    public function grupo1_factor2_noAplica(){
        return view('grupo1.factor2.noAplica');
    }

    public function grupo2_factor2(){
        return view('grupo2.factor2.index');
    }

    public function grupo2_factor3(){
        return view('grupo2.factor3.index');
    }
}
