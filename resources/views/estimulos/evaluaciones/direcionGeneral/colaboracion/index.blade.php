@extends('layouts.app')

@section('title_page')
    <img src="{{ asset('img/estimulos.png') }}" width="70px" height="40px">Estimulos
@endsection

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ \App\Traits\Principal::getUrlToken('/') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Evaluaciones a la dirección de Ciencia->Colaboracion institucional</li>
    </ol>
@endsection

@section('content')
    @component('components.card')
        @slot('title_card', 'Evaluación a la dirección general->Colaboracion institucional')
        <div class="row">
            <div class="col-1">
                <label class="col-form-label">Clave:</label>
                <input type="text" class="form-control form-control-sm text-center" name="clave" id="txtClave" readonly>
            </div>
            <div class="col-5">
                <label class="col-form-label">Nombre:</label>
                <div class="ui-widget">
                    <input type="text" class="form-control form-control-sm" name="nombre" id="txtNombre" autocomplete="off">
                </div>
            </div>
            <div class="col-1">
                <label class="col-form-label">Usuario:</label>
                <input type="text" class="form-control form-control-sm text-center" name="usuario" id="txtUsuario" readonly>
            </div>
            <div class="col-1">
                <label class="col-form-label">Valor punto:</label>
                <input type="text" class="form-control form-control-sm text-center" name="valor" id="txtValor" value="{{ $puntos->puntos }}" readonly>
            </div>
            <div class="col-1">
                <label class="col-form-label">Cantidad:</label>
                <input type="text" class="form-control form-control-sm text-center" name="cantidad" id="txtCantidad" value="0" readonly>
            </div>
            <div class="col-1">
                <label class="col-form-label">Total:</label>
                <input type="text" class="form-control form-control-sm text-center" name="total" id="txtTotal" value="0" readonly>
            </div>
            <div class="col-1">
                <label class="col-form-label">Total:</label>
                <input type="text" class="form-control form-control-sm text-center" name="year" id="txtYear" value="{{ date("Y") - 1 }}" readonly>
            </div>
        </div>
        <div class="row">
            <div class="col-11">
                <div style="column-count:6; list-style: none;">
                    @foreach ($comites as $itemComites)
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input comites" name="comites[]" id="comites{{ $itemComites->id }}" value="{{ $itemComites->id }}" onClick="contarComites({{ $puntos->puntos }});">
                            <label class="custom-control-label" for="comites{{ $itemComites->id }}">{{ $itemComites->nombre }}</label>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-1">
                <div class="float-right">
                    @can('estimulo-evaluaciones-general-colaboracion-index')
                        <input type="button" class="btn btn-primary" value="Guardar" id="btnGuardar"/>
                    @endcan
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="year">Seleccione el año:</label>
                    </div>
                    <select class="custom-select text-center" id="year" onChange="ShowSelected();">
                        @for ($i = date('Y'); $i >= 2020; $i--)
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
                        <th scope="col">Clave</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Puntos</th>
                        <th scope="col">Total</th>
                        <th scope="col">Año</th>
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
            ConsutarColaborador();
            $('#btnGuardar').on('click', guardarColaborador);
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
                action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/colaboracion/searchColaboradores/" + año,
                type: 'GET',
                dataType: 'json',
                ok: function(datosCritero32){
                    var datosCriterio32 = datosCritero32.response;
                    // console.log(datosCritero32);
                    // Codigo para guardar en el sistema...
                    for(var i = 0; i < datosCriterio32.length; i++){
                        var dataCriterio32 = datosCriterio32[i];
                        var options = {
                        action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/DifDiv/saveDatosDifDiv",
                            json: {
                                clave: dataCriterio32.clave,
                                nombre: dataCriterio32.nombre,
                                id_objetivo: 7,
                                id_criterio: criterio,
                                direccion: "DGeneral",
                                puntos: dataCriterio32.cantidad,
                                total_puntos: dataCriterio32.total,
                                year: año,
                                username: dataCriterio32.usuario,
                                _token: "{{ csrf_token() }}",
                            },
                            type: 'POST',
                            dateType: 'json',
                        };
                        // console.log(options); // e comenta para futuras pruebas...
                        guardarAutomatico(options);
                        // Finaliza codigo para guardar en el sistema...
                    }
                    consultarDatos({
                        action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/colaboracion/datosColaboradores/" + año + "/" + criterio,
                        type: 'GET',
                        dataType: 'json',
                        ok: function(datosGeneralCriterio32){
                            // console.log(datosGeneralCriterio32);
                            var datosGeneralCriterio32 = datosGeneralCriterio32.response;
                            var row = "";
                            for(var i = 0; i < datosGeneralCriterio32.length; i++){
                                var dataGeneralCriterio32 = datosGeneralCriterio32[i];
                                console.log(dataGeneralCriterio32);
                                var authUser = '<?= Auth::user()->usuario ?>';
                                var permissions = '<?= Auth::user()->hasPermissionTo("estimulo-evaluaciones-general-colaboracion-index") ?>';
                                // console.log(permissions);
                                if(dataGeneralCriterio32.username == authUser || permissions == 1){
                                        row += "<tr>";
                                        row += '<th scope="row" class="text-center" width="10%">' + dataGeneralCriterio32.clave + '</td>';
                                        row += '<td width="40%">' + dataGeneralCriterio32.nombre + "</td>";
                                        row += '<td class="text-center" width="10%">' + dataGeneralCriterio32.puntos + '</td>';
                                        row += '<td class="text-center" width="10%">' + dataGeneralCriterio32.total_puntos + '</td>';
                                        row += '<td class="text-center" width="10%">' + dataGeneralCriterio32.year + '</td>';
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
                },
            });
        }

        function contarComites(puntos){
            // Parte para contar la cantidad de comites a la que pertenece...
            var comites = [];
            $('input.comites:checked').each(function(){
                comites.push(this.value);
            });
            var cantidad = comites.length;
            $('#txtCantidad').val(cantidad);
            //Parte para sacar el total de puntos dependiendo de los comites a los que pertenece...
            // console.log(puntos);
            var totalPuntos = cantidad * puntos;
            $('#txtTotal').val(totalPuntos);
        }

        // Edgar Carrasco->(05/11/2021): Funcion para autocompletar el nombre de los alumnos...
        function ConsutarColaborador(){
            $("#txtNombre").autocomplete({
                source: function (request, response) {
                    $.ajax({
                        url: "{{ route('buscar.colaborador') }}",
                        type: "POST",
                        dateType: "json",
                        data: {
                            nombre: request.term,
                            _token: "{{ csrf_token() }}",
                        },
                        success: function (data){
                            response($.map(data.response, function(item){
                                return {
                                    label: item.nombre,
                                    value: item.nombre,
                                    id: item.clave,
                                    clave: item.clave,
                                    id: item.usuario,
                                    usuario: item.usuario,
                                };
                            }));
                            // console.log(data.response); // Edgar Carrasco->(05/11/2021): Se comenta para futuras pruebas...
                        },
                    });
                },
                minlength: 2,
                select: function (event, ui) {
                    if (ui.item) {
                        $("#txtClave").val(ui.item.clave);
                        $("#txtUsuario").val(ui.item.usuario);
                    }
                },
            });
        }

        function guardarColaborador(){
            var clave = $('#txtClave').val();
            var nombre = $('#txtNombre').val();
            var usuario = $('#txtUsuario').val();
            var valor = $('#txtValor').val();
            var cantidad = $('#txtCantidad').val();
            var total = $('#txtTotal').val();
            var year = $('#txtYear').val();
            if(clave == "" || nombre == "" || valor == 0 || cantidad == 0 || total == 0){
                swal({
                    type: 'warning',
                    title: 'Favor de llenar los campos.',
                    showConfirmButton: false,
                    timer: 1800
                }).catch(swal.noop);
                return;
            }
            consultarDatos({
                action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/colaboracion/existeColaboracion/" + year + "/" + clave,
                type: 'GET',
                dataType: 'json',
                ok: function(existeDataCriterio32){
                    var existe = existeDataCriterio32.response;
                    // console.log(existe);
                    if(existe == 0){
                        var options = {
                            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/colaboracion/savePuntosColaboradores",
                            json: {
                                clave: clave,
                                nombre: nombre,
                                usuario: usuario,
                                valor: valor,
                                cantidad: cantidad,
                                total: total,
                                year: year,
                                _token: "{{ csrf_token() }}",
                            },
                            type: 'POST',
                            dateType: 'json',
                            mensajeConfirm: 'Se han actualizado los puntos para la evaluación.',
                            url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/colaboracion/listColaboracion?token={{ Session::get('token') }}"
                        };
                        // console.log(options); // Se comenta para futuras pruebas...
                        peticionGeneralAjax(options);
                        obtenerCriterio32(year);
                    }else{
                        swal({
                            type: 'warning',
                            text: 'El usuario '+nombre+' con clave '+clave+' ya se encuentra registrado para el año '+year+'.',
                            showConfirmButton: false,
                            timer: 2500
                        }).catch(swal.noop);
                    }
                },
            });
        }
    </script>
@endsection
