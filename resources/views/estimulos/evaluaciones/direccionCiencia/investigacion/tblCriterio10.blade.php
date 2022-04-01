<div class="table-responsive" width = "100%">
    <table id="tblCriterio10" class="table table-bordered table-striped">
        <caption>Memorias internacionales en extenso(proccedings) con arbitraje limitado hasta un máximo de 3.</caption>
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
@include('estimulos.evaluaciones.direccionCiencia.investigacion.modalEvidenciasCriterio10')

<script>
    function obtenerCriterio10(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/investigacion/searchInvestigacion/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosCritero10){
                var datosCriterio10 = datosCritero10.response;
                // console.log(datosCritero10);
                // Codigo para guardar en el sistema...
                for(var i = 0; i < datosCriterio10.length; i++){
                    var dataCriterio10 = datosCriterio10[i];
                    var options = {
                        action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/investigacion/saveDatosInvestigacion",
                        json: {
                            clave: dataCriterio10.numero_personal,
                            nombre: dataCriterio10.nombre,
                            id_objetivo: 3,
                            id_criterio: 10,
                            direccion: "DCiencia",
                            puntos: 0,
                            total_puntos: 0,
                            year: year,
                            username: dataCriterio10.username,
                            _token: "{{ csrf_token() }}",
                        },
                        type: 'POST',
                        dateType: 'json',
                    };
                    // console.log(options); // e comenta para futuras pruebas...
                    guardarAutomatico(options);
                    // Finaliza codigo para guardar en el sistema...
                }
                verTablaCriterio10(year, 10);
            },
        });
    }

    function verTablaCriterio10(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/investigacion/datosInvestigacion/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosCienciaCriterio10){
                // console.log(datosCienciaCriterio10);
                var datosCienciaCriterio10 = datosCienciaCriterio10.response;
                var row = "";
                for(var i = 0; i < datosCienciaCriterio10.length; i++){
                    var dataCienciaCriterio10 = datosCienciaCriterio10[i];
                    // console.log(dataCienciaCriterio10);
                    var authUser = '<?= Auth::user()->usuario ?>';
                    var permissions = '<?= Auth::user()->hasPermissionTo("estimulo-evaluaciones-ciencia-investigacion-index") ?>';
                    // console.log(permissions);
                    if(dataCienciaCriterio10.username == authUser || permissions == 1){
                        row += "<tr>";
                        row += '<th scope="row" class="text-center" width="10%">' + dataCienciaCriterio10.clave + '</td>';
                        row += '<td width="40%">' + dataCienciaCriterio10.nombre + "</td>";
                        row += '<td class="text-center" width="10%">' + dataCienciaCriterio10.puntos + '</td>';
                        row += '<td class="text-center" width="10%">' + dataCienciaCriterio10.total_puntos + '</td>';
                        row += '<td class="text-center" width="10%">' + dataCienciaCriterio10.year + '</td>';
                        if(permissions == 1){
                            row += '<td class="text-center" width="10%"><a href="javascript:verEvidenciasCriterio10(' + dataCienciaCriterio10.year + ', ' + dataCienciaCriterio10.clave + ', ' + 10 +')"><i class="fa fa-edit"></i></a></td>';
                        }
                        row += "</tr>";
                    }
                }
                if ($.fn.dataTable.isDataTable("#tblCriterio10")) {
                    tblDifusionDivulgacion = $("#tblCriterio10").DataTable();
                    tblDifusionDivulgacion.destroy();
                }
                $('#tblCriterio10 > tbody').html('');
                $('#tblCriterio10 > tbody').append(row);
                $('#tblCriterio10').DataTable({
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

    // function verEvidenciasCriterio10(year, clave, criterio){
    //     consultarDatos({
    //         action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/investigacion/searchEvidenciasInvestigacion/" + year + "/" + clave + "/" + criterio,
    //         type: 'GET',
    //         dataType: 'json',
    //         ok: function(dataEvidenciasCriterio10){
    //             // console.log(dataEvidenciasCriterio10); //Comentamos para futuras pruebas...
    //             consultarDatos({
    //                 action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/investigacion/getEvidenciasInvestigacion/" + clave + "/" + year + "/" + criterio,
    //                 type: 'GET',
    //                 dataType: 'json',
    //                 ok: function(getEvidenciasCriterio10){
    //                     for(var i = 0; i < getEvidenciasCriterio10.response.length; i++){
    //                         var seleccion = getEvidenciasCriterio10.response[i].clave_evidencia;
    //                         $('input[value="' + seleccion + '"]').prop('checked', true);
    //                     }
    //                 },
    //             });
    //             $('#modalEvidenciasCriterio10').modal('show');
    //             var datos = dataEvidenciasCriterio10.response;
    //             var row = "";
    //             $('#clave').val(clave);
    //             $('#year').val(year);
    //             for(var i = 0; i < datos.length; i++){
    //                 var claveData = datos[i];
    //                 // console.log(claveData); //Comentamos para futuras pruebas...
    //                 row += '<div class="col-12 col-md-2 text-center">';
    //                 row += '<a href="http://126.107.2.56/SINFODI/Files/SINFODI-Articulos/' + claveData.clave + '.pdf" target="_blank">';
    //                 row += '<img src="{{ asset('img/pdf2.png') }}" width="60px" height="60px">';
    //                 row += '</a><br>';
    //                 row += '<b><input type="checkbox" class="evidenciasCriterio10" name="evidenciasCriterio10[]" id="evidenciasCriterio10'+claveData.clave+'" value="'+claveData.clave+'"> ' + claveData.clave + '</b>';
    //                 row += '</div>';
    //             }
    //             $("#contenedorCriterio10").html(row).fadeIn('slow');
    //         },
    //     });
    // }

    // function actualizarEvidenciasCriterio10(){
    //     var clave = $('#clave').val();
    //     var year = $('#year').val();
    //     var evidenciasCriterio10 = [];
    //     var puntos = 0;
    //     var criterio = 10;
    //     var objetivo = 3;
    //     consultarDatos({
    //         action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/investigacion/obtenerEvidenciasInvestigacion/" + clave + "/" + year + "/" + criterio,
    //         type: 'GET',
    //         dataType: 'json',
    //         ok: function(searchEvidenciasCriterio10){
    //             var existe = searchEvidenciasCriterio10.response;
    //             // console.log(existe);
    //             consultarDatos({
    //                 action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/investigacion/puntosinvestigacion/" + criterio + "/" + objetivo,
    //                 type: 'GET',
    //                 dataType: 'json',
    //                 ok: function(puntosCriterio10){
    //                     // console.log(puntosCriterio10.response[0].puntos); // Comentamos para futuras pruebas...
    //                     $('input.evidenciasCriterio10:checked').each(function(){
    //                         evidenciasCriterio10.push(this.value);
    //                         puntos = puntos + parseInt(puntosCriterio10.response[0].puntos);
    //                     });
    //                     if(puntos == 0){
    //                         swal({
    //                             type: 'warning',
    //                             title: 'Favor de seleccionar las evidencias.',
    //                             showConfirmButton: false,
    //                             timer: 1800
    //                         }).catch(swal.noop);
    //                     }else if(puntos > 30){
    //                         swal({
    //                             type: 'error',
    //                             title: 'Solo puede seleccionar un maximo de 3.',
    //                             showConfirmButton: false,
    //                             timer: 1800
    //                         }).catch(swal.noop);
    //                     }else{
    //                         if(existe == 0){
    //                             for(var i = 0; i < evidenciasCriterio10.length; i++){
    //                                 console.log(evidenciasCriterio10[i]); // Se comenta para futuras pruebas...
    //                                 var options = {
    //                                     action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/investigacion/savePuntos",
    //                                     json: {
    //                                         clave: clave,
    //                                         clave_evidencia: evidenciasCriterio10[i],
    //                                         puntos: puntos / parseInt(puntosCriterio10.response[0].puntos),
    //                                         total_puntos: puntos,
    //                                         year: year,
    //                                         id_criterio: criterio,
    //                                         _token: "{{ csrf_token() }}",
    //                                     },
    //                                     type: 'POST',
    //                                     dateType: 'json',
    //                                     mensajeConfirm: 'Se han actualizado los puntos para la evaluación.',
    //                                     url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/investigacion/listInvestigacion?token={{ Session::get('token') }}"
    //                                 };
    //                                 // console.log(options);
    //                                 peticionGeneralAjax(options);
    //                             }
    //                             actualizarDatosCienciaCriterio10(clave, year, 10);
    //                         }else{
    //                             deletePuntosEvidenciaCriterio10(clave, year, 10);
    //                             for(var i = 0; i < evidenciasCriterio10.length; i++){
    //                                 console.log(evidenciasCriterio10[i]); // Se comenta para futuras pruebas...
    //                                 var options = {
    //                                     action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/investigacion/savePuntos",
    //                                     json: {
    //                                         clave: clave,
    //                                         clave_evidencia: evidenciasCriterio10[i],
    //                                         puntos: puntos / parseInt(puntosCriterio10.response[0].puntos),
    //                                         total_puntos: puntos,
    //                                         year: year,
    //                                         id_criterio: criterio,
    //                                         _token: "{{ csrf_token() }}",
    //                                     },
    //                                     type: 'POST',
    //                                     dateType: 'json',
    //                                     mensajeConfirm: 'Se han actualizado los puntos para la evaluación.',
    //                                     url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/investigacion/listInvestigacion?token={{ Session::get('token') }}"
    //                                 };
    //                                 // console.log(options);
    //                                 peticionGeneralAjax(options);
    //                             }
    //                             actualizarDatosCienciaCriterio10(clave, year, 10);
    //                         }
    //                     }
    //                 },
    //             });
    //         },
    //     });
    // }

    // function actualizarDatosCienciaCriterio10(clave, year, criterio){
    //     // console.log(criterio);
    //     consultarDatos({
    //         action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/investigacion/updateDatosInvestigacion/" + clave + "/" + year + "/" + criterio,
    //         type: 'GET',
    //         dataType: 'json',
    //         ok: function(data){
    //             console.log("Puntos actualizados");
    //         },
    //     });
    // }

    // function deletePuntosEvidenciaCriterio10(clave, year, criterio){
    //     var optionsDelete = {
    //         action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/investigacion/deletePuntosInvestigacion/" + clave + "/" + year + "/" + criterio,
    //         json: {
    //             _token: "{{ csrf_token() }}",
    //             _method: 'DELETE',
    //         },
    //         type: 'POST',
    //         dateType: 'json',
    //     };
    //     guardarAutomatico(optionsDelete);
    // }
</script>
