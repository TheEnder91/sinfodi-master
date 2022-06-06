@extends('layouts.app')

@section('title_page')
    <img src="{{ asset('img/puntosTotales.png') }}" width="60px" height="60px">Puntos totales
@endsection

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ \App\Traits\Principal::getUrlToken('/') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Puntos totales</li>
    </ol>
@endsection

@section('content')
    @component('components.card')
        @slot('title_card', 'Puntos totales')
        <div class="container-fluid">
            <div class="row">
                <div class="col-5">
                    <div class="table-responsive">
                        <table id="tblCalculos" class="table table-sm">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col" style="font-size:13px;"></th>
                                    <th scope="col" style="font-size:13px;">Cantidad</th>
                                    <th scope="col" style="font-size:13px;">Porcentajes</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row" style="font-size:13px; vertical-align:middle;" width="40%">Importe:</th>
                                    <td width="30%"><input type="text" class="form-control form-control-sm text-center"  name="importeTotal" id="txtImporteTotal" value="0.00"></td>
                                    <td width="30%"><input type="text" class="form-control form-control-sm text-center"  name="porcentajeImporteTotal" id="txtPorcentajeImporteTotal" readonly value="0"></td>
                                </tr>
                                <tr>
                                    <th scope="row" style="font-size:13px; vertical-align:middle;" width="40%">Actividad individual:</th>
                                    <td width="30%"><input type="text" class="form-control form-control-sm text-center"  name="actividadIndividual" id="txtActividadIndividual" value="0.00" readonly></td>
                                    <td width="30%"><input type="text" class="form-control form-control-sm text-center"  name="porcentajeActividadIndividual" id="txtPorcentajeActividadIndividual" value="0" onkeyup="SumarPorcentaje();"></td>
                                </tr>
                                <tr>
                                    <th scope="row" style="font-size:13px; vertical-align:middle;" width="40%">Facturación:</th>
                                    <td width="30%"><input type="text" class="form-control form-control-sm text-center"  name="facturacion" id="txtFacturacion" value="0.00" readonly></td>
                                    <td width="30%"><input type="text" class="form-control form-control-sm text-center"  name="porcentajeFacturacion" id="txtPorcentajeFacturacion" value="0" onkeyup="SumarPorcentaje();"></td>
                                </tr>
                                <tr>
                                    <th scope="row" style="font-size:13px; vertical-align:middle;" width="40%">Fondos en administración:</th>
                                    <td width="30%"><input type="text" class="form-control form-control-sm text-center"  name="fondosAdmin" id="txtFondosAdmin" value="0.00" readonly></td>
                                    <td width="30%"><input type="text" class="form-control form-control-sm text-center"  name="porcentajeFondosAdmin" id="txtPorcentajeFondosAdmin" value="0" onkeyup="SumarPorcentaje();"></td>
                                </tr>
                                <tr>
                                    <th scope="row" style="font-size:13px; vertical-align:middle;" width="40%">Por responsabilidad:</th>
                                    <td width="30%"><input type="text" class="form-control form-control-sm text-center"  name="responsabilidad" id="txtResponsabilidad" value="0.00" readonly></td>
                                    <td width="30%"><input type="text" class="form-control form-control-sm text-center"  name="porcentajeResponsabilidad" id="txtPorcentajeResponsabilidad" value="0" onkeyup="SumarPorcentaje();"></td>
                                </tr>
                                <tr>
                                    <th scope="row" style="font-size:13px; vertical-align:middle;" width="40%">Total puntos responsabilidad:</th>
                                    <td width="30%"><input type="text" class="form-control form-control-sm text-center"  name="totalPuntosResponsabilidad" id="txtTotalPuntosResponsabilidad" value="0" readonly></td>
                                    <td width="30%">
                                        <input type="button" class="btn btn-warning" style="width:100%;" value="Calcular" id="btnCalcular" onclick="calcularPuntos();"/>
                                        <input type="button" class="btn btn-primary" style="width:100%;" value="Nuevo registro" id="btnNuevo" onclick="nuevoRegistro();"/>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row" style="font-size:13px; vertical-align:middle;" width="40%">Valor punto responsabilidad:</th>
                                    <td width="30%"><input type="text" class="form-control form-control-sm text-center"  name="valorPuntoResponsabilidad" id="txtValorPuntoResponsabilidad" value="0" readonly></td>
                                    <td width="30%">
                                        <input type="button" class="btn btn-primary" style="width:100%;" value="Guardar" id="btnGuardar"/>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row" style="font-size:13px; vertical-align:middle;" width="40%">Total puntos A * 0.3:</th>
                                    <td width="30%"><input type="text" class="form-control form-control-sm text-center"  name="totalPuntosTotalA" id="txtTotalPuntosTotalA" value="0" readonly></td>
                                    <td width="30%"></td>
                                </tr>
                                <tr>
                                    <th scope="row" style="font-size:13px; vertical-align:middle;" width="40%">Total puntos B * 0.7:</th>
                                    <td width="30%"><input type="text" class="form-control form-control-sm text-center"  name="totalPuntosTotalB" id="txtTotalPuntosTotalB" value="0" readonly></td>
                                    <td width="30%"></td>
                                </tr>
                                <tr>
                                    <th scope="row" style="font-size:13px; vertical-align:middle;" width="40%">Total puntos A y B:</th>
                                    <td width="30%"><input type="text" class="form-control form-control-sm text-center"  name="totalPuntosTotalAB" id="txtTotalPuntosTotalAB" value="0" readonly></td>
                                    <td width="30%"></td>
                                </tr>
                                <tr>
                                    <th scope="row" style="font-size:13px; vertical-align:middle;" width="40%">Aqui va algo:</th>
                                    <td width="30%"><input type="text" class="form-control form-control-sm text-center"  name="variableX" id="txtVariableX" value="0" readonly></td>
                                    <td width="30%"></td>
                                </tr>
                                <tr>
                                    <th scope="row" style="font-size:13px; vertical-align:middle;" width="40%">Valor por punto($):</th>
                                    <td width="30%"><input type="text" class="form-control form-control-sm text-center"  name="valorPunto" id="txtValorPunto" value="0" readonly></td>
                                    <td width="30%"></td>
                                </tr>
                                <tr>
                                    <th scope="row" style="font-size:13px; vertical-align:middle;" width="40%">Año:</th>
                                    <td width="30%"><input type="text" class="form-control form-control-sm text-center"  name="year" id="txtYear" value="{{ date("Y") - 2 }}" readonly></td>
                                    <td width="30%"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-7">
                    <div class="table-responsive">
                        <table id="tblTotalPuntos" class="table table-bordered table-striped" style="font-size:13px;">
                            <caption style="font-size:13px;">Registro del calculo de puntos totales</caption>
                            <thead>
                                <tr class="text-center">
                                    <th scope="col" style="font-size:13px; vertical-align:middle;">Año</th>
                                    <th scope="col" style="font-size:13px; vertical-align:middle;">Monto $</th>
                                    <th scope="col" style="font-size:13px; vertical-align:middle;">Valor responsabilidad</th>
                                    <th scope="col" style="font-size:13px; vertical-align:middle;">Valor A y B</th>
                                    <th scope="col" style="font-size:13px; vertical-align:middle;">Acciones</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endcomponent
