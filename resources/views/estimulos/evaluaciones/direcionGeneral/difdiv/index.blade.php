@extends('layouts.app')

@section('title_page')
    <img src="{{ asset('img/estimulos.png') }}" width="70px" height="40px">Estimulos
@endsection

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ \App\Traits\Principal::getUrlToken('/') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Evaluaciones a la dirección General</li>
    </ol>
@endsection

@section('content')
    @component('components.card')
        @slot('title_card', 'Evaluación a la dirección general->Difusión y Divulgación')
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
            <table id="tblCriterio1" class="table table-bordered table-striped">
                <thead>
                    <tr class="text-center">
                        <th scope="col">Clave</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Puntos</th>
                        <th scope="col">Total</th>
                        <th scope="col">Año</th>
                        <th scope="col">Evidencias</th>
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
        // console.log(año);
        var criterio = 1;
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/DifDiv/searchDifDIv/" + año,
            type: 'GET',
            dataType: 'json',
            ok: function(datosCritero1){
                var datosCriterio1 = datosCritero1.response;
                // console.log(datosCritero1);
                // Codigo para guardar en el sistema...
                for(var i = 0; i < datosCriterio1.length; i++){
                    var dataCriterio1 = datosCriterio1[i];
                    var options = {
                        action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/DifDiv/saveDatosDifDiv",
                        json: {
                            clave: dataCriterio1.numero_personal,
                            nombre: dataCriterio1.nombre,
                            id_objetivo: 1,
                            id_criterio: criterio,
                            direccion: "DGeneral",
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
                consultarDatos({
                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/DifDiv/datosDifDiv/" + año + "/" + criterio,
                    type: 'GET',
                    dataType: 'json',
                    ok: function(datosGeneralCriterio1){
                        // console.log(datosGeneralCriterio1);
                        var datosGeneralCriterio1 = datosGeneralCriterio1.response;
                        var row = "";
                        for(var i = 0; i < datosGeneralCriterio1.length; i++){
                            var dataGeneralCriterio1 = datosGeneralCriterio1[i];
                            // console.log(dataGeneralCriterio1);
                            // var authUser = '<?= Auth()->user()->usuario ?>';
                            // var permissions = '<?= Auth::user()->hasPermissionTo("estimulo-evaluaciones-general-difusiondivulgacion-index") ?>';
                            // console.log(permissions);
                            // if(dataGeneralCriterio1.username == authUser || permissions == 1){
                                    row += "<tr>";
                                    row += '<th scope="row" class="text-center" width="10%">' + dataGeneralCriterio1.clave + '</td>';
                                    row += '<td width="40%">' + dataGeneralCriterio1.nombre + "</td>";
                                    row += '<td class="text-center" width="10%">' + dataGeneralCriterio1.puntos + '</td>';
                                    row += '<td class="text-center" width="10%">' + dataGeneralCriterio1.total_puntos + '</td>';
                                    row += '<td class="text-center" width="10%">' + dataGeneralCriterio1.year + '</td>';
                                    row += '<td class="text-center" width="10%"><a href="javascript:verEvidenciasCriterio1(' + dataGeneralCriterio1.year + ', ' + dataGeneralCriterio1.clave + ')"><i class="fa fa-edit"></i></a></td>';
                                    row += "</tr>";
                            // }
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
            },
        });
    }

    function verEvidenciasCriterio1(year, clave){
        var criterio = 1;
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/DifDiv/searchEvidenciasDifDiv/" + year + "/" + clave,
            type: 'GET',
            dataType: 'json',
            ok: function(dataEvidenciasCriterio1){
                // console.log(dataEvidenciasCriterio1); //Comentamos para futuras pruebas...
                consultarDatos({
                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/DifDiv/getEvidenciasDifDiv/" + clave + "/" + year + "/" + criterio,
                    type: 'GET',
                    dataType: 'json',
                    ok: function(getEvidenciasCriterio1){
                        // console.log(year + "->" + clave + "->" + criterio);
                        for(var i = 0; i < getEvidenciasCriterio1.response.length; i++){
                            var seleccion = getEvidenciasCriterio1.response[i].clave_evidencia;
                            // console.log(getEvidenciasCriterio1.response[i]);
                            $('input[value="' + seleccion + '"]').prop('checked', true);
                        }
                    },
                });
                $('#modalEvidenciasCriterio1').modal('show');
                var datos = dataEvidenciasCriterio1;
                var row = "";
                $('#clave').val(clave);
                $('#year').val(year);
                for(var i = 0; i < datos.length; i++){
                    var claveData = datos[i];
                    // console.log(claveData.clave);
                    if(claveData.abreviatura == 'EAD'){
                        // console.log(claveData.clave);
                        row += '<div class="col-12 col-md-2 text-center">';
                        row += '<a href="http://126.107.2.56/SINFODI/Files/SINFODI-EventosAcademicos/' + claveData.clave + '.pdf" target="_blank">';
                        row += '<img src="{{ asset('img/pdf2.png') }}" width="60px" height="60px">';
                        row += '</a><br>';
                        row += '<b><input type="checkbox" class="evidenciasCriterio1" name="evidenciasCriterio1[]" id="evidenciasCriterio1'+claveData.clave+'" value="'+claveData.clave+'"> ' + claveData.clave + '</b>';
                        row += '</div>';
                    }else if(claveData.abreviatura == 'DIF'){
                        // console.log(claveData.clave);
                        row += '<div class="col-12 col-md-2 text-center">';
                        row += '<a href="http://126.107.2.56/SINFODI/Files/SINFODI-DivulgacionPromocion/' + claveData.clave + '.pdf" target="_blank">';
                        row += '<img src="{{ asset('img/pdf2.png') }}" width="60px" height="60px">';
                        row += '</a><br>';
                        row += '<b><input type="checkbox" class="evidenciasCriterio1" name="evidenciasCriterio1[]" id="evidenciasCriterio1'+claveData.clave+'" value="'+claveData.clave+'"> ' + claveData.clave + '</b>';
                        row += '</div>';
                    }
                }
                $("#contenedorCriterio1").html(row).fadeIn('slow');
            },
        });
    }

    function actualizarEvidenciasCriterio1(){
        var clave = $('#clave').val();
        var year = $('#year').val();
        var evidenciasCriterio1 = [];
        var puntos = 0;
        var criterio = 1;
        var objetivo = 1;
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/DifDiv/obtenerEvidenciasDifDiv/" + clave + "/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(searchEvidenciasCriterio1){
                var existe = searchEvidenciasCriterio1.response;
                // console.log(existe);
                // console.log(year);
                consultarDatos({
                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/DifDiv/puntosDifDiv/" + criterio + "/" + objetivo,
                    type: 'GET',
                    dataType: 'json',
                    ok: function(puntosCriterio1){
                        // console.log(puntosCriterio1.response[0].puntos); // Comentamos para futuras pruebas...
                        $('input.evidenciasCriterio1:checked').each(function(){
                            evidenciasCriterio1.push(this.value);
                            puntos = puntos + parseInt(puntosCriterio1.response[0].puntos);
                            // console.log(evidenciasCriterio1);
                        });
                        if(puntos == 0){
                            swal({
                                type: 'warning',
                                title: 'Favor de seleccionar las evidencias.',
                                showConfirmButton: false,
                                timer: 1800
                            }).catch(swal.noop);
                        }else if(puntos > 50){
                            swal({
                                type: 'error',
                                title: 'Solo puede seleccionar un maximo de 5.',
                                showConfirmButton: false,
                                timer: 1800
                            }).catch(swal.noop);
                        }else{
                            if(existe == 0){
                                for(var i = 0; i < evidenciasCriterio1.length; i++){
                                    var savePuntos = {
                                        action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/DifDiv/savePuntos",
                                        json: {
                                            clave: clave,
                                            clave_evidencia: evidenciasCriterio1[i],
                                            puntos: puntos / parseInt(puntosCriterio1.response[0].puntos),
                                            total_puntos: puntos,
                                            year: year,
                                            id_criterio: criterio,
                                            _token: "{{ csrf_token() }}",
                                        },
                                        type: 'POST',
                                        dateType: 'json',
                                    };
                                    // console.log(savePuntos);
                                    guardarAutomatico(savePuntos);
                                }
                                actualizarDatosGeneralCriterio1(clave, year, 1);
                                obtenerCriterio1(year);
                                $('#modalEvidenciasCriterio1').modal('hide');
                            }else{
                                deletePuntosEvidenciaCriterio1(clave, year, 1);
                                for(var i = 0; i < evidenciasCriterio1.length; i++){
                                    // console.log(evidenciasCriterio1[i]);
                                    var savePuntos = {
                                        action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/DifDiv/savePuntos",
                                        json: {
                                            clave: clave,
                                            clave_evidencia: evidenciasCriterio1[i],
                                            puntos: puntos / parseInt(puntosCriterio1.response[0].puntos),
                                            total_puntos: puntos,
                                            year: year,
                                            id_criterio: criterio,
                                            _token: "{{ csrf_token() }}",
                                        },
                                        type: 'POST',
                                        dateType: 'json',
                                    };
                                    // console.log(savePuntos);
                                    guardarAutomatico(savePuntos);
                                }
                                actualizarDatosGeneralCriterio1(clave, year, 1);
                                obtenerCriterio1(year);
                                $('#modalEvidenciasCriterio1').modal('hide');
                            }
                        }
                    },
                });
            },
        });
    }

    function actualizarDatosGeneralCriterio1(clave, year, criterio){
        // console.log(criterio);
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/DifDiv/updateDatosDifDiv/" + clave + "/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(data){
                console.log("Puntos actualizados");
            },
        });
    }

    function deletePuntosEvidenciaCriterio1(clave, year, criterio){
        var optionsDelete = {
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/DifDiv/deletePuntosDifDiv/" + clave + "/" + year + "/" + criterio,
            json: {
                _token: "{{ csrf_token() }}",
                _method: 'DELETE',
            },
            type: 'POST',
            dateType: 'json',
        };
        guardarAutomatico(optionsDelete);
    }
</script>
@endsection
