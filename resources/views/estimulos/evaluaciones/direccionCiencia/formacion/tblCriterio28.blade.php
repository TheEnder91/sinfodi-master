<div class="table-responsive" width = "100%" id="table_refresh">
    <table id="tblCriterio28" class="table table-bordered table-striped">
        <caption>Atención a alumnos de tesis de técnico superior universitario o equivalente.</caption>
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
@include('estimulos.evaluaciones.direccionCiencia.formacion.modalEvidenciasCriterio28')

<script>
    function obtenerCriterio28(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/formacionRH/searchFormacionRH/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosCritero28){
                var datosCriterio28 = datosCritero28.response;
                // console.log(datosCritero28);
                // Codigo para guardar en el sistema...
                for(var i = 0; i < datosCriterio28.length; i++){
                    var dataCriterio28 = datosCriterio28[i];
                    // console.log(dataCriterio28);
                    consultarDatos({
                        action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/formacionRH/searchUsernameFormacionRH/" + dataCriterio28.numero_personal,
                        type: 'GET',
                        dataType: 'json',
                        ok: function(datosCritero28Username){
                            // Codigo para guardar en el sistema...
                            var username = datosCritero28Username.response[0];
                            // console.log(username.clave + "->" + username.usuario);
                            var options = {
                                action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/formacionRH/saveDatosFormacionRH",
                                json: {
                                    clave: username.clave,
                                    nombre: username.nombre,
                                    id_objetivo: 6,
                                    id_criterio: 28,
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
                            verTablaCriterio28(year, 28);
                            // Finaliza codigo para guardar en el sistema...
                        },
                    });
                }
                verTablaCriterio28(year, 28);
            },
        });
    }

    function verTablaCriterio28(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/formacionRH/datosFormacionRH/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosCienciaCriterio28){
                // console.log(datosCienciaCriterio28);
                var datosCienciaCriterio28 = datosCienciaCriterio28.response;
                var row = "";
                for(var i = 0; i < datosCienciaCriterio28.length; i++){
                    var dataCienciaCriterio28 = datosCienciaCriterio28[i];
                    // console.log(dataCienciaCriterio28);
                    var authUser = '<?= Auth::user()->usuario ?>';
                    var permissions = '<?= Auth::user()->hasPermissionTo("estimulo-evaluaciones-ciencia-formacion-index") ?>';
                    // console.log(permissions);
                    if(dataCienciaCriterio28.username == authUser || permissions == 1){
                        row += "<tr>";
                        row += '<th scope="row" class="text-center" width="10%">' + dataCienciaCriterio28.clave + '</td>';
                        row += '<td width="40%">' + dataCienciaCriterio28.nombre + "</td>";
                        row += '<td class="text-center" width="10%">' + dataCienciaCriterio28.puntos + '</td>';
                        row += '<td class="text-center" width="10%">' + dataCienciaCriterio28.total_puntos + '</td>';
                        row += '<td class="text-center" width="10%">' + dataCienciaCriterio28.year + '</td>';
                        if(permissions == 1){
                            row += '<td class="text-center" width="10%"><a href="javascript:verEvidenciasCriterio28(' + dataCienciaCriterio28.year + ', ' + dataCienciaCriterio28.clave + ', ' + 28 +')"><i class="fa fa-edit"></i></a></td>';
                        }
                        row += "</tr>";
                    }
                }
                if ($.fn.dataTable.isDataTable("#tblCriterio28")) {
                    tblDifusionDivulgacion = $("#tblCriterio28").DataTable();
                    tblDifusionDivulgacion.destroy();
                }
                $('#tblCriterio28 > tbody').html('');
                $('#tblCriterio28 > tbody').append(row);
                $('#tblCriterio28').DataTable({
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

    function verEvidenciasCriterio28(year, clave, criterio){
        $('#modalEvidenciasCriterio28').modal('show');
    }
</script>
