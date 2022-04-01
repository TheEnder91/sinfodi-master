<div class="table-responsive" width = "100%">
    <table id="tblCriterio8" class="table table-bordered table-striped">
        <caption>Publicación de Artículos en revistas de circulación internacional con arbitraje, factor de impacto mayor de 4.0.</caption>
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
@include('estimulos.evaluaciones.direccionCiencia.investigacion.modalEvidenciasCriterio8')

<script>
    function obtenerCriterio8(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/investigacion/searchInvestigacion/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosCritero8){
                var datosCriterio8 = datosCritero8.response;
                // console.log(datosCritero8);
                // Codigo para guardar en el sistema...
                for(var i = 0; i < datosCriterio8.length; i++){
                    var dataCriterio8 = datosCriterio8[i];
                    var options = {
                        action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/investigacion/saveDatosInvestigacion",
                        json: {
                            clave: dataCriterio8.numero_personal,
                            nombre: dataCriterio8.nombre,
                            id_objetivo: 3,
                            id_criterio: 8,
                            direccion: "DCiencia",
                            puntos: 0,
                            total_puntos: 0,
                            year: year,
                            username: dataCriterio8.username,
                            _token: "{{ csrf_token() }}",
                        },
                        type: 'POST',
                        dateType: 'json',
                    };
                    // console.log(options); // e comenta para futuras pruebas...
                    guardarAutomatico(options);
                    // Finaliza codigo para guardar en el sistema...
                }
                varTablaCriterio8(year, 8);
            },
        });
    }

    function varTablaCriterio8(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/investigacion/datosInvestigacion/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosCienciaCriterio8){
                // console.log(datosCienciaCriterio8);
                var datosCienciaCriterio8 = datosCienciaCriterio8.response;
                var row = "";
                for(var i = 0; i < datosCienciaCriterio8.length; i++){
                    var dataCienciaCriterio8 = datosCienciaCriterio8[i];
                    // console.log(dataCienciaCriterio8);
                    var authUser = '<?= Auth::user()->usuario ?>';
                    var permissions = '<?= Auth::user()->hasPermissionTo("estimulo-evaluaciones-ciencia-investigacion-index") ?>';
                    // console.log(permissions);
                    if(dataCienciaCriterio8.username == authUser || permissions == 1){
                        row += "<tr>";
                        row += '<th scope="row" class="text-center" width="10%">' + dataCienciaCriterio8.clave + '</td>';
                        row += '<td width="40%">' + dataCienciaCriterio8.nombre + "</td>";
                        row += '<td class="text-center" width="10%">' + dataCienciaCriterio8.puntos + '</td>';
                        row += '<td class="text-center" width="10%">' + dataCienciaCriterio8.total_puntos + '</td>';
                        row += '<td class="text-center" width="10%">' + dataCienciaCriterio8.year + '</td>';
                        if(permissions == 1){
                            row += '<td class="text-center" width="10%"><a href="javascript:verEvidenciasCriterio8(' + dataCienciaCriterio8.year + ', ' + dataCienciaCriterio8.clave + ', ' + 8 +')"><i class="fa fa-edit"></i></a></td>';
                        }
                        row += "</tr>";
                    }
                }
                if ($.fn.dataTable.isDataTable("#tblCriterio8")) {
                    tblDifusionDivulgacion = $("#tblCriterio8").DataTable();
                    tblDifusionDivulgacion.destroy();
                }
                $('#tblCriterio8 > tbody').html('');
                $('#tblCriterio8 > tbody').append(row);
                $('#tblCriterio8').DataTable({
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

    // function verEvidenciasCriterio8(year, clave, criterio){
    //     consultarDatos({
    //         action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/investigacion/searchEvidenciasInvestigacion/" + year + "/" + clave + "/" + criterio,
    //         type: 'GET',
    //         dataType: 'json',
    //         ok: function(dataEvidenciasCriterio8){
    //             // console.log(dataEvidenciasCriterio8); //Comentamos para futuras pruebas...
    //             consultarDatos({
    //                 action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/investigacion/getEvidenciasInvestigacion/" + clave + "/" + year + "/" + criterio,
    //                 type: 'GET',
    //                 dataType: 'json',
    //                 ok: function(getEvidenciasCriterio8){
    //                     for(var i = 0; i < getEvidenciasCriterio8.response.length; i++){
    //                         var seleccion = getEvidenciasCriterio8.response[i].clave_evidencia;
    //                         $('input[value="' + seleccion + '"]').prop('checked', true);
    //                     }
    //                 },
    //             });
    //             $('#modalEvidenciasCriterio8').modal('show');
    //             var datos = dataEvidenciasCriterio8.response;
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
    //                 row += '<b><input type="checkbox" class="evidenciasCriterio8" name="evidenciasCriterio8[]" id="evidenciasCriterio8'+claveData.clave+'" value="'+claveData.clave+'"> ' + claveData.clave + '</b>';
    //                 row += '</div>';
    //             }
    //             $("#contenedorCriterio8").html(row).fadeIn('slow');
    //         },
    //     });
    // }

    // function actualizarEvidenciasCriterio8(){
    //     var clave = $('#clave').val();
    //     var year = $('#year').val();
    //     var evidenciasCriterio8 = [];
    //     var puntos = 0;
    //     var criterio = 8;
    //     var objetivo = 3;
    //     consultarDatos({
    //         action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/investigacion/obtenerEvidenciasInvestigacion/" + clave + "/" + year + "/" + criterio,
    //         type: 'GET',
    //         dataType: 'json',
    //         ok: function(searchEvidenciasCriterio8){
    //             var existe = searchEvidenciasCriterio8.response;
    //             // console.log(existe);
    //             consultarDatos({
    //                 action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/investigacion/puntosinvestigacion/" + criterio + "/" + objetivo,
    //                 type: 'GET',
    //                 dataType: 'json',
    //                 ok: function(puntosCriterio8){
    //                     // console.log(puntosCriterio8.response[0].puntos); // Comentamos para futuras pruebas...
    //                     $('input.evidenciasCriterio8:checked').each(function(){
    //                         evidenciasCriterio8.push(this.value);
    //                         puntos = puntos + parseInt(puntosCriterio8.response[0].puntos);
    //                     });
    //                     if(puntos == 0){
    //                         swal({
    //                             type: 'warning',
    //                             title: 'Favor de seleccionar las evidencias.',
    //                             showConfirmButton: false,
    //                             timer: 1800
    //                         }).catch(swal.noop);
    //                     }else{
    //                         if(existe == 0){
    //                             for(var i = 0; i < evidenciasCriterio8.length; i++){
    //                                 console.log(evidenciasCriterio8[i]); // Se comenta para futuras pruebas...
    //                                 var options = {
    //                                     action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/investigacion/savePuntos",
    //                                     json: {
    //                                         clave: clave,
    //                                         clave_evidencia: evidenciasCriterio8[i],
    //                                         puntos: puntos / parseInt(puntosCriterio8.response[0].puntos),
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
    //                             actualizarDatosCienciaCriterio8(clave, year, 8)
    //                         }else{
    //                             deletePuntosEvidenciaCriterio8(clave, year, 8);
    //                             for(var i = 0; i < evidenciasCriterio8.length; i++){
    //                                 console.log(evidenciasCriterio8[i]); // Se comenta para futuras pruebas...
    //                                 var options = {
    //                                     action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/investigacion/savePuntos",
    //                                     json: {
    //                                         clave: clave,
    //                                         clave_evidencia: evidenciasCriterio8[i],
    //                                         puntos: puntos / parseInt(puntosCriterio8.response[0].puntos),
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
    //                             actualizarDatosCienciaCriterio8(clave, year, 8)
    //                         }
    //                     }
    //                 },
    //             });
    //         },
    //     });
    // }

    // function actualizarDatosCienciaCriterio8(clave, year, criterio){
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

    // function deletePuntosEvidenciaCriterio8(clave, year, criterio){
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
