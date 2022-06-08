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
                    <input class="form-check-input" type="radio" name="direcciones" id="direccionGeneral" value="direccionGeneral">
                    <label class="form-check-label" for="direccionGeneral">Direccion general</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="direcciones" id="direccionAdministracion" value="direccionAdministracion">
                    <label class="form-check-label" for="direccionAdministracion">Direccion administración</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="direcciones" id="direccionPosgrado" value="direccionPosgrado">
                    <label class="form-check-label" for="direccionPosgrado">Direccion de posgrado</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="direcciones" id="direccionCiencia" value="direccionCiencia">
                    <label class="form-check-label" for="direccionCiencia">Direccion de ciencia</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="direcciones" id="direccionServicios" value="direccionServicios">
                    <label class="form-check-label" for="direccionServicios">Direccion de servicios</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="direcciones" id="direccionTecnologia" value="direccionTecnologia">
                    <label class="form-check-label" for="direccionTecnologia">Direccion de tecnología</label>
                </div><br>
                <div class="row">
                    <div class="col-6">
                        <input type="button" class="btn btn-warning" style="width:100%;" value="Calcular" id="btnCalcular" onclick="calcularPuntos();"/>
                        <input type="button" class="btn btn-primary" style="width:100%;" value="Nuevo registro" id="btnNuevo" onclick="nuevoRegistro();"/>
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
                                <th scope="row" style="font-size:13px; vertical-align:middle;" width="10%">Total personas del área:</th>
                                <th width="10%"><input type="text" class="form-control form-control-sm text-center"  name="totalPersonasArea" id="txtTotalPersonasArea" value="0" readonly></th>
                            </tr>
                            <tr>
                                <th scope="row" style="font-size:13px; vertical-align:middle;" width="10%">Recursos propios $:</th>
                                <td width="10%"><input type="text" class="form-control form-control-sm text-center"  name="contribucion" id="txtContribucion" value="0.00" readonly></th>
                            </tr>
                            <tr>
                                <th scope="row" style="font-size:13px; vertical-align:middle;" width="10%">Año:</th>
                                <th width="10%"><input type="text" class="form-control form-control-sm text-center"  name="year" id="txtYear" value="{{ date("Y") - 1 }}" readonly></th>
                            </tr>
                        </tbody>
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
            obtenerDatos(0);
            $('#btnNuevo').hide();
            $('#btnGuardar').hide();
            // $('#btnGuardar').on('click', guardarPuntosTotales);
        }

        function obtenerDatos(){
            // Consultamos el calculo de los recursos propios de la tabla de puntos totales
            // consultarDatos({
            //     action: "{{ config('app.url') }}/modulos/recursosPropios/ObtenerDatos/"+año,
            //     type: 'GET',
            //     dataType: 'json',
            //     ok: function(obtenerDatosPuntosTotales){
            //         var dataObtenerPuntosTotales = obtenerDatosPuntosTotales[0];
            //         // console.log(dataObtenerPuntosTotales);
            //         if(dataObtenerPuntosTotales != null){
            //             // console.log(dataObtenerPuntosTotales.importe_facturacion);
            //             $('#txtTotalRecursosPropios').val(new Intl.NumberFormat().format(dataObtenerPuntosTotales.importe_facturacion));
            //         }else{
            //             // console.log("Sin informacion");
            //             $('#txtTotalRecursosPropios').val('0.00');
            //         }
            //     },
            // });
        }

        function calcularPuntos(){
            let direccionGeneral = document.querySelector('#direccionGeneral');
            let direccionAdministracion = document.querySelector('#direccionAdministracion');
            let direccionPosgrado = document.querySelector('#direccionPosgrado');
            let direccionCiencia = document.querySelector('#direccionCiencia');
            let direccionServicios = document.querySelector('#direccionServicios');
            let direccionTecnologia = document.querySelector('#direccionTecnologia');
            let contribucion = document.getElementById('txtContribucion').value
            if(!document.querySelector('input[name="direcciones"]:checked')){
                swal({
                    type: 'warning',
                    text: 'Favor de seleccionar al menos una dirección para continuar.',
                    showConfirmButton: false,
                    timer: 2000
                }).catch(swal.noop);
                return;
            }else if(contribucion == "0.00"){
                swal({
                    type: 'warning',
                    text: 'Favor de ingresar el procentaje de contribución para continuar.',
                    showConfirmButton: false,
                    timer: 2000
                }).catch(swal.noop);
                return;
            }else{
                console.log("Calculando");
            }
        }
    </script>
@endsection
