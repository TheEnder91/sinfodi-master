<div class="table-responsive">
    <table id="tblCriterio2" class="table table-bordered table-striped" style="font-size:13px;">
        <caption style="font-size:13px;">Alumno del programa de maestría del CIDETEQ graduado entre 20 y 30 meses.</caption>
        <thead>
            <tr class="text-center">
                <th scope="col" style="font-size:13px;">Clave</th>
                <th scope="col" style="font-size:13px;">Nombre</th>
                <th scope="col" style="font-size:13px;">Puntos</th>
                <th scope="col" style="font-size:13px;">Total</th>
                <th scope="col" style="font-size:13px;">Año</th>
                {{-- @if (Auth::user()->hasPermissionTo("estimulo-evaluaciones-proyectos-posgrado-index")) --}}
                    <th scope="col" style="font-size:13px;">Evidencias</th>
                {{-- @endif --}}
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
@include('estimulos.evaluaciones.direccionProyTec.posgrado.modalEvidenciasCriterio2')

<script>
    function obtenerCriterio2(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionProyTec/posgrado/searchPosgrado/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosCritero2){
                var datosCriterio2 = datosCritero2.response;
                // console.log(datosCritero2);
                // Codigo para guardar en el sistema...
                if(datosCriterio2.length > 0){
                    for(var i = 0; i < datosCriterio2.length; i++){
                        var dataCriterio2 = datosCriterio2[i];
                        // console.log(dataCriterio2.numero_personal);
                        consultarDatos({
                            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionProyTec/posgrado/searchUsernamePosgrado/" + dataCriterio2.numero_personal,
                            type: 'GET',
                            dataType: 'json',
                            ok: function(datosCritero2Username){
                                // Codigo para guardar en el sistema...
                                var username = datosCritero2Username.response[0];
                                // console.log(username.usuario);
                                $.ajax({
                                    type: 'POST',
                                    url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionProyTec/posgrado/saveDatosPosgrado",
                                    data: {
                                        token: $('#txtTokenRepo').val(),
                                        clave: username.clave,
                                        nombre: username.nombre,
                                        id_objetivo: 2,
                                        id_criterio: criterio,
                                        direccion: "DProyTec",
                                        puntos: 0,
                                        total_puntos: 0,
                                        year: year,
                                        username: username.usuario
                                    },
                                    headers: {
                                        'token' : $('#txtTokenRepo').val() ? $('#txtTokenRepo').val(): ''
                                    },
                                    success: function(data){
                                        verTablaCriterio2(year, 2);
                                    }
                                });
                            },
                        });
                    }
                }else{
                    verTablaCriterio2(year, 2);
                }
            },
        });
    }

    function verTablaCriterio2(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionProyTec/posgrado/datosposgrado/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosGeneralCriterio2){
                // console.log(datosGeneralCriterio2);
                var datosGeneralCriterio2 = datosGeneralCriterio2.response;
                var row = "";
                for(var i = 0; i < datosGeneralCriterio2.length; i++){
                    var dataGeneralCriterio2 = datosGeneralCriterio2[i];
                    // console.log(dataGeneralCriterio2);
                    var authUser = '<?= Auth::user()->usuario ?>';
                    var permissions = '<?= Auth::user()->hasPermissionTo("estimulo-evaluaciones-proyectos-posgrado-index") ?>';
                    // console.log(permissions);
                    if(dataGeneralCriterio2.username == authUser || permissions == 1){
                        row += "<tr>";
                        row += '<th scope="row" class="text-center" width="10%" style="font-size:12px;">' + dataGeneralCriterio2.clave + '</td>';
                        row += '<td width="40%" style="font-size:12px;">' + dataGeneralCriterio2.nombre.toUpperCase() + "</td>";
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + parseInt(dataGeneralCriterio2.puntos) + '</td>';
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + parseInt(dataGeneralCriterio2.total_puntos) + '</td>';
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + dataGeneralCriterio2.year + '</td>';
                        // if(permissions == 1){
                            row += '<td class="text-center" width="10%" style="font-size:12px;"><a href="javascript:verEvidenciasCriterio2(' + dataGeneralCriterio2.year + ', ' + dataGeneralCriterio2.clave + ', ' + 2 +')"><i class="fa fa-edit"></i></a></td>';
                        // }
                        row += "</tr>";
                    }
                }
                if ($.fn.dataTable.isDataTable("#tblCriterio2")) {
                    tblDifusionDivulgacion = $("#tblCriterio2").DataTable();
                    tblDifusionDivulgacion.destroy();
                }
                $('#tblCriterio2 > tbody').html('');
                $('#tblCriterio2 > tbody').append(row);
                $('#tblCriterio2').DataTable({
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

    function verEvidenciasCriterio2(year, clave, criterio){
        $('#txtCantidadCriterio2').val(0);
        $('#txtTotalCriterio2').val(0);
        var objetivo = 2;
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionProyTec/posgrado/searchEvidenciasPosgrado/" + year + "/" + clave + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(dataEvidenciasCriterio2){
                // console.log(dataEvidenciasCriterio2); //Comentamos para futuras pruebas...
                $('#modalEvidenciasCriterio2').modal({backdrop: 'static', keyboard: false});
                consultarDatos({
                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionProyTec/posgrado/puntosPosgrado/" + criterio + "/" + objetivo,
                    type: 'GET',
                    dataType: 'json',
                    ok: function(puntosCriterio2){
                        puntos = puntosCriterio2.response[0].puntos;
                        // console.log(puntos); // Comentamos para futuras pruebas...
                        $('#txtValorCriterio2').val(puntos);
                        var datos = dataEvidenciasCriterio2.response;
                        var row = "";
                        $('#claveCriterio2').val(clave);
                        $('#txtYearCriterio2').val(year);
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
                                    row += '<img src="{{ asset('img/pdf2.png') }}" style="cursor: pointer" width="60px" height="60px" onClick="mostrarMensajeCriterio2(\''+nuevaFechaInicial+'\',\''+nuevaFechaFinal+'\', '+claveData.meses+', \''+claveData.evidencias+'\');">';
                                    row += '<br>';
                                    row += '<b><input type="checkbox" class="evidenciasCriterio2" name="evidenciasCriterio2[]" id="evidenciasCriterio2'+claveEvidencia+'" value="'+claveEvidencia+'" onClick="contarEvidenciasCriterio2('+puntos+');"> ' + claveEvidencia + '</b>';
                                    row += '</div>';
                                }else if (year <= '2021'){
                                    row += '<div class="col-12 col-md-2 text-center">';
                                    row += '<img src="{{ asset('img/pdf2.png') }}" style="cursor: pointer" width="60px" height="60px" onClick="mostrarMensajeCriterio2(\''+nuevaFechaInicial+'\',\''+nuevaFechaFinal+'\', '+claveData.meses+', \''+claveData.evidencias+'\');">';
                                    row += '<br>';
                                    row += '<b><input type="checkbox" class="evidenciasCriterio2" name="evidenciasCriterio2[]" id="evidenciasCriterio2'+claveEvidencia+'" value="'+claveEvidencia+'" onClick="contarEvidenciasCriterio2('+puntos+');"> ' + claveEvidencia + '</b>';
                                    row += '</div>';
                                }
                            }
                        }
                        $("#contenedorCriterio2").html(row).fadeIn('slow');
                        consultarDatos({
                            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionProyTec/posgrado/getEvidenciasPosgrado/" + clave + "/" + year + "/" + criterio,
                            type: 'GET',
                            dataType: 'json',
                            ok: function(getEvidenciasCriterio2){
                                var array = getEvidenciasCriterio2.response;
                                if(array.length > 0){
                                    var evidencias = [];
                                    var serieEvidencias = "";
                                    $('input.evidenciasCriterio2:checked').each(function(){
                                        evidencias.push(this.value);
                                    });
                                    let desmarcar = serieEvidencias.split(',');
                                    if(desmarcar != ""){
                                        for(var i = 0; i < desmarcar.length; i++){
                                            // console.log(desmarcar[i]);
                                            document.getElementById("evidenciasCriterio2"+desmarcar[i]).checked = false;
                                        }
                                    }
                                    $(".evidenciasCriterio2").prop("checked", this.checked);
                                    var dataEvidencias = getEvidenciasCriterio2.response[0];
                                    let str = dataEvidencias.evidencias;
                                    let arr = str.split(',');
                                    //dividir la cadena de texto por una coma
                                    // console.log(arr);
                                    for(var i = 0; i < arr.length; i++){
                                        // console.log(arr[i]);
                                        document.getElementById("evidenciasCriterio2"+arr[i]).checked = true;
                                    }
                                    $('#txtCantidadCriterio2').val(dataEvidencias.puntos);
                                    $('#txtTotalCriterio2').val(dataEvidencias.total_puntos);
                                }
                            },
                        });
                    },
                });
            },
        });
    }

    function mostrarMensajeCriterio2(fechaInicial, fechaFinal, meses, evidencias){
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

    function contarEvidenciasCriterio2(puntos){
        // Parte para contar la cantidad de evidencias a la que pertenece...
        var evidencias = [];
        $('input.evidenciasCriterio2:checked').each(function(){
            evidencias.push(this.value);
        });
        var cantidad = evidencias.length;
        $('#txtCantidadCriterio2').val(cantidad);
        //Parte para sacar el total de puntos dependiendo de los evidencias a los que pertenece...
        // console.log(puntos);
        var totalPuntos = cantidad * puntos;
        $('#txtTotalCriterio2').val(totalPuntos);
    }

    function actualizarEvidenciasCriterio2(){
        var clave = $('#claveCriterio2').val();
        var year = $('#txtYearCriterio2').val();
        var cantidad = $('#txtCantidadCriterio2').val();
        var total = $('#txtTotalCriterio2').val();
        var evidenciasCriterio6 = [];
        var puntos = 0;
        var criterio = 2;
        var objetivo = 2;
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionProyTec/posgrado/obtenerEvidenciasPosgrado/" + clave + "/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(searchEvidenciasCriterio2){
                var existe = searchEvidenciasCriterio2.response;
                // console.log(existe);
                var evidencias = [];
                var serieEvidencias = "";
                $('input.evidenciasCriterio2:checked').each(function(){
                    evidencias.push(this.value);
                });
                for(var i = 0; i < evidencias.length; i++){
                    var serieEvidencias = evidencias.join(',');
                }
                // console.log(serieEvidencias);
                var cantidadEvidencias = $('#txtCantidadCriterio2').val();
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
                            url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionProyTec/posgrado/savePuntos",
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
                                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionProyTec/posgrado/getEvidenciasPosgrado/" + clave + "/" + year + "/" + criterio,
                                    type: 'GET',
                                    dataType: 'json',
                                    ok: function(getEvidenciasCriterio2){
                                        var getPuntos = getEvidenciasCriterio2.response[0];
                                        // console.log(getPuntos);
                                        $.ajax({
                                            type: 'PUT',
                                            url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionProyTec/posgrado/updateDatosPuntos",
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
                                                $('#modalEvidenciasCriterio2').modal('hide');
                                                verTablaCriterio2(year, criterio);
                                            }
                                        });
                                    },
                                });
                            }
                        });
                    }else{
                        $.ajax({
                            type: 'PUT',
                            url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionProyTec/investigacion/updateDatos",
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
                                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionProyTec/posgrado/getEvidenciasPosgrado/" + clave + "/" + year + "/" + criterio,
                                    type: 'GET',
                                    dataType: 'json',
                                    ok: function(getEvidenciasCriterio2){
                                        var getPuntos = getEvidenciasCriterio2.response[0];
                                        // console.log(getPuntos);
                                        $.ajax({
                                            type: 'PUT',
                                            url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionProyTec/posgrado/updateDatosPuntos",
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
                                                $('#modalEvidenciasCriterio2').modal('hide');
                                                verTablaCriterio2(year, criterio);
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
