<div class="table-responsive" width = "100%">
    <table id="tblCriterio13" class="table table-bordered table-striped">
        <caption>Autor Publicación de capítulos de investigación en libros científicos en editoriales de reconocido prestigio.</caption>
        <thead>
            <tr class="text-center">
                <th scope="col">Clave</th>
                <th scope="col">Nombre</th>
                <th scope="col">Puntos</th>
                <th scope="col">Total</th>
                <th scope="col">Año</th>
                @if (Auth::user()->hasPermissionTo("estimulo-evaluaciones-posgrado-investigacion-index"))
                    <th scope="col">Evidencias</th>
                @endif
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
@include('estimulos.evaluaciones.direccionPosgrado.investigacion.modalEvidenciasCriterio13')

<script>
    function obtenerCriterio13(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/investigacion/searchInvestigacion/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosCritero13){
                var datosCriterio13 = datosCritero13.response;
                console.log(datosCritero13);
                // Codigo para guardar en el sistema...
                for(var i = 0; i < datosCriterio13.length; i++){
                    var dataCriterio13 = datosCriterio13[i];
                    var options = {
                        action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/investigacion/saveDatosInvestigacion",
                        json: {
                            clave: dataCriterio13.numero_personal,
                            nombre: dataCriterio13.nombre,
                            id_objetivo: 3,
                            id_criterio: 13,
                            direccion: "DPosgrado",
                            puntos: 0,
                            total_puntos: 0,
                            year: year,
                            username: dataCriterio13.username,
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
                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/investigacion/datosInvestigacion/" + year + "/" + criterio,
                    type: 'GET',
                    dataType: 'json',
                    ok: function(datosPosgradoCriterio13){
                        // console.log(datosPosgradoCriterio13);
                        var datosPosgradoCriterio13 = datosPosgradoCriterio13.response;
                        var row = "";
                        for(var i = 0; i < datosPosgradoCriterio13.length; i++){
                            var dataPosgradoCriterio13 = datosPosgradoCriterio13[i];
                            // console.log(dataPosgradoCriterio13);
                            var authUser = '<?= Auth::user()->usuario ?>';
                            var permissions = '<?= Auth::user()->hasPermissionTo("estimulo-evaluaciones-posgrado-investigacion-index") ?>';
                            // console.log(permissions);
                            if(dataPosgradoCriterio13.username == authUser || permissions == 1){
                                row += "<tr>";
                                row += '<th scope="row" class="text-center" width="10%">' + dataPosgradoCriterio13.clave + '</td>';
                                row += '<td width="40%">' + dataPosgradoCriterio13.nombre + "</td>";
                                row += '<td class="text-center" width="10%">' + dataPosgradoCriterio13.puntos + '</td>';
                                row += '<td class="text-center" width="10%">' + dataPosgradoCriterio13.total_puntos + '</td>';
                                row += '<td class="text-center" width="10%">' + dataPosgradoCriterio13.year + '</td>';
                                if(permissions == 1){
                                    row += '<td class="text-center" width="10%"><a href="javascript:verEvidenciasCriterio13(' + dataPosgradoCriterio13.year + ', ' + dataPosgradoCriterio13.clave + ', ' + 13 +')"><i class="fa fa-edit"></i></a></td>';
                                }
                                row += "</tr>";
                            }
                        }
                        if ($.fn.dataTable.isDataTable("#tblCriterio13")) {
                            tblDifusionDivulgacion = $("#tblCriterio13").DataTable();
                            tblDifusionDivulgacion.destroy();
                        }
                        $('#tblCriterio13 > tbody').html('');
                        $('#tblCriterio13 > tbody').append(row);
                        $('#tblCriterio13').DataTable({
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

    function verEvidenciasCriterio13(year, clave, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/investigacion/searchEvidenciasInvestigacion/" + year + "/" + clave + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(dataEvidenciasCriterio13){
                // console.log(dataEvidenciasCriterio13); //Comentamos para futuras pruebas...
                consultarDatos({
                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/investigacion/getEvidenciasInvestigacion/" + clave + "/" + year + "/" + criterio,
                    type: 'GET',
                    dataType: 'json',
                    ok: function(getEvidenciasCriterio13){
                        for(var i = 0; i < getEvidenciasCriterio13.response.length; i++){
                            var seleccion = getEvidenciasCriterio13.response[i].clave_evidencia;
                            $('input[value="' + seleccion + '"]').prop('checked', true);
                        }
                    },
                });
                $('#modalEvidenciasCriterio13').modal('show');
                var datos = dataEvidenciasCriterio13.response;
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
                    row += '<b><input type="checkbox" class="evidenciasCriterio13" name="evidenciasCriterio13[]" id="evidenciasCriterio13'+claveData.clave+'" value="'+claveData.clave+'"> ' + claveData.clave + '</b>';
                    row += '</div>';
                }
                $("#contenedorCriterio13").html(row).fadeIn('slow');
            },
        });
    }

    function actualizarEvidenciasCriterio13(){
        var clave = $('#clave').val();
        var year = $('#year').val();
        var evidenciasCriterio13 = [];
        var puntos = 0;
        var criterio = 13;
        var objetivo = 3;
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/investigacion/obtenerEvidenciasInvestigacion/" + clave + "/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(searchEvidenciasCriterio13){
                var existe = searchEvidenciasCriterio13.response;
                // console.log(existe);
                consultarDatos({
                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/investigacion/puntosinvestigacion/" + criterio + "/" + objetivo,
                    type: 'GET',
                    dataType: 'json',
                    ok: function(puntosCriterio13){
                        // console.log(puntosCriterio13.response[0].puntos); // Comentamos para futuras pruebas...
                        $('input.evidenciasCriterio13:checked').each(function(){
                            evidenciasCriterio13.push(this.value);
                            puntos = puntos + parseInt(puntosCriterio13.response[0].puntos);
                        });
                        if(puntos == 0){
                            swal({
                                type: 'warning',
                                title: 'Favor de seleccionar las evidencias.',
                                showConfirmButton: false,
                                timer: 1800
                            }).catch(swal.noop);
                        }else{
                            if(existe == 0){
                                for(var i = 0; i < evidenciasCriterio13.length; i++){
                                    console.log(evidenciasCriterio13[i]); // Se comenta para futuras pruebas...
                                    var options = {
                                        action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/investigacion/savePuntos",
                                        json: {
                                            clave: clave,
                                            clave_evidencia: evidenciasCriterio13[i],
                                            puntos: puntos / parseInt(puntosCriterio13.response[0].puntos),
                                            total_puntos: puntos,
                                            year: year,
                                            id_criterio: criterio,
                                            _token: "{{ csrf_token() }}",
                                        },
                                        type: 'POST',
                                        dateType: 'json',
                                        mensajeConfirm: 'Se han actualizado los puntos para la evaluación.',
                                        url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/investigacion/listInvestigacion?token={{ Session::get('token') }}"
                                    };
                                    // console.log(options);
                                    peticionGeneralAjax(options);
                                }
                                actualizarDatosPosgradoCriterio13(clave, year, 13);
                            }else{
                                deletePuntosEvidenciaCriterio13(clave, year, 13);
                                for(var i = 0; i < evidenciasCriterio13.length; i++){
                                    console.log(evidenciasCriterio13[i]); // Se comenta para futuras pruebas...
                                    var options = {
                                        action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/investigacion/savePuntos",
                                        json: {
                                            clave: clave,
                                            clave_evidencia: evidenciasCriterio13[i],
                                            puntos: puntos / parseInt(puntosCriterio13.response[0].puntos),
                                            total_puntos: puntos,
                                            year: year,
                                            id_criterio: criterio,
                                            _token: "{{ csrf_token() }}",
                                        },
                                        type: 'POST',
                                        dateType: 'json',
                                        mensajeConfirm: 'Se han actualizado los puntos para la evaluación.',
                                        url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/investigacion/listInvestigacion?token={{ Session::get('token') }}"
                                    };
                                    // console.log(options);
                                    peticionGeneralAjax(options);
                                }
                                actualizarDatosPosgradoCriterio13(clave, year, 13);
                            }
                        }
                    },
                });
            },
        });
    }

    function actualizarDatosPosgradoCriterio13(clave, year, criterio){
        // console.log(criterio);
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/investigacion/updateDatosInvestigacion/" + clave + "/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(data){
                console.log("Puntos actualizados");
            },
        });
    }

    function deletePuntosEvidenciaCriterio13(clave, year, criterio){
        var optionsDelete = {
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/investigacion/deletePuntosInvestigacion/" + clave + "/" + year + "/" + criterio,
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
