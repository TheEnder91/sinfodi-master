<div class="table-responsive" width = "100%" id="table_refresh">
    <table id="tblCriterio33" class="table table-bordered table-striped" style="font-size:13px;">
        <caption style="font-size:13px;">Pruebas de desempeño (Valor del punto: 1).</caption>
        <thead>
            <tr class="text-center">
                <th scope="col" style="font-size:13px;">Clave</th>
                <th scope="col" style="font-size:13px;">Nombre</th>
                <th scope="col" style="font-size:13px;">Puntos</th>
                <th scope="col" style="font-size:13px;">Total</th>
                <th scope="col" style="font-size:13px;">Año</th>
                {{-- @if (Auth::user()->hasPermissionTo("estimulo-evaluaciones-servicios-acreditaciones-index")) --}}
                    <th scope="col" style="font-size:13px;">Evidencias</th>
                {{-- @endif --}}
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
@include('estimulos.evaluaciones.direccionServTec.acreditaciones.modalEvidenciasCriterio33')
<script>
    function obtenerCriterio33(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/acreditaciones/searchAcreditaciones/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosCritero33 ){
                var datosCriterio33 = datosCritero33.response;
                // Codigo para guardar en el sistema...
                if(datosCriterio33.length > 0){
                    // console.log(datosCritero33);
                    for(var i = 0; i < datosCriterio33.length; i++){
                        var dataCriterio33 = datosCriterio33[i];
                        // console.log(dataCriterio33);
                        consultarDatos({
                            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/posgrado/searchUsernamePosgrado/" + dataCriterio33.numeroPersonal,
                            type: 'GET',
                            dataType: 'json',
                            ok: function(datosCritero33Username){
                                var username = datosCritero33Username.response[0];
                                verTablaCriterio33(year, criterio);
                                // console.log(username.clave + '->' + username.nombre + '->' + username.usuario);
                                // $.ajax({
                                //     type: 'POST',
                                //     url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/acreditaciones/saveDatosAcreditaciones",
                                //     data: {
                                //         token: $('#txtTokenRepo').val(),
                                //         clave: username.clave,
                                //         nombre: username.nombre,
                                //         id_objetivo: 8,
                                //         id_criterio: criterio,
                                //         direccion: "DServTec",
                                //         puntos: 0,
                                //         total_puntos: 0,
                                //         year: year,
                                //         username: username.usuario
                                //     },
                                //     headers: {
                                //         'token' : $('#txtTokenRepo').val() ? $('#txtTokenRepo').val(): ''
                                //     },
                                //     success: function(data){
                                //         verTablaCriterio33(year, criterio);
                                //         // console.log('OK');
                                //     }
                                // });
                            },
                        });
                    }
                }else{
                    verTablaCriterio33(year, criterio);
                }
            },
        });
    }

    function verTablaCriterio33(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/acreditaciones/datosAcreditaciones/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosGeneralCriterio33){
                // console.log(datosGeneralCriterio33);
                var datosGeneralCriterio33 = datosGeneralCriterio33.response;
                var row = "";
                for(var i = 0; i < datosGeneralCriterio33.length; i++){
                    var dataGeneralCriterio33 = datosGeneralCriterio33[i];
                    // console.log(dataGeneralCriterio33);
                    var authUser = '<?= Auth::user()->usuario ?>';
                    var permissions = '<?= Auth::user()->hasPermissionTo("estimulo-evaluaciones-servicios-acreditaciones-index") ?>';
                    // console.log(permissions);
                    if(dataGeneralCriterio33.username == authUser || permissions == 1){
                        row += "<tr>";
                        row += '<th scope="row" class="text-center" width="10%" style="font-size:12px;">' + dataGeneralCriterio33.clave + '</td>';
                        row += '<td width="40%" style="font-size:12px;">' + dataGeneralCriterio33.nombre.toUpperCase() + "</td>";
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + parseInt(dataGeneralCriterio33.puntos) + '</td>';
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + parseInt(dataGeneralCriterio33.total_puntos) + '</td>';
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + dataGeneralCriterio33.year + '</td>';
                        // if(permissions == 1){
                            row += '<td class="text-center" width="10%" style="font-size:12px;"><a href="javascript:verEvidenciasCriterio33(' + dataGeneralCriterio33.year + ', ' + dataGeneralCriterio33.clave + ', ' + 33 +')"><i class="fa fa-edit"></i></a></td>';
                        // }
                        row += "</tr>";
                    }
                }
                if ($.fn.dataTable.isDataTable("#tblCriterio33")) {
                    tblDifusionDivulgacion = $("#tblCriterio33").DataTable();
                    tblDifusionDivulgacion.destroy();
                }
                $('#tblCriterio33 > tbody').html('');
                $('#tblCriterio33 > tbody').append(row);
                $('#tblCriterio33').DataTable({
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

    function verEvidenciasCriterio33(year, clave){
        var criterio = 33;
        var objetivo = 8;
        $('#txtCantidadCriterio33').val(0);
        $('#txtTotalCriterio33').val(0);
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/acreditaciones/searchEvidencias/" + year + "/" + clave + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(dataEvidenciasCriterio33){
                console.log(dataEvidenciasCriterio33);
                $('#modalEvidenciasCriterio33').modal({backdrop: 'static', keyboard: false});
                consultarDatos({
                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/acreditaciones/puntos/" + criterio + "/" + objetivo,
                    type: 'GET',
                    dataType: 'json',
                    ok: function(puntosCriterio33){
                        puntos = puntosCriterio33.response[0].puntos;
                        // console.log(puntos); // Comentamos para futuras pruebas...
                        $('#txtValorCriterio33').val(puntos);
                        var row = "";
                        $('#claveCriterio33').val(clave);
                        $('#txtYearCriterio33').val(year);
                        var datos = dataEvidenciasCriterio33.response;
                        for(var i = 0; i < datos.length; i++){
                            // console.log(datos[i]);
                            var nombreData = datos[i];
                            var extension = nombreData.archivo.split(".");
                            extension = extension[1];
                            // console.log(extension);
                            if(extension == 'xlsx'){
                                row += '<div class="col-12 col-md-2 text-center">';
                                row += '<a href="http://126.107.2.56/SINFODI/servicios-tecnologicos/public/storage/' + nombreData.archivo + '" target="_blank">';
                                row += '<img src="{{ asset('img/excel.png') }}" width="70px" height="60px">';
                                row += '</a><br>';
                                row += '<b><input type="checkbox" class="evidenciasCriterio33" style="font-size:13px;" name="evidenciasCriterio33[]" id="evidenciasCriterio33'+nombreData.nombre+'" value="'+nombreData.nombre+'" onClick="contarEvidenciasCriterio33('+puntos+');"> ' + nombreData.nombre + '</b>';
                                row += '</div>';
                            }else if(extension == 'docx'){
                                row += '<div class="col-12 col-md-2 text-center">';
                                row += '<a href="http://126.107.2.56/SINFODI/servicios-tecnologicos/public/storage/' + nombreData.archivo + '" target="_blank">';
                                row += '<img src="{{ asset('img/word.png') }}" width="60px" height="60px">';
                                row += '</a><br>';
                                row += '<b><input type="checkbox" class="evidenciasCriterio33" style="font-size:13px;" name="evidenciasCriterio33[]" id="evidenciasCriterio33'+nombreData.nombre+'" value="'+nombreData.nombre+'" onClick="contarEvidenciasCriterio33('+puntos+');"> ' + nombreData.nombre + '</b>';
                                row += '</div>';
                            }else if(extension == 'pdf'){
                                row += '<div class="col-12 col-md-2 text-center">';
                                row += '<a href="http://126.107.2.56/SINFODI/servicios-tecnologicos/public/storage/' + nombreData.archivo + '" target="_blank">';
                                row += '<img src="{{ asset('img/pdf2.png') }}" width="60px" height="60px">';
                                row += '</a><br>';
                                row += '<b><input type="checkbox" class="evidenciasCriterio33" style="font-size:13px;" name="evidenciasCriterio33[]" id="evidenciasCriterio33'+nombreData.nombre+'" value="'+nombreData.nombre+'" onClick="contarEvidenciasCriterio33('+puntos+');"> ' + nombreData.nombre + '</b>';
                                row += '</div>';
                            }
                        }
                        $("#contenedorCriterio33").html(row).fadeIn('slow');
                        consultarDatos({
                            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/acreditaciones/getEvidenciasAcreditaciones/"+clave+"/"+year+"/"+criterio,
                            type: 'GET',
                            dataType: 'json',
                            ok: function(getEvidenciasCriterio33){
                                // console.log(getEvidenciasCriterio33.response);
                                var array = getEvidenciasCriterio33.response;
                                if(array.length > 0){
                                    var evidencias = [];
                                    var serieEvidencias = "";
                                    $('input.evidenciasCriterio33:checked').each(function(){
                                        evidencias.push(this.value);
                                    });
                                    let desmarcar = serieEvidencias.split(',');
                                    if(desmarcar != ""){
                                        for(var i = 0; i < desmarcar.length; i++){
                                            // console.log(desmarcar[i]);
                                            document.getElementById("evidenciasCriterio33"+desmarcar[i]).checked = false;
                                        }
                                    }
                                    $(".evidenciasCriterio33").prop("checked", this.checked);
                                    var dataEvidencias = getEvidenciasCriterio33.response[0];
                                    let str = dataEvidencias.evidencias;
                                    let arr = str.split(',');
                                    //dividir la cadena de texto por una coma
                                    // console.log(arr);
                                    for(var i = 0; i < arr.length; i++){
                                        // console.log(arr[i]);
                                        document.getElementById("evidenciasCriterio33"+arr[i]).checked = true;
                                    }
                                }
                            },
                        });
                    },
                });
            },
        });
    }

    function contarEvidenciasCriterio33(puntos){
        // Parte para contar la cantidad de evidencias a la que pertenece...
        var evidencias = [];
        $('input.evidenciasCriterio33:checked').each(function(){
            evidencias.push(this.value);
        });
        var cantidad = evidencias.length;
        $('#txtCantidadCriterio33').val(cantidad);
        //Parte para sacar el total de puntos dependiendo de los evidencias a los que pertenece...
        // console.log(puntos);
        var totalPuntos = cantidad * puntos;
        $('#txtTotalCriterio33').val(totalPuntos);
    }

    function actualizarEvidenciasCriterio33(){
        var clave = $('#claveCriterio33').val();
        var year = $('#txtYearCriterio33').val();
        var cantidad = $('#txtCantidadCriterio33').val();
        var total = $('#txtTotalCriterio33').val();
        var evidenciasCriterio33 = [];
        var puntos = 0;
        var criterio = 33;
        var objetivo = 8;
        // Consulta para saber si existe algun registro ya guardado...
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/acreditaciones/obtenerEvidencias/" + clave + "/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(searchEvidenciasCriterio33){
                var existe = searchEvidenciasCriterio33.response;
                // console.log(existe);
                // Consulta para obtener el valor del punto del criterio...
                consultarDatos({
                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/acreditaciones/puntos/" + criterio + "/" + objetivo,
                    type: 'GET',
                    dataType: 'json',
                    ok: function(puntosCriterio33){
                        puntos = puntosCriterio33.response[0].puntos;
                        // console.log(puntos); // Comentamos para futuras pruebas...
                        var evidencias = [];
                        var serieEvidencias = "";
                        $('input.evidenciasCriterio33:checked').each(function(){
                            evidencias.push(this.value);
                        });
                        for(var i = 0; i < evidencias.length; i++){
                            var serieEvidencias = evidencias.join(',');
                        }
                        // console.log(serieEvidencias);
                        var cantidadEvidencias = $('#txtCantidadCriterio33').val();
                        // console.log(cantidadEvidencias);
                        if(cantidadEvidencias == 0){
                            swal({
                                type: 'warning',
                                title: 'Favor de seleccionar las evidencias.',
                                showConfirmButton: false,
                                timer: 1800
                            }).catch(swal.noop);
                        }else if(cantidadEvidencias > 40){
                            swal({
                                type: 'error',
                                title: 'Solo puede seleccionar un maximo de 40.',
                                showConfirmButton: false,
                                timer: 1800
                            }).catch(swal.noop);
                        }else{
                            if(existe == 0){
                                $.ajax({
                                    type: 'POST',
                                    url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/acreditaciones/savePuntos",
                                    data: {
                                        token: $('#txtTokenRepo').val(),
                                        clave: clave,
                                        evidencias: serieEvidencias,
                                        id_criterio: criterio,
                                        puntos: cantidad,
                                        total_puntos: total,
                                        id_criterio: criterio,
                                        year: year
                                    },
                                    headers: {
                                        'token' : $('#txtTokenRepo').val() ? $('#txtTokenRepo').val(): ''
                                    },
                                    success: function(data){
                                        consultarDatos({
                                            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/acreditaciones/getEvidenciasAcreditaciones/" + clave + "/" + year + "/" + criterio,
                                            type: 'GET',
                                            dataType: 'json',
                                            ok: function(getEvidenciasCriterio33){
                                                var getPuntos = getEvidenciasCriterio33.response[0];
                                                // console.log(getPuntos);
                                                $.ajax({
                                                    type: 'PUT',
                                                    url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/acreditaciones/updateDatosPuntos",
                                                    data: {
                                                        token: $('#txtTokenRepo').val(),
                                                        clave: clave,
                                                        id_criterio: criterio,
                                                        puntos: getPuntos.puntos,
                                                        total_puntos: getPuntos.total_puntos,
                                                        id_criterio: criterio,
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
                                                        $('#modalEvidenciasCriterio33').modal('hide');
                                                        verTablaCriterio33(year, 33);
                                                    }
                                                });
                                            },
                                        });
                                    }
                                });
                            }else{
                                $.ajax({
                                    type: 'PUT',
                                    url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/acreditaciones/updateDatos",
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
                                            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/acreditaciones/getEvidenciasAcreditaciones/" + clave + "/" + year + "/" + criterio,
                                            type: 'GET',
                                            dataType: 'json',
                                            ok: function(getEvidenciasCriterio33){
                                                var getPuntos = getEvidenciasCriterio33.response[0];
                                                // console.log(getPuntos);
                                                $.ajax({
                                                    type: 'PUT',
                                                    url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/acreditaciones/updateDatosPuntos",
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
                                                        $('#modalEvidenciasCriterio33').modal('hide');
                                                        verTablaCriterio33(year, 33);
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
