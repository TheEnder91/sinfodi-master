<div class="table-responsive" width = "100%">
    <table id="tblCriterio9" class="table table-bordered table-striped">
        <caption>Autor de libros científicos en editoriales de reconocido prestigio.</caption>
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
@include('estimulos.evaluaciones.direccionPosgrado.investigacion.modalEvidenciasCriterio9')

<script>
    function obtenerCriterio9(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/investigacion/searchInvestigacion/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosCritero9){
                var datosCritero9 = datosCritero9.response;
                // console.log(datosCritero9);
                // Codigo para guardar en el sistema...
                for(var i = 0; i < datosCritero9.length; i++){
                    var dataCriterio9 = datosCritero9[i];
                    var options = {
                        action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/investigacion/saveDatosInvestigacion",
                        json: {
                            clave: dataCriterio9.numero_personal,
                            nombre: dataCriterio9.nombre,
                            id_objetivo: 3,
                            id_criterio: 9,
                            direccion: "DPosgrado",
                            puntos: 0,
                            total_puntos: 0,
                            year: year,
                            username: dataCriterio9.username,
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
                    ok: function(datosPosgradoCriterio9){
                        // console.log(datosPosgradoCriterio9);
                        var datosPosgradoCriterio9 = datosPosgradoCriterio9.response;
                        var row = "";
                        for(var i = 0; i < datosPosgradoCriterio9.length; i++){
                            var dataPosgradoCriterio9 = datosPosgradoCriterio9[i];
                            // console.log(dataPosgradoCriterio9);
                            var authUser = '<?= Auth::user()->usuario ?>';
                            var permissions = '<?= Auth::user()->hasPermissionTo("estimulo-evaluaciones-posgrado-investigacion-index") ?>';
                            // console.log(permissions);
                            if(dataPosgradoCriterio9.username == authUser || permissions == 1){
                                row += "<tr>";
                                row += '<th scope="row" class="text-center" width="10%">' + dataPosgradoCriterio9.clave + '</td>';
                                row += '<td width="40%">' + dataPosgradoCriterio9.nombre + "</td>";
                                row += '<td class="text-center" width="10%">' + dataPosgradoCriterio9.puntos + '</td>';
                                row += '<td class="text-center" width="10%">' + dataPosgradoCriterio9.total_puntos + '</td>';
                                row += '<td class="text-center" width="10%">' + dataPosgradoCriterio9.year + '</td>';
                                if(permissions == 1){
                                    row += '<td class="text-center" width="10%"><a href="javascript:verEvidenciasCriterio9(' + dataPosgradoCriterio9.year + ', ' + dataPosgradoCriterio9.clave + ', ' + 9 +')"><i class="fa fa-edit"></i></a></td>';
                                }
                                row += "</tr>";
                            }
                        }
                        if ($.fn.dataTable.isDataTable("#tblCriterio9")) {
                            tblDifusionDivulgacion = $("#tblCriterio9").DataTable();
                            tblDifusionDivulgacion.destroy();
                        }
                        $('#tblCriterio9 > tbody').html('');
                        $('#tblCriterio9 > tbody').append(row);
                        $('#tblCriterio9').DataTable({
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

    function verEvidenciasCriterio9(year, clave, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/investigacion/searchEvidenciasInvestigacion/" + year + "/" + clave + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(dataEvidenciasCriterio9){
                // console.log(dataEvidenciasCriterio9); //Comentamos para futuras pruebas...
                consultarDatos({
                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/investigacion/getEvidenciasInvestigacion/" + clave + "/" + year + "/" + criterio,
                    type: 'GET',
                    dataType: 'json',
                    ok: function(getEvidenciasCriterio9){
                        for(var i = 0; i < getEvidenciasCriterio9.response.length; i++){
                            var seleccion = getEvidenciasCriterio9.response[i].clave_evidencia;
                            $('input[value="' + seleccion + '"]').prop('checked', true);
                        }
                    },
                });
                $('#modalEvidenciasCriterio9').modal('show');
                var datos = dataEvidenciasCriterio9.response;
                var row = "";
                $('#clave').val(clave);
                $('#year').val(year);
                for(var i = 0; i < datos.length; i++){
                    var claveData = datos[i];
                    // console.log(claveData); //Comentamos para futuras pruebas...
                    row += '<div class="col-12 col-md-2 text-center">';
                    row += '<a href="http://126.107.2.56/SINFODI/Files/SINFODI-LFC/' + claveData.clave + '.pdf" target="_blank">';
                    row += '<img src="{{ asset('img/pdf2.png') }}" width="60px" height="60px">';
                    row += '</a><br>';
                    row += '<b><input type="checkbox" class="evidenciasCriterio9" name="evidenciasCriterio9[]" id="evidenciasCriterio9'+claveData.clave+'" value="'+claveData.clave+'"> ' + claveData.clave + '</b>';
                    row += '</div>';
                }
                $("#contenedorCriterio9").html(row).fadeIn('slow');
            },
        });
    }

    function actualizarEvidenciasCriterio9(){
        var clave = $('#clave').val();
        var year = $('#year').val();
        var evidenciasCriterio9 = [];
        var puntos = 0;
        var criterio = 9;
        var objetivo = 3;
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/investigacion/obtenerEvidenciasInvestigacion/" + clave + "/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(searchEvidenciasCriterio9){
                var existe = searchEvidenciasCriterio9.response;
                // console.log(existe);
                consultarDatos({
                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/investigacion/puntosinvestigacion/" + criterio + "/" + objetivo,
                    type: 'GET',
                    dataType: 'json',
                    ok: function(puntosCriterio9){
                        // console.log(puntosCriterio9.response[0].puntos); // Comentamos para futuras pruebas...
                        $('input.evidenciasCriterio9:checked').each(function(){
                            evidenciasCriterio9.push(this.value);
                            puntos = puntos + parseInt(puntosCriterio9.response[0].puntos);
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
                                for(var i = 0; i < evidenciasCriterio9.length; i++){
                                    // console.log(evidenciasCriterio9[i]); // Se comenta para futuras pruebas...
                                    var options = {
                                        action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/investigacion/savePuntos",
                                        json: {
                                            clave: clave,
                                            clave_evidencia: evidenciasCriterio9[i],
                                            puntos: puntos / parseInt(puntosCriterio9.response[0].puntos),
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
                                actualizarDatosPosgradoCriterio9(clave, year, 9);
                            }else{
                                deletePuntosEvidenciaCriterio9(clave, year, 9);
                                for(var i = 0; i < evidenciasCriterio9.length; i++){
                                    console.log(evidenciasCriterio9[i]); // Se comenta para futuras pruebas...
                                    var options = {
                                        action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/investigacion/savePuntos",
                                        json: {
                                            clave: clave,
                                            clave_evidencia: evidenciasCriterio9[i],
                                            puntos: puntos / parseInt(puntosCriterio9.response[0].puntos),
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
                                actualizarDatosPosgradoCriterio9(clave, year, 9);
                            }
                        }
                    },
                });
            },
        });
    }

    function actualizarDatosPosgradoCriterio8(clave, year, criterio){
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

    function deletePuntosEvidenciaCriterio8(clave, year, criterio){
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
