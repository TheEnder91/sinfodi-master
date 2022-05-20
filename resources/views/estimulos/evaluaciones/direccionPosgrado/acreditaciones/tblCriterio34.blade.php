<div class="table-responsive" width = "100%" id="table_refresh">
    <table id="tblCriterio34" class="table table-bordered table-striped" style="font-size:13px;">
        <caption style="font-size:13px;">Nuevas técnicas acreditadas y validadas como tales por la dirección técnica.</caption>
        <thead>
            <tr class="text-center">
                <th scope="col" style="font-size:13px;">Clave</th>
                <th scope="col" style="font-size:13px;">Nombre</th>
                <th scope="col" style="font-size:13px;">Puntos</th>
                <th scope="col" style="font-size:13px;">Total</th>
                <th scope="col" style="font-size:13px;">Año</th>
                @if (Auth::user()->hasPermissionTo("estimulo-evaluaciones-posgrado-acreditaciones-index"))
                    <th scope="col" style="font-size:13px;">Evidencias</th>
                @endif
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
@include('estimulos.evaluaciones.direccionPosgrado.acreditaciones.modalEvidenciasCriterio34')

<script>
    function obtenerCriterio34(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/acreditaciones/searchAcreditaciones/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosCritero34 ){
                var datosCriterio34 = datosCritero34.response;
                // Codigo para guardar en el sistema...
                if(datosCriterio34.length > 0){
                    // console.log(datosCritero34);
                    for(var i = 0; i < datosCriterio34.length; i++){
                        var dataCriterio34 = datosCriterio34[i];
                        // console.log(dataCriterio34);
                        consultarDatos({
                            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/posgrado/searchUsernamePosgrado/" + dataCriterio34.numero_personal,
                            type: 'GET',
                            dataType: 'json',
                            ok: function(datosCritero34Username){
                                var username = datosCritero34Username.response[0];
                                // console.log(username.clave + '->' + username.nombre + '->' + username.usuario);
                                $.ajax({
                                    type: 'POST',
                                    url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/acreditaciones/saveDatosAcreditaciones",
                                    data: {
                                        token: $('#txtTokenRepo').val(),
                                        clave: username.clave,
                                        nombre: username.nombre,
                                        id_objetivo: 8,
                                        id_criterio: criterio,
                                        direccion: "DPosgrado",
                                        puntos: 0,
                                        total_puntos: 0,
                                        year: year,
                                        username: username.usuario
                                    },
                                    headers: {
                                        'token' : $('#txtTokenRepo').val() ? $('#txtTokenRepo').val(): ''
                                    },
                                    success: function(data){
                                        verTablaCriterio34(year, criterio);
                                        // console.log('OK');
                                    }
                                });
                            },
                        });
                    }
                }else{
                    verTablaCriterio34(year, criterio);
                }
            },
        });
    }

    function verTablaCriterio34(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/acreditaciones/datosAcreditaciones/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosGeneralCriterio34){
                // console.log(datosGeneralCriterio34);
                var datosGeneralCriterio34 = datosGeneralCriterio34.response;
                var row = "";
                for(var i = 0; i < datosGeneralCriterio34.length; i++){
                    var dataGeneralCriterio34 = datosGeneralCriterio34[i];
                    // console.log(dataGeneralCriterio34);
                    var authUser = '<?= Auth::user()->usuario ?>';
                    var permissions = '<?= Auth::user()->hasPermissionTo("estimulo-evaluaciones-posgrado-acreditaciones-index") ?>';
                    // console.log(permissions);
                    if(dataGeneralCriterio34.username == authUser || permissions == 1){
                        row += "<tr>";
                        row += '<th scope="row" class="text-center" width="10%" style="font-size:12px;">' + dataGeneralCriterio34.clave + '</td>';
                        row += '<td width="40%" style="font-size:12px;">' + dataGeneralCriterio34.nombre.toUpperCase() + "</td>";
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + parseInt(dataGeneralCriterio34.puntos) + '</td>';
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + parseInt(dataGeneralCriterio34.total_puntos) + '</td>';
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + dataGeneralCriterio34.year + '</td>';
                        if(permissions == 1){
                            row += '<td class="text-center" width="10%" style="font-size:12px;"><a href="javascript:verEvidenciasCriterio34(' + dataGeneralCriterio34.year + ', ' + dataGeneralCriterio34.clave + ', ' + 34 +')"><i class="fa fa-edit"></i></a></td>';
                        }
                        row += "</tr>";
                    }
                }
                if ($.fn.dataTable.isDataTable("#tblCriterio34")) {
                    tblDifusionDivulgacion = $("#tblCriterio34").DataTable();
                    tblDifusionDivulgacion.destroy();
                }
                $('#tblCriterio34 > tbody').html('');
                $('#tblCriterio34 > tbody').append(row);
                $('#tblCriterio34').DataTable({
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

    function verEvidenciasCriterio34(year, clave){
        var criterio = 34;
        var objetivo = 8;
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/acreditaciones/searchEvidencias/" + year + "/" + clave + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(dataEvidenciasCriterio34){
                // console.log(dataEvidenciasCriterio34);
                $('#modalEvidenciasCriterio34').modal({backdrop: 'static', keyboard: false});
                consultarDatos({
                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/acreditaciones/puntos/" + criterio + "/" + objetivo,
                    type: 'GET',
                    dataType: 'json',
                    ok: function(puntosCriterio34){
                        puntos = puntosCriterio34.response[0].puntos;
                        // console.log(puntos); // Comentamos para futuras pruebas...
                        $('#txtValorCriterio34').val(puntos);
                        var row = "";
                        $('#claveCriterio34').val(clave);
                        $('#txtYearCriterio34').val(year);
                        var datos = dataEvidenciasCriterio34.response;
                        for(var i = 0; i < datos.length; i++){
                            var nombreData = datos[i];
                            var extension = nombreData.archivo.split(".");
                            extension = extension[1];
                            // console.log(extension);
                            if(extension == 'xlsx'){
                                row += '<div class="col-12 col-md-2 text-center">';
                                row += '<a href="http://126.107.2.56/SINFODI/servicios-tecnologicos/public/storage/' + nombreData.archivo + '" target="_blank">';
                                row += '<img src="{{ asset('img/excel.png') }}" width="70px" height="60px">';
                                row += '</a><br>';
                                row += '<b><input type="checkbox" class="evidenciasCriterio34" style="font-size:13px;" name="evidenciasCriterio34[]" id="evidenciasCriterio34'+nombreData.nombre+'" value="'+nombreData.nombre+'" onClick="contarEvidenciasCriterio34('+puntos+');"> ' + nombreData.nombre + '</b>';
                                row += '</div>';
                            }else if(extension == 'docx'){
                                row += '<div class="col-12 col-md-2 text-center">';
                                row += '<a href="http://126.107.2.56/SINFODI/servicios-tecnologicos/public/storage/' + nombreData.archivo + '" target="_blank">';
                                row += '<img src="{{ asset('img/word.png') }}" width="60px" height="60px">';
                                row += '</a><br>';
                                row += '<b><input type="checkbox" class="evidenciasCriterio34" style="font-size:13px;" name="evidenciasCriterio34[]" id="evidenciasCriterio34'+nombreData.nombre+'" value="'+nombreData.nombre+'" onClick="contarEvidenciasCriterio34('+puntos+');"> ' + nombreData.nombre + '</b>';
                                row += '</div>';
                            }else if(extension == 'pdf'){
                                row += '<div class="col-12 col-md-2 text-center">';
                                row += '<a href="http://126.107.2.56/SINFODI/servicios-tecnologicos/public/storage/' + nombreData.archivo + '" target="_blank">';
                                row += '<img src="{{ asset('img/pdf2.png') }}" width="60px" height="60px">';
                                row += '</a><br>';
                                row += '<b><input type="checkbox" class="evidenciasCriterio34" style="font-size:13px;" name="evidenciasCriterio34[]" id="evidenciasCriterio34'+nombreData.nombre+'" value="'+nombreData.nombre+'" onClick="contarEvidenciasCriterio34('+puntos+');"> ' + nombreData.nombre + '</b>';
                                row += '</div>';
                            }
                        }
                        $("#contenedorCriterio34").html(row).fadeIn('slow');
                        consultarDatos({
                            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/acreditaciones/getEvidenciasAcreditaciones/"+clave+"/"+year+"/"+criterio,
                            type: 'GET',
                            dataType: 'json',
                            ok: function(getEvidenciasCriterio34){
                                // console.log(getEvidenciasCriterio34.response);
                                var array = getEvidenciasCriterio34.response;
                                if(array.length > 0){
                                    var evidencias = [];
                                    var serieEvidencias = "";
                                    $('input.evidenciasCriterio34:checked').each(function(){
                                        evidencias.push(this.value);
                                    });
                                    let desmarcar = serieEvidencias.split(',');
                                    if(desmarcar != ""){
                                        for(var i = 0; i < desmarcar.length; i++){
                                            // console.log(desmarcar[i]);
                                            document.getElementById("evidenciasCriterio34"+desmarcar[i]).checked = false;
                                        }
                                    }
                                    $(".evidenciasCriterio34").prop("checked", this.checked);
                                    var dataEvidencias = getEvidenciasCriterio34.response[0];
                                    let str = dataEvidencias.evidencias;
                                    let arr = str.split(',');
                                    //dividir la cadena de texto por una coma
                                    // console.log(arr);
                                    for(var i = 0; i < arr.length; i++){
                                        // console.log(arr[i]);
                                        document.getElementById("evidenciasCriterio34"+arr[i]).checked = true;
                                    }
                                }
                            },
                        });
                    },
                });
            },
        });
    }

    function contarEvidenciasCriterio34(puntos){
        // Parte para contar la cantidad de evidencias a la que pertenece...
        var evidencias = [];
        $('input.evidenciasCriterio34:checked').each(function(){
            evidencias.push(this.value);
        });
        var cantidad = evidencias.length;
        $('#txtCantidadCriterio34').val(cantidad);
        //Parte para sacar el total de puntos dependiendo de los evidencias a los que pertenece...
        // console.log(puntos);
        var totalPuntos = cantidad * puntos;
        $('#txtTotalCriterio34').val(totalPuntos);
    }

    function actualizarEvidenciasCriterio34(){
        var clave = $('#claveCriterio34').val();
        var year = $('#txtYearCriterio34').val();
        var cantidad = $('#txtCantidadCriterio34').val();
        var total = $('#txtTotalCriterio34').val();
        var evidenciasCriterio34 = [];
        var puntos = 0;
        var criterio = 34;
        var objetivo = 8;
        // Consulta para saber si existe algun registro ya guardado...
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/acreditaciones/obtenerEvidencias/" + clave + "/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(searchEvidenciasCriterio34){
                var existe = searchEvidenciasCriterio34.response;
                // console.log(existe);
                // Consulta para obtener el valor del punto del criterio...
                consultarDatos({
                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/acreditaciones/puntos/" + criterio + "/" + objetivo,
                    type: 'GET',
                    dataType: 'json',
                    ok: function(puntosCriterio34){
                        puntos = puntosCriterio34.response[0].puntos;
                        // console.log(puntos); // Comentamos para futuras pruebas...
                        var evidencias = [];
                        var serieEvidencias = "";
                        $('input.evidenciasCriterio34:checked').each(function(){
                            evidencias.push(this.value);
                        });
                        for(var i = 0; i < evidencias.length; i++){
                            var serieEvidencias = evidencias.join(',');
                        }
                        // console.log(serieEvidencias);
                        var cantidadEvidencias = $('#txtCantidadCriterio34').val();
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
                                    url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/acreditaciones/savePuntos",
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
                                            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/acreditaciones/getEvidenciasAcreditaciones/" + clave + "/" + year + "/" + criterio,
                                            type: 'GET',
                                            dataType: 'json',
                                            ok: function(getEvidenciasCriterio34){
                                                var getPuntos = getEvidenciasCriterio34.response[0];
                                                // console.log(getPuntos);
                                                $.ajax({
                                                    type: 'PUT',
                                                    url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/acreditaciones/updateDatosPuntos",
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
                                                        $('#modalEvidenciasCriterio34').modal('hide');
                                                        verTablaCriterio34(year, 34);
                                                    }
                                                });
                                            },
                                        });
                                    }
                                });
                            }else{
                                $.ajax({
                                    type: 'PUT',
                                    url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/acreditaciones/updateDatos",
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
                                            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/acreditaciones/getEvidenciasAcreditaciones/" + clave + "/" + year + "/" + criterio,
                                            type: 'GET',
                                            dataType: 'json',
                                            ok: function(getEvidenciasCriterio34){
                                                var getPuntos = getEvidenciasCriterio34.response[0];
                                                // console.log(getPuntos);
                                                $.ajax({
                                                    type: 'PUT',
                                                    url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/acreditaciones/updateDatosPuntos",
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
                                                        $('#modalEvidenciasCriterio34').modal('hide');
                                                        verTablaCriterio34(year, 34);
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
