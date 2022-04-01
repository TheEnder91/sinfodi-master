<div class="table-responsive">
    <table id="tblCriterio5" class="table table-bordered table-striped">
        <caption>Alumno del programa de maestría del CIDETEQ graduado entre 43 y 48 meses.</caption>
        <thead>
            <tr class="text-center">
                <th scope="col">Clave</th>
                <th scope="col">Nombre</th>
                <th scope="col">Puntos</th>
                <th scope="col">Total</th>
                <th scope="col">Año</th>
                @if (Auth::user()->hasPermissionTo("estimulo-evaluaciones-posgrado-posgrado-index"))
                    <th scope="col">Evidencias</th>
                @endif
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
@include('estimulos.evaluaciones.direccionPosgrado.posgrado.modalEvidenciasCriterio5')

<script>
    function obtenerCriterio5(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/posgrado/searchPosgrado/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosCritero5){
                var datosCriterio5 = datosCritero5.response;
                // console.log(datosCritero5);
                // Codigo para guardar en el sistema...
                for(var i = 0; i < datosCriterio5.length; i++){
                    var dataCriterio5 = datosCriterio5[i];
                    // console.log(dataCriterio5);
                    consultarDatos({
                        action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/posgrado/searchUsernamePosgrado/" + dataCriterio5.numero_personal,
                        type: 'GET',
                        dataType: 'json',
                        ok: function(datosCritero5Username){
                            // Codigo para guardar en el sistema...
                            var username = datosCritero5Username.response[0];
                            // console.log(username.clave + "->" + username.usuario);
                            var options = {
                                action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/posgrado/saveDatosPosgrado",
                                json: {
                                    clave: username.clave,
                                    nombre: username.nombre,
                                    id_objetivo: 2,
                                    id_criterio: 5,
                                    direccion: "DPosgrado",
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
                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/posgrado/datosposgrado/" + year + "/" + criterio,
                    type: 'GET',
                    dataType: 'json',
                    ok: function(datosPosgradoCriterio5){
                        // console.log(datosPosgradoCriterio5);
                        var datosPosgradoCriterio5 = datosPosgradoCriterio5.response;
                        var row = "";
                        for(var i = 0; i < datosPosgradoCriterio5.length; i++){
                            var dataPosgradoCriterio5 = datosPosgradoCriterio5[i];
                            // console.log(dataPosgradoCriterio5);
                            var authUser = '<?= Auth::user()->usuario ?>';
                            var permissions = '<?= Auth::user()->hasPermissionTo("estimulo-evaluaciones-posgrado-posgrado-index") ?>';
                            // console.log(permissions);
                            if(dataPosgradoCriterio5.username == authUser || permissions == 1){
                                row += "<tr>";
                                row += '<th scope="row" class="text-center" width="10%">' + dataPosgradoCriterio5.clave + '</td>';
                                row += '<td width="40%">' + dataPosgradoCriterio5.nombre + "</td>";
                                row += '<td class="text-center" width="10%">' + dataPosgradoCriterio5.puntos + '</td>';
                                row += '<td class="text-center" width="10%">' + dataPosgradoCriterio5.total_puntos + '</td>';
                                row += '<td class="text-center" width="10%">' + dataPosgradoCriterio5.year + '</td>';
                                if(permissions == 1){
                                    row += '<td class="text-center" width="10%"><a href="javascript:verEvidenciasCriterio5(' + dataPosgradoCriterio5.year + ', ' + dataPosgradoCriterio5.clave + ', ' + 5 +')"><i class="fa fa-edit"></i></a></td>';
                                }
                                row += "</tr>";
                            }
                        }
                        if ($.fn.dataTable.isDataTable("#tblCriterio5")) {
                            tblDifusionDivulgacion = $("#tblCriterio5").DataTable();
                            tblDifusionDivulgacion.destroy();
                        }
                        $('#tblCriterio5 > tbody').html('');
                        $('#tblCriterio5 > tbody').append(row);
                        $('#tblCriterio5').DataTable({
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

    function verEvidenciasCriterio5(year, clave, criterio){
        $('#modalEvidenciasCriterio5').modal('show');
    }
</script>
