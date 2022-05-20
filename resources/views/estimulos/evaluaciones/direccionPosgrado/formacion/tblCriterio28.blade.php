<div class="table-responsive" width = "100%" id="table_refresh">
    <table id="tblCriterio28" class="table table-bordered table-striped" style="font-size:13px;">
        <caption style="font-size:13px;">Atención a alumnos de tesis de técnico superior universitario o equivalente.</caption>
        <thead>
            <tr class="text-center">
                <th scope="col" style="font-size:13px;">Clave</th>
                <th scope="col" style="font-size:13px;">Nombre</th>
                <th scope="col" style="font-size:13px;">Puntos</th>
                <th scope="col" style="font-size:13px;">Total</th>
                <th scope="col" style="font-size:13px;">Año</th>
                @if (Auth::user()->hasPermissionTo("estimulo-evaluaciones-posgrado-formacion-index"))
                    <th scope="col" style="font-size:13px;">Evidencias</th>
                @endif
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
@include('estimulos.evaluaciones.direccionPosgrado.formacion.modalEvidenciasCriterio28')

<script>
    function obtenerCriterio28(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/formacionRH/searchFormacionRH/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosCritero28){
                var datosCriterio28 = datosCritero28.response;
                // console.log(datosCritero28);
                // Codigo para guardar en el sistema...
                if(datosCriterio28.length > 0){
                    for(var i = 0; i < datosCriterio28.length; i++){
                        var dataCriterio28 = datosCriterio28[i];
                        // console.log(dataCriterio28);
                        consultarDatos({
                            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/formacionRH/searchUsernameFormacionRH/" + dataCriterio28.numero_personal,
                            type: 'GET',
                            dataType: 'json',
                            ok: function(datosCritero28Username){
                                // Codigo para guardar en el sistema...
                                var username = datosCritero28Username.response[0];
                                // console.log(username.clave + "->" + username.usuario);
                                $.ajax({
                                    type: 'POST',
                                    url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/formacionRH/saveDatosFormacionRH",
                                    data: {
                                        token: $('#txtTokenRepo').val(),
                                        clave: username.clave,
                                        nombre: username.nombre,
                                        id_objetivo: 6,
                                        id_criterio: 28,
                                        direccion: "DPosgrado",
                                        puntos: 0,
                                        total_puntos: 0,
                                        year: year,
                                        username: username.usuario,
                                    },
                                    headers: {
                                        'token' : $('#txtTokenRepo').val() ? $('#txtTokenRepo').val(): ''
                                    },
                                    success: function(data){
                                        verTablaCriterio28(year, 28);
                                    }
                                });
                            },
                        });
                    }
                }else{
                    verTablaCriterio28(year, 28);
                }
            },
        });
    }

    function verTablaCriterio28(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/formacionRH/datosFormacionRH/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosPosgradoCriterio28){
                // console.log(datosPosgradoCriterio28);
                var datosPosgradoCriterio28 = datosPosgradoCriterio28.response;
                var row = "";
                for(var i = 0; i < datosPosgradoCriterio28.length; i++){
                    var dataPosgradoCriterio28 = datosPosgradoCriterio28[i];
                    // console.log(dataPosgradoCriterio28);
                    var authUser = '<?= Auth::user()->usuario ?>';
                    var permissions = '<?= Auth::user()->hasPermissionTo("estimulo-evaluaciones-posgrado-formacion-index") ?>';
                    // console.log(permissions);
                    if(dataPosgradoCriterio28.username == authUser || permissions == 1){
                        row += "<tr>";
                        row += '<th scope="row" class="text-center" width="10%" style="font-size:12px;">' + dataPosgradoCriterio28.clave + '</td>';
                        row += '<td width="40%" style="font-size:12px;">' + dataPosgradoCriterio28.nombre.toUpperCase() + "</td>";
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + parseInt(dataPosgradoCriterio28.puntos) + '</td>';
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + parseInt(dataPosgradoCriterio28.total_puntos) + '</td>';
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + dataPosgradoCriterio28.year + '</td>';
                        if(permissions == 1){
                            row += '<td class="text-center" width="10%" style="font-size:12px;"><a href="javascript:verEvidenciasCriterio28(' + dataPosgradoCriterio28.year + ', ' + dataPosgradoCriterio28.clave + ', ' + 28 +')"><i class="fa fa-edit"></i></a></td>';
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
