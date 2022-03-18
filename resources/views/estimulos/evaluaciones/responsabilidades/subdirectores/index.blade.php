@extends('layouts.app')

@section('title_page')
    <img src="{{ asset('img/estimulos.png') }}" width="70px" height="40px">Estimulos
@endsection

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ \App\Traits\Principal::getUrlToken('/') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Evaluaciones a subdirectores</li>
    </ol>
@endsection

@section('content')
    @component('components.card')
        @slot('title_card', 'Listado de evaluacion a subdirectores')
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
            <table id="tblSubdirectores" class="table table-bordered table-striped">
                <caption style="font-size:13px;">Listado de subdirectores y sus respectivos puntos.</caption>
                <thead>
                    <tr class="text-center">
                        <th scope="col" style="font-size:13px;">Clave</th>
                        <th scope="col" style="font-size:13px;">Nombre</th>
                        <th scope="col" style="font-size:13px;">Responsabilidad</th>
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
        $(document).ready(initSubdirectores);

        function initSubdirectores(){
            obtenerSubdirectores(0);
        }

        function ShowSelected(){
            var year = document.getElementById("year").value;
            obtenerSubdirectores(year);
        }

        function obtenerSubdirectores(year){
            if(year === 0){
                var año = document.getElementById("year").value;
            }else{
                var año = year;
            }
            var direccion = 'Subdirector';
            // console.log(año);
            // Para saber si hay registros en la base de datos...
            consultarDatos({
                action: "{{ config('app.url') }}/estimulos/evaluaciones/responsabilidades/subdirectores/existe/"+año+"/"+direccion,
                type: 'GET',
                dataType: 'json',
                ok: function(existe){
                    if(existe.response == 0){
                        consultarDatos({
                            action: "{{ config('app.url') }}/estimulos/evaluaciones/responsabilidades/subdirectores/searchSubdirectores",
                            type: 'GET',
                            dataType: 'json',
                            ok: function(searchSubdirectores){
                                // Para obtener los puntos para los directores...
                                consultarDatos({
                                    action: "{{ config('app.url') }}/estimulos/evaluaciones/responsabilidades/subdirectores/puntos",
                                    type: 'GET',
                                    dataType: 'json',
                                    ok: function(puntos){
                                        // console.log(puntos);
                                        for(var i = 0; i < searchSubdirectores.length; i++){
                                            var dataSubdirectores = searchSubdirectores[i];
                                            // console.log(dataSubdirectores.clave);
                                            var options = {
                                                action: "{{ config('app.url') }}/estimulos/evaluaciones/responsabilidades/subdirectores/store",
                                                json: {
                                                    clave: dataSubdirectores.clave,
                                                    nombre: dataSubdirectores.nombre,
                                                    direccion: dataSubdirectores.puesto,
                                                    responsabilidad: 'Subdirector de área o equivalente',
                                                    puntos: puntos[0].puntos,
                                                    year: año,
                                                    username: dataSubdirectores.usuario,
                                                    _token: "{{ csrf_token() }}",
                                                },
                                            };
                                            // console.log(options); // Se comenta para futuras pruebas...
                                            guardarAutomatico(options);
                                            // Finaliza codigo para guardar en el sistema...
                                        }
                                    },
                                });
                            },
                        });
                    }
                    consultarDatos({
                        action: "{{ config('app.url') }}/estimulos/evaluaciones/responsabilidades/subdirectores/getSubdirectores/" + año,
                        type: 'GET',
                        dataType: 'json',
                        ok: function(getSubdirectores){
                            var getSubdirectores = getSubdirectores.response;
                            var row = "";
                            // console.log(getSubdirectores);
                            for(var i = 0; i < getSubdirectores.length; i++){
                                var dataSubdirectores = getSubdirectores[i];
                                // console.log(dataSubdirectores);
                                var authUser = '<?= Auth::user()->usuario ?>';
                                var permissions = '<?= Auth::user()->hasPermissionTo("estimulo-evaluaciones-subdirectores-index") ?>';
                                if(dataSubdirectores.username == authUser || permissions == 1){
                                        row += "<tr>";
                                        row += '<th scope="row" class="text-center" width="8%" style="font-size:12px;">' + dataSubdirectores.clave + '</td>';
                                        row += '<td width="62%" style="font-size:12px;">' + dataSubdirectores.nombre.toUpperCase() + "</td>";
                                        row += '<td class="text-center" width="20%" style="font-size:12px;">' + dataSubdirectores.responsabilidad.toUpperCase() + '</td>';
                                        row += '<td class="text-center" width="5%" style="font-size:12px;">' + Math.trunc(dataSubdirectores.puntos) + '</td>';
                                        row += '<td class="text-center" width="5%" style="font-size:12px;">' + dataSubdirectores.year + '</td>';
                                        row += "</tr>";
                                }
                            }
                            if ($.fn.dataTable.isDataTable("#tblSubdirectores")) {
                                tblDifusionDivulgacion = $("#tblSubdirectores").DataTable();
                                tblDifusionDivulgacion.destroy();
                            }
                            $('#tblSubdirectores > tbody').html('');
                            $('#tblSubdirectores > tbody').append(row);
                            $('#tblSubdirectores').DataTable({
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
                },
            });
        }
    </script>
@endsection
