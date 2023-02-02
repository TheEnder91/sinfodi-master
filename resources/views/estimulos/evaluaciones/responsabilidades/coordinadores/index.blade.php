@extends('layouts.app')

@section('title_page')
    <img src="{{ asset('img/estimulos.png') }}" width="70px" height="40px">Estimulos
@endsection

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ \App\Traits\Principal::getUrlToken('/') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Evaluaciones a coordinadores</li>
    </ol>
@endsection

@section('content')
    @component('components.card')
        @slot('title_card', 'Listado de evaluacion a coordinadores')
        <div class="row">
            <div class="col-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="year" style="font-size:13px;">Seleccione el año:</label>
                    </div>
                    <select class="custom-select text-center" style="font-size:13px;" id="year" onChange="ShowSelected();">
                        @for ($i = date('Y'); $i >= 2021; $i--)
                            <option value="{{ $i - 1 }}">{{ $i - 1 }}</option>
                        @endfor
                    </select>
                </div>
            </div>
        </div><br>
        <div class="table-responsive">
            <table id="tblCoordinadores" class="table table-bordered table-striped">
                <caption style="font-size:13px;">Listado de coordinadores y sus respectivos puntos.</caption>
                <thead>
                    <tr class="text-center">
                        <th scope="col" style="font-size:13px;">Clave</th>
                        <th scope="col" style="font-size:13px;">Nombre</th>
                        <th scope="col" style="font-size:13px;">Puesto</th>
                        <th scope="col" style="font-size:13px;">Puntos</th>
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
        $(document).ready(initCoordinadores);

        function initCoordinadores(){
            obtenerCoordinadores(0);
        }

        function ShowSelected(){
            var year = document.getElementById("year").value;
            obtenerCoordinadores(year);
        }

        function obtenerCoordinadores(year){
            if(year === 0){
                var año = document.getElementById("year").value;
            }else{
                var año = year;
            }
            // console.log(año);
            var direccion = 'Coordinadores';
            // Para saber si hay registros en la base de datos...
            consultarDatos({
                action: "{{ config('app.url') }}/estimulos/evaluaciones/responsabilidades/subdirectores/existe/"+año+"/"+direccion,
                type: 'GET',
                dataType: 'json',
                ok: function(existe){
                    // console.log(existe.response);
                    if(existe.response == 0){
                        consultarDatos({
                            action: "{{ config('app.url') }}/estimulos/evaluaciones/responsabilidades/Coordinadores/searchCoordinadores/"+año,
                            type: 'GET',
                            dataType: 'json',
                            ok: function(searchCoordinadores){
                                // console.log(searchCoordinadores);
                                // Para obtener los puntos para los directores...
                                consultarDatos({
                                    action: "{{ config('app.url') }}/estimulos/evaluaciones/responsabilidades/Coordinadores/puntos",
                                    type: 'GET',
                                    dataType: 'json',
                                    ok: function(puntos){
                                        // console.log(puntos[0].puntos);
                                        if(searchCoordinadores.length > 0){
                                            for(var i = 0; i < searchCoordinadores.length; i++){
                                                var dataCoordinadores = searchCoordinadores[i];
                                                // console.log(dataCoordinadores.clave);
                                                $.ajax({
                                                    type: 'POST',
                                                    url: "{{ config('app.url') }}/estimulos/evaluaciones/responsabilidades/Coordinadores/store",
                                                    data: {
                                                        clave: dataCoordinadores.clave,
                                                        nombre: dataCoordinadores.nombre,
                                                        direccion: direccion,
                                                        responsabilidad: 'Coordinador de área o equivalente',
                                                        puntos: puntos[0].puntos,
                                                        year: año,
                                                        username: dataCoordinadores.usuario,
                                                    },
                                                    headers: {
                                                        'token' : $('#txtTokenRepo').val() ? $('#txtTokenRepo').val(): ''
                                                    },
                                                    success: function(data){
                                                        verTablaCoordinadores(año);
                                                    }
                                                });
                                            }
                                        }else{
                                            verTablaCoordinadores(año);
                                        }
                                    },
                                });
                            },
                        });
                    }else{
                        verTablaCoordinadores(año);
                    }
                },
            });
        }

        function verTablaCoordinadores(year){
            consultarDatos({
                action: "{{ config('app.url') }}/estimulos/evaluaciones/responsabilidades/Coordinadores/getCoordinadores/" + year,
                type: 'GET',
                dataType: 'json',
                ok: function(getCoordinadores){
                    var getCoordinadores = getCoordinadores.response;
                    var row = "";
                    // console.log(getCoordinadores);
                    for(var i = 0; i < getCoordinadores.length; i++){
                        var dataCoordinadores = getCoordinadores[i];
                        // console.log(dataCoordinadores);
                        var authUser = '<?= Auth::user()->usuario ?>';
                        var permissions = '<?= Auth::user()->hasPermissionTo("estimulo-evaluaciones-directores-index") ?>';
                        if(dataCoordinadores.username == authUser || permissions == 1){
                            row += "<tr>";
                            row += '<th scope="row" class="text-center" width="8%" style="font-size:12px;">' + dataCoordinadores.clave + '</td>';
                            row += '<td width="62%" style="font-size:12px;">' + dataCoordinadores.nombre.toUpperCase() + "</td>";
                            row += '<td class="text-center" width="20%" style="font-size:12px;">' + dataCoordinadores.responsabilidad.toUpperCase() + '</td>';
                            row += '<td class="text-center" width="5%" style="font-size:12px;">' + Math.trunc(dataCoordinadores.puntos) + '</td>';
                            row += '<td class="text-center" width="5%" style="font-size:12px;">' + dataCoordinadores.year + '</td>';
                            row += "</tr>";
                        }
                    }
                    if ($.fn.dataTable.isDataTable("#tblCoordinadores")) {
                        tblDifusionDivulgacion = $("#tblCoordinadores").DataTable();
                        tblDifusionDivulgacion.destroy();
                    }
                    $('#tblCoordinadores > tbody').html('');
                    $('#tblCoordinadores > tbody').append(row);
                    $('#tblCoordinadores').DataTable({
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
