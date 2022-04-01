<div class="table-responsive" width = "100%" id="table_refresh">
    <table id="tblCriterio21" class="table table-bordered table-striped">
        <caption>Derecho de autor solicitado.</caption>
        <thead>
            <tr class="text-center">
                <th scope="col">Clave</th>
                <th scope="col">Nombre</th>
                <th scope="col">Puntos</th>
                <th scope="col">Total</th>
                <th scope="col">Año</th>
                @if (Auth::user()->hasPermissionTo("estimulo-evaluaciones-posgrado-transferencia-index"))
                    <th scope="col">Evidencias</th>
                @endif
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
@include('estimulos.evaluaciones.direccionPosgrado.transferencia.modalEvidenciasCriterio21')

<script>
    function obtenerCriterio21(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/transferencia/searchTransferencia/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosCritero21){
                var datosCriterio21 = datosCritero21.response;
                // console.log(datosCritero21);
                // Codigo para guardar en el sistema...
                for(var i = 0; i < datosCriterio21.length; i++){
                    var dataCriterio21 = datosCriterio21[i];
                    // console.log(dataCriterio21);
                    // Codigo para guardar en el sistema...
                    var options = {
                        action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/transferencia/saveDatosTransferencia",
                        json: {
                            clave: dataCriterio21.numero_personal,
                            nombre: dataCriterio21.nombre,
                            id_objetivo: 5,
                            id_criterio: 21,
                            direccion: "DPosgrado",
                            puntos: 0,
                            total_puntos: 0,
                            year: year,
                            username: dataCriterio21.username,
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
                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/transferencia/datosTransferencia/" + year + "/" + criterio,
                    type: 'GET',
                    dataType: 'json',
                    ok: function(datosPosgradoCriterio21){
                        // console.log(datosPosgradoCriterio21);
                        var datosPosgradoCriterio21 = datosPosgradoCriterio21.response;
                        var row = "";
                        for(var i = 0; i < datosPosgradoCriterio21.length; i++){
                            var dataPosgradoCriterio21 = datosPosgradoCriterio21[i];
                            // console.log(dataPosgradoCriterio21);
                            var authUser = '<?= Auth::user()->usuario ?>';
                            var permissions = '<?= Auth::user()->hasPermissionTo("estimulo-evaluaciones-posgrado-transferencia-index") ?>';
                            // console.log(permissions);
                            if(dataPosgradoCriterio21.username == authUser || permissions == 1){
                                row += "<tr>";
                                row += '<th scope="row" class="text-center" width="10%">' + dataPosgradoCriterio21.clave + '</td>';
                                row += '<td width="40%">' + dataPosgradoCriterio21.nombre + "</td>";
                                row += '<td class="text-center" width="10%">' + dataPosgradoCriterio21.puntos + '</td>';
                                row += '<td class="text-center" width="10%">' + dataPosgradoCriterio21.total_puntos + '</td>';
                                row += '<td class="text-center" width="10%">' + dataPosgradoCriterio21.year + '</td>';
                                if(permissions == 1){
                                    row += '<td class="text-center" width="10%"><a href="javascript:verEvidenciasCriterio21(' + dataPosgradoCriterio21.year + ', ' + dataPosgradoCriterio21.clave + ', ' + 21 +')"><i class="fa fa-edit"></i></a></td>';
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
            },
        });
    }

    function verEvidenciasCriterio21(year, clave, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/transferencia/searchEvidenciasTransferencia/" + year + "/" + clave + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(dataEvidenciasCriterio21){
                // console.log(dataEvidenciasCriterio21); //Comentamos para futuras pruebas...
                consultarDatos({
                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/transferencia/getEvidenciasTransferencia/" + clave + "/" + year + "/" + criterio,
                    type: 'GET',
                    dataType: 'json',
                    ok: function(getEvidenciasCriterio21){
                        for(var i = 0; i < getEvidenciasCriterio21.response.length; i++){
                            // console.log(getEvidenciasCriterio21.response[i].clave_evidencia); // Se comenta para futuras pruebas...
                            var seleccion = getEvidenciasCriterio21.response[i].clave_evidencia;
                            $('input[value="' + seleccion + '"]').prop('checked', true);
                        }
                    },
                });
                $('#modalEvidenciasCriterio21').modal('show');
                var datos = dataEvidenciasCriterio21.response;
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
                    row += '<b><input type="checkbox" class="evidenciasCriterio21" name="evidenciasCriterio21[]" id="evidenciasCriterio21'+claveData.clave+tipo+'" value="'+claveData.clave+tipo+'"> ' + claveData.clave+tipo+ '</b>';
                    row += '</div>';
                }
                $("#contenedorCriterio21").html(row).fadeIn('slow');
            },
        });
    }

    function actualizarEvidenciasCriterio21(){
        var clave = $('#clave').val();
        var year = $('#year').val();
        var evidencias = [];
        var puntos = 0;
        var id = 21;
        var objetivo = 5;
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/transferencia/obtenerEvidenciasTransferencia/" + clave + "/" + year + "/" + id,
            type: 'GET',
            dataType: 'json',
            ok: function(searchEvidenciasCriterio21){
                var existe = searchEvidenciasCriterio21.response;
                // console.log(existe);
                consultarDatos({
                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/transferencia/puntosTransferencia/" + id + "/" + objetivo,
                    type: 'GET',
                    dataType: 'json',
                    ok: function(puntosCriterio21){
                        // console.log(puntosCriterio21.response[0].puntos); // Comentamos para futuras pruebas...
                        $('input.evidenciasCriterio21:checked').each(function(){
                            evidencias.push(this.value);
                            puntos = puntos + parseInt(puntosCriterio21.response[0].puntos);
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
                                        action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/transferencia/savePuntos",
                                        json: {
                                            clave: clave,
                                            clave_evidencia: evidencias[i],
                                            puntos: puntos / parseInt(puntosCriterio21.response[0].puntos),
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
                                actualizarDatosPosgradoCriterio21(clave, year, 21);
                                obtenerCriterio21(year, 21);
                                $('#modalEvidenciasCriterio21').modal('hide');
                            }else{
                                deletePuntosEvidenciaCriterio21(clave, year, 21);
                                for(var i = 0; i < evidencias.length; i++){
                                    // console.log(evidencias[i]); // Se comenta para futuras pruebas...
                                    var savePuntos = {
                                        action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/transferencia/savePuntos",
                                        json: {
                                            clave: clave,
                                            clave_evidencia: evidencias[i],
                                            puntos: puntos / parseInt(puntosCriterio21.response[0].puntos),
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
                                actualizarDatosPosgradoCriterio21(clave, year, 21);
                                obtenerCriterio21(year, 21);
                                $('#modalEvidenciasCriterio21').modal('hide');
                            }
                        }
                    },
                });
            },
        });
    }

    function actualizarDatosPosgradoCriterio21(clave, year, criterio){
        // console.log(criterio);
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/transferencia/updateDatosTransferencia/" + clave + "/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(data){
                console.log("Puntos actualizados");
            },
        });
    }

    function deletePuntosEvidenciaCriterio21(clave, year, criterio){
        var optionsDelete = {
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/transferencia/deletePuntosTransferencia/" + clave + "/" + year + "/" + criterio,
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
