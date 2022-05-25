<div class="table-responsive" width = "100%" id="table_refresh">
    <table id="tblCriterio35" class="table table-bordered table-striped" style="font-size:13px;">
        <caption style="font-size:13px;">Pruebas interlaboratorio(puntos por analito 60 puntos máximo).</caption>
        <thead>
            <tr class="text-center">
                <th scope="col" style="font-size:13px;">Clave</th>
                <th scope="col" style="font-size:13px;">Nombre</th>
                <th scope="col" style="font-size:13px;">Puntos</th>
                <th scope="col" style="font-size:13px;">Total</th>
                <th scope="col" style="font-size:13px;">Año</th>
                {{-- @if (Auth::user()->hasPermissionTo("estimulo-evaluaciones-administracion-acreditaciones-index")) --}}
                    <th scope="col" style="font-size:13px;">Evidencias</th>
                {{-- @endif --}}
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
@include('estimulos.evaluaciones.direccionAdministracion.acreditaciones.modalEvidenciasCriterio35')

<script>
    function obtenerCriterio35(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionAdministracion/acreditaciones/searchAcreditaciones/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosCritero35){
                var datosCriterio35 = datosCritero35.response;
                // Codigo para guardar en el sistema...
                if(datosCriterio35.length > 0){
                    // console.log(datosCritero35);
                    for(var i = 0; i < datosCriterio35.length; i++){
                        var dataCriterio35 = datosCriterio35[i];
                        // console.log(dataCriterio35);
                        consultarDatos({
                            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionAdministracion/posgrado/searchUsernamePosgrado/" + dataCriterio35.numero_personal,
                            type: 'GET',
                            dataType: 'json',
                            ok: function(datosCritero35Username){
                                var username = datosCritero35Username.response[0];
                                // console.log(username.clave + '->' + username.nombre + '->' + username.usuario);
                                $.ajax({
                                    type: 'POST',
                                    url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionAdministracion/acreditaciones/saveDatosAcreditaciones",
                                    data: {
                                        token: $('#txtTokenRepo').val(),
                                        clave: username.clave,
                                        nombre: username.nombre,
                                        id_objetivo: 8,
                                        id_criterio: criterio,
                                        direccion: "DAdministracion",
                                        puntos: 0,
                                        total_puntos: 0,
                                        year: year,
                                        username: username.usuario
                                    },
                                    headers: {
                                        'token' : $('#txtTokenRepo').val() ? $('#txtTokenRepo').val(): ''
                                    },
                                    success: function(data){
                                        verTablaCriterio35(year, criterio);
                                        // console.log('OK');
                                    }
                                });
                            },
                        });
                    }
                }else{
                    verTablaCriterio35(year, criterio);
                }
            },
        });
    }

    function verTablaCriterio35(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionAdministracion/acreditaciones/datosAcreditaciones/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosGeneralCriterio35){
                // console.log(datosGeneralCriterio35);
                var datosGeneralCriterio35 = datosGeneralCriterio35.response;
                var row = "";
                for(var i = 0; i < datosGeneralCriterio35.length; i++){
                    var dataGeneralCriterio35 = datosGeneralCriterio35[i];
                    // console.log(dataGeneralCriterio35);
                    var authUser = '<?= Auth::user()->usuario ?>';
                    var permissions = '<?= Auth::user()->hasPermissionTo("estimulo-evaluaciones-administracion-acreditaciones-index") ?>';
                    // console.log(permissions);
                    if(dataGeneralCriterio35.username == authUser || permissions == 1){
                        row += "<tr>";
                        row += '<th scope="row" class="text-center" width="10%" style="font-size:12px;">' + dataGeneralCriterio35.clave + '</td>';
                        row += '<td width="40%" style="font-size:12px;">' + dataGeneralCriterio35.nombre.toUpperCase() + "</td>";
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + parseInt(dataGeneralCriterio35.puntos) + '</td>';
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + parseInt(dataGeneralCriterio35.total_puntos) + '</td>';
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + dataGeneralCriterio35.year + '</td>';
                        // if(permissions == 1){
                            row += '<td class="text-center" width="10%" style="font-size:12px;"><a href="javascript:verEvidenciasCriterio35(' + dataGeneralCriterio35.year + ', ' + dataGeneralCriterio35.clave + ', ' + 35 +')"><i class="fa fa-edit"></i></a></td>';
                        // }
                        row += "</tr>";
                    }
                }
                if ($.fn.dataTable.isDataTable("#tblCriterio35")) {
                    tblDifusionDivulgacion = $("#tblCriterio35").DataTable();
                    tblDifusionDivulgacion.destroy();
                }
                $('#tblCriterio35 > tbody').html('');
                $('#tblCriterio35 > tbody').append(row);
                $('#tblCriterio35').DataTable({
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

    function verEvidenciasCriterio35(year, clave){
        var criterio = 35;
        var objetivo = 8;
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionAdministracion/acreditaciones/searchEvidencias/" + year + "/" + clave + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(dataEvidenciasCriterio35){
                // console.log(dataEvidenciasCriterio35);
                $('#modalEvidenciasCriterio35').modal({backdrop: 'static', keyboard: false});
                consultarDatos({
                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionAdministracion/acreditaciones/puntos/" + criterio + "/" + objetivo,
                    type: 'GET',
                    dataType: 'json',
                    ok: function(puntosCriterio35){
                        puntos = puntosCriterio35.response[0].puntos;
                        // console.log(puntos); // Comentamos para futuras pruebas...
                        $('#txtValorCriterio35').val(puntos);
                        var row = "";
                        $('#claveCriterio35').val(clave);
                        $('#txtYearCriterio35').val(year);
                        var datos = dataEvidenciasCriterio35.response;
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
                                row += '<b><input type="checkbox" class="evidenciasCriterio35" style="font-size:13px;" name="evidenciasCriterio35[]" id="evidenciasCriterio35'+nombreData.nombre+'" value="'+nombreData.nombre+'" onClick="contarEvidenciasCriterio35('+puntos+');"> ' + nombreData.nombre + '</b>';
                                row += '</div>';
                            }else if(extension == 'docx'){
                                row += '<div class="col-12 col-md-2 text-center">';
                                row += '<a href="http://126.107.2.56/SINFODI/servicios-tecnologicos/public/storage/' + nombreData.archivo + '" target="_blank">';
                                row += '<img src="{{ asset('img/word.png') }}" width="60px" height="60px">';
                                row += '</a><br>';
                                row += '<b><input type="checkbox" class="evidenciasCriterio35" style="font-size:13px;" name="evidenciasCriterio35[]" id="evidenciasCriterio35'+nombreData.nombre+'" value="'+nombreData.nombre+'" onClick="contarEvidenciasCriterio35('+puntos+');"> ' + nombreData.nombre + '</b>';
                                row += '</div>';
                            }else if(extension == 'pdf'){
                                row += '<div class="col-12 col-md-2 text-center">';
                                row += '<a href="http://126.107.2.56/SINFODI/servicios-tecnologicos/public/storage/' + nombreData.archivo + '" target="_blank">';
                                row += '<img src="{{ asset('img/pdf2.png') }}" width="60px" height="60px">';
                                row += '</a><br>';
                                row += '<b><input type="checkbox" class="evidenciasCriterio35" style="font-size:13px;" name="evidenciasCriterio35[]" id="evidenciasCriterio35'+nombreData.nombre+'" value="'+nombreData.nombre+'" onClick="contarEvidenciasCriterio35('+puntos+');"> ' + nombreData.nombre + '</b>';
                                row += '</div>';
                            }
                        }
                        $("#contenedorCriterio35").html(row).fadeIn('slow');
                        consultarDatos({
                            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionAdministracion/acreditaciones/getEvidenciasAcreditaciones/"+clave+"/"+year+"/"+criterio,
                            type: 'GET',
                            dataType: 'json',
                            ok: function(getEvidenciasCriterio35){
                                // console.log(getEvidenciasCriterio35.response);
                                var array = getEvidenciasCriterio35.response;
                                if(array.length > 0){
                                    var evidencias = [];
                                    var serieEvidencias = "";
                                    $('input.evidenciasCriterio35:checked').each(function(){
                                        evidencias.push(this.value);
                                    });
                                    let desmarcar = serieEvidencias.split(',');
                                    if(desmarcar != ""){
                                        for(var i = 0; i < desmarcar.length; i++){
                                            // console.log(desmarcar[i]);
                                            document.getElementById("evidenciasCriterio35"+desmarcar[i]).checked = false;
                                        }
                                    }
                                    $(".evidenciasCriterio35").prop("checked", this.checked);
                                    var dataEvidencias = getEvidenciasCriterio35.response[0];
                                    let str = dataEvidencias.evidencias;
                                    let arr = str.split(',');
                                    //dividir la cadena de texto por una coma
                                    // console.log(arr);
                                    for(var i = 0; i < arr.length; i++){
                                        // console.log(arr[i]);
                                        document.getElementById("evidenciasCriterio35"+arr[i]).checked = true;
                                    }
                                }
                            },
                        });
                    },
                });
            },
        });
    }

    function contarEvidenciasCriterio35(puntos){
        // Parte para contar la cantidad de evidencias a la que pertenece...
        var evidencias = [];
        $('input.evidenciasCriterio35:checked').each(function(){
            evidencias.push(this.value);
        });
        var cantidad = evidencias.length;
        $('#txtCantidadCriterio35').val(cantidad);
        //Parte para sacar el total de puntos dependiendo de los evidencias a los que pertenece...
        // console.log(puntos);
        var totalPuntos = cantidad * puntos;
        $('#txtTotalCriterio35').val(totalPuntos);
    }

    function actualizarEvidenciasCriterio35(){
        var clave = $('#claveCriterio35').val();
        var year = $('#txtYearCriterio35').val();
        var cantidad = $('#txtCantidadCriterio35').val();
        var total = $('#txtTotalCriterio35').val();
        var evidenciasCriterio35 = [];
        var puntos = 0;
        var criterio = 35;
        var objetivo = 8;
        // Consulta para saber si existe algun registro ya guardado...
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionAdministracion/acreditaciones/obtenerEvidencias/" + clave + "/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(searchEvidenciasCriterio35){
                var existe = searchEvidenciasCriterio35.response;
                // console.log(existe);
                // Consulta para obtener el valor del punto del criterio...
                consultarDatos({
                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionAdministracion/acreditaciones/puntos/" + criterio + "/" + objetivo,
                    type: 'GET',
                    dataType: 'json',
                    ok: function(puntosCriterio35){
                        puntos = puntosCriterio35.response[0].puntos;
                        // console.log(puntos); // Comentamos para futuras pruebas...
                        var evidencias = [];
                        var serieEvidencias = "";
                        $('input.evidenciasCriterio35:checked').each(function(){
                            evidencias.push(this.value);
                        });
                        for(var i = 0; i < evidencias.length; i++){
                            var serieEvidencias = evidencias.join(',');
                        }
                        // console.log(serieEvidencias);
                        var cantidadEvidencias = $('#txtCantidadCriterio35').val();
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
                                    url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionAdministracion/acreditaciones/savePuntos",
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
                                            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionAdministracion/acreditaciones/getEvidenciasAcreditaciones/" + clave + "/" + year + "/" + criterio,
                                            type: 'GET',
                                            dataType: 'json',
                                            ok: function(getEvidenciasCriterio35){
                                                var getPuntos = getEvidenciasCriterio35.response[0];
                                                // console.log(getPuntos);
                                                $.ajax({
                                                    type: 'PUT',
                                                    url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionAdministracion/acreditaciones/updateDatosPuntos",
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
                                                        $('#modalEvidenciasCriterio35').modal('hide');
                                                        verTablaCriterio35(year, 35);
                                                    }
                                                });
                                            },
                                        });
                                    }
                                });
                            }else{
                                $.ajax({
                                    type: 'PUT',
                                    url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionAdministracion/acreditaciones/updateDatos",
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
                                            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionAdministracion/acreditaciones/getEvidenciasAcreditaciones/" + clave + "/" + year + "/" + criterio,
                                            type: 'GET',
                                            dataType: 'json',
                                            ok: function(getEvidenciasCriterio35){
                                                var getPuntos = getEvidenciasCriterio35.response[0];
                                                // console.log(getPuntos);
                                                $.ajax({
                                                    type: 'PUT',
                                                    url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionAdministracion/acreditaciones/updateDatosPuntos",
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
                                                        $('#modalEvidenciasCriterio35').modal('hide');
                                                        verTablaCriterio35(year, 35);
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
