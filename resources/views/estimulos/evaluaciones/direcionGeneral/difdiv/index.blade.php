@extends('layouts.app')

@section('title_page')
    <img src="{{ asset('img/estimulos.png') }}" width="70px" height="40px">Estimulos
@endsection

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ \App\Traits\Principal::getUrlToken('/') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Evaluaciones a la dirección General</li>
    </ol>
@endsection

@section('content')
    @component('components.card')
        @slot('title_card', 'Evaluación a la dirección general->Difusión y Divulgación')
        <div class="row">
            <div class="col-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="year">Seleccione el año:</label>
                    </div>
                    <select class="custom-select" id="year" onChange="ShowSelected();">
                        @for ($i = date('Y'); $i >= 2020; $i--)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>
            </div>
        </div><br>
        <div class="table-responsive">
            <table id="tblDifusionDivulgacion" class="table table-bordered table-striped">
                <thead>
                    <tr class="text-center">
                        <th scope="col">Clave</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Puntos</th>
                        <th scope="col">Total</th>
                        <th scope="col">Año</th>
                        <th scope="col">Evidencias</th>
                        {{-- <th scope="col">Evidencias DIF</th> --}}
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
        @include('estimulos.evaluaciones.direcionGeneral.difdiv.modalEvidencias')
    @endcomponent
@endsection

