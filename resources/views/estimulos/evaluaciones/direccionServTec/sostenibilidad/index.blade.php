@extends('layouts.app')

@section('title_page')
    <img src="{{ asset('img/estimulos.png') }}" width="70px" height="40px">Estimulos
@endsection

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ \App\Traits\Principal::getUrlToken('/') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Evaluaciones a la dirección de servicios tecnologicos->Sostentabilidad economica</li>
    </ol>
@endsection

@section('content')
    @component('components.card')
        @slot('title_card', 'Evaluación a la dirección de servicios tecnologicos->Sostentabilidad economica')
        <div class="row">
            <div class="col-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="year" style="font-size:13px;">Seleccione el año:</label>
                    </div>
                    <select class="custom-select" id="year" onChange="ShowSelected();" style="font-size:13px;">
                        @for ($i = date('Y'); $i >= 2021; $i--)
                            <option value="{{ $i - 1 }}">{{ $i - 1 }}</option>
                        @endfor
                    </select>
                </div>
            </div>
        </div><br>
        <div class="table-responsive">
            <table id="tblCriterio14" class="table table-bordered table-striped" style="font-size:13px;">
                <caption style="font-size:13px;">Monto ingresado a CIDETEQ por proyectos patrocinados, comercializados, servicios especiales, cursos.</caption>
                <thead>
                    <tr class="text-center">
                        <th scope="col" style="font-size:13px;">Clave</th>
                        <th scope="col" style="font-size:13px;">Nombre</th>
                        <th scope="col" style="font-size:13px;">Total</th>
                        <th scope="col" style="font-size:13px;">Año</th>
                        <th scope="col" style="font-size:13px;">Detalles</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    @endcomponent
@endsection

