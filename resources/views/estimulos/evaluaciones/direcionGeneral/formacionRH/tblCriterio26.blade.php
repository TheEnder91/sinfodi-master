<div class="table-responsive" width = "100%" id="table_refresh">
    <table id="tblCriterio26" class="table table-bordered table-striped" style="font-size:13px;">
        <caption style="font-size:13px;">Atención a alumnos de prácticas profesionales concluidas.</caption>
        <thead>
            <tr class="text-center">
                <th scope="col" style="font-size:13px;">Clave</th>
                <th scope="col" style="font-size:13px;">Nombre</th>
                <th scope="col" style="font-size:13px;">Puntos</th>
                <th scope="col" style="font-size:13px;">Total</th>
                <th scope="col" style="font-size:13px;">Año</th>
                @if (Auth::user()->hasPermissionTo("estimulo-evaluaciones-general-transferencia-index"))
                    <th scope="col" style="font-size:13px;">Evidencias</th>
                @endif
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
@include('estimulos.evaluaciones.direcionGeneral.formacionRH.modalEvidenciasCriterio26')

<script>
    function obtenerCriterio26(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/formacionRH/searchFormacionRH/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosCritero26){
                var datosCriterio26 = datosCritero26.response;
                // console.log(datosCritero26);
                // Codigo para guardar en el sistema...
                if(datosCriterio26.length > 0){
                    for(var i = 0; i < datosCriterio26.length; i++){
                        var dataCriterio26 = datosCriterio26[i];
                        // console.log(dataCriterio26);
                        consultarDatos({
                            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/formacionRH/searchUsernameFormacionRH/" + dataCriterio26.numero_personal,
                            type: 'GET',
                            dataType: 'json',
                            ok: function(datosCritero26Username){
                                // Codigo para guardar en el sistema...
                                var username = datosCritero26Username.response[0];
                                // console.log(username.clave + "->" + username.usuario);
                                $.ajax({
                                    type: 'POST',
                                    url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/formacionRH/saveDatosFormacionRH",
                                    data: {
                                        token: $('#txtTokenRepo').val(),
                                        clave: username.clave,
                                        nombre: username.nombre,
                                        id_objetivo: 6,
                                        id_criterio: 26,
                                        direccion: "DGeneral",
                                        puntos: 0,
                                        total_puntos: 0,
                                        year: year,
                                        username: username.usuario,
                                    },
                                    headers: {
                                        'token' : $('#txtTokenRepo').val() ? $('#txtTokenRepo').val(): ''
                                    },
                                    success: function(data){
                                        verTablaCriterio26(year, 26);
                                    }
                                });
                            },
                        });
                    }
                }else{
                    verTablaCriterio26(year, 26);
                }
            },
        });
    }

    function verTablaCriterio26(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/formacionRH/datosFormacionRH/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosGeneralCriterio26){
                // console.log(datosGeneralCriterio26);
                var datosGeneralCriterio26 = datosGeneralCriterio26.response;
                var row = "";
                for(var i = 0; i < datosGeneralCriterio26.length; i++){
                    var dataGeneralCriterio26 = datosGeneralCriterio26[i];
                    // console.log(dataGeneralCriterio26);
                    var authUser = '<?= Auth::user()->usuario ?>';
                    var permissions = '<?= Auth::user()->hasPermissionTo("estimulo-evaluaciones-general-formacion-index") ?>';
                    // console.log(permissions);
                    if(dataGeneralCriterio26.username == authUser || permissions == 1){
                        row += "<tr>";
                        row += '<th scope="row" class="text-center" width="10%" style="font-size:12px;">' + dataGeneralCriterio26.clave + '</td>';
                        row += '<td width="40%" style="font-size:12px;">' + dataGeneralCriterio26.nombre.toUpperCase() + "</td>";
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + parseInt(dataGeneralCriterio26.puntos) + '</td>';
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + parseInt(dataGeneralCriterio26.total_puntos) + '</td>';
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + dataGeneralCriterio26.year + '</td>';
                        if(permissions == 1){
                            row += '<td class="text-center" width="10%" style="font-size:12px;"><a href="javascript:verEvidenciasCriterio26(' + dataGeneralCriterio26.year + ', ' + dataGeneralCriterio26.clave + ', ' + 26 +')"><i class="fa fa-edit"></i></a></td>';
                        }
                        row += "</tr>";
                    }
                }
                if ($.fn.dataTable.isDataTable("#tblCriterio26")) {
                    tblDifusionDivulgacion = $("#tblCriterio26").DataTable();
                    tblDifusionDivulgacion.destroy();
                }
                $('#tblCriterio26 > tbody').html('');
                $('#tblCriterio26 > tbody').append(row);
                $('#tblCriterio26').DataTable({
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

    function verEvidenciasCriterio26(year, clave, criterio){
        $('#modalEvidenciasCriterio26').modal('show');
    }
</script>
