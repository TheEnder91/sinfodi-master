@extends('layouts.app')

@section('title_page')
    <img src="{{ asset('img/estimulos.png') }}" width="70px" height="40px">Estimulos
@endsection

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ \App\Traits\Principal::getUrlToken('/') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Evaluaciones a directores</li>
    </ol>
@endsection

@section('content')
    @component('components.card')
        @slot('title_card', 'Listado de evaluacion a directores')
        <div class="table-responsive">
            <table id="tblDirectores" class="table table-bordered table-striped">
                <thead>
                    <tr class="text-center">
                        <th scope="col">Clave</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Puesto</th>
                        <th scope="col">Puntos</th>
                        <th scope="col">Año</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($guardadosDatos as $item)
                        @if ($item->username == Auth()->user()->usuario || Auth::user()->hasPermissionTo('estimulo-evaluaciones-directores-index'))
                            <tr>
                                <th scope="row" class="text-center" width="10%">{{ $item->clave }}</th>
                                <td width="40%">{{ $item->nombre }}</td>
                                <td width="30%" class="text-center">{{ $item->responsabilidad }}</td>
                                <td class="text-center" width="10%">{{ $item->puntos }}</td>
                                <td class="text-center" width="10%">{{ $item->year }}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        <script>
            $(function(){
                $('#tblDirectores').DataTable({
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
    @endcomponent
@endsection
