@extends('layouts.app')

@section('title_page')
    <img src="{{ asset('img/estimulos.png') }}" width="70px" height="40px">Estimulos->Colaboracion institucional
@endsection

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ \App\Traits\Principal::getUrlToken('/') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Evaluaciones a la dirección de servicios tecnologicos->Colaboracion institucional</li>
    </ol>
@endsection

@section('content')
    @component('components.card')
        @slot('title_card', 'Evaluación a la dirección de servicios tecnologicos->Colaboracion institucional')
        <div class="row">
            <div class="col-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="year" style="font-size:13px;">Seleccione el año a evaluar:</label>
                    </div>
                    <select class="custom-select text-center" id="year" onChange="ShowSelected();" style="font-size:13px;">
                        @for ($i = date('Y'); $i >= 2021; $i--)
                            <option value="{{ $i - 1 }}">{{ $i - 1 }}</option>
                        @endfor
                    </select>
                </div>
            </div>
        </div><br>
        <div class="table-responsive">
            <table id="tblCriterio32" class="table table-bordered table-striped">
                <caption style="font-size:13px;">Puntos por las personas que participan en algun grupo institucional (Valor del punto: 10)</caption>
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

<div class="modal fade bd-example-modal-lg" id="detalleCriterio32ModalLabel" tabindex="-1" role="dialog" aria-labelledby="detalleCriterio32ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modalColaboracion">
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
                                    <table id="tblColaboracionCriterio32" class="table table-bordered table-striped display" style="font-size:13px;">
                                        <caption style="font-size:13px;">Listado de comites o grupos a los que participa.</caption>
                                        <thead>
                                            <tr class="text-center">
                                                <th scope="col" style="font-size:13px; vertical-align:middle;">#</th>
                                                <th scope="col" style="font-size:13px; vertical-align:middle;">Comite</th>
                                                <th scope="col" style="font-size:13px; vertical-align:middle;">Documento</th>
                                                <th scope="col" style="font-size:13px; vertical-align:middle;">Puntos</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="3" style="text-align:right">Suma:</th>
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
        $(document).ready(initCriterio32);

        function initCriterio32(){
            obtenerCriterio32(0);
        }

        function ShowSelected(){
            var year = document.getElementById("year").value;
            obtenerCriterio32(year);
        }

        function obtenerCriterio32(year){
            if(year === 0){
                var año = document.getElementById("year").value;
            }else{
                var año = year;
            }
            // console.log(año);
            var criterio = 32;
            consultarDatos({
                action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/colaboracion/searchColaboradores/" + año,
                type: 'GET',
                dataType: 'json',
                ok: function(datosCritero32){
                    var datosCriterio32 = datosCritero32.response;
                    // console.log(datosCritero32);
                    // Codigo para guardar en el sistema...
                    if(datosCriterio32.length > 0){
                        for(var i = 0; i < datosCriterio32.length; i++){
                            var dataCriterio32 = datosCriterio32[i];
                            $.ajax({
                                type: 'POST',
                                url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/colaboracion/saveDatos",
                                data: {
                                    token: $('#txtTokenRepo').val(),
                                    clave: dataCriterio32.clave,
                                    nombre: dataCriterio32.nombre,
                                    id_objetivo: 7,
                                    id_criterio: criterio,
                                    direccion: "DServTec",
                                    puntos: dataCriterio32.cantidad,
                                    total_puntos: dataCriterio32.total,
                                    year: año,
                                    username: dataCriterio32.usuario,
                                },
                                headers: {
                                    'token' : $('#txtTokenRepo').val() ? $('#txtTokenRepo').val(): ''
                                },
                                success: function(data){
                                    verTablaCriterio32(año, 32);
                                }
                            });
                        }
                    }else{
                        verTablaCriterio32(año, 32);
                    }
                },
            });
        }

        function verTablaCriterio32(year, criterio) {
            consultarDatos({
                action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/colaboracion/datosColaboradores/" + year + "/" + criterio,
                type: 'GET',
                dataType: 'json',
                ok: function(datosServiciosCriterio32){
                    // console.log(datosServiciosCriterio32);
                    var datosServiciosCriterio32 = datosServiciosCriterio32.response;
                    var row = "";
                    for(var i = 0; i < datosServiciosCriterio32.length; i++){
                        var dataServiciosCriterio32 = datosServiciosCriterio32[i];
                        // console.log(dataServiciosCriterio32);
                        var authUser = '<?= Auth::user()->usuario ?>';
                        var permissions = '<?= Auth::user()->hasPermissionTo("estimulo-evaluaciones-servicios-colaboracion-index") ?>';
                        // console.log(permissions);
                        if(dataServiciosCriterio32.username == authUser || permissions == 1){
                                row += "<tr>";
                                row += '<th scope="row" class="text-center" width="8%" style="font-size:12px;">' + dataServiciosCriterio32.clave + '</td>';
                                row += '<td width="77%" style="font-size:12px;">' + dataServiciosCriterio32.nombre.toUpperCase() + "</td>";
                                row += '<td class="text-center" width="5%" style="font-size:12px;">' + Math.trunc(dataServiciosCriterio32.puntos) + '</td>';
                                row += '<td class="text-center" width="5%" style="font-size:12px;">' + Math.trunc(dataServiciosCriterio32.total_puntos) + '</td>';
                                row += '<td class="text-center" width="5%" style="font-size:12px;">' + dataServiciosCriterio32.year + '</td>';
                                row += '<td class="text-center" width="5%" style="font-size:12px;"><a href="javascript:verDetalleCriterio32(' + dataServiciosCriterio32.year + ', ' + dataServiciosCriterio32.clave + ')"><i class="fa fa-search"></i></a></td>';
                                row += "</tr>";
                        }
                    }
                    if ($.fn.dataTable.isDataTable("#tblCriterio32")) {
                        tblDifusionDivulgacion = $("#tblCriterio32").DataTable();
                        tblDifusionDivulgacion.destroy();
                    }
                    $('#tblCriterio32 > tbody').html('');
                    $('#tblCriterio32 > tbody').append(row);
                    $('#tblCriterio32').DataTable({
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

        function verDetalleCriterio32(year, clave){
            $('#detalleCriterio32ModalLabel').modal({backdrop: 'static', keyboard: false});
            document.getElementById('tituloModal').innerHTML='Visualizar comites en los que participa.';
            var puntos = 10;
            consultarDatos({
                action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/colaboracion/getComiteColaboracion/" + year + "/" + clave,
                type: 'GET',
                dataType: 'json',
                ok: function(datosColaboracionesCriterio32){
                    // console.log(datosColaboracionesCriterio32);
                    var row = "";
                    for(var i = 0; i < datosColaboracionesCriterio32.length; i++){
                        var dataColaboracionCriterio32 = datosColaboracionesCriterio32[i];
                        var url1 = "{{ url('/archivos/nombre') }}";
                        var url_archivo = url1.replace('nombre', dataColaboracionCriterio32.url_archivo);
                        row += "<tr>";
                        row += '<th scope="row" class="text-center" width="15%" style="font-size:12px; vertical-align:middle;">' + dataColaboracionCriterio32.consecutivo + '</td>';
                        row += '<td width="40%" style="font-size:12px; vertical-align:middle;">' + dataColaboracionCriterio32.nombre.toUpperCase() + "</td>";
                        row += '<td class="text-center" width="25%" style="font-size:12px; vertical-align:middle;"><a href="' + url_archivo + '" target=_blank><i class="fa fa-eye"></i></a></td>';
                        row += '<td class="text-center" width="20%" style="font-size:12px; vertical-align:middle;">' + puntos + '</td>';
                        row += "</tr>";
                    }
                    if ($.fn.dataTable.isDataTable("#tblColaboracionCriterio32")) {
                        tblDifusionDivulgacion = $("#tblColaboracionCriterio32").DataTable();
                        tblDifusionDivulgacion.destroy();
                    }
                    $('#tblColaboracionCriterio32 > tbody').html('');
                    $('#tblColaboracionCriterio32 > tbody').append(row);
                    $('#tblColaboracionCriterio32').DataTable({
                        footerCallback: function(row, data, start, end, display) {
                            var api = this.api();
                            var intVal = function(i){
                                return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
                            };
                            if(api.column(3).data().length){
                                var pageTotal = api
                                    .column(3, {page: 'current'})
                                    .data()
                                    .reduce(function(a, b){
                                        return intVal(a) + intVal(b);
                                    });
                            }else{
                                var pageTotal = 0;
                            }
                            $(api.column(3).footer()).html(pageTotal);
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
                        lengthMenu: [[5, 10, 20, 50], [5, 10, 20, 50]]
                    });
                },
            });
        }
    </script>
@endsection
