<div class="table-responsive" width = "100%">
    <table id="tblCriterio7" class="table table-bordered table-striped">
        <caption>Publicación de Artículos en revistas de circulación internacional con arbitraje, factor de impacto entre 2.0 y 4.0.</caption>
        <thead>
            <tr class="text-center">
                <th scope="col">Clave</th>
                <th scope="col">Nombre</th>
                <th scope="col">Puntos</th>
                <th scope="col">Total</th>
                <th scope="col">Año</th>
                @if (Auth::user()->hasPermissionTo("estimulo-evaluaciones-administracion-investigacion-index"))
                    <th scope="col">Evidencias</th>
                @endif
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
@include('estimulos.evaluaciones.direccionAdministracion.investigacion.modalEvidenciasCriterio7')

<script>
    function obtenerCriterio7(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionAdministracion/investigacion/searchInvestigacion/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosCritero7){
                var datosCriterio7 = datosCritero7.response;
                // console.log(datosCritero7);
                // Codigo para guardar en el sistema...
                for(var i = 0; i < datosCriterio7.length; i++){
                    var dataCriterio7 = datosCriterio7[i];
                    // Codigo para guardar en el sistema...
                    var options = {
                        action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionAdministracion/investigacion/saveDatosInvestigacion",
                        json: {
                            clave: dataCriterio7.numero_personal,
                            nombre: dataCriterio7.nombre,
                            id_objetivo: 3,
                            id_criterio: 7,
                            direccion: "DAdministracion",
                            puntos: 0,
                            total_puntos: 0,
                            year: year,
                            username: dataCriterio7.username,
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
                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionAdministracion/investigacion/datosInvestigacion/" + year + "/" + criterio,
                    type: 'GET',
                    dataType: 'json',
                    ok: function(datosAdministracionCriterio7){
                        // console.log(datosAdministracionCriterio7);
                        var datosAdministracionCriterio7 = datosAdministracionCriterio7.response;
                        var row = "";
                        for(var i = 0; i < datosAdministracionCriterio7.length; i++){
                            var dataAdministracionCriterio7 = datosAdministracionCriterio7[i];
                            // console.log(dataAdministracionCriterio7);
                            var authUser = '<?= Auth::user()->usuario ?>';
                            var permissions = '<?= Auth::user()->hasPermissionTo("estimulo-evaluaciones-administracion-investigacion-index") ?>';
                            // console.log(permissions);
                            if(dataAdministracionCriterio7.username == authUser || permissions == 1){
                                row += "<tr>";
                                row += '<th scope="row" class="text-center" width="10%">' + dataAdministracionCriterio7.clave + '</td>';
                                row += '<td width="40%">' + dataAdministracionCriterio7.nombre + "</td>";
                                row += '<td class="text-center" width="10%">' + dataAdministracionCriterio7.puntos + '</td>';
                                row += '<td class="text-center" width="10%">' + dataAdministracionCriterio7.total_puntos + '</td>';
                                row += '<td class="text-center" width="10%">' + dataAdministracionCriterio7.year + '</td>';
                                if(permissions == 1){
                                    row += '<td class="text-center" width="10%"><a href="javascript:verEvidenciasCriterio7(' + dataAdministracionCriterio7.year + ', ' + dataAdministracionCriterio7.clave + ', ' + 7 +')"><i class="fa fa-edit"></i></a></td>';
                                }
                                row += "</tr>";
                            }
                        }
                        if ($.fn.dataTable.isDataTable("#tblCriterio7")) {
                            tblDifusionDivulgacion = $("#tblCriterio7").DataTable();
                            tblDifusionDivulgacion.destroy();
                        }
                        $('#tblCriterio7 > tbody').html('');
                        $('#tblCriterio7 > tbody').append(row);
                        $('#tblCriterio7').DataTable({
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

    function verEvidenciasCriterio7(year, clave, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionAdministracion/investigacion/searchEvidenciasInvestigacion/" + year + "/" + clave + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(dataEvidenciasCriterio7){
                // console.log(dataEvidenciasCriterio7); //Comentamos para futuras pruebas...
                consultarDatos({
                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionAdministracion/investigacion/getEvidenciasInvestigacion/" + clave + "/" + year + "/" + criterio,
                    type: 'GET',
                    dataType: 'json',
                    ok: function(getEvidenciasCriterio7){
                        for(var i = 0; i < getEvidenciasCriterio7.response.length; i++){
                            // console.log(getEvidenciasCriterio7.response[i].clave_evidencia); // Se comenta para futuras pruebas...
                            var seleccion = getEvidenciasCriterio7.response[i].clave_evidencia;
                            $('input[value="' + seleccion + '"]').prop('checked', true);
                        }
                    },
                });
                $('#modalEvidenciasCriterio7').modal('show');
                var datos = dataEvidenciasCriterio7.response;
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
                    row += '<b><input type="checkbox" class="evidenciasCriterio7" name="evidenciasCriterio7[]" id="evidenciasCriterio7'+claveData.clave+'" value="'+claveData.clave+'"> ' + claveData.clave + '</b>';
                    row += '</div>';
                }
                $("#contenedorCriterio7").html(row).fadeIn('slow');
            },
        });
    }

    function actualizarEvidenciasCriterio7(){
        var clave = $('#clave').val();
        var year = $('#year').val();
        var evidenciasCriterio7 = [];
        var puntos = 0;
        var criterio = 7;
        var objetivo = 3;
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionAdministracion/investigacion/obtenerEvidenciasInvestigacion/" + clave + "/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(searchEvidenciasCriterio7){
                var existe = searchEvidenciasCriterio7.response;
                // console.log(existe);
                consultarDatos({
                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionAdministracion/investigacion/puntosinvestigacion/" + criterio + "/" + objetivo,
                    type: 'GET',
                    dataType: 'json',
                    ok: function(puntosCriterio7){
                        // console.log(puntosCriterio7.response[0].puntos); // Comentamos para futuras pruebas...
                        $('input.evidenciasCriterio7:checked').each(function(){
                            evidenciasCriterio7.push(this.value);
                            puntos = puntos + parseInt(puntosCriterio7.response[0].puntos);
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
                                for(var i = 0; i < evidenciasCriterio7.length; i++){
                                    console.log(evidenciasCriterio7[i]); // Se comenta para futuras pruebas...
                                    var options = {
                                        action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionAdministracion/investigacion/savePuntos",
                                        json: {
                                            clave: clave,
                                            clave_evidencia: evidenciasCriterio7[i],
                                            puntos: puntos / parseInt(puntosCriterio7.response[0].puntos),
                                            total_puntos: puntos,
                                            year: year,
                                            id_criterio: criterio,
                                            _token: "{{ csrf_token() }}",
                                        },
                                        type: 'POST',
                                        dateType: 'json',
                                        mensajeConfirm: 'Se han actualizado los puntos para la evaluación.',
                                        url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionAdministracion/investigacion/listInvestigacion?token={{ Session::get('token') }}"
                                    };
                                    // console.log(options);
                                    peticionGeneralAjax(options);
                                }
                                actualizarDatosAdministracionCriterio7(clave, year, 7)
                            }else{
                                deletePuntosEvidenciaCriterio7(clave, year, 7);
                                for(var i = 0; i < evidenciasCriterio7.length; i++){
                                    console.log(evidenciasCriterio7[i]); // Se comenta para futuras pruebas...
                                    var options = {
                                        action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionAdministracion/investigacion/savePuntos",
                                        json: {
                                            clave: clave,
                                            clave_evidencia: evidenciasCriterio7[i],
                                            puntos: puntos / parseInt(puntosCriterio7.response[0].puntos),
                                            total_puntos: puntos,
                                            year: year,
                                            id_criterio: criterio,
                                            _token: "{{ csrf_token() }}",
                                        },
                                        type: 'POST',
                                        dateType: 'json',
                                        mensajeConfirm: 'Se han actualizado los puntos para la evaluación.',
                                        url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionAdministracion/investigacion/listInvestigacion?token={{ Session::get('token') }}"
                                    };
                                    // console.log(options);
                                    peticionGeneralAjax(options);
                                }
                                actualizarDatosAdministracionCriterio7(clave, year, 7)
                            }
                        }
                    },
                });
            },
        });
    }

    function actualizarDatosAdministracionCriterio7(clave, year, criterio){
        console.log(criterio);
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionAdministracion/investigacion/updateDatosInvestigacion/" + clave + "/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(data){
                console.log("Puntos actualizados");
            },
        });
    }

    function deletePuntosEvidenciaCriterio7(clave, year, criterio){
        var optionsDelete = {
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionAdministracion/investigacion/deletePuntosInvestigacion/" + clave + "/" + year + "/" + criterio,
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
