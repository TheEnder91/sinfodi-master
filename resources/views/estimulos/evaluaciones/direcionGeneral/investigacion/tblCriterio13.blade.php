<div class="table-responsive" width = "100%">
    <table id="tblCriterio13" class="table table-bordered table-striped" style="font-size:13px;">
        <caption style="font-size:13px;">Autor Publicación de capítulos de investigación en libros científicos en editoriales de reconocido prestigio.</caption>
        <thead>
            <tr class="text-center">
                <th scope="col" style="font-size:13px;">Clave</th>
                <th scope="col" style="font-size:13px;">Nombre</th>
                <th scope="col" style="font-size:13px;">Puntos</th>
                <th scope="col" style="font-size:13px;">Total</th>
                <th scope="col" style="font-size:13px;">Año</th>
                {{-- @if (Auth::user()->hasPermissionTo("estimulo-evaluaciones-general-investigacion-index")) --}}
                    <th scope="col" style="font-size:13px;">Evidencias</th>
                {{-- @endif --}}
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
@include('estimulos.evaluaciones.direcionGeneral.investigacion.modalEvidenciasCriterio13')

<script>
    function obtenerCriterio13(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/investigacion/searchInvestigacion/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosCritero13){
                var datosCriterio13 = datosCritero13.response;
                // console.log(datosCritero13);
                // Codigo para guardar en el sistema...
                if(datosCriterio13.length > 0){
                    for(var i = 0; i < datosCriterio13.length; i++){
                        var dataCriterio13 = datosCriterio13[i];
                        // console.log(dataCriterio13);
                        $.ajax({
                            type: 'POST',
                            url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/DifDiv/saveDatosDifDiv",
                            data: {
                                token: $('#txtTokenRepo').val(),
                                clave: dataCriterio13.numero_personal,
                                nombre: dataCriterio13.nombre,
                                id_objetivo: 3,
                                id_criterio: 13,
                                direccion: "DGeneral",
                                puntos: 0,
                                total_puntos: 0,
                                year: year,
                                username: dataCriterio13.username,
                            },
                            headers: {
                                'token' : $('#txtTokenRepo').val() ? $('#txtTokenRepo').val(): ''
                            },
                            success: function(data){
                                verTablaCriterio13(year, criterio);
                            }
                        });
                    }
                }else{
                    verTablaCriterio13(year, criterio);
                }
            },
        });
    }

    function verTablaCriterio13(year, criterio){
        consultarDatos({
                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/investigacion/datosInvestigacion/" + year + "/" + criterio,
                    type: 'GET',
                    dataType: 'json',
                    ok: function(datosGeneralCriterio13){
                        // console.log(datosGeneralCriterio13);
                        var datosGeneralCriterio13 = datosGeneralCriterio13.response;
                        var row = "";
                        for(var i = 0; i < datosGeneralCriterio13.length; i++){
                            var dataGeneralCriterio13 = datosGeneralCriterio13[i];
                            // console.log(dataGeneralCriterio13);
                            var authUser = '<?= Auth::user()->usuario ?>';
                            var permissions = '<?= Auth::user()->hasPermissionTo("estimulo-evaluaciones-general-investigacion-index") ?>';
                            // console.log(permissions);
                            if(dataGeneralCriterio13.username == authUser || permissions == 1){
                                row += "<tr>";
                                row += '<th scope="row" class="text-center" width="10%" style="font-size:12px;">' + dataGeneralCriterio13.clave + '</td>';
                                row += '<td width="40%" style="font-size:12px;">' + dataGeneralCriterio13.nombre.toUpperCase() + "</td>";
                                row += '<td class="text-center" width="10%" style="font-size:12px;">' + parseInt(dataGeneralCriterio13.puntos) + '</td>';
                                row += '<td class="text-center" width="10%" style="font-size:12px;">' + parseInt(dataGeneralCriterio13.total_puntos) + '</td>';
                                row += '<td class="text-center" width="10%" style="font-size:12px;">' + dataGeneralCriterio13.year + '</td>';
                                // if(permissions == 1){
                                    row += '<td class="text-center" width="10%" style="font-size:12px;"><a href="javascript:verEvidenciasCriterio13(' + dataGeneralCriterio13.year + ', ' + dataGeneralCriterio13.clave + ', ' + 13 +')"><i class="fa fa-edit"></i></a></td>';
                                // }
                                row += "</tr>";
                            }
                        }
                        if ($.fn.dataTable.isDataTable("#tblCriterio13")) {
                            tblDifusionDivulgacion = $("#tblCriterio13").DataTable();
                            tblDifusionDivulgacion.destroy();
                        }
                        $('#tblCriterio13 > tbody').html('');
                        $('#tblCriterio13 > tbody').append(row);
                        $('#tblCriterio13').DataTable({
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

    function verEvidenciasCriterio13(year, clave, criterio){
        // console.log(year+" -> "+clave+" -> "+criterio);
        var objetivo = 3;
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/investigacion/searchEvidenciasInvestigacion/" + year + "/" + clave + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(dataEvidenciasCriterio13){
                // console.log(dataEvidenciasCriterio13); //Comentamos para futuras pruebas...
                $('#modalEvidenciasCriterio13').modal({backdrop: 'static', keyboard: false});
                consultarDatos({
                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/investigacion/puntosinvestigacion/" + criterio + "/" + objetivo,
                    type: 'GET',
                    dataType: 'json',
                    ok: function(puntosCriterio13){
                        puntos = puntosCriterio13.response[0].puntos;
                        // console.log(puntos); // Comentamos para futuras pruebas...
                        $('#txtValorCriterio13').val(puntos);
                        var datos = dataEvidenciasCriterio13.response;
                        var row = "";
                        $('#claveCriterio13').val(clave);
                        $('#txtYearCriterio13').val(year);
                        // console.log(datos);
                        for(var i = 0; i < datos.length; i++){
                            var claveData = datos[i];
                            // console.log(claveData.clave);
                            row += '<div class="col-12 col-md-2 text-center">';
                            row += '<a href="http://126.107.2.56/SINFODI/Files/SINFODI-Articulos/' + claveData.clave + '.pdf" target="_blank">';
                            row += '<img src="{{ asset('img/pdf2.png') }}" width="60px" height="60px">';
                            row += '</a><br>';
                            row += '<b><input type="checkbox" class="evidenciasCriterio13" name="evidenciasCriterio13[]" id="evidenciasCriterio13'+claveData.clave+'" value="'+claveData.clave+'" onClick="contarEvidenciasCriterio13('+puntos+');"> ' + claveData.clave + '</b>';
                            row += '</div>';
                        }
                        $("#contenedorCriterio13").html(row).fadeIn('slow');
                        consultarDatos({
                            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/investigacion/getEvidenciasInvestigacion/" + clave + "/" + year + "/" + criterio,
                            type: 'GET',
                            dataType: 'json',
                            ok: function(getEvidenciasCriterio13){
                                var array = getEvidenciasCriterio13.response;
                                if(array.length > 0){
                                    var evidencias = [];
                                    var serieEvidencias = "";
                                    $('input.evidenciasCriterio13:checked').each(function(){
                                        evidencias.push(this.value);
                                    });
                                    let desmarcar = serieEvidencias.split(',');
                                    if(desmarcar != ""){
                                        for(var i = 0; i < desmarcar.length; i++){
                                            // console.log(desmarcar[i]);
                                            document.getElementById("evidenciasCriterio13"+desmarcar[i]).checked = false;
                                        }
                                    }
                                    $(".evidenciasCriterio13").prop("checked", this.checked);
                                    var dataEvidencias = getEvidenciasCriterio13.response[0];
                                    let str = dataEvidencias.evidencias;
                                    let arr = str.split(',');
                                    //dividir la cadena de texto por una coma
                                    // console.log(arr);
                                    for(var i = 0; i < arr.length; i++){
                                        // console.log(arr[i]);
                                        document.getElementById("evidenciasCriterio13"+arr[i]).checked = true;
                                    }
                                    $('#txtCantidad').val(dataEvidencias.puntos);
                                    $('#txtTotal').val(dataEvidencias.total_puntos);
                                }
                            },
                        });
                    },
                });
            },
        });
    }

    function contarEvidenciasCriterio13(puntos){
        // Parte para contar la cantidad de evidencias a la que pertenece...
        var evidencias = [];
        $('input.evidenciasCriterio13:checked').each(function(){
            evidencias.push(this.value);
        });
        var cantidad = evidencias.length;
        $('#txtCantidadCriterio13').val(cantidad);
        //Parte para sacar el total de puntos dependiendo de los evidencias a los que pertenece...
        // console.log(puntos);
        var totalPuntos = cantidad * puntos;
        $('#txtTotalCriterio13').val(totalPuntos);
    }

    function actualizarEvidenciasCriterio13(){
        var clave = $('#claveCriterio13').val();
        var year = $('#txtYearCriterio13').val();
        var cantidad = $('#txtCantidadCriterio13').val();
        var total = $('#txtTotalCriterio13').val();
        var evidenciasCriterio13 = [];
        var puntos = 0;
        var criterio = 13;
        var objetivo = 3;
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/investigacion/obtenerEvidenciasInvestigacion/" + clave + "/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(searchEvidenciasCriterio13){
                var existe = searchEvidenciasCriterio13.response;
                // console.log(existe);
                consultarDatos({
                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/investigacion/puntosinvestigacion/" + criterio + "/" + objetivo,
                    type: 'GET',
                    dataType: 'json',
                    ok: function(puntosCriterio13){
                        puntos = puntosCriterio13.response[0].puntos;
                        // console.log(puntos); // Comentamos para futuras pruebas...
                        var evidencias = [];
                        var serieEvidencias = "";
                        $('input.evidenciasCriterio13:checked').each(function(){
                            evidencias.push(this.value);
                        });
                        for(var i = 0; i < evidencias.length; i++){
                            var serieEvidencias = evidencias.join(',');
                        }
                        // console.log(serieEvidencias);
                        var cantidadEvidencias = $('#txtCantidadCriterio13').val();
                        // console.log(cantidadEvidencias);
                        if(cantidadEvidencias == 0){
                            swal({
                                type: 'warning',
                                title: 'Favor de seleccionar las evidencias.',
                                showConfirmButton: false,
                                timer: 1800
                            }).catch(swal.noop);
                        }else{
                            if(existe == 0){
                                $.ajax({
                                    type: 'POST',
                                    url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/investigacion/savePuntos",
                                    data: {
                                        token: $('#txtTokenRepo').val(),
                                        clave: clave,
                                        evidencias: serieEvidencias,
                                        id_criterio: criterio,
                                        puntos: cantidadEvidencias,
                                        total_puntos: total,
                                        year: year
                                    },
                                    headers: {
                                        'token' : $('#txtTokenRepo').val() ? $('#txtTokenRepo').val(): ''
                                    },
                                    success: function(data){
                                        consultarDatos({
                                            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/investigacion/getEvidenciasInvestigacion/" + clave + "/" + year + "/" + criterio,
                                            type: 'GET',
                                            dataType: 'json',
                                            ok: function(getEvidenciasCriterio13){
                                                var getPuntos = getEvidenciasCriterio13.response[0];
                                                // console.log(getPuntos);
                                                $.ajax({
                                                    type: 'PUT',
                                                    url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/investigacion/updateDatosPuntos",
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
                                                        $('#modalEvidenciasCriterio13').modal('hide');
                                                        verTablaCriterio13(year, criterio);
                                                    }
                                                });
                                            },
                                        });
                                    }
                                });
                            }else{
                                $.ajax({
                                    type: 'PUT',
                                    url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/investigacion/updateDatos",
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
                                            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/investigacion/getEvidenciasInvestigacion/" + clave + "/" + year + "/" + criterio,
                                            type: 'GET',
                                            dataType: 'json',
                                            ok: function(getEvidenciasCriterio13){
                                                var getPuntos = getEvidenciasCriterio13.response[0];
                                                // console.log(getPuntos);
                                                $.ajax({
                                                    type: 'PUT',
                                                    url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/investigacion/updateDatosPuntos",
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
                                                        $('#modalEvidenciasCriterio13').modal('hide');
                                                        verTablaCriterio13(year, criterio);
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
