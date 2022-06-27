<html>
    <head>
        <style type="text/css">
            .texto{
                font-family: Arial, Helvetica, sans-serif;
                text-align: center;
                font-size: 12px;
                font-weight: bold;
                padding-top: 3em;
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
            .encabezado{
                position: fixed;
                top: -40px;
                left: 0px;
                right: 0px;
                height: 50px;
                /** Extra personal styles **/
                color: white;
                text-align: center;
                line-height: 35px;
            }
            .pie{
                position: fixed;
                bottom: -10px;
                left: 0px;
                right: 0px;
                height: 50px;
                /** Extra personal styles **/
                color: white;
                text-align: center;
                line-height: 35px;
            }
        </style>
    </head>
    <body>
        @php
            $header = "http://localhost/sinfodi-master/public/img/headers.jpg";
            $footer = "http://localhost/sinfodi-master/public/img/footer.PNG";
            $headerBase64 = "data:image/png;base64," . base64_encode(file_get_contents($header));
            $footerBase64 = "data:image/png;base64," . base64_encode(file_get_contents($footer));
        @endphp
        <header class="encabezado">
            <div class="col-12" style="text-align: center;">
                <img src="<?php echo $headerBase64 ?>">
            </div>
        </header>
        <footer class="pie">
            <div class="col-12" style="text-align: center;">
            <img src="<?php echo $footerBase64 ?>"  width="800">
            </div>
        </footer>
        <br>
        <main>
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
                <table>
                    <thead>
                        <tr>
                            <th>Resumen</th>
                            <th>No. Puntos Anual</th>
                            <th>Monto Anual<sup>1</sup></th>
                            <th>Monto Bimestral<sup>1</sup></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Total Factor 1. Actividades A y B<sup>243</sup></td>
                            <td style="text-align: center">---</td>
                            <td style="text-align: center">---</td>
                            <td style="text-align: center">---</td>
                        </tr>
                        <tr>
                            <td>Total Factor 2. Ingresos propios</td>
                            <td style="text-align: center">---</td>
                            <td style="text-align: center">---</td>
                            <td style="text-align: center">---</td>
                        </tr>
                        <tr>
                            <td>Total Factor 3. Fondos en administración</td>
                            <td style="text-align: center">---</td>
                            <td style="text-align: center">---</td>
                            <td style="text-align: center">---</td>
                        </tr>
                        <tr>
                            <td>Total Tabla 5. Puntaje según nivel de responsabilidad<sup>23</sup></td>
                            <td style="text-align: center">---</td>
                            <td style="text-align: center">---</td>
                            <td style="text-align: center">---</td>
                        </tr>
                    </tbody>
                    <tfoot width = "100%" style="font-size: 10px;">
                        <tr>
                            <td style="text-align: left">Total General:</td>
                            <td style="text-align: center">---</td>
                            <td style="text-align: center">---</td>
                            <td style="text-align: center">---</td>
                        </tr>
                    </tfoot>
                    <div class="row">
                        <div class="col-12" style="border-top: 1px solid #000; border-right: 1px solid #000; font-size: 8px; font-weight: bold;">
                            1. Montos antes de impuestos.<br>
                            2. Valor por punto de actividad A y B: $106.49<br>
                            3. Valor por punto de responsabilidad: $59.55<br>
                            4. El cálculo dependede la fecha de designación. El cálculo es proporcional al tiempo en el Factor 1 y/o Tabla 5    ----en el puesto de responsabilidad y/o realizando Actividades A y B.<br>
                            5. Resultado de la suma de los puntos A multiplicados por un factor de 0.3 y los puntos B multiplicados por un factor de 0.7, conforme al Anexo 1 Mecanismo de Evaluación, página 13.
                        </div>
                    </div>
                </table>
            </div>
        </main>
        <script>
            $(document).ready(initVer);

            function initVer(){
                informacionPersonal();
            }
        </script>
    </body>
</html>
