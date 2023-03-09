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
                        <label class="input-group-text" for="grupo" style="font-size:13px;">Seleccione un grupo:</label>
                    </div>
                    <select class="custom-select text-center" style="font-size:13px;" id="grupo" onChange="ShowSelectedGrupo();">
                        {{-- <option value="grupo1">Grupo 1</option> --}}
                        <option value="grupo2">Grupo 2</option>
                    </select>
                </div>
            </div>
            <div class="col-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="year" style="font-size:13px;">Seleccione el año:</label>
                    </div>
                    <select class="custom-select text-center" style="font-size:13px;" id="year" onChange="ShowSelectedYear();">
                        @for ($i = date('Y'); $i >= 2021; $i--)
                            <option value="{{ $i - 1 }}">{{ $i - 1 }}</option>
                        @endfor
                    </select>
                </div>
            </div>
            <div class="col-4" id="direccionContenedor">
                <div class="input-group">
                    <div class="input-group-prepend direccionContenedor">
                        <label class="input-group-text" for="direccion" style="font-size:13px;">Seleccione la dirección:</label>
                    </div>
                    <select class="custom-select text-center" style="font-size:13px;" id="direccion" onChange="ShowSelectedDireccion();">
                        <option value="Direccion General">Dirección general</option>
                        <option value="Direccion Administracion">Dirección de administración</option>
                        <option value="Direccion Posgrado">Dirección de posgrado</option>
                        <option value="Direccion Ciencia">Dirección de ciencia</option>
                        <option value="Direccion Servicios">Dirección de servicios</option>
                        <option value="Direccion Tecnologia">Dirección de tecnología</option>
                    </select>
                </div>
            </div>
            {{-- <div class="col-2 text-center">
                <section class="text-right" id="sectionDownload">
                    <a href="javascript:downloadConcentrado();" style="font-size:13px;" class="btn btn-primary" role="button" aria-disabled="true">
                        <i class="fa fa-download"></i> Descargar concentrado
                    </a>
                </section>
            </div> --}}
        </div><br>
        <div class="table-responsive">
            <table id="tblDirecciones" class="table table-bordered table-striped" style="font-size:13px;">
                <thead>
                    <tr class="text-center">
                        <th scope="col" style="font-size:13px;">Clave</th>
                        <th scope="col" style="font-size:13px;">Nombre</th>
                        <th scope="col" style="font-size:13px;">Dirección</th>
                        <th scope="col" style="font-size:13px;">Acuse</th>
                        {{-- <th scope="col" style="font-size:13px;">Firmar</th> --}}
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
            var grupo = document.getElementById("grupo").value;
            var year = year = document.getElementById("year").value;
            verPersonal(grupo, year, direccion);
        }

        function ShowSelectedGrupo(){
            var grupo = document.getElementById("grupo").value;
            var year = document.getElementById("year").value;
            if(grupo == "grupo1"){
                var direccion = document.getElementById("direccion").value;
                document.getElementById("direccionContenedor").style.display="block";
                // document.getElementById("sectionDownload").style.display="block";
            }else if(grupo == "grupo2"){
                document.getElementById("direccionContenedor").style.display="none";
                // document.getElementById("sectionDownload").style.display="none";
                var direccion = "direccionVacio";
            }
            verPersonal(grupo, year, direccion);
        }

        function ShowSelectedYear(){
            var grupo = document.getElementById("grupo").value;
            if(grupo == "grupo1"){
                var direccion = document.getElementById("direccion").value;
                document.getElementById("direccionContenedor").style.display="block";
                // document.getElementById("sectionDownload").style.display="block";
            }else if(grupo == "grupo2"){
                document.getElementById("direccionContenedor").style.display="none";
                // document.getElementById("sectionDownload").style.display="none";
                var direccion = "direccionVacio";
            }
            var year = document.getElementById("year").value;
            verPersonal(grupo, year, direccion);
        }

        function ShowSelectedDireccion(){
            var year = document.getElementById("year").value;
            var direccion = document.getElementById("direccion").value;
            var grupo = document.getElementById("grupo").value;
            verPersonal(grupo, year, direccion);
        }

        function verPersonal(grupo, year, direccion){
            var bandera = false;
            // console.log(grupo+'->'+year+'->'+direccion);
            consultarDatos({
                action: "{{ config('app.url') }}/estimulos/evaluaciones/getDirecciones/" + year + "/" + direccion + "/" + grupo,
                type: 'GET',
                dataType: 'json',
                ok: function(datosPersonal){
                    // console.log(datosPersonal);
                    // console.log(datosPersonal.response.length);
                    var row = "";
                    if(datosPersonal.response.length > 0){
                        // console.log(datosPersonal.response.length);
                        for(var i = 0; i < datosPersonal.response.length; i++){
                            var data = datosPersonal.response[i];
                            // console.log(data);
                            if(grupo == 'grupo1'){
                                if(data.direccion == 'DGeneral'){
                                    var puesto = "Direccion General";
                                }else if(data.direccion == 'DAdministracion'){
                                    var puesto = "Direccion de administración";
                                }else if(data.direccion == 'DPosgrado'){
                                    var puesto = "Direccion de posgrado";
                                }else if(data.direccion == 'DCiencia'){
                                    var puesto = "Direccion de ciencia";
                                }else if(data.direccion == 'DServTec'){
                                    var puesto = "Direccion de servicios tecnologicos";
                                }else if(data.direccion == 'DProyTec'){
                                    var puesto = "Direccion de Tecnologia";
                                }
                            }else if(grupo == 'grupo2'){
                                var puesto = data.responsabilidad;
                            }
                            // console.log(data);
                            var authUser = '<?= Auth::user()->usuario ?>';
                            // console.log(grupo + ' -> ' + data.username);
                            var permissions = '<?= Auth::user()->hasPermissionTo("estimulo-evaluaciones-acuses-index") ?>';
                            // if(data.direccion == 'DCiencia' || data.direccion == 'DServTec' || data.direccion == 'DProyTec'){
                                if(data.username == authUser || permissions == 1){
                                    row += "<tr>";
                                    row += '<th scope="row" class="text-center" width="10%" style="font-size:12px; vertical-align:middle;">' + data.clave + '</td>';
                                    row += '<td width="50%" style="font-size:12px; vertical-align:middle;">' + data.nombre.toUpperCase() + "</td>";
                                    row += '<td class="text-left" width="30%" style="font-size:12px; vertical-align:middle;">' + puesto.toUpperCase() + "</td>";
                                    row += '<td class="text-center" width="10%" style="font-size:18px;"><a href="javascript:verAcuse(\'' + direccion + '\', ' + '\'' + data.nombre + '\', ' + data.clave + ', ' + year + ', ' + '\'' + grupo + '\'' + ')"><i class="fa fa-file-pdf"></i></a></td>';
                                    // if(bandera == true){
                                    //     row += '<td class="text-center" width="10%" style="font-size:18px;"><a href="javascript:firmarAcuse(\'' + direccion + '\', ' + '\'' + data.nombre + '\', ' + data.clave + ', ' + year + ', ' + '\'' + grupo + '\'' + ')"><i class="fa fa-edit"></i></a></td>';
                                    // }else{
                                    //     row += '<td class="text-center" width="10%" style="font-size:18px;"><a href="javascript:noFirmarAcuse()"><i class="fa fa-edit"></i></a></td>';
                                    // }
                                    row += "</tr>";
                                }
                            // }
                        }
                    }else{
                        console.log(datosPersonal.response.length);
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
                }
            });
        }

        function noFirmarAcuse(){
            swal({
                type: 'error',
                text: 'Aun no puede firmar, espere autorizacion.',
                showConfirmButton: false,
                timer: 2000
            }).catch(swal.noop);
        }

        function verAcuse(direccion, nombre, clave, year, grupo){
            var url2 = '{{ \App\Traits\Principal::getUrlToken("/estimulos/evaluaciones/generarAcusePDF/direccion/nombre/clave/year/grupo") }}';
            var link1 = url2.replace('direccion', direccion);
            var link2 = link1.replace('clave', clave);
            var link3 = link2.replace('year', year);
            var link4 = link3.replace('grupo', grupo);
            var url = link4.replace('nombre', nombre);
            // console.log(link3);
            window.open(url);
        }

        function firmarAcuse(direccion, nombre, clave, year, grupo){
            var url = '{{ \App\Traits\Principal::getUrlToken("/estimulos/evaluaciones/firmarAcusePDF/direccion/nombre/clave/year/grupo") }}';
            var link1 = url.replace('clave', clave);
            var link2 = link1.replace('nombre', nombre);
            var link3 = link2.replace('grupo', grupo);
            var link4 = link3.replace('direccion', direccion);
            var firma = link4.replace('year', year);
            window.open(firma);
        }

        function downloadConcentrado(){
            var year = document.getElementById("year").value;
            var direccion = document.getElementById("direccion").value;
            var url = '{{ \App\Traits\Principal::getUrlToken("/estimulos/evaluaciones/concentrado/ExcelConcentrado/direccion/year") }}';
            var link1 = url.replace('direccion', direccion);
            var concentrado = link1.replace('year', year);
            window.open(concentrado);
        }
    </script>
@endsection
