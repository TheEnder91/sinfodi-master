<div class="table-responsive" width = "100%" id="table_refresh">
    <table id="tblCriterio27" class="table table-bordered table-striped" style="font-size:13px;">
        <caption style="font-size:13px;">Atención a alumnos de residencia profesional concluida.</caption>
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
@include('estimulos.evaluaciones.direcionGeneral.formacionRH.modalEvidenciasCriterio27')

<script>
    function obtenerCriterio27(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/formacionRH/searchFormacionRH/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosCritero27){
                var datosCriterio27 = datosCritero27.response;
                // console.log(datosCritero27);
                // Codigo para guardar en el sistema...
                if(datosCriterio27.length > 0){
                    for(var i = 0; i < datosCriterio27.length; i++){
                        var dataCriterio27 = datosCriterio27[i];
                        // console.log(dataCriterio27);
                        consultarDatos({
                            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/formacionRH/searchUsernameFormacionRH/" + dataCriterio27.numero_personal,
                            type: 'GET',
                            dataType: 'json',
                            ok: function(datosCritero27Username){
                                // Codigo para guardar en el sistema...
                                var username = datosCritero27Username.response[0];
                                // console.log(username.clave + "->" + username.usuario);
                                $.ajax({
                                    type: 'POST',
                                    url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/formacionRH/saveDatosFormacionRH",
                                    data: {
                                        token: $('#txtTokenRepo').val(),
                                        clave: username.clave,
                                        nombre: username.nombre,
                                        id_objetivo: 6,
                                        id_criterio: 27,
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
                                        verTablaCriterio27(year, 27);
                                    }
                                });
                            },
                        });
                    }
                }else{
                    verTablaCriterio27(year, 27);
                }
            },
        });
    }

    function verTablaCriterio27(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/formacionRH/datosFormacionRH/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosGeneralCriterio27){
                // console.log(datosGeneralCriterio27);
                var datosGeneralCriterio27 = datosGeneralCriterio27.response;
                var row = "";
                for(var i = 0; i < datosGeneralCriterio27.length; i++){
                    var dataGeneralCriterio27 = datosGeneralCriterio27[i];
                    // console.log(dataGeneralCriterio27);
                    var authUser = '<?= Auth::user()->usuario ?>';
                    var permissions = '<?= Auth::user()->hasPermissionTo("estimulo-evaluaciones-general-formacion-index") ?>';
                    // console.log(permissions);
                    if(dataGeneralCriterio27.username == authUser || permissions == 1){
                        row += "<tr>";
                        row += '<th scope="row" class="text-center" width="10%" style="font-size:12px;">' + dataGeneralCriterio27.clave + '</td>';
                        row += '<td width="40%" style="font-size:12px;">' + dataGeneralCriterio27.nombre.toUpperCase() + "</td>";
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + parseInt(dataGeneralCriterio27.puntos) + '</td>';
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + parseInt(dataGeneralCriterio27.total_puntos) + '</td>';
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + dataGeneralCriterio27.year + '</td>';
                        if(permissions == 1){
                            row += '<td class="text-center" width="10%" style="font-size:12px;"><a href="javascript:verEvidenciasCriterio27(' + dataGeneralCriterio27.year + ', ' + dataGeneralCriterio27.clave + ', ' + 27 +')"><i class="fa fa-edit"></i></a></td>';
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
