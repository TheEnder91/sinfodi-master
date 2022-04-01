<div class="table-responsive" width = "100%" id="table_refresh">
    <table id="tblCriterio31" class="table table-bordered table-striped">
        <caption>Atención a alumnos de tesis de doctorado concluida.</caption>
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
@include('estimulos.evaluaciones.direccionAdministracion.formacion.modalEvidenciasCriterio31')

<script>
    function obtenerCriterio31(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionAdministracion/formacionRH/searchFormacionRH/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosCritero31){
                var datosCriterio31 = datosCritero31.response;
                // console.log(datosCritero31);
                // Codigo para guardar en el sistema...
                for(var i = 0; i < datosCriterio31.length; i++){
                    var dataCriterio31 = datosCriterio31[i];
                    // console.log(dataCriterio31);
                    consultarDatos({
                        action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionAdministracion/formacionRH/searchUsernameFormacionRH/" + dataCriterio31.numero_personal,
                        type: 'GET',
                        dataType: 'json',
                        ok: function(datosCritero31Username){
                            // Codigo para guardar en el sistema...
                            var username = datosCritero31Username.response[0];
                            // console.log(username.clave + "->" + username.usuario);
                            var options = {
                                action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionAdministracion/formacionRH/saveDatosFormacionRH",
                                json: {
                                    clave: username.clave,
                                    nombre: username.nombre,
                                    id_objetivo: 6,
                                    id_criterio: 31,
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
                    ok: function(datosAdministracionCriterio31){
                        // console.log(datosAdministracionCriterio31);
                        var datosAdministracionCriterio31 = datosAdministracionCriterio31.response;
                        var row = "";
                        for(var i = 0; i < datosAdministracionCriterio31.length; i++){
                            var dataAdministracionCriterio31 = datosAdministracionCriterio31[i];
                            // console.log(dataAdministracionCriterio31);
                            var authUser = '<?= Auth::user()->usuario ?>';
                            var permissions = '<?= Auth::user()->hasPermissionTo("estimulo-evaluaciones-administracion-formacion-index") ?>';
                            // console.log(permissions);
                            if(dataAdministracionCriterio31.username == authUser || permissions == 1){
                                row += "<tr>";
                                row += '<th scope="row" class="text-center" width="10%">' + dataAdministracionCriterio31.clave + '</td>';
                                row += '<td width="40%">' + dataAdministracionCriterio31.nombre + "</td>";
                                row += '<td class="text-center" width="10%">' + dataAdministracionCriterio31.puntos + '</td>';
                                row += '<td class="text-center" width="10%">' + dataAdministracionCriterio31.total_puntos + '</td>';
                                row += '<td class="text-center" width="10%">' + dataAdministracionCriterio31.year + '</td>';
                                if(permissions == 1){
                                    row += '<td class="text-center" width="10%"><a href="javascript:verEvidenciasCriterio31(' + dataAdministracionCriterio31.year + ', ' + dataAdministracionCriterio31.clave + ', ' + 31 +')"><i class="fa fa-edit"></i></a></td>';
                                }
                                row += "</tr>";
                            }
                        }
                        if ($.fn.dataTable.isDataTable("#tblCriterio31")) {
                            tblDifusionDivulgacion = $("#tblCriterio31").DataTable();
                            tblDifusionDivulgacion.destroy();
                        }
                        $('#tblCriterio31 > tbody').html('');
                        $('#tblCriterio31 > tbody').append(row);
                        $('#tblCriterio31').DataTable({
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

    function verEvidenciasCriterio31(year, clave, criterio){
        $('#modalEvidenciasCriterio31').modal('show');
    }
</script>
