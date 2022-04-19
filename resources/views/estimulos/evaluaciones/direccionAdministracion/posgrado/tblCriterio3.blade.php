<div class="table-responsive">
    <table id="tblCriterio3" class="table table-bordered table-striped" style="font-size:13px;">
        <caption style="font-size:13px;">Alumno del programa de maestría del CIDETEQ graduado entre 31 y 36 meses.</caption>
        <thead>
            <tr class="text-center">
                <th scope="col" style="font-size:13px;">Clave</th>
                <th scope="col" style="font-size:13px;">Nombre</th>
                <th scope="col" style="font-size:13px;">Puntos</th>
                <th scope="col" style="font-size:13px;">Total</th>
                <th scope="col" style="font-size:13px;">Año</th>
                @if (Auth::user()->hasPermissionTo("estimulo-evaluaciones-administracion-posgrado-index"))
                    <th scope="col" style="font-size:13px;">Evidencias</th>
                @endif
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
@include('estimulos.evaluaciones.direccionAdministracion.posgrado.modalEvidenciasCriterio3')

<script>
    function obtenerCriterio3(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionAdministracion/posgrado/searchPosgrado/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosCritero3){
                var datosCriterio3 = datosCritero3.response;
                // console.log(datosCritero3);
                // Codigo para guardar en el sistema...
                if(datosCriterio3.length > 0){
                    for(var i = 0; i < datosCriterio3.length; i++){
                        var dataCriterio3 = datosCriterio3[i];
                        // console.log(dataCriterio3);
                        consultarDatos({
                            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionAdministracion/posgrado/searchUsernamePosgrado/" + dataCriterio3.numero_personal,
                            type: 'GET',
                            dataType: 'json',
                            ok: function(datosCritero3Username){
                                // Codigo para guardar en el sistema...
                                var username = datosCritero3Username.response[0];
                                // console.log(username.clave + "->" + username.usuario);
                                $.ajax({
                                    type: 'POST',
                                    url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionAdministracion/posgrado/saveDatosPosgrado",
                                    data: {
                                        token: $('#txtTokenRepo').val(),
                                        clave: username.clave,
                                        nombre: username.nombre,
                                        id_objetivo: 2,
                                        id_criterio: criterio,
                                        direccion: "DAdministracion",
                                        puntos: 0,
                                        total_puntos: 0,
                                        year: year,
                                        username: username.usuario
                                    },
                                    headers: {
                                        'token' : $('#txtTokenRepo').val() ? $('#txtTokenRepo').val(): ''
                                    },
                                    success: function(data){
                                        verTablaCriterio3(year, criterio);
                                    }
                                });
                            },
                        });
                    }
                }else{
                    verTablaCriterio3(year, criterio);
                }
            },
        });
    }

    function verTablaCriterio3(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionAdministracion/posgrado/datosposgrado/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosAdministracionCriterio3){
                // console.log(datosAdministracionCriterio3);
                var datosAdministracionCriterio3 = datosAdministracionCriterio3.response;
                var row = "";
                for(var i = 0; i < datosAdministracionCriterio3.length; i++){
                    var dataAdministracionCriterio3 = datosAdministracionCriterio3[i];
                    // console.log(dataAdministracionCriterio3);
                    var authUser = '<?= Auth::user()->usuario ?>';
                    var permissions = '<?= Auth::user()->hasPermissionTo("estimulo-evaluaciones-administracion-posgrado-index") ?>';
                    // console.log(permissions);
                    if(dataAdministracionCriterio3.username == authUser || permissions == 1){
                        row += "<tr>";
                        row += '<th scope="row" class="text-center" width="10%" style="font-size:12px;">' + dataAdministracionCriterio3.clave + '</td>';
                        row += '<td width="40%" style="font-size:12px;">' + dataAdministracionCriterio3.nombre + "</td>";
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + dataAdministracionCriterio3.puntos + '</td>';
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + dataAdministracionCriterio3.total_puntos + '</td>';
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + dataAdministracionCriterio3.year + '</td>';
                        if(permissions == 1){
                            row += '<td class="text-center" width="10%" style="font-size:12px;"><a href="javascript:verEvidenciasCriterio3(' + dataAdministracionCriterio3.year + ', ' + dataAdministracionCriterio3.clave + ', ' + 3 +')"><i class="fa fa-edit"></i></a></td>';
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
    }

    function verEvidenciasCriterio3(year, clave, criterio){
        $('#modalEvidenciasCriterio3').modal('show');
    }
</script>
