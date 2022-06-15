@extends('layouts.app')

@section('title_page')
    <img src="{{ asset('img/fondosAdmin.png') }}" width="50px" height="40px">Fondos en administración
@endsection

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ \App\Traits\Principal::getUrlToken('/') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Añadir registro</li>
    </ol>
@endsection

@section('content')
    @component('components.card')
        @slot('title_card', 'Crear registro->Fondos en administración')
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
                    <table id="tblCalculosFA" class="table table-sm">
                        <tbody>
                            <tr>
                                <th scope="row" style="font-size:13px; vertical-align:middle;" width="10%">Fondos en administración $:</th>
                                <th width="10%"><input type="text" class="form-control form-control-sm text-center"  name="totalFondosAdministracion" id="txtTotalFondosAdministracion" value="0.00" readonly></th>
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
                                <td width="10%"><input type="text" class="form-control form-control-sm text-center"  name="fondosAdministracion" id="txtFondosAdministracion" value="0.00" readonly></th>
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
                                <th scope="col" style="font-size:13px;">Total fondos admin.</th>
                                <th scope="col" style="font-size:13px;">Fondos admin.</th>
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
        $(document).ready(initFondosAdministracion);

        function initFondosAdministracion(){
            var year = $('#txtYear').val();
            // obtenerFondosAdministracion(year);
            // obtenerFondosAdministracion();
            $('#btnNuevo').hide();
            $('#btnGuardar').show();
            // $('#btnGuardar').on('click', guardarFondosAdministracion);
        }

        function obtenerFondosAdministracion(year){
            // Consultamos el calculo de los recursos propios de la tabla de puntos totales...
            consultarDatos({
                action: "{{ config('app.url') }}/modulos/recursosPropios/ObtenerDatos/" + year,
                type: 'GET',
                dataType: 'json',
                ok: function(obtenerDatosFondosAdministracion){
                    var dataObtenerFondosAdministracion = obtenerDatosFondosAdministracion[0];
                    // console.log(dataObtenerFondosAdministracion);
                    if(dataObtenerFondosAdministracion != null){
                        // console.log(dataObtenerFondosAdministracion.importe_FondosAdministracion);
                        $('#txtTotalFondosAdministracion').val(new Intl.NumberFormat().format(dataObtenerFondosAdministracion.importe_facturacion));
                    }else{
                        // console.log("Sin informacion");
                        $('#txtTotalFondosAdministracion').val('0.00');
                    }
                },
            });
        }
    </script>
@endsection
