@extends('layouts.app')

@section('title_page')
    <img src="{{ asset('img/estimulos.png') }}" width="70px" height="40px">Estimulos
@endsection

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ \App\Traits\Principal::getUrlToken('/') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Evaluaciones a la dirección General->Sostentabilidad economica</li>
    </ol>
@endsection

@section('content')
    @component('components.card')
        @slot('title_card', 'Evaluación a la dirección general->Sostentabilidad economica')
        <div class="row">
            <div class="col-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="year">Seleccione el año:</label>
                    </div>
                    <select class="custom-select" id="year" onChange="ShowSelected();">
                        @for ($i = date('Y'); $i >= 2020; $i--)
                            <option value="{{ $i - 1 }}">{{ $i - 1 }}</option>
                        @endfor
                    </select>
                </div>
            </div>
        </div><br>
        <div class="table-responsive">
            <table id="tblCriterio14" class="table table-bordered table-striped">
                <thead>
                    <tr class="text-center">
                        <th scope="col">Clave</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Puntos</th>
                        <th scope="col">Total</th>
                        <th scope="col">Año</th>
                        {{-- @if (Auth::user()->hasPermissionTo("estimulo-evaluaciones-general-difusiondivulgacion-index")) --}}
                            <th scope="col">Evidencias</th>
                        {{-- @endif --}}
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    @endcomponent
@endsection

@section('scripts')
    <script>
        $(document).ready(initCriterio14);

        function initCriterio14(){
            obtenerCriterio14(0);
        }

        function ShowSelected(){
            var year = document.getElementById("year").value;
            obtenerCriterio14(year);
        }

        function obtenerCriterio14(year){
            if(year === 0){
                var año = document.getElementById("year").value;
            }else{
                var año = year;
            }
            if ($.fn.dataTable.isDataTable("#tblCriterio14")) {
                tblDifusionDivulgacion = $("#tblCriterio14").DataTable();
                tblDifusionDivulgacion.destroy();
            }
            var row = "";
            $('#tblCriterio14 > tbody').html('');
            $('#tblCriterio14 > tbody').append(row);
            $('#tblCriterio14').DataTable({
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
                lengthMenu: [[10, 15, 20, 50], [10, 15, 20, 50]]
            });
        }
    </script>
@endsection
