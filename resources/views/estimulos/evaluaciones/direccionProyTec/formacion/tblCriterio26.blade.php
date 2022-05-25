<div class="table-responsive" width = "100%" id="table_refresh">
    <table id="tblCriterio26" class="table table-bordered table-striped" style="font-size:13px;">
        <caption style="font-size:13px;">Atención a alumnos de prácticas profesionales concluidas.</caption>
        <thead>
            <tr class="text-center">
                <th scope="col" style="font-size:13px;">Clave</th>
                <th scope="col" style="font-size:13px;">Nombre</th>
                <th scope="col" style="font-size:13px;">Puntos</th>
                <th scope="col" style="font-size:13px;">Total</th>
                <th scope="col" style="font-size:13px;">Año</th>
                {{-- @if (Auth::user()->hasPermissionTo("estimulo-evaluaciones-proyectos-formacion-index")) --}}
                    <th scope="col" style="font-size:13px;">Evidencias</th>
                {{-- @endif --}}
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
@include('estimulos.evaluaciones.direccionProyTec.formacion.modalEvidenciasCriterio26')

<script>
    function obtenerCriterio26(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionProyTec/formacionRH/searchFormacionRH/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosCritero26){
                var datosCriterio26 = datosCritero26.response;
                // console.log(datosCritero26);
                // Codigo para guardar en el sistema...
                if(datosCriterio26.length > 0){
                    for(var i = 0; i < datosCriterio26.length; i++){
                        var dataCriterio26 = datosCriterio26[i];
                        // console.log(dataCriterio26);
                        consultarDatos({
                            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionProyTec/formacionRH/searchUsernameFormacionRH/" + dataCriterio26.numero_personal,
                            type: 'GET',
                            dataType: 'json',
                            ok: function(datosCritero26Username){
                                // Codigo para guardar en el sistema...
                                var username = datosCritero26Username.response[0];
                                // console.log(username.clave + "->" + username.usuario);
                                $.ajax({
                                    type: 'POST',
                                    url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionProyTec/formacionRH/saveDatosFormacionRH",
                                    data: {
                                        token: $('#txtTokenRepo').val(),
                                        clave: username.clave,
                                        nombre: username.nombre,
                                        id_objetivo: 6,
                                        id_criterio: 26,
                                        direccion: "DProyTec",
                                        puntos: 0,
                                        total_puntos: 0,
                                        year: year,
                                        username: username.usuario,
                                    },
                                    headers: {
                                        'token' : $('#txtTokenRepo').val() ? $('#txtTokenRepo').val(): ''
                                    },
                                    success: function(data){
                                        verTablaCriterio26(year, 26);
                                    }
                                });
                            },
                        });
                    }
                }else{
                    verTablaCriterio26(year, 26);
                }
            },
        });
    }

    function verTablaCriterio26(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionProyTec/formacionRH/datosFormacionRH/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosCienciaCriterio26){
                // console.log(datosCienciaCriterio26);
                var datosCienciaCriterio26 = datosCienciaCriterio26.response;
                var row = "";
                for(var i = 0; i < datosCienciaCriterio26.length; i++){
                    var dataCienciaCriterio26 = datosCienciaCriterio26[i];
                    // console.log(dataCienciaCriterio26);
                    var authUser = '<?= Auth::user()->usuario ?>';
                    var permissions = '<?= Auth::user()->hasPermissionTo("estimulo-evaluaciones-proyectos-formacion-index") ?>';
                    // console.log(permissions);
                    if(dataCienciaCriterio26.username == authUser || permissions == 1){
                        row += "<tr>";
                        row += '<th scope="row" class="text-center" width="10%" style="font-size:12px;">' + dataCienciaCriterio26.clave + '</td>';
                        row += '<td width="40%" style="font-size:12px;">' + dataCienciaCriterio26.nombre.toUpperCase() + "</td>";
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + parseInt(dataCienciaCriterio26.puntos) + '</td>';
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + parseInt(dataCienciaCriterio26.total_puntos) + '</td>';
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + dataCienciaCriterio26.year + '</td>';
                        // if(permissions == 1){
                            row += '<td class="text-center" width="10%" style="font-size:12px;"><a href="javascript:verEvidenciasCriterio26(' + dataCienciaCriterio26.year + ', ' + dataCienciaCriterio26.clave + ', ' + 26 +')"><i class="fa fa-edit"></i></a></td>';
                        // }
                        row += "</tr>";
                    }
                }
                if ($.fn.dataTable.isDataTable("#tblCriterio26")) {
                    tblDifusionDivulgacion = $("#tblCriterio26").DataTable();
                    tblDifusionDivulgacion.destroy();
                }
                $('#tblCriterio26 > tbody').html('');
                $('#tblCriterio26 > tbody').append(row);
                $('#tblCriterio26').DataTable({
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

    function verEvidenciasCriterio26(year, clave, criterio){
        $('#txtCantidadCriterio26').val(0);
        $('#txtTotalCriterio26').val(0);
        var objetivo = 6;
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionProyTec/formacionRH/searchEvidenciasFormacionRH/" + year + "/" + clave + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(dataEvidenciasCriterio26){
                // console.log(dataEvidenciasCriterio26); //Comentamos para futuras pruebas...
                $('#modalEvidenciasCriterio26').modal({backdrop: 'static', keyboard: false});
                consultarDatos({
                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionProyTec/formacionRH/puntosFormacionRH/" + criterio + "/" + objetivo,
                    type: 'GET',
                    dataType: 'json',
                    ok: function(puntosCriterio26){
                        puntos = puntosCriterio26.response[0].puntos;
                        // console.log(puntos); // Comentamos para futuras pruebas...
                        $('#txtValorCriterio26').val(puntos);
                        var datos = dataEvidenciasCriterio26.response;
                        var row = "";
                        $('#claveCriterio26').val(clave);
                        $('#txtYearCriterio26').val(year);
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
                                row += '<b><input type="checkbox" class="evidenciasCriterio26" name="evidenciasCriterio26[]" id="evidenciasCriterio26'+claveEvidencias+'" value="'+claveEvidencias+'" onClick="contarEvidenciasCriterio26('+puntos+');"> ' + claveEvidencias + '</b>';
                                row += '</div>';
                            }
                        }
                        $("#contenedorCriterio26").html(row).fadeIn('slow');
                        consultarDatos({
                            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionProyTec/formacionRH/getEvidenciasFormacionRH/" + clave + "/" + year + "/" + criterio,
                            type: 'GET',
                            dataType: 'json',
                            ok: function(getEvidenciasCriterio26){
                                var array = getEvidenciasCriterio26.response;
                                if(array.length > 0){
                                    var evidencias = [];
                                    var serieEvidencias = "";
                                    $('input.evidenciasCriterio26:checked').each(function(){
                                        evidencias.push(this.value);
                                    });
                                    let desmarcar = serieEvidencias.split(',');
                                    if(desmarcar != ""){
                                        for(var i = 0; i < desmarcar.length; i++){
                                            // console.log(desmarcar[i]);
                                            document.getElementById("evidenciasCriterio26"+desmarcar[i]).checked = false;
                                        }
                                    }
                                    $(".evidenciasCriterio26").prop("checked", this.checked);
                                    var dataEvidencias = getEvidenciasCriterio26.response[0];
                                    let str = dataEvidencias.evidencias;
                                    let arr = str.split(',');
                                    //dividir la cadena de texto por una coma
                                    // console.log(arr);
                                    for(var i = 0; i < arr.length; i++){
                                        // console.log(arr[i]);
                                        document.getElementById("evidenciasCriterio26"+arr[i]).checked = true;
                                    }
                                    $('#txtCantidadCriterio26').val(dataEvidencias.puntos);
                                    $('#txtTotalCriterio26').val(dataEvidencias.total_puntos);
                                }
                            },
                        });
                    },
                });
            },
        });
    }

    function contarEvidenciasCriterio26(puntos){
        // Parte para contar la cantidad de evidencias a la que pertenece...
        var evidencias = [];
        $('input.evidenciasCriterio26:checked').each(function(){
            evidencias.push(this.value);
        });
        var cantidad = evidencias.length;
        $('#txtCantidadCriterio26').val(cantidad);
        //Parte para sacar el total de puntos dependiendo de los evidencias a los que pertenece...
        // console.log(puntos);
        var totalPuntos = cantidad * puntos;
        $('#txtTotalCriterio26').val(totalPuntos);
    }

    function actualizarEvidenciasCriterio26(){
        var clave = $('#claveCriterio26').val();
        var year = $('#txtYearCriterio26').val();
        var cantidad = $('#txtCantidadCriterio26').val();
        var total = $('#txtTotalCriterio26').val();
        var evidenciasCriterio6 = [];
        var puntos = 0;
        var criterio = 26;
        var objetivo = 6;
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionProyTec/posgrado/obtenerEvidenciasPosgrado/" + clave + "/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(searchEvidenciasCriterio26){
                var existe = searchEvidenciasCriterio26.response;
                // console.log(existe);
                var evidencias = [];
                var serieEvidencias = "";
                $('input.evidenciasCriterio26:checked').each(function(){
                    evidencias.push(this.value);
                });
                for(var i = 0; i < evidencias.length; i++){
                    var serieEvidencias = evidencias.join(',');
                }
                // console.log(serieEvidencias);
                var cantidadEvidencias = $('#txtCantidadCriterio26').val();
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
                            url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionProyTec/formacionRH/savePuntos",
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
                                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionProyTec/formacionRH/getEvidenciasFormacionRH/" + clave + "/" + year + "/" + criterio,
                                    type: 'GET',
                                    dataType: 'json',
                                    ok: function(getEvidenciasCriterio26){
                                        var getPuntos = getEvidenciasCriterio26.response[0];
                                        // console.log(getPuntos);
                                        $.ajax({
                                            type: 'PUT',
                                            url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionProyTec/formacionRH/updateDatosPuntos",
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
                                                $('#modalEvidenciasCriterio26').modal('hide');
                                                verTablaCriterio26(year, criterio);
                                            }
                                        });
                                    },
                                });
                            }
                        });
                    }else{
                        $.ajax({
                            type: 'PUT',
                            url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionProyTec/formacionRH/updateDatosFormacionRH",
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
                                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionProyTec/formacionRH/getEvidenciasFormacionRH/" + clave + "/" + year + "/" + criterio,
                                    type: 'GET',
                                    dataType: 'json',
                                    ok: function(getEvidenciasCriterio26){
                                        var getPuntos = getEvidenciasCriterio26.response[0];
                                        // console.log(getPuntos);
                                        $.ajax({
                                            type: 'PUT',
                                            url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionProyTec/formacionRH/updateDatosPuntos",
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
                                                $('#modalEvidenciasCriterio26').modal('hide');
                                                verTablaCriterio26(year, criterio);
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
