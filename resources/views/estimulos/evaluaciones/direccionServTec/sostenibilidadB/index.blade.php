@extends('layouts.app')

@section('title_page')
    <img src="{{ asset('img/estimulos.png') }}" width="70px" height="40px">Estimulos
@endsection

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ \App\Traits\Principal::getUrlToken('/') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Evaluaciones a la dirección de servicios tecnologicos->Sostenibilidad economica B</li>
    </ol>
@endsection

@section('content')
    @component('components.card')
        @slot('title_card', 'Evaluaciones a la dirección de servicios tecnologicos->Sostenibilidad economica B.')
        <div class="row">
            <div class="col-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="year" style="font-size:13px;">Seleccione el año a evaluar:</label>
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
            <table id="tblCriterio37" class="table table-bordered table-striped" style="font-size:13px;">
                <caption style="font-size:13px;">Proyecto comercializados con remanente planeado o superior (Valor del punto: 200).</caption>
                <thead>
                    <tr class="text-center">
                        <th scope="col" style="font-size:13px;">Clave</th>
                        <th scope="col" style="font-size:13px;">Nombre</th>
                        <th scope="col" style="font-size:13px;">Puntos</th>
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

<div class="modal fade bd-example-modal-lg" id="detalleCriterio37ModalLabel" tabindex="-1" role="dialog" aria-labelledby="detalleCriterio37ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width: 40%;">
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
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table id="tblSostenibilidadBCriterio37" class="table table-bordered table-striped display" style="font-size:13px;">
                                        <caption style="font-size:13px;">Proyectos con remante.</caption>
                                        <thead>
                                            <tr class="text-center">
                                                <th scope="col" style="font-size:13px; vertical-align:middle;">CGN</th>
                                                <th scope="col" style="font-size:13px; vertical-align:middle;">Remanente</th>
                                                <th scope="col" style="font-size:13px; vertical-align:middle;">Tipo</th>
                                                <th scope="col" style="font-size:13px; vertical-align:middle;">Año</th>
                                                <th scope="col" style="font-size:13px; vertical-align:middle;">Puntaje</th>
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

