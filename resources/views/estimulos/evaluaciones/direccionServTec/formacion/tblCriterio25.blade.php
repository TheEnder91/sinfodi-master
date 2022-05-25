<div class="table-responsive" width = "100%" id="table_refresh">
    <table id="tblCriterio25" class="table table-bordered table-striped" style="font-size:13px;">
        <caption style="font-size:13px;">Atención a alumnos de servicio social concluido.</caption>
        <thead>
            <tr class="text-center">
                <th scope="col" style="font-size:13px;">Clave</th>
                <th scope="col" style="font-size:13px;">Nombre</th>
                <th scope="col" style="font-size:13px;">Puntos</th>
                <th scope="col" style="font-size:13px;">Total</th>
                <th scope="col" style="font-size:13px;">Año</th>
                {{-- @if (Auth::user()->hasPermissionTo("estimulo-evaluaciones-servicios-formacion-index")) --}}
                    <th scope="col" style="font-size:13px;">Evidencias</th>
                {{-- @endif --}}
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
@include('estimulos.evaluaciones.direccionServTec.formacion.modalEvidenciasCriterio25')

<script>
    function obtenerCriterio25(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/formacionRH/searchFormacionRH/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosCritero25){
                var datosCriterio25 = datosCritero25.response;
                // console.log(datosCritero25);
                // Codigo para guardar en el sistema...
                if(datosCriterio25.length > 0){
                    for(var i = 0; i < datosCriterio25.length; i++){
                        var dataCriterio25 = datosCriterio25[i];
                        // console.log(dataCriterio25);
                        consultarDatos({
                            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/formacionRH/searchUsernameFormacionRH/" + dataCriterio25.numero_personal,
                            type: 'GET',
                            dataType: 'json',
                            ok: function(datosCritero25Username){
                                // Codigo para guardar en el sistema...
                                var username = datosCritero25Username.response[0];
                                // console.log(username.clave + "->" + username.usuario);
                                $.ajax({
                                    type: 'POST',
                                    url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/formacionRH/saveDatosFormacionRH",
                                    data: {
                                        token: $('#txtTokenRepo').val(),
                                        clave: username.clave,
                                        nombre: username.nombre,
                                        id_objetivo: 6,
                                        id_criterio: 25,
                                        direccion: "DServTec",
                                        puntos: 0,
                                        total_puntos: 0,
                                        year: year,
                                        username: username.usuario,
                                    },
                                    headers: {
                                        'token' : $('#txtTokenRepo').val() ? $('#txtTokenRepo').val(): ''
                                    },
                                    success: function(data){
                                        verTablaCriterio25(year, 25);
                                    }
                                });
                            },
                        });
                    }
                }else{
                    verTablaCriterio25(year, 25);
                }
            },
        });
    }

    function verTablaCriterio25(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/formacionRH/datosFormacionRH/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosCienciaCriterio25){
                // console.log(datosCienciaCriterio25);
                var datosCienciaCriterio25 = datosCienciaCriterio25.response;
                var row = "";
                for(var i = 0; i < datosCienciaCriterio25.length; i++){
                    var dataCienciaCriterio25 = datosCienciaCriterio25[i];
                    // console.log(dataCienciaCriterio25);
                    var authUser = '<?= Auth::user()->usuario ?>';
                    var permissions = '<?= Auth::user()->hasPermissionTo("estimulo-evaluaciones-servicios-formacion-index") ?>';
                    // console.log(permissions);
                    if(dataCienciaCriterio25.username == authUser || permissions == 1){
                        row += "<tr>";
                        row += '<th scope="row" class="text-center" width="10%" style="font-size:12px;">' + dataCienciaCriterio25.clave + '</td>';
                        row += '<td width="40%" style="font-size:12px;">' + dataCienciaCriterio25.nombre.toUpperCase() + "</td>";
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + parseInt(dataCienciaCriterio25.puntos) + '</td>';
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + parseInt(dataCienciaCriterio25.total_puntos) + '</td>';
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + dataCienciaCriterio25.year + '</td>';
                        // if(permissions == 1){
                            row += '<td class="text-center" width="10%" style="font-size:12px;"><a href="javascript:verEvidenciasCriterio25(' + dataCienciaCriterio25.year + ', ' + dataCienciaCriterio25.clave + ', ' + 25 +')"><i class="fa fa-edit"></i></a></td>';
                        // }
                        row += "</tr>";
                    }
                }
                if ($.fn.dataTable.isDataTable("#tblCriterio25")) {
                    tblDifusionDivulgacion = $("#tblCriterio25").DataTable();
                    tblDifusionDivulgacion.destroy();
                }
                $('#tblCriterio25 > tbody').html('');
                $('#tblCriterio25 > tbody').append(row);
                $('#tblCriterio25').DataTable({
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

    function verEvidenciasCriterio25(year, clave, criterio){
        $('#txtCantidadCriterio25').val(0);
        $('#txtTotalCriterio25').val(0);
        var objetivo = 6;
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/formacionRH/searchEvidenciasFormacionRH/" + year + "/" + clave + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(dataEvidenciasCriterio25){
                // console.log(dataEvidenciasCriterio25); //Comentamos para futuras pruebas...
                $('#modalEvidenciasCriterio25').modal({backdrop: 'static', keyboard: false});
                consultarDatos({
                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/formacionRH/puntosFormacionRH/" + criterio + "/" + objetivo,
                    type: 'GET',
                    dataType: 'json',
                    ok: function(puntosCriterio25){
                        puntos = puntosCriterio25.response[0].puntos;
                        // console.log(puntos); // Comentamos para futuras pruebas...
                        $('#txtValorCriterio25').val(puntos);
                        var datos = dataEvidenciasCriterio25.response;
                        var row = "";
                        $('#claveCriterio25').val(clave);
                        $('#txtYearCriterio25').val(year);
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
                                row += '<b><input type="checkbox" class="evidenciasCriterio25" name="evidenciasCriterio25[]" id="evidenciasCriterio25'+claveEvidencias+'" value="'+claveEvidencias+'" onClick="contarEvidenciasCriterio25('+puntos+');"> ' + claveEvidencias + '</b>';
                                row += '</div>';
                            }
                        }
                        $("#contenedorCriterio25").html(row).fadeIn('slow');
                        consultarDatos({
                            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/formacionRH/getEvidenciasFormacionRH/" + clave + "/" + year + "/" + criterio,
                            type: 'GET',
                            dataType: 'json',
                            ok: function(getEvidenciasCriterio25){
                                var array = getEvidenciasCriterio25.response;
                                if(array.length > 0){
                                    var evidencias = [];
                                    var serieEvidencias = "";
                                    $('input.evidenciasCriterio25:checked').each(function(){
                                        evidencias.push(this.value);
                                    });
                                    let desmarcar = serieEvidencias.split(',');
                                    if(desmarcar != ""){
                                        for(var i = 0; i < desmarcar.length; i++){
                                            // console.log(desmarcar[i]);
                                            document.getElementById("evidenciasCriterio25"+desmarcar[i]).checked = false;
                                        }
                                    }
                                    $(".evidenciasCriterio25").prop("checked", this.checked);
                                    var dataEvidencias = getEvidenciasCriterio25.response[0];
                                    let str = dataEvidencias.evidencias;
                                    let arr = str.split(',');
                                    //dividir la cadena de texto por una coma
                                    // console.log(arr);
                                    for(var i = 0; i < arr.length; i++){
                                        // console.log(arr[i]);
                                        document.getElementById("evidenciasCriterio25"+arr[i]).checked = true;
                                    }
                                    $('#txtCantidadCriterio25').val(dataEvidencias.puntos);
                                    $('#txtTotalCriterio25').val(dataEvidencias.total_puntos);
                                }
                            },
                        });
                    },
                });
            },
        });
    }

    function contarEvidenciasCriterio25(puntos){
        // Parte para contar la cantidad de evidencias a la que pertenece...
        var evidencias = [];
        $('input.evidenciasCriterio25:checked').each(function(){
            evidencias.push(this.value);
        });
        var cantidad = evidencias.length;
        $('#txtCantidadCriterio25').val(cantidad);
        //Parte para sacar el total de puntos dependiendo de los evidencias a los que pertenece...
        // console.log(puntos);
        var totalPuntos = cantidad * puntos;
        $('#txtTotalCriterio25').val(totalPuntos);
    }

    function actualizarEvidenciasCriterio25(){
        var clave = $('#claveCriterio25').val();
        var year = $('#txtYearCriterio25').val();
        var cantidad = $('#txtCantidadCriterio25').val();
        var total = $('#txtTotalCriterio25').val();
        var evidenciasCriterio6 = [];
        var puntos = 0;
        var criterio = 25;
        var objetivo = 6;
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/posgrado/obtenerEvidenciasPosgrado/" + clave + "/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(searchEvidenciasCriterio25){
                var existe = searchEvidenciasCriterio25.response;
                // console.log(existe);
                var evidencias = [];
                var serieEvidencias = "";
                $('input.evidenciasCriterio25:checked').each(function(){
                    evidencias.push(this.value);
                });
                for(var i = 0; i < evidencias.length; i++){
                    var serieEvidencias = evidencias.join(',');
                }
                // console.log(serieEvidencias);
                var cantidadEvidencias = $('#txtCantidadCriterio25').val();
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
                            url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/formacionRH/savePuntos",
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
                                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/formacionRH/getEvidenciasFormacionRH/" + clave + "/" + year + "/" + criterio,
                                    type: 'GET',
                                    dataType: 'json',
                                    ok: function(getEvidenciasCriterio25){
                                        var getPuntos = getEvidenciasCriterio25.response[0];
                                        // console.log(getPuntos);
                                        $.ajax({
                                            type: 'PUT',
                                            url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/formacionRH/updateDatosPuntos",
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
                                                $('#modalEvidenciasCriterio25').modal('hide');
                                                verTablaCriterio25(year, criterio);
                                            }
                                        });
                                    },
                                });
                            }
                        });
                    }else{
                        $.ajax({
                            type: 'PUT',
                            url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/formacionRH/updateDatosFormacionRH",
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
                                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/formacionRH/getEvidenciasFormacionRH/" + clave + "/" + year + "/" + criterio,
                                    type: 'GET',
                                    dataType: 'json',
                                    ok: function(getEvidenciasCriterio25){
                                        var getPuntos = getEvidenciasCriterio25.response[0];
                                        // console.log(getPuntos);
                                        $.ajax({
                                            type: 'PUT',
                                            url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/formacionRH/updateDatosPuntos",
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
                                                $('#modalEvidenciasCriterio25').modal('hide');
                                                verTablaCriterio25(year, criterio);
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
