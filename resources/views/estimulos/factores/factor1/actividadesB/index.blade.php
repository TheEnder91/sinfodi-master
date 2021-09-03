@extends('layouts.app')

@section('title_page')
    <img src="{{ asset('img/estimulos.png') }}" width="70px" height="40px">Estimulos
@endsection

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ \App\Traits\Principal::getUrlToken('/') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Tabla 1. Actividades B</li>
    </ol>
@endsection

@section('content')
    @component('components.card')
        @slot('title_card', 'Tabla 1. Actividades B')
        @can('estimulo-actividadB-create')
            <section class="text-right">
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalNuevo">
                    <i class="fa fa-plus"></i> Nuevo criterio
                </button>
            </section><br>
        @endcan
        {{-- Modal nuevo registro --}}
        @section('title_modal')
            <i class="fa fa-plus"></i> Agregar criterio
        @endsection
        @section('content_modal')
            <input type="text" name="id" id="id" hidden>
            <label for="" class="col-form-control">
                Criterio:
            </label>
            <textarea class="form-control" name="nombre" id="nombreN"></textarea>
            <label for="" name='id_objetivo'>
                Objetivo al que pertenece:
            </label>
            <select name="id_objetivo" id="id_objetivoN" class="form-control">
                <option value="" selected disabled>Seleccione un objetivo...</option>
                @foreach ($objetivos as $item)
                    <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                @endforeach
            </select>
            <label for="" name='puntos' class="col-form-control">
                Punto asginado:
            </label>
            <input type="number" name="puntos" class="form-control" onKeyPress="return soloNumeros(event)" id="puntosN">
            <input type="text" name="observaciones" id="observaciones" value="Tabla 1. Actividad B." hidden>
            @section('buttons_modal')
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
                <input type="button" class="btn btn-success" value="Guardar" id="btnGuardar"/>
            @endsection
        @endsection
        {{-- Termina modal nuevo registro --}}
        <div class="table-responsive">
            <table id="tblActividadesB" class="table table-bordered table-striped">
                <caption>Actividades sustantivas que, ademas, buscan impulsar el trabajo colaborativo, la transferencia de tecnologia, la rentabilidad de los proyectos y contribuyen a alcanzar la autosostentabilidad del centro.</caption>
                <thead>
                    <tr class="text-center">
                        <th scope="col">#</th>
                        <th scope="col">Criterio</th>
                        <th scope="col">Objetivo</th>
                        <th scope="col">Puntos</th>
                        @if (Auth::user()->hasPermissionTo('estimulo-actividadB-show') || Auth::user()->hasPermissionTo('estimulo-actividadB-delete'))
                            <th scope="col">Acciones</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datos as $item)
                        <tr>
                            <th scope="row" width="5%" class="text-center">{{ $item->id }}</td>
                            <td width="42%">{{ $item->nombre }}</td>
                            <td width="35%">{{ $item->modulo->nombre }}</td>
                            <td class="text-center" width="8%">{{ $item->puntos }}</td>
                            @if (Auth::user()->hasPermissionTo('estimulo-actividadB-show') || Auth::user()->hasPermissionTo('estimulo-actividadB-delete'))
                                <td class="text-center" width="10%">
                                    @can('estimulo-actividadB-show')
                                        <a href="javascript:editarActividadB({{ $item->id }})"><i class="fa fa-pencil-alt"></i></a>
                                    @endcan
                                    @can('estimulo-actividadB-delete')
                                        <a href="javascript:eliminarActividadB({{ $item->id }})"><i class="fa fa-trash-alt"></i></a>
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
                $('#tblActividadesB').DataTable({
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
        @include('estimulos.factores.factor1.actividadesB.modalEditar')
    @endcomponent
@endsection

@section('scripts')
    <script>
        $(document).ready(initActividadesB);

        function initActividadesB(){
            $('#btnGuardar').on('click', guardarActividadesB);
            $('#btnActualizar').on('click', actualizarActividadesB);
        }

        function guardarActividadesB(){
            var criterio = $('#nombreN').val();
            var objetivo = $('#id_objetivoN').val();
            var puntos = $('#puntosN').val();
            var observaciones = $('#observaciones').val();
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
                action: "{{ config('app.url') }}/estimulos/factor1/criterios/storeActividadesB",
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
                url: "{{ config('app.url') }}/estimulos/factor1/criterios/listActividadesB?token={{ Session::get('token') }}"
            };
            peticionGeneralAjax(options);
        }

        function editarActividadB(id){
            consultarDatos({
                action: "{{ config('app.url') }}/estimulos/factor1/criterios/showActividadesB/" + id,
                type: 'GET',
                dataType: 'json',
                ok: function(data){
                    // console.log(data.response.id); // Se comenta para futuras pruebas...
                    // console.log(data.response.nombre); // Se comenta para futuras pruebas...
                    // console.log(data.response.id_objetivo); // Se comenta para futuras pruebas...
                    // console.log(data.response.puntos); // Se comenta para futuras pruebas...
                    $('#id').val(data.response.id);
                    $('#nombreE').val(data.response.nombre);
                    $('#id_objetivoE').val(data.response.id_objetivo);
                    $('#puntosE').val(data.response.puntos);
                    $('#modalEditar').modal('show');
                },
            });
        }

        function actualizarActividadesB(){
            var id = $('#id').val();
            var criterio = $('#nombreE').val();
            var objetivo = $('#id_objetivoE').val();
            var puntos = $('#puntosE').val();
            var observaciones = $('#observaciones').val();
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
                    action: "{{ config('app.url') }}/estimulos/factor1/criterios/updateActividadesB/" + id,
                    json: {
                        nombre: criterio,
                        id_objetivo: objetivo,
                        puntos: puntos,
                        _token: "{{ csrf_token() }}",
                    },
                    type: 'PUT',
                    dateType: 'json',
                    mensajeConfirm: 'El registro se actualizo correctamente',
                    url: "{{ config('app.url') }}/estimulos/factor1/criterios/listActividadesB?token={{ Session::get('token') }}"
                };
                peticionGeneralAjax(options);
            });
        }

        function eliminarActividadB(id){
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
                    action: "{{ config('app.url') }}/estimulos/factor1/criterios/destroyActividadesB/" + id,
                    json: {
                        _token: "{{ csrf_token() }}",
                        _method: 'DELETE',
                    },
                    type: 'POST',
                    dateType: 'json',
                    mensajeConfirm: 'El registro se elimino correctamente',
                    url: "{{ config('app.url') }}/estimulos/factor1/criterios/listActividadesB?token={{ Session::get('token') }}"
                };
                peticionGeneralAjax(options);
            });
        }
    </script>
@endsection
