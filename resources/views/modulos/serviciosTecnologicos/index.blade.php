@extends('layouts.app')

@section('title_page')
    <img src="{{ asset('img/Factura.png') }}" width="50px" height="30px">Servicios tecnológicos
@endsection

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ \App\Traits\Principal::getUrlToken('/') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Añadir registro</li>
    </ol>
@endsection

@section('content')
    @component('components.card')
        @slot('title_card', 'Información financiera de servicios tecnológicos.')
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-6">
                            <div class="row">
                                <div class="col-9">
                                    <label class="col-form-label" style="font-size:13px;">Monto total ingresado:</label>
                                    <input type="text" class="form-control form-control-sm"  name="montoTotalIngresado" id="txtMontoTotalIngresado" onKeyPress="return soloNumeros(event)">
                                </div>
                                <div class="col-3">
                                    <label class="col-form-label" style="font-size:13px;">Total:</label>
                                    <input type="text" class="form-control form-control-sm text-center" name="year" id="txtYear" value="{{ date("Y") - 1 }}" readonly>
                                </div>
                            </div>
                            <br>
                            <div class="row text-right">
                                <div class="col-12">
                                    <div>
                                        <input type="button" class="btn btn-primary" value="Guardar" id="btnGuardar"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="table-responsive">
                                <table id="tblInfoFinancieraST" class="table table-bordered table-striped">
                                    <thead>
                                        <tr class="text-center">
                                            <th scope="col" style="font-size:13px;">#</th>
                                            <th scope="col" style="font-size:13px;">Monto total ingresado</th>
                                            <th scope="col" style="font-size:13px;">Año</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endcomponent
@endsection

@section('scripts')
    <script>
        $(document).ready(initServiciosTecnologicos);

        function initServiciosTecnologicos(){
            obtenerDatos();
            $('#btnGuardar').on('click', guardarMonto);
        }

        function obtenerDatos(){
            consultarDatos({
                action: "{{ config('app.url') }}/modulos/serviciosTecnologicos/informacionFinanciera/getDatos",
                type: 'GET',
                dataType: 'json',
                ok: function(datosServTecno){
                    // console.log(datosServTecno);
                    var datosGetServTecno = datosServTecno.response;
                    var row = "";
                    if(datosGetServTecno.length > 0){
                        for(var i = 0; i < datosGetServTecno.length; i++){
                            var dataServTecno = datosGetServTecno[i];
                            row += "<tr>";
                            row += '<th scope="row" class="text-center" width="5%" style="font-size:12px;">' + dataServTecno.id + '</th>';
                            row += '<td width="65%" style="font-size:12px; text-align:center;">$' + new Intl.NumberFormat().format(dataServTecno.monto) + "</td>";
                            row += '<th scope="row" class="text-center" width="5%" style="font-size:12px;">' + dataServTecno.year + '</td>';
                            row += "</tr>";
                        }
                    }
                    if ($.fn.dataTable.isDataTable("#tblInfoFinancieraST")) {
                        tblDifusionDivulgacion = $("#tblInfoFinancieraST").DataTable();
                        tblDifusionDivulgacion.destroy();
                    }
                    $('#tblInfoFinancieraST > tbody').html('');
                    $('#tblInfoFinancieraST > tbody').append(row);
                    $('#tblInfoFinancieraST').DataTable({
                        "order":[[0, "desc"]],
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

        function guardarMonto(){
            var monto = $('#txtMontoTotalIngresado').val();
            var year = $('#txtYear').val();
            if(monto == ""){
                swal({
                    type: 'warning',
                    text: 'Favor de ingresar el monto total.',
                    showConfirmButton: false,
                    timer: 1800
                }).catch(swal.noop);
                return;
            }
            var options = {
                action: "{{ config('app.url') }}/modulos/serviciosTecnologicos/informacionFinanciera/saveDatos",
                json: {
                    monto: monto,
                    year: year,
                },
                type: 'POST',
                dateType: 'json',
                mensajeConfirm: 'Se ha guardado correctamente el registro.',
                url: "{{ config('app.url') }}/modulos/serviciosTecnologicos/informacionFinanciera/index?token={{ Session::get('token') }}"
            };
            // console.log(options);
            peticionGeneralAjax(options);
        }
    </script>
@endsection
