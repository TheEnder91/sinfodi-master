<div class="table-responsive" width = "100%" id="table_refresh">
    <table id="tblCriterio35" class="table table-bordered table-striped">
        <caption>Pruebas interlaboratorio(puntos por analito 60 puntos máximo).</caption>
        <thead>
            <tr class="text-center">
                <th scope="col">Clave</th>
                <th scope="col">Nombre</th>
                <th scope="col">Puntos</th>
                <th scope="col">Total</th>
                <th scope="col">Año</th>
                <th scope="col">Evidencias</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<script>
    function obtenerCriterio35(year, criterio){
        verTablaCriterio35(year, criterio);
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/acreditaciones/searchAcreditaciones/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosCritero35){
                var datosCriterio35 = datosCritero35.response;
                // console.log(datosCritero35);
                // Codigo para guardar en el sistema...
                for(var i = 0; i < datosCriterio35.length; i++){
                    var dataCriterio35 = datosCriterio35[i];
                    // console.log(dataCriterio35);
                    consultarDatos({
                        action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/formacionRH/searchUsernameFormacionRH/" + dataCriterio35.numero_personal,
                        type: 'GET',
                        dataType: 'json',
                        ok: function(datosCritero35Username){
                            // Codigo para guardar en el sistema...
                            var username = datosCritero35Username.response[0];
                            // console.log(username.clave + "->" + username.usuario);
                            var options = {
                                action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/acreditaciones/saveDatosAcreditaciones",
                                json: {
                                    clave: dataCriterio35.numero_personal,
                                    nombre: dataCriterio35.nombre_personal,
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
                            // console.log(options); // e comenta para futuras pruebas...
                            guardarAutomatico(options);
                            verTablaCriterio35(year, criterio);
                        },
                    });
                    // Finaliza codigo para guardar en el sistema...
                }
            },
        });
    }

    function verTablaCriterio35(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/acreditaciones/datosAcreditaciones/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosGeneralCriterio35){
                // console.log(datosGeneralCriterio35);
                var datosGeneralCriterio35 = datosGeneralCriterio35.response;
                var row = "";
                for(var i = 0; i < datosGeneralCriterio35.length; i++){
                    var dataGeneralCriterio35 = datosGeneralCriterio35[i];
                    // console.log(dataGeneralCriterio35);
                    var authUser = '<?= Auth::user()->usuario ?>';
                    var permissions = '<?= Auth::user()->hasPermissionTo("estimulo-evaluaciones-general-acreditaciones-index") ?>';
                    // console.log(permissions);
                    if(dataGeneralCriterio35.username == authUser || permissions == 1){
                        row += "<tr>";
                        row += '<th scope="row" class="text-center" width="10%">' + dataGeneralCriterio35.clave + '</td>';
                        row += '<td width="40%">' + dataGeneralCriterio35.nombre + "</td>";
                        row += '<td class="text-center" width="10%">' + dataGeneralCriterio35.puntos + '</td>';
                        row += '<td class="text-center" width="10%">' + dataGeneralCriterio35.total_puntos + '</td>';
                        row += '<td class="text-center" width="10%">' + dataGeneralCriterio35.year + '</td>';
                        if(permissions == 1){
                            row += '<td class="text-center" width="10%"><a href="javascript:verEvidenciasCriterio35(' + dataGeneralCriterio35.year + ', ' + dataGeneralCriterio35.clave + ', ' + criterio +')"><i class="fa fa-edit"></i></a></td>';
                        }
                        row += "</tr>";
                    }
                }
                if ($.fn.dataTable.isDataTable("#tblCriterio35")) {
                    tblDifusionDivulgacion = $("#tblCriterio35").DataTable();
                    tblDifusionDivulgacion.destroy();
                }
                $('#tblCriterio35 > tbody').html('');
                $('#tblCriterio35 > tbody').append(row);
                $('#tblCriterio35').DataTable({
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
