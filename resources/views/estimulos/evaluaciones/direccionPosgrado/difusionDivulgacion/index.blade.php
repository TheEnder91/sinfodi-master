@extends('layouts.app')

@section('title_page')
    <img src="{{ asset('img/estimulos.png') }}" width="70px" height="40px">Estimulos
@endsection

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ \App\Traits\Principal::getUrlToken('/') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Evaluacion a la dirección de posgrado->Difusión y Divulgación</li>
    </ol>
@endsection

@section('content')
    @component('components.card')
        @slot('title_card', 'Evaluación a la dirección de posgrado->Difusión y Divulgación')
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
                <caption style="font-size:13px;">Listado de evaluación Dirección de posgrado->Difusión y Divulgación y sus respectivos puntos.</caption>
                <thead>
                    <tr class="text-center">
                        <th scope="col" style="font-size:13px;">Clave</th>
                        <th scope="col" style="font-size:13px;">Nombre</th>
                        <th scope="col" style="font-size:13px;">Puntos</th>
                        <th scope="col" style="font-size:13px;">Total</th>
                        <th scope="col" style="font-size:13px;">Año</th>
                        @if (Auth::user()->hasPermissionTo("estimulo-evaluaciones-posgrado-difusiondivulgacion-index"))
                            <th scope="col" style="font-size:13px;">Evidencias</th>
                        @endif
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
        @include('estimulos.evaluaciones.direccionPosgrado.difusionDivulgacion.modalEvidenciasCriterio1')
    @endcomponent
@endsection

