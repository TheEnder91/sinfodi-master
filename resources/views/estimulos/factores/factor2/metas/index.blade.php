@extends('layouts.app')

@section('title_page')
    <img src="{{ asset('img/estimulos.png') }}" width="70px" height="40px">Estimulos
@endsection

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ \App\Traits\Principal::getUrlToken('/') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Listado de metas alcanzadas</li>
    </ol>
@endsection

@section('content')
    @component('components.card')
        @slot('title_card', 'FACTOR DE CUMPLIMIENTO DE ACUERDO A METAS ALCANZADAS DEL ÁREA(F2)')
        @can('estimulo-meta-create')
            <section class="text-right">
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalNuevo">
                    <i class="fa fa-plus"></i> Nueva meta
                </button>
            </section><br>
        @endcan
        {{-- Modal nuevo registro --}}
        @section('title_modal')
            <i class="fa fa-plus"></i> Agregar meta alcanzada
        @endsection
        @section('content_modal')
            <input type="text" name="id" id="id" hidden>
            <label for="cumplimiento" class="col-form-control">
                % CUMPLIMIENTO DE METAS:
            </label>
            <textarea class="form-control" name="cumplimiento" id="cumplimientoN"></textarea>
            <label for="f2" class="col-form-control">
                F2 = FACTOR X Cumplimiento de Indicadores Institucionales:
            </label>
            <input type="text" name="f2" id="f2N" class="form-control" onKeyPress="return soloNumeros(event)">
            @section('buttons_modal')
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
                <input type="button" class="btn btn-success" value="Guardar" id="btnGuardar"/>
            @endsection
        @endsection
        {{-- Termina modal nuevo registro --}}
        <div class="table-responsive">
            <table id="tblMetas" class="table table-bordered table-striped">
                <caption>Los valores de esta tabla podrán ser modificados a criterío de la Dirección General.</caption>
                <thead>
                    <tr class="text-center">
                        <th scope="col">#</th>
                        <th scope="col">% CUMPLIMIENTO DE METAS</th>
                        <th scope="col">F2= FACTOR x Cumplimiento de Indicadores Institucionales</th>
                        @if (Auth::user()->hasPermissionTo('estimulo-meta-show') || Auth::user()->hasPermissionTo('estimulo-meta-delete'))
                            <th scope="col">Acciones</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($metas as $item)
                        <tr>
                            <th scope="row" class="text-center" width="2%">{{ $item->id }}</th>
                            <td width="44%" class="text-center">{{ $item->cumplimiento }}</td>
                            <td width="44%" class="text-center">{{ $item->f2 }}</td>
                            @if (Auth::user()->hasPermissionTo('estimulo-meta-show') || Auth::user()->hasPermissionTo('estimulo-meta-delete'))
                                <td class="text-center" width="10%">
                                    @can('estimulo-meta-show')
                                        <a href="javascript:editarMeta({{ $item->id }})"><i class="fa fa-pencil-alt"></i></a>
                                    @endcan
                                    @can('estimulo-meta-delete')
                                        <a href="javascript:eliminarMeta({{ $item->id }})"><i class="fa fa-trash-alt"></i></a>
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
                $('#tblMetas').DataTable({
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
        @include('estimulos.factores.factor2.metas.modalEditar')
    @endcomponent
@endsection

@section('scripts')
    <script>
        $(document).ready(initMetas);

        function initMetas(){
            $('#btnGuardar').on('click', guardarMetas);
            $('#btnActualizar').on('click', actualizarMetas);
        }

        function guardarMetas(){
            var cumplimiento = $('#cumplimientoN').val();
            var factor = $('#f2N').val();
            // console.log(nombre); // Se comenta para futuras pruebas...
            // console.log(puntos); // Se comenta para futuras pruebas...
            if(cumplimiento === "" || factor === ""){
                swal({
                    type: 'warning',
                    title: '',
                    text: 'Por favor de ingresar los campos requeridos.',
                });
                return;
            }
            var options = {
                action: "{{ config('app.url') }}/estimulos/factor2/metas/storeMetas",
                json: {
                    cumplimiento: cumplimiento,
                    f2: factor,
                    _token: "{{ csrf_token() }}",
                },
                type: 'POST',
                dateType: 'json',
                mensajeConfirm: 'El registro se agrego correctamente',
                url: "{{ config('app.url') }}/estimulos/factor2/metas/listMetas?token={{ Session::get('token') }}"
            };
            peticionGeneralAjax(options);
        }

        function editarMeta(id){
            consultarDatos({
                action: "{{ config('app.url') }}/estimulos/factor2/metas/showMetas/" + id,
                type: 'GET',
                dataType: 'json',
                ok: function(data){
                    // console.log(data.response.id); // Se comenta para futuras pruebas...
                    // console.log(data.response.cumplimiento); // Se comenta para futuras pruebas...
                    // console.log(data.response.f2); // Se comenta para futuras pruebas...
                    $('#id').val(data.response.id);
                    $('#cumplimientoE').val(data.response.cumplimiento);
                    $('#f2E').val(data.response.f2);
                    $('#modalEditar').modal('show');
                },
            });
        }

        function actualizarMetas(){
            var id = $('#id').val();
            var cumplimiento = $('#cumplimientoE').val();
            var f2 = $('#f2E').val();
            // console.log(id); // Se comenta para futuras pruebas...
            // console.log(cumplimiento); // Se comenta para futuras pruebas...
            // console.log(f2); // Se comenta para futuras pruebas...
            if(cumplimiento === "" || f2 === ""){
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
                    action: "{{ config('app.url') }}/estimulos/factor2/metas/updateMetas/" + id,
                    json: {
                        cumplimiento: cumplimiento,
                        f2: f2,
                        _token: "{{ csrf_token() }}",
                    },
                    type: 'PUT',
                    dateType: 'json',
                    mensajeConfirm: 'El registro se actualizo correctamente',
                    url: "{{ config('app.url') }}/estimulos/factor2/metas/listMetas?token={{ Session::get('token') }}"
                };
                peticionGeneralAjax(options);
            });
        }

        function eliminarMeta(id){
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
                    action: "{{ config('app.url') }}/estimulos/factor2/metas/destroyMetas/" + id,
                    json: {
                        _token: "{{ csrf_token() }}",
                        _method: 'DELETE',
                    },
                    type: 'POST',
                    dateType: 'json',
                    mensajeConfirm: 'El registro se elimino correctamente',
                    url: "{{ config('app.url') }}/estimulos/factor2/metas/listMetas?token={{ Session::get('token') }}"
                };
                peticionGeneralAjax(options);
            });
        }
    </script>
@endsection
