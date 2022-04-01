<div class="table-responsive" width = "100%" id="table_refresh">
    <table id="tblCriterio19" class="table table-bordered table-striped">
        <caption>Registro de diseño industrial otorgado.</caption>
        <thead>
            <tr class="text-center">
                <th scope="col">Clave</th>
                <th scope="col">Nombre</th>
                <th scope="col">Puntos</th>
                <th scope="col">Total</th>
                <th scope="col">Año</th>
                @if (Auth::user()->hasPermissionTo("estimulo-evaluaciones-ciencia-transferencia-index"))
                    <th scope="col">Evidencias</th>
                @endif
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
@include('estimulos.evaluaciones.direccionCiencia.transferencia.modalEvidenciasCriterio19')

<script>
    function obtenerCriterio19(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/transferencia/searchTransferencia/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosCritero19){
                var datosCriterio19 = datosCritero19.response;
                // console.log(datosCritero19);
                // Codigo para guardar en el sistema...
                for(var i = 0; i < datosCriterio19.length; i++){
                    var dataCriterio19 = datosCriterio19[i];
                    // console.log(dataCriterio19);
                    // Codigo para guardar en el sistema...
                    var options = {
                        action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/transferencia/saveDatosTransferencia",
                        json: {
                            clave: dataCriterio19.numero_personal,
                            nombre: dataCriterio19.nombre,
                            id_objetivo: 5,
                            id_criterio: 19,
                            direccion: "DCiencia",
                            puntos: 0,
                            total_puntos: 0,
                            year: year,
                            username: dataCriterio19.username,
                            _token: "{{ csrf_token() }}",
                        },
                        type: 'POST',
                        dateType: 'json',
                    };
                    guardarAutomatico(options);
                    // console.log(options); // e comenta para futuras pruebas...
                    // Finaliza codigo para guardar en el sistema...
                }
                verTablaCriterio19(year, 19);
            },
        });
    }

    function verTablaCriterio19(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/transferencia/datosTransferencia/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosCienciaCriterio19){
                // console.log(datosCienciaCriterio19);
                var datosCienciaCriterio19 = datosCienciaCriterio19.response;
                var row = "";
                for(var i = 0; i < datosCienciaCriterio19.length; i++){
                    var dataCienciaCriterio19 = datosCienciaCriterio19[i];
                    // console.log(dataCienciaCriterio19);
                    var authUser = '<?= Auth::user()->usuario ?>';
                    var permissions = '<?= Auth::user()->hasPermissionTo("estimulo-evaluaciones-ciencia-transferencia-index") ?>';
                    // console.log(permissions);
                    if(dataCienciaCriterio19.username == authUser || permissions == 1){
                        row += "<tr>";
                        row += '<th scope="row" class="text-center" width="10%">' + dataCienciaCriterio19.clave + '</td>';
                        row += '<td width="40%">' + dataCienciaCriterio19.nombre + "</td>";
                        row += '<td class="text-center" width="10%">' + dataCienciaCriterio19.puntos + '</td>';
                        row += '<td class="text-center" width="10%">' + dataCienciaCriterio19.total_puntos + '</td>';
                        row += '<td class="text-center" width="10%">' + dataCienciaCriterio19.year + '</td>';
                        if(permissions == 1){
                            row += '<td class="text-center" width="10%"><a href="javascript:verEvidenciasCriterio19(' + dataCienciaCriterio19.year + ', ' + dataCienciaCriterio19.clave + ', ' + 19 +')"><i class="fa fa-edit"></i></a></td>';
                        }
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

    // function verEvidenciasCriterio19(year, clave, criterio){
    //     consultarDatos({
    //         action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/transferencia/searchEvidenciasTransferencia/" + year + "/" + clave + "/" + criterio,
    //         type: 'GET',
    //         dataType: 'json',
    //         ok: function(dataEvidenciasCriterio19){
    //             // console.log(dataEvidenciasCriterio19); //Comentamos para futuras pruebas...
    //             consultarDatos({
    //                 action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/transferencia/getEvidenciasTransferencia/" + clave + "/" + year + "/" + criterio,
    //                 type: 'GET',
    //                 dataType: 'json',
    //                 ok: function(getEvidenciasCriterio19){
    //                     for(var i = 0; i < getEvidenciasCriterio19.response.length; i++){
    //                         // console.log(getEvidenciasCriterio19.response[i].clave_evidencia); // Se comenta para futuras pruebas...
    //                         var seleccion = getEvidenciasCriterio19.response[i].clave_evidencia;
    //                         $('input[value="' + seleccion + '"]').prop('checked', true);
    //                     }
    //                 },
    //             });
    //             $('#modalEvidenciasCriterio19').modal('show');
    //             var datos = dataEvidenciasCriterio19.response;
    //             var row = "";
    //             $('#clave').val(clave);
    //             $('#year').val(year);
    //             for(var i = 0; i < datos.length; i++){
    //                 var claveData = datos[i];
    //                 // console.log(claveData); //Comentamos para futuras pruebas...
    //                 if(claveData.status == 1){
    //                     var tipo = "-R";
    //                 }else{
    //                     var tipo = "-O";
    //                 }
    //                 row += '<div class="col-12 col-md-2 text-center">';
    //                 row += '<a href="http://126.107.2.56/SINFODI/Files/SINFODI-PropiedadIntelectual/' + claveData.clave + tipo + '.pdf" target="_blank">';
    //                 row += '<img src="{{ asset('img/pdf2.png') }}" width="60px" height="60px">';
    //                 row += '</a><br>';
    //                 row += '<b><input type="checkbox" class="evidenciasCriterio19" name="evidenciasCriterio19[]" id="evidenciasCriterio19'+claveData.clave+tipo+'" value="'+claveData.clave+tipo+'"> ' + claveData.clave+tipo+ '</b>';
    //                 row += '</div>';
    //             }
    //             $("#contenedorCriterio19").html(row).fadeIn('slow');
    //         },
    //     });
    // }

    // function actualizarEvidenciasCriterio19(){
    //     var clave = $('#clave').val();
    //     var year = $('#year').val();
    //     var evidencias = [];
    //     var puntos = 0;
    //     var id = 19;
    //     var objetivo = 5;
    //     consultarDatos({
    //         action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/transferencia/obtenerEvidenciasTransferencia/" + clave + "/" + year + "/" + id,
    //         type: 'GET',
    //         dataType: 'json',
    //         ok: function(searchEvidenciasCriterio19){
    //             var existe = searchEvidenciasCriterio19.response;
    //             // console.log(existe);
    //             consultarDatos({
    //                 action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/transferencia/puntosTransferencia/" + id + "/" + objetivo,
    //                 type: 'GET',
    //                 dataType: 'json',
    //                 ok: function(puntosCriterio19){
    //                     // console.log(puntosCriterio19.response[0].puntos); // Comentamos para futuras pruebas...
    //                     $('input.evidenciasCriterio19:checked').each(function(){
    //                         evidencias.push(this.value);
    //                         puntos = puntos + parseInt(puntosCriterio19.response[0].puntos);
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
    //                             for(var i = 0; i < evidencias.length; i++){
    //                                 // console.log(evidencias[i]); // Se comenta para futuras pruebas...
    //                                 var savePuntos = {
    //                                     action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/transferencia/savePuntos",
    //                                     json: {
    //                                         clave: clave,
    //                                         clave_evidencia: evidencias[i],
    //                                         puntos: puntos / parseInt(puntosCriterio19.response[0].puntos),
    //                                         total_puntos: puntos,
    //                                         year: year,
    //                                         id_criterio: id,
    //                                         _token: "{{ csrf_token() }}",
    //                                     },
    //                                     type: 'POST',
    //                                     dateType: 'json',
    //                                 };
    //                                 // console.log(savePuntos);
    //                                 guardarAutomatico(savePuntos);
    //                             }
    //                             actualizarDatosCienciaCriterio19(clave, year, 19);
    //                             obtenerCriterio19(year, 19);
    //                             $('#modalEvidenciasCriterio19').modal('hide');
    //                         }else{
    //                             deletePuntosEvidenciaCriterio19(clave, year, 19);
    //                             for(var i = 0; i < evidencias.length; i++){
    //                                 // console.log(evidencias[i]); // Se comenta para futuras pruebas...
    //                                 var savePuntos = {
    //                                     action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/transferencia/savePuntos",
    //                                     json: {
    //                                         clave: clave,
    //                                         clave_evidencia: evidencias[i],
    //                                         puntos: puntos / parseInt(puntosCriterio19.response[0].puntos),
    //                                         total_puntos: puntos,
    //                                         year: year,
    //                                         id_criterio: id,
    //                                         _token: "{{ csrf_token() }}",
    //                                     },
    //                                     type: 'POST',
    //                                     dateType: 'json',
    //                                 };
    //                                 // console.log(savePuntos);
    //                                 guardarAutomatico(savePuntos);
    //                             }
    //                             actualizarDatosCienciaCriterio19(clave, year, 19);
    //                             obtenerCriterio19(year, 19);
    //                             $('#modalEvidenciasCriterio19').modal('hide');
    //                         }
    //                     }
    //                 },
    //             });
    //         },
    //     });
    // }

    // function actualizarDatosCienciaCriterio19(clave, year, criterio){
    //     // console.log(criterio);
    //     consultarDatos({
    //         action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/transferencia/updateDatosTransferencia/" + clave + "/" + year + "/" + criterio,
    //         type: 'GET',
    //         dataType: 'json',
    //         ok: function(data){
    //             console.log("Puntos actualizados");
    //         },
    //     });
    // }

    // function deletePuntosEvidenciaCriterio19(clave, year, criterio){
    //     var optionsDelete = {
    //         action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/transferencia/deletePuntosTransferencia/" + clave + "/" + year + "/" + criterio,
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
