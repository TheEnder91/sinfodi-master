@extends('layouts/app')

@section('title_page')
    <img src="{{ asset('img/panel_control.png') }}" width="50px" height="50px"> Panel de control
@endsection

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ \App\Traits\Principal::getUrlToken('/') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Listado de usuarios</li>
    </ol>
@endsection

@section('content')
    @component('components.card')
        @slot('title_card', 'Listado de usuarios')
        <div class="table-responsive" id="central">
            <table id="tblUsers" class="table table-bordered table-striped">
                <caption style="font-size:13px;">Lisado de usuarios a los cuales se les dara un rol.</caption>
                <thead>
                    <tr class="text-center">
                        <th width="5%" style="font-size:13px;">#</th>
                        <th style="font-size:13px;">Nombre</th>
                        <th style="font-size:13px;">Usuario</th>
                        <th style="font-size:13px;">Fecha de acceso</th>
                        {{-- @if (Auth::user()->hasPermissionTo('admin-user-show')) --}}
                            <th width="10%" style="font-size:13px;">Acciones</th>
                        {{-- @endif --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="text-center">
                            <th scope="row" width="8%" style="font-size:12px;">{{ $user->clave }}</th>
                            <td width="55%" style="font-size:12px;">{{ $user->nombre }}</td>
                            <td width="10%" style="font-size:12px;">{{ $user->usuario }}</td>
                            <td width="15%" style="font-size:12px;">{{ $user->created_at }}</td>
                            {{-- @if (Auth::user()->hasPermissionTo('admin-user-show')) --}}
                                <td width="5%" style="font-size:12px;">
                                    {{-- @can('admin-user-show') --}}
                                        <a href="javascript:getUrlToken('/panelControl/showUser/{{ $user->id }}', true)"><i class="fa fa-edit"></i></a>
                                    {{-- @endcan --}}
                                </td>
                            {{-- @endif --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @slot('script_tabla')
            <script>
                $(function(){
                    $('#tblUsers').DataTable({
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
