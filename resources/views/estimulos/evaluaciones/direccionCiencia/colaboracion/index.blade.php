@extends('layouts.app')

@section('title_page')
    <img src="{{ asset('img/estimulos.png') }}" width="70px" height="40px">Estimulos->Colaboracion institucional
@endsection

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ \App\Traits\Principal::getUrlToken('/') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Evaluaciones a la dirección de ciencia->Colaboracion institucional</li>
    </ol>
@endsection

@section('content')
    @component('components.card')
        @slot('title_card', 'Evaluación a la dirección de ciencia->Colaboracion institucional')
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
                <thead>
                    <tr class="text-center">
                        <th scope="col" style="font-size:13px;">Clave</th>
                        <th scope="col" style="font-size:13px;">Nombre</th>
                        <th scope="col" style="font-size:13px;">Puntos</th>
                        <th scope="col" style="font-size:13px;">Total</th>
                        <th scope="col" style="font-size:13px;">Año</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    @endcomponent
@endsection

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
                action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/colaboracion/searchColaboradores/" + año,
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
                                url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/colaboracion/saveDatos",
                                data: {
                                    token: $('#txtTokenRepo').val(),
                                    clave: dataCriterio32.clave,
                                    nombre: dataCriterio32.nombre,
                                    id_objetivo: 7,
                                    id_criterio: criterio,
                                    direccion: "DCiencia",
                                    puntos: dataCriterio32.cantidad,
                                    total_puntos: dataCriterio32.total,
                                    year: año,
                                    username: dataCriterio32.usuario,
                                },
                                headers: {
                                    'token' : $('#txtTokenRepo').val() ? $('#txtTokenRepo').val(): ''
                                },
                                success: function(data){
                                    verTablaCriterio32(year, 32);
                                }
                            });
                        }
                    }else{
                        verTablaCriterio32(year, 32);
                    }
                },
            });
        }

        function verTablaCriterio32(year, criterio) {
            consultarDatos({
                action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/colaboracion/datosColaboradores/" + year + "/" + criterio,
                type: 'GET',
                dataType: 'json',
                ok: function(datosCienciaCriterio32){
                    // console.log(datosCienciaCriterio32);
                    var datosCienciaCriterio32 = datosCienciaCriterio32.response;
                    var row = "";
                    for(var i = 0; i < datosCienciaCriterio32.length; i++){
                        var dataCienciaCriterio32 = datosCienciaCriterio32[i];
                        // console.log(dataCienciaCriterio32);
                        var authUser = '<?= Auth::user()->usuario ?>';
                        var permissions = '<?= Auth::user()->hasPermissionTo("estimulo-evaluaciones-ciencia-colaboracion-index") ?>';
                        // console.log(permissions);
                        if(dataCienciaCriterio32.username == authUser || permissions == 1){
                                row += "<tr>";
                                row += '<th scope="row" class="text-center" width="8%" style="font-size:12px;">' + dataCienciaCriterio32.clave + '</td>';
                                row += '<td width="77%" style="font-size:12px;">' + dataCienciaCriterio32.nombre.toUpperCase() + "</td>";
                                row += '<td class="text-center" width="5%" style="font-size:12px;">' + Math.trunc(dataCienciaCriterio32.puntos) + '</td>';
                                row += '<td class="text-center" width="5%" style="font-size:12px;">' + Math.trunc(dataCienciaCriterio32.total_puntos) + '</td>';
                                row += '<td class="text-center" width="5%" style="font-size:12px;">' + dataCienciaCriterio32.year + '</td>';
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
    </script>
@endsection