@section('scripts')
    <script>
        $(document).ready(initCriterio37);

        function initCriterio37(){
            obtenerCriterio37(0);
        }

        function ShowSelected(){
            var year = document.getElementById("year").value;
            obtenerCriterio37(year);
        }

        function obtenerCriterio37(year){
            if(year === 0){
                var año = document.getElementById("year").value;
            }else{
                var año = year;
            }
            // console.log(año);
            var id_objetivo = 4;
            var criterio = 37;
            consultarDatos({
                action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/sostenibilidadB/searchSostenibilidadB/" + año,
                type: 'GET',
                dataType: 'json',
                ok: function(datosCritero37){
                    var datosCriterio37 = datosCritero37.response;
                    // console.log(datosCritero37);
                    // Codigo para guardar en el sistema...
                    if(datosCriterio37.length > 0){
                        // console.log(datosCriterio37);
                        let arr2 = [];
                        datosCriterio37.forEach((x)=>{
                            if(x['remanente'] == 'Si'){
                                if(arr2.some((val)=>{ return val['clave_participante'] == x['clave_participante']})){
                                    arr2.forEach((k)=>{
                                        if(k['clave_participante'] === x['clave_participante']){
                                            k['nombre_participante'] = x['nombre_participante']
                                            k['usuario_participante'] = x['usuario_participante']
                                            k['year'] = x['year']
                                            k["occurrence"]++;
                                        }
                                    });
                                }else{
                                    let a = {}
                                    a['clave_participante'] = x['clave_participante']
                                    a['nombre_participante'] = x['nombre_participante']
                                    a['usuario_participante'] = x['usuario_participante']
                                    a['year'] = x['year']
                                    a["occurrence"] = 1;
                                    arr2.push(a);
                                }
                            }
                        });
                        // console.log(arr2);
                        consultarDatos({
                            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/sostenibilidadB/puntos/" + criterio + "/" + id_objetivo,
                            type: 'GET',
                            dataType: 'json',
                            ok: function(puntosCriterio37){
                                var puntos = puntosCriterio37.response;
                                // console.log(puntos[0].puntos);
                                for(var i = 0; i < arr2.length; i++){
                                    var dataCriterio37 = arr2[i];
                                    // console.log(dataCriterio37);
                                    var puntosTotales = dataCriterio37.occurrence * puntos[0].puntos;
                                    // console.log(dataCriterio37.clave_participante + '->' + puntosTotales);
                                    $.ajax({
                                        type: 'POST',
                                        url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/sostenibilidadB/saveDatos",
                                        data: {
                                            token: $('#txtTokenRepo').val(),
                                            clave: dataCriterio37.clave_participante,
                                            nombre: dataCriterio37.nombre_participante,
                                            id_objetivo: id_objetivo,
                                            id_criterio: criterio,
                                            direccion: "DServTec",
                                            puntos: dataCriterio37.occurrence,
                                            total_puntos: puntosTotales,
                                            year: año,
                                            username: dataCriterio37.usuario_participante
                                        },
                                        headers: {
                                            'token' : $('#txtTokenRepo').val() ? $('#txtTokenRepo').val(): ''
                                        },
                                        success: function(data){
                                            verTablaCriterio37(año, criterio);
                                        }
                                    });
                                }
                            },
                        });
                    }else{
                        verTablaCriterio37(año, criterio);
                    }
                },
            });
        }

        function verTablaCriterio37(year, criterio){
            consultarDatos({
                action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/sostenibilidadB/datosSostenibilidadB/" + year + "/" + criterio,
                type: 'GET',
                dataType: 'json',
                ok: function(datosGeneralCriterio37){
                    var datosGeneralCriterio37 = datosGeneralCriterio37.response;
                    // console.log(datosGeneralCriterio37);
                    var row = "";
                    for(var i = 0; i < datosGeneralCriterio37.length; i++){
                        var dataGeneralCriterio37 = datosGeneralCriterio37[i];
                        // console.log(dataGeneralCriterio37);
                        var authUser = '<?= Auth::user()->usuario ?>';
                        var permissions = '<?= Auth::user()->hasPermissionTo("estimulo-evaluaciones-servicios-sostentabilidadB-index") ?>';
                        // console.log(permissions);
                        if(dataGeneralCriterio37.username == authUser || permissions == 1){
                                row += "<tr>";
                                row += '<th style="font-size:12px;" scope="row" class="text-center" width="10%">' + dataGeneralCriterio37.clave + '</td>';
                                row += '<td style="font-size:12px;" width="60%">' + dataGeneralCriterio37.nombre.toUpperCase() + "</td>";
                                row += '<td style="font-size:12px;" class="text-center" width="10%">' + parseInt(dataGeneralCriterio37.puntos) + '</td>';
                                row += '<td style="font-size:12px;" class="text-center" width="10%">' + parseInt(dataGeneralCriterio37.total_puntos) + '</td>';
                                row += '<td style="font-size:12px;" class="text-center" width="10%">' + dataGeneralCriterio37.year + '</td>';
                                row += '<td class="text-center" width="5%" style="font-size:12px;"><a href="javascript:verDetalleCriterio37(' + dataGeneralCriterio37.year + ', ' + dataGeneralCriterio37.clave + ')"><i class="fa fa-search"></i></a></td>';
                                row += "</tr>";
                        }
                    }
                    if ($.fn.dataTable.isDataTable("#tblCriterio37")) {
                        tblDifusionDivulgacion = $("#tblCriterio37").DataTable();
                        tblDifusionDivulgacion.destroy();
                    }
                    $('#tblCriterio37 > tbody').html('');
                    $('#tblCriterio37 > tbody').append(row);
                    $('#tblCriterio37').DataTable({
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

        function verDetalleCriterio37(year, clave){
            $('#detalleCriterio37ModalLabel').modal({backdrop: 'static', keyboard: false});
            document.getElementById('tituloModal').innerHTML='Detalle sostenibilidad economica->actividades B.';
            consultarDatos({
                action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/sostenibilidadB/getDatosRemanente/" + clave + "/" + year,
                type: 'GET',
                dataType: 'json',
                ok: function(datosSostenibilidadBCriterio37){
                    // console.log(datosSostenibilidadBCriterio37);
                    var dataSostenibilidadBCriterio37 = datosSostenibilidadBCriterio37.response;
                    var row = "";
                    if(dataSostenibilidadBCriterio37.length > 0){
                        for(var i = 0; i < dataSostenibilidadBCriterio37.length; i++){
                            var getSostenibilidadBCriterio37 = dataSostenibilidadBCriterio37[i];
                            row += "<tr>";
                            row += '<th style="font-size:12px;" scope="row" class="text-center" width="10%">' + getSostenibilidadBCriterio37.cgn + '</td>';
                            row += '<td style="font-size:12px;" class="text-center" width="10%">' + getSostenibilidadBCriterio37.remanente + '</td>';
                            row += '<td style="font-size:12px;" class="text-center" width="10%">' + getSostenibilidadBCriterio37.tipo + '</td>';
                            row += '<td style="font-size:12px;" class="text-center" width="10%">' + getSostenibilidadBCriterio37.year + '</td>';
                            row += '<td style="font-size:12px;" class="text-center" width="10%">' + parseInt(200) + '</td>';
                            row += "</tr>";
                        }
                    }
                    if ($.fn.dataTable.isDataTable("#tblSostenibilidadBCriterio37")) {
                        tblDifusionDivulgacion = $("#tblSostenibilidadBCriterio37").DataTable();
                        tblDifusionDivulgacion.destroy();
                    }
                    $('#tblSostenibilidadBCriterio37 > tbody').html('');
                    $('#tblSostenibilidadBCriterio37 > tbody').append(row);
                    $('#tblSostenibilidadBCriterio37').DataTable({
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
                        lengthMenu: [[10, 15, 20, 50], [10, 15, 20, 50]]
                    });
                }
            });
        }
    </script>
@endsection
