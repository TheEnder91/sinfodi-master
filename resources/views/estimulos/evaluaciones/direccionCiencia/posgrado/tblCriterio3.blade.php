<div class="table-responsive">
    <table id="tblCriterio3" class="table table-bordered table-striped" style="font-size:13px;">
        <caption style="font-size:13px;">Alumno del programa de maestría del CIDETEQ graduado entre 31 y 36 meses (Valor del punto: 35).</caption>
        <thead>
            <tr class="text-center">
                <th scope="col" style="font-size:13px;">Clave</th>
                <th scope="col" style="font-size:13px;">Nombre</th>
                <th scope="col" style="font-size:13px;">Puntos</th>
                <th scope="col" style="font-size:13px;">Total</th>
                <th scope="col" style="font-size:13px;">Año</th>
                {{-- @if (Auth::user()->hasPermissionTo("estimulo-evaluaciones-ciencia-posgrado-index")) --}}
                    <th scope="col" style="font-size:13px;">Evidencias</th>
                {{-- @endif --}}
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
@include('estimulos.evaluaciones.direccionCiencia.posgrado.modalEvidenciasCriterio3')

<script>
    function obtenerCriterio3(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/posgrado/searchPosgrado/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosCritero3){
                var datosCriterio3 = datosCritero3.response;
                // console.log(datosCritero3);
                // Codigo para guardar en el sistema...
                if(datosCriterio3.length > 0){
                    for(var i = 0; i < datosCriterio3.length; i++){
                        var dataCriterio3 = datosCriterio3[i];
                        // console.log(dataCriterio3);
                        consultarDatos({
                            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/posgrado/searchUsernamePosgrado/" + dataCriterio3.numero_personal,
                            type: 'GET',
                            dataType: 'json',
                            ok: function(datosCritero3Username){
                                // Codigo para guardar en el sistema...
                                var username = datosCritero3Username.response[0];
                                verTablaCriterio3(year, criterio);
                                // console.log(username.clave + "->" + username.usuario);
                                // $.ajax({
                                //     type: 'POST',
                                //     url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/posgrado/saveDatosPosgrado",
                                //     data: {
                                //         token: $('#txtTokenRepo').val(),
                                //         clave: username.clave,
                                //         nombre: username.nombre,
                                //         id_objetivo: 2,
                                //         id_criterio: criterio,
                                //         direccion: "DCiencia",
                                //         puntos: 0,
                                //         total_puntos: 0,
                                //         year: year,
                                //         username: username.usuario
                                //     },
                                //     headers: {
                                //         'token' : $('#txtTokenRepo').val() ? $('#txtTokenRepo').val(): ''
                                //     },
                                //     success: function(data){
                                //         verTablaCriterio3(year, criterio);
                                //     }
                                // });
                            },
                        });
                    }
                }else{
                    verTablaCriterio3(year, criterio);
                }
            },
        });
    }

    function verTablaCriterio3(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/posgrado/datosposgrado/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosPosgradoCriterio3){
                // console.log(datosPosgradoCriterio3);
                var datosPosgradoCriterio3 = datosPosgradoCriterio3.response;
                var row = "";
                for(var i = 0; i < datosPosgradoCriterio3.length; i++){
                    var dataPosgradoCriterio3 = datosPosgradoCriterio3[i];
                    // console.log(dataPosgradoCriterio3);
                    var authUser = '<?= Auth::user()->usuario ?>';
                    var permissions = '<?= Auth::user()->hasPermissionTo("estimulo-evaluaciones-ciencia-posgrado-index") ?>';
                    // console.log(permissions);
                    if(dataPosgradoCriterio3.username == authUser || permissions == 1){
                        row += "<tr>";
                        row += '<th scope="row" class="text-center" width="10%" style="font-size:12px;">' + dataPosgradoCriterio3.clave + '</td>';
                        row += '<td width="40%" style="font-size:12px;">' + dataPosgradoCriterio3.nombre.toUpperCase() + "</td>";
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + parseInt(dataPosgradoCriterio3.puntos) + '</td>';
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + parseInt(dataPosgradoCriterio3.total_puntos) + '</td>';
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + dataPosgradoCriterio3.year + '</td>';
                        // if(permissions == 1){
                            row += '<td class="text-center" width="10%" style="font-size:12px;"><a href="javascript:verEvidenciasCriterio3(' + dataPosgradoCriterio3.year + ', ' + dataPosgradoCriterio3.clave + ', ' + criterio +')"><i class="fa fa-edit"></i></a></td>';
                        // }
                        row += "</tr>";
                    }
                }
                if ($.fn.dataTable.isDataTable("#tblCriterio3")) {
                    tblDifusionDivulgacion = $("#tblCriterio3").DataTable();
                    tblDifusionDivulgacion.destroy();
                }
                $('#tblCriterio3 > tbody').html('');
                $('#tblCriterio3 > tbody').append(row);
                $('#tblCriterio3').DataTable({
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

    function verEvidenciasCriterio3(year, clave, criterio){
        $('#txtCantidadCriterio3').val(0);
        $('#txtTotalCriterio3').val(0);
        var objetivo = 2;
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/posgrado/searchEvidenciasPosgrado/" + year + "/" + clave + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(dataEvidenciasCriterio3){
                // console.log(dataEvidenciasCriterio3); //Comentamos para futuras pruebas...
                $('#modalEvidenciasCriterio3').modal({backdrop: 'static', keyboard: false});
                consultarDatos({
                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/posgrado/puntosPosgrado/" + criterio + "/" + objetivo,
                    type: 'GET',
                    dataType: 'json',
                    ok: function(puntosCriterio3){
                        puntos = puntosCriterio3.response[0].puntos;
                        // console.log(puntos); // Comentamos para futuras pruebas...
                        $('#txtValorCriterio3').val(puntos);
                        var datos = dataEvidenciasCriterio3.response;
                        var row = "";
                        $('#claveCriterio3').val(clave);
                        $('#txtYearCriterio3').val(year);
                        for(var i = 0; i < datos.length; i++){
                            var claveData = datos[i];
                            // console.log(claveData);
                            if(claveData.evidencias != null){
                                // Obtener la clave de la cadena de la URL...
                                var evidencias = claveData.evidencias.substring(claveData.evidencias.lastIndexOf('/') + 1);
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
                                    row += '<img src="{{ asset('img/pdf2.png') }}" style="cursor: pointer" width="60px" height="60px" onClick="mostrarMensajeCriterio3(\''+nuevaFechaInicial+'\',\''+nuevaFechaFinal+'\', '+claveData.meses+', \''+claveData.evidencias+'\');">';
                                    row += '<br>';
                                    row += '<b><input type="checkbox" class="evidenciasCriterio3" name="evidenciasCriterio3[]" id="evidenciasCriterio3'+claveEvidencia+'" value="'+claveEvidencia+'" onClick="contarEvidenciasCriterio3('+puntos+');"> ' + claveEvidencia + '</b>';
                                    row += '</div>';
                                }else if (year <= '2021'){
                                    row += '<div class="col-12 col-md-2 text-center">';
                                    row += '<img src="{{ asset('img/pdf2.png') }}" style="cursor: pointer" width="60px" height="60px" onClick="mostrarMensajeCriterio3(\''+nuevaFechaInicial+'\',\''+nuevaFechaFinal+'\', '+claveData.meses+', \''+claveData.evidencias+'\');">';
                                    row += '<br>';
                                    row += '<b><input type="checkbox" class="evidenciasCriterio3" name="evidenciasCriterio3[]" id="evidenciasCriterio3'+claveEvidencia+'" value="'+claveEvidencia+'" onClick="contarEvidenciasCriterio3('+puntos+');"> ' + claveEvidencia + '</b>';
                                    row += '</div>';
                                }
                            }
                        }
                        $("#contenedorCriterio3").html(row).fadeIn('slow');
                        consultarDatos({
                            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/posgrado/getEvidenciasPosgrado/" + clave + "/" + year + "/" + criterio,
                            type: 'GET',
                            dataType: 'json',
                            ok: function(getEvidenciasCriterio3){
                                var array = getEvidenciasCriterio3.response;
                                if(array.length > 0){
                                    var evidencias = [];
                                    var serieEvidencias = "";
                                    $('input.evidenciasCriterio3:checked').each(function(){
                                        evidencias.push(this.value);
                                    });
                                    let desmarcar = serieEvidencias.split(',');
                                    if(desmarcar != ""){
                                        for(var i = 0; i < desmarcar.length; i++){
                                            // console.log(desmarcar[i]);
                                            document.getElementById("evidenciasCriterio3"+desmarcar[i]).checked = false;
                                        }
                                    }
                                    $(".evidenciasCriterio3").prop("checked", this.checked);
                                    var dataEvidencias = getEvidenciasCriterio3.response[0];
                                    let str = dataEvidencias.evidencias;
                                    let arr = str.split(',');
                                    //dividir la cadena de texto por una coma
                                    // console.log(arr);
                                    for(var i = 0; i < arr.length; i++){
                                        // console.log(arr[i]);
                                        document.getElementById("evidenciasCriterio3"+arr[i]).checked = true;
                                    }
                                    $('#txtCantidadCriterio3').val(dataEvidencias.puntos);
                                    $('#txtTotalCriterio3').val(dataEvidencias.total_puntos);
                                }
                            },
                        });
                    },
                });
            },
        });
    }

    function mostrarMensajeCriterio3(fechaInicial, fechaFinal, meses, evidencias){
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

    function contarEvidenciasCriterio3(puntos){
        // Parte para contar la cantidad de evidencias a la que pertenece...
        var evidencias = [];
        $('input.evidenciasCriterio3:checked').each(function(){
            evidencias.push(this.value);
        });
        var cantidad = evidencias.length;
        $('#txtCantidadCriterio3').val(cantidad);
        //Parte para sacar el total de puntos dependiendo de los evidencias a los que pertenece...
        // console.log(puntos);
        var totalPuntos = cantidad * puntos;
        $('#txtTotalCriterio3').val(totalPuntos);
    }

    function actualizarEvidenciasCriterio3(){
        var clave = $('#claveCriterio3').val();
        var year = $('#txtYearCriterio3').val();
        var cantidad = $('#txtCantidadCriterio3').val();
        var total = $('#txtTotalCriterio3').val();
        var evidenciasCriterio6 = [];
        var puntos = 0;
        var criterio = 3;
        var objetivo = 2;
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/posgrado/obtenerEvidenciasPosgrado/" + clave + "/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(searchEvidenciasCriterio3){
                var existe = searchEvidenciasCriterio3.response;
                // console.log(existe);
                var evidencias = [];
                var serieEvidencias = "";
                $('input.evidenciasCriterio3:checked').each(function(){
                    evidencias.push(this.value);
                });
                for(var i = 0; i < evidencias.length; i++){
                    var serieEvidencias = evidencias.join(',');
                }
                // console.log(serieEvidencias);
                var cantidadEvidencias = $('#txtCantidadCriterio3').val();
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
                            url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/posgrado/savePuntos",
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
                                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/posgrado/getEvidenciasPosgrado/" + clave + "/" + year + "/" + criterio,
                                    type: 'GET',
                                    dataType: 'json',
                                    ok: function(getEvidenciasCriterio3){
                                        var getPuntos = getEvidenciasCriterio3.response[0];
                                        // console.log(getPuntos);
                                        $.ajax({
                                            type: 'PUT',
                                            url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/posgrado/updateDatosPuntos",
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
                                                $('#modalEvidenciasCriterio3').modal('hide');
                                                verTablaCriterio3(year, criterio);
                                            }
                                        });
                                    },
                                });
                            }
                        });
                    }else{
                        $.ajax({
                            type: 'PUT',
                            url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/investigacion/updateDatos",
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
                                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/posgrado/getEvidenciasPosgrado/" + clave + "/" + year + "/" + criterio,
                                    type: 'GET',
                                    dataType: 'json',
                                    ok: function(getEvidenciasCriterio3){
                                        var getPuntos = getEvidenciasCriterio3.response[0];
                                        // console.log(getPuntos);
                                        $.ajax({
                                            type: 'PUT',
                                            url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/posgrado/updateDatosPuntos",
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
                                                $('#modalEvidenciasCriterio3').modal('hide');
                                                verTablaCriterio3(year, criterio);
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
