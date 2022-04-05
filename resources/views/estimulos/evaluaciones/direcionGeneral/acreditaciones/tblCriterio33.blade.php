<div class="table-responsive" width = "100%" id="table_refresh">
    <table id="tblCriterio33" class="table table-bordered table-striped">
        <caption>Pruebas de desempeño(limite superior de 40 puntos máximo).</caption>
        <thead>
            <tr class="text-center">
                <th scope="col">Clave</th>
                <th scope="col">Nombre</th>
                <th scope="col">Puntos</th>
                <th scope="col">Total</th>
                <th scope="col">Año</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
<script>
    function obtenerCriterio33(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/acreditaciones/searchAcreditaciones/" + year + "/" + criterio,
                type: 'GET',
                dataType: 'json',
                ok: function(datosCritero33 ){
                    var datosCriterio33 = datosCritero33.response;
                    // console.log(datosCritero33);
                    // Codigo para guardar en el sistema...
                    for(var i = 0; i < datosCriterio33.length; i++){
                        var dataCriterio33 = datosCriterio33[i];
                        // console.log(dataCriterio33);
                        consultarDatos({
                            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/formacionRH/searchUsernameFormacionRH/" + dataCriterio33.numero_personal,
                            type: 'GET',
                            dataType: 'json',
                            ok: function(datosCritero33Username){
                                // Codigo para guardar en el sistema...
                                var username = datosCritero33Username.response[0];
                                // console.log(username.clave + "->" + username.usuario);
                                var options = {
                                action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/acreditaciones/saveDatosAcreditaciones",
                                json: {
                                    clave: username.numero_personal,
                                    nombre: username.nombre_personal,
                                    id_objetivo: 8,
                                    id_criterio: criterio,
                                    direccion: "DGeneral",
                                    puntos: 0,
                                    total_puntos: 0,
                                    year: year,
                                    username: username.usuario,
                                    _token: "{{ csrf_token() }}",
                                },
                                type: 'POST',
                                dateType: 'json',
                            };
                            },
                        });
                        // console.log(options); // e comenta para futuras pruebas...
                        guardarAutomatico(options);
                        verTablaCriterio33(year, criterio);
                        // Finaliza codigo para guardar en el sistema...
                    }
                    // verTablaCriterio33(year, criterio);
                },
        });
    }

    function verTablaCriterio33(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/acreditaciones/datosAcreditaciones/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosGeneralCriterio33){
                // console.log(datosGeneralCriterio33);
                var datosGeneralCriterio33 = datosGeneralCriterio33.response;
                var row = "";
                for(var i = 0; i < datosGeneralCriterio33.length; i++){
                    var dataGeneralCriterio33 = datosGeneralCriterio33[i];
                    // console.log(dataGeneralCriterio33);
                    var authUser = '<?= Auth::user()->usuario ?>';
                    var permissions = '<?= Auth::user()->hasPermissionTo("estimulo-evaluaciones-general-formacion-index") ?>';
                    // console.log(permissions);
                    if(dataGeneralCriterio33.username == authUser || permissions == 1){
                        row += "<tr>";
                        row += '<th scope="row" class="text-center" width="10%">' + dataGeneralCriterio33.clave + '</td>';
                        row += '<td width="40%">' + dataGeneralCriterio33.nombre + "</td>";
                        row += '<td class="text-center" width="10%">' + dataGeneralCriterio33.puntos + '</td>';
                        row += '<td class="text-center" width="10%">' + dataGeneralCriterio33.total_puntos + '</td>';
                        row += '<td class="text-center" width="10%">' + dataGeneralCriterio33.year + '</td>';
                        if(permissions == 1){
                            row += '<td class="text-center" width="10%"><a href="javascript:verEvidenciasCriterio33(' + dataGeneralCriterio33.year + ', ' + dataGeneralCriterio33.clave + ', ' + 33 +')"><i class="fa fa-edit"></i></a></td>';
                        }
                        row += "</tr>";
                    }
                }
                if ($.fn.dataTable.isDataTable("#tblCriterio33")) {
                    tblDifusionDivulgacion = $("#tblCriterio33").DataTable();
                    tblDifusionDivulgacion.destroy();
                }
                $('#tblCriterio33 > tbody').html('');
                $('#tblCriterio33 > tbody').append(row);
                $('#tblCriterio33').DataTable({
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
</script>
