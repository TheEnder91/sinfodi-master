<?php

namespace App\Exports;

use App\Models\Estimulos\Comites;
use App\Models\Estimulos\Criterio;
use App\Models\Estimulos\Objetivo;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class ConcentradoExcel implements FromView
{

    protected $direccion, $year;

    function __construct($direccion, $year) {
        $this->direccion = $direccion;
        $this->year = $year;
    }

    public function view() : View
    {
        return view('estimulos.evaluaciones.concentradoExcel.index', [
            'participantes' => self::participantes(),
            'objetivos' => Objetivo::all(),
            'criterios' => Criterio::all(),
        ]);
    }

    public function participantes(){
        if($this->direccion == 'Direccion General'){
            $query = DB::table('sinfodi_evaluacion_general')
                        ->select('clave', 'nombre', 'direccion')
                        ->where('year', '=', $this->year)
                        ->where('total_puntos', '<>', 0.00)
                        ->distinct()
                        ->get();
        }
        return $query;
    }



}
