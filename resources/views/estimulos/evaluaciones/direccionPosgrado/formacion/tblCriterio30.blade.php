<div class="table-responsive" width = "100%" id="table_refresh">
    <table id="tblCriterio30" class="table table-bordered table-striped">
        <caption>Atención a alumnos de tesis de maestría concluida.</caption>
        <thead>
            <tr class="text-center">
                <th scope="col">Clave</th>
                <th scope="col">Nombre</th>
                <th scope="col">Puntos</th>
                <th scope="col">Total</th>
                <th scope="col">Año</th>
                @if (Auth::user()->hasPermissionTo("estimulo-evaluaciones-posgrado-formacion-index"))
                    <th scope="col">Evidencias</th>
                @endif
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
@include('estimulos.evaluaciones.direccionPosgrado.formacion.modalEvidenciasCriterio30')

<script>
    function obtenerCriterio30(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/formacionRH/searchFormacionRH/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosCritero30){
                var datosCriterio30 = datosCritero30.response;
                // console.log(datosCritero30);
                // Codigo para guardar en el sistema...
                for(var i = 0; i < datosCriterio30.length; i++){
                    var dataCriterio30 = datosCriterio30[i];
                    // console.log(dataCriterio30);
                    consultarDatos({
                        action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/formacionRH/searchUsernameFormacionRH/" + dataCriterio30.numero_personal,
                        type: 'GET',
                        dataType: 'json',
                        ok: function(datosCritero30Username){
                            // Codigo para guardar en el sistema...
                            var username = datosCritero30Username.response[0];
                            // console.log(username.clave + "->" + username.usuario);
                            var options = {
                                action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/formacionRH/saveDatosFormacionRH",
                                json: {
                                    clave: username.clave,
                                    nombre: username.nombre,
                                    id_objetivo: 6,
                                    id_criterio: 30,
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
                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/formacionRH/datosFormacionRH/" + year + "/" + criterio,
                    type: 'GET',
                    dataType: 'json',
                    ok: function(datosPosgradoCriterio30){
                        // console.log(datosPosgradoCriterio30);
                        var datosPosgradoCriterio30 = datosPosgradoCriterio30.response;
                        var row = "";
                        for(var i = 0; i < datosPosgradoCriterio30.length; i++){
                            var dataPosgradoCriterio30 = datosPosgradoCriterio30[i];
                            // console.log(dataPosgradoCriterio30);
                            var authUser = '<?= Auth::user()->usuario ?>';
                            var permissions = '<?= Auth::user()->hasPermissionTo("estimulo-evaluaciones-posgrado-formacion-index") ?>';
                            // console.log(permissions);
                            if(dataPosgradoCriterio30.username == authUser || permissions == 1){
                                row += "<tr>";
                                row += '<th scope="row" class="text-center" width="10%">' + dataPosgradoCriterio30.clave + '</td>';
                                row += '<td width="40%">' + dataPosgradoCriterio30.nombre + "</td>";
                                row += '<td class="text-center" width="10%">' + dataPosgradoCriterio30.puntos + '</td>';
                                row += '<td class="text-center" width="10%">' + dataPosgradoCriterio30.total_puntos + '</td>';
                                row += '<td class="text-center" width="10%">' + dataPosgradoCriterio30.year + '</td>';
                                if(permissions == 1){
                                    row += '<td class="text-center" width="10%"><a href="javascript:verEvidenciasCriterio30(' + dataPosgradoCriterio30.year + ', ' + dataPosgradoCriterio30.clave + ', ' + 30 +')"><i class="fa fa-edit"></i></a></td>';
                                }
                                row += "</tr>";
                            }
                        }
                        if ($.fn.dataTable.isDataTable("#tblCriterio30")) {
                            tblDifusionDivulgacion = $("#tblCriterio30").DataTable();
                            tblDifusionDivulgacion.destroy();
                        }
                        $('#tblCriterio30 > tbody').html('');
                        $('#tblCriterio30 > tbody').append(row);
                        $('#tblCriterio30').DataTable({
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

    function verEvidenciasCriterio30(year, clave, criterio){
        $('#modalEvidenciasCriterio30').modal('show');
    }
</script>
