<div class="table-responsive" width = "100%" id="table_refresh">
    <table id="tblCriterio27" class="table table-bordered table-striped">
        <caption>Atención a alumnos de residencia profesional concluida.</caption>
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
@include('estimulos.evaluaciones.direccionCiencia.formacion.modalEvidenciasCriterio27')

<script>
    function obtenerCriterio27(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/formacionRH/searchFormacionRH/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosCritero27){
                var datosCriterio27 = datosCritero27.response;
                // console.log(datosCritero27);
                // Codigo para guardar en el sistema...
                for(var i = 0; i < datosCriterio27.length; i++){
                    var dataCriterio27 = datosCriterio27[i];
                    // console.log(dataCriterio27);
                    consultarDatos({
                        action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/formacionRH/searchUsernameFormacionRH/" + dataCriterio27.numero_personal,
                        type: 'GET',
                        dataType: 'json',
                        ok: function(datosCritero27Username){
                            // Codigo para guardar en el sistema...
                            var username = datosCritero27Username.response[0];
                            // console.log(username.clave + "->" + username.usuario);
                            var options = {
                                action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/formacionRH/saveDatosFormacionRH",
                                json: {
                                    clave: username.clave,
                                    nombre: username.nombre,
                                    id_objetivo: 6,
                                    id_criterio: 27,
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
                            verTablaCriterio27(year, 27);
                            // Finaliza codigo para guardar en el sistema...
                        },
                    });
                }
                verTablaCriterio27(year, 27);
            },
        });
    }

    function verTablaCriterio27(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/formacionRH/datosFormacionRH/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosCienciaCriterio27){
                // console.log(datosCienciaCriterio27);
                var datosCienciaCriterio27 = datosCienciaCriterio27.response;
                var row = "";
                for(var i = 0; i < datosCienciaCriterio27.length; i++){
                    var dataCienciaCriterio27 = datosCienciaCriterio27[i];
                    // console.log(dataCienciaCriterio27);
                    var authUser = '<?= Auth::user()->usuario ?>';
                    var permissions = '<?= Auth::user()->hasPermissionTo("estimulo-evaluaciones-ciencia-formacion-index") ?>';
                    // console.log(permissions);
                    if(dataCienciaCriterio27.username == authUser || permissions == 1){
                        row += "<tr>";
                        row += '<th scope="row" class="text-center" width="10%">' + dataCienciaCriterio27.clave + '</td>';
                        row += '<td width="40%">' + dataCienciaCriterio27.nombre + "</td>";
                        row += '<td class="text-center" width="10%">' + dataCienciaCriterio27.puntos + '</td>';
                        row += '<td class="text-center" width="10%">' + dataCienciaCriterio27.total_puntos + '</td>';
                        row += '<td class="text-center" width="10%">' + dataCienciaCriterio27.year + '</td>';
                        if(permissions == 1){
                            row += '<td class="text-center" width="10%"><a href="javascript:verEvidenciasCriterio27(' + dataCienciaCriterio27.year + ', ' + dataCienciaCriterio27.clave + ', ' + 27 +')"><i class="fa fa-edit"></i></a></td>';
                        }
                        row += "</tr>";
                    }
                }
                if ($.fn.dataTable.isDataTable("#tblCriterio27")) {
                    tblDifusionDivulgacion = $("#tblCriterio27").DataTable();
                    tblDifusionDivulgacion.destroy();
                }
                $('#tblCriterio27 > tbody').html('');
                $('#tblCriterio27 > tbody').append(row);
                $('#tblCriterio27').DataTable({
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

    function verEvidenciasCriterio27(year, clave, criterio){
        $('#modalEvidenciasCriterio27').modal('show');
    }
</script>
