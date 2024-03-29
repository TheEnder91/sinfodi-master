<div class="table-responsive" width = "100%" id="table_refresh">
    <table id="tblCriterio19" class="table table-bordered table-striped" style="font-size:13px;">
        <caption style="font-size:13px;">Registro de diseño industrial otorgado (Valor del punto: 15).</caption>
        <thead>
            <tr class="text-center">
                <th scope="col" style="font-size:13px;">Clave</th>
                <th scope="col" style="font-size:13px;">Nombre</th>
                <th scope="col" style="font-size:13px;">Puntos</th>
                <th scope="col" style="font-size:13px;">Total</th>
                <th scope="col" style="font-size:13px;">Año</th>
                {{-- @if (Auth::user()->hasPermissionTo("estimulo-evaluaciones-general-transferencia-index")) --}}
                    <th scope="col" style="font-size:13px;">Evidencias</th>
                {{-- @endif --}}
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
@include('estimulos.evaluaciones.direcionGeneral.transferencia.modalEvidenciasCriterio19')

<script>
    function obtenerCriterio19(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/transferencia/searchTransferencia/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosCritero19){
                var datosCriterio19 = datosCritero19.response;
                // console.log(datosCritero19);
                // Codigo para guardar en el sistema...
                if(datosCriterio19.length > 0){
                    for(var i = 0; i < datosCriterio19.length; i++){
                        var dataCriterio19 = datosCriterio19[i];
                        verTablaCriterio19(year, criterio);
                        // console.log(dataCriterio19);
                        // $.ajax({
                        //     type: 'POST',
                        //     url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/investigacion/saveDatosInvestigacion",
                        //     data: {
                        //         token: $('#txtTokenRepo').val(),
                        //         clave: dataCriterio19.numero_personal,
                        //         nombre: dataCriterio19.nombre,
                        //         id_objetivo: 5,
                        //         id_criterio: 19,
                        //         direccion: "DGeneral",
                        //         puntos: 0,
                        //         total_puntos: 0,
                        //         year: year,
                        //         username: dataCriterio19.username,
                        //     },
                        //     headers: {
                        //         'token' : $('#txtTokenRepo').val() ? $('#txtTokenRepo').val(): ''
                        //     },
                        //     success: function(data){
                        //         verTablaCriterio19(year, criterio);
                        //     }
                        // });
                    }
                }else{
                    verTablaCriterio19(year, criterio);
                }
            },
        });
    }

    function verTablaCriterio19(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/transferencia/datosTransferencia/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosGeneralCriterio19){
                // console.log(datosGeneralCriterio19);
                var datosGeneralCriterio19 = datosGeneralCriterio19.response;
                var row = "";
                for(var i = 0; i < datosGeneralCriterio19.length; i++){
                    var dataGeneralCriterio19 = datosGeneralCriterio19[i];
                    // console.log(dataGeneralCriterio19);
                    var authUser = '<?= Auth::user()->usuario ?>';
                    var permissions = '<?= Auth::user()->hasPermissionTo("estimulo-evaluaciones-general-transferencia-index") ?>';
                    // console.log(permissions);
                    if(dataGeneralCriterio19.username == authUser || permissions == 1){
                        row += "<tr>";
                        row += '<th scope="row" class="text-center" width="10%" style="font-size:12px;">' + dataGeneralCriterio19.clave + '</td>';
                        row += '<td width="40%" style="font-size:12px;">' + dataGeneralCriterio19.nombre + "</td>";
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + dataGeneralCriterio19.puntos + '</td>';
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + dataGeneralCriterio19.total_puntos + '</td>';
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + dataGeneralCriterio19.year + '</td>';
                        // if(permissions == 1){
                            row += '<td class="text-center" width="10%" style="font-size:12px;"><a href="javascript:verEvidenciasCriterio19(' + dataGeneralCriterio19.year + ', ' + dataGeneralCriterio19.clave + ', ' + 19 +')"><i class="fa fa-edit"></i></a></td>';
                        // }
                        row += "</tr>";
                    }
                }
                if ($.fn.dataTable.isDataTable("#tblCriterio19")) {
                    tblDifusionDivulgacion = $("#tblCriterio19").DataTable();
                    tblDifusionDivulgacion.destroy();
                }
                $('#tblCriterio19 > tbody').html('');
                $('#tblCriterio19 > tbody').append(row);
                $('#tblCriterio19').DataTable({
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

    function verEvidenciasCriterio19(year, clave, criterio){
        var objetivo = 5;
        $('#txtCantidadCriterio19').val(0);
        $('#txtTotalCriterio19').val(0);
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/transferencia/searchEvidenciasTransferencia/" + year + "/" + clave + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(dataEvidenciasCriterio19){
                // console.log(dataEvidenciasCriterio19); //Comentamos para futuras pruebas...
                $('#modalEvidenciasCriterio19').modal({backdrop: 'static', keyboard: false});
                consultarDatos({
                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/transferencia/puntosTransferencia/" + criterio + "/" + objetivo,
                    type: 'GET',
                    dataType: 'json',
                    ok: function(puntosCriterio19){
                        puntos = puntosCriterio19.response[0].puntos;
                        // console.log(puntos); // Comentamos para futuras pruebas...
                        $('#txtValorCriterio19').val(puntos);
                        var datos = dataEvidenciasCriterio19.response;
                        var row = "";
                        $('#claveCriterio19').val(clave);
                        $('#txtYearCriterio19').val(year);
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
                            row += '<b><input type="checkbox" class="evidenciasCriterio19" name="evidenciasCriterio19[]" id="evidenciasCriterio19'+claveData.clave+'" value="'+claveData.clave+'" onClick="contarEvidenciasCriterio19('+puntos+');"> ' + claveData.clave + tipo + '</b>';
                            row += '</div>';
                        }
                        $("#contenedorCriterio19").html(row).fadeIn('slow');
                        consultarDatos({
                            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/transferencia/getEvidenciasTransferencia/" + clave + "/" + year + "/" + criterio,
                            type: 'GET',
                            dataType: 'json',
                            ok: function(getEvidenciasCriterio19){
                                var array = getEvidenciasCriterio19.response;
                                if(array.length > 0){
                                    var evidencias = [];
                                    var serieEvidencias = "";
                                    $('input.evidenciasCriterio19:checked').each(function(){
                                        evidencias.push(this.value);
                                    });
                                    let desmarcar = serieEvidencias.split(',');
                                    if(desmarcar != ""){
                                        for(var i = 0; i < desmarcar.length; i++){
                                            // console.log(desmarcar[i]);
                                            document.getElementById("evidenciasCriterio19"+desmarcar[i]).checked = false;
                                        }
                                    }
                                    $(".evidenciasCriterio19").prop("checked", this.checked);
                                    var dataEvidencias = getEvidenciasCriterio19.response[0];
                                    let str = dataEvidencias.evidencias;
                                    let arr = str.split(',');
                                    //dividir la cadena de texto por una coma
                                    // console.log(arr);
                                    for(var i = 0; i < arr.length; i++){
                                        // console.log(arr[i]);
                                        document.getElementById("evidenciasCriterio19"+arr[i]).checked = true;
                                    }
                                    $('#txtCantidadCriterio19').val(dataEvidencias.puntos);
                                    $('#txtTotalCriterio19').val(dataEvidencias.total_puntos);
                                }
                            },
                        });
                    },
                });
            },
        });
    }

    function contarEvidenciasCriterio19(puntos){
        // Parte para contar la cantidad de evidencias a la que pertenece...
        var evidencias = [];
        $('input.evidenciasCriterio19:checked').each(function(){
            evidencias.push(this.value);
        });
        var cantidad = evidencias.length;
        $('#txtCantidadCriterio19').val(cantidad);
        //Parte para sacar el total de puntos dependiendo de los evidencias a los que pertenece...
        // console.log(puntos);
        var totalPuntos = cantidad * puntos;
        $('#txtTotalCriterio19').val(totalPuntos);
    }

    function actualizarEvidenciasCriterio19(){
        var clave = $('#claveCriterio19').val();
        var year = $('#txtYearCriterio19').val();
        var cantidad = $('#txtCantidad').val();
        var total = $('#txtTotalCriterio19').val();
        var evidenciasCriterio19 = [];
        var puntos = 0;
        var criterio = 19;
        var objetivo = 5;
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/transferencia/obtenerEvidenciasTransferencia/" + clave + "/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(searchEvidenciasCriterio19){
                var existe = searchEvidenciasCriterio19.response;
                // console.log(existe);
                consultarDatos({
                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/transferencia/puntosTransferencia/" + criterio + "/" + objetivo,
                    type: 'GET',
                    dataType: 'json',
                    ok: function(puntosCriterio19){
                        puntos = puntosCriterio19.response[0].puntos;
                        // console.log(puntos); // Comentamos para futuras pruebas...
                        var evidencias = [];
                        var serieEvidencias = "";
                        $('input.evidenciasCriterio19:checked').each(function(){
                            evidencias.push(this.value);
                        });
                        for(var i = 0; i < evidencias.length; i++){
                            var serieEvidencias = evidencias.join(',');
                        }
                        // console.log(serieEvidencias);
                        var cantidadEvidencias = $('#txtCantidadCriterio19').val();
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
                                    url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/transferencia/savePuntos",
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
                                            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/transferencia/getEvidenciasTransferencia/" + clave + "/" + year + "/" + criterio,
                                            type: 'GET',
                                            dataType: 'json',
                                            ok: function(getEvidenciasCriterio19){
                                                var getPuntos = getEvidenciasCriterio19.response[0];
                                                // console.log(getPuntos);
                                                $.ajax({
                                                    type: 'PUT',
                                                    url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/transferencia/updateDatosPuntos",
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
                                                        $('#modalEvidenciasCriterio19').modal('hide');
                                                        verTablaCriterio19(year, criterio);
                                                    }
                                                });
                                            },
                                        });
                                    }
                                });
                            }else{
                                $.ajax({
                                    type: 'PUT',
                                    url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/transferencia/updateDatosTransferencia",
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
                                            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/transferencia/getEvidenciasTransferencia/" + clave + "/" + year + "/" + criterio,
                                            type: 'GET',
                                            dataType: 'json',
                                            ok: function(getEvidenciasCriterio19){
                                                var getPuntos = getEvidenciasCriterio19.response[0];
                                                // console.log(getPuntos.puntos);
                                                $.ajax({
                                                    type: 'PUT',
                                                    url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/transferencia/updateDatosPuntos",
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
                                                        $('#modalEvidenciasCriterio19').modal('hide');
                                                        verTablaCriterio19(year, criterio);
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
