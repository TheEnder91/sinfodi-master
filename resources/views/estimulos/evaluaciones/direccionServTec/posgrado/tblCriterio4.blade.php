<div class="table-responsive">
    <table id="tblCriterio4" class="table table-bordered table-striped" style="font-size:13px;">
        <caption style="font-size:13px;">Alumno del programa de doctorado del CIDETEQ graduado entre 37 y 42 meses (valor del punto: 70).</caption>
        <thead>
            <tr class="text-center">
                <th scope="col" style="font-size:13px;">Clave</th>
                <th scope="col" style="font-size:13px;">Nombre</th>
                <th scope="col" style="font-size:13px;">Puntos</th>
                <th scope="col" style="font-size:13px;">Total</th>
                <th scope="col" style="font-size:13px;">Año</th>
                {{-- @if (Auth::user()->hasPermissionTo("estimulo-evaluaciones-servicios-posgrado-index")) --}}
                    <th scope="col" style="font-size:13px;">Evidencias</th>
                {{-- @endif --}}
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
@include('estimulos.evaluaciones.direccionServTec.posgrado.modalEvidenciasCriterio4')

<script>
    function obtenerCriterio4(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/posgrado/searchPosgrado/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosCritero4){
                var datosCriterio4 = datosCritero4.response;
                // console.log(datosCritero4);
                // Codigo para guardar en el sistema...
                if(datosCriterio4.length > 0){
                    for(var i = 0; i < datosCriterio4.length; i++){
                        var dataCriterio4 = datosCriterio4[i];
                        // console.log(dataCriterio4);
                        consultarDatos({
                            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/posgrado/searchUsernamePosgrado/" + dataCriterio4.numero_personal,
                            type: 'GET',
                            dataType: 'json',
                            ok: function(datosCritero4Username){
                                // Codigo para guardar en el sistema...
                                var username = datosCritero4Username.response[0];
                                verTablaCriterio4(year, 4);
                                // console.log(username.clave + "->" + username.usuario);
                                // $.ajax({
                                //     type: 'POST',
                                //     url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/posgrado/saveDatosPosgrado",
                                //     data: {
                                //         token: $('#txtTokenRepo').val(),
                                //         clave: username.clave,
                                //         nombre: username.nombre,
                                //         id_objetivo: 2,
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
                                //         verTablaCriterio4(year, 4);
                                //     }
                                // });
                            },
                        });
                    }
                }else{
                    verTablaCriterio4(year, 4);
                }
            },
        });
    }

    function verTablaCriterio4(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/posgrado/datosposgrado/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosPosgradoCriterio4){
                // console.log(datosPosgradoCriterio4);
                var datosPosgradoCriterio4 = datosPosgradoCriterio4.response;
                var row = "";
                for(var i = 0; i < datosPosgradoCriterio4.length; i++){
                    var dataPosgradoCriterio4 = datosPosgradoCriterio4[i];
                    // console.log(dataPosgradoCriterio4);
                    var authUser = '<?= Auth::user()->usuario ?>';
                    var permissions = '<?= Auth::user()->hasPermissionTo("estimulo-evaluaciones-servicios-posgrado-index") ?>';
                    // console.log(permissions);
                    if(dataPosgradoCriterio4.username == authUser || permissions == 1){
                        row += "<tr>";
                        row += '<th scope="row" class="text-center" width="10%" style="font-size:12px;">' + dataPosgradoCriterio4.clave + '</td>';
                        row += '<td width="40%" style="font-size:12px;">' + dataPosgradoCriterio4.nombre.toUpperCase() + "</td>";
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + parseInt(dataPosgradoCriterio4.puntos) + '</td>';
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + parseInt(dataPosgradoCriterio4.total_puntos) + '</td>';
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + dataPosgradoCriterio4.year + '</td>';
                        // if(permissions == 1){
                            row += '<td class="text-center" width="10%" style="font-size:12px;"><a href="javascript:verEvidenciasCriterio4(' + dataPosgradoCriterio4.year + ', ' + dataPosgradoCriterio4.clave + ', ' + 4 +')"><i class="fa fa-edit"></i></a></td>';
                        // }
                        row += "</tr>";
                    }
                }
                if ($.fn.dataTable.isDataTable("#tblCriterio4")) {
                    tblDifusionDivulgacion = $("#tblCriterio4").DataTable();
                    tblDifusionDivulgacion.destroy();
                }
                $('#tblCriterio4 > tbody').html('');
                $('#tblCriterio4 > tbody').append(row);
                $('#tblCriterio4').DataTable({
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

    function verEvidenciasCriterio4(year, clave, criterio){
        $('#txtCantidadCriterio4').val(0);
        $('#txtTotalCriterio4').val(0);
        var objetivo = 2;
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/posgrado/searchEvidenciasPosgrado/" + year + "/" + clave + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(dataEvidenciasCriterio4){
                // console.log(dataEvidenciasCriterio4); //Comentamos para futuras pruebas...
                $('#modalEvidenciasCriterio4').modal({backdrop: 'static', keyboard: false});
                consultarDatos({
                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/posgrado/puntosPosgrado/" + criterio + "/" + objetivo,
                    type: 'GET',
                    dataType: 'json',
                    ok: function(puntosCriterio4){
                        puntos = puntosCriterio4.response[0].puntos;
                        // console.log(puntos); // Comentamos para futuras pruebas...
                        $('#txtValorCriterio4').val(puntos);
                        var datos = dataEvidenciasCriterio4.response;
                        var row = "";
                        $('#claveCriterio4').val(clave);
                        $('#txtYearCriterio4').val(year);
                        for(var i = 0; i < datos.length; i++){
                            var claveData = datos[i];
                            // console.log(claveData);
                            if(claveData.evidencias != null){
                                // Obtener la clave de la cadena de la URL...
                                var evidencias = claveData.evidencias.substring(claveData.evidencias.lastIndexOf("/") + 1);
                                var claveEvidencia = evidencias.substring(0, evidencias.indexOf('.pdf'));
                                // Obtenemos solo la fecha sin formato de horas...
                                var fechaInicial = claveData.FechaInicial;
                                var nuevaFechaInicial = fechaInicial.split(" ")[0].split("-").reverse().join("-");
                                // Obtenemos solo la fecha sin formato de horas...
                                var fechaFinal = claveData.FechaFinal;
                                var nuevaFechaFinal = fechaFinal.split(" ")[0].split("-").reverse().join("-");
                                // console.log(claveEvidencia);
                                if(year == '2020'){
                                    row += '<div class="col-12 col-md-2 text-center">';
                                    row += '<img src="{{ asset('img/pdf2.png') }}" style="cursor: pointer" width="60px" height="60px" onClick="mostrarMensajeCriterio4(\''+nuevaFechaInicial+'\',\''+nuevaFechaFinal+'\', '+claveData.meses+', \''+claveData.evidencias+'\');">';
                                    row += '<br>';
                                    row += '<b><input type="checkbox" class="evidenciasCriterio4" name="evidenciasCriterio4[]" id="evidenciasCriterio4'+claveEvidencia+'" value="'+claveEvidencia+'" onClick="contarEvidenciasCriterio4('+puntos+');"> ' + claveEvidencia + '</b>';
                                    row += '</div>';
                                }else if (year <= '2021'){
                                    row += '<div class="col-12 col-md-2 text-center">';
                                    row += '<img src="{{ asset('img/pdf2.png') }}" style="cursor: pointer" width="60px" height="60px" onClick="mostrarMensajeCriterio4(\''+nuevaFechaInicial+'\',\''+nuevaFechaFinal+'\', '+claveData.meses+', \''+claveData.evidencias+'\');">';
                                    row += '<br>';
                                    row += '<b><input type="checkbox" class="evidenciasCriterio4" name="evidenciasCriterio4[]" id="evidenciasCriterio4'+claveEvidencia+'" value="'+claveEvidencia+'" onClick="contarEvidenciasCriterio4('+puntos+');"> ' + claveEvidencia + '</b>';
                                    row += '</div>';
                                }
                            }
                        }
                        $("#contenedorCriterio4").html(row).fadeIn('slow');
                        consultarDatos({
                            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/posgrado/getEvidenciasPosgrado/" + clave + "/" + year + "/" + criterio,
                            type: 'GET',
                            dataType: 'json',
                            ok: function(getEvidenciasCriterio4){
                                var array = getEvidenciasCriterio4.response;
                                if(array.length > 0){
                                    var evidencias = [];
                                    var serieEvidencias = "";
                                    $('input.evidenciasCriterio4:checked').each(function(){
                                        evidencias.push(this.value);
                                    });
                                    let desmarcar = serieEvidencias.split(',');
                                    if(desmarcar != ""){
                                        for(var i = 0; i < desmarcar.length; i++){
                                            // console.log(desmarcar[i]);
                                            document.getElementById("evidenciasCriterio4"+desmarcar[i]).checked = false;
                                        }
                                    }
                                    $(".evidenciasCriterio4").prop("checked", this.checked);
                                    var dataEvidencias = getEvidenciasCriterio4.response[0];
                                    let str = dataEvidencias.evidencias;
                                    let arr = str.split(',');
                                    //dividir la cadena de texto por una coma
                                    // console.log(arr);
                                    for(var i = 0; i < arr.length; i++){
                                        // console.log(arr[i]);
                                        document.getElementById("evidenciasCriterio4"+arr[i]).checked = true;
                                    }
                                    $('#txtCantidadCriterio4').val(dataEvidencias.puntos);
                                    $('#txtTotalCriterio4').val(dataEvidencias.total_puntos);
                                }
                            },
                        });
                    },
                });
            },
        });
    }

    function mostrarMensajeCriterio4(fechaInicial, fechaFinal, meses, evidencias){
        // console.log(fechaInicial+'->'+fechaFinal+'->'+meses+'->'+evidencias);
        swal({
            title:'Información:',
            html:
              '<b>Fecha inicial: </b>' + fechaInicial + '<br>' +
              '<b>Fecha final: </b>' + fechaFinal + '<br>' +
              '<b>Meses transcurridos: </b>' + meses,
            showCloseButton: true,
            focusConfirm: false,
            confirmButtonText:
              '<a href="'+evidencias+'" target="_blank" style="color:white;"><i class="fa fa-eye"></i> Ver documento.</a>',
        });
    }

    function contarEvidenciasCriterio4(puntos){
        // Parte para contar la cantidad de evidencias a la que pertenece...
        var evidencias = [];
        $('input.evidenciasCriterio4:checked').each(function(){
            evidencias.push(this.value);
        });
        var cantidad = evidencias.length;
        $('#txtCantidadCriterio4').val(cantidad);
        //Parte para sacar el total de puntos dependiendo de los evidencias a los que pertenece...
        // console.log(puntos);
        var totalPuntos = cantidad * puntos;
        $('#txtTotalCriterio4').val(totalPuntos);
    }

    function actualizarEvidenciasCriterio4(){
        var clave = $('#claveCriterio4').val();
        var year = $('#txtYearCriterio4').val();
        var cantidad = $('#txtCantidadCriterio4').val();
        var total = $('#txtTotalCriterio4').val();
        var evidenciasCriterio6 = [];
        var puntos = 0;
        var criterio = 4;
        var objetivo = 2;
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/posgrado/obtenerEvidenciasPosgrado/" + clave + "/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(searchEvidenciasCriterio4){
                var existe = searchEvidenciasCriterio4.response;
                // console.log(existe);
                var evidencias = [];
                var serieEvidencias = "";
                $('input.evidenciasCriterio4:checked').each(function(){
                    evidencias.push(this.value);
                });
                for(var i = 0; i < evidencias.length; i++){
                    var serieEvidencias = evidencias.join(',');
                }
                // console.log(serieEvidencias);
                var cantidadEvidencias = $('#txtCantidadCriterio4').val();
                // console.log(cantidadEvidencias);
                if(cantidadEvidencias == 0){
                    swal({
                        type: 'warning',
                        text: 'Favor de seleccionar las evidencias.',
                        showConfirmButton: false,
                        timer: 1800
                    }).catch(swal.noop);
                }else{
                    if(existe == 0){
                        $.ajax({
                            type: 'POST',
                            url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/posgrado/savePuntos",
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
                                // console.log('OK');
                                consultarDatos({
                                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/posgrado/getEvidenciasPosgrado/" + clave + "/" + year + "/" + criterio,
                                    type: 'GET',
                                    dataType: 'json',
                                    ok: function(getEvidenciasCriterio4){
                                        var getPuntos = getEvidenciasCriterio4.response[0];
                                        // console.log(getPuntos);
                                        $.ajax({
                                            type: 'PUT',
                                            url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/posgrado/updateDatosPuntos",
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
                                                $('#modalEvidenciasCriterio4').modal('hide');
                                                verTablaCriterio4(year, criterio);
                                            }
                                        });
                                    },
                                });
                            }
                        });
                    }else{
                        $.ajax({
                            type: 'PUT',
                            url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/investigacion/updateDatos",
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
                                // console.log('OK');
                                consultarDatos({
                                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/posgrado/getEvidenciasPosgrado/" + clave + "/" + year + "/" + criterio,
                                    type: 'GET',
                                    dataType: 'json',
                                    ok: function(getEvidenciasCriterio4){
                                        var getPuntos = getEvidenciasCriterio4.response[0];
                                        // console.log(getPuntos);
                                        $.ajax({
                                            type: 'PUT',
                                            url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/posgrado/updateDatosPuntos",
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
                                                $('#modalEvidenciasCriterio4').modal('hide');
                                                verTablaCriterio4(year, criterio);
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
    }
</script>
