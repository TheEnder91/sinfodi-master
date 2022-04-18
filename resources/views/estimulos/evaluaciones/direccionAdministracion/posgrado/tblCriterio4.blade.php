<div class="table-responsive">
    <table id="tblCriterio4" class="table table-bordered table-striped" style="font-size:13px;">
        <caption>Alumno del programa de maestría del CIDETEQ graduado entre 37 y 42 meses.</caption>
        <thead>
            <tr class="text-center">
                <th scope="col" style="font-size:13px;">Clave</th>
                <th scope="col" style="font-size:13px;">Nombre</th>
                <th scope="col" style="font-size:13px;">Puntos</th>
                <th scope="col" style="font-size:13px;">Total</th>
                <th scope="col" style="font-size:13px;">Año</th>
                @if (Auth::user()->hasPermissionTo("estimulo-evaluaciones-direccionGral-posgrado-index"))
                    <th scope="col" style="font-size:13px;">Evidencias</th>
                @endif
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
@include('estimulos.evaluaciones.direccionAdministracion.posgrado.modalEvidenciasCriterio4')

<script>
    function obtenerCriterio4(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionAdministracion/posgrado/searchPosgrado/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosCritero4){
                var datosCriterio4 = datosCritero4.response;
                // console.log(datosCritero4);
                // Codigo para guardar en el sistema...
                if(datosCriterio4.length > 0){
                    for(var i = 0; i < datosCriterio4.length; i++){
                        var dataCriterio4 = datosCriterio4[i];
                        // console.log(dataCriterio4);
                        consultarDatos({
                            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionAdministracion/posgrado/searchUsernamePosgrado/" + dataCriterio4.numero_personal,
                            type: 'GET',
                            dataType: 'json',
                            ok: function(datosCritero4Username){
                                // Codigo para guardar en el sistema...
                                var username = datosCritero4Username.response[0];
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
                                        direccion: "DGeneral",
                                        puntos: 0,
                                        total_puntos: 0,
                                        year: year,
                                        username: username.usuario
                                    },
                                    headers: {
                                        'token' : $('#txtTokenRepo').val() ? $('#txtTokenRepo').val(): ''
                                    },
                                    success: function(data){
                                        verTablaCriterio4(year, 4);
                                    }
                                });
                            },
                        });
                    }
                }else{
                    verTablaCriterio4(year, 4);
                }
            },
        });
    }

    function verTablaCriterio4(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionAdministracion/posgrado/datosposgrado/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosAdministracionCriterio4){
                // console.log(datosAdministracionCriterio4);
                var datosAdministracionCriterio4 = datosAdministracionCriterio4.response;
                var row = "";
                for(var i = 0; i < datosAdministracionCriterio4.length; i++){
                    var dataAdministracionCriterio4 = datosAdministracionCriterio4[i];
                    // console.log(dataAdministracionCriterio4);
                    var authUser = '<?= Auth::user()->usuario ?>';
                    var permissions = '<?= Auth::user()->hasPermissionTo("estimulo-evaluaciones-direccionGral-posgrado-index") ?>';
                    // console.log(permissions);
                    if(dataAdministracionCriterio4.username == authUser || permissions == 1){
                        row += "<tr>";
                        row += '<th scope="row" class="text-center" width="10%" style="font-size:12px;">' + dataAdministracionCriterio4.clave + '</td>';
                        row += '<td width="40%" style="font-size:12px;">' + dataAdministracionCriterio4.nombre + "</td>";
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + dataAdministracionCriterio4.puntos + '</td>';
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + dataAdministracionCriterio4.total_puntos + '</td>';
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + dataAdministracionCriterio4.year + '</td>';
                        if(permissions == 1){
                            row += '<td class="text-center" width="10%" style="font-size:12px;"><a href="javascript:verEvidenciasCriterio4(' + dataAdministracionCriterio4.year + ', ' + dataAdministracionCriterio4.clave + ', ' + 4 +')"><i class="fa fa-edit"></i></a></td>';
                        }
                        row += "</tr>";
                    }
                }
                if ($.fn.dataTable.isDataTable("#tblCriterio4")) {
                    tblDifusionDivulgacion = $("#tblCriterio4").DataTable();
                    tblDifusionDivulgacion.destroy();
                }
                $('#tblCriterio4 > tbody').html('');
                $('#tblCriterio4 > tbody').append(row);
                $('#tblCriterio4').DataTable({
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

    function verEvidenciasCriterio4(year, clave, criterio){
        $('#modalEvidenciasCriterio4').modal('show');
    }
</script>
