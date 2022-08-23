@extends('layouts.app')

@section('title_page')
    <img src="{{ asset('img/recursosPropios.png') }}" width="50px" height="40px">Recursos propios
@endsection

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ \App\Traits\Principal::getUrlToken('/') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Añadir registro</li>
    </ol>
@endsection

@section('content')
    @component('components.card')
        @slot('title_card', 'Crear registro->Recursos propios')
        <div class="row">
            <div class="col-2" style="text-align: justify;">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="direcciones" id="direccionGeneral" value="Direccion General" onChange="showSelected('Direccion_General', 1);">
                    <label class="form-check-label" for="direccionGeneral">Direccion general</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="direcciones" id="direccionAdministracion" value="Direccion de Administración" onChange="showSelected('Direccion_Administracion', 2);">
                    <label class="form-check-label" for="direccionAdministracion">Direccion administración</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="direcciones" id="direccionPosgrado" value="Direccion de Posgrado" onChange="showSelected('Direccion_Posgrado', 3);">
                    <label class="form-check-label" for="direccionPosgrado">Direccion de posgrado</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="direcciones" id="direccionCiencia" value="Direccion de Ciencia" onChange="showSelected('Direccion_Ciencia', 4);">
                    <label class="form-check-label" for="direccionCiencia">Direccion de ciencia</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="direcciones" id="direccionServicios" value="Direccion de Servicios" onChange="showSelected('Direccion_Servicios', 5);">
                    <label class="form-check-label" for="direccionServicios">Direccion de servicios</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="direcciones" id="direccionTecnologia" value="Direccion de Tecnología" onChange="showSelected('Direccion_Tecnologia', 6);">
                    <label class="form-check-label" for="direccionTecnologia">Direccion de tecnología</label>
                </div><br>
                <div class="row">
                    <div class="col-6">
                        <input type="button" class="btn btn-warning" style="width:100%;" value="Calcular" id="btnCalcular" onclick="calcularPuntos();"/>
                        <input type="button" class="btn btn-primary" style="width:100%;" value="Nuevo" id="btnNuevo" onclick="nuevoRegistro();"/>
                    </div>
                    <div class="col-6">
                        <input type="button" class="btn btn-primary" style="width:100%;" value="Guardar" id="btnGuardar"/>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="table-responsive">
                    <table id="tblCalculosRP" class="table table-sm">
                        <tbody>
                            <tr>
                                <th scope="row" style="font-size:13px; vertical-align:middle;" width="10%">Facturación $:</th>
                                <th width="10%"><input type="text" class="form-control form-control-sm text-center"  name="totalRecursosPropios" id="txtTotalRecursosPropios" value="0.00" readonly></th>
                            </tr>
                            <tr>
                                <th scope="row" style="font-size:13px; vertical-align:middle;" width="10%">Contribución %:</th>
                                <th width="10%"><input type="text" class="form-control form-control-sm text-center"  name="contribucion" id="txtContribucion" value="0.00"></th>
                            </tr>
                            <tr>
                                <th scope="row" style="font-size:13px; vertical-align:middle;" width="10%">Total de personas de la dirección:</th>
                                <th width="10%"><input type="text" class="form-control form-control-sm text-center"  name="totalPersonasArea" id="txtTotalPersonasArea" value="0" readonly></th>
                            </tr>
                            <tr>
                                <th scope="row" style="font-size:13px; vertical-align:middle;" width="10%">Recursos propios $:</th>
                                <td width="10%"><input type="text" class="form-control form-control-sm text-center"  name="recursosPropios" id="txtRecursosPropios" value="0.00" readonly></th>
                            </tr>
                            <tr>
                                <th scope="row" style="font-size:13px; vertical-align:middle;" width="10%">Año:</th>
                                <th width="10%"><input type="text" class="form-control form-control-sm text-center"  name="year" id="txtYear" value="{{ date("Y") - 1 }}" readonly></th>
                            </tr>
                            <tr>
                                <th width="10%"><input type="hidden" class="form-control form-control-sm text-center"  name="direccion" id="txtDireccion" value="" readonly></th>
                                <th width="10%"><input type="hidden" class="form-control form-control-sm text-center"  name="idDireccion" id="txtIdDireccion" value="" readonly></th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-6">
                <div class="table-responsive">
                    <table id="tblRecursosPropios" class="table table-sm">
                        <thead>
                            <tr class="text-center">
                                <th scope="col" style="font-size:13px;">#</th>
                                <th scope="col" style="font-size:13px;">Dirección</th>
                                <th scope="col" style="font-size:13px;">Facturación</th>
                                <th scope="col" style="font-size:13px;">Recursos propios</th>
                                <th scope="col" style="font-size:13px;">Año</th>
                                <th scope="col" style="font-size:13px;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    @endcomponent
