@extends('layouts.app')

@section('title_page')
    <img src="{{ asset('img/estimulos.png') }}" width="70px" height="40px">Estimulos
@endsection

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ \App\Traits\Principal::getUrlToken('/') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Listado de factor por desempeño</li>
    </ol>
@endsection

@section('content')
    @component('components.card')
        @slot('title_card', 'FACTOR DE CUMPLIMIENTO DE ACUERDO A LA EVALUACION CUALITATIVA DE DESEMPEÑO(F3)')
        @can('estimulo-desempeño-create')
            <section class="text-right">
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalNuevo">
                    <i class="fa fa-plus"></i> Nuevo Factor por Desempeño
                </button>
            </section><br>
        @endcan
        {{-- Modal nuevo registro --}}
        @section('title_modal')
            <i class="fa fa-plus"></i> Agregar Factor por Desempeño
        @endsection
        @section('content_modal')
            <input type="text" name="id" id="id" hidden>
            <label for="resultados" class="col-form-control">
                RESULTADO DE LA EVALUACION:
            </label>
            <input type="text" name="resultados" id="resultadosN" class="form-control">
            <label for="f3" class="col-form-control">
                F3 = FACTOR X Cumplimiento de Metas de Desempeño Cualitativo:
            </label>
            <input type="text" name="f3" id="f3N" class="form-control" onKeyPress="return soloNumeros(event)">
            @section('buttons_modal')
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
                <input type="button" class="btn btn-success" value="Guardar" id="btnGuardar"/>
            @endsection
        @endsection
        {{-- Termina modal nuevo registro --}}
        <div class="table-responsive">
            <table id="tblDesempeño" class="table table-bordered table-striped">
                <caption>Los valores de esta tabla podrán ser modificados a criterío de la Dirección General.</caption>
                <thead>
                    <tr class="text-center">
                        <th scope="col">#</th>
                        <th scope="col">RESULTADO DE LA EVALUACION</th>
                        <th scope="col">F3 = FACTOR x Cumplimiento de Metas de Desempeño Cualitativo</th>
                        @if (Auth::user()->hasPermissionTo('estimulo-desempeño-show') || Auth::user()->hasPermissionTo('estimulo-desempeño-delete'))
                            <th scope="col">Acciones</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($desempeño as $item)
                        <tr>
                            <th scope="row" class="text-center" width="2%">{{ $item->id }}</th>
                            <td width="44%" class="text-center">{{ $item->resultados }}</td>
                            <td width="44%" class="text-center">{{ $item->f3 }}</td>
                            @if (Auth::user()->hasPermissionTo('estimulo-desempeño-show') || Auth::user()->hasPermissionTo('estimulo-desempeño-delete'))
                                <td class="text-center" width="10%">
                                    @can('estimulo-desempeño-show')
                                        <a href="javascript:editarObjetivo({{ $item->id }})"><i class="fa fa-pencil-alt"></i></a>
                                    @endcan
                                    @can('estimulo-desempeño-delete')
                                        <a href="javascript:eliminarObjetivo({{ $item->id }})"><i class="fa fa-trash-alt"></i></a>
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
                $('#tblDesempeño').DataTable({
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
        @include('estimulos.factores.factor3.desempeños.modalEditar')
    @endcomponent
@endsection

@section('scripts')
    <script>
        $(document).ready(initDesempeño);

        function initDesempeño(){
            $('#btnGuardar').on('click', guardarDesempeño);
            $('#btnActualizar').on('click', actualizarDesempeño);
        }

        function guardarDesempeño(){
            var resultados = $('#resultadosN').val();
            var f3 = $('#f3N').val();
            // console.log(resultados); //Se comenta para futuras pruebas...
            // console.log(f3); //Se comenta para futuras pruebas...
            if(resultados === "" || f3 === ""){
                swal({
                    type: 'warning',
                    title: '',
                    text: 'Por favor de ingresar los campos requeridos.',
                });
                return;
            }
            var options = {
                action: "{{ config('app.url') }}/estimulos/factor3/desempeño/storeDesempeño",
                json: {
                    resultados: resultados,
                    f3: f3,
                    _token: "{{ csrf_token() }}",
                },
                type: 'POST',
                dateType: 'json',
                mensajeConfirm: 'El registro se agrego correctamente',
                url: "{{ config('app.url') }}/estimulos/factor3/desempeño/listDesempeño?token={{ Session::get('token') }}"
            };
            peticionGeneralAjax(options);
        }

        function editarObjetivo(id){
            consultarDatos({
                action: "{{ config('app.url') }}/estimulos/factor3/desempeño/showDesempeño/" + id,
                type: 'GET',
                dataType: 'json',
                ok: function(data){
                    // console.log(data.response.id); //Se comenta para futuras pruebas...
                    // console.log(data.response.resultados); //Se comenta para futuras pruebas...
                    // console.log(data.response.f3); //Se comenta para futuras pruebas...
                    $('#id').val(data.response.id);
                    $('#resultadosE').val(data.response.resultados);
                    $('#f3E').val(data.response.f3);
                    $('#modalEditar').modal('show');
                },
            });
        }

        function actualizarDesempeño(){
            var id = $('#id').val();
            var resultados = $('#resultadosE').val();
            var f3 = $('#f3E').val();
            // console.log(id); //Se comenta para futuras pruebas...
            // console.log(resultados); //Se comenta para futuras pruebas...
            // console.log(f3); //Se comenta para futuras pruebas...
            if(resultados === "" || f3 === ""){
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
                    action: "{{ config('app.url') }}/estimulos/factor3/desempeño/updateDesempeño/" + id,
                    json: {
                        resultados: resultados,
                        f3: f3,
                        _token: "{{ csrf_token() }}",
                    },
                    type: 'PUT',
                    dateType: 'json',
                    mensajeConfirm: 'El registro se actualizo correctamente',
                    url: "{{ config('app.url') }}/estimulos/factor3/desempeño/listDesempeño?token={{ Session::get('token') }}"
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
                    action: "{{ config('app.url') }}/estimulos/factor3/desempeño/destroyDesempeño/" + id,
                    json: {
                        _token: "{{ csrf_token() }}",
                        _method: 'DELETE',
                    },
                    type: 'POST',
                    dateType: 'json',
                    mensajeConfirm: 'El registro se elimino correctamente',
                    url: "{{ config('app.url') }}/estimulos/factor3/desempeño/listDesempeño?token={{ Session::get('token') }}"
                };
                peticionGeneralAjax(options);
            });
        }
    </script>
@endsection
