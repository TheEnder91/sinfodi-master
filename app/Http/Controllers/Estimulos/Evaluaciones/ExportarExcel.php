<?php

namespace App\Http\Controllers\Estimulos\Evaluaciones;

use Illuminate\Http\Request;
use App\Exports\ConcentradoExcel;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ExportarExcel extends Controller
{
    public function index($direccion, $year){
        return Excel::download(new ConcentradoExcel($direccion, $year), 'concentrado.xlsx');
    }
}
