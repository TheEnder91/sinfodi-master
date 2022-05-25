<div class="table-responsive" width = "100%" id="table_refresh">
    <table id="tblCriterio28" class="table table-bordered table-striped" style="font-size:13px;">
        <caption style="font-size:13px;">Atención a alumnos de tesis de técnico superior universitario o equivalente.</caption>
        <thead>
            <tr class="text-center">
                <th scope="col" style="font-size:13px;">Clave</th>
                <th scope="col" style="font-size:13px;">Nombre</th>
                <th scope="col" style="font-size:13px;">Puntos</th>
                <th scope="col" style="font-size:13px;">Total</th>
                <th scope="col" style="font-size:13px;">Año</th>
                {{-- @if (Auth::user()->hasPermissionTo("estimulo-evaluaciones-ciencia-formacion-index")) --}}
                    <th scope="col" style="font-size:13px;">Evidencias</th>
                {{-- @endif --}}
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
@include('estimulos.evaluaciones.direccionCiencia.formacion.modalEvidenciasCriterio28')

<script>
    function obtenerCriterio28(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/formacionRH/searchFormacionRH/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosCritero28){
                var datosCriterio28 = datosCritero28.response;
                // console.log(datosCritero28);
                // Codigo para guardar en el sistema...
                if(datosCriterio28.length > 0){
                    for(var i = 0; i < datosCriterio28.length; i++){
                        var dataCriterio28 = datosCriterio28[i];
                        // console.log(dataCriterio28);
                        consultarDatos({
                            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/formacionRH/searchUsernameFormacionRH/" + dataCriterio28.numero_personal,
                            type: 'GET',
                            dataType: 'json',
                            ok: function(datosCritero28Username){
                                // Codigo para guardar en el sistema...
                                var username = datosCritero28Username.response[0];
                                // console.log(username.clave + "->" + username.usuario);
                                $.ajax({
                                    type: 'POST',
                                    url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/formacionRH/saveDatosFormacionRH",
                                    data: {
                                        token: $('#txtTokenRepo').val(),
                                        clave: username.clave,
                                        nombre: username.nombre,
                                        id_objetivo: 6,
                                        id_criterio: 28,
                                        direccion: "DCiencia",
                                        puntos: 0,
                                        total_puntos: 0,
                                        year: year,
                                        username: username.usuario,
                                    },
                                    headers: {
                                        'token' : $('#txtTokenRepo').val() ? $('#txtTokenRepo').val(): ''
                                    },
                                    success: function(data){
                                        verTablaCriterio28(year, 28);
                                    }
                                });
                            },
                        });
                    }
                }else{
                    verTablaCriterio28(year, 28);
                }
            },
        });
    }

    function verTablaCriterio28(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/formacionRH/datosFormacionRH/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosCienciaCriterio28){
                // console.log(datosCienciaCriterio28);
                var datosCienciaCriterio28 = datosCienciaCriterio28.response;
                var row = "";
                for(var i = 0; i < datosCienciaCriterio28.length; i++){
                    var dataCienciaCriterio28 = datosCienciaCriterio28[i];
                    // console.log(dataCienciaCriterio28);
                    var authUser = '<?= Auth::user()->usuario ?>';
                    var permissions = '<?= Auth::user()->hasPermissionTo("estimulo-evaluaciones-ciencia-formacion-index") ?>';
                    // console.log(permissions);
                    if(dataCienciaCriterio28.username == authUser || permissions == 1){
                        row += "<tr>";
                        row += '<th scope="row" class="text-center" width="10%" style="font-size:12px;">' + dataCienciaCriterio28.clave + '</td>';
                        row += '<td width="40%" style="font-size:12px;">' + dataCienciaCriterio28.nombre.toUpperCase() + "</td>";
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + parseInt(dataCienciaCriterio28.puntos) + '</td>';
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + parseInt(dataCienciaCriterio28.total_puntos) + '</td>';
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + dataCienciaCriterio28.year + '</td>';
                        // if(permissions == 1){
                            row += '<td class="text-center" width="10%" style="font-size:12px;"><a href="javascript:verEvidenciasCriterio28(' + dataCienciaCriterio28.year + ', ' + dataCienciaCriterio28.clave + ', ' + 28 +')"><i class="fa fa-edit"></i></a></td>';
                        // }
                        row += "</tr>";
                    }
                }
                if ($.fn.dataTable.isDataTable("#tblCriterio28")) {
                    tblDifusionDivulgacion = $("#tblCriterio28").DataTable();
                    tblDifusionDivulgacion.destroy();
                }
                $('#tblCriterio28 > tbody').html('');
                $('#tblCriterio28 > tbody').append(row);
                $('#tblCriterio28').DataTable({
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

    function verEvidenciasCriterio28(year, clave, criterio){
        $('#txtCantidadCriterio28').val(0);
        $('#txtTotalCriterio28').val(0);
        var objetivo = 6;
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/formacionRH/searchEvidenciasFormacionRH/" + year + "/" + clave + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(dataEvidenciasCriterio28){
                // console.log(dataEvidenciasCriterio28); //Comentamos para futuras pruebas...
                $('#modalEvidenciasCriterio28').modal({backdrop: 'static', keyboard: false});
                consultarDatos({
                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/formacionRH/puntosFormacionRH/" + criterio + "/" + objetivo,
                    type: 'GET',
                    dataType: 'json',
                    ok: function(puntosCriterio28){
                        puntos = puntosCriterio28.response[0].puntos;
                        // console.log(puntos); // Comentamos para futuras pruebas...
                        $('#txtValorCriterio28').val(puntos);
                        var datos = dataEvidenciasCriterio28.response;
                        var row = "";
                        $('#claveCriterio28').val(clave);
                        $('#txtYearCriterio28').val(year);
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
                                row += '<b><input type="checkbox" class="evidenciasCriterio28" name="evidenciasCriterio28[]" id="evidenciasCriterio28'+claveEvidencias+'" value="'+claveEvidencias+'" onClick="contarEvidenciasCriterio28('+puntos+');"> ' + claveEvidencias + '</b>';
                                row += '</div>';
                            }
                        }
                        $("#contenedorCriterio28").html(row).fadeIn('slow');
                        consultarDatos({
                            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/formacionRH/getEvidenciasFormacionRH/" + clave + "/" + year + "/" + criterio,
                            type: 'GET',
                            dataType: 'json',
                            ok: function(getEvidenciasCriterio28){
                                var array = getEvidenciasCriterio28.response;
                                if(array.length > 0){
                                    var evidencias = [];
                                    var serieEvidencias = "";
                                    $('input.evidenciasCriterio28:checked').each(function(){
                                        evidencias.push(this.value);
                                    });
                                    let desmarcar = serieEvidencias.split(',');
                                    if(desmarcar != ""){
                                        for(var i = 0; i < desmarcar.length; i++){
                                            // console.log(desmarcar[i]);
                                            document.getElementById("evidenciasCriterio28"+desmarcar[i]).checked = false;
                                        }
                                    }
                                    $(".evidenciasCriterio28").prop("checked", this.checked);
                                    var dataEvidencias = getEvidenciasCriterio28.response[0];
                                    let str = dataEvidencias.evidencias;
                                    let arr = str.split(',');
                                    //dividir la cadena de texto por una coma
                                    // console.log(arr);
                                    for(var i = 0; i < arr.length; i++){
                                        // console.log(arr[i]);
                                        document.getElementById("evidenciasCriterio28"+arr[i]).checked = true;
                                    }
                                    $('#txtCantidadCriterio28').val(dataEvidencias.puntos);
                                    $('#txtTotalCriterio28').val(dataEvidencias.total_puntos);
                                }
                            },
                        });
                    },
                });
            },
        });
    }

    function contarEvidenciasCriterio28(puntos){
        // Parte para contar la cantidad de evidencias a la que pertenece...
        var evidencias = [];
        $('input.evidenciasCriterio28:checked').each(function(){
            evidencias.push(this.value);
        });
        var cantidad = evidencias.length;
        $('#txtCantidadCriterio28').val(cantidad);
        //Parte para sacar el total de puntos dependiendo de los evidencias a los que pertenece...
        // console.log(puntos);
        var totalPuntos = cantidad * puntos;
        $('#txtTotalCriterio28').val(totalPuntos);
    }

    function actualizarEvidenciasCriterio28(){
        var clave = $('#claveCriterio28').val();
        var year = $('#txtYearCriterio28').val();
        var cantidad = $('#txtCantidadCriterio28').val();
        var total = $('#txtTotalCriterio28').val();
        var evidenciasCriterio6 = [];
        var puntos = 0;
        var criterio = 28;
        var objetivo = 6;
        // console.log(clave);
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/posgrado/obtenerEvidenciasPosgrado/" + clave + "/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(searchEvidenciasCriterio28){
                var existe = searchEvidenciasCriterio28.response;
                // console.log(existe);
                var evidencias = [];
                var serieEvidencias = "";
                $('input.evidenciasCriterio28:checked').each(function(){
                    evidencias.push(this.value);
                });
                for(var i = 0; i < evidencias.length; i++){
                    var serieEvidencias = evidencias.join(',');
                }
                // console.log(serieEvidencias);
                var cantidadEvidencias = $('#txtCantidadCriterio28').val();
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
                            url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/formacionRH/savePuntos",
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
                                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/formacionRH/getEvidenciasFormacionRH/" + clave + "/" + year + "/" + criterio,
                                    type: 'GET',
                                    dataType: 'json',
                                    ok: function(getEvidenciasCriterio28){
                                        var getPuntos = getEvidenciasCriterio28.response[0];
                                        // console.log(getPuntos);
                                        $.ajax({
                                            type: 'PUT',
                                            url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/formacionRH/updateDatosPuntos",
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
                                                $('#modalEvidenciasCriterio28').modal('hide');
                                                verTablaCriterio28(year, criterio);
                                            }
                                        });
                                    },
                                });
                            }
                        });
                    }else{
                        $.ajax({
                            type: 'PUT',
                            url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/formacionRH/updateDatosFormacionRH",
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
                                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/formacionRH/getEvidenciasFormacionRH/" + clave + "/" + year + "/" + criterio,
                                    type: 'GET',
                                    dataType: 'json',
                                    ok: function(getEvidenciasCriterio28){
                                        var getPuntos = getEvidenciasCriterio28.response[0];
                                        // console.log(getPuntos);
                                        $.ajax({
                                            type: 'PUT',
                                            url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/formacionRH/updateDatosPuntos",
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
                                                $('#modalEvidenciasCriterio28').modal('hide');
                                                verTablaCriterio28(year, criterio);
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