<div class="modal fade bd-example-modal-lg" id="detalleCriterio14ModalLabel" tabindex="-1" role="dialog" aria-labelledby="detalleCriterio14ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title tituloModal" id="exampleModalLongTitle">
                    <div class="tituloModal" id="tituloModal"></div>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="cuerpoModal">
                    {{-- <div class="container"> --}}
                        <div class="row">
                            <div class="col-4" style="font-size: 12px;">
                                <div class="row">
                                    <div class="col-12">
                                        <b style="color: red;">Calculo total =</b> <b>suma proyectos + suma servicios + suma cursos.</b>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12" id="calculoTotal"></div>
                                </div>
                                <div class="row">
                                    <div class="col-12" id="calculoTotalSuma"></div>
                                </div>
                                <div class="row">
                                    <div class="col-12" id="calculoTotalSuma"></div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-12" id="calculoTotalEntrePuntosPorPersona"></div>
                                </div>
                                <div class="row">
                                    <div class="col-12" id="total"></div>
                                </div>
                            </div>
                            <div class="col-3" style="font-size: 12px;">
                                <div class="row">
                                    <div class="col-12">
                                        <b style="color: green;">Monto =</b> <b>Monto total ingresado / 10000.</b>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12" id="monto"></div>
                                </div>
                                <div class="row">
                                    <div class="col-12" id="montoEntre"></div>
                                </div>
                            </div>
                            <div class="col-5" style="font-size: 12px;">
                                <div class="row">
                                    <div class="col-12" id="puntosPorPersona"></div>
                                </div>
                                <div class="row">
                                    <div class="col-12" id="puntosPorPersonaReal"></div>
                                </div>
                                <div class="row">
                                    <div class="col-12" id="totalPuntosPorPersonaReal"></div>
                                </div>
                            </div>
                        </div>
                    {{-- </div><br> --}}
                    <br>
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-primary">
                                <div class="card-header p-0 pt-1">
                                    <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="proys-tab" data-toggle="tab" href="#proys" role="tab" aria-controls="proys" aria-selected="true">Proyectos</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="servEsp-tab" data-toggle="tab" href="#servEsp" role="tab" aria-controls="servEsp" aria-selected="true">Servicios especiales</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="cursos-tab" data-toggle="tab" href="#cursos" role="tab" aria-controls="cursos" aria-selected="true">Cursos</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content" id="custom-tabs-one-tabContent">
                                        <div class="tab-pane fade show active" id="proys" role="tabpanel" aria-labelledby="proys-tab">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="table-responsive">
                                                        <table id="tblProyCriterio14" class="table table-bordered table-striped display" style="font-size:13px;">
                                                            <caption style="font-size:13px;">
                                                                Calculos para obtener los puntos totales de proyectos patrocinados.
                                                                <ul style="list-style-type: square">
                                                                    <li><b>Porcentaje de participación</b></li>
                                                                    <li><b>Monto proporcionado por el CTCI</b></li>
                                                                    <li><b>Monto conforme a porcentaje de participacion =</b> porcentaje de participación * monto proporcionado por el CTCI</li>
                                                                    <li><b>Puntos totales =</b> monto proporcionado por el CTCI / 10000</li>
                                                                    <li><b>Puntos lider =</b> puntos totales * 0.2</li>
                                                                    <li><b>Nuevos puntos =</b> puntos totales - puntos lider</li>
                                                                    <li><b>Puntos por participación =</b> nuevos puntos * porcentaje de participación</li>
                                                                    <li>
                                                                        <b>Total =</b>
                                                                        <ul style="list-style-type: circle;">
                                                                            <li><b>Si el participante es lider =</b> puntos lider + puntos por participacion.</li>
                                                                            <li><b>Si no es lider solo se toman los puntos por participacion.</b></li>
                                                                        </ul>
                                                                    </li>
                                                                </ul>
                                                            </caption>
                                                            <thead>
                                                                <tr class="text-center">
                                                                    <th scope="col" style="font-size:13px; vertical-align:middle;">CGN</th>
                                                                    <th scope="col" style="font-size:13px; vertical-align:middle;">Porcentaje de participación</th>
                                                                    <th scope="col" style="font-size:13px; vertical-align:middle;">Monto proporcionado por el CTCI</th>
                                                                    <th scope="col" style="font-size:13px; vertical-align:middle;">Monto por % de participación</th>
                                                                    <th scope="col" style="font-size:13px; vertical-align:middle;">Puntos totales</th>
                                                                    <th scope="col" style="font-size:13px; vertical-align:middle;">Lider</th>
                                                                    <th scope="col" style="font-size:13px; vertical-align:middle;">Puntos lider</th>
                                                                    <th scope="col" style="font-size:13px; vertical-align:middle;">Nuevos puntos</th>
                                                                    <th scope="col" style="font-size:13px; vertical-align:middle;">Puntos por participación</th>
                                                                    <th scope="col" style="font-size:13px; vertical-align:middle;">Total</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody></tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <th colspan="9" style="text-align:right">Suma:</th>
                                                                    <th style="text-align:center"></th>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade show" id="servEsp" role="tabpanel" aria-labelledby="servEsp-tab">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="table-responsive">
                                                        <table id="tblServiciosCriterio14" class="table table-bordered table-striped display" style="font-size:13px;">
                                                            <caption style="font-size:13px;">
                                                                Calculos para obtener los puntos totales de servicios especiales.
                                                                <ul style="list-style-type: square">
                                                                    <li><b>Porcentaje de participación</b></li>
                                                                    <li><b>Monto proporcionado por el CTCI</b></li>
                                                                    <li><b>Monto conforme a porcentaje de participacion =</b> porcentaje de participación * monto proporcionado por el CTCI</li>
                                                                    <li><b>Totales =</b> monto conforme a porcentaje de participacion / 10000</li>
                                                                </ul>
                                                            </caption>
                                                            <thead>
                                                                <tr class="text-center">
                                                                    <th scope="col" style="font-size:13px; vertical-align:middle;">CGN</th>
                                                                    <th scope="col" style="font-size:13px; vertical-align:middle;">Porcentaje de participación</th>
                                                                    <th scope="col" style="font-size:13px; vertical-align:middle;">Monto proporcionado por el CTCI</th>
                                                                    <th scope="col" style="font-size:13px; vertical-align:middle;">Monto por % de participación</th>
                                                                    <th scope="col" style="font-size:13px; vertical-align:middle;">Total</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody></tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <th colspan="4" style="text-align:right">Suma:</th>
                                                                    <th style="text-align:center"></th>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade show" id="cursos" role="tabpanel" aria-labelledby="cursos-tab">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="table-responsive">
                                                        <table id="tblCursosCriterio14" class="table table-bordered table-striped display" style="font-size:13px;">
                                                            <caption style="font-size:13px;">
                                                                Calculos para obtener los puntos totales de cursos.
                                                                <ul style="list-style-type: square">
                                                                    <li><b>Porcentaje de participación</b></li>
                                                                    <li><b>Monto proporcionado por el CTCI</b></li>
                                                                    <li><b>Monto conforme a porcentaje de participacion =</b> porcentaje de participación * monto proporcionado por el CTCI</li>
                                                                    <li><b>Totales =</b> monto conforme a porcentaje de participacion / 10000</li>
                                                                </ul>
                                                            </caption>
                                                            <thead>
                                                                <tr class="text-center">
                                                                    <th scope="col" style="font-size:13px; vertical-align:middle;">CGN</th>
                                                                    <th scope="col" style="font-size:13px; vertical-align:middle;">Porcentaje de participación</th>
                                                                    <th scope="col" style="font-size:13px; vertical-align:middle;">Monto proporcionado por el CTCI</th>
                                                                    <th scope="col" style="font-size:13px; vertical-align:middle;">Monto por % de participación</th>
                                                                    <th scope="col" style="font-size:13px; vertical-align:middle;">Total</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody></tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <th colspan="4" style="text-align:right">Suma:</th>
                                                                    <th style="text-align:center"></th>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@section('scripts')
    <script>
        $(document).ready(initCriterio14);

        function initCriterio14(){
            obtenerCriterio14(0);
        }

        function ShowSelected(){
            var year = document.getElementById("year").value;
            obtenerCriterio14(year);
        }

        function obtenerCriterio14(year){
            if(year === 0){
                var año = document.getElementById("year").value;
            }else{
                var año = year;
            }
            // console.log(año);
            var criterio = 14;
            $.ajax({
                type: 'GET',
                url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/sostentabilidad/searchSostentabilidad/" + año,
                data: {
                    token: $('#txtTokenRepo').val(),
                },
                headers: {
                    'token' : $('#txtTokenRepo').val() ? $('#txtTokenRepo').val(): ''
                },
                success: function(datosCritero14){
                    console.log(datosCritero14);
                    var dataCriterio14 = datosCritero14.response;
                    if(dataCriterio14.length > 0){
                        for(var i = 0; i < dataCriterio14.length; i++){
                            var dataGetCriterio14 = dataCriterio14[i];
                            var resultadoSumaSostenibilidad = getSumaSostenibilidad(año, dataGetCriterio14.clave_participante);
                            // console.log(dataGetCriterio14.clave_participante + ' -> ' + resultadoSumaSostenibilidad);
                            var direccion = 'Direccion_Servicios';
                            var resultadoGetMonto = getMontoAjax(año);
                            // console.log(dataGetCriterio14.clave_participante + ' -> ' + resultadoGetMonto);
                            var resultadoGetPuntosPersonal = getPuntosPersonal(año, direccion);
                            // console.log(dataGetCriterio14.clave_participante + ' -> ' + resultadoGetPuntosPersonal);
                            var puntosPorPersona = resultadoGetMonto / resultadoGetPuntosPersonal;
                            // console.log(dataGetCriterio14.clave_participante + ' -> ' + puntosPorPersona);
                            var total = parseFloat(resultadoSumaSostenibilidad.toFixed(2)) + parseFloat(puntosPorPersona.toFixed(2));
                            // console.log(dataGetCriterio14.clave_participante + ' -> ' + total);
                            verTablaCriterio14(año, 14);
                            // $.ajax({
                                // type: 'POST',
                                // url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/sostentabilidad/saveDatosSostentabilidad",
                                // data: {
                                    // token: $('#txtTokenRepo').val(),
                                    // clave: dataGetCriterio14.clave_participante,
                                    // nombre: dataGetCriterio14.nombre_participante,
                                    // id_objetivo: 4,
                                    // id_criterio: criterio,
                                    // direccion: "DServTec",
                                    // puntos: 0,
                                    // total_puntos: dataGetCriterio14.total,
                                    // year: dataGetCriterio14.year,
                                    // username: dataGetCriterio14.usuario_participante,
                                // },
                                // headers: {
                                    // 'token' : $('#txtTokenRepo').val() ? $('#txtTokenRepo').val(): ''
                                // },
                                // success: function(data){
                                    // console.log('Desde modulo de sostenibilidad');
                                    // verTablaCriterio14(año, 14);
                                // }
                            // });
                        }
                    }else{
                        verTablaCriterio14(año, 14);
                    }
                }
            });
            $.ajax({
                type: 'GET',
                url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/sostentabilidad/getPersonalRestante/" + año,
                data: {
                    token: $('#txtTokenRepo').val(),
                },
                headers: {
                    'token' : $('#txtTokenRepo').val() ? $('#txtTokenRepo').val(): ''
                },
                success: function(datosRestantesPersonalCritero14){
                    // console.log(datosRestantesPersonalCritero14);
                    var dataRestantesPersonalCriterio14 = datosRestantesPersonalCritero14.response;
                    if(dataRestantesPersonalCriterio14.length > 0){
                        for(var i = 0; i < dataRestantesPersonalCriterio14.length; i++){
                            var dataGetRestantesPersonalCriterio14 = dataRestantesPersonalCriterio14[i];
                            var direccion = 'Direccion_Servicios';
                            var resultadoGetMonto = getMontoAjax(año);
                            // console.log(dataGetRestantesPersonalCriterio14.clave_participante + ' -> ' + resultadoGetMonto);
                            var resultadoGetPuntosPersonal = getPuntosPersonal(año, direccion);
                            // console.log(dataGetRestantesPersonalCriterio14.clave_participante + ' -> ' + resultadoGetPuntosPersonal);
                            var puntosPorPersona = resultadoGetMonto / resultadoGetPuntosPersonal;
                            // console.log(dataGetRestantesPersonalCriterio14.clave_participante + ' -> ' + puntosPorPersona);
                            var total = parseFloat(puntosPorPersona.toFixed(2));
                            verTablaCriterio14(año, 14);
                            // console.log(dataGetRestantesPersonalCriterio14.clave_participante + ' -> ' + total);
                            // $.ajax({
                            //     type: 'POST',
                            //     url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/sostentabilidad/saveDatosSostentabilidad",
                            //     data: {
                            //         token: $('#txtTokenRepo').val(),
                            //         clave: dataGetRestantesPersonalCriterio14.clave,
                            //         nombre: dataGetRestantesPersonalCriterio14.nombre,
                            //         id_objetivo: 4,
                            //         id_criterio: criterio,
                            //         direccion: "DServTec",
                            //         puntos: 0,
                            //         total_puntos: total,
                            //         year: dataGetRestantesPersonalCriterio14.year,
                            //         username: dataGetRestantesPersonalCriterio14.usuario,
                            //     },
                            //     headers: {
                            //         'token' : $('#txtTokenRepo').val() ? $('#txtTokenRepo').val(): ''
                            //     },
                            //     success: function(data){
                            //         console.log('Restantes de sostenibilidad.');
                            //         verTablaCriterio14(año, 14);
                            //     }
                            // });
                        }
                    }else{
                        verTablaCriterio14(año, 14);
                    }
                }
            });
        }

        function getSumaSostenibilidad(year, clave){
            var result = "";
            $.ajax({
                type: 'GET',
                url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/sostentabilidad/calculosSostentabilidad/" + year + "/" + clave,
                async: false,
                data: {
                    token: $('#txtTokenRepo').val(),
                },
                headers: {
                    'token' : $('#txtTokenRepo').val() ? $('#txtTokenRepo').val(): ''
                },
                beforeSend: function(xhr){
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                },
                success: function(datosCalculoTotalCriterio14){
                    if(datosCalculoTotalCriterio14[0].sumaProyectos === null){
                        var sumaProyectos = 0;
                    }else{
                        var sumaProyectos = datosCalculoTotalCriterio14[0].sumaProyectos;
                    }
                    if(datosCalculoTotalCriterio14[0].sumaServicios === null){
                        var sumaServicios = 0;
                    }else{
                        var sumaServicios = datosCalculoTotalCriterio14[0].sumaServicios;
                    }
                    if(datosCalculoTotalCriterio14[0].sumaCursos === null){
                        var sumaCursos = 0;
                    }else{
                        var sumaCursos = datosCalculoTotalCriterio14[0].sumaCursos;
                    }
                    var sumaTotalCalculo = parseFloat(sumaProyectos) + parseFloat(sumaServicios) + parseFloat(sumaCursos);
                    result = sumaTotalCalculo;
                }
            });
            return result;
        }

        function getMontoAjax(year){
            var result = "";
            $.ajax({
                type: 'GET',
                url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/sostentabilidad/getMonto/" + year,
                async: false,
                data: {
                    token: $('#txtTokenRepo').val(),
                },
                headers: {
                    'token' : $('#txtTokenRepo').val() ? $('#txtTokenRepo').val(): ''
                },
                beforeSend: function(xhr){
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                },
                success: function(datosMontoCriterio14){
                    var monto = parseFloat(datosMontoCriterio14.response) / 10000;
                    result = monto;
                    // console.log(result);
                }
            });
            return result;
        }

        function getPuntosPersonal(year, direccion){
            var result = "";
            $.ajax({
                type: 'GET',
                url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/ObtenerTotalPersonas/" + year + "/" + direccion,
                async: false,
                data: {
                    token: $('#txtTokenRepo').val(),
                },
                headers: {
                    'token' : $('#txtTokenRepo').val() ? $('#txtTokenRepo').val(): ''
                },
                beforeSend: function(xhr){
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                },
                success: function(datosTotalPersonalCriterio14){
                    result = datosTotalPersonalCriterio14;
                }
            });
            return result;
        }

        function verTablaCriterio14(year, criterio){
            consultarDatos({
                action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/sostentabilidad/datosSostentabilidad/" + year + "/" + criterio,
                type: 'GET',
                dataType: 'json',
                ok: function(datosServiciosCriterio14){
                    // console.log(datosServiciosCriterio14);
                    var datosServiciosCriterio14 = datosServiciosCriterio14.response;
                    var row = "";
                    for(var i = 0; i < datosServiciosCriterio14.length; i++){
                        var dataServiciosCriterio14 = datosServiciosCriterio14[i];
                        // console.log(dataServiciosCriterio14);
                        var authUser = '<?= Auth::user()->usuario ?>';
                        var permissions = '<?= Auth::user()->hasPermissionTo("estimulo-evaluaciones-servicios-sostentabilidad-index") ?>';
                        // console.log(permissions);
                        if(dataServiciosCriterio14.username == authUser || permissions == 1){
                                row += "<tr>";
                                row += '<th scope="row" class="text-center" width="8%" style="font-size:12px;">' + dataServiciosCriterio14.clave + '</td>';
                                row += '<td width="77%" style="font-size:12px;">' + dataServiciosCriterio14.nombre.toUpperCase() + "</td>";
                                row += '<td class="text-center" width="5%" style="font-size:12px;">' + dataServiciosCriterio14.total_puntos + '</td>';
                                row += '<td class="text-center" width="5%" style="font-size:12px;">' + dataServiciosCriterio14.year + '</td>';
                                row += '<td class="text-center" width="5%" style="font-size:12px;"><a href="javascript:verDetalleCriterio14(' + dataServiciosCriterio14.year + ', ' + dataServiciosCriterio14.clave + ')"><i class="fa fa-search"></i></a></td>';
                                row += "</tr>";
                        }
                    }
                    if ($.fn.dataTable.isDataTable("#tblCriterio14")) {
                        tblDifusionDivulgacion = $("#tblCriterio14").DataTable();
                        tblDifusionDivulgacion.destroy();
                    }
                    $('#tblCriterio14 > tbody').html('');
                    $('#tblCriterio14 > tbody').append(row);
                    $('#tblCriterio14').DataTable({
                        "order":[[0, "asc"]],
                        "language":{
                          "lengthMenu": "Mostrar _MENU_ registros por página.",
                          "info": "Página _PAGE_ de _PAGES_",
                          "infoEmpty": "No se encontraron registros.",
                          "infoFiltered": "(filtrada de _MAX_ registros)",
                          "loadingRecords": "Cargando...",
                          "processing":     "Procesando...",
                          "search": "Buscar:",
                          "zeroRecords":    "No se encontraron registros.",
                          "paginate": {
                                          "next":       ">",
                                          "previous":   "<"
                                      },
                        },
                        lengthMenu: [[10, 15, 20, 50], [10, 15, 20, 50]]
                    });
                },
            });
        }

        function verDetalleCriterio14(year, clave){
            document.getElementById('tituloModal').innerHTML='Visualizar detalle sostenibilidad economica.';
            // Mostrar el calculo total...
            consultarDatos({
                action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/sostentabilidad/calculosSostentabilidad/" + year + "/" + clave,
                type: 'GET',
                dataType: 'json',
                ok: function(datosCalculoTotalCriterio14){
                    // console.log(datosCalculoTotalCriterio14[0].sumaProyectos);
                    if(datosCalculoTotalCriterio14.length > 0){
                        if(datosCalculoTotalCriterio14[0].sumaProyectos === null){
                            var sumaProyectos = 0;
                        }else{
                            var sumaProyectos = datosCalculoTotalCriterio14[0].sumaProyectos;
                        }
                        if(datosCalculoTotalCriterio14[0].sumaServicios === null){
                            var sumaServicios = 0;
                        }else{
                            var sumaServicios = datosCalculoTotalCriterio14[0].sumaServicios;
                        }
                        if(datosCalculoTotalCriterio14[0].sumaCursos === null){
                            var sumaCursos = 0;
                        }else{
                            var sumaCursos = datosCalculoTotalCriterio14[0].sumaCursos;
                        }
                    }else{
                        var sumaProyectos = 0;
                        var sumaServicios = 0;
                        var sumaCursos = 0;
                    }
                    var sumaTotalCalculo = parseFloat(sumaProyectos) + parseFloat(sumaServicios) + parseFloat(sumaCursos);
                    // console.log(sumaProyectos + ' -> ' + sumaServicios + ' -> ' + sumaCursos);
                    document.getElementById('calculoTotal').innerHTML='<b style="color: red;">Calculo total =</b> ' + sumaProyectos + ' + ' + sumaServicios + ' + ' + sumaCursos;
                    document.getElementById('calculoTotalSuma').innerHTML='<b style="color: red;">Calculo total =</b> ' + sumaTotalCalculo.toFixed(2);
                    // Mostrar el monto total y punto por participante...
                    var direccion = 'Direccion_Servicios';
                    consultarDatos({
                        action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/sostentabilidad/getMonto/" + year,
                        type: 'GET',
                        dataType: 'json',
                        ok: function(datosMontoCriterio14){
                            // console.log(datosMontoCriterio14.response);
                            document.getElementById('monto').innerHTML='<b style="color: green;">Monto =</b> ' + datosMontoCriterio14.response + ' / 10000';
                            var monto = parseFloat(datosMontoCriterio14.response) / 10000;
                            document.getElementById('montoEntre').innerHTML='<b style="color: green;">Monto =</b> ' + monto.toFixed(2);
                            document.getElementById('puntosPorPersona').innerHTML='<b style="color: blue;">Puntos por persona(ingreso) =</b> <b style="color: green;">Monto</b> <b>/ numero de personal en la dirección.</b>';
                            consultarDatos({
                                action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/ObtenerTotalPersonas/" + year + "/" + direccion,
                                type: 'GET',
                                dataType: 'json',
                                ok: function(datosTotalPersonalCriterio14){
                                    // console.log(datosTotalPersonalCriterio14);
                                    document.getElementById('puntosPorPersonaReal').innerHTML='<b style="color: blue;">Puntos por persona(ingreso) =</b> '+monto.toFixed(2)+' / '+datosTotalPersonalCriterio14;
                                    var totalPuntosPorPersona = monto.toFixed(2) / datosTotalPersonalCriterio14;
                                    document.getElementById('totalPuntosPorPersonaReal').innerHTML='<b style="color: blue;">Puntos por persona(ingreso) =</b> '+totalPuntosPorPersona.toFixed(2);
                                    document.getElementById('calculoTotalEntrePuntosPorPersona').innerHTML='<b>Total =</b> <b style="color: red;">Calculo total</b> + <b style="color: blue;">Puntos por persona</b>';
                                    var total = parseFloat(sumaTotalCalculo.toFixed(2)) + parseFloat(totalPuntosPorPersona.toFixed(2));
                                    document.getElementById('total').innerHTML='<b>Total =</b> '+total.toFixed(2);
                                }
                            });
                        }
                    });
                },
            });
            // Detalles proyectos patrocinados...
            consultarDatos({
                action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/sostentabilidad/detallesProyectos/" + year + "/" + clave,
                type: 'GET',
                dataType: 'json',
                ok: function(datosProyCriterio14){
                    var row = "";
                    for(var i = 0; i < datosProyCriterio14.length; i++){
                        var dataProyCriterio14 = datosProyCriterio14[i];
                        row += "<tr>";
                        row += '<th scope="row" class="text-center" width="20%" style="font-size:12px;">' + dataProyCriterio14.cgn + '</td>';
                        row += '<td width="9%" style="font-size:12px; text-align: center;">' + dataProyCriterio14.porcentaje_participacion+'</td>';
                        row += '<td width="9%" style="font-size:12px; text-align: center;">'+dataProyCriterio14.monto_ingresado+'</td>';
                        row += '<td width="9%" style="font-size:12px; text-align: center;">'+dataProyCriterio14.ingreso_participacion+'</td>';
                        row += '<td width="9%" style="font-size:12px; text-align: center;">'+dataProyCriterio14.puntos_totales+'</td>';
                        row += '<td width="8%" style="font-size:12px; text-align: center;">'+dataProyCriterio14.lider_responsable+'</td>';
                        row += '<td width="9%" style="font-size:12px; text-align: center;">'+dataProyCriterio14.puntos_lider+'</td>';
                        row += '<td width="9%" style="font-size:12px; text-align: center;">'+dataProyCriterio14.nuevos_puntos_totales+'</td>';
                        row += '<td width="9%" style="font-size:12px; text-align: center;">'+dataProyCriterio14.puntos_participacion+'</td>';
                        row += '<td width="9%" style="font-size:12px; text-align: center;">'+dataProyCriterio14.total+'</td>';
                        row += "</tr>";
                    }
                    if ($.fn.dataTable.isDataTable("#tblProyCriterio14")) {
                        tblDifusionDivulgacion = $("#tblProyCriterio14").DataTable();
                        tblDifusionDivulgacion.destroy();
                    }
                    $('#tblProyCriterio14 > tbody').html('');
                    $('#tblProyCriterio14 > tbody').append(row);
                    $('#tblProyCriterio14').DataTable({
                        "order":[[0, "asc"]],
                        "language":{
                          "lengthMenu": "Mostrar _MENU_ registros por página.",
                          "info": "Página _PAGE_ de _PAGES_",
                          "infoEmpty": "No se encontraron registros.",
                          "infoFiltered": "(filtrada de _MAX_ registros)",
                          "loadingRecords": "Cargando...",
                          "processing":     "Procesando...",
                          "search": "Buscar:",
                          "zeroRecords":    "No se encontraron registros.",
                          "paginate": {
                                          "next":       ">",
                                          "previous":   "<"
                                      },
                        },
                        lengthMenu: [[5, 10, 15, 20], [5, 10, 15, 20]],
                        footerCallback: function(row, data, start, end, display) {
                            var api = this.api();
                            var intVal = function(i){
                                return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
                            };
                            if(api.column(9).data().length){
                                var pageTotal = api
                                    .column(9, {page: 'current'})
                                    .data()
                                    .reduce(function(a, b){
                                        return intVal(a) + intVal(b);
                                    });
                            }else{
                                var pageTotal = 0;
                            }
                            $(api.column(9).footer()).html(pageTotal);
                        },
                    });
                },
            });
            // Detalles servicios especiales...
            consultarDatos({
                action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/sostentabilidad/detallesServicios/" + year + "/" + clave,
                type: 'GET',
                dataType: 'json',
                ok: function(datosServiciosCriterio14){
                    // console.log(datosServiciosCriterio14);
                    var row = "";
                    for(var i = 0; i < datosServiciosCriterio14.length; i++){
                        // console.log(datosServiciosCriterio14[i]);
                        var dataServiciosCriterio14 = datosServiciosCriterio14[i];
                        row += "<tr>";
                        row += '<th scope="row" class="text-center" width="20%" style="font-size:12px;">' + dataServiciosCriterio14.cgn + '</td>';
                        row += '<td width="20%" style="font-size:12px; text-align: center;">' + dataServiciosCriterio14.porcentaje_participacion+'</td>';
                        row += '<td width="20%" style="font-size:12px; text-align: center;">'+dataServiciosCriterio14.monto_ingresado+'</td>';
                        row += '<td width="20%" style="font-size:12px; text-align: center;">'+dataServiciosCriterio14.ingreso_participacion+'</td>';
                        row += '<td width="20%" style="font-size:12px; text-align: center;">'+dataServiciosCriterio14.total+'</td>';
                        row += "</tr>";
                    }
                    if ($.fn.dataTable.isDataTable("#tblServiciosCriterio14")) {
                        tblDifusionDivulgacion = $("#tblServiciosCriterio14").DataTable();
                        tblDifusionDivulgacion.destroy();
                    }
                    $('#tblServiciosCriterio14 > tbody').html('');
                    $('#tblServiciosCriterio14 > tbody').append(row);
                    $('#tblServiciosCriterio14').DataTable({
                        footerCallback: function(row, data, start, end, display) {
                            var api = this.api();
                            var intVal = function(i){
                                return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
                            };
                            if(api.column(4).data().length){
                                var pageTotal = api
                                    .column(4, {page: 'current'})
                                    .data()
                                    .reduce(function(a, b){
                                        return intVal(a) + intVal(b);
                                    });
                            }else{
                                var pageTotal = 0;
                            }
                            $(api.column(4).footer()).html(pageTotal);
                        },
                        "order":[[0, "asc"]],
                        "language":{
                          "lengthMenu": "Mostrar _MENU_ registros por página.",
                          "info": "Página _PAGE_ de _PAGES_",
                          "infoEmpty": "No se encontraron registros.",
                          "infoFiltered": "(filtrada de _MAX_ registros)",
                          "loadingRecords": "Cargando...",
                          "processing":     "Procesando...",
                          "search": "Buscar:",
                          "zeroRecords":    "No se encontraron registros.",
                          "paginate": {
                                          "next":       ">",
                                          "previous":   "<"
                                      },
                        },
                        lengthMenu: [[5, 10, 15, 20], [5, 10, 15, 20]]
                    });
                },
            });
            // Detalles cursos...
            consultarDatos({
                action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/sostentabilidad/detallesCursos/" + year + "/" + clave,
                type: 'GET',
                dataType: 'json',
                ok: function(datosCursosCriterio14){
                    // console.log(datosCursosCriterio14);
                    var row = "";
                    for(var i = 0; i < datosCursosCriterio14.length; i++){
                        // console.log(datosCursosCriterio14[i]);
                        var dataCursosCriterio14 = datosCursosCriterio14[i];
                        row += "<tr>";
                        row += '<th scope="row" class="text-center" width="20%" style="font-size:12px;">' + dataCursosCriterio14.cgn + '</td>';
                        row += '<td width="20%" style="font-size:12px; text-align: center;">' + dataCursosCriterio14.porcentaje_participacion+'</td>';
                        row += '<td width="20%" style="font-size:12px; text-align: center;">'+dataCursosCriterio14.monto_ingresado+'</td>';
                        row += '<td width="20%" style="font-size:12px; text-align: center;">'+dataCursosCriterio14.ingreso_participacion+'</td>';
                        row += '<td width="20%" style="font-size:12px; text-align: center;">'+dataCursosCriterio14.total+'</td>';
                        row += "</tr>";
                    }
                    if ($.fn.dataTable.isDataTable("#tblCursosCriterio14")) {
                        tblDifusionDivulgacion = $("#tblCursosCriterio14").DataTable();
                        tblDifusionDivulgacion.destroy();
                    }
                    $('#tblCursosCriterio14 > tbody').html('');
                    $('#tblCursosCriterio14 > tbody').append(row);
                    $('#tblCursosCriterio14').DataTable({
                        "order":[[0, "asc"]],
                        "language":{
                          "lengthMenu": "Mostrar _MENU_ registros por página.",
                          "info": "Página _PAGE_ de _PAGES_",
                          "infoEmpty": "No se encontraron registros.",
                          "infoFiltered": "(filtrada de _MAX_ registros)",
                          "loadingRecords": "Cargando...",
                          "processing":     "Procesando...",
                          "search": "Buscar:",
                          "zeroRecords":    "No se encontraron registros.",
                          "paginate": {
                                          "next":       ">",
                                          "previous":   "<"
                                      },
                        },
                        lengthMenu: [[5, 10, 15, 20], [5, 10, 15, 20]],
                        footerCallback: function(row, data, start, end, display) {
                            var api = this.api();
                            var intVal = function(i){
                                return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
                            };
                            if(api.column(4).data().length){
                                var pageTotal = api
                                    .column(4, {page: 'current'})
                                    .data()
                                    .reduce(function(a, b){
                                        return intVal(a) + intVal(b);
                                    });
                            }else{
                                var pageTotal = 0;
                            }
                            $(api.column(4).footer()).html(pageTotal);
                        },
                    });
                },
            });
            $('#detalleCriterio14ModalLabel').modal({backdrop: 'static', keyboard: false});
        }
    </script>
@endsection