@endsection

@section('scripts')
    <script>
        $(document).ready(initRecursosPropios);

        function initRecursosPropios(){
            var year = $('#txtYear').val();
            obtenerFacturacion(year);
            obtenerRecursosPropios();
            $('#btnNuevo').hide();
            $('#btnGuardar').show();
            $('#btnGuardar').on('click', guardarRecursosPropios);
        }

        function obtenerRecursosPropios(){
            consultarDatos({
                action: "{{ config('app.url') }}/modulos/recursosPropios/ObtenerRecursosPropios/",
                type: 'GET',
                dataType: 'json',
                ok: function(datosRecursosPropios){
                    var dataRecursosPropios = datosRecursosPropios.response;
                    // console.log(dataRecursosPropios);
                    var row = "";
                    for(var i = 0; i < dataRecursosPropios.length; i++){
                        var getRecursosPropios = dataRecursosPropios[i];
                        // console.log(getRecursosPropios);
                        row += "<tr>";
                        row += '<th scope="row" class="text-center" width="2%" style="font-size:13px; vertical-align:middle;">' + getRecursosPropios.id + '</td>';
                        row += '<th scope="row" class="text-left" width="28%" style="font-size:13px; vertical-align:middle;">' + getRecursosPropios.direccion + '</td>';
                        row += '<td width="20%" class="text-center" style="font-size:13px; vertical-align:middle;">' + "$"+new Intl.NumberFormat().format(getRecursosPropios.facturacion) + "</td>";
                        row += '<td width="30%" class="text-center" style="font-size:13px; vertical-align:middle;">' + "$"+new Intl.NumberFormat().format(getRecursosPropios.recursos_propios) + "</td>";
                        row += '<td width="10%" class="text-center" style="font-size:13px; vertical-align:middle;">' + getRecursosPropios.year + "</td>";
                        row += '<td width="10%" class="text-center" style="font-size:13px; vertical-align:middle;">' +
                                    '<a href="javascript:verRecursoPropio('+ getRecursosPropios.year +', '+getRecursosPropios.id_direccion+')"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;'+
                                '</td>';
                        row += "</tr>";
                    }
                    if ($.fn.dataTable.isDataTable("#tblRecursosPropios")) {
                        tblDifusionDivulgacion = $("#tblRecursosPropios").DataTable();
                        tblDifusionDivulgacion.destroy();
                    }
                    $('#tblRecursosPropios > tbody').html('');
                    $('#tblRecursosPropios > tbody').append(row);
                    $('#tblRecursosPropios').DataTable({
                        "order":[[4, "asc"]],
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
                }
            });
        }

        function obtenerFacturacion(year){
            // Consultamos el calculo de los recursos propios de la tabla de puntos totales...
            consultarDatos({
                action: "{{ config('app.url') }}/modulos/recursosPropios/ObtenerDatos/" + year,
                type: 'GET',
                dataType: 'json',
                ok: function(obtenerDatosRecursosPropios){
                    var dataObtenerRecursosPropios = obtenerDatosRecursosPropios[0];
                    // console.log(dataObtenerRecursosPropios);
                    if(dataObtenerRecursosPropios != null){
                        // console.log(dataObtenerRecursosPropios.importe_facturacion);
                        $('#txtTotalRecursosPropios').val(new Intl.NumberFormat().format(dataObtenerRecursosPropios.importe_facturacion));
                    }else{
                        // console.log("Sin informacion");
                        $('#txtTotalRecursosPropios').val('0.00');
                    }
                },
            });
        }

        function showSelected(direccion, idDireccion) {
            // console.log(direccion);
            var year = $('#txtYear').val();
            let area = $('input[name="direcciones"]:checked').val();
            // console.log(idDireccion+' -> '+year);
            consultarDatos({
                action: "{{ config('app.url') }}/modulos/recursosPropios/ObtenerTotalPersonasDirecciones/" + year + "/" + direccion,
                type: 'GET',
                dataType: 'json',
                ok: function(obtenerTotalPersonasDireccion){
                    var personas = obtenerTotalPersonasDireccion[0].totalPersonas;
                    // console.log(personas);
                    $('#txtTotalPersonasArea').val(personas);
                    $('#txtDireccion').val(area);
                    $('#txtIdDireccion').val(idDireccion);
                },
            });
        }

        function calcularPuntos(){
            var txtContribucion = $('#txtContribucion').val();
            if(!document.querySelector('input[name="direcciones"]:checked')){
                swal({
                    type: 'warning',
                    text: 'Favor de seleccionar al menos una dirección para continuar.',
                    showConfirmButton: false,
                    timer: 2000
                }).catch(swal.noop);
                return;
            }else if(txtContribucion == "0.00"){
                swal({
                    type: 'warning',
                    text: 'Favor de ingresar el procentaje de contribución para continuar.',
                    showConfirmButton: false,
                    timer: 2000
                }).catch(swal.noop);
                return;
            }else{
                var facturacion = $('#txtTotalRecursosPropios').val().replace(/,/g, "");
                var contribucion = ($('#txtContribucion').val().replace(/,/g, "")) / 100;
                var totalPersonasDireccion = $('#txtTotalPersonasArea').val().replace(/,/g, "");
                var x = facturacion * contribucion;
                var recursosPropios = x / totalPersonasDireccion;
                $('#txtRecursosPropios').val(new Intl.NumberFormat().format(recursosPropios.toFixed(2)));
                // console.log(recursosPropios);
            }
        }

        function guardarRecursosPropios(){
            var direccion = $('#txtDireccion').val();
            var idDireccion = parseInt($('#txtIdDireccion').val());
            var facturacion = parseFloat($('#txtTotalRecursosPropios').val().replace(/,/g, ""));
            var contribucion = parseFloat($('#txtContribucion').val().replace(/,/g, ""));
            var personasDireccion = parseInt($('#txtTotalPersonasArea').val());
            var recursosPropios = parseFloat($('#txtRecursosPropios').val().replace(/,/g, ""));
            var year = $('#txtYear').val();
            if(direccion == "" || contribucion == "0.00" || recursosPropios == "0.00"){
                swal({
                    type: 'warning',
                    text: 'Ingrese la información y click en calcular..',
                    showConfirmButton: false,
                    timer: 2000
                }).catch(swal.noop);
                return;
            }
            // Consulta para validar si ya existe el registro correspondiente al año...
            consultarDatos({
                action: "{{ config('app.url') }}/modulos/recursosPropios/existe/" + year + "/" + idDireccion,
                type: 'GET',
                dataType: 'json',
                ok: function(existeRecursoPropio){
                    var existe = existeRecursoPropio.response;
                    // console.log(existe);
                    if(existe == 0){
                        // Guardamos los datos en la base de datos...
                        var options = {
                            action: "{{ config('app.url') }}/modulos/recursosPropios/guardarRecursosPropios",
                            json: {
                                id_direccion: idDireccion,
                                direccion: direccion,
                                facturacion: facturacion,
                                contribucion: contribucion,
                                personas_direccion: personasDireccion,
                                recursos_propios: recursosPropios,
                                year: year,
                                _token: "{{ csrf_token() }}",
                            },
                            type: 'POST',
                            dateType: 'json',
                            mensajeConfirm: 'La información se registro en el sistema.',
                            url: "{{ config('app.url') }}/modulos/recursosPropios/listRecursosPropios?token={{ Session::get('token') }}"
                        };
                        // console.log(options);
                        peticionGeneralAjax(options);
                    }else{
                        swal({
                            type: 'warning',
                            text: 'La información ya se encuentra registrado para el año '+year+'.',
                            showConfirmButton: false,
                            timer: 2500
                        }).catch(swal.noop);
                    }
                },
            });
        }

        function verRecursoPropio(year, idDireccion){
            $('#btnNuevo').show();
            $('#btnGuardar').hide();
            $('#btnCalcular').hide();
            // console.log(idDireccion + "->" + year);
            // Consulta para validar si ya existe el registro correspondiente al año...
            consultarDatos({
                action: "{{ config('app.url') }}/modulos/recursosPropios/getRecursoPropio/" + year + "/" + idDireccion,
                type: 'GET',
                dataType: 'json',
                ok: function(getRecursoPropio){
                    var dataObtenerRecursoPropio = getRecursoPropio.response[0];
                    // console.log(dataObtenerRecursoPropio.direccion);
                    if(dataObtenerRecursoPropio.id_direccion == 1){
                        document.querySelector('#direccionGeneral').checked = true;
                    }else if(dataObtenerRecursoPropio.id_direccion == 2){
                        document.querySelector('#direccionAdministracion').checked = true;
                    }else if(dataObtenerRecursoPropio.id_direccion == 3){
                        document.querySelector('#direccionPosgrado').checked = true;
                    }else if(dataObtenerRecursoPropio.id_direccion == 4){
                        document.querySelector('#direccionCiencia').checked = true;
                    }else if(dataObtenerRecursoPropio.id_direccion == 5){
                        document.querySelector('#direccionServicios').checked = true;
                    }else if(dataObtenerRecursoPropio.id_direccion == 6){
                        document.querySelector('#direccionTecnologia').checked = true;
                    }
                    $('#txtTotalRecursosPropios').val(new Intl.NumberFormat().format(dataObtenerRecursoPropio.facturacion));
                    $('#txtContribucion').val(new Intl.NumberFormat().format(dataObtenerRecursoPropio.contribucion));
                    $('#txtTotalPersonasArea').val(new Intl.NumberFormat().format(dataObtenerRecursoPropio.personas_direccion));
                    $('#txtRecursosPropios').val(new Intl.NumberFormat().format(dataObtenerRecursoPropio.recursos_propios));
                    $('#txtYear').val(dataObtenerRecursoPropio.year);
                },
            });
        }

        function nuevoRegistro(){
            document.querySelector('#direccionGeneral').checked = false;
            document.querySelector('#direccionAdministracion').checked = false;
            document.querySelector('#direccionPosgrado').checked = false;
            document.querySelector('#direccionCiencia').checked = false;
            document.querySelector('#direccionServicios').checked = false;
            document.querySelector('#direccionTecnologia').checked = false;
            var year = {{ date("Y") - 1 }};
            obtenerFacturacion(year);
            $('#txtContribucion').val('0.00');
            $('#txtTotalPersonasArea').val('0');
            $('#txtRecursosPropios').val('0.00');
            $('#txtYear').val({{ date("Y") - 1 }});
            $('#btnNuevo').hide();
            $('#btnGuardar').show();
            $('#btnCalcular').show();
        }
    </script>
@endsection
