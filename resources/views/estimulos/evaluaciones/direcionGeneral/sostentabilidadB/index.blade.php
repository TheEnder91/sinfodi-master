@extends('layouts.app')

@section('title_page')
    <img src="{{ asset('img/estimulos.png') }}" width="70px" height="40px">Estimulos
@endsection

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ \App\Traits\Principal::getUrlToken('/') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Evaluaciones a la dirección de general->Sostenibilidad economica B</li>
    </ol>
@endsection

@section('content')
    @component('components.card')
        @slot('title_card', 'Evaluaciones a la dirección de general->Sostenibilidad economica B.')
        <div class="row">
            <div class="col-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="year" style="font-size:13px;">Seleccione el año a evaluar:</label>
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
            <table id="tblCriterio37" class="table table-bordered table-striped" style="font-size:13px;">
                <caption style="font-size:13px;">Proyecto comercializados con remanente planeado o superior.</caption>
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
            // console.log(año);
            var id_objetivo = 4;
            var criterio = 37;
            consultarDatos({
                action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/sostenibilidadB/searchSostenibilidadB/" + año,
                type: 'GET',
                dataType: 'json',
                ok: function(datosCritero37){
                    var datosCriterio37 = datosCritero37.response;
                    // console.log(datosCritero37);
                    // Codigo para guardar en el sistema...
                    if(datosCriterio37.length > 0){
                        // console.log(datosCriterio37);
                        let arr2 = [];
                        datosCriterio37.forEach((x)=>{
                            if(x['remanente'] == 'Si'){
                                if(arr2.some((val)=>{ return val['clave_participante'] == x['clave_participante']})){
                                    arr2.forEach((k)=>{
                                        if(k['clave_participante'] === x['clave_participante']){
                                            k['nombre_participante'] = x['nombre_participante']
                                            k['usuario_participante'] = x['usuario_participante']
                                            k['year'] = x['year']
                                            k["occurrence"]++;
                                        }
                                    });
                                }else{
                                    let a = {}
                                    a['clave_participante'] = x['clave_participante']
                                    a['nombre_participante'] = x['nombre_participante']
                                    a['usuario_participante'] = x['usuario_participante']
                                    a['year'] = x['year']
                                    a["occurrence"] = 1;
                                    arr2.push(a);
                                }
                            }
                        });
                        // console.log(arr2);
                        consultarDatos({
                            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/sostenibilidadB/puntos/" + criterio + "/" + id_objetivo,
                            type: 'GET',
                            dataType: 'json',
                            ok: function(puntosCriterio37){
                                var puntos = puntosCriterio37.response;
                                // console.log(puntos[0].puntos);
                                for(var i = 0; i < arr2.length; i++){
                                    var dataCriterio37 = arr2[i];
                                    var puntosTotales = dataCriterio37.occurrence * puntos[0].puntos;
                                    // console.log(dataCriterio37);
                                    $.ajax({
                                        type: 'POST',
                                        url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/sostenibilidadB/saveDatos",
                                        data: {
                                            token: $('#txtTokenRepo').val(),
                                            clave: dataCriterio37.clave_participante,
                                            nombre: dataCriterio37.nombre_participante,
                                            id_objetivo: id_objetivo,
                                            id_criterio: criterio,
                                            direccion: "DGeneral",
                                            puntos: dataCriterio37.occurrence,
                                            total_puntos: puntosTotales,
                                            year: año,
                                            username: dataCriterio37.usuario_participante
                                        },
                                        headers: {
                                            'token' : $('#txtTokenRepo').val() ? $('#txtTokenRepo').val(): ''
                                        },
                                        success: function(data){
                                            verTablaCriterio37(año, criterio);
                                        }
                                    });
                                }
                            },
                        });
                    }else{
                        verTablaCriterio37(año, criterio);
                    }
                },
            });
        }

        function verTablaCriterio37(year, criterio){
            consultarDatos({
                action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/sostenibilidadB/datosSostenibilidadB/" + year + "/" + criterio,
                type: 'GET',
                dataType: 'json',
                ok: function(datosGeneralCriterio37){
                    var datosGeneralCriterio37 = datosGeneralCriterio37.response;
                    // console.log(datosGeneralCriterio37);
                    var row = "";
                    for(var i = 0; i < datosGeneralCriterio37.length; i++){
                        var dataGeneralCriterio37 = datosGeneralCriterio37[i];
                        // console.log(dataGeneralCriterio37);
                        var authUser = '<?= Auth::user()->usuario ?>';
                        var permissions = '<?= Auth::user()->hasPermissionTo("estimulo-evaluaciones-general-sostentabilidadB-index") ?>';
                        // console.log(permissions);
                        if(dataGeneralCriterio37.username == authUser || permissions == 1){
                                row += "<tr>";
                                row += '<th style="font-size:12px;" scope="row" class="text-center" width="10%">' + dataGeneralCriterio37.clave + '</td>';
                                row += '<td style="font-size:12px;" width="60%">' + dataGeneralCriterio37.nombre.toUpperCase() + "</td>";
                                row += '<td style="font-size:12px;" class="text-center" width="10%">' + parseInt(dataGeneralCriterio37.puntos) + '</td>';
                                row += '<td style="font-size:12px;" class="text-center" width="10%">' + parseInt(dataGeneralCriterio37.total_puntos) + '</td>';
                                row += '<td style="font-size:12px;" class="text-center" width="10%">' + dataGeneralCriterio37.year + '</td>';
                                row += "</tr>";
                        }
                    }
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
                },
            });
        }
    </script>
@endsection
