<div class="table-responsive" width = "100%" id="table_refresh">
    <table id="tblCriterio22" class="table table-bordered table-striped" style="font-size:13px;">
        <caption style="font-size:13px;">Patente otorgada.</caption>
        <thead>
            <tr class="text-center">
                <th scope="col" style="font-size:13px;">Clave</th>
                <th scope="col" style="font-size:13px;">Nombre</th>
                <th scope="col" style="font-size:13px;">Puntos</th>
                <th scope="col" style="font-size:13px;">Total</th>
                <th scope="col" style="font-size:13px;">Año</th>
                @if (Auth::user()->hasPermissionTo("estimulo-evaluaciones-proyectos-transferencia-index"))
                    <th scope="col" style="font-size:13px;">Evidencias</th>
                @endif
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
@include('estimulos.evaluaciones.direccionProyTec.transferencia.modalEvidenciasCriterio22')

<script>
    function obtenerCriterio22(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionProyTec/transferencia/searchTransferencia/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosCritero22){
                var datosCriterio22 = datosCritero22.response;
                // console.log(datosCritero22);
                // Codigo para guardar en el sistema...
                if(datosCriterio22.length > 0){
                    for(var i = 0; i < datosCriterio22.length; i++){
                        var dataCriterio22 = datosCriterio22[i];
                        // console.log(dataCriterio22);
                        $.ajax({
                            type: 'POST',
                            url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionProyTec/transferencia/saveDatosTransferencia",
                            data: {
                                token: $('#txtTokenRepo').val(),
                                clave: dataCriterio22.numero_personal,
                                nombre: dataCriterio22.nombre,
                                id_objetivo: 5,
                                id_criterio: 22,
                                direccion: "DProyTec",
                                puntos: 0,
                                total_puntos: 0,
                                year: year,
                                username: dataCriterio22.username,
                            },
                            headers: {
                                'token' : $('#txtTokenRepo').val() ? $('#txtTokenRepo').val(): ''
                            },
                            success: function(data){
                                verTablaCriterio22(year, criterio);
                            }
                        });
                    }
                }else{
                    verTablaCriterio22(year, criterio);
                }
            },
        });
    }

    function verTablaCriterio22(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionProyTec/transferencia/datosTransferencia/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosProyectosCriterio22){
                // console.log(datosProyectosCriterio22);
                var datosProyectosCriterio22 = datosProyectosCriterio22.response;
                var row = "";
                for(var i = 0; i < datosProyectosCriterio22.length; i++){
                    var dataProyectosCriterio22 = datosProyectosCriterio22[i];
                    // console.log(dataProyectosCriterio22);
                    var authUser = '<?= Auth::user()->usuario ?>';
                    var permissions = '<?= Auth::user()->hasPermissionTo("estimulo-evaluaciones-proyectos-transferencia-index") ?>';
                    // console.log(permissions);
                    if(dataProyectosCriterio22.username == authUser || permissions == 1){
                        row += "<tr>";
                        row += '<th scope="row" class="text-center" width="10%" style="font-size:12px;">' + dataProyectosCriterio22.clave + '</td>';
                        row += '<td width="40%" style="font-size:12px;">' + dataProyectosCriterio22.nombre.toUpperCase() + "</td>";
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + parseInt(dataProyectosCriterio22.puntos) + '</td>';
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + parseInt(dataProyectosCriterio22.total_puntos) + '</td>';
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + dataProyectosCriterio22.year + '</td>';
                        if(permissions == 1){
                            row += '<td class="text-center" width="10%" style="font-size:12px;"><a href="javascript:verEvidenciasCriterio22(' + dataProyectosCriterio22.year + ', ' + dataProyectosCriterio22.clave + ', ' + 22 +')"><i class="fa fa-edit"></i></a></td>';
                        }
                        row += "</tr>";
                    }
                }
                if ($.fn.dataTable.isDataTable("#tblCriterio22")) {
                    tblDifusionDivulgacion = $("#tblCriterio22").DataTable();
                    tblDifusionDivulgacion.destroy();
                }
                $('#tblCriterio22 > tbody').html('');
                $('#tblCriterio22 > tbody').append(row);
                $('#tblCriterio22').DataTable({
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

    function verEvidenciasCriterio22(year, clave, criterio){
        var objetivo = 5;
        $('#txtCantidadCriterio22').val(0);
        $('#txtTotalCriterio22').val(0);
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionProyTec/transferencia/searchEvidenciasTransferencia/" + year + "/" + clave + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(dataEvidenciasCriterio22){
                // console.log(dataEvidenciasCriterio22); //Comentamos para futuras pruebas...
                $('#modalEvidenciasCriterio22').modal({backdrop: 'static', keyboard: false});
                consultarDatos({
                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionProyTec/transferencia/puntosTransferencia/" + criterio + "/" + objetivo,
                    type: 'GET',
                    dataType: 'json',
                    ok: function(puntosCriterio22){
                        puntos = puntosCriterio22.response[0].puntos;
                        // console.log(puntos); // Comentamos para futuras pruebas...
                        $('#txtValorCriterio22').val(puntos);
                        var datos = dataEvidenciasCriterio22.response;
                        var row = "";
                        $('#claveCriterio22').val(clave);
                        $('#txtYearCriterio22').val(year);
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
                            row += '<b><input type="checkbox" class="evidenciasCriterio22" name="evidenciasCriterio22[]" id="evidenciasCriterio22'+claveData.clave+'" value="'+claveData.clave+'" onClick="contarEvidenciasCriterio22('+puntos+');"> ' + claveData.clave + tipo + '</b>';
                            row += '</div>';
                        }
                        $("#contenedorCriterio22").html(row).fadeIn('slow');
                        consultarDatos({
                            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionProyTec/transferencia/getEvidenciasTransferencia/" + clave + "/" + year + "/" + criterio,
                            type: 'GET',
                            dataType: 'json',
                            ok: function(getEvidenciasCriterio22){
                                var array = getEvidenciasCriterio22.response;
                                if(array.length > 0){
                                    var evidencias = [];
                                    var serieEvidencias = "";
                                    $('input.evidenciasCriterio22:checked').each(function(){
                                        evidencias.push(this.value);
                                    });
                                    let desmarcar = serieEvidencias.split(',');
                                    if(desmarcar != ""){
                                        for(var i = 0; i < desmarcar.length; i++){
                                            // console.log(desmarcar[i]);
                                            document.getElementById("evidenciasCriterio22"+desmarcar[i]).checked = false;
                                        }
                                    }
                                    $(".evidenciasCriterio22").prop("checked", this.checked);
                                    var dataEvidencias = getEvidenciasCriterio22.response[0];
                                    let str = dataEvidencias.evidencias;
                                    let arr = str.split(',');
                                    //dividir la cadena de texto por una coma
                                    // console.log(arr);
                                    for(var i = 0; i < arr.length; i++){
                                        // console.log(arr[i]);
                                        document.getElementById("evidenciasCriterio22"+arr[i]).checked = true;
                                    }
                                    $('#txtCantidadCriterio22').val(dataEvidencias.puntos);
                                    $('#txtTotalCriterio22').val(dataEvidencias.total_puntos);
                                }
                            },
                        });
                    },
                });
            },
        });
    }

    function contarEvidenciasCriterio22(puntos){
        // Parte para contar la cantidad de evidencias a la que pertenece...
        var evidencias = [];
        $('input.evidenciasCriterio22:checked').each(function(){
            evidencias.push(this.value);
        });
        var cantidad = evidencias.length;
        $('#txtCantidadCriterio22').val(cantidad);
        //Parte para sacar el total de puntos dependiendo de los evidencias a los que pertenece...
        // console.log(puntos);
        var totalPuntos = cantidad * puntos;
        $('#txtTotalCriterio22').val(totalPuntos);
    }

    function actualizarEvidenciasCriterio22(){
        var clave = $('#claveCriterio22').val();
        var year = $('#txtYearCriterio22').val();
        var cantidad = $('#txtCantidad').val();
        var total = $('#txtTotalCriterio22').val();
        var evidenciasCriterio22 = [];
        var puntos = 0;
        var criterio = 22;
        var objetivo = 5;
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionProyTec/transferencia/obtenerEvidenciasTransferencia/" + clave + "/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(searchEvidenciasCriterio22){
                var existe = searchEvidenciasCriterio22.response;
                // console.log(existe);
                consultarDatos({
                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionProyTec/transferencia/puntosTransferencia/" + criterio + "/" + objetivo,
                    type: 'GET',
                    dataType: 'json',
                    ok: function(puntosCriterio22){
                        puntos = puntosCriterio22.response[0].puntos;
                        // console.log(puntos); // Comentamos para futuras pruebas...
                        var evidencias = [];
                        var serieEvidencias = "";
                        $('input.evidenciasCriterio22:checked').each(function(){
                            evidencias.push(this.value);
                        });
                        for(var i = 0; i < evidencias.length; i++){
                            var serieEvidencias = evidencias.join(',');
                        }
                        // console.log(serieEvidencias);
                        var cantidadEvidencias = $('#txtCantidadCriterio22').val();
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
                                    url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionProyTec/transferencia/savePuntos",
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
                                            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionProyTec/transferencia/getEvidenciasTransferencia/" + clave + "/" + year + "/" + criterio,
                                            type: 'GET',
                                            dataType: 'json',
                                            ok: function(getEvidenciasCriterio22){
                                                var getPuntos = getEvidenciasCriterio22.response[0];
                                                // console.log(getPuntos);
                                                $.ajax({
                                                    type: 'PUT',
                                                    url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionProyTec/transferencia/updateDatosPuntos",
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
                                                        $('#modalEvidenciasCriterio22').modal('hide');
                                                        verTablaCriterio22(year, criterio);
                                                    }
                                                });
                                            },
                                        });
                                    }
                                });
                            }else{
                                $.ajax({
                                    type: 'PUT',
                                    url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionProyTec/transferencia/updateDatosTransferencia",
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
                                            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionProyTec/transferencia/getEvidenciasTransferencia/" + clave + "/" + year + "/" + criterio,
                                            type: 'GET',
                                            dataType: 'json',
                                            ok: function(getEvidenciasCriterio22){
                                                var getPuntos = getEvidenciasCriterio22.response[0];
                                                // console.log(getPuntos.puntos);
                                                $.ajax({
                                                    type: 'PUT',
                                                    url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionProyTec/transferencia/updateDatosPuntos",
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
                                                        $('#modalEvidenciasCriterio22').modal('hide');
                                                        verTablaCriterio22(year, criterio);
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
