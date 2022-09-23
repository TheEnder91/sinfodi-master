<!DOCTYPE html>
<html lang="en">
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
            .centrado{
            	text-align: center;
            }
            .Fieldset {
                border: 1px solid black;
                border-radius: 15px;
                margin: 1px auto;
                width: 100%;
            }
            .Legend {
                font-size: 16px;
                text-align: center;
                padding: 0.2% 0.4%;
                width: 15%;
                margin: 0 34.6%;
                border: 1px solid black;
                border-radius: 5px;
            }
            .thead{
                border: 1px solid black;
                color: white;
                background: #000000:
            }
            .tbody {
                border: 1px solid black;
            }
        </style>
    </head>
    <body>
        <div class="texto">
            EVALUACIÓN AL DESEMPEÑO DE ACUERDO A LOS LINEAMIENTOS PARA EL OTORGAMIENTO DE ÉSTIMULOS POR PROYECTO DEL PERSONAL
            CIENTÍFICO Y TECNOLÓGICO DEL <br> CENTRO DE INVESTIGACIÓN Y DESARROLLO TECNOLÓGICO EN ELECTROQUÍMICA S. C.<br>
            @if($grupo == 'grupo1')
                GRUPO 1 PERSONAL CIENTÍFICO Y TECNOLÓGICO ORIENTADO A LOS PROCESOS SUSTANTIVOS.
            @elseif ($grupo == 'grupo2')
                GRUPO 2 PERSONAL CIENTÍFICO Y TECNOLÓGICO ORIENTADO A LAS ACTIVIDADES DE GESTÓN Y SOPORTE DE ÁREAS SUSTANTIVAS.
            @endif
        </div>
        <div class="row">
            <div class="left"><b>Empleado: </b> {{ $clave }}</div>
            <div class="right"><b>Fecha: </b> {{ date('Y-m-d') }}</div>
            <div class="center">{{ strtoupper(eliminar_acentos($nombre)) }}</div>
        </div>
        @if($grupo == 'grupo1')
            @include('estimulos.evaluaciones.acuses.grupo1')
            {{-- @include('estimulos.evaluaciones.acuses.acuseGrupo1Prueba') --}}
        @elseif ($grupo == 'grupo2')
            @include('estimulos.evaluaciones.acuses.grupo2')
            {{-- @include('estimulos.evaluaciones.acuses.acuseGrupo2Prueba') --}}
        @endif
        <div style="text-align: center; font-weight: bold; font-size: 11px;">
            Firma de representantes del Comité de Evaluación conforme al acuerdo de la minuta de la Primera Sesión del Comité de Evaluación {{ date("Y") }}.
        </div>
        <div class="centrado" style="width: 100%; font-size: 12px; font-weight: bold;">
            <div class="linea"></div>
            {{ strtoupper(eliminar_acentos($nombre)) }}<br>
            Acuso de recibido como conformidad y manifiesto el conocimiento del proceso y el cálculo de los estímulos.
        </div>
        <div style="width: 100%; font-size: 12px; font-weight: bold;">
            <div style="float:left; width: 50%;">
                <div style="text-align: center;">
                    <div style="border-top: 1px solid black; height: 2px; max-width: 200px; padding: 0; margin: 50px auto 0 auto;"></div>
                    <p>C.P. MARÍA JUDIT RIVERA MONTEALVO<br>PRESIDENTA</p>
                </div>
            </div>
            <div style="float:left; width: 50%;">
                <div style="text-align: center;">
                    <div style="border-top: 1px solid black; height: 2px; max-width: 200px; padding: 0; margin: 50px auto 0 auto;"></div>
                    <p>LIC. ESTEBAN VELIZ MARCIN<br>SECRETARIO TÉCNICO</p>
                </div>
            </div>
    </body>
</html>
