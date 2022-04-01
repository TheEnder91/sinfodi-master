<div class="table-responsive" width = "100%">
    <table id="tblCriterio11" class="table table-bordered table-striped">
        <caption>Memorias nacionales en extenso con arbitraje limitado hasta un máximo de 4.</caption>
        <thead>
            <tr class="text-center">
                <th scope="col">Clave</th>
                <th scope="col">Nombre</th>
                <th scope="col">Puntos</th>
                <th scope="col">Total</th>
                <th scope="col">Año</th>
                @if (Auth::user()->hasPermissionTo("estimulo-evaluaciones-ciencia-investigacion-index"))
                    <th scope="col">Evidencias</th>
                @endif
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
@include('estimulos.evaluaciones.direccionCiencia.investigacion.modalEvidenciasCriterio11')

<script>
    function obtenerCriterio11(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/investigacion/searchInvestigacion/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosCritero11){
                var datosCriterio11 = datosCritero11.response;
                // console.log(datosCritero11);
                // Codigo para guardar en el sistema...
                for(var i = 0; i < datosCriterio11.length; i++){
                    var dataCriterio11 = datosCriterio11[i];
                    var options = {
                        action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/investigacion/saveDatosInvestigacion",
                        json: {
                            clave: dataCriterio11.numero_personal,
                            nombre: dataCriterio11.nombre,
                            id_objetivo: 3,
                            id_criterio: 11,
                            direccion: "DCiencia",
                            puntos: 0,
                            total_puntos: 0,
                            year: year,
                            username: dataCriterio11.username,
                            _token: "{{ csrf_token() }}",
                        },
                        type: 'POST',
                        dateType: 'json',
                    };
                    // console.log(options); // e comenta para futuras pruebas...
                    guardarAutomatico(options);
                    // Finaliza codigo para guardar en el sistema...
                }
                consultarDatos({
                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/investigacion/datosInvestigacion/" + year + "/" + criterio,
                    type: 'GET',
                    dataType: 'json',
                    ok: function(datosCienciaCriterio11){
                        // console.log(datosCienciaCriterio11);
                        var datosCienciaCriterio11 = datosCienciaCriterio11.response;
                        var row = "";
                        for(var i = 0; i < datosCienciaCriterio11.length; i++){
                            var dataCienciaCriterio11 = datosCienciaCriterio11[i];
                            // console.log(dataCienciaCriterio11);
                            var authUser = '<?= Auth::user()->usuario ?>';
                            var permissions = '<?= Auth::user()->hasPermissionTo("estimulo-evaluaciones-ciencia-investigacion-index") ?>';
                            // console.log(permissions);
                            if(dataCienciaCriterio11.username == authUser || permissions == 1){
                                row += "<tr>";
                                row += '<th scope="row" class="text-center" width="10%">' + dataCienciaCriterio11.clave + '</td>';
                                row += '<td width="40%">' + dataCienciaCriterio11.nombre + "</td>";
                                row += '<td class="text-center" width="10%">' + dataCienciaCriterio11.puntos + '</td>';
                                row += '<td class="text-center" width="10%">' + dataCienciaCriterio11.total_puntos + '</td>';
                                row += '<td class="text-center" width="10%">' + dataCienciaCriterio11.year + '</td>';
                                if(permissions == 1){
                                    row += '<td class="text-center" width="10%"><a href="javascript:verEvidenciasCriterio11(' + dataCienciaCriterio11.year + ', ' + dataCienciaCriterio11.clave + ', ' + 11 +')"><i class="fa fa-edit"></i></a></td>';
                                }
                                row += "</tr>";
                            }
                        }
                        if ($.fn.dataTable.isDataTable("#tblCriterio11")) {
                            tblDifusionDivulgacion = $("#tblCriterio11").DataTable();
                            tblDifusionDivulgacion.destroy();
                        }
                        $('#tblCriterio11 > tbody').html('');
                        $('#tblCriterio11 > tbody').append(row);
                        $('#tblCriterio11').DataTable({
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
            },
        });
    }

    function verEvidenciasCriterio11(year, clave, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/investigacion/searchEvidenciasInvestigacion/" + year + "/" + clave + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(dataEvidenciasCriterio11){
                // console.log(dataEvidenciasCriterio11); //Comentamos para futuras pruebas...
                consultarDatos({
                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/investigacion/getEvidenciasInvestigacion/" + clave + "/" + year + "/" + criterio,
                    type: 'GET',
                    dataType: 'json',
                    ok: function(getEvidenciasCriterio11){
                        for(var i = 0; i < getEvidenciasCriterio11.response.length; i++){
                            var seleccion = getEvidenciasCriterio11.response[i].clave_evidencia;
                            $('input[value="' + seleccion + '"]').prop('checked', true);
                        }
                    },
                });
                $('#modalEvidenciasCriterio11').modal('show');
                var datos = dataEvidenciasCriterio11.response;
                var row = "";
                $('#clave').val(clave);
                $('#year').val(year);
                for(var i = 0; i < datos.length; i++){
                    var claveData = datos[i];
                    // console.log(claveData); //Comentamos para futuras pruebas...
                    row += '<div class="col-12 col-md-2 text-center">';
                    row += '<a href="http://126.107.2.56/SINFODI/Files/SINFODI-Articulos/' + claveData.clave + '.pdf" target="_blank">';
                    row += '<img src="{{ asset('img/pdf2.png') }}" width="60px" height="60px">';
                    row += '</a><br>';
                    row += '<b><input type="checkbox" class="evidenciasCriterio11" name="evidenciasCriterio11[]" id="evidenciasCriterio11'+claveData.clave+'" value="'+claveData.clave+'"> ' + claveData.clave + '</b>';
                    row += '</div>';
                }
                $("#contenedorCriterio11").html(row).fadeIn('slow');
            },
        });
    }

    function actualizarEvidenciasCriterio11(){
        var clave = $('#clave').val();
        var year = $('#year').val();
        var evidenciasCriterio11 = [];
        var puntos = 0;
        var criterio = 11;
        var objetivo = 3;
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/investigacion/obtenerEvidenciasInvestigacion/" + clave + "/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(searchEvidenciasCriterio11){
                var existe = searchEvidenciasCriterio11.response;
                // console.log(existe);
                consultarDatos({
                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/investigacion/puntosinvestigacion/" + criterio + "/" + objetivo,
                    type: 'GET',
                    dataType: 'json',
                    ok: function(puntosCriterio11){
                        // console.log(puntosCriterio11.response[0].puntos); // Comentamos para futuras pruebas...
                        $('input.evidenciasCriterio11:checked').each(function(){
                            evidenciasCriterio11.push(this.value);
                            puntos = puntos + parseInt(puntosCriterio11.response[0].puntos);
                        });
                        if(puntos == 0){
                            swal({
                                type: 'warning',
                                title: 'Favor de seleccionar las evidencias.',
                                showConfirmButton: false,
                                timer: 1800
                            }).catch(swal.noop);
                        }else if(puntos > 40){
                            swal({
                                type: 'error',
                                title: 'Solo puede seleccionar un maximo de 4.',
                                showConfirmButton: false,
                                timer: 1800
                            }).catch(swal.noop);
                        }else{
                            if(existe == 0){
                                for(var i = 0; i < evidenciasCriterio11.length; i++){
                                    console.log(evidenciasCriterio11[i]); // Se comenta para futuras pruebas...
                                    var options = {
                                        action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/investigacion/savePuntos",
                                        json: {
                                            clave: clave,
                                            clave_evidencia: evidenciasCriterio11[i],
                                            puntos: puntos / parseInt(puntosCriterio11.response[0].puntos),
                                            total_puntos: puntos,
                                            year: year,
                                            id_criterio: criterio,
                                            _token: "{{ csrf_token() }}",
                                        },
                                        type: 'POST',
                                        dateType: 'json',
                                        mensajeConfirm: 'Se han actualizado los puntos para la evaluación.',
                                        url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/investigacion/listInvestigacion?token={{ Session::get('token') }}"
                                    };
                                    // console.log(options);
                                    peticionGeneralAjax(options);
                                }
                                actualizarDatosCienciaCriterio11(clave, year, 11);
                            }else{
                                deletePuntosEvidenciaCriterio11(clave, year, 11);
                                for(var i = 0; i < evidenciasCriterio11.length; i++){
                                    console.log(evidenciasCriterio11[i]); // Se comenta para futuras pruebas...
                                    var options = {
                                        action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/investigacion/savePuntos",
                                        json: {
                                            clave: clave,
                                            clave_evidencia: evidenciasCriterio11[i],
                                            puntos: puntos / parseInt(puntosCriterio11.response[0].puntos),
                                            total_puntos: puntos,
                                            year: year,
                                            id_criterio: criterio,
                                            _token: "{{ csrf_token() }}",
                                        },
                                        type: 'POST',
                                        dateType: 'json',
                                        mensajeConfirm: 'Se han actualizado los puntos para la evaluación.',
                                        url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/investigacion/listInvestigacion?token={{ Session::get('token') }}"
                                    };
                                    // console.log(options);
                                    peticionGeneralAjax(options);
                                }
                                actualizarDatosCienciaCriterio11(clave, year, 11);
                            }
                        }
                    },
                });
            },
        });
    }

    function actualizarDatosCienciaCriterio11(clave, year, criterio){
        // console.log(criterio);
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/investigacion/updateDatosInvestigacion/" + clave + "/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(data){
                console.log("Puntos actualizados");
            },
        });
    }

    function deletePuntosEvidenciaCriterio11(clave, year, criterio){
        var optionsDelete = {
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/investigacion/deletePuntosInvestigacion/" + clave + "/" + year + "/" + criterio,
            json: {
                _token: "{{ csrf_token() }}",
                _method: 'DELETE',
            },
            type: 'POST',
            dateType: 'json',
        };
        guardarAutomatico(optionsDelete);
    }
</script>
