@extends('layouts.app')

@section('title_page')
    <img src="{{ asset('img/estimulos.png') }}" width="70px" height="40px">Estimulos
@endsection

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ \App\Traits\Principal::getUrlToken('/') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Evaluaciones a directores</li>
    </ol>
@endsection

@section('content')
    @component('components.card')
        @slot('title_card', 'Listado de evaluacion a directores')
        <div class="row">
            <div class="col-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="year" style="font-size:13px;">Seleccione el año:</label>
                    </div>
                    <select class="custom-select text-center" style="font-size:13px;" id="year" onChange="ShowSelected();">
                        @for ($i = date('Y'); $i >= 2020; $i--)
                            <option value="{{ $i - 1 }}">{{ $i - 1 }}</option>
                        @endfor
                    </select>
                </div>
            </div>
        </div><br>
        <div class="table-responsive">
            <table id="tblDirectores" class="table table-bordered table-striped">
                <caption style="font-size:13px;">Listado de directores y sus respectivos puntos.</caption>
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
        <script>
            $(function(){
                $('#tblDirectores').DataTable({
                    "order":[[4, "desc"]],
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
                    lengthMenu: [[10, 15, 20], [10, 15, 20]]
                });
            });
        </script>
    @endcomponent
@endsection

@section('scripts')
    <script>
        $(document).ready(initDirectores);

        function initDirectores(){
            obtenerDirectores(0);
            // $('#btnGuardarDirectores').on('click', guardarDirector);
        }

        function ShowSelected(){
            var year = document.getElementById("year").value;
            obtenerDirectores(year);
        }

        function obtenerDirectores(year){
            if(year === 0){
                var año = document.getElementById("year").value;
            }else{
                var año = year;
            }
            // console.log(año);
            consultarDatos({
                action: "{{ config('app.url') }}/estimulos/evaluaciones/responsabilidades/directores/searchDirectores",
                type: 'GET',
                dataType: 'json',
                ok: function(searchDirectores){
                    // Para obtener los puntos para los directores...
                    consultarDatos({
                        action: "{{ config('app.url') }}/estimulos/evaluaciones/responsabilidades/directores/puntos",
                        type: 'GET',
                        dataType: 'json',
                        ok: function(puntos){
                            // console.log(puntos[0].puntos);
                            for(var i = 0; i < searchDirectores.length; i++){
                                var dataDirectores = searchDirectores[i];
                                // console.log(dataDirectores.clave);
                                var options = {
                                    action: "{{ config('app.url') }}/estimulos/evaluaciones/responsabilidades/directores/store",
                                    json: {
                                        clave: dataDirectores.clave,
                                        nombre: dataDirectores.nombre,
                                        direccion: dataDirectores.puesto,
                                        responsabilidad: 'Director de área o equivalente',
                                        puntos: puntos[0].puntos,
                                        year: año,
                                        username: dataDirectores.usuario,
                                        _token: "{{ csrf_token() }}",
                                    },
                                };
                                // console.log(options); // Se comenta para futuras pruebas...
                                guardarAutomatico(options);
                                // Finaliza codigo para guardar en el sistema...
                            }
                            consultarDatos({
                                action: "{{ config('app.url') }}/estimulos/evaluaciones/responsabilidades/directores/getDirectores/" + año,
                                type: 'GET',
                                dataType: 'json',
                                ok: function(getDirectores){
                                    var getDirectores = getDirectores.response;
                                    var row = "";
                                    // console.log(getDirectores);
                                    for(var i = 0; i < getDirectores.length; i++){
                                        var dataDirectores = getDirectores[i];
                                        // console.log(dataDirectores);
                                        var authUser = '<?= Auth::user()->usuario ?>';
                                        var permissions = '<?= Auth::user()->hasPermissionTo("estimulo-evaluaciones-directores-index") ?>';
                                        if(dataDirectores.username == authUser || permissions == 1){
                                                row += "<tr>";
                                                row += '<th scope="row" class="text-center" width="8%" style="font-size:12px;">' + dataDirectores.clave + '</td>';
                                                row += '<td width="77%" style="font-size:12px;">' + dataDirectores.nombre + "</td>";
                                                row += '<td class="text-center" width="5%" style="font-size:12px;">' + Math.trunc(dataDirectores.puntos) + '</td>';
                                                row += '<td class="text-center" width="5%" style="font-size:12px;">' + Math.trunc(dataDirectores.puntos) + '</td>';
                                                row += '<td class="text-center" width="5%" style="font-size:12px;">' + dataDirectores.year + '</td>';
                                                row += "</tr>";
                                        }
                                    }
                                    if ($.fn.dataTable.isDataTable("#tblDirectores")) {
                                        tblDifusionDivulgacion = $("#tblDirectores").DataTable();
                                        tblDifusionDivulgacion.destroy();
                                    }
                                    $('#tblDirectores > tbody').html('');
                                    $('#tblDirectores > tbody').append(row);
                                    $('#tblDirectores').DataTable({
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
                },
            });
        }

        // function guardarDirector(clave, nombre, direccion, responsabilidad, puntos, year, username){
        //     swal({
        //         type: 'warning',
        //         title: "Se guardara el registro.",
        //         text: "¿Desea continuar?",
        //         showDenyButton: true,
        //         showCancelButton: true,
        //         confirmButtonText: "Si, guardar",
        //         denyButtonText: "Cancelar",
        //     }).then((result) => {
        //         consultarDatos({
        //             action: "{{ config('app.url') }}/estimulos/evaluaciones/responsabilidades/directores/consultarDirectores/" + clave + "/" + year,
        //             type: 'GET',
        //             dataType: 'json',
        //             ok: function(data){
        //                 // console.log(data); //Se comenta para futuras pruebas...
        //                 if(data > 0){
        //                     mostrarMensaje(clave, nombre, year);
        //                 }else{
        //                     var options = {
        //                         action: "{{ config('app.url') }}/estimulos/evaluaciones/responsabilidades/directores/storeDirectores",
        //                         json: {
        //                             clave: clave,
        //                             nombre: nombre,
        //                             direccion: direccion,
        //                             responsabilidad: responsabilidad,
        //                             puntos: puntos,
        //                             year: year,
        //                             username: username,
        //                             status: 1,
        //                             _token: "{{ csrf_token() }}",
        //                         },
        //                         type: 'POST',
        //                         dateType: 'json',
        //                         mensajeConfirm: 'El registro se guardo correctamente',
        //                         url: "{{ config('app.url') }}/estimulos/evaluaciones/responsabilidades/directores/listDirectores?token={{ Session::get('token') }}"
        //                     };
        //                     peticionGeneralAjax(options);
        //                 }
        //             },
        //         });
        //     }).catch(swal.noop);
        // }

        // function mostrarMensaje(clave, nombre, year){
        //     swal({
        //         type: 'info',
        //         title: "",
        //         text: "El usuario "+nombre+" con clave "+clave+" ya se encuentra registrado para la evaluacion del año "+year+", ver historial.",
        //     });
        // }
    </script>
@endsection