@section('scripts')
    <script>
        $(document).ready(initVer);

        function initVer(){
            VerDatos(0);
            $('#btnActualizar').on('click', actualizarEvidencias);
        }

        function ShowSelected(){
            /* Para obtener el valor */
            var cod = document.getElementById("year").value;
            // alert(cod);
            VerDatos(cod);
        }

        function VerDatos(fecha){
            if(fecha === 0){
                var year = document.getElementById("year").value;
            }else{
                var year = fecha;
            }
            consultarDatos({
                action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/DifDiv/searchDifDIv/" + year,
                type: 'GET',
                dataType: 'json',
                ok: function(data){
                    // console.log(data);
                    var datos = data.response;
                    for(var i = 0; i < datos.length; i++){
                        var data = datos[i];
                        // Codigo para guardar en el sistema...
                        var options = {
                            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/DifDiv/saveDatos",
                            json: {
                                clave: data.numero_personal,
                                nombre: data.nombre,
                                id_objetivo: 1,
                                id_criterio: 1,
                                direccion: "DGeneral",
                                puntos: 0,
                                total_puntos: 0,
                                year: year,
                                username: data.username,
                                _token: "{{ csrf_token() }}",
                            },
                            type: 'POST',
                            dateType: 'json',
                        };
                        guardarAutomatico(options);
                        // console.log(options); // e comenta para futuras pruebas...
                        // Finaliza codigo para guardar en el sistema...
                    }
                    consultarDatos({
                        action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/DifDiv/datosDifDIv/" + year,
                        type: 'GET',
                        dataType: 'json',
                        ok: function(datosGeneral){
                            // console.log(datosGeneral);
                            var dataGeneral = datosGeneral.response;
                            var row = "";
                            for(var i = 0; i < dataGeneral.length; i++){
                                var data = dataGeneral[i];
                                // console.log(data.username);
                                var authUser = '<?= Auth()->user()->usuario ?>';
                                var permissions = '<?= Auth::user()->hasPermissionTo("estimulo-evaluaciones-general-difusiondivulgacion-index") ?>';
                                // console.log(permissions);
                                if(data.username == authUser || permissions == 1){
                                    row += "<tr>";
                                    row += '<th scope="row" class="text-center" width="10%">' + data.clave + '</td>';
                                    row += '<td width="40%">' + data.nombre + "</td>";
                                    row += '<td class="text-center" width="10%">' + data.puntos + '</td>';
                                    row += '<td class="text-center" width="10%">' + data.total_puntos + '</td>';
                                    row += '<td class="text-center" width="10%">' + data.year + '</td>';
                                    row += '<td class="text-center" width="10%"><a href="javascript:editarEvidencias(' + data.year + ', ' + data.clave + ')"><i class="fa fa-edit"></i></a></td>';
                                    row += "</tr>";
                                }
                            }
                            if ($.fn.dataTable.isDataTable("#tblDifusionDivulgacion")) {
                                tblDifusionDivulgacion = $("#tblDifusionDivulgacion").DataTable();
                                tblDifusionDivulgacion.destroy();
                            }
                            $('#tblDifusionDivulgacion > tbody').html('');
                            $('#tblDifusionDivulgacion > tbody').append(row);
                            $('#tblDifusionDivulgacion').DataTable({
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

        function editarEvidencias(fecha, clave){
            if(fecha === 0){
                var year = document.getElementById("year").value;
            }else{
                var year = fecha;
            }
            consultarDatos({
                action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/DifDiv/searchEvidenciasDifDIv/" + year + "/" + clave,
                type: 'GET',
                dataType: 'json',
                ok: function(data){
                    // console.log(data); //Comentamos para futuras pruebas...
                    consultarDatos({
                        action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/DifDiv/obtenerEvidencias/" + clave + "/" + year,
                        type: 'GET',
                        dataType: 'json',
                        ok: function(data){
                            for(var i = 0; i < data.response.length; i++){
                                // console.log(data.response[i].clave_evidencia); // Se comenta para futuras pruebas...
                                var seleccion = data.response[i].clave_evidencia;
                                $('input[value="' + seleccion + '"]').prop('checked', true);
                            }
                        },
                    });
                    $('#clave').val(clave);
                    $('#year').val(year);
                    $('#modalEvidencias').modal('show');
                    var datos = data.response;
                    var row = "";
                    for(var i = 0; i < datos.length; i++){
                        // console.log(data); //Comentamos para futuras pruebas...
                        var claveData = datos[i];
                        row += '<div class="col-12 col-md-2 text-center">';
                        row += '<a href="http://126.107.2.56/SINFODI/Files/SINFODI-DivulgacionPromocion/' + claveData.clave + '.pdf" target="_blank">';
                        row += '<img src="{{ asset('img/pdf2.png') }}" width="60px" height="60px">';
                        row += '</a><br>';
                        row += '<b><input type="checkbox" class="evidencias" name="evidencias[]" id="evidencias'+claveData.clave+'" value="'+claveData.clave+'"> ' + claveData.clave + '</b>';
                        row += '</div>';
                    }
                    $("#contenedor").html(row).fadeIn('slow');
                },
            });
        }

        function actualizarEvidencias(){
            var clave = $('#clave').val();
            var year = $('#year').val();
            var evidencias = [];
            var puntos = 0;
            var id = 1;
            consultarDatos({
                action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/DifDiv/searchEvidencias/" + clave + "/" + year,
                type: 'GET',
                dataType: 'json',
                ok: function(data){
                    // console.log(data.response); // Comentamos para futuras pruebas...
                    var existe = data.response;
                    consultarDatos({
                        action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/DifDiv/puntos/" + id,
                        type: 'GET',
                        dataType: 'json',
                        ok: function(data){
                            // console.log(data.response.puntos); // Comentamos para futuras pruebas...
                            $('input.evidencias:checked').each(function(){
                                evidencias.push(this.value);
                                puntos = puntos + parseInt(data.response.puntos);
                            });
                            if(puntos == 0){
                                swal({
                                    type: 'warning',
                                    title: 'Favor de seleccionar las evidencias.',
                                    showConfirmButton: false,
                                    timer: 1800
                                }).catch(swal.noop);
                            }else if(puntos > 50){
                                swal({
                                    type: 'error',
                                    title: 'Se a dopado.',
                                    showConfirmButton: false,
                                    timer: 1800
                                }).catch(swal.noop);
                            }else{
                                if(existe == 0){
                                    for(var i = 0; i < evidencias.length; i++){
                                        // console.log(evidencias[i]); // Se comenta para futuras pruebas...
                                        var options = {
                                            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/DifDiv/savePuntos",
                                            json: {
                                                clave: clave,
                                                clave_evidencia: evidencias[i],
                                                puntos: puntos / parseInt(data.response.puntos),
                                                total_puntos: puntos,
                                                year: year,
                                                _token: "{{ csrf_token() }}",
                                            },
                                            type: 'POST',
                                            dateType: 'json',
                                            mensajeConfirm: 'Se han actualizado los puntos para la evaluación.',
                                            url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/DifDiv/listDifDIv?token={{ Session::get('token') }}"
                                        };
                                        // console.log(options); // Se comenta para futuras pruebas...
                                        peticionGeneralAjax(options);
                                    }
                                    actualizarDatosGeneral(clave, year);
                                }else{
                                    deletePuntosEvidencia(clave, year);
                                    for(var i = 0; i < evidencias.length; i++){
                                        console.log(evidencias[i]); // Se comenta para futuras pruebas...
                                        var options = {
                                            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/DifDiv/savePuntos",
                                            json: {
                                                clave: clave,
                                                clave_evidencia: evidencias[i],
                                                puntos: puntos / parseInt(data.response.puntos),
                                                total_puntos: puntos,
                                                year: year,
                                                _token: "{{ csrf_token() }}",
                                            },
                                            type: 'POST',
                                            dateType: 'json',
                                            mensajeConfirm: 'Se han actualizado los puntos para la evaluación.',
                                            url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/DifDiv/listDifDIv?token={{ Session::get('token') }}"
                                        };
                                        // console.log(options); // Se comenta para futuras pruebas...
                                        peticionGeneralAjax(options);
                                    }
                                    actualizarDatosGeneral(clave, year);
                                }
                            }
                        },
                    });
                },
            });
        }

        function actualizarDatosGeneral(clave, year){
            consultarDatos({
                action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/DifDiv/updateDatos/" + clave + "/" + year,
                type: 'GET',
                dataType: 'json',
                ok: function(data){
                    console.log("Puntos actualizados");
                },
            });
        }

        function deletePuntosEvidencia(clave, year){
            var optionsDelete = {
                action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/DifDiv/deletePuntos/" + clave + "/" + year,
                json: {
                    _token: "{{ csrf_token() }}",
                    _method: 'DELETE',
                },
                type: 'POST',
                dateType: 'json',
            };
            guardarAutomatico(optionsDelete);
        }
    </script>
@endsection
