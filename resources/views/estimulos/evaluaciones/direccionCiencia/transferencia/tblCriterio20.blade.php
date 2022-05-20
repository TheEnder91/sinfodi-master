<div class="table-responsive" width = "100%" id="table_refresh">
    <table id="tblCriterio20" class="table table-bordered table-striped" style="font-size:13px;">
        <caption style="font-size:13px;">Derecho de autor otorgado.</caption>
        <thead>
            <tr class="text-center">
                <th scope="col" style="font-size:13px;">Clave</th>
                <th scope="col" style="font-size:13px;">Nombre</th>
                <th scope="col" style="font-size:13px;">Puntos</th>
                <th scope="col" style="font-size:13px;">Total</th>
                <th scope="col" style="font-size:13px;">Año</th>
                @if (Auth::user()->hasPermissionTo("estimulo-evaluaciones-ciencia-transferencia-index"))
                    <th scope="col" style="font-size:13px;">Evidencias</th>
                @endif
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
@include('estimulos.evaluaciones.direccionPosgrado.transferencia.modalEvidenciasCriterio20')

<script>
    function obtenerCriterio20(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/transferencia/searchTransferencia/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosCritero20){
                var datosCriterio20 = datosCritero20.response;
                // console.log(datosCritero20);
                // Codigo para guardar en el sistema...
                if(datosCriterio20.length > 0){
                    for(var i = 0; i < datosCriterio20.length; i++){
                        var dataCriterio20 = datosCriterio20[i];
                        // console.log(dataCriterio20);
                        $.ajax({
                            type: 'POST',
                            url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/transferencia/saveDatosTransferencia",
                            data: {
                                token: $('#txtTokenRepo').val(),
                                clave: dataCriterio20.numero_personal,
                                nombre: dataCriterio20.nombre,
                                id_objetivo: 5,
                                id_criterio: 20,
                                direccion: "DCiencia",
                                puntos: 0,
                                total_puntos: 0,
                                year: year,
                                username: dataCriterio20.username,
                            },
                            headers: {
                                'token' : $('#txtTokenRepo').val() ? $('#txtTokenRepo').val(): ''
                            },
                            success: function(data){
                                verTablaCriterio20(year, criterio);
                            }
                        });
                    }
                }else{
                    verTablaCriterio20(year, criterio);
                }
            },
        });
    }

    function verTablaCriterio20(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/transferencia/datosTransferencia/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosPosgradoCriterio20){
                // console.log(datosPosgradoCriterio20);
                var datosPosgradoCriterio20 = datosPosgradoCriterio20.response;
                var row = "";
                for(var i = 0; i < datosPosgradoCriterio20.length; i++){
                    var dataPosgradoCriterio20 = datosPosgradoCriterio20[i];
                    // console.log(dataPosgradoCriterio20);
                    var authUser = '<?= Auth::user()->usuario ?>';
                    var permissions = '<?= Auth::user()->hasPermissionTo("estimulo-evaluaciones-ciencia-transferencia-index") ?>';
                    // console.log(permissions);
                    if(dataPosgradoCriterio20.username == authUser || permissions == 1){
                        row += "<tr>";
                        row += '<th scope="row" class="text-center" width="10%" style="font-size:12px;">' + dataPosgradoCriterio20.clave + '</td>';
                        row += '<td width="40%" style="font-size:12px;">' + dataPosgradoCriterio20.nombre + "</td>";
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + dataPosgradoCriterio20.puntos + '</td>';
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + dataPosgradoCriterio20.total_puntos + '</td>';
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + dataPosgradoCriterio20.year + '</td>';
                        if(permissions == 1){
                            row += '<td class="text-center" width="10%" style="font-size:12px;"><a href="javascript:verEvidenciasCriterio20(' + dataPosgradoCriterio20.year + ', ' + dataPosgradoCriterio20.clave + ', ' + 20 +')"><i class="fa fa-edit"></i></a></td>';
                        }
                        row += "</tr>";
                    }
                }
                if ($.fn.dataTable.isDataTable("#tblCriterio20")) {
                    tblDifusionDivulgacion = $("#tblCriterio20").DataTable();
                    tblDifusionDivulgacion.destroy();
                }
                $('#tblCriterio20 > tbody').html('');
                $('#tblCriterio20 > tbody').append(row);
                $('#tblCriterio20').DataTable({
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

    function verEvidenciasCriterio20(year, clave, criterio){
        var objetivo = 5;
        $('#txtCantidadCriterio20').val(0);
        $('#txtTotalCriterio20').val(0);
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/transferencia/searchEvidenciasTransferencia/" + year + "/" + clave + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(dataEvidenciasCriterio20){
                // console.log(dataEvidenciasCriterio20); //Comentamos para futuras pruebas...
                $('#modalEvidenciasCriterio20').modal({backdrop: 'static', keyboard: false});
                consultarDatos({
                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/transferencia/puntosTransferencia/" + criterio + "/" + objetivo,
                    type: 'GET',
                    dataType: 'json',
                    ok: function(puntosCriterio20){
                        puntos = puntosCriterio20.response[0].puntos;
                        // console.log(puntos); // Comentamos para futuras pruebas...
                        $('#txtValorCriterio20').val(puntos);
                        var datos = dataEvidenciasCriterio20.response;
                        var row = "";
                        $('#claveCriterio20').val(clave);
                        $('#txtYearCriterio20').val(year);
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
                            row += '<b><input type="checkbox" class="evidenciasCriterio20" name="evidenciasCriterio20[]" id="evidenciasCriterio20'+claveData.clave+'" value="'+claveData.clave+'" onClick="contarEvidenciasCriterio20('+puntos+');"> ' + claveData.clave + tipo + '</b>';
                            row += '</div>';
                        }
                        $("#contenedorCriterio20").html(row).fadeIn('slow');
                        consultarDatos({
                            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/transferencia/getEvidenciasTransferencia/" + clave + "/" + year + "/" + criterio,
                            type: 'GET',
                            dataType: 'json',
                            ok: function(getEvidenciasCriterio20){
                                var array = getEvidenciasCriterio20.response;
                                if(array.length > 0){
                                    var evidencias = [];
                                    var serieEvidencias = "";
                                    $('input.evidenciasCriterio20:checked').each(function(){
                                        evidencias.push(this.value);
                                    });
                                    let desmarcar = serieEvidencias.split(',');
                                    if(desmarcar != ""){
                                        for(var i = 0; i < desmarcar.length; i++){
                                            // console.log(desmarcar[i]);
                                            document.getElementById("evidenciasCriterio20"+desmarcar[i]).checked = false;
                                        }
                                    }
                                    $(".evidenciasCriterio20").prop("checked", this.checked);
                                    var dataEvidencias = getEvidenciasCriterio20.response[0];
                                    let str = dataEvidencias.evidencias;
                                    let arr = str.split(',');
                                    //dividir la cadena de texto por una coma
                                    // console.log(arr);
                                    for(var i = 0; i < arr.length; i++){
                                        // console.log(arr[i]);
                                        document.getElementById("evidenciasCriterio20"+arr[i]).checked = true;
                                    }
                                    $('#txtCantidadCriterio20').val(dataEvidencias.puntos);
                                    $('#txtTotalCriterio20').val(dataEvidencias.total_puntos);
                                }
                            },
                        });
                    },
                });
            },
        });
    }

    function contarEvidenciasCriterio20(puntos){
        // Parte para contar la cantidad de evidencias a la que pertenece...
        var evidencias = [];
        $('input.evidenciasCriterio20:checked').each(function(){
            evidencias.push(this.value);
        });
        var cantidad = evidencias.length;
        $('#txtCantidadCriterio20').val(cantidad);
        //Parte para sacar el total de puntos dependiendo de los evidencias a los que pertenece...
        // console.log(puntos);
        var totalPuntos = cantidad * puntos;
        $('#txtTotalCriterio20').val(totalPuntos);
    }

    function actualizarEvidenciasCriterio20(){
        var clave = $('#claveCriterio20').val();
        var year = $('#txtYearCriterio20').val();
        var cantidad = $('#txtCantidad').val();
        var total = $('#txtTotalCriterio20').val();
        var evidenciasCriterio20 = [];
        var puntos = 0;
        var criterio = 20;
        var objetivo = 5;
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/transferencia/obtenerEvidenciasTransferencia/" + clave + "/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(searchEvidenciasCriterio20){
                var existe = searchEvidenciasCriterio20.response;
                // console.log(existe);
                consultarDatos({
                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/transferencia/puntosTransferencia/" + criterio + "/" + objetivo,
                    type: 'GET',
                    dataType: 'json',
                    ok: function(puntosCriterio20){
                        puntos = puntosCriterio20.response[0].puntos;
                        // console.log(puntos); // Comentamos para futuras pruebas...
                        var evidencias = [];
                        var serieEvidencias = "";
                        $('input.evidenciasCriterio20:checked').each(function(){
                            evidencias.push(this.value);
                        });
                        for(var i = 0; i < evidencias.length; i++){
                            var serieEvidencias = evidencias.join(',');
                        }
                        // console.log(serieEvidencias);
                        var cantidadEvidencias = $('#txtCantidadCriterio20').val();
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
                                    url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/transferencia/savePuntos",
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
                                            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/transferencia/getEvidenciasTransferencia/" + clave + "/" + year + "/" + criterio,
                                            type: 'GET',
                                            dataType: 'json',
                                            ok: function(getEvidenciasCriterio20){
                                                var getPuntos = getEvidenciasCriterio20.response[0];
                                                // console.log(getPuntos);
                                                $.ajax({
                                                    type: 'PUT',
                                                    url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/transferencia/updateDatosPuntos",
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
                                                        $('#modalEvidenciasCriterio20').modal('hide');
                                                        verTablaCriterio20(year, criterio);
                                                    }
                                                });
                                            },
                                        });
                                    }
                                });
                            }else{
                                $.ajax({
                                    type: 'PUT',
                                    url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/transferencia/updateDatosTransferencia",
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
                                            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/transferencia/getEvidenciasTransferencia/" + clave + "/" + year + "/" + criterio,
                                            type: 'GET',
                                            dataType: 'json',
                                            ok: function(getEvidenciasCriterio20){
                                                var getPuntos = getEvidenciasCriterio20.response[0];
                                                // console.log(getPuntos.puntos);
                                                $.ajax({
                                                    type: 'PUT',
                                                    url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/transferencia/updateDatosPuntos",
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
                                                        $('#modalEvidenciasCriterio20').modal('hide');
                                                        verTablaCriterio20(year, criterio);
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
