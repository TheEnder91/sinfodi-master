<div class="table-responsive" width = "100%" id="table_refresh">
    <table id="tblCriterio24" class="table table-bordered table-striped" style="font-size:13px;">
        <caption style="font-size:13px;">Atención a alumnos de verano de la ciencia concluido.</caption>
        <thead>
            <tr class="text-center">
                <th scope="col" style="font-size:13px;">Clave</th>
                <th scope="col" style="font-size:13px;">Nombre</th>
                <th scope="col" style="font-size:13px;">Puntos</th>
                <th scope="col" style="font-size:13px;">Total</th>
                <th scope="col" style="font-size:13px;">Año</th>
                {{-- @if (Auth::user()->hasPermissionTo("estimulo-evaluaciones-posgrado-formacion-index")) --}}
                    <th scope="col" style="font-size:13px;">Evidencias</th>
                {{-- @endif --}}
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
@include('estimulos.evaluaciones.direccionPosgrado.formacion.modalEvidenciasCriterio24')

<script>
    function obtenerCriterio24(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/formacionRH/searchFormacionRH/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosCritero24){
                var datosCriterio24 = datosCritero24.response;
                // console.log(datosCritero24);
                // Codigo para guardar en el sistema...
                if(datosCriterio24.length > 0){
                    for(var i = 0; i < datosCriterio24.length; i++){
                        var dataCriterio24 = datosCriterio24[i];
                        // console.log(dataCriterio24);
                        consultarDatos({
                            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/formacionRH/searchUsernameFormacionRH/" + dataCriterio24.numero_personal,
                            type: 'GET',
                            dataType: 'json',
                            ok: function(datosCritero24Username){
                                // Codigo para guardar en el sistema...
                                var username = datosCritero24Username.response[0];
                                // console.log(username.clave + "->" + username.usuario);
                                $.ajax({
                                    type: 'POST',
                                    url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/formacionRH/saveDatosFormacionRH",
                                    data: {
                                        token: $('#txtTokenRepo').val(),
                                        clave: username.clave,
                                        nombre: username.nombre,
                                        id_objetivo: 6,
                                        id_criterio: 24,
                                        direccion: "DPosgrado",
                                        puntos: 0,
                                        total_puntos: 0,
                                        year: year,
                                        username: username.usuario,
                                    },
                                    headers: {
                                        'token' : $('#txtTokenRepo').val() ? $('#txtTokenRepo').val(): ''
                                    },
                                    success: function(data){
                                        verTablaCriterio24(year, 24);
                                    }
                                });
                            },
                        });
                    }
                }else{
                    verTablaCriterio24(year, 24);
                }
            },
        });
    }

    function verTablaCriterio24(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/formacionRH/datosFormacionRH/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosPosgradoCriterio24){
                // console.log(datosPosgradoCriterio24);
                var datosPosgradoCriterio24 = datosPosgradoCriterio24.response;
                var row = "";
                for(var i = 0; i < datosPosgradoCriterio24.length; i++){
                    var dataPosgradoCriterio24 = datosPosgradoCriterio24[i];
                    // console.log(dataPosgradoCriterio24);
                    var authUser = '<?= Auth::user()->usuario ?>';
                    var permissions = '<?= Auth::user()->hasPermissionTo("estimulo-evaluaciones-posgrado-formacion-index") ?>';
                    // console.log(permissions);
                    if(dataPosgradoCriterio24.username == authUser || permissions == 1){
                        row += "<tr>";
                        row += '<th scope="row" class="text-center" width="10%" style="font-size:12px;">' + dataPosgradoCriterio24.clave + '</td>';
                        row += '<td width="40%" style="font-size:12px;">' + dataPosgradoCriterio24.nombre.toUpperCase() + "</td>";
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + parseInt(dataPosgradoCriterio24.puntos) + '</td>';
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + parseInt(dataPosgradoCriterio24.total_puntos) + '</td>';
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + dataPosgradoCriterio24.year + '</td>';
                        // if(permissions == 1){
                            row += '<td class="text-center" width="10%" style="font-size:12px;"><a href="javascript:verEvidenciasCriterio24(' + dataPosgradoCriterio24.year + ', ' + dataPosgradoCriterio24.clave + ', ' + 24 +')"><i class="fa fa-edit"></i></a></td>';
                        // }
                        row += "</tr>";
                    }
                }
                if ($.fn.dataTable.isDataTable("#tblCriterio24")) {
                    tblDifusionDivulgacion = $("#tblCriterio24").DataTable();
                    tblDifusionDivulgacion.destroy();
                }
                $('#tblCriterio24 > tbody').html('');
                $('#tblCriterio24 > tbody').append(row);
                $('#tblCriterio24').DataTable({
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

    function verEvidenciasCriterio24(year, clave, criterio){
        $('#txtCantidadCriterio24').val(0);
        $('#txtTotalCriterio24').val(0);
        var objetivo = 6;
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/formacionRH/searchEvidenciasFormacionRH/" + year + "/" + clave + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(dataEvidenciasCriterio24){
                // console.log(dataEvidenciasCriterio24); //Comentamos para futuras pruebas...
                $('#modalEvidenciasCriterio24').modal({backdrop: 'static', keyboard: false});
                consultarDatos({
                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/formacionRH/puntosFormacionRH/" + criterio + "/" + objetivo,
                    type: 'GET',
                    dataType: 'json',
                    ok: function(puntosCriterio24){
                        puntos = puntosCriterio24.response[0].puntos;
                        // console.log(puntos); // Comentamos para futuras pruebas...
                        $('#txtValorCriterio24').val(puntos);
                        var datos = dataEvidenciasCriterio24.response;
                        var row = "";
                        $('#claveCriterio24').val(clave);
                        $('#txtYearCriterio24').val(year);
                        for(var i = 0; i < datos.length; i++){
                            var claveData = datos[i];
                            // console.log(claveData);
                            if(claveData.evidencias != null){
                                // Obtener la clave de la cadena de la URL...
                                var claveEvidencias = claveData.evidencias.substring(claveData.evidencias.lastIndexOf("/") + 1);
                                // var claveEvidencia = evidencias.substring(0, evidencias.indexOf('.pdf'));
                                // console.log(evidencias);
                                row += '<div class="col-12 col-md-2 text-center">';
                                row += '<a href="' + claveData.evidencias + '" target="_blank">';
                                row += '<img src="{{ asset('img/pdf2.png') }}" width="60px" height="60px"></a>';
                                row += '<br>';
                                row += '<b><input type="checkbox" class="evidenciasCriterio24" name="evidenciasCriterio24[]" id="evidenciasCriterio24'+claveEvidencias+'" value="'+claveEvidencias+'" onClick="contarEvidenciasCriterio24('+puntos+');"> ' + claveEvidencias + '</b>';
                                row += '</div>';
                            }
                        }
                        $("#contenedorCriterio24").html(row).fadeIn('slow');
                        consultarDatos({
                            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/formacionRH/getEvidenciasFormacionRH/" + clave + "/" + year + "/" + criterio,
                            type: 'GET',
                            dataType: 'json',
                            ok: function(getEvidenciasCriterio24){
                                var array = getEvidenciasCriterio24.response;
                                if(array.length > 0){
                                    var evidencias = [];
                                    var serieEvidencias = "";
                                    $('input.evidenciasCriterio24:checked').each(function(){
                                        evidencias.push(this.value);
                                    });
                                    let desmarcar = serieEvidencias.split(',');
                                    if(desmarcar != ""){
                                        for(var i = 0; i < desmarcar.length; i++){
                                            // console.log(desmarcar[i]);
                                            document.getElementById("evidenciasCriterio24"+desmarcar[i]).checked = false;
                                        }
                                    }
                                    $(".evidenciasCriterio24").prop("checked", this.checked);
                                    var dataEvidencias = getEvidenciasCriterio24.response[0];
                                    let str = dataEvidencias.evidencias;
                                    let arr = str.split(',');
                                    //dividir la cadena de texto por una coma
                                    // console.log(arr);
                                    for(var i = 0; i < arr.length; i++){
                                        // console.log(arr[i]);
                                        document.getElementById("evidenciasCriterio24"+arr[i]).checked = true;
                                    }
                                    $('#txtCantidadCriterio24').val(dataEvidencias.puntos);
                                    $('#txtTotalCriterio24').val(dataEvidencias.total_puntos);
                                }
                            },
                        });
                    },
                });
            },
        });
    }

    function contarEvidenciasCriterio24(puntos){
        // Parte para contar la cantidad de evidencias a la que pertenece...
        var evidencias = [];
        $('input.evidenciasCriterio24:checked').each(function(){
            evidencias.push(this.value);
        });
        var cantidad = evidencias.length;
        $('#txtCantidadCriterio24').val(cantidad);
        //Parte para sacar el total de puntos dependiendo de los evidencias a los que pertenece...
        // console.log(puntos);
        var totalPuntos = cantidad * puntos;
        $('#txtTotalCriterio24').val(totalPuntos);
    }

    function actualizarEvidenciasCriterio24(){
        var clave = $('#claveCriterio24').val();
        var year = $('#txtYearCriterio24').val();
        var cantidad = $('#txtCantidadCriterio24').val();
        var total = $('#txtTotalCriterio24').val();
        var evidenciasCriterio6 = [];
        var puntos = 0;
        var criterio = 24;
        var objetivo = 6;
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/posgrado/obtenerEvidenciasPosgrado/" + clave + "/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(searchEvidenciasCriterio24){
                var existe = searchEvidenciasCriterio24.response;
                // console.log(existe);
                var evidencias = [];
                var serieEvidencias = "";
                $('input.evidenciasCriterio24:checked').each(function(){
                    evidencias.push(this.value);
                });
                for(var i = 0; i < evidencias.length; i++){
                    var serieEvidencias = evidencias.join(',');
                }
                // console.log(serieEvidencias);
                var cantidadEvidencias = $('#txtCantidadCriterio24').val();
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
                            url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/formacionRH/savePuntos",
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
                                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/formacionRH/getEvidenciasFormacionRH/" + clave + "/" + year + "/" + criterio,
                                    type: 'GET',
                                    dataType: 'json',
                                    ok: function(getEvidenciasCriterio24){
                                        var getPuntos = getEvidenciasCriterio24.response[0];
                                        // console.log(getPuntos);
                                        $.ajax({
                                            type: 'PUT',
                                            url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/formacionRH/updateDatosPuntos",
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
                                                $('#modalEvidenciasCriterio24').modal('hide');
                                                verTablaCriterio24(year, criterio);
                                            }
                                        });
                                    },
                                });
                            }
                        });
                    }else{
                        $.ajax({
                            type: 'PUT',
                            url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/formacionRH/updateDatosFormacionRH",
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
                                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/formacionRH/getEvidenciasFormacionRH/" + clave + "/" + year + "/" + criterio,
                                    type: 'GET',
                                    dataType: 'json',
                                    ok: function(getEvidenciasCriterio24){
                                        var getPuntos = getEvidenciasCriterio24.response[0];
                                        // console.log(getPuntos);
                                        $.ajax({
                                            type: 'PUT',
                                            url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/formacionRH/updateDatosPuntos",
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
                                                $('#modalEvidenciasCriterio24').modal('hide');
                                                verTablaCriterio24(year, criterio);
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
