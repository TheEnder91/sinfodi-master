<div class="table-responsive" width = "100%" id="table_refresh">
    <table id="tblCriterio24" class="table table-bordered table-striped">
        <caption>Atención a alumnos de verano de la ciencia concluido.</caption>
        <thead>
            <tr class="text-center">
                <th scope="col">Clave</th>
                <th scope="col">Nombre</th>
                <th scope="col">Puntos</th>
                <th scope="col">Total</th>
                <th scope="col">Año</th>
                @if (Auth::user()->hasPermissionTo("estimulo-evaluaciones-administracion-formacion-index"))
                    <th scope="col">Evidencias</th>
                @endif
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
@include('estimulos.evaluaciones.direccionAdministracion.formacion.modalEvidenciasCriterio24')

<script>
    function obtenerCriterio24(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionAdministracion/formacionRH/searchFormacionRH/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosCritero24){
                var datosCriterio24 = datosCritero24.response;
                // console.log(datosCritero24);
                // Codigo para guardar en el sistema...
                for(var i = 0; i < datosCriterio24.length; i++){
                    var dataCriterio24 = datosCriterio24[i];
                    // console.log(dataCriterio24);
                    consultarDatos({
                        action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionAdministracion/formacionRH/searchUsernameFormacionRH/" + dataCriterio24.numero_personal,
                        type: 'GET',
                        dataType: 'json',
                        ok: function(datosCritero24Username){
                            // Codigo para guardar en el sistema...
                            var username = datosCritero24Username.response[0];
                            // console.log(username.clave + "->" + username.usuario);
                            var options = {
                                action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionAdministracion/formacionRH/saveDatosFormacionRH",
                                json: {
                                    clave: username.clave,
                                    nombre: username.nombre,
                                    id_objetivo: 6,
                                    id_criterio: 24,
                                    direccion: "DAdministracion",
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
                            // Finaliza codigo para guardar en el sistema...
                        },
                    });
                }
                consultarDatos({
                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionAdministracion/formacionRH/datosFormacionRH/" + year + "/" + criterio,
                    type: 'GET',
                    dataType: 'json',
                    ok: function(datosAdministracionCriterio24){
                        // console.log(datosAdministracionCriterio24);
                        var datosAdministracionCriterio24 = datosAdministracionCriterio24.response;
                        var row = "";
                        for(var i = 0; i < datosAdministracionCriterio24.length; i++){
                            var dataAdministracionCriterio24 = datosAdministracionCriterio24[i];
                            // console.log(dataAdministracionCriterio24);
                            var authUser = '<?= Auth::user()->usuario ?>';
                            var permissions = '<?= Auth::user()->hasPermissionTo("estimulo-evaluaciones-administracion-formacion-index") ?>';
                            // console.log(permissions);
                            if(dataAdministracionCriterio24.username == authUser || permissions == 1){
                                row += "<tr>";
                                row += '<th scope="row" class="text-center" width="10%">' + dataAdministracionCriterio24.clave + '</td>';
                                row += '<td width="40%">' + dataAdministracionCriterio24.nombre + "</td>";
                                row += '<td class="text-center" width="10%">' + dataAdministracionCriterio24.puntos + '</td>';
                                row += '<td class="text-center" width="10%">' + dataAdministracionCriterio24.total_puntos + '</td>';
                                row += '<td class="text-center" width="10%">' + dataAdministracionCriterio24.year + '</td>';
                                if(permissions == 1){
                                    row += '<td class="text-center" width="10%"><a href="javascript:verEvidenciasCriterio24(' + dataAdministracionCriterio24.year + ', ' + dataAdministracionCriterio24.clave + ', ' + 24 +')"><i class="fa fa-edit"></i></a></td>';
                                }
                                row += "</tr>";
                            }
                        }
                        if ($.fn.dataTable.isDataTable("#tblCriterio24")) {
                            tblDifusionDivulgacion = $("#tblCriterio24").DataTable();
                            tblDifusionDivulgacion.destroy();
                        }
                        $('#tblCriterio24 > tbody').html('');
                        $('#tblCriterio24 > tbody').append(row);
                        $('#tblCriterio24').DataTable({
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

    function verEvidenciasCriterio24(year, clave, criterio){
        $('#modalEvidenciasCriterio24').modal('show');
    }
</script>
