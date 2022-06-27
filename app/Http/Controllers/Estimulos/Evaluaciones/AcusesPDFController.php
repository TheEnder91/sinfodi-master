<?php

namespace App\Http\Controllers\Estimulos\Evaluaciones;

use PDF;
use Dompdf\Dompdf;
use Dompdf\Options;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AcusesPDFController extends Controller
{
    const PERMISSIONS = [
        'index' => 'estimulo-evaluaciones-acuses-index',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('estimulos.evaluaciones.acuses.index');
    }

    public function getDirecciones($year, $direccion){
        if($direccion == 'Direccion general'){
            $queryGeneral = DB::table('sinfodi_evaluacion_general')
                        ->select('clave', 'nombre')
                        ->where('year', '=', $year)
                        ->where('total_puntos', '<>', 0.00);
            $queryResponsabilidad = DB::table('sinfodi_evaluacion_responsabilidades')
                                        ->select('clave', 'nombre')
                                        ->where('year', '=', $year)
                                        ->where('responsabilidad', '=', $direccion)
                                        ->unionAll($queryGeneral);
            $queryDireccion = DB::table($queryResponsabilidad)
                                ->select('clave', 'nombre')
                                ->orderBy('clave', 'ASC')
                                ->distinct()
                                ->get();
            return $queryDireccion;
        }elseif($direccion == 'Direccion administracion'){
            $queryAdministracion = DB::table('sinfodi_evaluacion_administracion')
                        ->select('clave', 'nombre')
                        ->where('year', '=', $year)
                        ->where('total_puntos', '<>', 0.00);
            $queryResponsabilidad = DB::table('sinfodi_evaluacion_responsabilidades')
                                        ->select('clave', 'nombre')
                                        ->where('year', '=', $year)
                                        ->where('responsabilidad', '=', $direccion)
                                        ->unionAll($queryAdministracion);
            $queryDireccion = DB::table($queryResponsabilidad)
                                ->select('clave', 'nombre')
                                ->orderBy('clave', 'ASC')
                                ->distinct()
                                ->get();
            return $queryDireccion;
        }elseif($direccion == 'Direccion posgrado'){
            $queryPosgrado = DB::table('sinfodi_evaluacion_posgrado')
                        ->select('clave', 'nombre')
                        ->where('year', '=', $year)
                        ->where('total_puntos', '<>', 0.00);
            $queryResponsabilidad = DB::table('sinfodi_evaluacion_responsabilidades')
                                        ->select('clave', 'nombre')
                                        ->where('year', '=', $year)
                                        ->where('responsabilidad', '=', $direccion)
                                        ->unionAll($queryPosgrado);
            $queryDireccion = DB::table($queryResponsabilidad)
                                ->select('clave', 'nombre')
                                ->orderBy('clave', 'ASC')
                                ->distinct()
                                ->get();
            return $queryDireccion;
        }elseif($direccion == 'Direccion ciencia'){
            $queryCiencia = DB::table('sinfodi_evaluacion_ciencia')
                        ->select('clave', 'nombre')
                        ->where('year', '=', $year)
                        ->where('total_puntos', '<>', 0.00);
            $queryResponsabilidad = DB::table('sinfodi_evaluacion_responsabilidades')
                                        ->select('clave', 'nombre')
                                        ->where('year', '=', $year)
                                        ->where('responsabilidad', '=', $direccion)
                                        ->unionAll($queryCiencia);
            $queryDireccion = DB::table($queryResponsabilidad)
                                ->select('clave', 'nombre')
                                ->groupBy('clave', 'nombre')
                                ->orderBy('clave', 'ASC')
                                ->get();
            return $queryDireccion;
        }elseif($direccion == 'Direccion servicios'){
            $queryServicios = DB::table('sinfodi_evaluacion_serv_tecno')
                        ->select('clave', 'nombre')
                        ->where('year', '=', $year)
                        ->where('total_puntos', '<>', 0.00);
            $queryResponsabilidad = DB::table('sinfodi_evaluacion_responsabilidades')
                                        ->select('clave', 'nombre')
                                        ->where('year', '=', $year)
                                        ->where('responsabilidad', '=', $direccion)
                                        ->unionAll($queryServicios);
            $queryDireccion = DB::table($queryResponsabilidad)
                                ->select('clave', 'nombre')
                                ->groupBy('clave', 'nombre')
                                ->orderBy('clave', 'ASC')
                                ->get();
            return $queryDireccion;
        }elseif($direccion == 'Direccion tecnologia'){
            $queryServicios = DB::table('sinfodi_evaluacion_proy_tecno')
                        ->select('clave', 'nombre')
                        ->where('year', '=', $year)
                        ->where('total_puntos', '<>', 0.00);
            $queryResponsabilidad = DB::table('sinfodi_evaluacion_responsabilidades')
                                        ->select('clave', 'nombre')
                                        ->where('year', '=', $year)
                                        ->where('responsabilidad', '=', $direccion)
                                        ->unionAll($queryServicios);
            $queryDireccion = DB::table($queryResponsabilidad)
                                ->select('clave', 'nombre')
                                ->groupBy('clave', 'nombre')
                                ->orderBy('clave', 'ASC')
                                ->get();
            return $queryDireccion;
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function generarAcuse($direccion, $nombre, $clave, $year)
    {
        // $personal = DB::table('sinfodi_evaluados')
        //                 ->select('clave', 'nombre', 'usuario')
        //                 ->where('usuario', '=', $username)
        //                 ->get();
        // return view('estimulos.evaluaciones.acuses.acuses', [
        //     'usuario' => $username,
        // ]);
        $dompdf = resolve('dompdf.wrapper');
        $dompdf->loadView('estimulos.evaluaciones.acuses.acuses', [
            'direccion' => $direccion,
            'nombre' => $nombre,
            'clave' => $clave,
            'year' => $year,
        ]);
        return $dompdf->download();
        // $pdf=new FPDF();
        // $pdf->AddPage();
        // $pdf->SetFont('Arial', 'B', 16);
        // $pdf->Cell(40, 10, iconv('UTF-8', 'ISO-8859-2', 'Hola Mundo!'), 1);
        // $pdf->Output();
    }
}
