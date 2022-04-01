@extends('layouts.app')

@section('title_page')
    <img src="{{ asset('img/estimulos.png') }}" width="70px" height="40px">Estimulos
@endsection

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ \App\Traits\Principal::getUrlToken('/') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Evaluaciones a la dirección de administracion->Sostenibilidad economica B</li>
    </ol>
@endsection

@section('content')
    @component('components.card')
        @slot('title_card', 'Evaluaciones a la dirección de administracion->Sostenibilidad economica B.')
        <div class="row">
            <div class="col-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="year">Seleccione el año:</label>
                    </div>
                    <select class="custom-select" id="year" onChange="ShowSelected();">
                        @for ($i = date('Y'); $i >= 2021; $i--)
                            <option value="{{ $i - 1 }}">{{ $i - 1 }}</option>
                        @endfor
                    </select>
                </div>
            </div>
        </div><br>
        <div class="table-responsive">
            <table id="tblCriterio37" class="table table-bordered table-striped">
                <caption>Proyecto comercializados con remanente planeado o superior.</caption>
                <thead>
                    <tr class="text-center">
                        <th scope="col" style="font-size:13px;">Clave</th>
                        <th scope="col" style="font-size:13px;">Nombre</th>
                        <th scope="col" style="font-size:13px;">Puntos</th>
                        <th scope="col" style="font-size:13px;">Total</th>
                        <th scope="col" style="font-size:13px;">Año</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    @endcomponent
@endsection

@section('scripts')
    <script>
        $(document).ready(initCriterio37);

        function initCriterio37(){
            obtenerCriterio37(0);
        }

        function ShowSelected(){
            var year = document.getElementById("year").value;
            obtenerCriterio37(year);
        }

        function obtenerCriterio37(year){
            if(year === 0){
                var año = document.getElementById("year").value;
            }else{
                var año = year;
            }
            var row = "";
            if ($.fn.dataTable.isDataTable("#tblCriterio37")) {
                tblDifusionDivulgacion = $("#tblCriterio37").DataTable();
                tblDifusionDivulgacion.destroy();
            }
            $('#tblCriterio37 > tbody').html('');
            $('#tblCriterio37 > tbody').append(row);
            $('#tblCriterio37').DataTable({
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
