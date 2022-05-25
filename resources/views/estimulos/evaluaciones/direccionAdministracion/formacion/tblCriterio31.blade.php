<div class="table-responsive" width = "100%" id="table_refresh">
    <table id="tblCriterio31" class="table table-bordered table-striped" style="font-size:13px;">
        <caption style="font-size:13px;">Atención a alumnos de tesis de doctorado concluida.</caption>
        <thead>
            <tr class="text-center">
                <th scope="col" style="font-size:13px;">Clave</th>
                <th scope="col" style="font-size:13px;">Nombre</th>
                <th scope="col" style="font-size:13px;">Puntos</th>
                <th scope="col" style="font-size:13px;">Total</th>
                <th scope="col" style="font-size:13px;">Año</th>
                {{-- @if (Auth::user()->hasPermissionTo("estimulo-evaluaciones-administracion-formacion-index")) --}}
                    <th scope="col" style="font-size:13px;">Evidencias</th>
                {{-- @endif --}}
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
@include('estimulos.evaluaciones.direccionAdministracion.formacion.modalEvidenciasCriterio31')

<script>
    function obtenerCriterio31(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionAdministracion/formacionRH/searchFormacionRH/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosCritero31){
                var datosCriterio31 = datosCritero31.response;
                // console.log(datosCritero31);
                // Codigo para guardar en el sistema...
                if(datosCriterio31.length > 0){
                    for(var i = 0; i < datosCriterio31.length; i++){
                        var dataCriterio31 = datosCriterio31[i];
                        // console.log(dataCriterio31);
                        consultarDatos({
                            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionAdministracion/formacionRH/searchUsernameFormacionRH/" + dataCriterio31.numero_personal,
                            type: 'GET',
                            dataType: 'json',
                            ok: function(datosCritero31Username){
                                // Codigo para guardar en el sistema...
                                var username = datosCritero31Username.response[0];
                                // console.log(username.clave + "->" + username.usuario);
                                $.ajax({
                                    type: 'POST',
                                    url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionAdministracion/formacionRH/saveDatosFormacionRH",
                                    data: {
                                        token: $('#txtTokenRepo').val(),
                                        clave: username.clave,
                                        nombre: username.nombre,
                                        id_objetivo: 6,
                                        id_criterio: 31,
                                        direccion: "DAdministracion",
                                        puntos: 0,
                                        total_puntos: 0,
                                        year: year,
                                        username: username.usuario,
                                    },
                                    headers: {
                                        'token' : $('#txtTokenRepo').val() ? $('#txtTokenRepo').val(): ''
                                    },
                                    success: function(data){
                                        verTablaCriterio31(year, 31);
                                    }
                                });
                            },
                        });
                    }
                }else{
                    verTablaCriterio31(year, 31);
                }
            },
        });
    }

    function verTablaCriterio31(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionAdministracion/formacionRH/datosFormacionRH/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosAdministracionCriterio31){
                // console.log(datosAdministracionCriterio31);
                var datosAdministracionCriterio31 = datosAdministracionCriterio31.response;
                var row = "";
                for(var i = 0; i < datosAdministracionCriterio31.length; i++){
                    var dataAdministracionCriterio31 = datosAdministracionCriterio31[i];
                    // console.log(dataAdministracionCriterio31);
                    var authUser = '<?= Auth::user()->usuario ?>';
                    var permissions = '<?= Auth::user()->hasPermissionTo("estimulo-evaluaciones-administracion-formacion-index") ?>';
                    // console.log(permissions);
                    if(dataAdministracionCriterio31.username == authUser || permissions == 1){
                        row += "<tr>";
                        row += '<th scope="row" class="text-center" width="10%" style="font-size:12px;">' + dataAdministracionCriterio31.clave + '</td>';
                        row += '<td width="40%" style="font-size:12px;">' + dataAdministracionCriterio31.nombre.toUpperCase() + "</td>";
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + parseInt(dataAdministracionCriterio31.puntos) + '</td>';
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + parseInt(dataAdministracionCriterio31.total_puntos) + '</td>';
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + dataAdministracionCriterio31.year + '</td>';
                        // if(permissions == 1){
                            row += '<td class="text-center" width="10%" style="font-size:12px;"><a href="javascript:verEvidenciasCriterio31(' + dataAdministracionCriterio31.year + ', ' + dataAdministracionCriterio31.clave + ', ' + 31 +')"><i class="fa fa-edit"></i></a></td>';
                        // }
                        row += "</tr>";
                    }
                }
                if ($.fn.dataTable.isDataTable("#tblCriterio31")) {
                    tblDifusionDivulgacion = $("#tblCriterio31").DataTable();
                    tblDifusionDivulgacion.destroy();
                }
                $('#tblCriterio31 > tbody').html('');
                $('#tblCriterio31 > tbody').append(row);
                $('#tblCriterio31').DataTable({
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

    function verEvidenciasCriterio31(year, clave, criterio){
        $('#txtCantidadCriterio31').val(0);
        $('#txtTotalCriterio31').val(0);
        var objetivo = 6;
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionAdministracion/formacionRH/searchEvidenciasFormacionRH/" + year + "/" + clave + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(dataEvidenciasCriterio31){
                // console.log(dataEvidenciasCriterio31); //Comentamos para futuras pruebas...
                $('#modalEvidenciasCriterio31').modal({backdrop: 'static', keyboard: false});
                consultarDatos({
                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionAdministracion/formacionRH/puntosFormacionRH/" + criterio + "/" + objetivo,
                    type: 'GET',
                    dataType: 'json',
                    ok: function(puntosCriterio31){
                        puntos = puntosCriterio31.response[0].puntos;
                        // console.log(puntos); // Comentamos para futuras pruebas...
                        $('#txtValorCriterio31').val(puntos);
                        var datos = dataEvidenciasCriterio31.response;
                        var row = "";
                        $('#claveCriterio31').val(clave);
                        $('#txtYearCriterio31').val(year);
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
                                row += '<b><input type="checkbox" class="evidenciasCriterio31" name="evidenciasCriterio31[]" id="evidenciasCriterio31'+claveEvidencias+'" value="'+claveEvidencias+'" onClick="contarEvidenciasCriterio31('+puntos+');"> ' + claveEvidencias + '</b>';
                                row += '</div>';
                            }
                        }
                        $("#contenedorCriterio31").html(row).fadeIn('slow');
                        consultarDatos({
                            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionAdministracion/formacionRH/getEvidenciasFormacionRH/" + clave + "/" + year + "/" + criterio,
                            type: 'GET',
                            dataType: 'json',
                            ok: function(getEvidenciasCriterio31){
                                var array = getEvidenciasCriterio31.response;
                                if(array.length > 0){
                                    var evidencias = [];
                                    var serieEvidencias = "";
                                    $('input.evidenciasCriterio31:checked').each(function(){
                                        evidencias.push(this.value);
                                    });
                                    let desmarcar = serieEvidencias.split(',');
                                    if(desmarcar != ""){
                                        for(var i = 0; i < desmarcar.length; i++){
                                            // console.log(desmarcar[i]);
                                            document.getElementById("evidenciasCriterio31"+desmarcar[i]).checked = false;
                                        }
                                    }
                                    $(".evidenciasCriterio31").prop("checked", this.checked);
                                    var dataEvidencias = getEvidenciasCriterio31.response[0];
                                    let str = dataEvidencias.evidencias;
                                    let arr = str.split(',');
                                    //dividir la cadena de texto por una coma
                                    // console.log(arr);
                                    for(var i = 0; i < arr.length; i++){
                                        // console.log(arr[i]);
                                        document.getElementById("evidenciasCriterio31"+arr[i]).checked = true;
                                    }
                                    $('#txtCantidadCriterio31').val(dataEvidencias.puntos);
                                    $('#txtTotalCriterio31').val(dataEvidencias.total_puntos);
                                }
                            },
                        });
                    },
                });
            },
        });
    }

    function contarEvidenciasCriterio31(puntos){
        // Parte para contar la cantidad de evidencias a la que pertenece...
        var evidencias = [];
        $('input.evidenciasCriterio31:checked').each(function(){
            evidencias.push(this.value);
        });
        var cantidad = evidencias.length;
        $('#txtCantidadCriterio31').val(cantidad);
        //Parte para sacar el total de puntos dependiendo de los evidencias a los que pertenece...
        // console.log(puntos);
        var totalPuntos = cantidad * puntos;
        $('#txtTotalCriterio31').val(totalPuntos);
    }

    function actualizarEvidenciasCriterio31(){
        var clave = $('#claveCriterio31').val();
        var year = $('#txtYearCriterio31').val();
        var cantidad = $('#txtCantidadCriterio31').val();
        var total = $('#txtTotalCriterio31').val();
        var evidenciasCriterio6 = [];
        var puntos = 0;
        var criterio = 31;
        var objetivo = 6;
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionAdministracion/posgrado/obtenerEvidenciasPosgrado/" + clave + "/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(searchEvidenciasCriterio31){
                var existe = searchEvidenciasCriterio31.response;
                // console.log(existe);
                var evidencias = [];
                var serieEvidencias = "";
                $('input.evidenciasCriterio31:checked').each(function(){
                    evidencias.push(this.value);
                });
                for(var i = 0; i < evidencias.length; i++){
                    var serieEvidencias = evidencias.join(',');
                }
                // console.log(serieEvidencias);
                var cantidadEvidencias = $('#txtCantidadCriterio31').val();
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
                            url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionAdministracion/formacionRH/savePuntos",
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
                                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionAdministracion/formacionRH/getEvidenciasFormacionRH/" + clave + "/" + year + "/" + criterio,
                                    type: 'GET',
                                    dataType: 'json',
                                    ok: function(getEvidenciasCriterio31){
                                        var getPuntos = getEvidenciasCriterio31.response[0];
                                        // console.log(getPuntos);
                                        $.ajax({
                                            type: 'PUT',
                                            url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionAdministracion/formacionRH/updateDatosPuntos",
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
                                                $('#modalEvidenciasCriterio31').modal('hide');
                                                verTablaCriterio31(year, criterio);
                                            }
                                        });
                                    },
                                });
                            }
                        });
                    }else{
                        $.ajax({
                            type: 'PUT',
                            url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionAdministracion/formacionRH/updateDatosFormacionRH",
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
                                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionAdministracion/formacionRH/getEvidenciasFormacionRH/" + clave + "/" + year + "/" + criterio,
                                    type: 'GET',
                                    dataType: 'json',
                                    ok: function(getEvidenciasCriterio31){
                                        var getPuntos = getEvidenciasCriterio31.response[0];
                                        // console.log(getPuntos);
                                        $.ajax({
                                            type: 'PUT',
                                            url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionAdministracion/formacionRH/updateDatosPuntos",
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
                                                $('#modalEvidenciasCriterio31').modal('hide');
                                                verTablaCriterio31(year, criterio);
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
