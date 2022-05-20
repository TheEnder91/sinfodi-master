<div class="table-responsive" width = "100%" id="table_refresh">
    <table id="tblCriterio6" class="table table-bordered table-striped" style="font-size:13px;">
        <caption style="font-size:13px;">Publicación de Artículos en revistas de circulación internacional con arbitraje, factor de impacto hasta 2.0.</caption>
        <thead>
            <tr class="text-center">
                <th scope="col" style="font-size:13px;">Clave</th>
                <th scope="col" style="font-size:13px;">Nombre</th>
                <th scope="col" style="font-size:13px;">Puntos</th>
                <th scope="col" style="font-size:13px;">Total</th>
                <th scope="col" style="font-size:13px;">Año</th>
                @if (Auth::user()->hasPermissionTo("estimulo-evaluaciones-proyectos-investigacion-index"))
                    <th scope="col" style="font-size:13px;">Evidencias</th>
                @endif
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
@include('estimulos.evaluaciones.direccionProyTec.investigacion.modalEvidenciasCriterio6')

<script>
    function obtenerCriterio6(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionProyTec/investigacion/searchInvestigacion/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosCritero6){
                var datosCriterio6 = datosCritero6.response;
                // console.log(datosCritero6);
                // Codigo para guardar en el sistema...
                if(datosCriterio6.length > 0){
                    for(var i = 0; i < datosCriterio6.length; i++){
                        var dataCriterio6 = datosCriterio6[i];
                        // console.log(dataCriterio6);
                        $.ajax({
                            type: 'POST',
                            url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionProyTec/investigacion/saveDatosInvestigacion",
                            data: {
                                token: $('#txtTokenRepo').val(),
                                clave: dataCriterio6.numero_personal,
                                nombre: dataCriterio6.nombre,
                                id_objetivo: 3,
                                id_criterio: 6,
                                direccion: "DProyTec",
                                puntos: 0,
                                total_puntos: 0,
                                year: year,
                                username: dataCriterio6.username,
                            },
                            headers: {
                                'token' : $('#txtTokenRepo').val() ? $('#txtTokenRepo').val(): ''
                            },
                            success: function(data){
                                verTablaCriterio6(year, criterio);
                            }
                        });
                    }
                }else{
                    verTablaCriterio6(year, criterio);
                }
            },
        });
    }

    function verTablaCriterio6(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionProyTec/investigacion/datosInvestigacion/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosCienciaCriterio6){
                // console.log(datosCienciaCriterio6);
                var datosCienciaCriterio6 = datosCienciaCriterio6.response;
                var row = "";
                for(var i = 0; i < datosCienciaCriterio6.length; i++){
                    var dataCienciaCriterio6 = datosCienciaCriterio6[i];
                    // console.log(dataCienciaCriterio6);
                    var authUser = '<?= Auth::user()->usuario ?>';
                    var permissions = '<?= Auth::user()->hasPermissionTo("estimulo-evaluaciones-proyectos-investigacion-index") ?>';
                    // console.log(permissions);
                    if(dataCienciaCriterio6.username == authUser || permissions == 1){
                        row += "<tr>";
                        row += '<th scope="row" class="text-center" width="10%" style="font-size:12px;">' + dataCienciaCriterio6.clave + '</td>';
                        row += '<td width="40%" style="font-size:12px;">' + dataCienciaCriterio6.nombre.toUpperCase() + "</td>";
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + parseInt(dataCienciaCriterio6.puntos) + '</td>';
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + parseInt(dataCienciaCriterio6.total_puntos) + '</td>';
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + dataCienciaCriterio6.year + '</td>';
                        if(permissions == 1){
                            row += '<td class="text-center" width="10%" style="font-size:12px;"><a href="javascript:verEvidenciasCriterio6(' + dataCienciaCriterio6.year + ', ' + dataCienciaCriterio6.clave + ', ' + 6 +')"><i class="fa fa-edit"></i></a></td>';
                        }
                        row += "</tr>";
                    }
                }
                if ($.fn.dataTable.isDataTable("#tblCriterio6")) {
                    tblDifusionDivulgacion = $("#tblCriterio6").DataTable();
                    tblDifusionDivulgacion.destroy();
                }
                $('#tblCriterio6 > tbody').html('');
                $('#tblCriterio6 > tbody').append(row);
                $('#tblCriterio6').DataTable({
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

    function verEvidenciasCriterio6(year, clave, criterio){
        var objetivo = 3;
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionProyTec/investigacion/searchEvidenciasInvestigacion/" + year + "/" + clave + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(dataEvidenciasCriterio6){
                // console.log(dataEvidenciasCriterio6); //Comentamos para futuras pruebas...
                $('#modalEvidenciasCriterio6').modal({backdrop: 'static', keyboard: false});
                consultarDatos({
                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionProyTec/investigacion/puntosinvestigacion/" + criterio + "/" + objetivo,
                    type: 'GET',
                    dataType: 'json',
                    ok: function(puntosCriterio6){
                        puntos = puntosCriterio6.response[0].puntos;
                        // console.log(puntos); // Comentamos para futuras pruebas...
                        $('#txtValorCriterio6').val(puntos);
                        var datos = dataEvidenciasCriterio6.response;
                        var row = "";
                        $('#claveCriterio6').val(clave);
                        $('#txtYearCriterio6').val(year);
                        // console.log(datos);
                        for(var i = 0; i < datos.length; i++){
                            var claveData = datos[i];
                            row += '<div class="col-12 col-md-2 text-center">';
                            row += '<a href="http://127.106.2.56/SINFODI/Files/SINFODI-Articulos/' + claveData.clave + '.pdf" target="_blank">';
                            row += '<img src="{{ asset('img/pdf2.png') }}" width="60px" height="60px">';
                            row += '</a><br>';
                            row += '<b><input type="checkbox" class="evidenciasCriterio6" name="evidenciasCriterio6[]" id="evidenciasCriterio6'+claveData.clave+'" value="'+claveData.clave+'" onClick="contarEvidenciasCriterio6('+puntos+');"> ' + claveData.clave + '</b>';
                            row += '</div>';
                        }
                        $("#contenedorCriterio6").html(row).fadeIn('slow');
                        consultarDatos({
                            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionProyTec/investigacion/getEvidenciasInvestigacion/" + clave + "/" + year + "/" + criterio,
                            type: 'GET',
                            dataType: 'json',
                            ok: function(getEvidenciasCriterio6){
                                var array = getEvidenciasCriterio6.response;
                                if(array.length > 0){
                                    // console.log(clave);
                                    var evidencias = [];
                                    var serieEvidencias = "";
                                    $('input.evidenciasCriterio6:checked').each(function(){
                                        evidencias.push(this.value);
                                    });
                                    let desmarcar = serieEvidencias.split(',');
                                    if(desmarcar != ""){
                                        for(var i = 0; i < desmarcar.length; i++){
                                            // console.log(desmarcar[i]);
                                            document.getElementById("evidenciasCriterio6"+desmarcar[i]).checked = false;
                                        }
                                    }
                                    $(".evidenciasCriterio6").prop("checked", this.checked);
                                    var dataEvidencias = getEvidenciasCriterio6.response[0];
                                    let str = dataEvidencias.evidencias;
                                    let arr = str.split(',');
                                    //dividir la cadena de texto por una coma
                                    // console.log(arr);
                                    for(var i = 0; i < arr.length; i++){
                                        // console.log(arr[i]);
                                        document.getElementById("evidenciasCriterio6"+arr[i]).checked = true;
                                    }
                                    $('#txtCantidadCriterio6').val(dataEvidencias.puntos);
                                    $('#txtTotalCriterio6').val(dataEvidencias.total_puntos);
                                }else{
                                    $('#txtCantidadCriterio6').val(0);
                                    $('#txtTotalCriterio6').val(0);
                                }
                            },
                        });
                    },
                });
            },
        });
    }

    function contarEvidenciasCriterio6(puntos){
        // Parte para contar la cantidad de evidencias a la que pertenece...
        var evidencias = [];
        $('input.evidenciasCriterio6:checked').each(function(){
            evidencias.push(this.value);
        });
        var cantidad = evidencias.length;
        $('#txtCantidadCriterio6').val(cantidad);
        //Parte para sacar el total de puntos dependiendo de los evidencias a los que pertenece...
        // console.log(puntos);
        var totalPuntos = cantidad * puntos;
        $('#txtTotalCriterio6').val(totalPuntos);
    }

    function actualizarEvidenciasCriterio6(){
        var clave = $('#claveCriterio6').val();
        var year = $('#txtYearCriterio6').val();
        var cantidad = $('#txtCantidadCriterio6').val();
        var total = $('#txtTotalCriterio6').val();
        var evidenciasCriterio6 = [];
        var puntos = 0;
        var criterio = 6;
        var objetivo = 3;
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionProyTec/investigacion/obtenerEvidenciasInvestigacion/" + clave + "/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(searchEvidenciasCriterio6){
                var existe = searchEvidenciasCriterio6.response;
                // console.log(existe);
                consultarDatos({
                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionProyTec/investigacion/puntosinvestigacion/" + criterio + "/" + objetivo,
                    type: 'GET',
                    dataType: 'json',
                    ok: function(puntosCriterio6){
                        puntos = puntosCriterio6.response[0].puntos;
                        // console.log(puntos); // Comentamos para futuras pruebas...
                        var evidencias = [];
                        var serieEvidencias = "";
                        $('input.evidenciasCriterio6:checked').each(function(){
                            evidencias.push(this.value);
                        });
                        for(var i = 0; i < evidencias.length; i++){
                            var serieEvidencias = evidencias.join(',');
                        }
                        // console.log(serieEvidencias);
                        var cantidadEvidencias = $('#txtCantidadCriterio6').val();
                        // console.log(cantidadEvidencias);
                        if(cantidadEvidencias == 0){
                            swal({
                                type: 'warning',
                                title: 'Favor de seleccionar las evidencias.',
                                showConfirmButton: false,
                                timer: 1800
                            }).catch(swal.noop);
                        }else{
                            if(existe == 0){
                                $.ajax({
                                    type: 'POST',
                                    url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionProyTec/investigacion/savePuntos",
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
                                        consultarDatos({
                                            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionProyTec/investigacion/getEvidenciasInvestigacion/" + clave + "/" + year + "/" + criterio,
                                            type: 'GET',
                                            dataType: 'json',
                                            ok: function(getEvidenciasCriterio6){
                                                var getPuntos = getEvidenciasCriterio6.response[0];
                                                // console.log(getPuntos);
                                                $.ajax({
                                                    type: 'PUT',
                                                    url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionProyTec/investigacion/updateDatosPuntos",
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
                                                        $('#modalEvidenciasCriterio6').modal('hide');
                                                        verTablaCriterio6(year, criterio);
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
                                            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionProyTec/investigacion/getEvidenciasInvestigacion/" + clave + "/" + year + "/" + criterio,
                                            type: 'GET',
                                            dataType: 'json',
                                            ok: function(getEvidenciasCriterio6){
                                                var getPuntos = getEvidenciasCriterio6.response[0];
                                                // console.log(getPuntos);
                                                $.ajax({
                                                    type: 'PUT',
                                                    url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionProyTec/investigacion/updateDatosPuntos",
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
                                                        $('#modalEvidenciasCriterio6').modal('hide');
                                                        verTablaCriterio6(year, criterio);
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
