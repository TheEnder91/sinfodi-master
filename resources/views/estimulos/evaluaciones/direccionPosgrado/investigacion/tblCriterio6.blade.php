<div class="table-responsive" width = "100%" id="table_refresh">
    <table id="tblCriterio6" class="table table-bordered table-striped">
        <caption>Publicación de Artículos en revistas de circulación internacional con arbitraje, factor de impacto hasta 2.0.</caption>
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
@include('estimulos.evaluaciones.direccionPosgrado.investigacion.modalEvidenciasCriterio6')

<script>
    function obtenerCriterio6(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/investigacion/searchInvestigacion/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosCritero6){
                var datosCriterio6 = datosCritero6.response;
                // console.log(datosCritero6);
                // Codigo para guardar en el sistema...
                for(var i = 0; i < datosCriterio6.length; i++){
                    var dataCriterio6 = datosCriterio6[i];
                    // Codigo para guardar en el sistema...
                    var options = {
                        action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/investigacion/saveDatosInvestigacion",
                        json: {
                            clave: dataCriterio6.numero_personal,
                            nombre: dataCriterio6.nombre,
                            id_objetivo: 3,
                            id_criterio: 6,
                            direccion: "DPosgrado",
                            puntos: 0,
                            total_puntos: 0,
                            year: year,
                            username: dataCriterio6.username,
                            _token: "{{ csrf_token() }}",
                        },
                        type: 'POST',
                        dateType: 'json',
                    };
                    guardarAutomatico(options);
                    // console.log(options); // e comenta para futuras pruebas...
                    // Finaliza codigo para guardar en el sistema...
                }
                consultarDatos({
                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/investigacion/datosInvestigacion/" + year + "/" + criterio,
                    type: 'GET',
                    dataType: 'json',
                    ok: function(datosPosgradoCriterio6){
                        // console.log(datosPosgradoCriterio6);
                        var datosPosgradoCriterio6 = datosPosgradoCriterio6.response;
                        var row = "";
                        for(var i = 0; i < datosPosgradoCriterio6.length; i++){
                            var dataPosgradoCriterio6 = datosPosgradoCriterio6[i];
                            // console.log(dataPosgradoCriterio6);
                            var authUser = '<?= Auth::user()->usuario ?>';
                            var permissions = '<?= Auth::user()->hasPermissionTo("estimulo-evaluaciones-posgrado-investigacion-index") ?>';
                            // console.log(permissions);
                            if(dataPosgradoCriterio6.username == authUser || permissions == 1){
                                row += "<tr>";
                                row += '<th scope="row" class="text-center" width="10%">' + dataPosgradoCriterio6.clave + '</td>';
                                row += '<td width="40%">' + dataPosgradoCriterio6.nombre + "</td>";
                                row += '<td class="text-center" width="10%">' + dataPosgradoCriterio6.puntos + '</td>';
                                row += '<td class="text-center" width="10%">' + dataPosgradoCriterio6.total_puntos + '</td>';
                                row += '<td class="text-center" width="10%">' + dataPosgradoCriterio6.year + '</td>';
                                if(permissions == 1){
                                    row += '<td class="text-center" width="10%"><a href="javascript:verEvidenciasCriterio6(' + dataPosgradoCriterio6.year + ', ' + dataPosgradoCriterio6.clave + ', ' + 6 +')"><i class="fa fa-edit"></i></a></td>';
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
            },
        });
    }

    function verEvidenciasCriterio6(year, clave, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/investigacion/searchEvidenciasInvestigacion/" + year + "/" + clave + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(dataEvidenciasCriterio6){
                // console.log(dataEvidenciasCriterio6); //Comentamos para futuras pruebas...
                consultarDatos({
                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/investigacion/getEvidenciasInvestigacion/" + clave + "/" + year + "/" + criterio,
                    type: 'GET',
                    dataType: 'json',
                    ok: function(getEvidenciasCriterio6){
                        for(var i = 0; i < getEvidenciasCriterio6.response.length; i++){
                            // console.log(getEvidenciasCriterio6.response[i].clave_evidencia); // Se comenta para futuras pruebas...
                            var seleccion = getEvidenciasCriterio6.response[i].clave_evidencia;
                            $('input[value="' + seleccion + '"]').prop('checked', true);
                        }
                    },
                });
                $('#modalEvidenciasCriterio6').modal('show');
                var datos = dataEvidenciasCriterio6.response;
                var row = "";
                $('#clave').val(clave);
                $('#year').val(year);
                for(var i = 0; i < datos.length; i++){
                    // console.log(data); //Comentamos para futuras pruebas...
                    var claveData = datos[i];
                    row += '<div class="col-12 col-md-2 text-center">';
                    row += '<a href="http://126.107.2.56/SINFODI/Files/SINFODI-Articulos/' + claveData.clave + '.pdf" target="_blank">';
                    row += '<img src="{{ asset('img/pdf2.png') }}" width="60px" height="60px">';
                    row += '</a><br>';
                    row += '<b><input type="checkbox" class="evidencias" name="evidencias[]" id="evidencias'+claveData.clave+'" value="'+claveData.clave+'"> ' + claveData.clave + '</b>';
                    row += '</div>';
                }
                $("#contenedor").html(row).fadeIn('slow');
            },
        });
    }

    function actualizarEvidenciasCriterio6(){
        var clave = $('#clave').val();
        var year = $('#year').val();
        var evidencias = [];
        var puntos = 0;
        var id = 6;
        var objetivo = 3;
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/investigacion/obtenerEvidenciasInvestigacion/" + clave + "/" + year + "/" + id,
            type: 'GET',
            dataType: 'json',
            ok: function(searchEvidenciasCriterio6){
                // console.log(searchEvidenciasCriterio6.response);
                var existe = searchEvidenciasCriterio6.response;
                // console.log(existe);
                consultarDatos({
                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/investigacion/puntosinvestigacion/" + id + "/" + objetivo,
                    type: 'GET',
                    dataType: 'json',
                    ok: function(puntosCriterio6){
                        // console.log(puntosCriterio6.response[0].puntos); // Comentamos para futuras pruebas...
                        $('input.evidencias:checked').each(function(){
                            evidencias.push(this.value);
                            puntos = puntos + parseInt(puntosCriterio6.response[0].puntos);
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
                                for(var i = 0; i < evidencias.length; i++){
                                    // console.log(evidencias[i]); // Se comenta para futuras pruebas...
                                    var options = {
                                        action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/investigacion/savePuntos",
                                        json: {
                                            clave: clave,
                                            clave_evidencia: evidencias[i],
                                            puntos: puntos / parseInt(puntosCriterio6.response[0].puntos),
                                            total_puntos: puntos,
                                            year: year,
                                            id_criterio: id,
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
                                actualizarDatosPosgradoCriterio6(clave, year, 6)
                            }else{
                                deletePuntosEvidenciaCriterio6(clave, year, 6);
                                for(var i = 0; i < evidencias.length; i++){
                                    // console.log(evidencias[i]); // Se comenta para futuras pruebas...
                                    var options = {
                                        action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/investigacion/savePuntos",
                                        json: {
                                            clave: clave,
                                            clave_evidencia: evidencias[i],
                                            puntos: puntos / parseInt(puntosCriterio6.response[0].puntos),
                                            total_puntos: puntos,
                                            year: year,
                                            id_criterio: id,
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
                                actualizarDatosPosgradoCriterio6(clave, year, 6)
                            }
                        }
                    },
                });
            },
        });
    }

    function actualizarDatosPosgradoCriterio6(clave, year, criterio){
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

    function deletePuntosEvidenciaCriterio6(clave, year, criterio){
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
