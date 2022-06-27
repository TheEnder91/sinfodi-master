@extends('layouts.app')

@section('title_page')
    <img src="{{ asset('img/estimulos.png') }}" width="70px" height="40px">Estimulos
@endsection

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ \App\Traits\Principal::getUrlToken('/') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Generar acuses</li>
    </ol>
@endsection

@section('content')
    @component('components.card')
        @slot('title_card', 'Generar acuses')
        <div class="row">
            <div class="col-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="year" style="font-size:13px;">Seleccione el año:</label>
                    </div>
                    <select class="custom-select text-center" style="font-size:13px;" id="year" onChange="ShowSelected();">
                        @for ($i = date('Y'); $i >= 2021; $i--)
                            <option value="{{ $i - 1 }}">{{ $i - 1 }}</option>
                        @endfor
                    </select>
                </div>
            </div>
            <div class="col-4">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="direccion" style="font-size:13px;">Seleccione la dirección:</label>
                    </div>
                    <select class="custom-select text-center" style="font-size:13px;" id="direccion" onChange="ShowSelectedDireccion();">
                        <option selected value="Direccion general">Dirección general</option>
                        <option value="Direccion administracion">Dirección de administración</option>
                        <option value="Direccion posgrado">Dirección de posgrado</option>
                        <option value="Direccion ciencia">Dirección de ciencia</option>
                        <option value="Direccion servicios">Dirección de servicios</option>
                        <option value="Direccion tecnologia">Dirección de tecnología</option>
                    </select>
                </div>
            </div>
        </div><br>
        <div class="table-responsive">
            <table id="tblDirecciones" class="table table-bordered table-striped" style="font-size:13px;">
                <thead>
                    <tr class="text-center">
                        <th scope="col" style="font-size:13px;">Clave</th>
                        <th scope="col" style="font-size:13px;">Nombre</th>
                        <th scope="col" style="font-size:13px;">Acuse</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
        {{-- @include('estimulos.evaluaciones.acuses.table') --}}
    @endcomponent
@endsection

@section('scripts')
    <script>
        $(document).ready(initDirecciones);

        function initDirecciones(){
            var direccion = document.getElementById("direccion").value;
            verPersonalDireccion(direccion, 0);
        }

        function ShowSelected(){
            var year = document.getElementById("year").value;
            var direccion = document.getElementById("direccion").value;
            verPersonalDireccion(direccion, year);
        }

        function ShowSelectedDireccion(){
            var year = document.getElementById("year").value;
            var direccion = document.getElementById("direccion").value;
            verPersonalDireccion(direccion, year);
        }

        function verPersonalDireccion(direccion, year){
            if(year === 0){
                var año = document.getElementById("year").value;
            }else{
                var año = year;
            }
            // console.log(direccion+'->'+year);
            consultarDatos({
                action: "{{ config('app.url') }}/estimulos/evaluaciones/getDirecciones/" + year + "/" + direccion,
                type: 'GET',
                dataType: 'json',
                ok: function(datosDirecciones){
                    // console.log(datosDirecciones);
                    var row = "";
                    if(datosDirecciones.length > 0){
                        for(var i = 0; i < datosDirecciones.length; i++){
                            var data = datosDirecciones[i];
                            // console.log(data);
                            var authUser = '<?= Auth::user()->usuario ?>';
                            var permissions = '<?= Auth::user()->hasPermissionTo("estimulo-evaluaciones-acuses-index") ?>';
                            // if(data.username == authUser || permissions == 1){
                                row += "<tr>";
                                row += '<th scope="row" class="text-center" width="10%" style="font-size:12px; vertical-align:middle;">' + data.clave + '</td>';
                                row += '<td width="80%" style="font-size:12px; vertical-align:middle;">' + data.nombre.toUpperCase() + "</td>";
                                row += '<td class="text-center" width="10%" style="font-size:18px;"><a href="javascript:verAcuse(\'' + direccion + '\', ' + '\'' + data.nombre + '\', ' + data.clave + ', ' + año + ')"><i class="fa fa-file-pdf"></i></a></td>';
                                row += "</tr>";
                            // }
                        }
                    }
                    if ($.fn.dataTable.isDataTable("#tblDirecciones")) {
                        tblDifusionDivulgacion = $("#tblDirecciones").DataTable();
                        tblDifusionDivulgacion.destroy();
                    }
                    $('#tblDirecciones > tbody').html('');
                    $('#tblDirecciones > tbody').append(row);
                    $('#tblDirecciones').DataTable({
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
                },
            });
        }

        function verAcuse(direccion, nombre, clave, year){
            var url2 = '{{ \App\Traits\Principal::getUrlToken("/estimulos/evaluaciones/generarAcusePDF/direccion/nombre/clave/year") }}';
            var link1 = url2.replace('direccion', direccion);
            var link2 = link1.replace('clave', clave);
            var link3 = link2.replace('year', year);
            var url = link3.replace('nombre', nombre);
            // console.log(link3);
            window.open(url, "_blank");
        }
    </script>
@endsection
