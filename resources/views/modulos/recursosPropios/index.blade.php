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
            <div class="col-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="year" style="font-size:13px;">Seleccione el año a calcular:</label>
                    </div>
                    <select class="custom-select" id="year" onChange="ShowSelected();" style="font-size:13px;">
                        @for ($i = date('Y'); $i >= 2021; $i--)
                            <option value="{{ $i - 1 }}">{{ $i - 1 }}</option>
                        @endfor
                    </select>
                </div>
            </div>
        </div><br>
        <div class="row">
            <div class="col-2" style="text-align: justify;">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="direcciones" id="direccionGeneral" value="direccionGeneral" checked>
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
                </div>
            </div>
            <div class="col-4">
                <div class="table-responsive">
                    <table id="tblCalculosRP" class="table table-sm">
                        <tbody>
                            <tr>
                                <th scope="row" style="font-size:13px; vertical-align:middle;" width="10%">Cantidad $:</th>
                                <th width="10%"><input type="text" class="form-control form-control-sm text-center"  name="totalRecursosPropios" id="txtTotalRecursosPropios" readonly></th>
                                {{-- <th width="25%">
                                    <input type="button" class="btn btn-warning" style="width:50%;" value="Calcular" id="btnCalcular" onclick="calcularPuntos();"/>
                                    <input type="button" class="btn btn-primary" style="width:50%;" value="Nuevo registro" id="btnNuevo" onclick="nuevoRegistro();"/>
                                </th> --}}
                            </tr>
                            <tr>
                                <th scope="row" style="font-size:13px; vertical-align:middle;" width="10%">Contribución %:</th>
                                <th width="10%"><input type="text" class="form-control form-control-sm text-center"  name="contribucion" id="txtContribucion"></th>
                                {{-- <th width="25%">
                                    <input type="button" class="btn btn-primary" style="width:50%;" value="Guardar" id="btnGuardar"/>
                                </th> --}}
                            </tr>
                            <tr>
                                <th scope="row" style="font-size:13px; vertical-align:middle;" width="10%">Total personas del área:</th>
                                <th width="10%"><input type="text" class="form-control form-control-sm text-center"  name="totalPersonasArea" id="txtTotalPersonasArea" readonly></th>
                                {{-- <th width="25%"></th> --}}
                            </tr>
                            <tr>
                                <th scope="row" style="font-size:13px; vertical-align:middle;" width="10%">Recursos propios $:</th>
                                <td width="10%"><input type="text" class="form-control form-control-sm text-center"  name="contribucion" id="txtContribucion" readonly></th>
                                {{-- <th width="25%"></th> --}}
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-6">
                <div class="row">
                    <div class="col-3">
                        <input type="button" class="btn btn-warning" style="width:100%;" value="Calcular" id="btnCalcular" onclick="calcularPuntos();"/>
                        <input type="button" class="btn btn-primary" style="width:100%;" value="Nuevo registro" id="btnNuevo" onclick="nuevoRegistro();"/>
                    </div>
                </div>
                <div class="row" style="margin-top: 5px;">
                    <div class="col-3">
                        <input type="button" class="btn btn-primary" style="width:100%;" value="Guardar" id="btnGuardar"/>
                    </div>
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
            // $('#btnGuardar').on('click', guardarPuntosTotales);
        }

        function ShowSelected(){
            var year = document.getElementById("year").value;
            obtenerDatos(year);
        }

        function obtenerDatos(year){
            if(year === 0){
                var año = document.getElementById("year").value;
            }else{
                var año = year;
            }
            // Consultamos el calculo de los recursos propios de la tabla de puntos totales
            consultarDatos({
                action: "{{ config('app.url') }}/modulos/recursosPropios/ObtenerDatos/"+año,
                type: 'GET',
                dataType: 'json',
                ok: function(obtenerDatosPuntosTotales){
                    var dataObtenerPuntosTotales = obtenerDatosPuntosTotales[0];
                    // console.log(dataObtenerPuntosTotales);
                    if(dataObtenerPuntosTotales != null){
                        // console.log(dataObtenerPuntosTotales.importe_facturacion);
                        $('#txtTotalRecursosPropios').val(new Intl.NumberFormat().format(dataObtenerPuntosTotales.importe_facturacion));
                    }else{
                        // console.log("Sin informacion");
                        $('#txtTotalRecursosPropios').val('0.00');
                    }
                },
            });
        }
    </script>
@endsection
