<?php

namespace App\Http\Controllers\Estimulos\Evaluaciones;

use Dompdf\Dompdf;
use Barryvdh\DomPDF\PDF;
use App\Traits\SingleResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class AcusesPDFController extends Controller
{
    const PERMISSIONS = [
        'index' => 'estimulo-evaluaciones-acuses-index',
    ];

    use SingleResponse;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('estimulos.evaluaciones.acuses.index');
    }

    public function criterios(){
        $sqlQuery = DB::table('criterios')
                        ->where('observaciones', '=', 'Tabla 1. Actividad A.')
                        ->get();
        return $sqlQuery;
    }

    public function getDirecciones($year, $direccion, $grupo){
        $responsabilidades = DB::table('sinfodi_evaluacion_responsabilidades')
                                ->select('clave')
                                ->where('year', $year)
                                ->whereRaw('(direccion = "Coordinadores" OR direccion = "Personal_Apoyo")')
                                ->distinct()
                                ->get();
        foreach ($responsabilidades as $itemResponsabilidad){
            $datos[] = [
                'clave' => $itemResponsabilidad->clave,
            ];
        }
        if($grupo == 'grupo1'){
            if($direccion == 'Direccion General'){
                $query = DB::table('sinfodi_evaluacion_general')
                            ->select('clave', 'nombre', 'direccion', 'username')
                            ->where('year', '=', $year)
                            // ->whereNotIn('clave', $datos)
                            ->distinct()
                            ->get();
            }else if($direccion == 'Direccion Administracion'){
                // $query = DB::table('sinfodi_evaluacion_administracion')
                //             ->select('clave', 'nombre', 'direccion', 'username')
                //             ->where('year', '=', $year)
                //             ->distinct()
                //             ->get();
                $query = [];
            }else if($direccion == 'Direccion Posgrado'){
                $query = DB::table('sinfodi_evaluacion_posgrado')
                            ->select('clave', 'nombre', 'direccion', 'username')
                            ->where('year', '=', $year)
                            ->where('total_puntos', '<>', 0.00)
                            // ->whereNotIn('clave', $datos)
                            ->distinct()
                            ->get();
            }else if($direccion == 'Direccion Ciencia'){
                $query = DB::table('sinfodi_evaluacion_ciencia')
                            ->select('clave', 'nombre', 'direccion', 'username')
                            ->where('year', '=', $year)
                            // ->whereNotIn('clave', $datos)
                            ->distinct()
                            ->get();
            }else if($direccion == 'Direccion Servicios'){
                $query = DB::table('sinfodi_evaluacion_serv_tecno')
                            ->select('clave', 'nombre', 'direccion', 'username')
                            ->where('year', '=', $year)
                            // ->whereNotIn('clave', $datos)
                            ->distinct()
                            ->get();
            }else if($direccion == 'Direccion Tecnologia'){
                $query = DB::table('sinfodi_evaluacion_proy_tecno')
                            ->select('clave', 'nombre', 'direccion', 'username')
                            ->where('year', '=', $year)
                            // ->whereNotIn('clave', $datos)
                            ->distinct()
                            ->get();
            }
        }elseif($grupo == 'grupo2'){
            $query = DB::table('sinfodi_evaluacion_responsabilidades')
                        ->select('clave', 'nombre', 'direccion', 'responsabilidad', 'username')
                        ->where('year', '=', $year)
                        // ->whereNotIn('clave', $datos)
                        ->distinct()
                        ->get();
        }else{
            $query = $grupo.'->'.$year.'->'.$direccion;
        }
        $data['response'] = $query;
        return $this->response($data);
    }

    public function consultasCriteriosA($direccion, $clave, $year, $grupo){
        if($grupo == 'grupo1'){
            if($direccion == 'Direccion General'){
                $queryCriterioA = DB::select('
                           SELECT criterios.id AS idCriterio,
                           criterios.nombre AS criterio,
                           criterios.puntos AS puntosCriterio,
                           puntos.puntos AS cantidad,
                           puntos.total_puntos AS totalPuntos
                    FROM sinfodi_criterios criterios
                    LEFT JOIN(
                        SELECT id_criterio, puntos, total_puntos
                        FROM sinfodi_evaluacion_general
                        WHERE sinfodi_evaluacion_general.clave = '.$clave.' AND sinfodi_evaluacion_general.year = '.$year.'
                    ) puntos ON criterios.id = puntos.id_criterio
                    WHERE criterios.observaciones = "Tabla 1. Actividad A."
                    ORDER BY criterios.id ASC
                ');
            }else if($direccion == 'Direccion Administracion'){
                $queryCriterioA = DB::select('
                           SELECT criterios.id AS idCriterio,
                           criterios.nombre AS criterio,
                           criterios.puntos AS puntosCriterio,
                           puntos.puntos AS cantidad,
                           puntos.total_puntos AS totalPuntos
                    FROM sinfodi_criterios criterios
                    LEFT JOIN(
                        SELECT id_criterio, puntos, total_puntos
                        FROM sinfodi_evaluacion_administracion
                        WHERE sinfodi_evaluacion_administracion.clave = '.$clave.' AND sinfodi_evaluacion_administracion.year = '.$year.'
                    ) puntos ON criterios.id = puntos.id_criterio
                    WHERE criterios.observaciones = "Tabla 1. Actividad A."
                    ORDER BY criterios.id ASC
                ');
            }else if($direccion == 'Direccion Posgrado'){
                $queryCriterioA = DB::select('
                           SELECT criterios.id AS idCriterio,
                           criterios.nombre AS criterio,
                           criterios.puntos AS puntosCriterio,
                           puntos.puntos AS cantidad,
                           puntos.total_puntos AS totalPuntos
                    FROM sinfodi_criterios criterios
                    LEFT JOIN(
                        SELECT id_criterio, puntos, total_puntos
                        FROM sinfodi_evaluacion_posgrado
                        WHERE sinfodi_evaluacion_posgrado.clave = '.$clave.' AND sinfodi_evaluacion_posgrado.year = '.$year.'
                    ) puntos ON criterios.id = puntos.id_criterio
                    WHERE criterios.observaciones = "Tabla 1. Actividad A."
                    ORDER BY criterios.id ASC
                ');
            }else if($direccion == 'Direccion Ciencia'){
                $queryCriterioA = DB::select('
                           SELECT criterios.id AS idCriterio,
                           criterios.nombre AS criterio,
                           criterios.puntos AS puntosCriterio,
                           puntos.puntos AS cantidad,
                           puntos.total_puntos AS totalPuntos
                    FROM sinfodi_criterios criterios
                    LEFT JOIN(
                        SELECT id_criterio, puntos, total_puntos
                        FROM sinfodi_evaluacion_ciencia
                        WHERE sinfodi_evaluacion_ciencia.clave = '.$clave.' AND sinfodi_evaluacion_ciencia.year = '.$year.'
                    ) puntos ON criterios.id = puntos.id_criterio
                    WHERE criterios.observaciones = "Tabla 1. Actividad A."
                    ORDER BY criterios.id ASC
                ');
            }else if($direccion == 'Direccion Servicios'){
                $queryCriterioA = DB::select('
                           SELECT criterios.id AS idCriterio,
                           criterios.nombre AS criterio,
                           criterios.puntos AS puntosCriterio,
                           puntos.puntos AS cantidad,
                           puntos.total_puntos AS totalPuntos
                    FROM sinfodi_criterios criterios
                    LEFT JOIN(
                        SELECT id_criterio, puntos, total_puntos
                        FROM sinfodi_evaluacion_serv_tecno
                        WHERE sinfodi_evaluacion_serv_tecno.clave = '.$clave.' AND sinfodi_evaluacion_serv_tecno.year = '.$year.'
                    ) puntos ON criterios.id = puntos.id_criterio
                    WHERE criterios.observaciones = "Tabla 1. Actividad A."
                    ORDER BY criterios.id ASC
                ');
            }else if($direccion == 'Direccion Tecnologia'){
                $queryCriterioA = DB::select('
                           SELECT criterios.id AS idCriterio,
                           criterios.nombre AS criterio,
                           criterios.puntos AS puntosCriterio,
                           puntos.puntos AS cantidad,
                           puntos.total_puntos AS totalPuntos
                    FROM sinfodi_criterios criterios
                    LEFT JOIN(
                        SELECT id_criterio, puntos, total_puntos
                        FROM sinfodi_evaluacion_proy_tecno
                        WHERE sinfodi_evaluacion_proy_tecno.clave = '.$clave.' AND sinfodi_evaluacion_proy_tecno.year = '.$year.'
                    ) puntos ON criterios.id = puntos.id_criterio
                    WHERE criterios.observaciones = "Tabla 1. Actividad A."
                    ORDER BY criterios.id ASC
                ');
            }
            return $queryCriterioA;
        }else{
            return "";
        }
    }

    public function consultasCriteriosB($direccion, $clave, $year, $grupo){
        if($grupo == 'grupo1'){
            if($direccion == 'Direccion General'){
                $queryCriterioB = DB::select('
                           SELECT criterios.id AS idCriterio,
                           criterios.nombre AS criterio,
                           criterios.puntos AS puntosCriterio,
                           puntos.puntos AS cantidad,
                           puntos.total_puntos AS totalPuntos
                    FROM sinfodi_criterios criterios
                    LEFT JOIN(
                        SELECT id_criterio, puntos, total_puntos
                        FROM sinfodi_evaluacion_general
                        WHERE sinfodi_evaluacion_general.clave = '.$clave.' AND sinfodi_evaluacion_general.year = '.$year.'
                    ) puntos ON criterios.id = puntos.id_criterio
                    WHERE criterios.observaciones = "Tabla 1. Actividad B."
                    ORDER BY criterios.id ASC
                ');
            }else if($direccion == 'Direccion Administracion'){
                $queryCriterioB = DB::select('
                           SELECT criterios.id AS idCriterio,
                           criterios.nombre AS criterio,
                           criterios.puntos AS puntosCriterio,
                           puntos.puntos AS cantidad,
                           puntos.total_puntos AS totalPuntos
                    FROM sinfodi_criterios criterios
                    LEFT JOIN(
                        SELECT id_criterio, puntos, total_puntos
                        FROM sinfodi_evaluacion_administracion
                        WHERE sinfodi_evaluacion_administracion.clave = '.$clave.' AND sinfodi_evaluacion_administracion.year = '.$year.'
                    ) puntos ON criterios.id = puntos.id_criterio
                    WHERE criterios.observaciones = "Tabla 1. Actividad B."
                    ORDER BY criterios.id ASC
                ');
            }else if($direccion == 'Direccion Posgrado'){
                $queryCriterioB = DB::select('
                           SELECT criterios.id AS idCriterio,
                           criterios.nombre AS criterio,
                           criterios.puntos AS puntosCriterio,
                           puntos.puntos AS cantidad,
                           puntos.total_puntos AS totalPuntos
                    FROM sinfodi_criterios criterios
                    LEFT JOIN(
                        SELECT id_criterio, puntos, total_puntos
                        FROM sinfodi_evaluacion_posgrado
                        WHERE sinfodi_evaluacion_posgrado.clave = '.$clave.' AND sinfodi_evaluacion_posgrado.year = '.$year.'
                    ) puntos ON criterios.id = puntos.id_criterio
                    WHERE criterios.observaciones = "Tabla 1. Actividad B."
                    ORDER BY criterios.id ASC
                ');
            }else if($direccion == 'Direccion Ciencia'){
                $queryCriterioB = DB::select('
                           SELECT criterios.id AS idCriterio,
                           criterios.nombre AS criterio,
                           criterios.puntos AS puntosCriterio,
                           puntos.puntos AS cantidad,
                           puntos.total_puntos AS totalPuntos
                    FROM sinfodi_criterios criterios
                    LEFT JOIN(
                        SELECT id_criterio, puntos, total_puntos
                        FROM sinfodi_evaluacion_ciencia
                        WHERE sinfodi_evaluacion_ciencia.clave = '.$clave.' AND sinfodi_evaluacion_ciencia.year = '.$year.'
                    ) puntos ON criterios.id = puntos.id_criterio
                    WHERE criterios.observaciones = "Tabla 1. Actividad B."
                    ORDER BY criterios.id ASC
                ');
            }else if($direccion == 'Direccion Servicios'){
                $queryCriterioB = DB::select('
                           SELECT criterios.id AS idCriterio,
                           criterios.nombre AS criterio,
                           criterios.puntos AS puntosCriterio,
                           puntos.puntos AS cantidad,
                           puntos.total_puntos AS totalPuntos
                    FROM sinfodi_criterios criterios
                    LEFT JOIN(
                        SELECT id_criterio, puntos, total_puntos
                        FROM sinfodi_evaluacion_serv_tecno
                        WHERE sinfodi_evaluacion_serv_tecno.clave = '.$clave.' AND sinfodi_evaluacion_serv_tecno.year = '.$year.'
                    ) puntos ON criterios.id = puntos.id_criterio
                    WHERE criterios.observaciones = "Tabla 1. Actividad B."
                    ORDER BY criterios.id ASC
                ');
            }else if($direccion == 'Direccion Tecnologia'){
                $queryCriterioB = DB::select('
                           SELECT criterios.id AS idCriterio,
                           criterios.nombre AS criterio,
                           criterios.puntos AS puntosCriterio,
                           puntos.puntos AS cantidad,
                           puntos.total_puntos AS totalPuntos
                    FROM sinfodi_criterios criterios
                    LEFT JOIN(
                        SELECT id_criterio, puntos, total_puntos
                        FROM sinfodi_evaluacion_proy_tecno
                        WHERE sinfodi_evaluacion_proy_tecno.clave = '.$clave.' AND sinfodi_evaluacion_proy_tecno.year = '.$year.'
                    ) puntos ON criterios.id = puntos.id_criterio
                    WHERE criterios.observaciones = "Tabla 1. Actividad B."
                    ORDER BY criterios.id ASC
                ');
            }
            return $queryCriterioB;
        }else{
            return "";
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function generarAcuse($direccion, $nombre, $clave, $year, $grupo){
        $nombreDoc = $clave."_".$nombre.".pdf";
        $dompdf = \App::make("dompdf.wrapper");
        if($grupo == 'grupo1'){
            $sumaTotalPuntosA = self::getSumaTotalPuntosA($year, $clave, $direccion);
            $sumaTotalPuntosB = self::getSumaTotalPuntosB($year, $clave, $direccion);
            $valoPuntoProductividad = self::getValorPuntoProductividad($year);
            $html = view('estimulos.evaluaciones.acuses.acuses', [
                'clave' => $clave,
                'nombre' => $nombre,
                'grupo' => $grupo,
                'año' => $year,
                'criteriosA' => self::consultasCriteriosA($direccion, $clave, $year, $grupo),
                'criteriosB' => self::consultasCriteriosB($direccion, $clave, $year, $grupo),
                'sumaTotalPuntosA' => $sumaTotalPuntosA,
                'sumaTotalPuntosB' => $sumaTotalPuntosB,
                'valorPuntoProductividad' => $valoPuntoProductividad,
            ]);
            $dompdf->loadHtml($html);
            return $dompdf->stream($nombreDoc);
        }elseif($grupo == 'grupo2'){
            $tipoResponsabilidad = self::getTipoResponsabilidad($clave, $year);
            $nivelResponsabilidad = self::getNivelResponsabilidad($clave, $year);
            $puntaje = self::getPuntosResponsabilidad($clave, $year);
            $nivelImpacto = self::getNivelImpacto('Medio');
            $valoPuntoResponsabilidad = self::getValorPuntoResponsabilidad($year);
            $html = view('estimulos.evaluaciones.acuses.acuses', [
                'clave' => $clave,
                'nombre' => $nombre,
                'grupo' => $grupo,
                'puntajeResponsabilidad' => $puntaje,
                'nivelResponsabilidad' => $nivelResponsabilidad,
                'tipoResonsabilidad' => $tipoResponsabilidad,
                'nivelImpacto' => $nivelImpacto,
                'valorPuntoResponsabilidad' => $valoPuntoResponsabilidad,
            ]);
            $dompdf->loadHtml($html);
            return $dompdf->stream($nombreDoc);
        }
        // $html = view('estimulos.evaluaciones.acuses.acuses', [
        //     'direccion' => $direccion,
        //     'clave' => $clave,
        //     'nombre' => $nombre,
        //     'grupo' => $grupo,
        //     // 'criteriosA' => self::consultasCriteriosA($direccion, $clave, $year, $grupo),
        //     // 'criteriosB' => self::consultasCriteriosB($direccion, $clave, $year, $grupo),
        // ])->render();
        // $dompdf->loadHtml($html);
        // return $dompdf->stream();($nombreDoc);
    }

    public function getTipoResponsabilidad($clave, $year){
        $query = DB::table('sinfodi_evaluacion_responsabilidades')
                    ->where('clave', $clave)
                    ->where('year', $year)
                    ->value('direccion');
        return $query;
    }

    public function getPuntosResponsabilidad($clave, $year){
        $query = DB::table('sinfodi_evaluacion_responsabilidades')
                    ->where('clave', $clave)
                    ->where('year', $year)
                    ->value('puntos');
        return $query;
    }

    public function getNivelResponsabilidad($clave, $year){
        $query = DB::table('sinfodi_evaluacion_responsabilidades')
                    ->where('clave', $clave)
                    ->where('year', $year)
                    ->value('responsabilidad');
        return $query;
    }

    public function getNivelImpacto($nivel){
        $query = DB::table('sinfodi_impacto')
                    ->where('nivel', $nivel)
                    ->value('factor');
        return $query;
    }

    public function getValorPuntoResponsabilidad($year){
        $query = DB::table('sinfodi_total_puntos')
                    ->where('year', $year)
                    ->value('valor_punto_responsabilidad');
        return $query;
    }

    public function getValorPuntoProductividad($year){
        $query = DB::table('sinfodi_total_puntos')
                    ->where('year', $year)
                    ->value('valor_punto_actividades');
        return $query;
    }

    public function getSumaTotalPuntosA($year, $clave, $direccion){
        if($direccion == 'Direccion General'){
            $query = DB::table('sinfodi_evaluacion_general')
                        ->selectRaw('SUM(total_puntos) AS total_puntos')
                        ->where('clave', $clave)
                        ->where('year', $year)
                        ->whereBetween('id_criterio', [1, 35])
                        ->value('total_puntos');
        }else if($direccion == 'Direccion Administracion'){
            $query = DB::table('sinfodi_evaluacion_administracion')
                        ->selectRaw('SUM(total_puntos) AS total_puntos')
                        ->where('clave', $clave)
                        ->where('year', $year)
                        ->whereBetween('id_criterio', [1, 35])
                        ->value('total_puntos');
        }else if($direccion == 'Direccion Posgrado'){
            $query = DB::table('sinfodi_evaluacion_posgrado')
                        ->selectRaw('SUM(total_puntos) AS total_puntos')
                        ->where('clave', $clave)
                        ->where('year', $year)
                        ->whereBetween('id_criterio', [1, 35])
                        ->value('total_puntos');
        }else if($direccion == 'Direccion Ciencia'){
            $query = DB::table('sinfodi_evaluacion_ciencia')
                        ->selectRaw('SUM(total_puntos) AS total_puntos')
                        ->where('clave', $clave)
                        ->where('year', $year)
                        ->whereBetween('id_criterio', [1, 35])
                        ->value('total_puntos');
        }else if($direccion == 'Direccion Servicios'){
            $query = DB::table('sinfodi_evaluacion_serv_tecno')
                        ->selectRaw('SUM(total_puntos) AS total_puntos')
                        ->where('clave', $clave)
                        ->where('year', $year)
                        ->whereBetween('id_criterio', [1, 35])
                        ->value('total_puntos');
        }else if($direccion == 'Direccion Tecnologia'){
            $query = DB::table('sinfodi_evaluacion_proy_tecno')
                        ->selectRaw('SUM(total_puntos) AS total_puntos')
                        ->where('clave', $clave)
                        ->where('year', $year)
                        ->whereBetween('id_criterio', [1, 35])
                        ->value('total_puntos');
        }
        return $query;
    }

    public function getSumaTotalPuntosB($year, $clave, $direccion){
        if($direccion == 'Direccion General'){
            $query = DB::table('sinfodi_evaluacion_general')
                        ->selectRaw('SUM(total_puntos) AS total_puntos')
                        ->where('clave', $clave)
                        ->where('year', $year)
                        ->whereBetween('id_criterio', [36, 41])
                        ->value('total_puntos');
        }else if($direccion == 'Direccion Administracion'){
            $query = DB::table('sinfodi_evaluacion_administracion')
                        ->selectRaw('SUM(total_puntos) AS total_puntos')
                        ->where('clave', $clave)
                        ->where('year', $year)
                        ->whereBetween('id_criterio', [36, 41])
                        ->value('total_puntos');
        }else if($direccion == 'Direccion Posgrado'){
            $query = DB::table('sinfodi_evaluacion_posgrado')
                        ->selectRaw('SUM(total_puntos) AS total_puntos')
                        ->where('clave', $clave)
                        ->where('year', $year)
                        ->whereBetween('id_criterio', [36, 41])
                        ->value('total_puntos');
        }else if($direccion == 'Direccion Ciencia'){
            $query = DB::table('sinfodi_evaluacion_ciencia')
                        ->selectRaw('SUM(total_puntos) AS total_puntos')
                        ->where('clave', $clave)
                        ->where('year', $year)
                        ->whereBetween('id_criterio', [36, 41])
                        ->value('total_puntos');
        }else if($direccion == 'Direccion Servicios'){
            $query = DB::table('sinfodi_evaluacion_serv_tecno')
                        ->selectRaw('SUM(total_puntos) AS total_puntos')
                        ->where('clave', $clave)
                        ->where('year', $year)
                        ->whereBetween('id_criterio', [36, 41])
                        ->value('total_puntos');
        }else if($direccion == 'Direccion Tecnologia'){
            $query = DB::table('sinfodi_evaluacion_proy_tecno')
                        ->selectRaw('SUM(total_puntos) AS total_puntos')
                        ->where('clave', $clave)
                        ->where('year', $year)
                        ->whereBetween('id_criterio', [36, 41])
                        ->value('total_puntos');
        }
        return $query;
    }

        // if($direccion == 'Direccion General'){
        //     $queryResumen = DB::select('
        //                 SELECT sinfodi_evaluados.clave AS clave,
        //                 sinfodi_evaluados.nombre AS nombre,
        //                 sinfodi_evaluacion_responsabilidades.puntos AS puntos,
        //                 sinfodi_recursos_propios.recursos_propios AS recursos_propios,
        //                 sinfodi_fondos_administracion.fondos_admin AS fondos_admin,
        //                 (SELECT SUM(total_puntos) * 0.3 FROM sinfodi_evaluacion_general WHERE year='.$year.' AND clave = '.$clave.' AND (id_criterio BETWEEN 1 AND 35)) AS puntosA,
        //                 (SELECT SUM(total_puntos) * 0.7 FROM sinfodi_evaluacion_general WHERE year='.$year.' AND clave = '.$clave.' AND (id_criterio BETWEEN 36 AND 41)) AS puntosB,
        //                 sinfodi_total_puntos.valor_punto_actividades AS valorPunto,
        //                 sinfodi_total_puntos.valor_punto_responsabilidad AS valorResponsabilidad
        //         FROM sinfodi_evaluados
        //         LEFT OUTER JOIN sinfodi_evaluacion_responsabilidades ON sinfodi_evaluacion_responsabilidades.username = sinfodi_evaluados.usuario AND sinfodi_evaluacion_responsabilidades.year = '.$year.'
        //         LEFT OUTER JOIN sinfodi_recursos_propios ON sinfodi_recursos_propios.id_direccion = 1 AND sinfodi_recursos_propios.year = '.$year.'
        //         LEFT OUTER JOIN sinfodi_fondos_administracion ON sinfodi_fondos_administracion.id_direccion = 1 AND sinfodi_fondos_administracion.year = '.$year.'
        //         LEFT OUTER JOIN sinfodi_total_puntos ON sinfodi_total_puntos.year = '.$year.'
        //         WHERE sinfodi_evaluados.clave = '.$clave.'
        //         LIMIT 1
        //     ');
        //     $queryCriterioA = DB::select('
        //                SELECT criterios.id AS idCriterio,
        //                criterios.nombre AS criterio,
        //                criterios.puntos AS puntosCriterio,
        //                puntos.puntos AS cantidad,
        //                puntos.total_puntos AS totalPuntos
        //         FROM sinfodi_criterios criterios
        //         LEFT JOIN(
        //             SELECT id_criterio, puntos, total_puntos
        //             FROM sinfodi_evaluacion_general
        //             WHERE sinfodi_evaluacion_general.clave = '.$clave.' AND sinfodi_evaluacion_general.year = '.$year.'
        //         ) puntos ON criterios.id = puntos.id_criterio
        //         WHERE criterios.observaciones = "Tabla 1. Actividad A."
        //         ORDER BY criterios.id ASC
        //     ');
        //     $querySumaA = DB::select('
        //         SELECT SUM(total_puntos) AS sumaA
        //         FROM sinfodi_evaluacion_general
        //         WHERE clave = '.$clave.' AND year = '.$year.' AND (id_criterio BETWEEN 1 AND 35)
        //     ');
        //     $queryCriterioB = DB::select('
        //                SELECT criterios.id AS idCriterio,
        //                criterios.nombre AS criterio,
        //                criterios.puntos AS puntosCriterio,
        //                puntos.puntos AS cantidad,
        //                puntos.total_puntos AS totalPuntos
        //         FROM sinfodi_criterios criterios
        //         LEFT JOIN(
        //             SELECT id_criterio, puntos, total_puntos
        //             FROM sinfodi_evaluacion_general
        //             WHERE sinfodi_evaluacion_general.clave = '.$clave.' AND sinfodi_evaluacion_general.year = '.$year.'
        //         ) puntos ON criterios.id = puntos.id_criterio
        //         WHERE criterios.observaciones = "Tabla 1. Actividad B."
        //         ORDER BY criterios.id ASC
        //     ');
        //     $querySumaB = DB::select('
        //         SELECT SUM(total_puntos) AS sumaB
        //         FROM sinfodi_evaluacion_general
        //         WHERE clave = '.$clave.' AND year = '.$year.' AND (id_criterio BETWEEN 36 AND 41)
        //     ');
        // }elseif($direccion == 'Direccion Administracion'){
        //     $queryResumen = DB::select('
        //                 SELECT sinfodi_evaluados.clave AS clave,
        //                 sinfodi_evaluados.nombre AS nombre,
        //                 sinfodi_evaluacion_responsabilidades.puntos AS puntos,
        //                 sinfodi_recursos_propios.recursos_propios AS recursos_propios,
        //                 sinfodi_fondos_administracion.fondos_admin AS fondos_admin,
        //                 (SELECT SUM(total_puntos) * 0.3 FROM sinfodi_evaluacion_administracion WHERE year='.$year.' AND clave = '.$clave.' AND (id_criterio BETWEEN 1 AND 35)) AS puntosA,
        //                 (SELECT SUM(total_puntos) * 0.7 FROM sinfodi_evaluacion_administracion WHERE year='.$year.' AND clave = '.$clave.' AND (id_criterio BETWEEN 36 AND 41)) AS puntosB,
        //                 sinfodi_total_puntos.valor_punto_actividades AS valorPunto,
        //                 sinfodi_total_puntos.valor_punto_responsabilidad AS valorResponsabilidad
        //         FROM sinfodi_evaluados
        //         LEFT OUTER JOIN sinfodi_evaluacion_responsabilidades ON sinfodi_evaluacion_responsabilidades.username = sinfodi_evaluados.usuario AND sinfodi_evaluacion_responsabilidades.year = '.$year.'
        //         LEFT OUTER JOIN sinfodi_recursos_propios ON sinfodi_recursos_propios.id_direccion = 2 AND sinfodi_recursos_propios.year = '.$year.'
        //         LEFT OUTER JOIN sinfodi_fondos_administracion ON sinfodi_fondos_administracion.id_direccion = 2 AND sinfodi_fondos_administracion.year = '.$year.'
        //         LEFT OUTER JOIN sinfodi_total_puntos ON sinfodi_total_puntos.year = '.$year.'
        //         WHERE sinfodi_evaluados.clave = '.$clave.'
        //         LIMIT 1
        //     ');
        //     $queryCriterioA = DB::select('
        //                SELECT criterios.id AS idCriterio,
        //                criterios.nombre AS criterio,
        //                criterios.puntos AS puntosCriterio,
        //                puntos.puntos AS cantidad,
        //                puntos.total_puntos AS totalPuntos
        //         FROM sinfodi_criterios criterios
        //         LEFT JOIN(
        //             SELECT id_criterio, puntos, total_puntos
        //             FROM sinfodi_evaluacion_administracion
        //             WHERE sinfodi_evaluacion_administracion.clave = '.$clave.' AND sinfodi_evaluacion_administracion.year = '.$year.'
        //         ) puntos ON criterios.id = puntos.id_criterio
        //         WHERE criterios.observaciones = "Tabla 1. Actividad A."
        //         ORDER BY criterios.id ASC
        //     ');
        //     $querySumaA = DB::select('
        //         SELECT SUM(total_puntos) AS sumaA
        //         FROM sinfodi_evaluacion_administracion
        //         WHERE clave = '.$clave.' AND year = '.$year.' AND (id_criterio BETWEEN 1 AND 35)
        //     ');
        //     $queryCriterioB = DB::select('
        //                SELECT criterios.id AS idCriterio,
        //                criterios.nombre AS criterio,
        //                criterios.puntos AS puntosCriterio,
        //                puntos.puntos AS cantidad,
        //                puntos.total_puntos AS totalPuntos
        //         FROM sinfodi_criterios criterios
        //         LEFT JOIN(
        //             SELECT id_criterio, puntos, total_puntos
        //             FROM sinfodi_evaluacion_administracion
        //             WHERE sinfodi_evaluacion_administracion.clave = '.$clave.' AND sinfodi_evaluacion_administracion.year = '.$year.'
        //         ) puntos ON criterios.id = puntos.id_criterio
        //         WHERE criterios.observaciones = "Tabla 1. Actividad B."
        //         ORDER BY criterios.id ASC
        //     ');
        //     $querySumaB = DB::select('
        //         SELECT SUM(total_puntos) AS sumaB
        //         FROM sinfodi_evaluacion_administracion
        //         WHERE clave = '.$clave.' AND year = '.$year.' AND (id_criterio BETWEEN 36 AND 41)
        //     ');
        // }elseif($direccion == 'Direccion Posgrado'){
        //     $queryResumen = DB::select('
        //                 SELECT sinfodi_evaluados.clave AS clave,
        //                 sinfodi_evaluados.nombre AS nombre,
        //                 sinfodi_evaluacion_responsabilidades.puntos AS puntos,
        //                 sinfodi_recursos_propios.recursos_propios AS recursos_propios,
        //                 sinfodi_fondos_administracion.fondos_admin AS fondos_admin,
        //                 (SELECT SUM(total_puntos) * 0.3 FROM sinfodi_evaluacion_posgrado WHERE year='.$year.' AND clave = '.$clave.' AND (id_criterio BETWEEN 1 AND 35)) AS puntosA,
        //                 (SELECT SUM(total_puntos) * 0.7 FROM sinfodi_evaluacion_posgrado WHERE year='.$year.' AND clave = '.$clave.' AND (id_criterio BETWEEN 36 AND 41)) AS puntosB,
        //                 sinfodi_total_puntos.valor_punto_actividades AS valorPunto,
        //                 sinfodi_total_puntos.valor_punto_responsabilidad AS valorResponsabilidad
        //         FROM sinfodi_evaluados
        //         LEFT OUTER JOIN sinfodi_evaluacion_responsabilidades ON sinfodi_evaluacion_responsabilidades.username = sinfodi_evaluados.usuario AND sinfodi_evaluacion_responsabilidades.year = '.$year.'
        //         LEFT OUTER JOIN sinfodi_recursos_propios ON sinfodi_recursos_propios.id_direccion = 3 AND sinfodi_recursos_propios.year = '.$year.'
        //         LEFT OUTER JOIN sinfodi_fondos_administracion ON sinfodi_fondos_administracion.id_direccion = 3 AND sinfodi_fondos_administracion.year = '.$year.'
        //         LEFT OUTER JOIN sinfodi_total_puntos ON sinfodi_total_puntos.year = '.$year.'
        //         WHERE sinfodi_evaluados.clave = '.$clave.'
        //         LIMIT 1
        //     ');
        //     $queryCriterioA = DB::select('
        //                SELECT criterios.id AS idCriterio,
        //                criterios.nombre AS criterio,
        //                criterios.puntos AS puntosCriterio,
        //                puntos.puntos AS cantidad,
        //                puntos.total_puntos AS totalPuntos
        //         FROM sinfodi_criterios criterios
        //         LEFT JOIN(
        //             SELECT id_criterio, puntos, total_puntos
        //             FROM sinfodi_evaluacion_posgrado
        //             WHERE sinfodi_evaluacion_posgrado.clave = '.$clave.' AND sinfodi_evaluacion_posgrado.year = '.$year.'
        //         ) puntos ON criterios.id = puntos.id_criterio
        //         WHERE criterios.observaciones = "Tabla 1. Actividad A."
        //         ORDER BY criterios.id ASC
        //     ');
        //     $querySumaA = DB::select('
        //         SELECT SUM(total_puntos) AS sumaA
        //         FROM sinfodi_evaluacion_posgrado
        //         WHERE clave = '.$clave.' AND year = '.$year.' AND (id_criterio BETWEEN 1 AND 35)
        //     ');
        //     $queryCriterioB = DB::select('
        //                SELECT criterios.id AS idCriterio,
        //                criterios.nombre AS criterio,
        //                criterios.puntos AS puntosCriterio,
        //                puntos.puntos AS cantidad,
        //                puntos.total_puntos AS totalPuntos
        //         FROM sinfodi_criterios criterios
        //         LEFT JOIN(
        //             SELECT id_criterio, puntos, total_puntos
        //             FROM sinfodi_evaluacion_posgrado
        //             WHERE sinfodi_evaluacion_posgrado.clave = '.$clave.' AND sinfodi_evaluacion_posgrado.year = '.$year.'
        //         ) puntos ON criterios.id = puntos.id_criterio
        //         WHERE criterios.observaciones = "Tabla 1. Actividad B."
        //         ORDER BY criterios.id ASC
        //     ');
        //     $querySumaB = DB::select('
        //         SELECT SUM(total_puntos) AS sumaB
        //         FROM sinfodi_evaluacion_posgrado
        //         WHERE clave = '.$clave.' AND year = '.$year.' AND (id_criterio BETWEEN 36 AND 41)
        //     ');
        // }elseif($direccion == 'Direccion Ciencia'){
        //     $queryResumen = DB::select('
        //                 SELECT sinfodi_evaluados.clave AS clave,
        //                 sinfodi_evaluados.nombre AS nombre,
        //                 sinfodi_evaluacion_responsabilidades.puntos AS puntos,
        //                 sinfodi_recursos_propios.recursos_propios AS recursos_propios,
        //                 sinfodi_fondos_administracion.fondos_admin AS fondos_admin,
        //                 (SELECT SUM(total_puntos) * 0.3 FROM sinfodi_evaluacion_ciencia WHERE year='.$year.' AND clave = '.$clave.' AND (id_criterio BETWEEN 1 AND 35)) AS puntosA,
        //                 (SELECT SUM(total_puntos) * 0.7 FROM sinfodi_evaluacion_ciencia WHERE year='.$year.' AND clave = '.$clave.' AND (id_criterio BETWEEN 36 AND 41)) AS puntosB,
        //                 sinfodi_total_puntos.valor_punto_actividades AS valorPunto,
        //                 sinfodi_total_puntos.valor_punto_responsabilidad AS valorResponsabilidad
        //         FROM sinfodi_evaluados
        //         LEFT OUTER JOIN sinfodi_evaluacion_responsabilidades ON sinfodi_evaluacion_responsabilidades.username = sinfodi_evaluados.usuario AND sinfodi_evaluacion_responsabilidades.year = '.$year.'
        //         LEFT OUTER JOIN sinfodi_recursos_propios ON sinfodi_recursos_propios.id_direccion = 4 AND sinfodi_recursos_propios.year = '.$year.'
        //         LEFT OUTER JOIN sinfodi_fondos_administracion ON sinfodi_fondos_administracion.id_direccion = 4 AND sinfodi_fondos_administracion.year = '.$year.'
        //         LEFT OUTER JOIN sinfodi_total_puntos ON sinfodi_total_puntos.year = '.$year.'
        //         WHERE sinfodi_evaluados.clave = '.$clave.'
        //         LIMIT 1
        //     ');
        //     $queryCriterioA = DB::select('
        //                SELECT criterios.id AS idCriterio,
        //                criterios.nombre AS criterio,
        //                criterios.puntos AS puntosCriterio,
        //                puntos.puntos AS cantidad,
        //                puntos.total_puntos AS totalPuntos
        //         FROM sinfodi_criterios criterios
        //         LEFT JOIN(
        //             SELECT id_criterio, puntos, total_puntos
        //             FROM sinfodi_evaluacion_ciencia
        //             WHERE sinfodi_evaluacion_ciencia.clave = '.$clave.' AND sinfodi_evaluacion_ciencia.year = '.$year.'
        //         ) puntos ON criterios.id = puntos.id_criterio
        //         WHERE criterios.observaciones = "Tabla 1. Actividad A."
        //         ORDER BY criterios.id ASC
        //     ');
        //     $querySumaA = DB::select('
        //         SELECT SUM(total_puntos) AS sumaA
        //         FROM sinfodi_evaluacion_ciencia
        //         WHERE clave = '.$clave.' AND year = '.$year.' AND (id_criterio BETWEEN 1 AND 35)
        //     ');
        //     $queryCriterioB = DB::select('
        //                SELECT criterios.id AS idCriterio,
        //                criterios.nombre AS criterio,
        //                criterios.puntos AS puntosCriterio,
        //                puntos.puntos AS cantidad,
        //                puntos.total_puntos AS totalPuntos
        //         FROM sinfodi_criterios criterios
        //         LEFT JOIN(
        //             SELECT id_criterio, puntos, total_puntos
        //             FROM sinfodi_evaluacion_ciencia
        //             WHERE sinfodi_evaluacion_ciencia.clave = '.$clave.' AND sinfodi_evaluacion_ciencia.year = '.$year.'
        //         ) puntos ON criterios.id = puntos.id_criterio
        //         WHERE criterios.observaciones = "Tabla 1. Actividad B."
        //         ORDER BY criterios.id ASC
        //     ');
        //     $querySumaB = DB::select('
        //         SELECT SUM(total_puntos) AS sumaB
        //         FROM sinfodi_evaluacion_ciencia
        //         WHERE clave = '.$clave.' AND year = '.$year.' AND (id_criterio BETWEEN 36 AND 41)
        //     ');
        // }elseif($direccion == 'Direccion Servicios'){
        //     $queryResumen = DB::select('
        //                 SELECT sinfodi_evaluados.clave AS clave,
        //                 sinfodi_evaluados.nombre AS nombre,
        //                 sinfodi_evaluacion_responsabilidades.puntos AS puntos,
        //                 sinfodi_recursos_propios.recursos_propios AS recursos_propios,
        //                 sinfodi_fondos_administracion.fondos_admin AS fondos_admin,
        //                 (SELECT SUM(total_puntos) * 0.3 FROM sinfodi_evaluacion_serv_tecno WHERE year='.$year.' AND clave = '.$clave.' AND (id_criterio BETWEEN 1 AND 35)) AS puntosA,
        //                 (SELECT SUM(total_puntos) * 0.7 FROM sinfodi_evaluacion_serv_tecno WHERE year='.$year.' AND clave = '.$clave.' AND (id_criterio BETWEEN 36 AND 41)) AS puntosB,
        //                 sinfodi_total_puntos.valor_punto_actividades AS valorPunto,
        //                 sinfodi_total_puntos.valor_punto_responsabilidad AS valorResponsabilidad
        //         FROM sinfodi_evaluados
        //         LEFT OUTER JOIN sinfodi_evaluacion_responsabilidades ON sinfodi_evaluacion_responsabilidades.username = sinfodi_evaluados.usuario AND sinfodi_evaluacion_responsabilidades.year = '.$year.'
        //         LEFT OUTER JOIN sinfodi_recursos_propios ON sinfodi_recursos_propios.id_direccion = 5 AND sinfodi_recursos_propios.year = '.$year.'
        //         LEFT OUTER JOIN sinfodi_fondos_administracion ON sinfodi_fondos_administracion.id_direccion = 5 AND sinfodi_fondos_administracion.year = '.$year.'
        //         LEFT OUTER JOIN sinfodi_total_puntos ON sinfodi_total_puntos.year = '.$year.'
        //         WHERE sinfodi_evaluados.clave = '.$clave.'
        //         LIMIT 1
        //     ');
        //     $queryCriterioA = DB::select('
        //                SELECT criterios.id AS idCriterio,
        //                criterios.nombre AS criterio,
        //                criterios.puntos AS puntosCriterio,
        //                puntos.puntos AS cantidad,
        //                puntos.total_puntos AS totalPuntos
        //         FROM sinfodi_criterios criterios
        //         LEFT JOIN(
        //             SELECT id_criterio, puntos, total_puntos
        //             FROM sinfodi_evaluacion_serv_tecno
        //             WHERE sinfodi_evaluacion_serv_tecno.clave = '.$clave.' AND sinfodi_evaluacion_serv_tecno.year = '.$year.'
        //         ) puntos ON criterios.id = puntos.id_criterio
        //         WHERE criterios.observaciones = "Tabla 1. Actividad A."
        //         ORDER BY criterios.id ASC
        //     ');
        //     $querySumaA = DB::select('
        //         SELECT SUM(total_puntos) AS sumaA
        //         FROM sinfodi_evaluacion_serv_tecno
        //         WHERE clave = '.$clave.' AND year = '.$year.' AND (id_criterio BETWEEN 1 AND 35)
        //     ');
        //     $queryCriterioB = DB::select('
        //                SELECT criterios.id AS idCriterio,
        //                criterios.nombre AS criterio,
        //                criterios.puntos AS puntosCriterio,
        //                puntos.puntos AS cantidad,
        //                puntos.total_puntos AS totalPuntos
        //         FROM sinfodi_criterios criterios
        //         LEFT JOIN(
        //             SELECT id_criterio, puntos, total_puntos
        //             FROM sinfodi_evaluacion_serv_tecno
        //             WHERE sinfodi_evaluacion_serv_tecno.clave = '.$clave.' AND sinfodi_evaluacion_serv_tecno.year = '.$year.'
        //         ) puntos ON criterios.id = puntos.id_criterio
        //         WHERE criterios.observaciones = "Tabla 1. Actividad B."
        //         ORDER BY criterios.id ASC
        //     ');
        //     $querySumaB = DB::select('
        //         SELECT SUM(total_puntos) AS sumaB
        //         FROM sinfodi_evaluacion_serv_tecno
        //         WHERE clave = '.$clave.' AND year = '.$year.' AND (id_criterio BETWEEN 36 AND 41)
        //     ');
        // }elseif($direccion == 'Direccion Tecnologia'){
        //     $queryResumen = DB::select('
        //                 SELECT sinfodi_evaluados.clave AS clave,
        //                 sinfodi_evaluados.nombre AS nombre,
        //                 sinfodi_evaluacion_responsabilidades.puntos AS puntos,
        //                 sinfodi_recursos_propios.recursos_propios AS recursos_propios,
        //                 sinfodi_fondos_administracion.fondos_admin AS fondos_admin,
        //                 (SELECT SUM(total_puntos) * 0.3 FROM sinfodi_evaluacion_proy_tecno WHERE year='.$year.' AND clave = '.$clave.' AND (id_criterio BETWEEN 1 AND 35)) AS puntosA,
        //                 (SELECT SUM(total_puntos) * 0.7 FROM sinfodi_evaluacion_proy_tecno WHERE year='.$year.' AND clave = '.$clave.' AND (id_criterio BETWEEN 36 AND 41)) AS puntosB,
        //                 sinfodi_total_puntos.valor_punto_actividades AS valorPunto,
        //                 sinfodi_total_puntos.valor_punto_responsabilidad AS valorResponsabilidad
        //         FROM sinfodi_evaluados
        //         LEFT OUTER JOIN sinfodi_evaluacion_responsabilidades ON sinfodi_evaluacion_responsabilidades.username = sinfodi_evaluados.usuario AND sinfodi_evaluacion_responsabilidades.year = '.$year.'
        //         LEFT OUTER JOIN sinfodi_recursos_propios ON sinfodi_recursos_propios.id_direccion = 6 AND sinfodi_recursos_propios.year = '.$year.'
        //         LEFT OUTER JOIN sinfodi_fondos_administracion ON sinfodi_fondos_administracion.id_direccion = 6 AND sinfodi_fondos_administracion.year = '.$year.'
        //         LEFT OUTER JOIN sinfodi_total_puntos ON sinfodi_total_puntos.year = '.$year.'
        //         WHERE sinfodi_evaluados.clave = '.$clave.'
        //         LIMIT 1
        //     ');
        //     $queryCriterioA = DB::select('
        //                SELECT criterios.id AS idCriterio,
        //                criterios.nombre AS criterio,
        //                criterios.puntos AS puntosCriterio,
        //                puntos.puntos AS cantidad,
        //                puntos.total_puntos AS totalPuntos
        //         FROM sinfodi_criterios criterios
        //         LEFT JOIN(
        //             SELECT id_criterio, puntos, total_puntos
        //             FROM sinfodi_evaluacion_proy_tecno
        //             WHERE sinfodi_evaluacion_proy_tecno.clave = '.$clave.' AND sinfodi_evaluacion_proy_tecno.year = '.$year.'
        //         ) puntos ON criterios.id = puntos.id_criterio
        //         WHERE criterios.observaciones = "Tabla 1. Actividad A."
        //         ORDER BY criterios.id ASC
        //     ');
        //     $querySumaA = DB::select('
        //         SELECT SUM(total_puntos) AS sumaA
        //         FROM sinfodi_evaluacion_proy_tecno
        //         WHERE clave = '.$clave.' AND year = '.$year.' AND (id_criterio BETWEEN 1 AND 35)
        //     ');
        //     $queryCriterioB = DB::select('
        //                SELECT criterios.id AS idCriterio,
        //                criterios.nombre AS criterio,
        //                criterios.puntos AS puntosCriterio,
        //                puntos.puntos AS cantidad,
        //                puntos.total_puntos AS totalPuntos
        //         FROM sinfodi_criterios criterios
        //         LEFT JOIN(
        //             SELECT id_criterio, puntos, total_puntos
        //             FROM sinfodi_evaluacion_proy_tecno
        //             WHERE sinfodi_evaluacion_proy_tecno.clave = '.$clave.' AND sinfodi_evaluacion_proy_tecno.year = '.$year.'
        //         ) puntos ON criterios.id = puntos.id_criterio
        //         WHERE criterios.observaciones = "Tabla 1. Actividad B."
        //         ORDER BY criterios.id ASC
        //     ');
        //     $querySumaB = DB::select('
        //         SELECT SUM(total_puntos) AS sumaB
        //         FROM sinfodi_evaluacion_proy_tecno
        //         WHERE clave = '.$clave.' AND year = '.$year.' AND (id_criterio BETWEEN 36 AND 41)
        //     ');
        // }


    //     if($direccion == 'Direccion General'){
    //         $tabla = "sinfodi_evaluacion_general";
    //     }elseif($direccion == 'Direccion Administracion'){
    //         $tabla = 'sinfodi_evaluacion_administracion';
    //     }elseif($direccion == 'Direccion Posgrado'){
    //         $tabla = 'sinfodi_evaluacion_posgrado';
    //     }elseif($direccion == 'Direccion Ciencia'){
    //         $tabla = 'sinfodi_evaluacion_ciencia';
    //     }elseif($direccion == 'Direccion Servicios'){
    //         $tabla = 'sinfodi_evaluacion_serv_tecno';
    //     }elseif($direccion == 'Direccion Tecnologia'){
    //         $tabla = 'sinfodi_evaluacion_proy_tecno';
    //     }
    //     $queryResponsabilidad = DB::table('sinfodi_evaluacion_responsabilidades')
    //                                 ->select('direccion')
    //                                 ->where('year', $year)
    //                                 ->where('clave', $clave)
    //                                 ->limit(1)
    //                                 ->get();
    //     $queryProductividad = DB::table($tabla)
    //                                 ->select('clave')
    //                                 ->where('clave', $clave)
    //                                 ->where('year', $year)
    //                                 ->limit(1)
    //                                 ->get();
    //     $queryResumen = DB::select('
    //         SELECT sinfodi_evaluados.clave AS clave,
    //                sinfodi_evaluados.nombre AS nombre,
    //                sinfodi_evaluacion_responsabilidades.puntos AS puntos,
    //                sinfodi_recursos_propios.recursos_propios AS recursos_propios,
    //                sinfodi_fondos_administracion.fondos_admin AS fondos_admin,
    //                (SELECT SUM(total_puntos) * 0.3 FROM '.$tabla.' WHERE year='.$year.' AND clave = '.$clave.' AND (id_criterio BETWEEN 1 AND 35)) AS puntosA,
    //                (SELECT SUM(total_puntos) * 0.7 FROM '.$tabla.' WHERE year='.$year.' AND clave = '.$clave.' AND (id_criterio BETWEEN 36 AND 41)) AS puntosB,
    //                sinfodi_total_puntos.valor_punto_actividades AS valorPunto,
    //                sinfodi_total_puntos.valor_punto_responsabilidad AS valorResponsabilidad
    //         FROM sinfodi_evaluados
    //         LEFT OUTER JOIN sinfodi_evaluacion_responsabilidades ON sinfodi_evaluacion_responsabilidades.username = sinfodi_evaluados.usuario AND sinfodi_evaluacion_responsabilidades.year = '.$year.'
    //         LEFT OUTER JOIN sinfodi_recursos_propios ON sinfodi_recursos_propios.id_direccion = 1 AND sinfodi_recursos_propios.year = '.$year.'
    //         LEFT OUTER JOIN sinfodi_fondos_administracion ON sinfodi_fondos_administracion.id_direccion = 1 AND sinfodi_fondos_administracion.year = '.$year.'
    //         LEFT OUTER JOIN sinfodi_total_puntos ON sinfodi_total_puntos.year = '.$year.'
    //         WHERE sinfodi_evaluados.clave = '.$clave.'
    //         LIMIT 1
    //     ');
    //     $nombreDoc = $clave."_".$nombre.".pdf";
    //     $dompdf = resolve('dompdf.wrapper');
    //     $dompdf->loadView('estimulos.evaluaciones.acuses.acuses2', [
    //         'direccion' => $direccion,
    //         'clave' => $clave,
    //         'nombre' => $nombre,
    //         'queryResponsabilidad' => $queryResponsabilidad,
    //         'queryProductividad' => $queryProductividad,
    //         'queryResumen' => $queryResumen,
    //         // 'queryCriterioA' => $queryCriterioA,
    //         // 'querySumaA' => $querySumaA,
    //         // 'queryCriterioB' => $queryCriterioB,
    //         // 'querySumaB' => $querySumaB,
    //     ]);
    //     return $dompdf->download($nombreDoc);
    // }

        // $queryCriterioA = DB::table('sinfodi_criterios')
        //                     ->where('observaciones', '=', 'Tabla 1. Actividad A.')
        //                     ->orderBy('id', 'ASC')
        //                     ->get();
        // $queryCriterioB = DB::table('sinfodi_criterios')
        //                     ->where('observaciones', '=', 'Tabla 1. Actividad B.')
        //                     ->orderBy('id', 'ASC')
        //                     ->get();
        // $nombreDoc = $clave."_".$nombre.".pdf";
        // $dompdf = resolve('dompdf.wrapper');
        // $dompdf->loadView('estimulos.evaluaciones.acuses.acuses', [
        //     'direccion' => $direccion,
        //     'clave' => $clave,
        //     'nombre' => $nombre,
        //     'grupo' => $grupo,
        //     'criteriosA' => $queryCriterioA,
        //     'criteriosB' => $queryCriterioB,
        // ]);
        // return $dompdf->download('Pruebas');




        // $archivo = $dompdf->download()->getOriginalContent();
        // Storage::put("/public/".$nombreDoc, $archivo);

        // // dd(file_get_contents(storage_path("app/public/".$nombreDoc)));

        // $prueba = Http::attach(
        //     'pdf', file_get_contents(storage_path("app/public/".$nombreDoc)), $nombreDoc
        // )->post('http://126.107.2.56/SINFODI/esignature/api/document', [
        //     'no_employee' => $clave,
        //     'document_type_id' => 4,
        //     'is_private' => 1, //1 = SI, 2= NO
        // ]);

        // dd($prueba->json());

        // $prueba = Http::post('http://126.107.2.56/SINFODI/esignature/api/document', [
        //     'no_employee' => $clave,
        //     // 'pdf' => Storage::get("/app/public/".$nombreDoc),
        //     'document_type_id' => 4,
        //     'is_private' => 1, //1 = SI, 2= NO
        // ])->attach('pdf', Storage::get("/app/public/".$nombreDoc));
        // return $dompdf->stream($nombreDoc);
    // }

    public function firmarAcuse($direccion, $nombre, $clave, $year, $grupo){
        $dompdf = resolve('dompdf.wrapper');
        if($grupo == 'grupo1'){
            $sumaTotalPuntosA = self::getSumaTotalPuntosA($year, $clave, $direccion);
            $sumaTotalPuntosB = self::getSumaTotalPuntosB($year, $clave, $direccion);
            $valoPuntoProductividad = self::getValorPuntoProductividad($year);
            $html = view('estimulos.evaluaciones.acuses.acuses', [
                'clave' => $clave,
                'nombre' => $nombre,
                'grupo' => $grupo,
                'año' => $year,
                'criteriosA' => self::consultasCriteriosA($direccion, $clave, $year, $grupo),
                'criteriosB' => self::consultasCriteriosB($direccion, $clave, $year, $grupo),
                'sumaTotalPuntosA' => $sumaTotalPuntosA,
                'sumaTotalPuntosB' => $sumaTotalPuntosB,
                'valorPuntoProductividad' => $valoPuntoProductividad,
            ]);
            $dompdf->loadHtml($html);
            // return $dompdf->stream();($nombreDoc);
        }elseif($grupo == 'grupo2'){
            $tipoResponsabilidad = self::getTipoResponsabilidad($clave, $year);
            $nivelResponsabilidad = self::getNivelResponsabilidad($clave, $year);
            $puntaje = self::getPuntosResponsabilidad($clave, $year);
            $nivelImpacto = self::getNivelImpacto('Medio');
            $valoPuntoResponsabilidad = self::getValorPuntoResponsabilidad($year);
            $html = view('estimulos.evaluaciones.acuses.acuses', [
                'clave' => $clave,
                'nombre' => $nombre,
                'grupo' => $grupo,
                'puntajeResponsabilidad' => $puntaje,
                'nivelResponsabilidad' => $nivelResponsabilidad,
                'tipoResonsabilidad' => $tipoResponsabilidad,
                'nivelImpacto' => $nivelImpacto,
                'valorPuntoResponsabilidad' => $valoPuntoResponsabilidad,
            ]);
            $dompdf->loadHtml($html);
            // return $dompdf->stream();($nombreDoc);
        }

        $nombreDoc = $clave."_".$nombre.".pdf";
        // dd($nombreDoc);
        $archivo = $dompdf->download()->getOriginalContent();
        Storage::put("/public/".$nombreDoc, $archivo);
        $prueba = Http::attach(
            'pdf', file_get_contents(storage_path("app/public/".$nombreDoc)), $nombreDoc
        )->post('http://126.107.2.56/SINFODI/esignature/api/document', [
            'no_employee' => $clave,
            'document_type_id' => 4,
            'is_private' => 1, //1 = SI, 2= NO
        ]);
        // $prueba = Http::post('http://126.107.2.56/SINFODI/esignature/api/document', [
        //     'no_employee' => $clave,
        //     // 'pdf' => Storage::get("/app/public/".$nombreDoc),
        //     'document_type_id' => 4,
        //     'is_private' => 1, //1 = SI, 2= NO
        // // ])->attach('pdf', Storage::get("/app/public/".$nombreDoc));
        // ])->attach('pdf', Storage::get("/public/".$nombreDoc));
        return $dompdf->stream($nombreDoc);
    }
}