@section('scripts')
<script>
    $(document).ready(initCriterio1);

    function initCriterio1(){
        obtenerCriterio1(0);
        $('#btnActualizarCriterio1').on('click', actualizarEvidenciasCriterio1);
    }

    function ShowSelected(){
        var year = document.getElementById("year").value;
        obtenerCriterio1(year);
    }

    function obtenerCriterio1(year){
        if(year === 0){
            var año = document.getElementById("year").value;
        }else{
            var año = year;
        }
        var criterio = 1;
        // Codigo de prueba...
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/DifDiv/searchDifDIv/" + año,
            type: 'GET',
            dataType: 'json',
            ok: function(datosCritero1){
                var datosCriterio1 = datosCritero1.response;
                // console.log(datosCritero1);
                for(var i = 0; i < datosCriterio1.length; i++){
                    var dataCriterio1 = datosCriterio1[i];
                    // console.log(dataCriterio1);
                    $.ajax({
                        type: 'POST',
                        url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/DifDiv/saveDatosDifDiv",
                        data: {
                            token: $('#txtTokenRepo').val(),
                            clave: dataCriterio1.numero_personal,
                            nombre: dataCriterio1.nombre,
                            id_objetivo: 1,
                            id_criterio: criterio,
                            direccion: "DPosgrado",
                            puntos: 0,
                            total_puntos: 0,
                            year: año,
                            username: dataCriterio1.username
                        },
                        headers: {
                            'token' : $('#txtTokenRepo').val() ? $('#txtTokenRepo').val(): ''
                        },
                        success: function(data){
                            verTablaCriterio1(año, 1);
                        }
                    });
                }
            },
        });
        // Finaliza codigo de prueba...
    }

    function verTablaCriterio1(año, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/DifDiv/datosDifDiv/" + año + "/" + criterio,
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
                    var permissions = '<?= Auth::user()->hasPermissionTo("estimulo-evaluaciones-general-difusiondivulgacion-index") ?>';
                    // console.log(permissions);
                    if(dataGeneralCriterio1.username == authUser || permissions == 1){
                            row += "<tr>";
                            row += '<th style="font-size:12px;" scope="row" class="text-center" width="10%">' + dataGeneralCriterio1.clave + '</td>';
                            row += '<td style="font-size:12px;" width="40%">' + dataGeneralCriterio1.nombre.toUpperCase() + "</td>";
                            row += '<td style="font-size:12px;" class="text-center" width="10%">' + parseInt(dataGeneralCriterio1.puntos) + '</td>';
                            row += '<td style="font-size:12px;" class="text-center" width="10%">' + parseInt(dataGeneralCriterio1.total_puntos) + '</td>';
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
        var criterio = 1;
        var objetivo = 1;
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/DifDiv/searchEvidenciasDifDiv/" + year + "/" + clave,
            type: 'GET',
            dataType: 'json',
            ok: function(dataEvidenciasCriterio1){
                $('#modalEvidenciasCriterio1').modal({backdrop: 'static', keyboard: false});
                consultarDatos({
                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/DifDiv/puntosDifDiv/" + criterio + "/" + objetivo,
                    type: 'GET',
                    dataType: 'json',
                    ok: function(puntosCriterio1){
                        puntos = puntosCriterio1.response[0].puntos;
                        // console.log(puntos); // Comentamos para futuras pruebas...
                        $('#txtValor').val(puntos);
                        var datos = dataEvidenciasCriterio1;
                        var row = "";
                        $('#clave').val(clave);
                        $('#txtYear').val(year);
                        for(var i = 0; i < datos.length; i++){
                            var claveData = datos[i];
                            // console.log(claveData.clave);
                            if(claveData.abreviatura == 'EAD'){
                                // console.log(claveData.clave);
                                // console.log(puntos); // Comentamos para futuras pruebas...
                                row += '<div class="col-12 col-md-2 text-center">';
                                row += '<a href="http://126.107.2.56/SINFODI/Files/SINFODI-EventosAcademicos/' + claveData.clave + '.pdf" target="_blank">';
                                row += '<img src="{{ asset('img/pdf2.png') }}" width="60px" height="60px">';
                                row += '</a><br>';
                                row += '<b><input type="checkbox" class="evidenciasCriterio1" style="font-size:13px;" name="evidenciasCriterio1[]" id="evidenciasCriterio1'+claveData.clave+'" value="'+claveData.clave+'" onClick="contarEvidencias('+puntos+');"> ' + claveData.clave + '</b>';
                                row += '</div>';
                            }else if(claveData.abreviatura == 'DIF'){
                                // console.log(claveData.clave);
                                row += '<div class="col-12 col-md-2 text-center">';
                                row += '<a href="http://126.107.2.56/SINFODI/Files/SINFODI-DivulgacionPromocion/' + claveData.clave + '.pdf" target="_blank">';
                                row += '<img src="{{ asset('img/pdf2.png') }}" width="60px" height="60px">';
                                row += '</a><br>';
                                row += '<b><input type="checkbox" class="evidenciasCriterio1" style="font-size:13px;" name="evidenciasCriterio1[]" id="evidenciasCriterio1'+claveData.clave+'" value="'+claveData.clave+'" onClick="contarEvidencias('+puntos+');"> ' + claveData.clave + '</b>';
                                row += '</div>';
                            }
                        }
                        $("#contenedorCriterio1").html(row).fadeIn('slow');
                        consultarDatos({
                            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/DifDiv/getEvidenciasDifDiv/" + clave + "/" + year + "/" + criterio,
                            type: 'GET',
                            dataType: 'json',
                            ok: function(getEvidenciasCriterio1){
                                var evidencias = [];
                                var serieEvidencias = "";
                                $('input.evidenciasCriterio1:checked').each(function(){
                                    evidencias.push(this.value);
                                });
                                let desmarcar = serieEvidencias.split(',');
                                if(desmarcar != ""){
                                    for(var i = 0; i < desmarcar.length; i++){
                                        // console.log(desmarcar[i]);
                                        document.getElementById("evidenciasCriterio1"+desmarcar[i]).checked = false;
                                    }
                                }
                                $(".evidenciasCriterio1").prop("checked", this.checked);
                                var dataEvidencias = getEvidenciasCriterio1.response[0];
                                // console.log(getEvidenciasCriterio1.response[0]);
                                let str = dataEvidencias.evidencias;
                                let arr = str.split(',');
                                //dividir la cadena de texto por una coma
                                // console.log(arr);
                                for(var i = 0; i < arr.length; i++){
                                    // console.log(arr[i]);
                                    document.getElementById("evidenciasCriterio1"+arr[i]).checked = true;
                                }
                            },
                        });
                    },
                });
            },
        });
    }

    function contarEvidencias(puntos){
        // Parte para contar la cantidad de evidencias a la que pertenece...
        var evidencias = [];
        $('input.evidenciasCriterio1:checked').each(function(){
            evidencias.push(this.value);
        });
        var cantidad = evidencias.length;
        $('#txtCantidad').val(cantidad);
        //Parte para sacar el total de puntos dependiendo de los evidencias a los que pertenece...
        // console.log(puntos);
        var totalPuntos = cantidad * puntos;
        $('#txtTotal').val(totalPuntos);
    }

    function actualizarEvidenciasCriterio1(){
        var clave = $('#clave').val();
        var year = $('#txtYear').val();
        var cantidad = $('#txtCantidad').val();
        var total = $('#txtTotal').val();
        var evidenciasCriterio1 = [];
        var puntos = 0;
        var criterio = 1;
        var objetivo = 1;
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/DifDiv/obtenerEvidenciasDifDiv/" + clave + "/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(searchEvidenciasCriterio1){
                var existe = searchEvidenciasCriterio1.response;
                // console.log(existe);
                // console.log(year);
                consultarDatos({
                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/DifDiv/puntosDifDiv/" + criterio + "/" + objetivo,
                    type: 'GET',
                    dataType: 'json',
                    ok: function(puntosCriterio1){
                        puntos = puntosCriterio1.response[0].puntos;
                        // console.log(puntos); // Comentamos para futuras pruebas...
                        var evidencias = [];
                        var serieEvidencias = "";
                        $('input.evidenciasCriterio1:checked').each(function(){
                            evidencias.push(this.value);
                        });
                        for(var i = 0; i < evidencias.length; i++){
                            var serieEvidencias = evidencias.join(',');
                        }
                        // console.log(serieEvidencias);
                        var cantidadEvidencias = $('#txtCantidad').val();
                        // console.log(cantidadEvidencias);
                        if(cantidadEvidencias == 0){
                            swal({
                                type: 'warning',
                                title: 'Favor de seleccionar las evidencias.',
                                showConfirmButton: false,
                                timer: 1800
                            }).catch(swal.noop);
                        }else if(cantidadEvidencias > 5){
                            swal({
                                type: 'error',
                                title: 'Solo puede seleccionar un maximo de 5.',
                                showConfirmButton: false,
                                timer: 1800
                            }).catch(swal.noop);
                        }else{
                            if(existe == 0){
                                $.ajax({
                                    type: 'POST',
                                    url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/DifDiv/savePuntos",
                                    data: {
                                        token: $('#txtTokenRepo').val(),
                                        clave: clave,
                                        evidencias: serieEvidencias,
                                        id_criterio: criterio,
                                        puntos: cantidad,
                                        total_puntos: total,
                                        year: year
                                    },
                                    headers: {
                                        'token' : $('#txtTokenRepo').val() ? $('#txtTokenRepo').val(): ''
                                    },
                                    success: function(data){
                                        consultarDatos({
                                            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/DifDiv/getEvidenciasDifDiv/" + clave + "/" + year + "/" + criterio,
                                            type: 'GET',
                                            dataType: 'json',
                                            ok: function(getEvidenciasCriterio1){
                                                var getPuntos = getEvidenciasCriterio1.response[0];
                                                // console.log(getPuntos);
                                                $.ajax({
                                                    type: 'PUT',
                                                    url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/DifDiv/updateDatosPuntos",
                                                    data: {
                                                        token: $('#txtTokenRepo').val(),
                                                        clave: clave,
                                                        id_criterio: criterio,
                                                        puntos: getPuntos.puntos,
                                                        total_puntos: getPuntos.total_puntos,
                                                        year: year
                                                    },
                                                    headers: {
                                                        'token' : $('#txtTokenRepo').val() ? $('#txtTokenRepo').val(): ''
                                                    },
                                                    success: function(data){
                                                        swal({
                                                            type: 'success',
                                                            text: 'Se han actualizado los puntos con exito',
                                                            showConfirmButton: false,
                                                            timer: 2000
                                                        }).catch(swal.noop);
                                                        $('#modalEvidenciasCriterio1').modal('hide');
                                                        verTablaCriterio1(year, 1);
                                                    }
                                                });
                                            },
                                        });
                                    }
                                });
                            }else{
                                $.ajax({
                                    type: 'PUT',
                                    url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/DifDiv/updateDatosDifDiv",
                                    data: {
                                        token: $('#txtTokenRepo').val(),
                                        clave: clave,
                                        evidencias: serieEvidencias,
                                        id_criterio: criterio,
                                        puntos: cantidad,
                                        total_puntos: total,
                                        year: year,
                                        id_criterio: criterio
                                    },
                                    headers: {
                                        'token' : $('#txtTokenRepo').val() ? $('#txtTokenRepo').val(): ''
                                    },
                                    success: function(data){
                                        consultarDatos({
                                            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/DifDiv/getEvidenciasDifDiv/" + clave + "/" + year + "/" + criterio,
                                            type: 'GET',
                                            dataType: 'json',
                                            ok: function(getEvidenciasCriterio1){
                                                var getPuntos = getEvidenciasCriterio1.response[0];
                                                // console.log(getPuntos);
                                                $.ajax({
                                                    type: 'PUT',
                                                    url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/DifDiv/updateDatosPuntos",
                                                    data: {
                                                        token: $('#txtTokenRepo').val(),
                                                        clave: clave,
                                                        id_criterio: criterio,
                                                        puntos: getPuntos.puntos,
                                                        total_puntos: getPuntos.total_puntos,
                                                        year: year
                                                    },
                                                    headers: {
                                                        'token' : $('#txtTokenRepo').val() ? $('#txtTokenRepo').val(): ''
                                                    },
                                                    success: function(data){
                                                        swal({
                                                            type: 'success',
                                                            text: 'Se han actualizado los puntos con exito',
                                                            showConfirmButton: false,
                                                            timer: 2000
                                                        }).catch(swal.noop);
                                                        $('#modalEvidenciasCriterio1').modal('hide');
                                                        verTablaCriterio1(year, 1);
                                                    }
                                                });
                                            },
                                        });
                                    }
                                });
                            }
                        }
                    },
                });
            },
        });
    }
</script>
@endsection
