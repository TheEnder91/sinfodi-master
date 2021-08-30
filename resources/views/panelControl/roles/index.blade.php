@extends('layouts/app')

@section('title_page')
    <img src="{{ asset('img/panel_control.png') }}" width="50px" height="50px"> Panel de control
@endsection

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ \App\Traits\Principal::getUrlToken('/') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Listado de roles</li>
    </ol>
@endsection

@section('content')
    @component('components.card')
        @slot('title_card', 'Listado de roles')
        @can('admin-role-create')
            <section class="text-right">
                <a href="{{ \App\Traits\Principal::getUrlToken('/panelControl/createRol') }}" class="btn btn-primary" role="button" aria-disabled="true">
                    <i class="fa fa-plus"></i> Nuevo registro
                </a>
            </section><br>
        @endcan
        <div class="table-responsive">
            <table id="tblRole" class="table table-bordered table-striped">
                <caption>Listado de roles</caption>
                <thead>
                    <tr class="text-center">
                        <th width="5%">#</th>
                        <th>Nombre</th>
                        <th>Slug</th>
                        <th>Descripción</th>
                        <th>Fecha de creación</th>
                        @if (Auth::user()->hasPermissionTo('admin-role-show') || Auth::user()->hasPermissionTo('admin-role-destroy'))
                            <th>Acciones</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rows as $item)
                        <tr class="text-center">
                            <th scope="row">{{ $item->id }}</th>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->slug }}</td>
                            <td class="text-left">{{ $item->description }}</td>
                            <td>{{ $item->created_at }}</td>
                            @if (Auth::user()->hasPermissionTo('admin-role-show') || Auth::user()->hasPermissionTo('admin-role-destroy'))
                                <td>
                                    @can('admin-role-show')
                                        <a href="javascript:getUrlToken('/panelControl/showRol/{{ $item->id }}', true)"><i class="fa fa-edit"></i></a>
                                    @endcan
                                    @can('admin-role-destroy')
                                        <a href="javascript:eliminarRol({{ $item->id }})"><i class="fa fa-trash-alt"></i></a>
                                    @endcan
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @slot('script_tabla')
            <script>
                $(function(){
                    $('#tblRole').DataTable({
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
        @endslot
    @endcomponent
@endsection

@section('scripts')
    <script>
        $(document).ready(initRoles);

        function initRoles(){
            $('#btnEliminarRol').on('click', eliminarRol);
        }

        function eliminarRol(id){
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
                    action: "{{ config('app.url') }}/panelControl/destroyRol/"+id,
                    json: {
                        _token: "{{ csrf_token() }}",
                        _method: 'DELETE',
                    },
                    type: 'POST',
                    dateType: 'json',
                    mensajeConfirm: 'El registro se elimino correctamente',
                    url: "{{ config('app.url') }}/panelControl/listRoles?token={{ Session::get('token') }}"
                };
                peticionGeneralAjax(options);
            });
        }
    </script>
@endsection
