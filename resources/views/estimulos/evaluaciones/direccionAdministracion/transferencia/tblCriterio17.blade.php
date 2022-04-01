<div class="table-responsive" width = "100%" id="table_refresh">
    <table id="tblCriterio17" class="table table-bordered table-striped">
        <caption>Registro de modelo de utilidades otorgado.</caption>
        <thead>
            <tr class="text-center">
                <th scope="col">Clave</th>
                <th scope="col">Nombre</th>
                <th scope="col">Puntos</th>
                <th scope="col">Total</th>
                <th scope="col">Año</th>
                @if (Auth::user()->hasPermissionTo("estimulo-evaluaciones-administracion-transferencia-index"))
                    <th scope="col">Evidencias</th>
                @endif
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
@include('estimulos.evaluaciones.direccionAdministracion.transferencia.modalEvidenciasCriterio17')

<script>
    function obtenerCriterio17(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionAdministracion/transferencia/searchTransferencia/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosCritero17){
                var datosCriterio17 = datosCritero17.response;
                // console.log(datosCritero17);
                // Codigo para guardar en el sistema...
                for(var i = 0; i < datosCriterio17.length; i++){
                    var dataCriterio17 = datosCriterio17[i];
                    // console.log(dataCriterio17);
                    // Codigo para guardar en el sistema...
                    var options = {
                        action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionAdministracion/investigacion/saveDatosInvestigacion",
                        json: {
                            clave: dataCriterio17.numero_personal,
                            nombre: dataCriterio17.nombre,
                            id_objetivo: 5,
                            id_criterio: 17,
                            direccion: "DAdministracion",
                            puntos: 0,
                            total_puntos: 0,
                            year: year,
                            username: dataCriterio17.username,
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
                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionAdministracion/transferencia/datosTransferencia/" + year + "/" + criterio,
                    type: 'GET',
                    dataType: 'json',
                    ok: function(datosAdministracionCriterio17){
                        // console.log(datosAdministracionCriterio17);
                        var datosAdministracionCriterio17 = datosAdministracionCriterio17.response;
                        var row = "";
                        for(var i = 0; i < datosAdministracionCriterio17.length; i++){
                            var dataAdministracionCriterio17 = datosAdministracionCriterio17[i];
                            // console.log(dataAdministracionCriterio17);
                            var authUser = '<?= Auth::user()->usuario ?>';
                            var permissions = '<?= Auth::user()->hasPermissionTo("estimulo-evaluaciones-administracion-transferencia-index") ?>';
                            // console.log(permissions);
                            if(dataAdministracionCriterio17.username == authUser || permissions == 1){
                                row += "<tr>";
                                row += '<th scope="row" class="text-center" width="10%">' + dataAdministracionCriterio17.clave + '</td>';
                                row += '<td width="40%">' + dataAdministracionCriterio17.nombre + "</td>";
                                row += '<td class="text-center" width="10%">' + dataAdministracionCriterio17.puntos + '</td>';
                                row += '<td class="text-center" width="10%">' + dataAdministracionCriterio17.total_puntos + '</td>';
                                row += '<td class="text-center" width="10%">' + dataAdministracionCriterio17.year + '</td>';
                                if(permissions == 1){
                                    row += '<td class="text-center" width="10%"><a href="javascript:verEvidenciasCriterio17(' + dataAdministracionCriterio17.year + ', ' + dataAdministracionCriterio17.clave + ', ' + 17 +')"><i class="fa fa-edit"></i></a></td>';
                                }
                                row += "</tr>";
                            }
                        }
                        if ($.fn.dataTable.isDataTable("#tblCriterio17")) {
                            tblDifusionDivulgacion = $("#tblCriterio17").DataTable();
                            tblDifusionDivulgacion.destroy();
                        }
                        $('#tblCriterio17 > tbody').html('');
                        $('#tblCriterio17 > tbody').append(row);
                        $('#tblCriterio17').DataTable({
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

    function verEvidenciasCriterio17(year, clave, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionAdministracion/transferencia/searchEvidenciasTransferencia/" + year + "/" + clave + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(dataEvidenciasCriterio17){
                // console.log(dataEvidenciasCriterio17); //Comentamos para futuras pruebas...
                consultarDatos({
                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionAdministracion/investigacion/getEvidenciasInvestigacion/" + clave + "/" + year + "/" + criterio,
                    type: 'GET',
                    dataType: 'json',
                    ok: function(getEvidenciasCriterio17){
                        for(var i = 0; i < getEvidenciasCriterio17.response.length; i++){
                            // console.log(getEvidenciasCriterio17.response[i].clave_evidencia); // Se comenta para futuras pruebas...
                            var seleccion = getEvidenciasCriterio17.response[i].clave_evidencia;
                            $('input[value="' + seleccion + '"]').prop('checked', true);
                        }
                    },
                });
                $('#modalEvidenciasCriterio17').modal('show');
                var datos = dataEvidenciasCriterio17.response;
                var row = "";
                $('#clave').val(clave);
                $('#year').val(year);
                for(var i = 0; i < datos.length; i++){
                    var claveData = datos[i];
                    // console.log(claveData); //Comentamos para futuras pruebas...
                    if(claveData.status == 1){
                        var tipo = "-R";
                    }else{
                        var tipo = "-O";
                    }
                    row += '<div class="col-12 col-md-2 text-center">';
                    row += '<a href="http://126.107.2.56/SINFODI/Files/SINFODI-PropiedadIntelectual/' + claveData.clave + tipo + '.pdf" target="_blank">';
                    row += '<img src="{{ asset('img/pdf2.png') }}" width="60px" height="60px">';
                    row += '</a><br>';
                    row += '<b><input type="checkbox" class="evidenciasCriterio17" name="evidenciasCriterio17[]" id="evidenciasCriterio17'+claveData.clave+tipo+'" value="'+claveData.clave+tipo+'"> ' + claveData.clave+tipo+ '</b>';
                    row += '</div>';
                }
                $("#contenedorCriterio17").html(row).fadeIn('slow');
            },
        });
    }

    function actualizarEvidenciasCriterio17(){
        var clave = $('#clave').val();
        var year = $('#year').val();
        var evidencias = [];
        var puntos = 0;
        var id = 17;
        var objetivo = 5;
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionAdministracion/transferencia/obtenerEvidenciasTransferencia/" + clave + "/" + year + "/" + id,
            type: 'GET',
            dataType: 'json',
            ok: function(searchEvidenciasCriterio17){
                var existe = searchEvidenciasCriterio17.response;
                // console.log(existe);
                consultarDatos({
                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionAdministracion/investigacion/puntosinvestigacion/" + id + "/" + objetivo,
                    type: 'GET',
                    dataType: 'json',
                    ok: function(puntosCriterio17){
                        // console.log(puntosCriterio17.response[0].puntos); // Comentamos para futuras pruebas...
                        $('input.evidenciasCriterio17:checked').each(function(){
                            evidencias.push(this.value);
                            puntos = puntos + parseInt(puntosCriterio17.response[0].puntos);
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
                                    var savePuntos = {
                                        action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionAdministracion/transferencia/savePuntos",
                                        json: {
                                            clave: clave,
                                            clave_evidencia: evidencias[i],
                                            puntos: puntos / parseInt(puntosCriterio17.response[0].puntos),
                                            total_puntos: puntos,
                                            year: year,
                                            id_criterio: id,
                                            _token: "{{ csrf_token() }}",
                                        },
                                        type: 'POST',
                                        dateType: 'json',
                                    };
                                    // console.log(savePuntos);
                                    guardarAutomatico(savePuntos);
                                }
                                actualizarDatosAdministracionCriterio17(clave, year, 17);
                                obtenerCriterio17(year, 17);
                                $('#modalEvidenciasCriterio17').modal('hide');
                            }else{
                                deletePuntosEvidenciaCriterio17(clave, year, 17);
                                for(var i = 0; i < evidencias.length; i++){
                                    // console.log(evidencias[i]); // Se comenta para futuras pruebas...
                                    var savePuntos = {
                                        action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionAdministracion/transferencia/savePuntos",
                                        json: {
                                            clave: clave,
                                            clave_evidencia: evidencias[i],
                                            puntos: puntos / parseInt(puntosCriterio17.response[0].puntos),
                                            total_puntos: puntos,
                                            year: year,
                                            id_criterio: id,
                                            _token: "{{ csrf_token() }}",
                                        },
                                        type: 'POST',
                                        dateType: 'json',
                                    };
                                    // console.log(savePuntos);
                                    guardarAutomatico(savePuntos);
                                }
                                actualizarDatosAdministracionCriterio17(clave, year, 17);
                                obtenerCriterio17(year, 17);
                                $('#modalEvidenciasCriterio17').modal('hide');
                            }
                        }
                    },
                });
            },
        });
    }

    function actualizarDatosAdministracionCriterio17(clave, year, criterio){
        // console.log(criterio);
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionAdministracion/transferencia/updateDatosTransferencia/" + clave + "/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(data){
                console.log("Puntos actualizados");
            },
        });
    }

    function deletePuntosEvidenciaCriterio17(clave, year, criterio){
        var optionsDelete = {
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionAdministracion/transferencia/deletePuntosTransferencia/" + clave + "/" + year + "/" + criterio,
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
