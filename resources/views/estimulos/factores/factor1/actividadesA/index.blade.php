@extends('layouts.app')

@section('title_page')
    <img src="{{ asset('img/estimulos.png') }}" width="70px" height="40px">Estimulos
@endsection

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ \App\Traits\Principal::getUrlToken('/') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Tabla 1. Actividades A</li>
    </ol>
@endsection

@section('content')
    @component('components.card')
        @slot('title_card', 'Tabla 1. Actividades A')
        @can('estimulo-actividadA-create')
            <section class="text-right">
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalNuevo" style="font-size:13px;">
                    <i class="fa fa-plus"></i> Nuevo criterio
                </button>
            </section><br>
        @endcan
        {{-- Modal nuevo registro --}}
        @section('title_modal')
            <i class="fa fa-plus"></i> Agregar criterio
        @endsection
        @section('content_modal')
            {{-- @include('estimulos.factores.factor1.actividadesA.form') --}}
            {{-- <div class="row"> --}}
                {{-- <div class="col-12"> --}}
                    <input type="text" name="id" id="id" hidden>
                    <label for="txtNombre" class="col-form-control" style="font-size:13px;">
                        <span style="color: red">*</span>Criterio:
                    </label>
                    <textarea class="form-control form-control-sm" id="txtNombre"></textarea>
                    <label for="" name='id_objetivo' style="font-size:13px;">
                        <span style="color: red">*</span>Objetivo al que pertenece:
                    </label>
                    <select name="id_objetivo" id="id_objetivo" class="form-control form-control-sm id_objetivo">
                        <option value="0" style="font-size:12px;" selected disabled>Seleccione un objetivo...</option>
                        @foreach ($objetivos as $item)
                            <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                        @endforeach
                    </select>
                    <label for="txtPuntos" name='puntos' class="col-form-control" style="font-size:13px;">
                        <span style="color: red">*</span>Punto asginado:
                    </label>
                    <input type="number" class="form-control form-control-sm" onKeyPress="return soloNumeros(event)" id="txtPuntos">
                    <input type="text" name="observaciones" class="observaciones" id="observaciones" value="Tabla 1. Actividad A." hidden>
                {{-- </div> --}}
            {{-- </div> --}}
            @section('buttons_modal')
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal" style="font-size:13px;">Cancelar</button>
                <input type="button" class="btn btn-success" value="Guardar" id="btnGuardar" style="font-size:13px;"/>
            @endsection
        @endsection
        {{-- Termina modal nuevo registro --}}
        <div class="table-responsive">
            <table id="tblActividadesA" class="table table-bordered table-striped">
                <caption>Actividades sustantivas que representan la contribución directa de la productividad del personal a las metas e indicadores instituciones.</caption>
                <thead>
                    <tr class="text-center">
                        <th scope="col" style="font-size:13px;">#</th>
                        <th scope="col" style="font-size:13px;">Criterio</th>
                        <th scope="col" style="font-size:13px;">Objetivo</th>
                        <th scope="col" style="font-size:13px;">Puntos</th>
                        @if (Auth::user()->hasPermissionTo('estimulo-actividadA-show') || Auth::user()->hasPermissionTo('estimulo-actividadA-delete'))
                            <th scope="col" style="font-size:13px;">Acciones</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datos as $item)
                        <tr>
                            <th scope="row" width="5%" class="text-center" style="font-size:12px;">{{ $item->id }}</td>
                            <td width="42%" style="font-size:12px;">{{ $item->nombre }}</td>
                            <td width="35%" style="font-size:12px;">{{ $item->modulo->nombre }}</td>
                            <td class="text-center" width="8%" style="font-size:12px;">{{ $item->puntos }}</td>
                            @if (Auth::user()->hasPermissionTo('estimulo-actividadA-show') || Auth::user()->hasPermissionTo('estimulo-actividadA-delete'))
                                <td class="text-center" width="10%" style="font-size:12px;">
                                    @can('estimulo-actividadA-show')
                                        <a href="javascript:editarActividadA({{ $item->id }})"><i class="fa fa-edit"></i></a>
                                    @endcan
                                    @can('estimulo-actividadA-delete')
                                        <a href="javascript:eliminarActividadA({{ $item->id }})"><i class="fa fa-trash-alt"></i></a>
                                    @endcan
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @include('estimulos.factores.factor1.actividadesA.modalEditar')
        <script>
            $(function(){
                $('#tblActividadesA').DataTable({
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
                    lengthMenu: [[10, 15, 20], [10, 15, 20]]
                });
            });
        </script>
    @endcomponent
@endsection

