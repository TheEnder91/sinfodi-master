<div class="table-responsive" width = "100%" id="table_refresh">
    <table id="tblCriterio21" class="table table-bordered table-striped" style="font-size:13px;">
        <caption style="font-size:13px;">Derecho de autor solicitado.</caption>
        <thead>
            <tr class="text-center">
                <th scope="col" style="font-size:13px;">Clave</th>
                <th scope="col" style="font-size:13px;">Nombre</th>
                <th scope="col" style="font-size:13px;">Puntos</th>
                <th scope="col" style="font-size:13px;">Total</th>
                <th scope="col" style="font-size:13px;">Año</th>
                @if (Auth::user()->hasPermissionTo("estimulo-evaluaciones-servicios-transferencia-index"))
                    <th scope="col" style="font-size:13px;">Evidencias</th>
                @endif
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
@include('estimulos.evaluaciones.direccionServTec.transferencia.modalEvidenciasCriterio21')

<script>
    function obtenerCriterio21(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/transferencia/searchTransferencia/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosCritero21){
                var datosCriterio21 = datosCritero21.response;
                // console.log(datosCritero21);
                // Codigo para guardar en el sistema...
                if(datosCriterio21.length > 0){
                    for(var i = 0; i < datosCriterio21.length; i++){
                        var dataCriterio21 = datosCriterio21[i];
                        // console.log(dataCriterio21);
                        $.ajax({
                            type: 'POST',
                            url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/transferencia/saveDatosTransferencia",
                            data: {
                                token: $('#txtTokenRepo').val(),
                                clave: dataCriterio21.numero_personal,
                                nombre: dataCriterio21.nombre,
                                id_objetivo: 5,
                                id_criterio: 21,
                                direccion: "DServTec",
                                puntos: 0,
                                total_puntos: 0,
                                year: year,
                                username: dataCriterio21.username,
                            },
                            headers: {
                                'token' : $('#txtTokenRepo').val() ? $('#txtTokenRepo').val(): ''
                            },
                            success: function(data){
                                verTablaCriterio21(year, criterio);
                            }
                        });
                    }
                }else{
                    verTablaCriterio21(year, criterio);
                }
            },
        });
    }

    function verTablaCriterio21(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/transferencia/datosTransferencia/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosServiciosCriterio21){
                // console.log(datosServiciosCriterio21);
                var datosServiciosCriterio21 = datosServiciosCriterio21.response;
                var row = "";
                for(var i = 0; i < datosServiciosCriterio21.length; i++){
                    var dataServiciosCriterio21 = datosServiciosCriterio21[i];
                    // console.log(dataServiciosCriterio21);
                    var authUser = '<?= Auth::user()->usuario ?>';
                    var permissions = '<?= Auth::user()->hasPermissionTo("estimulo-evaluaciones-servicios-transferencia-index") ?>';
                    // console.log(permissions);
                    if(dataServiciosCriterio21.username == authUser || permissions == 1){
                        row += "<tr>";
                        row += '<th scope="row" class="text-center" width="10%" style="font-size:12px;">' + dataServiciosCriterio21.clave + '</td>';
                        row += '<td width="40%" style="font-size:12px;">' + dataServiciosCriterio21.nombre + "</td>";
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + dataServiciosCriterio21.puntos + '</td>';
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + dataServiciosCriterio21.total_puntos + '</td>';
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + dataServiciosCriterio21.year + '</td>';
                        if(permissions == 1){
                            row += '<td class="text-center" width="10%" style="font-size:12px;"><a href="javascript:verEvidenciasCriterio21(' + dataServiciosCriterio21.year + ', ' + dataServiciosCriterio21.clave + ', ' + 21 +')"><i class="fa fa-edit"></i></a></td>';
                        }
                        row += "</tr>";
                    }
                }
                if ($.fn.dataTable.isDataTable("#tblCriterio21")) {
                    tblDifusionDivulgacion = $("#tblCriterio21").DataTable();
                    tblDifusionDivulgacion.destroy();
                }
                $('#tblCriterio21 > tbody').html('');
                $('#tblCriterio21 > tbody').append(row);
                $('#tblCriterio21').DataTable({
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

    function verEvidenciasCriterio21(year, clave, criterio){
        var objetivo = 5;
        $('#txtCantidadCriterio21').val(0);
        $('#txtTotalCriterio21').val(0);
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/transferencia/searchEvidenciasTransferencia/" + year + "/" + clave + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(dataEvidenciasCriterio21){
                // console.log(dataEvidenciasCriterio21); //Comentamos para futuras pruebas...
                $('#modalEvidenciasCriterio21').modal({backdrop: 'static', keyboard: false});
                consultarDatos({
                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/transferencia/puntosTransferencia/" + criterio + "/" + objetivo,
                    type: 'GET',
                    dataType: 'json',
                    ok: function(puntosCriterio21){
                        puntos = puntosCriterio21.response[0].puntos;
                        // console.log(puntos); // Comentamos para futuras pruebas...
                        $('#txtValorCriterio21').val(puntos);
                        var datos = dataEvidenciasCriterio21.response;
                        var row = "";
                        $('#claveCriterio21').val(clave);
                        $('#txtYearCriterio21').val(year);
                        // console.log(datos);
                        for(var i = 0; i < datos.length; i++){
                            var claveData = datos[i];
                            if(claveData.status == 1){
                                var tipo = "-R";
                            }else{
                                var tipo = "-O";
                            }
                            // console.log(claveData.clave);
                            row += '<div class="col-12 col-md-2 text-center">';
                            row += '<a href="http://126.107.2.56/SINFODI/Files/SINFODI-PropiedadIntelectual/' + claveData.clave + tipo + '.pdf" target="_blank">';
                            row += '<img src="{{ asset('img/pdf2.png') }}" width="60px" height="60px">';
                            row += '</a><br>';
                            row += '<b><input type="checkbox" class="evidenciasCriterio21" name="evidenciasCriterio21[]" id="evidenciasCriterio21'+claveData.clave+'" value="'+claveData.clave+'" onClick="contarEvidenciasCriterio21('+puntos+');"> ' + claveData.clave + tipo + '</b>';
                            row += '</div>';
                        }
                        $("#contenedorCriterio21").html(row).fadeIn('slow');
                        consultarDatos({
                            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/transferencia/getEvidenciasTransferencia/" + clave + "/" + year + "/" + criterio,
                            type: 'GET',
                            dataType: 'json',
                            ok: function(getEvidenciasCriterio21){
                                var array = getEvidenciasCriterio21.response;
                                if(array.length > 0){
                                    var evidencias = [];
                                    var serieEvidencias = "";
                                    $('input.evidenciasCriterio21:checked').each(function(){
                                        evidencias.push(this.value);
                                    });
                                    let desmarcar = serieEvidencias.split(',');
                                    if(desmarcar != ""){
                                        for(var i = 0; i < desmarcar.length; i++){
                                            // console.log(desmarcar[i]);
                                            document.getElementById("evidenciasCriterio21"+desmarcar[i]).checked = false;
                                        }
                                    }
                                    $(".evidenciasCriterio21").prop("checked", this.checked);
                                    var dataEvidencias = getEvidenciasCriterio21.response[0];
                                    let str = dataEvidencias.evidencias;
                                    let arr = str.split(',');
                                    //dividir la cadena de texto por una coma
                                    // console.log(arr);
                                    for(var i = 0; i < arr.length; i++){
                                        // console.log(arr[i]);
                                        document.getElementById("evidenciasCriterio21"+arr[i]).checked = true;
                                    }
                                    $('#txtCantidadCriterio21').val(dataEvidencias.puntos);
                                    $('#txtTotalCriterio21').val(dataEvidencias.total_puntos);
                                }
                            },
                        });
                    },
                });
            },
        });
    }

    function contarEvidenciasCriterio21(puntos){
        // Parte para contar la cantidad de evidencias a la que pertenece...
        var evidencias = [];
        $('input.evidenciasCriterio21:checked').each(function(){
            evidencias.push(this.value);
        });
        var cantidad = evidencias.length;
        $('#txtCantidadCriterio21').val(cantidad);
        //Parte para sacar el total de puntos dependiendo de los evidencias a los que pertenece...
        // console.log(puntos);
        var totalPuntos = cantidad * puntos;
        $('#txtTotalCriterio21').val(totalPuntos);
    }

    function actualizarEvidenciasCriterio21(){
        var clave = $('#claveCriterio21').val();
        var year = $('#txtYearCriterio21').val();
        var cantidad = $('#txtCantidad').val();
        var total = $('#txtTotalCriterio21').val();
        var evidenciasCriterio21 = [];
        var puntos = 0;
        var criterio = 21;
        var objetivo = 5;
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/transferencia/obtenerEvidenciasTransferencia/" + clave + "/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(searchEvidenciasCriterio21){
                var existe = searchEvidenciasCriterio21.response;
                // console.log(existe);
                consultarDatos({
                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/transferencia/puntosTransferencia/" + criterio + "/" + objetivo,
                    type: 'GET',
                    dataType: 'json',
                    ok: function(puntosCriterio21){
                        puntos = puntosCriterio21.response[0].puntos;
                        // console.log(puntos); // Comentamos para futuras pruebas...
                        var evidencias = [];
                        var serieEvidencias = "";
                        $('input.evidenciasCriterio21:checked').each(function(){
                            evidencias.push(this.value);
                        });
                        for(var i = 0; i < evidencias.length; i++){
                            var serieEvidencias = evidencias.join(',');
                        }
                        // console.log(serieEvidencias);
                        var cantidadEvidencias = $('#txtCantidadCriterio21').val();
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
                                    url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/transferencia/savePuntos",
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
                                            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/transferencia/getEvidenciasTransferencia/" + clave + "/" + year + "/" + criterio,
                                            type: 'GET',
                                            dataType: 'json',
                                            ok: function(getEvidenciasCriterio21){
                                                var getPuntos = getEvidenciasCriterio21.response[0];
                                                // console.log(getPuntos);
                                                $.ajax({
                                                    type: 'PUT',
                                                    url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/transferencia/updateDatosPuntos",
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
                                                        $('#modalEvidenciasCriterio21').modal('hide');
                                                        verTablaCriterio21(year, criterio);
                                                    }
                                                });
                                            },
                                        });
                                    }
                                });
                            }else{
                                $.ajax({
                                    type: 'PUT',
                                    url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/transferencia/updateDatosTransferencia",
                                    data: {
                                        token: $('#txtTokenRepo').val(),
                                        clave: clave,
                                        evidencias: serieEvidencias,
                                        id_criterio: criterio,
                                        puntos: cantidadEvidencias,
                                        total_puntos: total,
                                        year: year,
                                        id_criterio: criterio
                                    },
                                    headers: {
                                        'token' : $('#txtTokenRepo').val() ? $('#txtTokenRepo').val(): ''
                                    },
                                    success: function(data){
                                        consultarDatos({
                                            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/transferencia/getEvidenciasTransferencia/" + clave + "/" + year + "/" + criterio,
                                            type: 'GET',
                                            dataType: 'json',
                                            ok: function(getEvidenciasCriterio21){
                                                var getPuntos = getEvidenciasCriterio21.response[0];
                                                // console.log(getPuntos.puntos);
                                                $.ajax({
                                                    type: 'PUT',
                                                    url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/transferencia/updateDatosPuntos",
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
                                                        $('#modalEvidenciasCriterio21').modal('hide');
                                                        verTablaCriterio21(year, criterio);
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
