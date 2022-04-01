<div class="table-responsive" width = "100%" id="table_refresh">
    <table id="tblCriterio29" class="table table-bordered table-striped">
        <caption>Atención a alumnos de tesis de licenciatura concluida.</caption>
        <thead>
            <tr class="text-center">
                <th scope="col">Clave</th>
                <th scope="col">Nombre</th>
                <th scope="col">Puntos</th>
                <th scope="col">Total</th>
                <th scope="col">Año</th>
                @if (Auth::user()->hasPermissionTo("estimulo-evaluaciones-ciencia-formacion-index"))
                    <th scope="col">Evidencias</th>
                @endif
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
@include('estimulos.evaluaciones.direccionCiencia.formacion.modalEvidenciasCriterio29')

<script>
    function obtenerCriterio29(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/formacionRH/searchFormacionRH/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosCritero29){
                var datosCriterio29 = datosCritero29.response;
                // console.log(datosCritero29);
                // Codigo para guardar en el sistema...
                for(var i = 0; i < datosCriterio29.length; i++){
                    var dataCriterio29 = datosCriterio29[i];
                    // console.log(dataCriterio29);
                    consultarDatos({
                        action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/formacionRH/searchUsernameFormacionRH/" + dataCriterio29.numero_personal,
                        type: 'GET',
                        dataType: 'json',
                        ok: function(datosCritero29Username){
                            // Codigo para guardar en el sistema...
                            var username = datosCritero29Username.response[0];
                            // console.log(username.clave + "->" + username.usuario);
                            var options = {
                                action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/formacionRH/saveDatosFormacionRH",
                                json: {
                                    clave: username.clave,
                                    nombre: username.nombre,
                                    id_objetivo: 6,
                                    id_criterio: 29,
                                    direccion: "DCiencia",
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
                            verTablaCriterio29(year, 29);
                            // Finaliza codigo para guardar en el sistema...
                        },
                    });
                }
                verTablaCriterio29(year, 29);
            },
        });
    }

    function verTablaCriterio29(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/formacionRH/datosFormacionRH/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosCienciaCriterio29){
                // console.log(datosCienciaCriterio29);
                var datosCienciaCriterio29 = datosCienciaCriterio29.response;
                var row = "";
                for(var i = 0; i < datosCienciaCriterio29.length; i++){
                    var dataCienciaCriterio29 = datosCienciaCriterio29[i];
                    // console.log(dataCienciaCriterio29);
                    var authUser = '<?= Auth::user()->usuario ?>';
                    var permissions = '<?= Auth::user()->hasPermissionTo("estimulo-evaluaciones-ciencia-formacion-index") ?>';
                    // console.log(permissions);
                    if(dataCienciaCriterio29.username == authUser || permissions == 1){
                        row += "<tr>";
                        row += '<th scope="row" class="text-center" width="10%">' + dataCienciaCriterio29.clave + '</td>';
                        row += '<td width="40%">' + dataCienciaCriterio29.nombre + "</td>";
                        row += '<td class="text-center" width="10%">' + dataCienciaCriterio29.puntos + '</td>';
                        row += '<td class="text-center" width="10%">' + dataCienciaCriterio29.total_puntos + '</td>';
                        row += '<td class="text-center" width="10%">' + dataCienciaCriterio29.year + '</td>';
                        if(permissions == 1){
                            row += '<td class="text-center" width="10%"><a href="javascript:verEvidenciasCriterio29(' + dataCienciaCriterio29.year + ', ' + dataCienciaCriterio29.clave + ', ' + 29 +')"><i class="fa fa-edit"></i></a></td>';
                        }
                        row += "</tr>";
                    }
                }
                if ($.fn.dataTable.isDataTable("#tblCriterio29")) {
                    tblDifusionDivulgacion = $("#tblCriterio29").DataTable();
                    tblDifusionDivulgacion.destroy();
                }
                $('#tblCriterio29 > tbody').html('');
                $('#tblCriterio29 > tbody').append(row);
                $('#tblCriterio29').DataTable({
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

    function verEvidenciasCriterio29(year, clave, criterio){
        $('#modalEvidenciasCriterio29').modal('show');
    }
</script>
