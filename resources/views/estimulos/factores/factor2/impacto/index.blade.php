@extends('layouts.app')

@section('title_page')
    <img src="{{ asset('img/estimulos.png') }}" width="70px" height="40px">Estimulos
@endsection

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ \App\Traits\Principal::getUrlToken('/') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Listado de nivel de impacto</li>
    </ol>
@endsection

@section('content')
    @component('components.card')
        @slot('title_card', 'FACTOR DEL NIVEL DE IMPACTO AL DESARROLLO INTITUCIONAL(F2)')
        @can('estimulo-impacto-create')
            <section class="text-right">
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalNuevo" style="font-size:13px;">
                    <i class="fa fa-plus"></i> Nuevo Nivel de Impacto
                </button>
            </section><br>
        @endcan
        {{-- Modal nuevo registro --}}
        @section('title_modal')
            <i class="fa fa-plus"></i> Agregar Nivel de Impacto
        @endsection
        @section('content_modal')
            <input type="text" name="id" id="id" hidden>
            <label for="factor" class="col-form-control" style="font-size:13px;">
                <span style="color: red">*</span>F2 = FACTOR:
            </label>
            <input type="text" name="factor" id="factorN" class="form-control form-control-sm" onKeyPress="return soloNumeros(event)">
            <label for="nivel" class="col-form-control" style="font-size:13px;">
                <span style="color: red">*</span>Nivel:
            </label>
            <select name="nivel" id="nivelN" class="form-control form-control-sm">
                <option value="" selected disabled style="font-size:13px;">Seleccione un nivel...</option>
                <option value="Alto">Alto</option>
                <option value="Medio">Medio</option>
                <option value="Bajo">Bajo</option>
                <option value="Nulo">Nulo</option>
            </select>
            @section('buttons_modal')
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal" style="font-size:13px;">Cancelar</button>
                <input type="button" class="btn btn-success" value="Guardar" id="btnGuardar" style="font-size:13px;"/>
            @endsection
        @endsection
        {{-- Termina modal nuevo registro --}}
        <div class="table-responsive">
            <table id="tblImpacto" class="table table-bordered table-striped">
                <caption>Listado del factor por nivel de impacto al desarrollo institucional.</caption>
                <thead>
                    <tr class="text-center">
                        <th scope="col" style="font-size:13px;">#</th>
                        <th scope="col" style="font-size:13px;">F2 = FACTOR</th>
                        <th scope="col" style="font-size:13px;">Nivel</th>
                        @if (Auth::user()->hasPermissionTo('estimulo-impacto-show') || Auth::user()->hasPermissionTo('estimulo-impacto-delete'))
                            <th scope="col" style="font-size:13px;">Acciones</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($impacto as $item)
                        <tr>
                            <th scope="row" class="text-center" width="2%" style="font-size:12px;">{{ $item->id }}</th>
                            <td width="44%" class="text-center" style="font-size:12px;">{{ $item->factor }}</td>
                            <td width="44%" class="text-center" style="font-size:12px;">{{ $item->nivel }}</td>
                            @if (Auth::user()->hasPermissionTo('estimulo-impacto-show') || Auth::user()->hasPermissionTo('estimulo-impacto-delete'))
                                <td class="text-center" width="10%" style="font-size:12px;">
                                    @can('estimulo-impacto-show')
                                        <a href="javascript:editarImpacto({{ $item->id }})"><i class="fa fa-edit"></i></a>
                                    @endcan
                                    @can('estimulo-impacto-delete')
                                        <a href="javascript:eliminarImpacto({{ $item->id }})"><i class="fa fa-trash-alt"></i></a>
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
                $('#tblImpacto').DataTable({
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
        @include('estimulos.factores.factor2.impacto.modalEditar')
    @endcomponent
@endsection

@section('scripts')
    <script>
        $(document).ready(initImpactos);

        function initImpactos(){
            $('#btnGuardar').on('click', guardarImpactos);
            $('#btnActualizar').on('click', actualizarImpactos);
        }

        function guardarImpactos(){
            var factor = $('#factorN').val();
            var nivel = $('#nivelN').val();
            // console.log(factor); // Se comenta para futuras pruebas...
            // console.log(nivel); // Se comenta para futuras pruebas...
            if(factor === "" || nivel === null){
                swal({
                    type: 'warning',
                    title: '',
                    text: 'Por favor de ingresar los campos requeridos.',
                });
                return;
            }
            var options = {
                action: "{{ config('app.url') }}/estimulos/factor2/inpacto/storeImpacto",
                json: {
                    factor: factor,
                    nivel: nivel,
                    _token: "{{ csrf_token() }}",
                },
                type: 'POST',
                dateType: 'json',
                mensajeConfirm: 'El registro se agrego correctamente',
                url: "{{ config('app.url') }}/estimulos/factor2/inpacto/listImpacto?token={{ Session::get('token') }}"
            };
            peticionGeneralAjax(options);
        }

        function editarImpacto(id){
            consultarDatos({
                action: "{{ config('app.url') }}/estimulos/factor2/inpacto/showImpacto/" + id,
                type: 'GET',
                dataType: 'json',
                ok: function(data){
                    // console.log(data.response.id); // Se comenta para futuras pruebas...
                    // console.log(data.response.factor); // Se comenta para futuras pruebas...
                    // console.log(data.response.nivel); // Se comenta para futuras pruebas...
                    $('#id').val(data.response.id);
                    $('#factorE').val(data.response.factor);
                    $('#nivelE').val(data.response.nivel);
                    $('#modalEditar').modal('show');
                },
            });
        }

        function actualizarImpactos(){
            var id = $('#id').val();
            var factor = $('#factorE').val();
            var nivel = $('#nivelE').val();
            // console.log(factor); // Se comenta para futuras pruebas...
            // console.log(nivel); // Se comenta para futuras pruebas...
            if(factor === "" || nivel === null){
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
                    action: "{{ config('app.url') }}/estimulos/factor2/inpacto/updateImpacto/" + id,
                    json: {
                        factor: factor,
                        nivel: nivel,
                        _token: "{{ csrf_token() }}",
                    },
                    type: 'PUT',
                    dateType: 'json',
                    mensajeConfirm: 'El registro se actualizo correctamente',
                    url: "{{ config('app.url') }}/estimulos/factor2/inpacto/listImpacto?token={{ Session::get('token') }}"
                };
                peticionGeneralAjax(options);
            });
        }

        function eliminarImpacto(id){
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
                    action: "{{ config('app.url') }}/estimulos/factor2/inpacto/destroyImpacto/" + id,
                    json: {
                        _token: "{{ csrf_token() }}",
                        _method: 'DELETE',
                    },
                    type: 'POST',
                    dateType: 'json',
                    mensajeConfirm: 'El registro se elimino correctamente',
                    url: "{{ config('app.url') }}/estimulos/factor2/inpacto/listImpacto?token={{ Session::get('token') }}"
                };
                peticionGeneralAjax(options);
            });
        }
    </script>
@endsection
