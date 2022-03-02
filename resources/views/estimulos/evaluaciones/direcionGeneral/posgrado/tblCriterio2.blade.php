<div class="table-responsive">
    <table id="tblCriterio2" class="table table-bordered table-striped">
        <caption>Alumno del programa de maestría del CIDETEQ graduado entre 20 y 30 meses.</caption>
        <thead>
            <tr class="text-center">
                <th scope="col">Clave</th>
                <th scope="col">Nombre</th>
                <th scope="col">Puntos</th>
                <th scope="col">Total</th>
                <th scope="col">Año</th>
                @if (Auth::user()->hasPermissionTo("estimulo-evaluaciones-direccionGral-posgrado-index"))
                    <th scope="col">Evidencias</th>
                @endif
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
@include('estimulos.evaluaciones.direcionGeneral.posgrado.modalEvidenciasCriterio2')

<script>
    function obtenerCriterio2(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/posgrado/searchPosgrado/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosCritero2){
                var datosCriterio2 = datosCritero2.response;
                // console.log(datosCritero2);
                // Codigo para guardar en el sistema...
                for(var i = 0; i < datosCriterio2.length; i++){
                    var dataCriterio2 = datosCriterio2[i];
                    // console.log(dataCriterio2);
                    consultarDatos({
                        action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/posgrado/searchUsernamePosgrado/" + dataCriterio2.numero_personal,
                        type: 'GET',
                        dataType: 'json',
                        ok: function(datosCritero2Username){
                            // Codigo para guardar en el sistema...
                            var username = datosCritero2Username.response[0];
                            // console.log(username.clave + "->" + username.usuario);
                            var options = {
                                action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/posgrado/saveDatosPosgrado",
                                json: {
                                    clave: username.clave,
                                    nombre: username.nombre,
                                    id_objetivo: 2,
                                    id_criterio: 2,
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
                            // Finaliza codigo para guardar en el sistema...
                        },
                    });
                }
                consultarDatos({
                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/posgrado/datosposgrado/" + year + "/" + criterio,
                    type: 'GET',
                    dataType: 'json',
                    ok: function(datosGeneralCriterio2){
                        // console.log(datosGeneralCriterio2);
                        var datosGeneralCriterio2 = datosGeneralCriterio2.response;
                        var row = "";
                        for(var i = 0; i < datosGeneralCriterio2.length; i++){
                            var dataGeneralCriterio2 = datosGeneralCriterio2[i];
                            // console.log(dataGeneralCriterio2);
                            var authUser = '<?= Auth::user()->usuario ?>';
                            var permissions = '<?= Auth::user()->hasPermissionTo("estimulo-evaluaciones-direccionGral-posgrado-index") ?>';
                            // console.log(permissions);
                            if(dataGeneralCriterio2.username == authUser || permissions == 1){
                                row += "<tr>";
                                row += '<th scope="row" class="text-center" width="10%">' + dataGeneralCriterio2.clave + '</td>';
                                row += '<td width="40%">' + dataGeneralCriterio2.nombre + "</td>";
                                row += '<td class="text-center" width="10%">' + dataGeneralCriterio2.puntos + '</td>';
                                row += '<td class="text-center" width="10%">' + dataGeneralCriterio2.total_puntos + '</td>';
                                row += '<td class="text-center" width="10%">' + dataGeneralCriterio2.year + '</td>';
                                if(permissions == 1){
                                    row += '<td class="text-center" width="10%"><a href="javascript:verEvidenciasCriterio2(' + dataGeneralCriterio2.year + ', ' + dataGeneralCriterio2.clave + ', ' + 2 +')"><i class="fa fa-edit"></i></a></td>';
                                }
                                row += "</tr>";
                            }
                        }
                        if ($.fn.dataTable.isDataTable("#tblCriterio2")) {
                            tblDifusionDivulgacion = $("#tblCriterio2").DataTable();
                            tblDifusionDivulgacion.destroy();
                        }
                        $('#tblCriterio2 > tbody').html('');
                        $('#tblCriterio2 > tbody').append(row);
                        $('#tblCriterio2').DataTable({
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

    function verEvidenciasCriterio2(year, clave, criterio){
        $('#modalEvidenciasCriterio2').modal('show');
    }
</script>
