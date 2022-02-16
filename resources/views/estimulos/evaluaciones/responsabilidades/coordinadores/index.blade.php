@extends('layouts.app')

@section('title_page')
    <img src="{{ asset('img/estimulos.png') }}" width="70px" height="40px">Estimulos
@endsection

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ \App\Traits\Principal::getUrlToken('/') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Evaluaciones a coordinadores</li>
    </ol>
@endsection

@section('content')
    @component('components.card')
        @slot('title_card', 'Listado de evaluacion a coordinadores')
        <section class="text-right">
            <a href="{{ \App\Traits\Principal::getUrlToken('/estimulos/evaluaciones/responsabilidades/Coordinadores/historialCoordinadores') }}" class="btn btn-primary" role="button" aria-disabled="true">
                <i class="fas fa-history"></i> Ver historial
            </a>
        </section><br>
        <div class="table-responsive">
            <table id="tblCoordinadores" class="table table-bordered table-striped">
                <thead>
                    <tr class="text-center">
                        <th scope="col">Clave</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Puesto</th>
                        <th scope="col">Puntos</th>
                        <th scope="col">Año</th>
                        @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-coordinadores-index'))
                            <th scope="col">Acciones</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($guardadosDatos as $item)
                        @if ($item->username == Auth()->user()->usuario || Auth::user()->hasPermissionTo('estimulo-evaluaciones-coordinadores-index'))
                            <tr>
                                <th scope="row" class="text-center" width="10%">{{ $item->clave }}</th>
                                <td width="50%">{{ $item->nombre }}</td>
                                <td width="30%" class="text-center">{{ $item->responsabilidad }}</td>
                                <td class="text-center" width="10%">{{ $item->puntos }}</td>
                                <td class="text-center" width="10%">{{ $item->year }}</td>
                                @if (Auth::user()->hasPermissionTo('estimulo-evaluaciones-coordinadores-index'))
                                    <td class="text-center" width="10%">
                                        <a href="javascript:guardarCoordinador('{{ $item->clave }}', '{{ $item->nombre }}', '{{ $item->direccion }}', '{{ $item->responsabilidad }}', {{ $item->puntos }}, {{ $item->year }}, '{{ $item->username }}')"><i class="far fa-save fa-lg"></i></a>
                                    </td>
                                @endif
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        <script>
            $(function(){
                $('#tblCoordinadores').DataTable({
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

@section('scripts')
    <script>
        $(document).ready(initCoordinadores);

        function initCoordinadores(){
            $('#btnGuardarCoordinadores').on('click', guardarCoordinador);
        }

        function guardarCoordinador(clave, nombre, direccion, responsabilidad, puntos, year, username){
            swal({
                type: 'warning',
                title: "Se guardara el registro.",
                text: "¿Desea continuar?",
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: "Si, guardar",
                denyButtonText: "Cancelar",
            }).then((result) => {
                consultarDatos({
                    action: "{{ config('app.url') }}/estimulos/evaluaciones/responsabilidades/Coordinadores/consultarCoordinadores/" + clave + "/" + year,
                    type: 'GET',
                    dataType: 'json',
                    ok: function(data){
                        // console.log(data); //Se comenta para futuras pruebas...
                        if(data > 0){
                            mostrarMensaje(clave, nombre, year);
                        }else{
                            var options = {
                                action: "{{ config('app.url') }}/estimulos/evaluaciones/responsabilidades/Coordinadores/storeCoordinadores",
                                json: {
                                    clave: clave,
                                    nombre: nombre,
                                    direccion: direccion,
                                    responsabilidad: responsabilidad,
                                    puntos: puntos,
                                    year: year,
                                    username: username,
                                    status: 1,
                                    _token: "{{ csrf_token() }}",
                                },
                                type: 'POST',
                                dateType: 'json',
                                mensajeConfirm: 'El registro se guardo correctamente',
                                url: "{{ config('app.url') }}/estimulos/evaluaciones/responsabilidades/Coordinadores/listCoordinadores?token={{ Session::get('token') }}"
                            };
                            peticionGeneralAjax(options);
                        }
                    },
                });
            }).catch(swal.noop);
        }

        function mostrarMensaje(clave, nombre, year){
            swal({
                type: 'info',
                title: "",
                text: "El usuario "+nombre+" con clave "+clave+" ya se encuentra registrado para la evaluacion del año "+year+", ver historial.",
            });
        }
    </script>
@endsection
