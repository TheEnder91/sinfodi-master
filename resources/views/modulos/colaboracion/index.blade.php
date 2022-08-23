@extends('layouts.app')

@section('title_page')
    <img src="{{ asset('img/colaboracion.png') }}" width="50px" height="40px">Colaboración institucional
@endsection

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ \App\Traits\Principal::getUrlToken('/') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Añadir registro</li>
    </ol>
@endsection

@section('content')
    @component('components.card')
        @slot('title_card', 'Crear registro->Colaboracion institucional')
        <div class="row">
            <input type="text" class="form-control form-control-sm text-center"  name="id" id="txtId">
            <div class="col-1">
                <label class="col-form-label" style="font-size:13px;">Clave:</label>
                <input type="text" class="form-control form-control-sm text-center"  name="clave" id="txtClave" readonly>
            </div>
            <div class="col-5">
                <label class="col-form-label" style="font-size:13px;"><span style="color: red">*</span>Nombre:</label>
                <div class="ui-widget">
                    <input type="text" class="form-control form-control-sm" name="nombre" id="txtNombre" autocomplete="off">
                </div>
            </div>
            <div class="col-1">
                <label class="col-form-label" style="font-size:13px;">Usuario:</label>
                <input type="text" class="form-control form-control-sm text-center" name="usuario" id="txtUsuario" readonly>
            </div>
            <div class="col-1">
                <label class="col-form-label" style="font-size:13px;">Valor punto:</label>
                <input type="text" class="form-control form-control-sm text-center" name="valor" id="txtValor" value="{{ $puntos->puntos }}" readonly>
            </div>
            <div class="col-1">
                <label class="col-form-label" style="font-size:13px;">Cantidad:</label>
                <input type="text" class="form-control form-control-sm text-center" name="cantidad" id="txtCantidad" value="0" readonly>
            </div>
            <div class="col-1">
                <label class="col-form-label" style="font-size:13px;">Total:</label>
                <input type="text" class="form-control form-control-sm text-center" name="total" id="txtTotal" value="0" readonly>
            </div>
            <div class="col-1">
                <label class="col-form-label" style="font-size:13px;">Total:</label>
                <input type="text" class="form-control form-control-sm text-center" name="year" id="txtYear" value="{{ date("Y") - 1 }}" readonly>
            </div>
        </div>
        <div class="row">
            <div class="col-11">
                <label class="col-form-label"><span style="font-size:13px; color:red">*</span>Seleccione un comite:
                    <a href="javascript:agregarComite()"><i class="fa fa-plus"></i>Agregar comite</a>
                </label>
                <div style="column-count:6; list-style: none;" id="listComites"></div>
            </div>
            <div class="col-1">
                <div class="float-right">
                    <input type="button" class="btn btn-primary" value="Guardar" id="btnGuardar"/>
                </div>
                <div class="float-right">
                    <input type="button" class="btn btn-primary" value="Actualizar" id="btnActualizar"/>
                </div>
            </div>
        </div><br>
        <div class="table-responsive">
            <table id="tblColaboradores" class="table table-bordered table-striped">
                <thead>
                    <tr class="text-center">
                        <th scope="col" style="font-size:13px;">#</th>
                        <th scope="col" style="font-size:13px;">Nombre del colaborador</th>
                        <th scope="col" style="font-size:13px;">Comites</th>
                        <th scope="col" style="font-size:13px;">Valor</th>
                        <th scope="col" style="font-size:13px;">Cantidad</th>
                        <th scope="col" style="font-size:13px;">Total</th>
                        <th scope="col" style="font-size:13px;">Año</th>
                        <th scope="col" style="font-size:13px;">Acciones</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
        @include('modulos.colaboracion.modaAgregarComite')
    @endcomponent
@endsection

