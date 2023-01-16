@extends('layouts.app')

@section('title_page')
    <img src="{{ asset('img/panel_control.png') }}" width="50px" height="50px"> Panel de control
@endsection

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ \App\Traits\Principal::getUrlToken('/') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Listado de permisos</li>
    </ol>
@endsection

@section('content')
    @component('components.card')
        @slot('title_card', 'Listado de permisos')
        <div class="table-responsive">
            <table id="tblPermissions" class="table table-bordered table-striped">
                <caption style="font-size:13px;">Listado de permisos disponibles</caption>
                <thead>
                    <tr class="text-center">
                        <th width="5%" style="font-size:13px;">#</th>
                        <th width="25%" style="font-size:13px;">Nombre</th>
                        <th width="25%" style="font-size:13px;">Slug</th>
                        <th width="30%" style="font-size:13px;">Descripción</th>
                        <th width="15%" style="font-size:13px;">Fecha de creación</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rows as $item)
                        <tr class="text-center">
                            <th style="font-size:12px;" scope="row">{{ $item->id }}</th>
                            <td style="font-size:12px;">{{ $item->name }}</td>
                            <td style="font-size:12px;">{{ $item->slug }}</td>
                            <td style="font-size:12px;" class="text-left">{{ $item->description }}</td>
                            <td style="font-size:12px;">{{ $item->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @slot('script_tabla')
            <script>
                $(function(){
                    $('#tblPermissions').DataTable({
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
