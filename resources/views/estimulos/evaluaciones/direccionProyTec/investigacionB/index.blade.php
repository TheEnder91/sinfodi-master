@extends('layouts.app')

@section('title_page')
    <img src="{{ asset('img/estimulos.png') }}" width="70px" height="40px">Estimulos
@endsection

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ \App\Traits\Principal::getUrlToken('/') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Evaluaciones a la dirección de tecnologia->Investigacion cientifica->TablaB</li>
    </ol>
@endsection

@section('content')
    @component('components.card')
        @slot('title_card', 'Evaluaciones a la dirección de tecnologia->Investigacion cientifica -> Tabla B.')
        <div class="table-responsive" width = "100%">
            <table id="tblCriterio36" class="table table-bordered table-striped" style="font-size:13px;">
                <caption style="font-size:13px;">Prueba de concepto. (Valor del punto: 500).</caption>
                <thead>
                    <tr class="text-center">
                        <th scope="col" style="font-size:13px;">Clave</th>
                        <th scope="col" style="font-size:13px;">Nombre</th>
                        <th scope="col" style="font-size:13px;">Puntos</th>
                        <th scope="col" style="font-size:13px;">Total</th>
                        <th scope="col" style="font-size:13px;">Año</th>
                        {{-- @if (Auth::user()->hasPermissionTo("estimulo-evaluaciones-general-investigacion-index")) --}}
                            {{-- <th scope="col" style="font-size:13px;">Evidencias</th> --}}
                        {{-- @endif --}}
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    @endcomponent
@endsection

@section('scripts')
    <script>
        $(document).ready(initVerCriterio36);

        function initVerCriterio36(){
            verTablaCriterio36();
        }

        function verTablaCriterio36(){
            var year = 2022;
            var criterio = 36;
            consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionProyTec/investigacionB/datosInvestigacionB/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosProyectosCriterio36){
                var datosProyectosCriterio36 = datosProyectosCriterio36.response;
                // console.log(datosProyectosCriterio36);
                var row = "";
                for(var i = 0; i < datosProyectosCriterio36.length; i++){
                    var dataProyectosCriteri40 = datosProyectosCriterio36[i];
                    // console.log(dataProyectosCriteri40);
                    var authUser = '<?= Auth::user()->usuario ?>';
                    var permissions = '<?= Auth::user()->hasPermissionTo("estimulo-evaluaciones-proyectos-investigacionB-index") ?>';
                    // console.log(permissions);
                    if(dataProyectosCriteri40.username == authUser || permissions == 1){
                            row += "<tr>";
                            row += '<th style="font-size:12px;" scope="row" class="text-center" width="10%">' + dataProyectosCriteri40.clave + '</td>';
                            row += '<td style="font-size:12px;" width="60%">' + dataProyectosCriteri40.nombre.toUpperCase() + "</td>";
                            row += '<td style="font-size:12px;" class="text-center" width="10%">' + parseInt(dataProyectosCriteri40.puntos) + '</td>';
                            row += '<td style="font-size:12px;" class="text-center" width="10%">' + parseInt(dataProyectosCriteri40.total_puntos) + '</td>';
                            row += '<td style="font-size:12px;" class="text-center" width="10%">' + dataProyectosCriteri40.year + '</td>';
                            row += "</tr>";
                    }
                }
                if ($.fn.dataTable.isDataTable("#tblCriterio36")) {
                    tblDifusionDivulgacion = $("#tblCriterio36").DataTable();
                    tblDifusionDivulgacion.destroy();
                }
                $('#tblCriterio36 > tbody').html('');
                $('#tblCriterio36 > tbody').append(row);
                $('#tblCriterio36').DataTable({
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
