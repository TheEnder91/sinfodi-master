@extends('layouts.app')

@section('title_page')
    <img src="{{ asset('img/estimulos.png') }}" width="70px" height="40px">Estimulos
@endsection

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ \App\Traits\Principal::getUrlToken('/') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Evaluaciones a personal de apoyo</li>
    </ol>
@endsection

@section('content')
    @component('components.card')
        @slot('title_card', 'Listado de evaluacion a personal de apoyo')
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
            <table id="tblPersonalApoyo" class="table table-bordered table-striped">
                <caption style="font-size:13px;">Listado de personal de apoyo, y sus respectivos puntos.</caption>
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
        $(document).ready(initPersonalApoyo);

        function initPersonalApoyo(){
            obtenerPersonalApoyo(0);
        }

        function ShowSelected(){
            var year = document.getElementById("year").value;
            obtenerPersonalApoyo(year);
        }

        function obtenerPersonalApoyo(year){
            if(year === 0){
                var año = document.getElementById("year").value;
            }else{
                var año = year;
            }
            // console.log(año);
            var direccion = 'Personal_Apoyo';
            // Para saber si hay registros en la base de datos...
            consultarDatos({
                action: "{{ config('app.url') }}/estimulos/evaluaciones/responsabilidades/personalApoyo/existe/"+año+"/"+direccion,
                type: 'GET',
                dataType: 'json',
                ok: function(existe){
                    // console.log(existe.response);
                    if(existe.response == 0){
                        consultarDatos({
                            action: "{{ config('app.url') }}/estimulos/evaluaciones/responsabilidades/personalApoyo/searchPersonalApoyo",
                            type: 'GET',
                            dataType: 'json',
                            ok: function(searchPersonalApoyo){
                                // console.log(searchPersonalApoyo);
                                // Para obtener los puntos para los directores...
                                consultarDatos({
                                    action: "{{ config('app.url') }}/estimulos/evaluaciones/responsabilidades/personalApoyo/puntos",
                                    type: 'GET',
                                    dataType: 'json',
                                    ok: function(puntos){
                                        // console.log(puntos[0].puntos);
                                        if(searchPersonalApoyo.length > 0){
                                            for(var i = 0; i < searchPersonalApoyo.length; i++){
                                                var dataPersonalApoyo = searchPersonalApoyo[i];
                                                // console.log(dataPersonalApoyo.clave);
                                                $.ajax({
                                                    type: 'POST',
                                                    url: "{{ config('app.url') }}/estimulos/evaluaciones/responsabilidades/personalApoyo/store",
                                                    data: {
                                                        clave: dataPersonalApoyo.clave,
                                                        nombre: dataPersonalApoyo.nombre,
                                                        direccion: dataPersonalApoyo.puesto,
                                                        responsabilidad: 'Personal de apoyo de área o equivalente',
                                                        puntos: puntos[0].puntos,
                                                        year: año,
                                                        username: dataPersonalApoyo.usuario,
                                                    },
                                                    headers: {
                                                        'token' : $('#txtTokenRepo').val() ? $('#txtTokenRepo').val(): ''
                                                    },
                                                    success: function(data){
                                                        verTablaPersonalApoyo(año);
                                                    }
                                                });
                                            }
                                        }else{
                                            verTablaPersonalApoyo(año);
                                        }
                                    },
                                });
                            },
                        });
                    }else{
                        verTablaPersonalApoyo(año);
                    }
                },
            });
        }

        function verTablaPersonalApoyo(year){
            consultarDatos({
                action: "{{ config('app.url') }}/estimulos/evaluaciones/responsabilidades/personalApoyo/getPersonalApoyo/" + year,
                type: 'GET',
                dataType: 'json',
                ok: function(getPersonalApoyo){
                    var getPersonalApoyo = getPersonalApoyo.response;
                    var row = "";
                    // console.log(getPersonalApoyo);
                    for(var i = 0; i < getPersonalApoyo.length; i++){
                        var dataPersonalApoyo = getPersonalApoyo[i];
                        // console.log(dataPersonalApoyo);
                        var authUser = '<?= Auth::user()->usuario ?>';
                        var permissions = '<?= Auth::user()->hasPermissionTo("estimulo-evaluaciones-apoyo-index") ?>';
                        if(dataPersonalApoyo.username == authUser || permissions == 1){
                            row += "<tr>";
                            row += '<th scope="row" class="text-center" width="8%" style="font-size:12px;">' + dataPersonalApoyo.clave + '</td>';
                            row += '<td width="57%" style="font-size:12px;">' + dataPersonalApoyo.nombre.toUpperCase() + "</td>";
                            row += '<td class="text-center" width="25%" style="font-size:12px;">' + dataPersonalApoyo.responsabilidad.toUpperCase() + '</td>';
                            row += '<td class="text-center" width="5%" style="font-size:12px;">' + Math.trunc(dataPersonalApoyo.puntos) + '</td>';
                            row += '<td class="text-center" width="5%" style="font-size:12px;">' + dataPersonalApoyo.year + '</td>';
                            row += "</tr>";
                        }
                    }
                    if ($.fn.dataTable.isDataTable("#tblPersonalApoyo")) {
                        tblDifusionDivulgacion = $("#tblPersonalApoyo").DataTable();
                        tblDifusionDivulgacion.destroy();
                    }
                    $('#tblPersonalApoyo > tbody').html('');
                    $('#tblPersonalApoyo > tbody').append(row);
                    $('#tblPersonalApoyo').DataTable({
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
