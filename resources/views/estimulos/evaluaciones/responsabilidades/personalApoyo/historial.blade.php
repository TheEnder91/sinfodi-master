@extends('layouts.app')

@section('title_page')
    <img src="{{ asset('img/estimulos.png') }}" width="70px" height="40px">Estimulos
@endsection

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ \App\Traits\Principal::getUrlToken('/') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/responsabilidades/personalApoyo/listPersonalApoyo') }}">Evaluacion al personal de apoyo</a></li>
        <li class="breadcrumb-item active">Historial de evaluaciones al personal de apoyo</li>
    </ol>
@endsection

@section('content')
    @component('components.card')
        @slot('title_card', 'Historial de evaluaciones al personal de apoyo')
        <div class="table-responsive" id="central">
            <table id="tblHistorial" class="table table-bordered table-striped">
                <caption>Listado de evaluacion al personal de apoyo.</caption>
                <thead>
                    <tr class="text-center">
                        <th width="5%">Clave</th>
                        <th scope="col" width="65%">Nombre</th>
                        <th scope="col" width="15%">Puesto</th>
                        <th scope="col" width="5%">Puntos</th>
                        <th scope="col" width="5%">Año</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($personalApoyo as $item)
                        @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-apoyo-index') || $item->username == Auth::user()->usuario)
                            <tr>
                                <th scope="row" class="text-center">{{ $item->clave }}</th>
                                <td>{{ $item->nombre }}</td>
                                <td class="text-center">{{ $item->responsabilidad }}</td>
                                <td class="text-center">{{ $item->puntos }}</td>
                                <td class="text-center">{{ $item->year }}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        @slot('script_tabla')
            <script>
                $(function(){
                    $('#tblHistorial').DataTable({
                        "order":[[4, "desc"]],
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
