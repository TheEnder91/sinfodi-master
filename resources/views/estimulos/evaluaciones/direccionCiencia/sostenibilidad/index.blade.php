@extends('layouts.app')

@section('title_page')
    <img src="{{ asset('img/estimulos.png') }}" width="70px" height="40px">Estimulos
@endsection

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ \App\Traits\Principal::getUrlToken('/') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Evaluaciones a la dirección de ciencia->Sostentabilidad economica</li>
    </ol>
@endsection

@section('content')
    @component('components.card')
        @slot('title_card', 'Evaluación a la dirección de ciencia->Sostentabilidad economica')
        <div class="row">
            <div class="col-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="year">Seleccione el año:</label>
                    </div>
                    <select class="custom-select" id="year" onChange="ShowSelected();">
                        @for ($i = date('Y'); $i >= 2021; $i--)
                            <option value="{{ $i - 1 }}">{{ $i - 1 }}</option>
                        @endfor
                    </select>
                </div>
            </div>
        </div><br>
        <div class="table-responsive">
            <table id="tblCriterio14" class="table table-bordered table-striped">
                <caption style="font-size:13px;">Monto ingresado a CIDETEQ por proyectos patrocinados, comercializados, servicios especiales, cursos.</caption>
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
            consultarDatos({
                action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/sostentabilidad/searchSostentabilidad/" + año,
                type: 'GET',
                dataType: 'json',
                ok: function(datosCritero14){
                    var datosCriterio14 = datosCritero14.response;
                    // console.log(datosCritero14);
                    // Codigo para guardar en el sistema...
                    for(var i = 0; i < datosCriterio14.length; i++){
                        var dataCriterio14 = datosCriterio14[i];
                        var options = {
                            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/sostentabilidad/saveDatosSostentabilidad",
                            json: {
                                clave: dataCriterio14.clave_participante,
                                nombre: dataCriterio14.nombre_participante,
                                id_objetivo: 4,
                                id_criterio: criterio,
                                direccion: "DCiencia",
                                puntos: 0,
                                total_puntos: dataCriterio14.total,
                                year: dataCriterio14.year,
                                username: dataCriterio14.usuario_participante,
                                _token: "{{ csrf_token() }}",
                            },
                            type: 'POST',
                            dateType: 'json',
                        };
                        // console.log(options); // e comenta para futuras pruebas...
                        guardarAutomatico(options);
                        // Finaliza codigo para guardar en el sistema...
                    }
                    verTablaCriterio14(año, 14);
                },
            });
        }

        function verTablaCriterio14(year, criterio){
            consultarDatos({
                action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/sostentabilidad/datosSostentabilidad/" + year + "/" + criterio,
                type: 'GET',
                dataType: 'json',
                ok: function(datosCienciaCriterio14){
                    // console.log(datosCienciaCriterio14);
                    var datosCienciaCriterio14 = datosCienciaCriterio14.response;
                    var row = "";
                    for(var i = 0; i < datosCienciaCriterio14.length; i++){
                        var dataCienciaCriterio14 = datosCienciaCriterio14[i];
                        // console.log(dataCienciaCriterio14);
                        var authUser = '<?= Auth::user()->usuario ?>';
                        var permissions = '<?= Auth::user()->hasPermissionTo("estimulo-evaluaciones-ciencia-sostentabilidad-index") ?>';
                        // console.log(permissions);
                        if(dataCienciaCriterio14.username == authUser || permissions == 1){
                                row += "<tr>";
                                row += '<th scope="row" class="text-center" width="8%" style="font-size:12px;">' + dataCienciaCriterio14.clave + '</td>';
                                row += '<td width="77%" style="font-size:12px;">' + dataCienciaCriterio14.nombre.toUpperCase() + "</td>";
                                row += '<td class="text-center" width="5%" style="font-size:12px;">' + parseInt(dataCienciaCriterio14.puntos) + '</td>';
                                row += '<td class="text-center" width="5%" style="font-size:12px;">' + dataCienciaCriterio14.total_puntos + '</td>';
                                row += '<td class="text-center" width="5%" style="font-size:12px;">' + dataCienciaCriterio14.year + '</td>';
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
    </script>
@endsection
