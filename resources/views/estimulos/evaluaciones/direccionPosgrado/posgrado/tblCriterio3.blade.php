<div class="table-responsive">
    <table id="tblCriterio3" class="table table-bordered table-striped">
        <caption>Alumno del programa de maestría del CIDETEQ graduado entre 31 y 36 meses.</caption>
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
@include('estimulos.evaluaciones.direccionPosgrado.posgrado.modalEvidenciasCriterio3')

<script>
    function obtenerCriterio3(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/posgrado/searchPosgrado/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosCritero3){
                var datosCriterio3 = datosCritero3.response;
                // console.log(datosCritero3);
                // Codigo para guardar en el sistema...
                for(var i = 0; i < datosCriterio3.length; i++){
                    var dataCriterio3 = datosCriterio3[i];
                    // console.log(dataCriterio3);
                    consultarDatos({
                        action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/posgrado/searchUsernamePosgrado/" + dataCriterio3.numero_personal,
                        type: 'GET',
                        dataType: 'json',
                        ok: function(datosCritero3Username){
                            // Codigo para guardar en el sistema...
                            var username = datosCritero3Username.response[0];
                            // console.log(username.clave + "->" + username.usuario);
                            var options = {
                                action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/posgrado/saveDatosPosgrado",
                                json: {
                                    clave: username.clave,
                                    nombre: username.nombre,
                                    id_objetivo: 2,
                                    id_criterio: 3,
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
                    ok: function(datosPosgradoCriterio3){
                        // console.log(datosPosgradoCriterio3);
                        var datosPosgradoCriterio3 = datosPosgradoCriterio3.response;
                        var row = "";
                        for(var i = 0; i < datosPosgradoCriterio3.length; i++){
                            var dataPosgradoCriterio3 = datosPosgradoCriterio3[i];
                            // console.log(dataPosgradoCriterio3);
                            var authUser = '<?= Auth::user()->usuario ?>';
                            var permissions = '<?= Auth::user()->hasPermissionTo("estimulo-evaluaciones-posgrado-posgrado-index") ?>';
                            // console.log(permissions);
                            if(dataPosgradoCriterio3.username == authUser || permissions == 1){
                                row += "<tr>";
                                row += '<th scope="row" class="text-center" width="10%">' + dataPosgradoCriterio3.clave + '</td>';
                                row += '<td width="40%">' + dataPosgradoCriterio3.nombre + "</td>";
                                row += '<td class="text-center" width="10%">' + dataPosgradoCriterio3.puntos + '</td>';
                                row += '<td class="text-center" width="10%">' + dataPosgradoCriterio3.total_puntos + '</td>';
                                row += '<td class="text-center" width="10%">' + dataPosgradoCriterio3.year + '</td>';
                                if(permissions == 1){
                                    row += '<td class="text-center" width="10%"><a href="javascript:verEvidenciasCriterio3(' + dataPosgradoCriterio3.year + ', ' + dataPosgradoCriterio3.clave + ', ' + 3 +')"><i class="fa fa-edit"></i></a></td>';
                                }
                                row += "</tr>";
                            }
                        }
                        if ($.fn.dataTable.isDataTable("#tblCriterio3")) {
                            tblDifusionDivulgacion = $("#tblCriterio3").DataTable();
                            tblDifusionDivulgacion.destroy();
                        }
                        $('#tblCriterio3 > tbody').html('');
                        $('#tblCriterio3 > tbody').append(row);
                        $('#tblCriterio3').DataTable({
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

    function verEvidenciasCriterio3(year, clave, criterio){
        $('#modalEvidenciasCriterio3').modal('show');
    }
</script>
