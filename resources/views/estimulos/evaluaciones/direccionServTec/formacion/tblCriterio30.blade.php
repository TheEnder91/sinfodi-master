<div class="table-responsive" width = "100%" id="table_refresh">
    <table id="tblCriterio30" class="table table-bordered table-striped" style="font-size:13px;">
        <caption style="font-size:13px;">Atención a alumnos de tesis de maestría concluida.</caption>
        <thead>
            <tr class="text-center">
                <th scope="col" style="font-size:13px;">Clave</th>
                <th scope="col" style="font-size:13px;">Nombre</th>
                <th scope="col" style="font-size:13px;">Puntos</th>
                <th scope="col" style="font-size:13px;">Total</th>
                <th scope="col" style="font-size:13px;">Año</th>
                @if (Auth::user()->hasPermissionTo("estimulo-evaluaciones-servicios-formacion-index"))
                    <th scope="col" style="font-size:13px;">Evidencias</th>
                @endif
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
@include('estimulos.evaluaciones.direccionServTec.formacion.modalEvidenciasCriterio30')

<script>
    function obtenerCriterio30(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/formacionRH/searchFormacionRH/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosCritero30){
                var datosCriterio30 = datosCritero30.response;
                // console.log(datosCritero30);
                // Codigo para guardar en el sistema...
                if(datosCriterio30.length > 0){
                    for(var i = 0; i < datosCriterio30.length; i++){
                        var dataCriterio30 = datosCriterio30[i];
                        // console.log(dataCriterio30);
                        consultarDatos({
                            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/formacionRH/searchUsernameFormacionRH/" + dataCriterio30.numero_personal,
                            type: 'GET',
                            dataType: 'json',
                            ok: function(datosCritero30Username){
                                // Codigo para guardar en el sistema...
                                var username = datosCritero30Username.response[0];
                                // console.log(username.clave + "->" + username.usuario);
                                $.ajax({
                                    type: 'POST',
                                    url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/formacionRH/saveDatosFormacionRH",
                                    data: {
                                        token: $('#txtTokenRepo').val(),
                                        clave: username.clave,
                                        nombre: username.nombre,
                                        id_objetivo: 6,
                                        id_criterio: 30,
                                        direccion: "DServTec",
                                        puntos: 0,
                                        total_puntos: 0,
                                        year: year,
                                        username: username.usuario,
                                    },
                                    headers: {
                                        'token' : $('#txtTokenRepo').val() ? $('#txtTokenRepo').val(): ''
                                    },
                                    success: function(data){
                                        verTablaCriterio30(year, 30);
                                    }
                                });
                            },
                        });
                    }
                }else{
                    verTablaCriterio30(year, 30);
                }
            },
        });
    }

    function verTablaCriterio30(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/formacionRH/datosFormacionRH/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosCienciaCriterio30){
                // console.log(datosCienciaCriterio30);
                var datosCienciaCriterio30 = datosCienciaCriterio30.response;
                var row = "";
                for(var i = 0; i < datosCienciaCriterio30.length; i++){
                    var dataCienciaCriterio30 = datosCienciaCriterio30[i];
                    // console.log(dataCienciaCriterio30);
                    var authUser = '<?= Auth::user()->usuario ?>';
                    var permissions = '<?= Auth::user()->hasPermissionTo("estimulo-evaluaciones-servicios-formacion-index") ?>';
                    // console.log(permissions);
                    if(dataCienciaCriterio30.username == authUser || permissions == 1){
                        row += "<tr>";
                        row += '<th scope="row" class="text-center" width="10%" style="font-size:12px;">' + dataCienciaCriterio30.clave + '</td>';
                        row += '<td width="40%" style="font-size:12px;">' + dataCienciaCriterio30.nombre.toUpperCase() + "</td>";
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + parseInt(dataCienciaCriterio30.puntos) + '</td>';
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + parseInt(dataCienciaCriterio30.total_puntos) + '</td>';
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + dataCienciaCriterio30.year + '</td>';
                        if(permissions == 1){
                            row += '<td class="text-center" width="10%" style="font-size:12px;"><a href="javascript:verEvidenciasCriterio30(' + dataCienciaCriterio30.year + ', ' + dataCienciaCriterio30.clave + ', ' + 30 +')"><i class="fa fa-edit"></i></a></td>';
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
    }

    function verEvidenciasCriterio30(year, clave, criterio){
        $('#modalEvidenciasCriterio30').modal('show');
    }
</script>
