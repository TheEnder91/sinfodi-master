@extends('layouts.app')

@section('title_page')
    <img src="{{ asset('img/estimulos.png') }}" width="70px" height="40px">Estimulos
@endsection

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ \App\Traits\Principal::getUrlToken('/') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Evaluacion a la dirección de administracion->Difusión y Divulgación</li>
    </ol>
@endsection

@section('content')
    @component('components.card')
        @slot('title_card', 'Evaluación a la dirección de administración->Difusión y Divulgación')
        <div class="row">
            <div class="col-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="year" style="font-size:13px;">Seleccione el año:</label>
                    </div>
                    <select class="custom-select" id="year" onChange="ShowSelected();" style="font-size:13px;">
                        @for ($i = date('Y'); $i >= 2021; $i--)
                            <option value="{{ $i - 1 }}">{{ $i - 1 }}</option>
                        @endfor
                    </select>
                </div>
            </div>
        </div><br>
        <div class="table-responsive">
            <table id="tblCriterio1" class="table table-bordered table-striped">
                <caption style="font-size:13px;">Listado de evaluación Dirección de administración->Difusión y Divulgación y sus respectivos puntos.</caption>
                <thead>
                    <tr class="text-center">
                        <th scope="col" style="font-size:13px;">Clave</th>
                        <th scope="col" style="font-size:13px;">Nombre</th>
                        <th scope="col" style="font-size:13px;">Puntos</th>
                        <th scope="col" style="font-size:13px;">Total</th>
                        <th scope="col" style="font-size:13px;">Año</th>
                        @if (Auth::user()->hasPermissionTo("estimulo-evaluaciones-administracion-difusiondivulgacion-index"))
                            <th scope="col" style="font-size:13px;">Evidencias</th>
                        @endif
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
        @include('estimulos.evaluaciones.direcionGeneral.difdiv.modalEvidenciasCriterio1')
    @endcomponent
@endsection

@section('scripts')
    <script>
        $(document).ready(initCriterio1);

        function initCriterio1(){
            obtenerCriterio1(0);
            verTablaCriterio1(0, 1);
            // $('#btnActualizarCriterio1').on('click', actualizarEvidenciasCriterio1);
        }

        function ShowSelected(){
            var year = document.getElementById("year").value;
            obtenerCriterio1(year);
            verTablaCriterio1(year, 1);
        }

        function obtenerCriterio1(year){
            if(year === 0){
                var año = document.getElementById("year").value;
            }else{
                var año = year;
            }
            // console.log(año);
            var criterio = 1;
            consultarDatos({
                action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionAdministracion/DifDiv/searchDifDIv/" + año,
                type: 'GET',
                dataType: 'json',
                ok: function(datosCritero1){
                    var datosCriterio1 = datosCritero1.response;
                    // console.log(datosCritero1);
                    // Codigo para guardar en el sistema...
                    for(var i = 0; i < datosCriterio1.length; i++){
                        var dataCriterio1 = datosCriterio1[i];
                        var options = {
                            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionAdministracion/DifDiv/saveDatosDifDiv",
                            json: {
                                clave: dataCriterio1.numero_personal,
                                nombre: dataCriterio1.nombre,
                                id_objetivo: 1,
                                id_criterio: criterio,
                                direccion: "DAdministracion",
                                puntos: 0,
                                total_puntos: 0,
                                year: año,
                                username: dataCriterio1.username,
                                _token: "{{ csrf_token() }}",
                            },
                            type: 'POST',
                            dateType: 'json',
                        };
                        // console.log(options); // e comenta para futuras pruebas...
                        guardarAutomatico(options);
                        // Finaliza codigo para guardar en el sistema...
                    }
                }
            });
        }

        function verTablaCriterio1(year, criterio){
            consultarDatos({
                action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionAdministracion/DifDiv/datosDifDiv/" + year + "/" + criterio,
                type: 'GET',
                dataType: 'json',
                ok: function(datosGeneralCriterio1){
                    // console.log(datosGeneralCriterio1);
                    var datosGeneralCriterio1 = datosGeneralCriterio1.response;
                    var row = "";
                    for(var i = 0; i < datosGeneralCriterio1.length; i++){
                       var dataGeneralCriterio1 = datosGeneralCriterio1[i];
                       // console.log(dataGeneralCriterio1);
                       var authUser = '<?= Auth::user()->usuario ?>';
                       var permissions = '<?= Auth::user()->hasPermissionTo("estimulo-evaluaciones-administracion-difusiondivulgacion-index") ?>';
                       // console.log(permissions);
                       if(dataGeneralCriterio1.username == authUser || permissions == 1){
                               row += "<tr>";
                               row += '<th style="font-size:12px;" scope="row" class="text-center" width="10%">' + dataGeneralCriterio1.clave + '</td>';
                               row += '<td style="font-size:12px;" width="40%">' + dataGeneralCriterio1.nombre + "</td>";
                               row += '<td style="font-size:12px;" class="text-center" width="10%">' + dataGeneralCriterio1.puntos + '</td>';
                               row += '<td style="font-size:12px;" class="text-center" width="10%">' + dataGeneralCriterio1.total_puntos + '</td>';
                               row += '<td style="font-size:12px;" class="text-center" width="10%">' + dataGeneralCriterio1.year + '</td>';
                               if(permissions == 1){
                                   row += '<td class="text-center" width="10%" style="font-size:12px;"><a href="javascript:verEvidenciasCriterio1(' + dataGeneralCriterio1.year + ', ' + dataGeneralCriterio1.clave + ')"><i class="fa fa-edit"></i></a></td>';
                               }
                               row += "</tr>";
                       }
                    }
                    if ($.fn.dataTable.isDataTable("#tblCriterio1")) {
                        tblDifusionDivulgacion = $("#tblCriterio1").DataTable();
                        tblDifusionDivulgacion.destroy();
                    }
                    $('#tblCriterio1 > tbody').html('');
                    $('#tblCriterio1 > tbody').append(row);
                    $('#tblCriterio1').DataTable({
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

        function verEvidenciasCriterio1(year, clave){
            $('#modalEvidenciasCriterio24').modal('show');
        }
    </script>
@endsection