@section('scripts')
    <script>
        $(document).ready(initColaboracion);

        function initColaboracion(){
            var year = $('#txtYear').val();
            listarComites(year);
            $('#btnActualizar').hide();
            $('#txtId').hide();
            $('#btnGuardar').show();
            ConsutarColaborador();
            obtenerDatos();
            $('#btnGuardarComites').on('click', guardarComite);
            $('#btnGuardar').on('click', guardarColaborador);
            $('#btnActualizar').on('click', actualizarColaborador);
        }

        function listarComites(year){
            consultarDatos({
                action: "{{ config('app.url') }}/modulos/colaboracion/listComites/"+ year,
                type: 'GET',
                dataType: 'json',
                ok: function(datosComites){
                    var row = "";
                    for(var i = 0; i < datosComites.length; i++){
                        var dataComites = datosComites[i];
                        // console.log(dataComites);
                        row += '<div class="custom-control custom-checkbox">';
                        row += '<input type="checkbox" class="custom-control-input comites" name="comites[]" data-name-display="'+dataComites.consecutivo+'" id="comites'+dataComites.consecutivo+'" value="'+dataComites.consecutivo+'" onClick="contarComites({{ $puntos->puntos }});">';
                        row += '<label class="custom-control-label" for="comites'+dataComites.consecutivo+'" style="font-size:13px;">'+dataComites.consecutivo+'-'+dataComites.nombre+'</label>';
                        row += '</div>';
                    }
                    $("#listComites").html(row).fadeIn('slow');
                },
            });
        }

        function agregarComite(){
            var year = $('#txtYearComite').val();
            consultarDatos({
                action: "{{ config('app.url') }}/modulos/colaboracion/ultimoComite/"+ year,
                type: 'GET',
                dataType: 'json',
                ok: function(numeroUltimoComite){
                    // console.log(numeroUltimoComite);
                    if(numeroUltimoComite.length > 0){
                        var ultimoConsecutivo = parseInt(numeroUltimoComite[0].consecutivo) + 1;
                        $('#txtNumeroComite').val(ultimoConsecutivo);
                    }else{
                        $('#txtNumeroComite').val(1);
                    }
                }
            });
            var numeroComite = $('#txtNumeroComite').val();
            $('#modaAgregarComite').modal({backdrop: 'static', keyboard: false});
            consultarDatos({
                action: "{{ config('app.url') }}/modulos/colaboracion/getComites",
                type: 'GET',
                dataType: 'json',
                ok: function(datosGetComites){
                    // console.log(datosGetComites);
                    var row = "";
                    for(var i = 0; i < datosGetComites.length; i++){
                        var dataGetComites = datosGetComites[i];
                        // console.log(dataGetComites);
                        row += "<tr>";
                        row += '<th scope="row" class="text-left" width="90%" style="font-size:12px;">' + dataGetComites.nombre + '</td>';
                        row += '<td width="5%" class="text-center" style="font-size:12px;"><a href="javascript:verDocumento('+ dataGetComites.id +', '+dataGetComites.consecutivo+', '+dataGetComites.year+', \''+dataGetComites.url_archivo+'\')"><i class="fa fa-file"></i></a></i></td>';
                        row += '<td class="text-center" width="5%" style="font-size:12px;">' + dataGetComites.year + '</td>';
                        row += "</tr>";
                    }
                    // $("#listComites").html(row).fadeIn('slow');
                    if ($.fn.dataTable.isDataTable("#tblComites")) {
                        tblDifusionDivulgacion = $("#tblComites").DataTable();
                        tblDifusionDivulgacion.destroy();
                    }
                    $('#tblComites > tbody').html('');
                    $('#tblComites > tbody').append(row);
                    $('#tblComites').DataTable({
                        "order":[[2, "desc"]],
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
                        lengthMenu: [[5, 10, 15, 20], [5, 10, 15, 20]]
                    });
                },
            });
        }

        function obtenerDatos(){
            consultarDatos({
                action: "{{ config('app.url') }}/modulos/colaboracion/datosColaboradores/",
                type: 'GET',
                dataType: 'json',
                ok: function(datosColaboradores){
                    // console.log(datosColaboradores);
                    var datosColaboradores = datosColaboradores.response;
                    var row = "";
                    for(var i = 0; i < datosColaboradores.length; i++){
                        var dataColaboradores = datosColaboradores[i];
                        // console.log(dataColaboradores);
                        row += "<tr>";
                        row += '<th scope="row" class="text-center" width="5%" style="font-size:12px;">' + dataColaboradores.clave + '</td>';
                        row += '<td width="65%" style="font-size:12px;">' + dataColaboradores.nombre.toUpperCase() + "</td>";
                        row += '<td class="text-center" width="5%" style="font-size:12px;">' + dataColaboradores.comites + '</td>';
                        row += '<td class="text-center" width="5%" style="font-size:12px;">' + dataColaboradores.valor + '</td>';
                        row += '<td class="text-center" width="5%" style="font-size:12px;">' + dataColaboradores.cantidad + '</td>';
                        row += '<td class="text-center" width="5%" style="font-size:12px;">' + dataColaboradores.total + '</td>';
                        row += '<td class="text-center" width="5%" style="font-size:12px;">' + dataColaboradores.year + '</td>';
                        row += '<td class="text-center" width="5%" style="font-size:12px;">'+
                                    '<a href="javascript:editarColaboradores('+ dataColaboradores.id +', '+dataColaboradores.clave+', '+dataColaboradores.year+')"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;'+
                                    '<a href="javascript:eliminarColaboradores('+ dataColaboradores.id +')"><i class="fa fa-trash-alt"></i></a>'+
                                '</td>';
                        row += "</tr>";
                    }
                    if ($.fn.dataTable.isDataTable("#tblColaboradores")) {
                        tblDifusionDivulgacion = $("#tblColaboradores").DataTable();
                        tblDifusionDivulgacion.destroy();
                    }
                    $('#tblColaboradores > tbody').html('');
                    $('#tblColaboradores > tbody').append(row);
                    $('#tblColaboradores').DataTable({
                        "order":[[6, "desc"]],
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
            var comites = [];
            var serieComite = "";
            $('input.comites:checked').each(function(){
                comites.push(this.value);
            });
            for(var i = 0; i < comites.length; i++){
                var serieComite = comites.join(',');
            }
            if(nombre == ""){
                swal({
                    type: 'warning',
                    text: 'Favor de llenar los campos marcados con un *.',
                    showConfirmButton: false,
                    timer: 1800
                }).catch(swal.noop);
                return;
            }
            let desmarcar = serieComite.split(',');
            if(desmarcar == ""){
                swal({
                    type: 'warning',
                    text: 'Seleccione al menos un comite.',
                    showConfirmButton: false,
                    timer: 1800
                }).catch(swal.noop);
                return;
            }
            consultarDatos({
                action: "{{ config('app.url') }}/modulos/colaboracion/existeColaboracion/" + year + "/" + clave,
                type: 'GET',
                dataType: 'json',
                ok: function(existeDataColaborador){
                    var existe = existeDataColaborador.response;
                    // console.log(existe);
                    if(existe == 0){
                        var options = {
                            action: "{{ config('app.url') }}/modulos/colaboracion/savePuntosColaboradores",
                            json: {
                                clave: clave,
                                nombre: nombre,
                                usuario: usuario,
                                comites: serieComite,
                                valor: valor,
                                cantidad: cantidad,
                                total: total,
                                year: year,
                                _token: "{{ csrf_token() }}",
                            },
                            type: 'POST',
                            dateType: 'json',
                            mensajeConfirm: 'Se ha registrado el colaborador con exito.',
                            url: "{{ config('app.url') }}/modulos/colaboracion/listColaboracion?token={{ Session::get('token') }}"
                        };
                        // console.log(options); // Se comenta para futuras pruebas...
                        peticionGeneralAjax(options);
                        obtenerDatos();
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

        function guardarComite(){
            var ultimoConsecutivoComite = $('#txtNumeroComite').val();
            var nombreComite = $('#txtNombreComite').val();
            var descripcionComite = $('#txtDescripcionComite').val();
            var archivo = $("#txtDocumentoComite").val();
            var yearComite = $('#txtYearComite').val();
            var urlArchivo = ("{{ config('app.url') }}/public/comites/"+nombreComite+"_"+yearComite+".pdf").split(' ').join('_');
            if(nombreComite == ""){
                swal({
                    type: 'warning',
                    text: 'Ingrese el nombre del comite.',
                    showConfirmButton: false,
                    timer: 1800
                }).catch(swal.noop);
                return;
            }
            if(archivo === ""){
                swal({
                    type: 'warning',
                    text: 'Seleccione el documento en formato *.pdf',
                    showConfirmButton: false,
                    timer: 1800
                }).catch(swal.noop);
                return;
            }else{
                var documentoComite = document.getElementById('txtDocumentoComite').files[0].name;
            }
            consultarDatos({
                action: "{{ config('app.url') }}/modulos/colaboracion/existeComite/" + yearComite + "/" + ultimoConsecutivoComite,
                type: 'GET',
                dataType: 'json',
                ok: function(existeDataComite){
                    // console.log(existeDataComite);
                    if(existeDataComite == 0){
                        var options = {
                            action: "{{ config('app.url') }}/modulos/colaboracion/saveComite",
                            json: {
                                consecutivo: ultimoConsecutivoComite,
                                nombre: nombreComite,
                                descripcion: descripcionComite,
                                url_archivo: urlArchivo,
                                year: yearComite,
                                _token: "{{ csrf_token() }}",
                            },
                            type: 'POST',
                            dateType: 'json',
                            mensajeConfirm: 'Se ha registrado el comite con exito.',
                            url: "{{ config('app.url') }}/modulos/colaboracion/listColaboracion?token={{ Session::get('token') }}"
                        };
                        // console.log(options); // Se comenta para futuras pruebas...
                        peticionGeneralAjax(options);
                    }else{
                        swal({
                            type: 'warning',
                            text: 'El comite '+nombreComite+' ya se encuentra registrado para el año '+yearComite+'.',
                            showConfirmButton: false,
                            timer: 2500
                        }).catch(swal.noop);
                    }
                }
            });
        }

        function editarColaboradores(id, claveEmpleado, year){
            var comites = [];
            var serieComite = "";
            $('input.comites:checked').each(function(){
                comites.push(this.value);
            });
            for(var i = 0; i < comites.length; i++){
                var serieComite = comites.join(',');
            }
            let desmarcar = serieComite.split(',');
            if(desmarcar != ""){
                for(var i = 0; i < desmarcar.length; i++){
                    // console.log(desmarcar[i]);
                    document.getElementById("comites"+desmarcar[i]).checked = false;
                }
            }
            $(".comites").prop("checked", this.checked);
            $('#btnActualizar').show();
            $('#btnGuardar').hide();
            consultarDatos({
                action: "{{ config('app.url') }}/modulos/colaboracion/getColaboradores/"+id+"/"+claveEmpleado+"/"+year,
                type: 'GET',
                dataType: 'json',
                ok: function(datosColaboradores){
                    var dataColaborador = datosColaboradores.response[0];
                    // console.log(datosColaboradores.response[0].nombre);
                    $('#txtId').val(dataColaborador.id);
                    $('#txtClave').val(dataColaborador.clave);
                    $('#txtNombre').val(dataColaborador.nombre);
                    $('#txtUsuario').val(dataColaborador.usuario);
                    $('#txtValor').val(dataColaborador.valor);
                    $('#txtCantidad').val(dataColaborador.cantidad);
                    $('#txtTotal').val(dataColaborador.total);
                    $('#txtYear').val(dataColaborador.year);
                    let str = dataColaborador.comites;
                    let arr = str.split(',');
                    //dividir la cadena de texto por una coma
                    // console.log(arr);
                    for(var i = 0; i < arr.length; i++){
                        // console.log(arr[i]);
                        document.getElementById("comites"+arr[i]).checked = true;
                    }
                },
            });
        }

        function actualizarColaborador(){
            var id = $('#txtId').val();
            var clave = $('#txtClave').val();
            var nombre = $('#txtNombre').val();
            var usuario = $('#txtUsuario').val();
            var valor = $('#txtValor').val();
            var cantidad = $('#txtCantidad').val();
            var total = $('#txtTotal').val();
            var year = $('#txtYear').val();
            var comites = [];
            var serieComite = "";
            $('input.comites:checked').each(function(){
                comites.push(this.value);
            });
            for(var i = 0; i < comites.length; i++){
                var serieComite = comites.join(',');
            }
            if(nombre == ""){
                swal({
                    type: 'warning',
                    text: 'Favor de llenar los campos marcados con un *.',
                    showConfirmButton: false,
                    timer: 1800
                }).catch(swal.noop);
                return;
            }
            let desmarcar = serieComite.split(',');
            if(desmarcar == ""){
                swal({
                    type: 'warning',
                    text: 'Seleccione al menos un comite.',
                    showConfirmButton: false,
                    timer: 1800
                }).catch(swal.noop);
                return;
            }
            // console.log(id);
            var options = {
                action: "{{ config('app.url') }}/modulos/colaboracion/updateColaboracion/" + id,
                json: {
                    clave: clave,
                    nombre: nombre,
                    usuario: usuario,
                    comites: serieComite,
                    cantidad: cantidad,
                    total: total,
                    _token: "{{ csrf_token() }}",
                },
                type: 'PUT',
                dateType: 'json',
                mensajeConfirm: 'El registro se actualizo correctamente',
                url: "{{ config('app.url') }}/modulos/colaboracion/listColaboracion?token={{ Session::get('token') }}"
            };
            // console.log(options);
            peticionGeneralAjax(options);
        }

        function eliminarColaboradores(id){
            swal({
                type: 'warning',
                title: "Se eliminara el registro.",
                text: "¿Desea continuar?",
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: "Si, eliminar",
                denyButtonText: "Cancelar",
            }).catch(swal.noop).then((result) => {
                var options = {
                    action: "{{ config('app.url') }}/modulos/colaboracion/destroyColaboracion/" + id,
                    json: {
                        _token: "{{ csrf_token() }}",
                        _method: 'DELETE',
                    },
                    type: 'POST',
                    dateType: 'json',
                    mensajeConfirm: 'El registro se elimino correctamente',
                    url: "{{ config('app.url') }}/modulos/colaboracion/listColaboracion?token={{ Session::get('token') }}"
                };
                peticionGeneralAjax(options);
            });
        }
    </script>
@endsection
