<div class="table-responsive" width = "100%" id="table_refresh">
    <table id="tblCriterio25" class="table table-bordered table-striped">
        <caption>Atención a alumnos de servicio social concluido.</caption>
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
@include('estimulos.evaluaciones.direccionAdministracion.formacion.modalEvidenciasCriterio25')

<script>
    function obtenerCriterio25(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionAdministracion/formacionRH/searchFormacionRH/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosCritero25){
                var datosCriterio25 = datosCritero25.response;
                // console.log(datosCritero25);
                // Codigo para guardar en el sistema...
                for(var i = 0; i < datosCriterio25.length; i++){
                    var dataCriterio25 = datosCriterio25[i];
                    // console.log(dataCriterio25);
                    consultarDatos({
                        action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionAdministracion/formacionRH/searchUsernameFormacionRH/" + dataCriterio25.numero_personal,
                        type: 'GET',
                        dataType: 'json',
                        ok: function(datosCritero25Username){
                            // Codigo para guardar en el sistema...
                            var username = datosCritero25Username.response[0];
                            // console.log(username.clave + "->" + username.usuario);
                            var options = {
                                action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionAdministracion/formacionRH/saveDatosFormacionRH",
                                json: {
                                    clave: username.clave,
                                    nombre: username.nombre,
                                    id_objetivo: 6,
                                    id_criterio: 25,
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
                    ok: function(datosAdministracionCriterio25){
                        // console.log(datosAdministracionCriterio25);
                        var datosAdministracionCriterio25 = datosAdministracionCriterio25.response;
                        var row = "";
                        for(var i = 0; i < datosAdministracionCriterio25.length; i++){
                            var dataAdministracionCriterio25 = datosAdministracionCriterio25[i];
                            // console.log(dataAdministracionCriterio25);
                            var authUser = '<?= Auth::user()->usuario ?>';
                            var permissions = '<?= Auth::user()->hasPermissionTo("estimulo-evaluaciones-administracion-formacion-index") ?>';
                            // console.log(permissions);
                            if(dataAdministracionCriterio25.username == authUser || permissions == 1){
                                row += "<tr>";
                                row += '<th scope="row" class="text-center" width="10%">' + dataAdministracionCriterio25.clave + '</td>';
                                row += '<td width="40%">' + dataAdministracionCriterio25.nombre + "</td>";
                                row += '<td class="text-center" width="10%">' + dataAdministracionCriterio25.puntos + '</td>';
                                row += '<td class="text-center" width="10%">' + dataAdministracionCriterio25.total_puntos + '</td>';
                                row += '<td class="text-center" width="10%">' + dataAdministracionCriterio25.year + '</td>';
                                if(permissions == 1){
                                    row += '<td class="text-center" width="10%"><a href="javascript:verEvidenciasCriterio25(' + dataAdministracionCriterio25.year + ', ' + dataAdministracionCriterio25.clave + ', ' + 25 +')"><i class="fa fa-edit"></i></a></td>';
                                }
                                row += "</tr>";
                            }
                        }
                        if ($.fn.dataTable.isDataTable("#tblCriterio25")) {
                            tblDifusionDivulgacion = $("#tblCriterio25").DataTable();
                            tblDifusionDivulgacion.destroy();
                        }
                        $('#tblCriterio25 > tbody').html('');
                        $('#tblCriterio25 > tbody').append(row);
                        $('#tblCriterio25').DataTable({
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

    function verEvidenciasCriterio25(year, clave, criterio){
        $('#modalEvidenciasCriterio25').modal('show');
    }
</script>
