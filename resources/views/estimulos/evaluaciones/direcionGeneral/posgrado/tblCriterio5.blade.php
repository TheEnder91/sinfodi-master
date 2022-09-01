<div class="table-responsive">
    <table id="tblCriterio5" class="table table-bordered table-striped" style="font-size:13px;">
        <caption style="font-size:13px;">Alumno del programa de doctorado del CIDETEQ graduado entre 43 y 60 meses (Valor del punto: 60).</caption>
        <thead>
            <tr class="text-center">
                <th scope="col" style="font-size:13px;">Clave</th>
                <th scope="col" style="font-size:13px;">Nombre</th>
                <th scope="col" style="font-size:13px;">Puntos</th>
                <th scope="col" style="font-size:13px;">Total</th>
                <th scope="col" style="font-size:13px;">Año</th>
                {{-- @if (Auth::user()->hasPermissionTo("estimulo-evaluaciones-general-posgrado-index")) --}}
                    <th scope="col" style="font-size:13px;">Evidencias</th>
                {{-- @endif --}}
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
@include('estimulos.evaluaciones.direcionGeneral.posgrado.modalEvidenciasCriterio5')

<script>
    function obtenerCriterio5(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/posgrado/searchPosgrado/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosCritero5){
                var datosCriterio5 = datosCritero5.response;
                // console.log(datosCritero5);
                // Codigo para guardar en el sistema...
                if(datosCriterio5.length > 0){
                    for(var i = 0; i < datosCriterio5.length; i++){
                        var dataCriterio5 = datosCriterio5[i];
                        // console.log(dataCriterio5);
                        consultarDatos({
                            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/posgrado/searchUsernamePosgrado/" + dataCriterio5.numero_personal,
                            type: 'GET',
                            dataType: 'json',
                            ok: function(datosCritero5Username){
                                // Codigo para guardar en el sistema...
                                var username = datosCritero5Username.response[0];
                                // console.log(username.clave + "->" + username.usuario);
                                $.ajax({
                                    type: 'POST',
                                    url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/posgrado/saveDatosPosgrado",
                                    data: {
                                        token: $('#txtTokenRepo').val(),
                                        clave: username.clave,
                                        nombre: username.nombre,
                                        id_objetivo: 2,
                                        id_criterio: criterio,
                                        direccion: "DGeneral",
                                        puntos: 0,
                                        total_puntos: 0,
                                        year: year,
                                        username: username.usuario
                                    },
                                    headers: {
                                        'token' : $('#txtTokenRepo').val() ? $('#txtTokenRepo').val(): ''
                                    },
                                    success: function(data){
                                        verTablaCriterio5(year, 5);
                                    }
                                });
                            },
                        });
                    }
                }else{
                    verTablaCriterio5(year, 5);
                }
            },
        });
    }

    function verTablaCriterio5(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/posgrado/datosposgrado/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosGeneralCriterio5){
                // console.log(datosGeneralCriterio5);
                var datosGeneralCriterio5 = datosGeneralCriterio5.response;
                var row = "";
                for(var i = 0; i < datosGeneralCriterio5.length; i++){
                    var dataGeneralCriterio5 = datosGeneralCriterio5[i];
                    // console.log(dataGeneralCriterio5);
                    var authUser = '<?= Auth::user()->usuario ?>';
                    var permissions = '<?= Auth::user()->hasPermissionTo("estimulo-evaluaciones-general-posgrado-index") ?>';
                    // console.log(permissions);
                    if(dataGeneralCriterio5.username == authUser || permissions == 1){
                        row += "<tr>";
                        row += '<th scope="row" class="text-center" width="10%" style="font-size:12px;">' + dataGeneralCriterio5.clave + '</td>';
                        row += '<td width="40%" style="font-size:12px;">' + dataGeneralCriterio5.nombre.toUpperCase() + "</td>";
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + parseInt(dataGeneralCriterio5.puntos) + '</td>';
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + parseInt(dataGeneralCriterio5.total_puntos) + '</td>';
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + dataGeneralCriterio5.year + '</td>';
                        // if(permissions == 1){
                            row += '<td class="text-center" width="10%" style="font-size:12px;"><a href="javascript:verEvidenciasCriterio5(' + dataGeneralCriterio5.year + ', ' + dataGeneralCriterio5.clave + ', ' + criterio +')"><i class="fa fa-edit"></i></a></td>';
                        // }
                        row += "</tr>";
                    }
                }
                if ($.fn.dataTable.isDataTable("#tblCriterio5")) {
                    tblDifusionDivulgacion = $("#tblCriterio5").DataTable();
                    tblDifusionDivulgacion.destroy();
                }
                $('#tblCriterio5 > tbody').html('');
                $('#tblCriterio5 > tbody').append(row);
                $('#tblCriterio5').DataTable({
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

    function verEvidenciasCriterio5(year, clave, criterio){
        var objetivo = 2;
        $('#txtCantidadCriterio5').val(0);
        $('#txtTotalCriterio5').val(0);
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/posgrado/searchEvidenciasPosgrado/" + year + "/" + clave + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(dataEvidenciasCriterio5){
                // console.log(dataEvidenciasCriterio5); //Comentamos para futuras pruebas...
                $('#modalEvidenciasCriterio5').modal({backdrop: 'static', keyboard: false});
                consultarDatos({
                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/posgrado/puntosPosgrado/" + criterio + "/" + objetivo,
                    type: 'GET',
                    dataType: 'json',
                    ok: function(puntosCriterio5){
                        puntos = puntosCriterio5.response[0].puntos;
                        // console.log(puntos); // Comentamos para futuras pruebas...
                        $('#txtValorCriterio5').val(puntos);
                        var datos = dataEvidenciasCriterio5.response;
                        var row = "";
                        $('#claveCriterio5').val(clave);
                        $('#txtYearCriterio5').val(year);
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
                                    row += '<img src="{{ asset('img/pdf2.png') }}" style="cursor: pointer" width="60px" height="60px" onClick="mostrarMensajeCriterio5(\''+nuevaFechaInicial+'\',\''+nuevaFechaFinal+'\', '+claveData.meses+', \''+claveData.evidencias+'\');">';
                                    row += '<br>';
                                    row += '<b><input type="checkbox" class="evidenciasCriterio5" name="evidenciasCriterio5[]" id="evidenciasCriterio5'+claveEvidencia+'" value="'+claveEvidencia+'" onClick="contarEvidenciasCriterio5('+puntos+');"> ' + claveEvidencia + '</b>';
                                    row += '</div>';
                                }else if (year <= '2021'){
                                    row += '<div class="col-12 col-md-2 text-center">';
                                    row += '<img src="{{ asset('img/pdf2.png') }}" style="cursor: pointer" width="60px" height="60px" onClick="mostrarMensajeCriterio5(\''+nuevaFechaInicial+'\',\''+nuevaFechaFinal+'\', '+claveData.meses+', \''+claveData.evidencias+'\');">';
                                    row += '<br>';
                                    row += '<b><input type="checkbox" class="evidenciasCriterio5" name="evidenciasCriterio5[]" id="evidenciasCriterio5'+claveEvidencia+'" value="'+claveEvidencia+'" onClick="contarEvidenciasCriterio5('+puntos+');"> ' + claveEvidencia + '</b>';
                                    row += '</div>';
                                }
                            }
                        }
                        $("#contenedorCriterio5").html(row).fadeIn('slow');
                        consultarDatos({
                            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/posgrado/getEvidenciasPosgrado/" + clave + "/" + year + "/" + criterio,
                            type: 'GET',
                            dataType: 'json',
                            ok: function(getEvidenciasCriterio5){
                                var array = getEvidenciasCriterio5.response;
                                if(array.length > 0){
                                    var evidencias = [];
                                    var serieEvidencias = "";
                                    $('input.evidenciasCriterio5:checked').each(function(){
                                        evidencias.push(this.value);
                                    });
                                    let desmarcar = serieEvidencias.split(',');
                                    if(desmarcar != ""){
                                        for(var i = 0; i < desmarcar.length; i++){
                                            // console.log(desmarcar[i]);
                                            document.getElementById("evidenciasCriterio5"+desmarcar[i]).checked = false;
                                        }
                                    }
                                    $(".evidenciasCriterio5").prop("checked", this.checked);
                                    var dataEvidencias = getEvidenciasCriterio5.response[0];
                                    let str = dataEvidencias.evidencias;
                                    let arr = str.split(',');
                                    //dividir la cadena de texto por una coma
                                    // console.log(arr);
                                    for(var i = 0; i < arr.length; i++){
                                        // console.log(arr[i]);
                                        document.getElementById("evidenciasCriterio5"+arr[i]).checked = true;
                                    }
                                    $('#txtCantidadCriterio5').val(dataEvidencias.puntos);
                                    $('#txtTotalCriterio5').val(dataEvidencias.total_puntos);
                                }
                            },
                        });
                    },
                });
            },
        });
    }

    function mostrarMensajeCriterio5(fechaInicial, fechaFinal, meses, evidencias){
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

    function contarEvidenciasCriterio5(puntos){
        // Parte para contar la cantidad de evidencias a la que pertenece...
        var evidencias = [];
        $('input.evidenciasCriterio5:checked').each(function(){
            evidencias.push(this.value);
        });
        var cantidad = evidencias.length;
        $('#txtCantidadCriterio5').val(cantidad);
        //Parte para sacar el total de puntos dependiendo de los evidencias a los que pertenece...
        // console.log(puntos);
        var totalPuntos = cantidad * puntos;
        $('#txtTotalCriterio5').val(totalPuntos);
    }

    function actualizarEvidenciasCriterio5(){
        var clave = $('#claveCriterio5').val();
        var year = $('#txtYearCriterio5').val();
        var cantidad = $('#txtCantidadCriterio5').val();
        var total = $('#txtTotalCriterio5').val();
        var evidenciasCriterio6 = [];
        var puntos = 0;
        var criterio = 5;
        var objetivo = 2;
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/posgrado/obtenerEvidenciasPosgrado/" + clave + "/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(searchEvidenciasCriterio5){
                var existe = searchEvidenciasCriterio5.response;
                // console.log(existe);
                var evidencias = [];
                var serieEvidencias = "";
                $('input.evidenciasCriterio5:checked').each(function(){
                    evidencias.push(this.value);
                });
                for(var i = 0; i < evidencias.length; i++){
                    var serieEvidencias = evidencias.join(',');
                }
                // console.log(serieEvidencias);
                var cantidadEvidencias = $('#txtCantidadCriterio5').val();
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
                            url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/posgrado/savePuntos",
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
                                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/posgrado/getEvidenciasPosgrado/" + clave + "/" + year + "/" + criterio,
                                    type: 'GET',
                                    dataType: 'json',
                                    ok: function(getEvidenciasCriterio5){
                                        var getPuntos = getEvidenciasCriterio5.response[0];
                                        // console.log(getPuntos);
                                        $.ajax({
                                            type: 'PUT',
                                            url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/posgrado/updateDatosPuntos",
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
                                                $('#modalEvidenciasCriterio5').modal('hide');
                                                $('#txtCantidadCriterio5').val(0);
                                                $('#txtTotalCriterio5').val(0);
                                                verTablaCriterio5(year, criterio);
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
                                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/posgrado/getEvidenciasPosgrado/" + clave + "/" + year + "/" + criterio,
                                    type: 'GET',
                                    dataType: 'json',
                                    ok: function(getEvidenciasCriterio5){
                                        var getPuntos = getEvidenciasCriterio5.response[0];
                                        // console.log(getPuntos);
                                        $.ajax({
                                            type: 'PUT',
                                            url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/posgrado/updateDatosPuntos",
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
                                                $('#modalEvidenciasCriterio5').modal('hide');
                                                $('#txtCantidadCriterio5').val(0);
                                                $('#txtTotalCriterio5').val(0);
                                                verTablaCriterio5(year, criterio);
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
