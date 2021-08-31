@extends('layouts.app')

@section('title_page')
    <img src="{{ asset('img/estimulos.png') }}" width="70px" height="40px">Estimulos
@endsection

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ \App\Traits\Principal::getUrlToken('/')  }}">Inicio</a></li>
        <li class="breadcrumb-item active">Listado de objetivos</li>
    </ol>
@endsection

@section('content')
    @component('components.card')
        @slot('title_card', 'Listado de objetivos')
        @can('estimulo-objetivo-create')
            <section class="text-right">
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalNuevo">
                    <i class="fa fa-plus"></i> Nuevo objetivo
                </button>
            </section><br>
        @endcan
        {{-- Modal nuevo registro --}}
        @section('title_modal')
            <i class="fa fa-plus"></i> Agregar objetivo
        @endsection
        @section('content_modal')
            {{-- @include('estimulos.objetivos.form') --}}
            <div class="col-12">
                <input type="text" class="form-control txtNomObjetivo" name="nombre" id="txtNomObjetivo">
            </div>
            @section('buttons_modal')
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
                <input type="button" class="btn btn-success" value="Guardar" id="btnGuardar"/>
            @endsection
        @endsection
        {{-- Termina modal nuevo registro --}}
        <div class="table-responsive">
            <table id="tblObjetivos" class="table table-bordered table-striped">
                <caption>Listado de objetivos establecidos para la evaluación.</caption>
                <thead>
                    <tr class="text-center">
                        <th scope="col">#</th>
                        <th scope="col">Nombre del objetivo</th>
                        @if (Auth::user()->hasPermissionTo('estimulo-objetivo-show') || Auth::user()->hasPermissionTo('estimulo-objetivo-delete'))
                            <th scope="col">Acciones</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datos as $item)
                        <tr>
                            <th scope="row" width="5%" class="text-center">{{ $item->id }}</td>
                            <td width="85%">{{ $item->nombre }}</td>
                            @if (Auth::user()->hasPermissionTo('estimulo-objetivo-show') || Auth::user()->hasPermissionTo('estimulo-objetivo-delete'))
                                <td class="text-center" width="10%">
                                    @can('estimulo-objetivo-show')
                                        <a href="javascript:editarObjetivo({{ $item->id }})"><i class="fa fa-pencil-alt"></i></a>
                                    @endcan
                                    @can('estimulo-objetivo-delete')
                                        <a href="javascript:eliminarObjetivo({{ $item->id }})"><i class="fa fa-trash-alt"></i></a>
                                    @endcan
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @include('estimulos.objetivos.modalEditar')
        <script>
            $(function(){
                $('#tblObjetivos').DataTable({
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
                    lengthMenu: [[10, 15, 20, 25], [10, 15, 20, 25]]
                });
            });
        </script>
    @endcomponent
@endsection

@section('scripts')
    <script>
        $(document).ready(initObjetivos);

        function initObjetivos(){
            $('#btnGuardar').on('click', guardarObjetivo);
            $('#btnActualizar').on('click', actualizarObjetivo);
        }

        function guardarObjetivo(){
            var nombre = $('#txtNomObjetivo').val();

            // console.log(nombre); //Se comenta para futuras pruebas...

            if(nombre === ""){
                swal({
                    type: 'warning',
                    title: '',
                    text: 'Por favor de ingresar los campos requeridos.',
                });
                return;
            }

            var options = {
                action: "{{ config('app.url') }}/estimulos/objetivos/storeObjetivo",
                json: {
                    nombre: nombre,
                    _token: "{{ csrf_token() }}",
                },
                type: 'POST',
                dateType: 'json',
                mensajeConfirm: 'El registro se agrego correctamente',
                url: "{{ config('app.url') }}/estimulos/objetivos/listObjetivos?token={{ Session::get('token') }}"
            };
            peticionGeneralAjax(options);
        }

        function editarObjetivo(id){
            consultarDatos({
                action: "{{ config('app.url') }}/estimulos/objetivos/showObjetivo/" + id,
                type: 'GET',
                dataType: 'json',
                ok: function(data){
                    // console.log(data.response.id); //Se comenta para futuras pruebas...
                    $('#modalEditar').modal('show');
                    $('#id').val(data.response.id);
                    // console.log($('#id').val())
                    $('.txtNomObjetivo').val(data.response.nombre);
                },
            });
        }

        function actualizarObjetivo(){
            var id = $('#id').val();
            var nombre = $('.txtNomObjetivo').val();
            // console.log(id); //Se comenta para futuras pruebas...

            if(nombre == ""){
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
                    action: "{{ config('app.url') }}/estimulos/objetivos/updateObjetivo/" + id,
                    json: {
                        nombre: nombre,
                        _token: "{{ csrf_token() }}",
                    },
                    type: 'PUT',
                    dateType: 'json',
                    mensajeConfirm: 'El registro se actualizo correctamente',
                    url: "{{ config('app.url') }}/estimulos/objetivos/listObjetivos?token={{ Session::get('token') }}"
                };
                peticionGeneralAjax(options);
            });
        }

        function eliminarObjetivo(id){
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
                    action: "{{ config('app.url') }}/estimulos/objetivos/destroyObjetivo/" + id,
                    json: {
                        _token: "{{ csrf_token() }}",
                        _method: 'DELETE',
                    },
                    type: 'POST',
                    dateType: 'json',
                    mensajeConfirm: 'El registro se elimino correctamente',
                    url: "{{ config('app.url') }}/estimulos/objetivos/listObjetivos?token={{ Session::get('token') }}"
                };
                peticionGeneralAjax(options);
            });
        }
    </script>
@endsection