@section('scripts')
    <script>
        $(document).ready(initActividadesA);

        function initActividadesA(){
            $('#btnGuardar').on('click', guardarActividadesA);
            $('#btnActualizar').on('click', actualizarActividadesA);
        }

        function guardarActividadesA(){
            var criterio = $('#txtNombre').val();
            var objetivo = $('#id_objetivo').val();
            var puntos = $('#txtPuntos').val();
            var observaciones = $('.observaciones').val();
            // console.log(criterio); // Se comenta para futuras pruebas...
            // console.log(objetivo); // Se comenta para futuras pruebas...
            // console.log(puntos); // Se comenta para futuras pruebas...
            // console.log(observaciones); // Se comenta para fututas pruebas...
            if(criterio === "" || objetivo === null || puntos === ""){
                swal({
                    type: 'warning',
                    title: '',
                    text: 'Por favor de ingresar los campos requeridos.',
                });
                return;
            }
            var options = {
                action: "{{ config('app.url') }}/estimulos/factor1/criterios/storeActividadesA",
                json: {
                    nombre: criterio,
                    id_objetivo: objetivo,
                    puntos: puntos,
                    observaciones: observaciones,
                    _token: "{{ csrf_token() }}",
                },
                type: 'POST',
                dateType: 'json',
                mensajeConfirm: 'El registro se agrego correctamente',
                url: "{{ config('app.url') }}/estimulos/factor1/criterios/listActividadesA?token={{ Session::get('token') }}"
            };
            peticionGeneralAjax(options);
        }

        function editarActividadA(id){
            consultarDatos({
                action: "{{ config('app.url') }}/estimulos/factor1/criterios/showActividadesA/" + id,
                type: 'GET',
                dataType: 'json',
                ok: function(data){
                    // console.log(data.response.id); // Se comenta para futuras pruebas...
                    // console.log(data.response.nombre); // Se comenta para futuras pruebas...
                    // console.log(data.response.id_objetivo); // Se comenta para futuras pruebas...
                    // console.log(data.response.puntos); // Se comenta para futuras pruebas...
                    $('#id').val(data.response.id);
                    $('#txtNombreE').val(data.response.nombre);
                    $('#id_objetivoE').val(data.response.id_objetivo);
                    $('#txtPuntosE').val(data.response.puntos);
                    $('#modalEditar').modal('show');
                },
            });
        }

        function actualizarActividadesA(){
            var id = $('#id').val();
            var criterio = $('#txtNombreE').val();
            var objetivo = $('#id_objetivoE').val();
            var puntos = $('#txtPuntosE').val();
            var observaciones = $('.observaciones').val();
            // console.log(id); // Se comenta para futuras pruebas...
            // console.log(criterio); // Se comenta para futuras pruebas...
            // console.log(objetivo); // Se comenta para futuras pruebas...
            // console.log(puntos); // Se comenta para futuras pruebas...
            // console.log(observaciones); // Se comenta para fututas pruebas...
            if(criterio === "" || objetivo === null || puntos === ""){
                swal({
                    type: 'warning',
                    title: '',
                    text: 'Por favor de ingresar los campos requeridos.',
                });
                return;
            }
            swal({
                type: 'warning',
                title: "Se actualizara el registro.",
                text: "¿Desea continuar?",
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: "Si, actualizar",
                denyButtonText: "Cancelar",
            }).then((result) => {
                var options = {
                    action: "{{ config('app.url') }}/estimulos/factor1/criterios/updateActividadesA/" + id,
                    json: {
                        nombre: criterio,
                        id_objetivo: objetivo,
                        puntos: puntos,
                        _token: "{{ csrf_token() }}",
                    },
                    type: 'PUT',
                    dateType: 'json',
                    mensajeConfirm: 'El registro se actualizo correctamente',
                    url: "{{ config('app.url') }}/estimulos/factor1/criterios/listActividadesA?token={{ Session::get('token') }}"
                };
                peticionGeneralAjax(options);
            });
        }

        function eliminarActividadA(id){
            swal({
                type: 'warning',
                title: "Se eliminara el registro.",
                text: "¿Desea continuar?",
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: "Si, eliminar",
                denyButtonText: "Cancelar",
            }).then((result) => {
                console.log('asdasdasd');
                var options = {
                    action: "{{ config('app.url') }}/estimulos/factor1/criterios/destroyActividadesA/" + id,
                    json: {
                        _token: "{{ csrf_token() }}",
                        _method: 'DELETE',
                    },
                    type: 'POST',
                    dateType: 'json',
                    mensajeConfirm: 'El registro se elimino correctamente',
                    url: "{{ config('app.url') }}/estimulos/factor1/criterios/listActividadesA?token={{ Session::get('token') }}"
                };
                peticionGeneralAjax(options);
            });
        }
    </script>
@endsection