@endsection

@section('scripts')
    <script>
        $(document).ready(initPuntosTotales);

        function initPuntosTotales(){
            verTablaPuntosTotales();
            $('#btnNuevo').hide();
            $('#btnGuardar').on('click', guardarPuntosTotales);
        }

        function verTablaPuntosTotales(){
            consultarDatos({
                action: "{{ config('app.url') }}/modulos/puntosTotales/getTotalPuntos",
                type: 'GET',
                dataType: 'json',
                ok: function(datosPuntosTotales){
                    var dataPuntosTotales = datosPuntosTotales.response;
                    // console.log(dataPuntosTotales);
                    var row = "";
                    for(var i = 0; i < dataPuntosTotales.length; i++){
                        var getPuntosTotales = dataPuntosTotales[i];
                        // console.log(getPuntosTotales);
                        row += "<tr>";
                        row += '<th scope="row" class="text-center" width="15%" style="font-size:13px; vertical-align:middle;">' + getPuntosTotales.year + '</td>';
                        row += '<td width="20%" class="text-center" style="font-size:13px; vertical-align:middle;">' + "$"+new Intl.NumberFormat().format(getPuntosTotales.importe) + "</td>";
                        row += '<td width="35%" class="text-center" style="font-size:13px; vertical-align:middle;">' + "$"+new Intl.NumberFormat().format(getPuntosTotales.valor_punto_responsabilidad) + "</td>";
                        row += '<td width="20%" class="text-center" style="font-size:13px; vertical-align:middle;">' + "$"+new Intl.NumberFormat().format(getPuntosTotales.valor_punto_actividades) + "</td>";
                        row += '<td width="10%" class="text-center" style="font-size:13px; vertical-align:middle;">' +
                                    '<a href="javascript:verTotalPuntos('+ getPuntosTotales.id +', '+getPuntosTotales.year+')"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;'+
                                '</td>';
                        row += "</tr>";
                    }
                    if ($.fn.dataTable.isDataTable("#tblTotalPuntos")) {
                        tblDifusionDivulgacion = $("#tblTotalPuntos").DataTable();
                        tblDifusionDivulgacion.destroy();
                    }
                    $('#tblTotalPuntos > tbody').html('');
                    $('#tblTotalPuntos > tbody').append(row);
                    $('#tblTotalPuntos').DataTable({
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
                }
            });
        }

        function SumarPorcentaje(){
            var porcentajeActividadIndividual = parseInt($('#txtPorcentajeActividadIndividual').val());
            var porcentajeFacturacion = parseInt($('#txtPorcentajeFacturacion').val());
            var porcentajeFondosAdmin = parseInt($('#txtPorcentajeFondosAdmin').val());
            var porcentajeResponsabilidad = parseInt($('#txtPorcentajeResponsabilidad').val());
            var porcentajeImporteTotal = parseInt(0);
            porcentajeImporteTotal = porcentajeActividadIndividual + porcentajeFacturacion + porcentajeFondosAdmin + porcentajeResponsabilidad;
            $('#txtPorcentajeImporteTotal').val(porcentajeImporteTotal);
        }

        function calcularPuntos(){
            var importe = parseFloat($('#txtImporteTotal').val());
            var porcentajeActividadIndividual = parseInt($('#txtPorcentajeActividadIndividual').val()) / 100;
            var porcentajeFacturacion = parseInt($('#txtPorcentajeFacturacion').val()) / 100;
            var porcentajeFondosAdmin = parseInt($('#txtPorcentajeFondosAdmin').val()) / 100;
            var porcentajeResponsabilidad = parseInt($('#txtPorcentajeResponsabilidad').val()) / 100;
            var importeTotal = parseFloat($('#txtImporteTotal').val());
            // Validamos si hay valor en el importe...
            if(importe == 0){
                swal({
                    type: 'warning',
                    text: 'Favor de ingresar el importe.',
                    showConfirmButton: false,
                    timer: 1800
                }).catch(swal.noop);
                return;
            }
            // Validamos si los porcentajes son 0...
            if(porcentajeActividadIndividual == 0 || porcentajeFacturacion == 0 || porcentajeFondosAdmin == 0 || porcentajeResponsabilidad == 0){
                swal({
                    type: 'warning',
                    text: 'Favor de llenar todos los porcentajes.',
                    showConfirmButton: false,
                    timer: 1800
                }).catch(swal.noop);
                return;
            }
            // Calcular el importe de las actividades individuales(Importe total * porcentaje de la actividad individuales)
            actividadIndividual = importeTotal * porcentajeActividadIndividual;
            $('#txtActividadIndividual').val(new Intl.NumberFormat().format(actividadIndividual));
            // Calcular el importe de la facturación(Importe total * porcentaje de facturacion)
            facturacion = importeTotal *porcentajeFacturacion;
            $('#txtFacturacion').val(new Intl.NumberFormat().format(facturacion));
            // Calcular el importe de los fondos de administracion(Importe total * porcentaje de fondos de administracion)
            fondosAdmin = importeTotal *porcentajeFondosAdmin;
            $('#txtFondosAdmin').val(new Intl.NumberFormat().format(fondosAdmin));
            // Calcular el importe de responsabilidad(Importe total * porcentaje de responsabilidades)
            responsabilidad = importeTotal * porcentajeResponsabilidad;
            $('#txtResponsabilidad').val(new Intl.NumberFormat().format(responsabilidad));
            // Calcular la suma de todos los puntos para responsabilidades...
            var year = $('#txtYear').val();
            consultarDatos({
                action: "{{ config('app.url') }}/modulos/puntosTotales/sumarPuntosTotales/"+year,
                type: 'GET',
                dataType: 'json',
                ok: function(datosSumaTotalPuntos){
                    var sumaTotalPuntos = datosSumaTotalPuntos[0].suma;
                    if(sumaTotalPuntos === null){
                        $('#txtTotalPuntosResponsabilidad').val(0);
                        $('#txtValorPuntoResponsabilidad').val(0);
                    }else{
                        $('#txtTotalPuntosResponsabilidad').val(new Intl.NumberFormat().format(sumaTotalPuntos));
                        // Obtener el valor del punto por responsabilidad...
                        var valorPuntoResponsabilidad = responsabilidad / sumaTotalPuntos;
                        $('#txtValorPuntoResponsabilidad').val(new Intl.NumberFormat().format(valorPuntoResponsabilidad.toFixed(2)));
                    }
                },
            });
            consultarDatos({

            });
        }

        function guardarPuntosTotales(){
            // Declaración de las variables...
            var importe = parseFloat($('#txtImporteTotal').val());
            var porcentajeImporte = parseInt($('#txtPorcentajeImporteTotal').val());
            var importeActividadesIndividuales = parseFloat($('#txtActividadIndividual').val().replace(/,/g, ""));
            var porcentajeActividadIndividual = parseInt($('#txtPorcentajeActividadIndividual').val());
            var importeFacturacion = parseFloat($('#txtFacturacion').val().replace(/,/g, ""))
            var porcentajeFacturacion = parseInt($('#txtPorcentajeFacturacion').val());
            var importeFondosAdmin = parseFloat($('#txtFondosAdmin').val().replace(/,/g, ""));
            var porcentajeFondosAdmin = parseInt($('#txtPorcentajeFondosAdmin').val());
            var importeResponsabilidad = parseFloat($('#txtResponsabilidad').val().replace(/,/g, ""));
            var porcentajeResponsabilidad = parseInt($('#txtPorcentajeResponsabilidad').val());
            var totalPuntosResponsabilidad = parseInt($('#txtTotalPuntosResponsabilidad').val().replace(/,/g, ""));
            var valorPuntoResponsabilidad = parseFloat($('#txtValorPuntoResponsabilidad').val().replace(/,/g, ""));
            var totalPuntosActividades = parseFloat($('#txtTotalPuntosTotalAB').val().replace(/,/g, ""));
            var variableX = parseFloat($('#txtVariableX').val().replace(/,/g, ""));
            var valorPuntoActividades = parseFloat($('#txtValorPunto').val().replace(/,/g, ""));
            var year = $('#txtYear').val();
            // Validamos si esta vacio el importe...
            // Validamos si hay valor en el importe...
            if(importe == 0){
                swal({
                    type: 'warning',
                    text: 'Favor de ingresar el importe.',
                    showConfirmButton: false,
                    timer: 1800
                }).catch(swal.noop);
                return;
            }
            // Validamos que los campos no esten vacios...
            if(porcentajeActividadIndividual == 0 || porcentajeFacturacion == 0 || porcentajeFondosAdmin == 0 || porcentajeResponsabilidad == 0){
                swal({
                    type: 'warning',
                    text: 'Favor de llenar todos los porcentajes.',
                    showConfirmButton: false,
                    timer: 1800
                }).catch(swal.noop);
                return;
            }
            // Consulta para validar si ya existe el registro correspondiente al año...
            consultarDatos({
                action: "{{ config('app.url') }}/modulos/puntosTotales/existe/" + year,
                type: 'GET',
                dataType: 'json',
                ok: function(existeYear){
                    var existe = existeYear.response;
                    // console.log(existe);
                    if(existe == 0){
                        // Guardamos los datos en la base de datos...
                        var options = {
                            action: "{{ config('app.url') }}/modulos/puntosTotales/guardarTotalPuntos",
                            json: {
                                importe: importe,
                                porcentaje_importe: porcentajeImporte,
                                importe_act_individual: importeActividadesIndividuales,
                                porcentaje_act_individual: porcentajeActividadIndividual,
                                importe_facturacion: importeFacturacion,
                                porcentaje_facturacion: porcentajeFacturacion,
                                importe_fondos_admin: importeFondosAdmin,
                                porcentaje_fondos_admin: porcentajeFondosAdmin,
                                importe_responsabilidad: importeResponsabilidad,
                                porcentaje_responsabilidad: porcentajeResponsabilidad,
                                total_puntos_responsabilidad: totalPuntosResponsabilidad,
                                valor_punto_responsabilidad: valorPuntoResponsabilidad,
                                total_puntos_actividades: totalPuntosActividades,
                                cantidad: variableX,
                                valor_punto_actividades: valorPuntoActividades,
                                year: year,
                                _token: "{{ csrf_token() }}",
                            },
                            type: 'POST',
                            dateType: 'json',
                            mensajeConfirm: 'Los datos ingresados se han registrado con exito.',
                            url: "{{ config('app.url') }}/modulos/puntosTotales/listPuntosTotales?token={{ Session::get('token') }}"
                        };
                        peticionGeneralAjax(options);
                    }else{
                        swal({
                            type: 'warning',
                            text: 'Los datos ingresados ya se encuentra registrado para el año '+year+'.',
                            showConfirmButton: false,
                            timer: 2500
                        }).catch(swal.noop);
                    }
                }
            });
        }

        function verTotalPuntos(id, year){
            consultarDatos({
                action: "{{ config('app.url') }}/modulos/puntosTotales/getTotalPuntos",
                type: 'GET',
                dataType: 'json',
                ok: function(verPuntosTotales){
                    var dataVerPuntosTotales = verPuntosTotales.response[0];
                    // console.log(dataVerPuntosTotales.year);
                    $('#txtImporteTotal').val(new Intl.NumberFormat().format(dataVerPuntosTotales.importe));
                    document.getElementById('txtImporteTotal').readOnly = true;
                    $('#txtPorcentajeImporteTotal').val(dataVerPuntosTotales.porcentaje_importe);
                    $('#txtActividadIndividual').val(new Intl.NumberFormat().format(dataVerPuntosTotales.importe_act_individual));
                    $('#txtPorcentajeActividadIndividual').val(dataVerPuntosTotales.porcentaje_act_individual);
                    document.getElementById('txtPorcentajeActividadIndividual').readOnly = true;
                    $('#txtFacturacion').val(new Intl.NumberFormat().format(dataVerPuntosTotales.importe_facturacion));
                    $('#txtPorcentajeFacturacion').val(dataVerPuntosTotales.porcentaje_facturacion);
                    document.getElementById('txtPorcentajeFacturacion').readOnly = true;
                    $('#txtFondosAdmin').val(new Intl.NumberFormat().format(dataVerPuntosTotales.importe_fondos_admin));
                    $('#txtPorcentajeFondosAdmin').val(dataVerPuntosTotales.porcentaje_fondos_admin);
                    document.getElementById('txtPorcentajeFondosAdmin').readOnly = true;
                    $('#txtResponsabilidad').val(new Intl.NumberFormat().format(dataVerPuntosTotales.importe_responsabilidad));
                    $('#txtPorcentajeResponsabilidad').val(dataVerPuntosTotales.porcentaje_responsabilidad);
                    document.getElementById('txtPorcentajeResponsabilidad').readOnly = true;
                    $('#txtTotalPuntosResponsabilidad').val(new Intl.NumberFormat().format(dataVerPuntosTotales.total_puntos_responsabilidad));
                    $('#txtValorPuntoResponsabilidad').val(new Intl.NumberFormat().format(dataVerPuntosTotales.valor_punto_responsabilidad));
                    $('#txtTotalPuntosTotalAB').val(new Intl.NumberFormat().format(dataVerPuntosTotales.total_puntos_actividades));
                    $('#txtVariableX').val(new Intl.NumberFormat().format(dataVerPuntosTotales.cantidad));
                    $('#txtValorPunto').val(new Intl.NumberFormat().format(dataVerPuntosTotales.valor_punto_actividades));
                    $('#txtYear').val(dataVerPuntosTotales.year);
                    $('#btnCalcular').hide();
                    $('#btnGuardar').hide();
                    $('#btnNuevo').show();
                },
            });
        }

        function nuevoRegistro(){
            // Declaramos variable con el año actual...
            var currentTime = new Date();
            var year = currentTime.getFullYear()
            // Regresamos los valores a la forma determinada para un nuevo registro...
            $('#txtImporteTotal').val('0.00');
            document.getElementById('txtImporteTotal').readOnly = false;
            $('#txtPorcentajeImporteTotal').val('0');
            $('#txtActividadIndividual').val('0.00');
            $('#txtPorcentajeActividadIndividual').val('0');
            document.getElementById('txtPorcentajeActividadIndividual').readOnly = false;
            $('#txtFacturacion').val('0.00');
            $('#txtPorcentajeFacturacion').val('0');
            document.getElementById('txtPorcentajeFacturacion').readOnly = false;
            $('#txtFondosAdmin').val('0.00');
            $('#txtPorcentajeFondosAdmin').val('0');
            document.getElementById('txtPorcentajeFondosAdmin').readOnly = false;
            $('#txtResponsabilidad').val('0.00');
            $('#txtPorcentajeResponsabilidad').val('0');
            document.getElementById('txtPorcentajeResponsabilidad').readOnly = false;
            $('#txtTotalPuntosResponsabilidad').val('0');
            $('#txtValorPuntoResponsabilidad').val('0');
            $('#txtTotalPuntosTotalAB').val('0');
            $('#txtVariableX').val('0');
            $('#txtValorPunto').val('0');
            $('#txtYear').val(year - 1);
            $('#btnCalcular').show();
            $('#btnGuardar').show();
            $('#btnNuevo').hide();
        }
    </script>
@endsection
