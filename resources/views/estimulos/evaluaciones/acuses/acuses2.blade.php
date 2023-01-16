<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <style type="text/css">
            .texto{
                font-family: Arial, Helvetica, sans-serif;
                text-align: center;
                font-size: 12px;
                font-weight: bold;
            }
            .row:after {
                content: "";
                clear: both;
                display: table;
            }
            .left {
                float: left;
                width: 20%;
                font-family: Arial, Helvetica, sans-serif;
                font-size: 12px;
            }
            .center {
                margin: 0 auto;
                width: 50%;
                font-family: Arial, Helvetica, sans-serif;
                text-align: center;
                font-size: 12px;
            }
            .right {
                float: right;
                width: 30%;
                font-family: Arial, Helvetica, sans-serif;
                font-size: 12px;
                text-align: right;
            }
            #page {
                width: 100%;
                text-align: center;
                background: #fff;
                border: 1px solid #000;
                border-radius: 25px;
                padding: 10px 10px 10px 10px;
            }
            table {
                width: 100%;
                text-align: left;
                border-collapse: collapse;
                margin: 0 0 1em 0;
                font-size: 10px;
                font-family: Arial, Helvetica, sans-serif;
            }
            td, th {
                padding: 0.3em;
            }
            tbody {
                border-top: 1px solid #000;
                border-bottom: 1px solid #000;
            }
            tbody th, tfoot th {
                border: 0;
            }
            th.name {
                width: 25%;
            }
            th.location {
                width: 20%;
            }
            th.lasteruption {
                width: 30%;
            }
            th.eruptiontype {
                width: 25%;
            }
            .linea {
                border-top: 1px solid black;
                height: 2px;
                max-width: 200px;
                padding: 0;
                margin: 50px auto 0 auto;
            }
        </style>
    </head>
    <div class="texto">
        EVALUACIÓN AL DESEMPEÑO DE ACUERDO A LOS LINEAMIENTOS PARA EL OTORGAMIENTO DE ÉSTIMULOS POR PROYECTO DEL PERSONAL
        CIENTÍFICO Y TECNOLÓGICO DEL <br> CENTRO DE INVESTIGACIÓN Y DESARROLLO TECNOLÓGICO EN ELECTROQUÍMICA S. C.
    </div>
    <div class="row">
        <div class="left"><b>Empleado: </b> {{ $clave }}</div>
        <div class="right"><b>Fecha: </b> {{ date('Y-m-d') }}</div>
        <div class="center">{{ strtoupper(eliminar_acentos($nombre)) }}</div>
    </div>
    <div id="page">
        <table id="resumen">
            <thead>
                <tr>
                    <th>Resumen</th>
                    <th>No. Puntos Anual</th>
                    <th>Monto Anual<sup>1</sup></th>
                    <th>Monto Bimestral<sup>1</sup></th>
                </tr>
            </thead>
            <tbody>
                @if (count($queryResponsabilidad) >= 1 && count($queryProductividad) >= 1)
                    @foreach ($queryResponsabilidad as $itemResponsabilidad)
                        @if ($itemResponsabilidad->direccion == 'Directores' || $itemResponsabilidad->direccion == 'Subdirectores')
                            @foreach ($queryResumen as $itemResumen)
                                @php
                                    // Calculos para el factor 1
                                    if(is_null($itemResumen->puntosA)){
                                        $totalPuntosA = 0.00;
                                    }else {
                                        $totalPuntosA = $itemResumen->puntosA;
                                    }
                                    if(is_null($itemResumen->puntosB)){
                                        $totalPuntosB = 0.00;
                                    }else{
                                        $totalPuntosB = $itemResumen->puntosB;
                                    }
                                    $totalPuntosAB = $totalPuntosA + $totalPuntosB;
                                    $montoAnual = $totalPuntosAB * $itemResumen->valorPunto;
                                    $montoBimestral = $montoAnual / 6;
                                    // Calculos para el factor 2
                                    if(is_null($itemResumen->recursos_propios)){
                                        $ingresoPropio = 0.00;
                                    }else{
                                        $ingresoPropio = $itemResumen->recursos_propios;
                                    }
                                    $montoBimestralIngresosPropios = $ingresoPropio / 6;
                                    // Calculo para el factor 3
                                    if(is_null($itemResumen->valorResponsabilidad)){
                                        $fondosAdmin = 0.00;
                                    }else {
                                        $fondosAdmin = $itemResumen->fondos_admin;
                                    }
                                    $montoBimestralFondosAdmin = $fondosAdmin / 6;
                                    // Calculos para el procentaje segun nivel de responsabilidad
                                    if(is_null($itemResumen->puntos)){
                                        $puntosResponsabilidad = 0.00;
                                    }else{
                                        $puntosResponsabilidad = $itemResumen->puntos;
                                    }
                                    $montoAnualResponsabilidad = $puntosResponsabilidad * $itemResumen->valorResponsabilidad;
                                    $montoBimestralResponsabilidad = $montoAnualResponsabilidad / 6;
                                @endphp
                                <tr id="factor1">
                                    <td>Total Factor 1. Actividades A y B</td>
                                    <td style="text-align: center">{{ number_format($totalPuntosAB, 2) }}</td>
                                    <td style="text-align: center">${{ number_format($montoAnual, 2) }}</td>
                                    <td style="text-align: center">${{ number_format($montoBimestral, 2) }}</td>
                                </tr>
                                <tr>
                                    <td>Total Factor 2. Ingresos propios</td>
                                    <td style="text-align: center">---</td>
                                    <td style="text-align: center">${{ number_format($ingresoPropio, 2) }}</td>
                                    <td style="text-align: center">${{ number_format($montoBimestralIngresosPropios, 2) }}</td>
                                </tr>
                                <tr>
                                    <td>Total Factor 3. Fondos en administración</td>
                                    <td style="text-align: center">---</td>
                                    <td style="text-align: center">${{ number_format($fondosAdmin, 2) }}</td>
                                    <td style="text-align: center">${{ number_format($montoBimestralFondosAdmin, 2) }}</td>
                                </tr>
                                <tr>
                                    <td>Total Tabla 5. Puntaje según nivel de responsabilidad</td>
                                    <td style="text-align: center">{{ $puntosResponsabilidad }}</td>
                                    <td style="text-align: center">${{ number_format($montoAnualResponsabilidad, 2) }}</td>
                                    <td style="text-align: center">${{ number_format($montoBimestralResponsabilidad, 2) }}</td>
                                </tr>
                            @endforeach
                        @else
                            @foreach ($queryResumen as $itemResumen)
                                @php
                                    // Calculos para el factor 2
                                    if(is_null($itemResumen->recursos_propios)){
                                        $ingresoPropio = 0.00;
                                    }else{
                                        $ingresoPropio = $itemResumen->recursos_propios;
                                    }
                                    $montoBimestralIngresosPropios = $ingresoPropio / 6;
                                    // Calculo para el factor 3
                                    if(is_null($itemResumen->valorResponsabilidad)){
                                        $fondosAdmin = 0.00;
                                    }else {
                                        $fondosAdmin = $itemResumen->fondos_admin;
                                    }
                                    $montoBimestralFondosAdmin = $fondosAdmin / 6;
                                    // Calculos para el procentaje segun nivel de responsabilidad
                                    if(is_null($itemResumen->puntos)){
                                        $puntosResponsabilidad = 0.00;
                                    }else{
                                        $puntosResponsabilidad = $itemResumen->puntos;
                                    }
                                    $montoAnualResponsabilidad = $puntosResponsabilidad * $itemResumen->valorResponsabilidad;
                                    $montoBimestralResponsabilidad = $montoAnualResponsabilidad / 6;
                                @endphp
                                <tr>
                                    <td>Total Factor 2. Ingresos propios</td>
                                    <td style="text-align: center">---</td>
                                    <td style="text-align: center">${{ number_format($ingresoPropio, 2) }}</td>
                                    <td style="text-align: center">${{ number_format($montoBimestralIngresosPropios, 2) }}</td>
                                </tr>
                                <tr>
                                    <td>Total Factor 3. Fondos en administración</td>
                                    <td style="text-align: center">---</td>
                                    <td style="text-align: center">${{ number_format($fondosAdmin, 2) }}</td>
                                    <td style="text-align: center">${{ number_format($montoBimestralFondosAdmin, 2) }}</td>
                                </tr>
                                <tr>
                                    <td>Total Tabla 5. Puntaje según nivel de responsabilidad</td>
                                    <td style="text-align: center">{{ $puntosResponsabilidad }}</td>
                                    <td style="text-align: center">${{ number_format($montoAnualResponsabilidad, 2) }}</td>
                                    <td style="text-align: center">${{ number_format($montoBimestralResponsabilidad, 2) }}</td>
                                </tr>
                            @endforeach
                        @endif
                    @endforeach
                @elseif (count($queryResponsabilidad) >= 1 && count($queryProductividad) == 0)
                    @foreach ($queryResumen as $itemResumen)
                        @php
                            // Calculos para el factor 2
                            if(is_null($itemResumen->recursos_propios)){
                                $ingresoPropio = 0.00;
                            }else{
                                $ingresoPropio = $itemResumen->recursos_propios;
                            }
                            $montoBimestralIngresosPropios = $ingresoPropio / 6;
                            // Calculo para el factor 3
                            if(is_null($itemResumen->valorResponsabilidad)){
                                $fondosAdmin = 0.00;
                            }else {
                                $fondosAdmin = $itemResumen->fondos_admin;
                            }
                            $montoBimestralFondosAdmin = $fondosAdmin / 6;
                            // Calculos para el procentaje segun nivel de responsabilidad
                            if(is_null($itemResumen->puntos)){
                                $puntosResponsabilidad = 0.00;
                            }else{
                                $puntosResponsabilidad = $itemResumen->puntos;
                            }
                            $montoAnualResponsabilidad = $puntosResponsabilidad * $itemResumen->valorResponsabilidad;
                            $montoBimestralResponsabilidad = $montoAnualResponsabilidad / 6;
                        @endphp
                        <tr>
                            <td>Total Factor 2. Ingresos propios</td>
                            <td style="text-align: center">---</td>
                            <td style="text-align: center">${{ number_format($ingresoPropio, 2) }}</td>
                            <td style="text-align: center">${{ number_format($montoBimestralIngresosPropios, 2) }}</td>
                        </tr>
                        <tr>
                            <td>Total Factor 3. Fondos en administración</td>
                            <td style="text-align: center">---</td>
                            <td style="text-align: center">${{ number_format($fondosAdmin, 2) }}</td>
                            <td style="text-align: center">${{ number_format($montoBimestralFondosAdmin, 2) }}</td>
                        </tr>
                        <tr>
                            <td>Total Tabla 5. Puntaje según nivel de responsabilidad</td>
                            <td style="text-align: center">{{ $puntosResponsabilidad }}</td>
                            <td style="text-align: center">${{ number_format($montoAnualResponsabilidad, 2) }}</td>
                            <td style="text-align: center">${{ number_format($montoBimestralResponsabilidad, 2) }}</td>
                        </tr>
                    @endforeach
                @elseif (count($queryResponsabilidad) == 0 && count($queryProductividad) >= 1)
                    @foreach ($queryResumen as $itemResumen)
                        @php
                            // Calculos para el factor 1
                            if(is_null($itemResumen->puntosA)){
                                $totalPuntosA = 0.00;
                            }else {
                                $totalPuntosA = $itemResumen->puntosA;
                            }
                            if(is_null($itemResumen->puntosB)){
                                $totalPuntosB = 0.00;
                            }else{
                                $totalPuntosB = $itemResumen->puntosB;
                            }
                            $totalPuntosAB = $totalPuntosA + $totalPuntosB;
                            $montoAnual = $totalPuntosAB * $itemResumen->valorPunto;
                            $montoBimestral = $montoAnual / 6;
                            // Calculos para el factor 2
                            if(is_null($itemResumen->recursos_propios)){
                                $ingresoPropio = 0.00;
                            }else{
                                $ingresoPropio = $itemResumen->recursos_propios;
                            }
                            $montoBimestralIngresosPropios = $ingresoPropio / 6;
                            // Calculo para el factor 3
                            if(is_null($itemResumen->valorResponsabilidad)){
                                $fondosAdmin = 0.00;
                            }else {
                                $fondosAdmin = $itemResumen->fondos_admin;
                            }
                            $montoBimestralFondosAdmin = $fondosAdmin / 6;
                        @endphp
                        <tr id="factor1">
                            <td>Total Factor 1. Actividades A y B</td>
                            <td style="text-align: center">{{ number_format($totalPuntosAB, 2) }}</td>
                            <td style="text-align: center">${{ number_format($montoAnual, 2) }}</td>
                            <td style="text-align: center">${{ number_format($montoBimestral, 2) }}</td>
                        </tr>
                        <tr>
                            <td>Total Factor 2. Ingresos propios</td>
                            <td style="text-align: center">---</td>
                            <td style="text-align: center">${{ number_format($ingresoPropio, 2) }}</td>
                            <td style="text-align: center">${{ number_format($montoBimestralIngresosPropios, 2) }}</td>
                        </tr>
                        <tr>
                            <td>Total Factor 3. Fondos en administración</td>
                            <td style="text-align: center">---</td>
                            <td style="text-align: center">${{ number_format($fondosAdmin, 2) }}</td>
                            <td style="text-align: center">${{ number_format($montoBimestralFondosAdmin, 2) }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</html>
