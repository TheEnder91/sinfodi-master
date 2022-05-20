<div class="table-responsive" width = "100%" id="table_refresh">
    <table id="tblCriterio31" class="table table-bordered table-striped" style="font-size:13px;">
        <caption style="font-size:13px;">Atención a alumnos de tesis de doctorado concluida.</caption>
        <thead>
            <tr class="text-center">
                <th scope="col" style="font-size:13px;">Clave</th>
                <th scope="col" style="font-size:13px;">Nombre</th>
                <th scope="col" style="font-size:13px;">Puntos</th>
                <th scope="col" style="font-size:13px;">Total</th>
                <th scope="col" style="font-size:13px;">Año</th>
                @if (Auth::user()->hasPermissionTo("estimulo-evaluaciones-ciencia-formacion-index"))
                    <th scope="col" style="font-size:13px;">Evidencias</th>
                @endif
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
@include('estimulos.evaluaciones.direccionCiencia.formacion.modalEvidenciasCriterio31')

<script>
    function obtenerCriterio31(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/formacionRH/searchFormacionRH/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosCritero31){
                var datosCriterio31 = datosCritero31.response;
                // console.log(datosCritero31);
                // Codigo para guardar en el sistema...
                if(datosCriterio31.length > 0){
                    for(var i = 0; i < datosCriterio31.length; i++){
                        var dataCriterio31 = datosCriterio31[i];
                        // console.log(dataCriterio31);
                        consultarDatos({
                            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/formacionRH/searchUsernameFormacionRH/" + dataCriterio31.numero_personal,
                            type: 'GET',
                            dataType: 'json',
                            ok: function(datosCritero31Username){
                                // Codigo para guardar en el sistema...
                                var username = datosCritero31Username.response[0];
                                // console.log(username.clave + "->" + username.usuario);
                                $.ajax({
                                    type: 'POST',
                                    url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/formacionRH/saveDatosFormacionRH",
                                    data: {
                                        token: $('#txtTokenRepo').val(),
                                        clave: username.clave,
                                        nombre: username.nombre,
                                        id_objetivo: 6,
                                        id_criterio: 31,
                                        direccion: "DCiencia",
                                        puntos: 0,
                                        total_puntos: 0,
                                        year: year,
                                        username: username.usuario,
                                    },
                                    headers: {
                                        'token' : $('#txtTokenRepo').val() ? $('#txtTokenRepo').val(): ''
                                    },
                                    success: function(data){
                                        verTablaCriterio31(year, 31);
                                    }
                                });
                            },
                        });
                    }
                }else{
                    verTablaCriterio31(year, 31);
                }
            },
        });
    }

    function verTablaCriterio31(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/formacionRH/datosFormacionRH/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosCienciaCriterio31){
                // console.log(datosCienciaCriterio31);
                var datosCienciaCriterio31 = datosCienciaCriterio31.response;
                var row = "";
                for(var i = 0; i < datosCienciaCriterio31.length; i++){
                    var dataCienciaCriterio31 = datosCienciaCriterio31[i];
                    // console.log(dataCienciaCriterio31);
                    var authUser = '<?= Auth::user()->usuario ?>';
                    var permissions = '<?= Auth::user()->hasPermissionTo("estimulo-evaluaciones-ciencia-formacion-index") ?>';
                    // console.log(permissions);
                    if(dataCienciaCriterio31.username == authUser || permissions == 1){
                        row += "<tr>";
                        row += '<th scope="row" class="text-center" width="10%" style="font-size:12px;">' + dataCienciaCriterio31.clave + '</td>';
                        row += '<td width="40%" style="font-size:12px;">' + dataCienciaCriterio31.nombre.toUpperCase() + "</td>";
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + parseInt(dataCienciaCriterio31.puntos) + '</td>';
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + parseInt(dataCienciaCriterio31.total_puntos) + '</td>';
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + dataCienciaCriterio31.year + '</td>';
                        if(permissions == 1){
                            row += '<td class="text-center" width="10%" style="font-size:12px;"><a href="javascript:verEvidenciasCriterio31(' + dataCienciaCriterio31.year + ', ' + dataCienciaCriterio31.clave + ', ' + 31 +')"><i class="fa fa-edit"></i></a></td>';
                        }
                        row += "</tr>";
                    }
                }
                if ($.fn.dataTable.isDataTable("#tblCriterio31")) {
                    tblDifusionDivulgacion = $("#tblCriterio31").DataTable();
                    tblDifusionDivulgacion.destroy();
                }
                $('#tblCriterio31 > tbody').html('');
                $('#tblCriterio31 > tbody').append(row);
                $('#tblCriterio31').DataTable({
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

    function verEvidenciasCriterio31(year, clave, criterio){
        $('#modalEvidenciasCriterio31').modal('show');
    }
</script>
