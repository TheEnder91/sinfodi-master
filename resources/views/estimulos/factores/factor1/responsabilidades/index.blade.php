@extends('layouts.app')

@section('title_page')
    <img src="{{ asset('img/estimulos.png') }}" width="70px" height="40px">Estimulos
@endsection

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ \App\Traits\Principal::getUrlToken('/') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Nivel de responsabilidad</li>
    </ol>
@endsection

@section('content')
    @component('components.card')
        @slot('title_card', 'Puntaje según su nivel de responsabilidad')
        @can('estimulo-responsabilidad-create')
            <section class="text-right">
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalNuevo">
                    <i class="fa fa-plus"></i> Nuevo criterio
                </button>
            </section><br>
        @endcan
        {{-- Modal nuevo registro --}}
        @section('title_modal')
            <i class="fa fa-plus"></i> Agregar nivel de responsabilidad
        @endsection
        @section('content_modal')
            <input type="text" name="id" id="id" hidden>
            <label for="" class="col-form-control">
                Nivel de responsabilidad:
            </label>
            <textarea class="form-control" name="nombre" id="nombreN"></textarea>
            <label for="" name='puntos' class="col-form-control">
                Puntos asginado:
            </label>
            <input type="number" name="puntos" class="form-control" onKeyPress="return soloNumeros(event)" id="puntosN">
            @section('buttons_modal')
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
                <input type="button" class="btn btn-success" value="Guardar" id="btnGuardar"/>
            @endsection
        @endsection
        {{-- Termina modal nuevo registro --}}
        <div class="table-responsive">
            <table id="tblResponsabilidades" class="table table-bordered table-striped">
                <caption>Listado de puntaje según el nivel de responsabilidad.</caption>
                <thead>
                    <tr class="text-center">
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Puntos</th>
                        @if (Auth::user()->hasPermissionTo('estimulo-responsabilidad-show') || Auth::user()->hasPermissionTo('estimulo-responsabilidad-delete'))
                            <th scope="col">Acciones</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($responsabilidades as $item)
                        <tr>
                            <th scope="row" class="text-center" width="2%">{{ $item->id }}</th>
                            <td width="83%">{{ $item->nombre }}</td>
                            <td class="text-center" width="5%">{{ $item->puntos }}</td>
                            @if (Auth::user()->hasPermissionTo('estimulo-responsabilidad-show') || Auth::user()->hasPermissionTo('estimulo-responsabilidad-delete'))
                                <td class="text-center" width="10%">
                                    @can('estimulo-responsabilidad-show')
                                        <a href="javascript:editarResponsabilidad({{ $item->id }})"><i class="fa fa-pencil-alt"></i></a>
                                    @endcan
                                    @can('estimulo-responsabilidad-delete')
                                        <a href="javascript:eliminarResponsabilidad({{ $item->id }})"><i class="fa fa-trash-alt"></i></a>
                                    @endcan
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <script>
            $(function(){
                $('#tblResponsabilidades').DataTable({
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
        @include('estimulos.factores.factor1.responsabilidades.modalEditar')
    @endcomponent
@endsection

@section('scripts')
    <script>
        $(document).ready(initResponsabilidades);

        function initResponsabilidades(){
            $('#btnGuardar').on('click', guardarResponsabilidades);
            $('#btnActualizar').on('click', actualizarResponsabilidades);
        }

        function guardarResponsabilidades(){
            var nombre = $('#nombreN').val();
            var puntos = $('#puntosN').val();
            // console.log(nombre); // Se comenta para futuras pruebas...
            // console.log(puntos); // Se comenta para futuras pruebas...
            if(nombre === "" || puntos === ""){
                swal({
                    type: 'warning',
                    title: '',
                    text: 'Por favor de ingresar los campos requeridos.',
                });
                return;
            }
            var options = {
                action: "{{ config('app.url') }}/estimulos/factor1/responsabilidades/storeResponsabildiades",
                json: {
                    nombre: nombre,
                    puntos: puntos,
                    _token: "{{ csrf_token() }}",
                },
                type: 'POST',
                dateType: 'json',
                mensajeConfirm: 'El registro se agrego correctamente',
                url: "{{ config('app.url') }}/estimulos/factor1/responsabilidades/listResponsabildiades?token={{ Session::get('token') }}"
            };
            peticionGeneralAjax(options);
        }

        function editarResponsabilidad(id){
            consultarDatos({
                action: "{{ config('app.url') }}/estimulos/factor1/responsabilidades/showResponsabildiades/" + id,
                type: 'GET',
                dataType: 'json',
                ok: function(data){
                    // console.log(data.response.id); // Se comenta para futuras pruebas...
                    // console.log(data.response.nombre); // Se comenta para futuras pruebas...
                    // console.log(data.response.puntos); // Se comenta para futuras pruebas...
                    $('#id').val(data.response.id);
                    $('#nombreE').val(data.response.nombre);
                    $('#puntosE').val(data.response.puntos);
                    $('#modalEditar').modal('show');
                },
            });
        }

        function actualizarResponsabilidades(){
            var id = $('#id').val();
            var nombre = $('#nombreE').val();
            var puntos = $('#puntosE').val();
            // console.log(id); // Se comenta para futuras pruebas...
            // console.log(nombre); // Se comenta para futuras pruebas...
            // console.log(puntos); // Se comenta para futuras pruebas...
            if(nombre === "" || puntos === ""){
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
                    action: "{{ config('app.url') }}/estimulos/factor1/responsabilidades/updateResponsabildiades/" + id,
                    json: {
                        nombre: nombre,
                        puntos: puntos,
                        _token: "{{ csrf_token() }}",
                    },
                    type: 'PUT',
                    dateType: 'json',
                    mensajeConfirm: 'El registro se actualizo correctamente',
                    url: "{{ config('app.url') }}/estimulos/factor1/responsabilidades/listResponsabildiades?token={{ Session::get('token') }}"
                };
                peticionGeneralAjax(options);
            });
        }

        function eliminarResponsabilidad(id){
            swal({
                type: 'warning',
                title: "Se eliminara el registro.",
                text: "¿Desea continuar?",
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: "Si, eliminar",
                denyButtonText: "Cancelar",
            }).then((result) => {
                var options = {
                    action: "{{ config('app.url') }}/estimulos/factor1/responsabilidades/destroyResponsabildiades/" + id,
                    json: {
                        _token: "{{ csrf_token() }}",
                        _method: 'DELETE',
                    },
                    type: 'POST',
                    dateType: 'json',
                    mensajeConfirm: 'El registro se elimino correctamente',
                    url: "{{ config('app.url') }}/estimulos/factor1/responsabilidades/listResponsabildiades?token={{ Session::get('token') }}"
                };
                peticionGeneralAjax(options);
            });
        }
    </script>
@endsection
